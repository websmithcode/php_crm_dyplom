<?php namespace apps\User;

class View extends \Core\View
{
    public function render($tpl, $pageData, $sessUser)
    {
        $pageData['is_invalid'] = !empty($pageData['error']) ? "is-invalid" : '';
        parent::render($tpl, $pageData, $sessUser);
    }
}