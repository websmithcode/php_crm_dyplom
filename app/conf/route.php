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
        global $STATE;

        if (!class_exists($controllerName) | !method_exists($controllerName, $action)) {
            static::err404();
            return;
        }
        $controller = new $controllerName();
        if (isset($route[$STATE->maxDepth + 1]) && !empty($route[$STATE->maxDepth + 1])) {
            static::err404();
            return;
        }
        $controller->exec($action);
    }

    public static function reduceSlashes()
    {
        if (str_contains(Functions::getCurrentPath(), '//')) {
            $reduced = Functions::getCurrentPath();
            echo $reduced;
            while (str_contains($reduced, '//')) {
                $reduced = preg_replace("/\/{2}/", '/', $reduced);
            }
            header("Location: $reduced");
        }
    }

    public static function err404()
    {
        global $STATE;
        $STATE->httpCode = 404;
        $STATE->error = 'Page not found';
        static::errorPage();
    }

    public static function errorPage($httpCode = null, $error = null)
    {
        global $STATE;
        $httpCode = $httpCode ?? $STATE->httpCode;
        $error = $error ?? $STATE->error;
        http_response_code((int)$httpCode);
        printf("<h1>%s error</h1><h2>%s</h2>", $httpCode, $error);
    }
}