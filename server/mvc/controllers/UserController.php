<?php

class UserController
{
    private $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        include '../views/users.php';
    }
}