<?php

/*
** Класс маршрутизации
*/

class Route
{

    public static function buildRoute()
    {

//        $controllerName = "IndexController";
//        $modelName = "IndexModel";
//        $viewName = "IndexView";
//        $action = "index";
//
//        $uriParts = explode("?", $_SERVER['REQUEST_URI']);
//        $route = explode("/", $uriParts[0]);
//
//        if ($route[1] != '') {
//            $controllerName = ucfirst($route[1] . "Controller");
//            $modelName = ucfirst($route[1] . "Model");
//            $viewName = ucfirst($route[1] . "View");
//        }
//
//        require_once CONTROLLER_PATH . $controllerName . ".php"; //IndexController.php
//        require_once MODEL_PATH . $modelName . ".php"; //IndexModel.php
//        require_once VIEW_PATH . $viewName . ".php"; //IndexModel.php
//
//        if (isset($route[2]) && $route[2] != '') {
//            $action = $route[2];
//        }
//
//        new $controllerName($action);

        $app = 'Index';
        $action = "index";

        $uriParts = explode("?", $_SERVER['REQUEST_URI']);
        $route = explode("/", $uriParts[0]);

        if ($route[1] != '') {
            $app = ucfirst($route[1]);
        }


        require_once APPS_PATH . $app . "/Controller.php";
        require_once APPS_PATH . $app . "/Model.php";
        require_once APPS_PATH . $app . "/View.php";

        if (isset($route[2]) && $route[2] != '') {
            $action = $route[2];
        }

        $controllerName = "\\apps\\$app\\Controller";
        new $controllerName($action);
    }

    public function errorPage()
    {

    }
}