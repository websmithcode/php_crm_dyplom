<?php

use Core\Functions;

class Route
{

    public static function buildRoute()
    {
        static::reduceSlashes();
        $app = 'Index';
        $action = "index";
        $route = explode("/", Functions::getCurrentPath());

        if ($route[1] != '') {
            $app = ucfirst($route[1]);
        }
        @include_once APPS_PATH . $app . "/Controller.php";
        @include_once APPS_PATH . $app . "/Model.php";
        @include_once APPS_PATH . $app . "/View.php";

        if (isset($route[2]) && !empty($route[2])) {
            $action = $route[2];
        }

        $controllerName = "\\apps\\$app\\Controller";
        if ((isset($route[3]) && !empty($route[3])) | !class_exists($controllerName) | !method_exists($controllerName, $action)) {
            static::errorPage();
            return;
        }
        new $controllerName($action);
    }
    public static function errorPage()
    {
        echo "<h1>404 error</h1><h2>Page not found</h2>";
    }
    public static function reduceSlashes(){
        if (str_contains(Functions::getCurrentPath(), '//')){
            $reduced = Functions::getCurrentPath();
            while (str_contains($reduced, '//')){
                $reduced = preg_replace("/\/{2}/", '/', $reduced);
            }
            header("Location: $reduced");
        }
    }
}