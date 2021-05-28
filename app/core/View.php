<?php

class View {
    public function render($tpl, $pageData) {

        $cssName =  str_replace('Controller', '', $pageData['controllerName']);
        $pageData['stylesCSS'] = CSS_URI . $cssName . '.css';
        include(TEMPLATE_PATH . "wrapper.php");
    }
}