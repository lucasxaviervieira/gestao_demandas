<?php

require_once('../app/core/Controller.php');

require_once('../app/models/Update.php');

class HomeController extends Controller
{
    public function index()
    {
        $data = $this->getNavbarData();
        $this->view('home/index', $data);
    }
}