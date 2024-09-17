<?php

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

    private function authHelper()
    {
        session_start();

        if (isset($_SESSION['username'])) {
            $isConnected = 'LOGGED';
        } else {
            $isConnected = 'NOT_LOGGED';
        }
        return $isConnected;
    }

    private function changePage($conn, $page = null)
    {
        echo $conn;
        if ($page == 'LOGIN') {
            if ($conn == 'LOGGED') {
                header('Location: http://gestaodemanda/example');
            }
        } else {
            if ($conn == 'NOT_LOGGED') {
                header('Location: http://gestaodemanda/');
            }
        }
    }
}