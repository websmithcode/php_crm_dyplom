<?php namespace Core;

class View
{

    public $template;

//    public function __construct($template){
//        $this->template = $template;
//    }

    public function render($tpl, $pageData)
    {
        $appName = Functions::getAppName();
        $pageData['styleCSS'] = CSS_URI . $appName . '.css';
        $pageData['scriptJS'] = JS_URI .  $appName . '.js';
        include(TEMPLATE_PATH . "wrapper.php");
    }
}