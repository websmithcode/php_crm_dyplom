<?php namespace apps\Analytics;


use DateTime;

class Controller extends \Core\Controller
{
    public function index()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
        $this->pageData['title'] = "Аналитика";
    }

    public function partner_commission(){
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        $filters = [];
        if (@$_GET['fromDateOrder'] && @$_GET['fromTimeOrder']) {
            $filters['fromDatetimeOrder'] = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['fromDateOrder'] . ' ' . $_GET['fromTimeOrder'] . ':00');
        }
        if (@$_GET['toDateOrder'] && @$_GET['toTimeOrder']) {
            $filters['toDatetimeOrder'] = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['toDateOrder'] . ' ' . $_GET['toTimeOrder'] . ':00');
        }
        if (@$_GET['fromDateAccrual'] && @$_GET['fromTimeAccrual']) {
            $filters['fromDatetimeAccrual'] = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['fromDateAccrual'] . ' ' . $_GET['fromTimeAccrual'] . ':00');
        }
        if (@$_GET['toDateAccrual'] && @$_GET['toTimeAccrual']) {
            $filters['toDatetimeAccrual'] = DateTime::createFromFormat('Y-m-d H:i:s', $_GET['toDateAccrual'] . ' ' . $_GET['toTimeAccrual'] . ':00');
        }

        $this->pageData['title'] = "Аналитика: Комиссия партнеров";
        $this->pageData['partnerCommissions'] = $this->model->getPartnerCommissions($this->sessUser, $filters);
    }
}