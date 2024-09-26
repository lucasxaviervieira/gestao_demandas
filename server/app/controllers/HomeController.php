<?php

require_once('../app/core/Controller.php');

class HomeController extends Controller
{
    public function index()
    {
        $data = $this->getNavbarData();
        $this->view('home/index', $data);
    }
}