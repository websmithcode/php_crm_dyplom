<?php

class View {
    public function render($tpl, $pageData) {

        function includeComponent($componentName){
            include COMPONENT_PATH . $componentName . '/' . $componentName. '.php';
        }

        $cssName =  str_replace('Controller', '', $pageData['controllerName']);
        $pageData['stylesCSS'] = CSS_URI . $cssName . '.css';
        include(TEMPLATE_PATH . "wrapper.php");
    }
}