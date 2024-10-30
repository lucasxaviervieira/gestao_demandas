<?php

// ROUTE TO SEND DATA 
// verify login with ldap


require_once('../app/services/LdapAuth.php');

require_once('../app/models/User.php');

require_once('../app/models/DailyAccess.php');


class AuthController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $password = $_POST['password'];

            $auth = new LdapAuth();

            if ($auth->login($username, $password)) {


                if (!$this->isUser($username)) {
                    header("Location: http://gestaodemanda/login/viewSectors?username=$username");
                } else {
                    $this->loginSuccessfuly($username);
                }

                exit();
            } else {
                header("Location: http://gestaodemanda/");
            }
        } else {
            header("Location: http://gestaodemanda/");
        }
    }

    public function saveUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $sectorId = $_POST['sector'];

            $userModel = new User;
            $userModel->createUser($username, $sectorId);

            $this->loginSuccessfuly($username);
        } else {
            header("Location: http://gestaodemanda/");
        }
    }

    private function loginSuccessfuly($username)
    {
        session_start();
        $_SESSION['username'] = $username;

        $this->firstAccessOnDay();

        header("Location: http://gestaodemanda/home");
    }

    private function firstAccessOnDay()
    {
        $currentDate = date('Y-m-d');

        $dailyAccessModel = new DailyAccess;

        $lastAccess = $dailyAccessModel->getLastDailyAccess()[0]['data_hora_acessado'];
        $lastAccess = date('Y-m-d', strtotime($lastAccess));

        if ($currentDate != $lastAccess) {
            header("Location: http://gestaodemanda/routine");
            $dailyAccessModel->createDailyAccess();
        }
    }

    private function isUser($username)
    {
        $userModel = new User;
        $userInfo = $userModel->getUser('nome_usuario', $username)[0];
        return isset($userInfo) ? true : false;
    }
}