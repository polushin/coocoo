<?php

namespace app\controller;

class UsersController extends AppController
{
    public function login()
    {
        if ($this->auth->getUser()) {
            throw new \Exception('You are already logged!');
        }

        $error = '';

        if ($this->request->isPost()) {
            if ($this->auth->check($this->request->data('email'), $this->request->data('password'))) {
                $this->redirect('/');
            }
            $error = 'Incorrect login or password';
        }
        $this->view->set('error', $error);
    }

    public function logout()
    {
        $this->auth->logout();
        $this->redirect('/');
    }
}

