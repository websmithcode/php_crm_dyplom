<?php namespace Core;

class Controller
{

    public $model;
    public $view;
    public $action;
    public $template;
    protected $pageData = array();

    public function __construct($action)
    {
        $controllerName = static::class;
        $rawAppName = explode('\\', static::class);
        $appName = $rawAppName[count($rawAppName) - 2];
        $appNameSpace = "\\apps\\" . $appName . '\\';

        $modelName = $appNameSpace . 'Model';
        $viewName = $appNameSpace . 'View';

        $this->model = new $modelName();
        $this->view = new $viewName();


        $this->action = $action;
        $this->template = APPS_PATH . $appName . '/templates/' . $action . '.tpl.php';

        $this->pageData['controllerName'] = $controllerName;
        $this->$action();
        $this->view->render($this->template, $this->pageData);
    }

    public function exec()
    {

    }
}