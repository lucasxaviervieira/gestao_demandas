<?php

require_once('../app/models/Update.php');

class Controller
{
    public function __construct($page = null)
    {
        $isConn = $this->authHelper();
        $this->changePage($isConn, $page);
    }

    public function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            extract($data);

            require_once $viewPath;
        } else {
            throw new \Exception("View {$view} not found.");
        }
    }

    public function getNavbarData()
    {
        $username = $_SESSION['username'];
        $lastUpdate = new DateTime($this->getLastUpt());
        $lastUptTime = $lastUpdate->format('H:i:s');
        $lastUptDate = $lastUpdate->format('d/m/Y');
        $data = ['username' => $username, 'last_update' => ['time' => $lastUptTime, 'date' => $lastUptDate]];
        return $data;
    }
    private function getLastUpt()
    {
        $updateModel = new Update;
        $lastUpdate = $updateModel->getLastUpdate();
        $lastUpdate = $lastUpdate['data_atualizacao'];
        return $lastUpdate;
    }

    private function authHelper()
    {
        session_start();
        $isConnected = (isset($_SESSION['username'])) ?  'LOGGED' : 'NOT_LOGGED';
        return $isConnected;
    }

    private function changePage($conn, $page = null)
    {
        if ($page == 'LOGIN') {
            if ($conn == 'LOGGED') {
                header('Location: http://gestaodemanda/home');
            }
        } else {
            if ($conn == 'NOT_LOGGED') {
                header('Location: http://gestaodemanda/');
            }
        }
    }
}
