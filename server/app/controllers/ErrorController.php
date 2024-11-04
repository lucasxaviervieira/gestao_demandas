<?php

// ROUTE TO ERROR PAGE
// page: "Error"

require_once('../app/core/Controller.php');

class ErrorController extends Controller
{
    public function index()
    {
        $this->view('error/index');
    }
}