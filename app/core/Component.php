<?php
class Component
{
    public $componentData;
    public $template;

    public function __construct(){
        $componentName = static::class;
        $componentDir = COMPONENT_PATH . $componentName . '/';

        $template = $componentDir . $componentName . '.tpl.php';
        $this->render($template, $this->componentData);
    }

    public function render($template, $componentData ){
        include $template;
    }
}