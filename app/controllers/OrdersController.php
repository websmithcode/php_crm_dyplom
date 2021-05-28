<?php

class OrdersController extends Controller {

    public function index() {
        $this->pageData['title'] = "Заказы";
        $this->pageData['orders'] = $this->model->getOrders();
    }
    public function ChangePrices() {
        $this->pageData['title'] = "Установка цен";
    }
}
