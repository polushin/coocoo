<?php
namespace app\controller;

use app\core\Controller;

class ErrorController extends Controller
{
    public function index($message = '')
    {
        $this->view->render('error/index', ['message'=>$message]);
    }
}