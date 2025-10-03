<?php
namespace App\Controller;

use App\Controller\AppController;

class UsersController extends AppController
{
    // public function beforeFilter(Event $event)
    // {
    //     parent::beforeFilter($event);
    //     $this->Auth->allow(['add', 'logout']);
    // }

   public function login()
{
    $this->viewBuilder()->setLayout('login');

    if ($this->request->is('post')) {
        $data = $this->request->getData();
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if ($username === 'admin' && $password === '1') {
            // Manually set user session data if needed
            $this->Auth->setUser(['username' => 'admin', 'role' => 'admin']);
            return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
        } else {
            $this->Flash->error('Invalid username or password');
        }
    }
}


    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function index()
    {
      if (!$this->Auth->user()) {
        return $this->redirect(['action' => 'login']);

       
    }
    $users = $this->paginate($this->Users);
    $this->set(compact('users'));
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success('User has been created.');
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error('Unable to add the user.');
        }
        $this->set(compact('user'));
    }

    public function isAuthorized($user)
    {
        // Admin can access all user actions
        if ($user['role'] === 'admin') {
            return true;
        }

        // Vehicle managers can view users but not modify
        if ($user['role'] === 'vehicle_manager' && in_array($this->request->getParam('action'), ['index', 'view'])) {
            return true;
        }

        return parent::isAuthorized($user);
    }
}
