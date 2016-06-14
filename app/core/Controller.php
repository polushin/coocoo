<?php
namespace app\core;

class Controller
{
    protected $view;
    protected $request;

    public function __construct()
    {
        $this->view = new View();
        $this->request = new Request();

        $controllerName = (new \ReflectionClass(get_called_class()))->getShortName();
        $modelName = str_replace('Controller', '', $controllerName);

        if (file_exists(sprintf("app/model/table/%s.php", $modelName))) {
            $this->$modelName = TableRegistry::get($modelName);
        }
    }

    public function initialize()
    {
    }

    public function redirect($url = '/')
    {
        header('Location: '.$url);
        exit;
    }

    public function getView()
    {
        return $this->view;
    }
}