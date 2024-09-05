<?php

require '../models/Database.php';
require '../models/User.php';
require '../controllers/UserController.php';

$db = new PDO('mysql:host=localhost;dbname=my_database', 'root', '');
$userModel = new User($db);
$userController = new UserController($userModel);

$userController->index();