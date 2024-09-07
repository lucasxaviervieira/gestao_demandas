<?php
class HomeController {
    public function index() {
        require_once '../app/models/User.php';
        $user = new User();
        $data = $user->getUserData();
        
        require_once '../app/views/home.php';
    }
}