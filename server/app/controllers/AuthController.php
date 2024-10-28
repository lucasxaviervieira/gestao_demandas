<?php

// ROUTE TO SEND DATA 
// verify login with ldap


require_once('../app/services/LdapAuth.php');

require_once('../app/models/User.php');


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


                if (!$this->isUser($username)) {
                    header("Location: http://gestaodemanda/login/viewSectors?username=$username");
                } else {
                    $_SESSION['username'] = $username;
                    header('Location: http://gestaodemanda/home');
                }

                exit();
            } else {
                header('Location: http://gestaodemanda/');
            }
        } else {
            header('Location: http://gestaodemanda/');
        }
    }

    public function saveUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            session_start();

            $username = $_POST['username'];
            $sectorId = $_POST['sector'];

            $userModel = new User;
            $userModel->createUser($username, $sectorId);

            $_SESSION['username'] = $username;
            header('Location: http://gestaodemanda/home');
        } else {
            header('Location: http://gestaodemanda/');
        }
    }


    private function isUser($username)
    {
        $userModel = new User;
        $userInfo = $userModel->getUser('nome_usuario', $username)[0];
        return isset($userInfo) ? true : false;
    }
}
