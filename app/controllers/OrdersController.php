<?php

class OrdersController extends Controller {

    public function index() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Заказы";

        $filters = [];
        if (@$_GET['fromDate'] && @$_GET['fromTime']) {
            $filters['fromDatetime'] = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['fromDate'] . ' ' . $_GET['fromTime'] . ':00');
        }
        if (@$_GET['toDate'] && @$_GET['toTime']) {
            $filters['toDatetime'] = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['toDate'] . ' ' . $_GET['toTime'] . ':00');
        }

        $this->pageData['orders'] = $this->model->getOrders($filters);
    }
    public function ChangePrices() {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $this->pageData['title'] = "Установка цен";
    }
}
