<?php
namespace app\controller;

use app\core\Controller;
use app\core\auth\Auth;
use app\core\Configure;

class AppController extends Controller
{
    public function initialize()
    {
        $this->auth = new Auth([
            'loginField' => 'email'
        ]);

        $this->loggedUser = $this->auth->getUser();

        $this->view->set('loggedUser', $this->loggedUser);
        $this->view->set('blogName', Configure::get('blogName'));
    }
}