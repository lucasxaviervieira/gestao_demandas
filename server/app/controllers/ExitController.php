<?php

// ROUTE TO SEND DATA 
// exit from account

require_once('../app/utils/ConstructUrl.php');


class ExitController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            unset($_SESSION['username']);
            $url = $this->getUrl("/login");
            header("Location: $url");
        } else {
            $url = $this->getUrl("/");
            header("Location: $url");
        }
    }
    private function getUrl($path)
    {
        $constructUrlModel = new ConstructUrl($path);
        $url = $constructUrlModel->getUrl();
        return $url;
    }
}
