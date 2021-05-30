<?php namespace apps\Orders;

use DateTime;

class Controller extends \Core\Controller
{


    public function index()
    {
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
        if (@$_GET['partner'] && $this->sessUser->LoginRoleID== USER_ROLES['MANAGER']) {
            $matches = [];
            preg_match("/^(\d+)\)/", $_GET['partner'], $matches['PartnerID']);
            preg_match("/\)\s(.+)\s\(/", $_GET['partner'], $matches['PartnerName']);
            preg_match("/\((.+)\)/", $_GET['partner'], $matches['PartnerEmail']);
            preg_match("/\[(.+)]$/", $_GET['partner'], $matches['PartnerRequisites']);
            if (!empty($matches['PartnerID'])) {
                $filters['PartnerID'] = $matches['PartnerID'][1];
            }
            if (!empty($matches['PartnerName'])) {
                $filters['PartnerName'] = $matches['PartnerName'][1];
            }
            if (!empty($matches['PartnerEmail'])) {
                $filters['PartnerEmail'] = $matches['PartnerEmail'][1];
            }
            if (!empty($matches['PartnerRequisites'])) {
                $filters['PartnerRequisites'] = $matches['PartnerRequisites'][1];
            }
        }

        $this->pageData['orders'] = $this->model->getOrders($this->sessUser, $filters);
        $this->pageData['partners'] = $this->model->getPartners();
    }

    public function AddOrder()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
        $this->pageData['title'] = "Добавление заказа";
    }
}
