<?php

// ROUTE TO PAGE
// page: "Login"

require_once('../app/core/Controller.php');

require_once('../app/models/Sector.php');

class LoginController extends Controller
{
    public function __construct()
    {
        parent::__construct('LOGIN');
    }

    public function index()
    {
        $this->view('login/index/index');
    }

    public function viewSectors()
    {
        $username = $_GET['username'];
        $data = ["username" => $username];

        $data = array_merge($data, $this->getSectors());

        $this->view('login/create/index', $data);
    }

    private function getSectors()
    {
        $sectorModel = new Sector;
        $sectors = $sectorModel->getAllSectors();
        return ["setores" => $sectors];
    }
}
