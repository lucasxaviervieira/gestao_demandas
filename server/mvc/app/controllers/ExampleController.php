<?php

require_once('../app/core/Controller.php');

class ExampleController extends Controller
{
    public function index()
    {
        $data = ['name' => 'lucas', 'email' => 'lucas@gmail.com'];
        // echo $_SESSION['username'];
        $this->view('user/index', $data);
    }
}