<?php

require_once('../app/core/Controller.php');

require_once('../app/models/Update.php');

class UserController extends Controller
{
    public function index()
    {
        $data = $this->getNavbarData();
        $this->view('home/index', $data);
    }
}