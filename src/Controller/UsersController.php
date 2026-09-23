<?php
declare(strict_types=1);

namespace App\Controller;

use App\Enum\TaskStatusEnum;
use App\Model\Entity\User;
use App\Utility\PasswordValidator;
use App\Utility\TokensGenerator;
use Cake\Http\Response;
use Cake\I18n\DateTime;
use Cake\Routing\Router;
use Random\RandomException;
use Cake\Mailer\MailerAwareTrait;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\RestorePasswordTokensTable $RestorePasswordTokens
 * @property \App\Model\Table\TasksTable $Tasks
 */
class UsersController extends AppController
{
    use MailerAwareTrait;

    private const RESET_TOKEN_LIFETIME = 60;
    private const RESET_PASSWORD_LIMIT = 5;

    private $Users;
    private $RestorePasswordTokens;
    private $Tasks;
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['login', 'register', 'forgotPassword', 'resetPassword']);
        $this->Users = $this->fetchTable('Users');
        $this->RestorePasswordTokens = $this->fetchTable('RestorePasswordTokens');
        $this->Tasks = $this->fetchTable('Tasks');
    }

    /**
     * Login method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful login, renders view otherwise.
     */
    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        if ($result->isValid()) {
            $this->Flash->success(__('Login successful'));
            $redirect = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Tasks', 'action' => 'index'];

            return $this->redirect($redirect);
        }

        if ($this->request->is('post')) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }

    public function register()
    {
        $this->request->allowMethod(['get', 'post']);
        $user = $this->Users->newEmptyEntity();

        $avatars = $this->fetchTable('Avatars')
            ->find()
            ->all();

        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $error = PasswordValidator::validate(
                $this->request->getData('password'),
                $this->request->getData('confirm_password'),
            );

            if ($error !== null) {
                $this->Flash->error($error);
            } elseif ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful. You can now log in.'));

                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Registration failed. Please try again.'));
            }
        }

        $selectedAvatarId = $user->avatar_id ?? $avatars->first()?->id;

        $this->set(compact('user', 'avatars', 'selectedAvatarId'));
    }

    public function logout()
    {
        $this->Authentication->logout();
        $this->Flash->success(__('You have been logged out.'));

        return $this->redirect(['action' => 'login']);
    }

    public function resetPassword($token): ?Response
    {
        if (empty($token) || strlen($token) < 64) {
            return $this->redirect(['action' => 'login']);
        }

        $restorePasswordToken = $this->RestorePasswordTokens
            ->find()
            ->where(['token' => TokensGenerator::hash($token)])
            ->first();

        if (!$restorePasswordToken || $restorePasswordToken->expires_at < new DateTime()) {
            $this->Flash->error(__('Invalid or expired password reset token.'));
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            $newPassword = $this->request->getData('password');

            $error = PasswordValidator::validate($newPassword, $this->request->getData('confirm_password'));
            if ($error !== null) {
                $this->Flash->error($error);

                return null;
            }

            $user = $this->Users->get($restorePasswordToken->user_id);
            $user->password = $newPassword;

            if ($this->Users->save($user)) {
                $this->RestorePasswordTokens->delete($restorePasswordToken);
                $this->Flash->success(__('Your password has been reset successfully. You can now log in.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Failed to reset password. Please try again.'));
            }
        }

        return null;
    }

    /**
     * @throws RandomException
     */
    public function forgotPassword()
    {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');

            $user = $this->Users
                ->find()
                ->where(['email' => $email])
                ->first();

            if ($user) {
                $existingToken = $this->RestorePasswordTokens
                    ->find()
                    ->where(['user_id' => $user->id])
                    ->first();

                $cooldownEnds = new DateTime(sprintf('+%d minutes', self::RESET_TOKEN_LIFETIME - self::RESET_PASSWORD_LIMIT),);

                if ($existingToken && $existingToken->expires_at > $cooldownEnds) {
                    $this->Flash->warning(__('A password reset link has already been sent to your email. Please check your inbox or wait {0} minutes to create a new one', self::RESET_PASSWORD_LIMIT));

                    return;
                }

                $token = TokensGenerator::generateRandomString();
                $expirationDate = new DateTime(sprintf('+%d minutes', self::RESET_TOKEN_LIFETIME));

                $this->RestorePasswordTokens->deleteAll(['user_id' => $user->id]);
                $restorePasswordToken = $this->RestorePasswordTokens->newEmptyEntity();
                $restorePasswordToken->user_id = $user->id;
                $restorePasswordToken->token = TokensGenerator::hash($token);
                $restorePasswordToken->expires_at = $expirationDate;

                if ($this->RestorePasswordTokens->save($restorePasswordToken)) {
                    try {
                        $this->getMailer('Default')->send('forgotPassword', [
                            $user->email,
                            Router::url(['controller' => 'Users', 'action' => 'resetPassword', $token], true)
                        ]);
                    } catch (\Exception $e) {
                        $this->Flash->error(__('Failed to send password reset email. Please try again later.'));
                    }
                }
            }

            $this->Flash->success(__('If you provided a correct email address, reset link has been sent to your email.'));
        }
    }

    public function profile()
    {
        $user = $this->Users->get($this->currentUserId());

        $counts = $this->Tasks->find()
            ->select(['status', 'count' => 'COUNT(*)'])
            ->where(['user_id' => $user->id])
            ->groupBy('status')
            ->all()
            ->combine('status', 'count')
            ->toArray();

        $totalTasks = (int)array_sum($counts);
        $doneTasks = (int)($counts[TaskStatusEnum::DONE] ?? 0);
        $activeTasks = $totalTasks - $doneTasks;
        $donePercent = $totalTasks > 0 ? (int)round($doneTasks / $totalTasks * 100) : 0;

        $userName = $user->name;
        $userEmail = $user->email;
        $memberSince = $user->created?->i18nFormat('d MMM yyyy');
        $breakdown = $this->buildStatusBreakdown($counts);

        $avatars = $this->fetchTable('Avatars')
            ->find()
            ->all();

        $this->set(compact(
            'userName',
            'userEmail',
            'memberSince',
            'totalTasks',
            'doneTasks',
            'activeTasks',
            'donePercent',
            'breakdown',
            'avatars'
        ));
    }

    public function changePassword()
    {
        $user = $this->Users->get($this->currentUserId());

        if ($this->request->is('post')) {
            $newPassword = $this->request->getData('new_password');

            if (!$this->isCurrentPasswordValid($user, $this->request->getData('current_password'))) {
                $this->Flash->error(__('Current password is incorrect.'));

                return null;
            }

            $error = PasswordValidator::validate($newPassword, $this->request->getData('confirm_password'));
            if ($error !== null) {
                $this->Flash->error($error);

                return null;
            }

            $user->password = $newPassword;

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been changed successfully.'));
                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('Failed to change password. Please try again.'));
            }
        }
    }

    public function changeAvatar(): ?Response
    {
        $this->request->allowMethod(['post']);

        $user = $this->Users->get($this->currentUserId());

        $this->Users->patchEntity(
            $user,
            ['avatar_id' => $this->request->getData('avatar_id')],
            ['fields' => ['avatar_id']],
        );

        if ($this->Users->save($user)) {
            $this->Flash->success(__('Your avatar has been changed successfully.'));
        } else {
            $errors = $user->getError('avatar_id');
            $this->Flash->error($errors ? reset($errors) : __('Failed to change avatar. Please try again.'));
        }

        return $this->redirect(['action' => 'profile']);
    }

    /**
     * Checks the plain text password against the user's hash using the hasher
     * configured for the login form, so the hashing logic is never duplicated here.
     *
     * @param \App\Model\Entity\User $user Logged in user (loaded by id).
     * @param string|null $password Plain text password to check.
     * @return bool
     */
    private function isCurrentPasswordValid(User $user, ?string $password): bool
    {
        $hasher = $this->Authentication
            ->getAuthenticationService()
            ->authenticators()
            ->get('Form')
            ->getIdentifier()
            ->getPasswordHasher();

        return $hasher->check((string)$password, (string)$user->password);
    }

    /**
     * Rows for the "tasks by status" bar / legend: translated label, css accent slug and count per status.
     *
     * @param array<int, int|string> $counts Status value => number of tasks.
     * @return array<int, array<string, mixed>>
     */
    private function buildStatusBreakdown(array $counts): array
    {
        $accents = TaskStatusEnum::getAccents();

        $breakdown = [];
        foreach (TaskStatusEnum::getStatuses() as $value => $label) {
            $breakdown[] = [
                'label' => $label,
                'accent' => $accents[$value],
                'count' => (int)($counts[$value] ?? 0),
            ];
        }

        return $breakdown;
    }
}
