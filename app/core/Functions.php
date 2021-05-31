<?php namespace Core;


class Functions
{
    public static function includeComponent($componentName)
    {
        include COMPONENT_PATH . $componentName . '/' . $componentName . '.php';
    }

    public static function getAppName(): string
    {
        $_pathParts = explode('/', static::getCurrentPath());
        $appName = @$_pathParts[1];
        return ucfirst(!empty($appName) ? $appName : 'Index');
    }

    public static function getCurrentPath($offset=0): string
    {
        $pathParts = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
        $pathParts = array_slice($pathParts, 0, count($pathParts) + $offset);
        return join('/', $pathParts);
    }

    public static function getActionName(): string
    {
        $_pathParts = explode('/', static::getCurrentPath());
        $action = @$_pathParts[2];
        return !empty($action) ? $action : 'index';
    }
}