<?php

class LogoutController extends Controller
{
    function action_index()
    {
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }

}
