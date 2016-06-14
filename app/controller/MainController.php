<?php
namespace app\controller;

class MainController extends AppController
{
    public function index()
    {
        $this->redirect('/posts');
    }
}