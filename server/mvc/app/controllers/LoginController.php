<?php

require_once('../app/core/Controller.php');

require_once('../app/services/ldapAuth.php');

class LoginController extends Controller
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $auth = new LdapAuth();

            if ($auth->login($username, $password)) {
                header('Location: http://gestaodemanda/test');
                exit();
            } else {
                header('Location: http://gestaodemanda/');
            }
        }
    }
}