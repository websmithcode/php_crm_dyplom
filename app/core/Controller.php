<?php namespace Core;

use Route;

class Controller
{

    public object $model;
    public object $view;
    public string $action;
    public string $template;
    protected string $appName;
    protected array $pageData = array();
    protected $sessUser;

    public function __construct()
    {
        $controllerName = static::class;
        $this->appName = Functions::getAppName();
        $appNameSpace = "\\apps\\" . $this->appName . '\\';

        $modelName = $appNameSpace . 'Model';
        $viewName = $appNameSpace . 'View';

        $this->model = new $modelName();
        $this->view = new $viewName();

        $this->pageData['controllerName'] = $controllerName;
        $this->sessUser = $this->model->getSessUser();
    }

    public function exec($action)
    {
        global $STATE;
        $this->template = APPS_PATH . $this->appName . '/templates/' . $action . '.tpl.php';
        $this->$action();
        if ($STATE->httpCode >= 400) {
            Route::errorPage();
            return;
        }
        $this->view->render($this->template, $this->pageData, $this->sessUser);
    }

}