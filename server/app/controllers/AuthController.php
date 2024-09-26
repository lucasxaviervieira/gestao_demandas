<?php

require_once('../app/services/ldapAuth.php');

class AuthController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $username = $_POST['username'];
            $password = $_POST['password'];

            $auth = new LdapAuth();

            if ($auth->login($username, $password)) {
                $_SESSION['username'] = $username;
                header('Location: http://gestaodemanda/home');
                exit();
            } else {
                header('Location: http://gestaodemanda/');
            }
        } else {
            header('Location: http://gestaodemanda/');
        }
    }
}