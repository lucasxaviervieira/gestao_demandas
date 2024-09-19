<?php

require_once('../app/core/Controller.php');

require_once('../app/models/Update.php');

class ExampleController extends Controller
{
    public function index()
    {
        $updateModel = new Update;
        $lastUpdate = $updateModel->getLastUpdate();
        $lastUpdate = $lastUpdate['data_atualizacao'];

        $username = $_SESSION['username'];

        $data = ['username' => $username, 'last_update' => $lastUpdate];
        $this->view('home/index', $data);
    }
}