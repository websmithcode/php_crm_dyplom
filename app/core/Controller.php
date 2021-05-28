<?php

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
        $pageDirName = str_replace('Controller', '', $controllerName);
        $modelName = $pageDirName . "Model";
        $viewName = $pageDirName . "View";


        $this->action = $action;
        $this->template = TEMPLATE_PATH . 'content/' . strtolower($pageDirName) . '/' . $action . '.tpl.php';
        if ($controllerName == 'IndexController') {
            $this->template = TEMPLATE_PATH . 'content/index.tpl.php';
        }
        $this->pageData['controllerName'] = $controllerName;
        $this->model = new $modelName();
        $this->view = new $viewName();

        $this->$action();
        $this->view->render($this->template, $this->pageData);
    }

}