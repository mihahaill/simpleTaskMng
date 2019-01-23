<?php

class TaskController extends Controller
{

    function __construct()
    {
        $this->model = new Task();
        $this->view = new View();
        parent::__construct();

    }

    function action_index()
    {
        $data = $this->model->getData();
        $this->view->render('task.php', 'template.php', $data);
    }

    function action_update()
    {
        session_start();
        if (isset($_SESSION['admin'])) {
            $data = $this->model->update();
            if (!$data) {
                header('Location: /');
                exit();
            }
            $this->view->render('update.php', 'template.php', $data);
        } else {
            header('Location: /');
            exit();
        }
    }

    function action_create()
    {
        $result = $this->model->create();
        if ($result) {
            header('Location: /');
            exit();
        }
        $this->view->render('create.php', 'template.php');
    }

    function action_delete()
    {
        session_start();
        if (isset($_SESSION['admin'])) {
            $this->model->delete();
        }
        header('Location: /');
        exit();
    }
}
