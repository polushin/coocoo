<?php

namespace app\core;

class Request{

    public function data($key)
    {
        if (isset($_POST[$key])) {
            return $_POST[$key];
        }
        return null;
    }

    public function getData()
    {
        return $_POST;
    }

    public function isPost()
    {
        return !empty($_POST);
    }
}
