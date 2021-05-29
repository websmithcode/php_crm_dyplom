<?php namespace apps\Reference;


class Controller extends \Core\Controller{
    public function index() {
        $this->pageData['title'] = "Справка";
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
    }
}