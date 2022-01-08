<?php

class Router
{

    public static function route($url)
    {
        // Controller
        $controller = (isset($url[0]) && $url != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
        $controller_name = $controller;
        array_shift($url);

        // Action
        $action = (isset($url[0]) && $url != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = $action;
        array_shift($url);

        //params
        $queryParams = $url;

        $dispacth  = new $controller($controller_name, $action);

        if (method_exists($controller, $action)) {
            call_user_func_array([$dispacth, $action], $queryParams);
        } else {
            include(ROOT.DS.'app'.DS.'views'.DS.'home'.DS.'404Error'.'.php');
            die();
        }
    }

    public static function redirect($location)
    {
        header('Location: ' . SROOT . $location);
    }
}
