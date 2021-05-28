<?php


class UserController extends Controller{
    public function index()
    {
        $this->pageData['title'] = "Страница пользователя";
        if (empty($_SESSION['user'])) {
            header('Location: /user/login');
        }
    }

    public function login()
    {
        $this->pageData['title'] = "Вход в личный кабинет";
        if (!empty($_SESSION['user'])) {
            header('Location: /user/');
        }

        if (!empty($_POST)) {
            $loggedInUser = $this->model->checkUser();
            if (!$loggedInUser) {
                $this->pageData['error'] = "Не правильный логин или пароль";
            } else {
                $_SESSION['user'] = $loggedInUser;
                header("Location: /user");
            }
        }
    }


    public function logout()
    {
        session_destroy();
        header('Location: /user/login');
    }
}