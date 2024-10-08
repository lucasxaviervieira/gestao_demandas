<?php

// ROUTE TO PAGE
// page: "Usuários"

require_once('../app/core/Controller.php');

require_once('../app/models/User.php');

require_once('../app/models/DemandControl.php');

class UserController extends Controller
{
    public function index()
    {
        $userId = isset($_GET['id']) ? $_GET['id'] : 1;
        $userId = (int) $userId;

        $data = $this->getNavbarData();

        $users = $this->getUsers();
        $users = ($this->groupUserBySector($users['usuarios']));
        $users = ['usuarios' => $users];

        $demands = $this->cleanDemands($userId);

        $data = array_merge($data, $users);
        $data = array_merge($data, $demands);

        $this->view('demands/users/index', $data);
    }
    private function getUsers()
    {
        $userModel = new User;
        $users = $userModel->getAllUsers();
        $data = ['usuarios' => $users];
        return $data;
    }
    private function groupUserBySector($users)
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
    private function getDemandsByUser($userId)
    {
        $demandCtrlModel = new DemandControl;
        $demand = $demandCtrlModel->getDemandCtrlByUser($userId);
        $data = ['demandas' => $demand];
        return $data;
    }
    private function cleanDemands($userId)
    {
        $data = $this->getDemandsByUser($userId);
        $newDemand = [];
        foreach ($data['demandas'] as $demands) {
            $cleanDemands = [];

            foreach ($demands as $key => $value) {
                $cleanDemands[$key] = $value === null ? '-' : $value;
                if (gettype($value) === 'boolean') {
                    $cleanDemands[$key] = $value == false ? 'não' : 'sim';
                }
            }
            $newDemand[] = $cleanDemands;
        }
        $cleanedDemands = ['demandas_limpas' => $newDemand];
        return $cleanedDemands;
    }
}