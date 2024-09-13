<?php

require_once('../app/core/Controller.php');

class UserController extends Controller
{
    public function index()
    {
        session_start();
        if (isset($_SESSION['user'])) {
            header('Location: http://gestaodemanda/test');
        } else {
            $this->view('user/login');
        }
    }
}