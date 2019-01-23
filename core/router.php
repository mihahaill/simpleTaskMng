<?php

class Router
{

    static function start()
    {
        $controller_name = 'Task';
        $model_name = 'Task';
        $action_name = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }

        if (!empty($routes[2])) {
            $act = explode('?', $routes[2]);
            $action_name = $act[0];
        }

        $controller_name = ucfirst($controller_name) . 'Controller';
        $action_name = 'action_' . $action_name;

        $model_file = $model_name . '.php';
        $model_path = "models/" . $model_file;
        if (file_exists($model_path)) {
            include $model_path;
        }

        $controller_file = $controller_name . '.php';
        $controller_path = "controllers/" . $controller_file;

        if (file_exists($controller_path)) {
            include $controller_path;
        } else {
            Router::ErrorPage();
        }

        $controller = new $controller_name;
        $action = $action_name;

        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Router::ErrorPage();
        }

    }

    function ErrorPage()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . 'error');
        exit();
    }

}
