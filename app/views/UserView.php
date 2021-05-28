<?php

class UserView extends View{
    public function render($tpl, $pageData) {
        $pageData['is_invalid'] = !empty($pageData['error']) ? "is-invalid" : '';
        parent::render($tpl, $pageData);
    }
}