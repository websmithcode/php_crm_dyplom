<?php namespace apps\User;

class View extends \core\View{
    public function render($tpl, $pageData) {
        $pageData['is_invalid'] = !empty($pageData['error']) ? "is-invalid" : '';
        parent::render($tpl, $pageData);
    }
}