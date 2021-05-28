<?php


class HandbookController extends Controller{
    public function index() {
        $this->pageData['title'] = "Справочники";
    }

    public function prints() {
        $this->pageData['title'] = "Принты";
    }
    public function sizes() {
        $this->pageData['title'] = "Размеры";
    }
    public function materials() {
        $this->pageData['title'] = "Материалы";
    }
    public function partners() {
        $this->pageData['title'] = "Партнеры";
    }
}