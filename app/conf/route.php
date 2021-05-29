<?php

use Core\Functions;

class Route
{

    public static function buildRoute()
    {
        $app = 'Index';
        $action = "index";

        $route = explode("/", Functions::getCurrentPath());

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