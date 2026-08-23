<?php
declare(strict_types=1);

namespace App\Controller;

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
 */
class UsersController extends AppController
{
    use MailerAwareTrait;
    private $Users;
    private $RestorePasswordTokens;
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
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            $password = $this->request->getData('password');
            $confirmPassword = $this->request->getData('confirm_password');

            if (empty($password) || empty($confirmPassword)) {
                $this->Flash->error(__('Password and confirm password fields cannot be empty.'));
                return null;
            }

            if ($password !== $confirmPassword) {
                $this->Flash->error(__('Passwords do not match.'));
                return null;
            }

            if (mb_strlen($password) < 8) {
                $this->Flash->error(__('Password must be at least 8 characters long.'));
                return null;
            }

            if (!preg_match('/[A-Z]/', $password)) {
                $this->Flash->error(__('Password must contain at least one uppercase letter.'));
                return null;
            }

            if (!preg_match('/[0-9]/', $password)) {
                $this->Flash->error(__('Password must contain at least one number.'));
                return null;
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Registration successful. You can now log in.'));
                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Registration failed. Please try again.'));
        }
        $this->set(compact('user'));
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
            ->where(['token' => $token])
            ->first();

        if (!$restorePasswordToken || $restorePasswordToken->expires_at < new DateTime()) {
            $this->Flash->error(__('Invalid or expired password reset token.'));
            return $this->redirect(['action' => 'login']);
        }

        if ($this->request->is('post')) {
            $newPassword = $this->request->getData('password');
            $confirmPassword = $this->request->getData('confirm_password');

            if (empty($newPassword) || empty($confirmPassword)) {
                $this->Flash->error(__('Password and confirm password fields cannot be empty.'));
                return null;
            }

            if ($newPassword !== $confirmPassword) {
                $this->Flash->error(__('Passwords do not match.'));
                return null;
            }

            if (mb_strlen($newPassword) < 8) {
                $this->Flash->error(__('Password must be at least 8 characters long.'));
                return null;
            }

            if (!preg_match('/[A-Z]/', $newPassword)) {
                $this->Flash->error(__('Password must contain at least one uppercase letter.'));
                return null;
            }

            if (!preg_match('/[0-9]/', $newPassword)) {
                $this->Flash->error(__('Password must contain at least one number.'));
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
                $token = TokensGenerator::generateRandomString();
                $expirationDate = new DateTime('+1 hour');

                $this->RestorePasswordTokens->deleteAll(['user_id' => $user->id]);
                $restorePasswordToken = $this->RestorePasswordTokens->newEmptyEntity();
                $restorePasswordToken->user_id = $user->id;
                $restorePasswordToken->token = $token;
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

            $this->Flash->success(__('If you provided a correct email adres, reset link has been sent to your email.'));
        }
    }
}
