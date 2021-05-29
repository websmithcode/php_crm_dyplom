<?php namespace Core;


class Functions
{
    public static function includeComponent($componentName){
        include COMPONENT_PATH . $componentName . '/' . $componentName . '.php';
    }

    public static function getCurrentPath(){
        return parse_url($_SERVER['REQUEST_URI'])['path'];
    }

    public static function getAppName(): string
    {
        return ucfirst(explode('/', static::getCurrentPath())[1]);
    }
    public static function getActionName(): string
    {
        $action = explode('/', static::getCurrentPath())[2];
        return ucfirst(!empty($action) ? $action : 'Index');
    }
}