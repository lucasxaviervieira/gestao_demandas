<?php

// ROUTE TO SEND DATA 
// exit from account

class ExitController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            unset($_SESSION['username']);
            header("Location: http://gestaodemanda/login");
        } else {
            header("Location: http://gestaodemanda/");
        }
    }
}