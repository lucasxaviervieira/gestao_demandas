<?php

// ROUTE TO PAGE
// page: "Home"


require_once('../app/core/Controller.php');

class HomeController extends Controller
{
    public function index()
    {
        $data = $this->getCommonData();
        $this->view('home/index', $data);
    }
}
