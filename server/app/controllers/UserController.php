<?php

require_once('../app/core/Controller.php');

require_once('../app/models/User.php');

require_once('../app/models/DemandControl.php');

class UserController extends Controller
{
    public function index()
    {
        $userId = isset($_GET['id']) ? $_GET['id'] : 1;

        $data = $this->getNavbarData();

        $users = $this->getUsers();
        $users = ($this->groupUserBySector($users['usuarios']));
        $users = ['usuarios' => $users];

        $demands = $this->getDemandsByUser($userId);

        $data = array_merge($data, $users);
        $data = array_merge($data, $demands);

        $this->view('users/index', $data);
    }
    public function groupUserBySector($users)
    {
        $groupedBySector = [];
        foreach ($users as $value) {
            $id = $value['id'];
            $sector = $value['setor_sigla'];
            $username = $value['nome_usuario'];

            if (!isset($groupedBySector[$sector])) {
                $groupedBySector[$sector] = [];
            }
            $groupedBySector[$sector][] = ['username' => $username, 'id' => $id];
        }
        return $groupedBySector;
    }
    private function getUsers()
    {
        $userModel = new User;
        $users = $userModel->getAllUsers();
        $data = ['usuarios' => $users];
        return $data;
    }
    private function getDemandsByUser($userId)
    {
        $demandCtrlModel = new DemandControl;
        $users = $demandCtrlModel->getDemandCtrl($userId);
        $data = ['demandas' => $users];
        return $data;
    }
}