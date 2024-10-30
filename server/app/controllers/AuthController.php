<?php

// ROUTE TO SEND DATA 
// verify login with ldap


require_once('../app/services/LdapAuth.php');

require_once('../app/models/User.php');

require_once('../app/models/DailyAccess.php');

require_once('../app/utils/ConstructUrl.php');


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
                    $url = $this->getUrl("/login/viewSectors?username=$username");
                    header("Location: $url");
                } else {
                    $this->loginSuccessfuly($username);
                }

                exit();
            } else {
                $url = $this->getUrl("/");
                header("Location: $url");
            }
        } else {
            $url = $this->getUrl("/");
            header("Location: $url");
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
            $url = $this->getUrl("/");
            header("Location: $url");
        }
    }

    private function loginSuccessfuly($username)
    {
        session_start();
        $_SESSION['username'] = $username;

        $this->firstAccessOnDay();

        $url = $this->getUrl("/home");
        header("Location: $url");
    }

    private function firstAccessOnDay()
    {
        $currentDate = date('Y-m-d');

        $dailyAccessModel = new DailyAccess;

        $lastAccess = $dailyAccessModel->getLastDailyAccess()[0]['data_hora_acessado'];
        $lastAccess = date('Y-m-d', strtotime($lastAccess));

        if ($currentDate != $lastAccess) {
            $url = $this->getUrl("/routine");
            header("Location: $url");
            $dailyAccessModel->createDailyAccess();
        }
    }

    private function isUser($username)
    {
        $userModel = new User;
        $userInfo = $userModel->getUser('nome_usuario', $username)[0];
        return isset($userInfo) ? true : false;
    }

    private function getUrl($path)
    {
        $constructUrlModel = new ConstructUrl($path);
        $url = $constructUrlModel->getUrl();
        return $url;
    }
}
