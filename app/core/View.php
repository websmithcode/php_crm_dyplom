<?php namespace Core;

class View
{

    public $template;

//    public function __construct($template){
//        $this->template = $template;
//    }

    public function render($tpl, $pageData)
    {
        function includeComponent($componentName)
        {
            include COMPONENT_PATH . $componentName . '/' . $componentName . '.php';
        }

        function getCurrentPath()
        {
            return parse_url($_SERVER['REQUEST_URI'])['path'];
        }

        $cssName = str_replace('Controller', '', $pageData['controllerName']);
        $pageData['stylesCSS'] = CSS_URI . $cssName . '.css';
        include(TEMPLATE_PATH . "wrapper.php");
    }
}