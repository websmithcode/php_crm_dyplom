<?php namespace Core;


class Functions
{
    public static function includeComponent($componentName){
        include COMPONENT_PATH . $componentName . '/' . $componentName . '.php';
    }

    public static function getCurrentPath(){
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

    public static function getAppName(){
        return ucfirst(explode('/', static::getCurrentPath())[1]);
    }
}