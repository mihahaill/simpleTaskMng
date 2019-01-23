<?php

require_once "models/User.php";

class LoginController extends Controller
{

    function __construct()
    {
        $this->model = new User();
        $this->model->createAdmin();
        $this->view = new View();
        parent::__construct();
    }

    function action_index()
    {
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            if ($this->model->check($login, $password)) {

                session_start();

                $_SESSION['admin'] = $_POST['login'];
                header('Location: /');
                exit();
            }
        }
        $this->view->render('login.php', 'template.php');
    }

}
