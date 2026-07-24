<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * Initialize controller
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->Authentication->allowUnauthenticated(['login', 'register']);
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
            $redirect = $this->Authentication->getLoginRedirect() ?? ['controller' => 'Start', 'action' => 'index'];

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
}
