<?php


class HandbookController extends Controller{
    public function index() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Справочники";
    }

    public function prints() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Принты";
    }
    public function sizes() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Размеры";
    }
    public function materials() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Материалы";
    }
    public function partners() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Партнеры";
    }
}