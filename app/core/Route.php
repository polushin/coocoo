<?php

namespace app\core;

class Route
{
    public static function start()
    {
        $controllerName = 'Main';
        $actionName = 'index';
        $actionParameter = null;

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controllerName = $routes[1];
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        if (!empty($routes[3])) {
            $actionParameter = $routes[3];
        }

        $controllerName = ucfirst($controllerName);
        $controllerFullName = '\\app\\controller\\'. $controllerName . 'Controller';

        $controller = new $controllerFullName();
        $controller->initialize();

        if (method_exists($controller, $actionName)) {
            $controller->$actionName($actionParameter);
            $view = $controller->getView();
            $view->render(lcfirst($controllerName) . '/' . $actionName);
        } else {
            throw new \Exception('route not found');
        }
    }

    public static function error($message)
    {
        $controller = new \app\controller\ErrorController();
        $controller->index($message);
    }
}