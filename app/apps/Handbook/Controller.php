<?php namespace apps\Handbook;


class Controller extends \Core\Controller
{
    public function index()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Справочники";
    }

    public function prints()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
        $this->pageData['title'] = "Принты";
        $this->pageData['prints'] = $this->model->getPrints();
    }

    public function sizes()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Размеры";
        $this->pageData['sizes'] = $this->model->getSizes();
    }

    public function materials()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Материалы";
    }

    public function partners()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Партнеры";
    }
}
