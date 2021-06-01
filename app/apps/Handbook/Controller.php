<?php namespace apps\Handbook;


use PDOException;

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

        global $STATE;
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->pageData['prints'] = $this->model->getPrints();
                    $this->pageData['title'] = "Принты";
                    break;
                case 'POST':
                    $toUpdate = (array)json_decode(file_get_contents('php://input'));
                    $this->model->addPrint($toUpdate);

                    break;
                default:
                    $STATE->httpCode = 404;
            }
        } catch (PDOException) {
            $STATE->httpCode = 400;
        }
    }

    public function sizes()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        global $STATE;
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->pageData['title'] = "Размеры";
                    $this->pageData['sizes'] = $this->model->getSizes();
                    break;
                case 'POST':
                    $toUpdate = (array)json_decode(file_get_contents('php://input'));
                    $this->model->addSize($toUpdate);

                    break;
                default:
                    $STATE->httpCode = 404;
            }
        } catch (PDOException) {
            $STATE->httpCode = 400;
        }
    }

    public function materials()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');

        }
            global $STATE;
            try {
                switch ($_SERVER['REQUEST_METHOD']) {
                    case 'GET':
                        $this->pageData['materials'] = $this->model->getMaterials();
                        $this->pageData['title'] = "Материалы";
                        break;
                    case 'POST':
                        $toUpdate = (array)json_decode(file_get_contents('php://input'));
                        $this->model->addMaterial($toUpdate);

                        break;
                    default:
                        $STATE->httpCode = 404;
                }
            } catch (PDOException) {
                $STATE->httpCode = 400;
            }
    }

    public function partners()
    {
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }

        global $STATE;
        try {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    $this->pageData['title'] = "Партнеры";
                    $this->pageData['partners'] = $this->model->getPartners();
                    break;
                case 'POST':
                    $toUpdate = (array)json_decode(file_get_contents('php://input'));
                    $this->model->addPartner($toUpdate);

                    break;
                default:
                    $STATE->httpCode = 404;
            }
        } catch (PDOException) {
            $STATE->httpCode = 400;
        }
    }
}

