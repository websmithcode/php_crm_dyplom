<?php


class ReferenceController extends Controller{
    public function index() {
        $this->pageData['title'] = "Справка";
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
    }
}