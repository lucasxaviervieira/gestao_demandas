<?php

require_once('../app/core/Controller.php');

class UserController extends Controller
{
    public function index()
    {
        $data = $this->getNavbarData();
        $this->view('home/index', $data);
    }
}