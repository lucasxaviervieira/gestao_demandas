<?php

require_once('../app/core/Controller.php');

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct('LOGIN');
    }

    public function index()
    {
        $this->view('user/login');
    }
}