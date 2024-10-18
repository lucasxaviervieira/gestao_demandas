<?php

// ROUTE TO PAGE
// page: "Minhas Demandas"

require_once('../app/core/Controller.php');

require_once('../app/models/User.php');

require_once('../app/models/DemandControl.php');


class MyController extends Controller
{
    public function index()
    {
        $userId = $this->getUserByUsername();

        $data = $this->getCommonData();

        $demands = $this->separateDemands($userId);

        $data = array_merge($data, $demands);

        $this->view('demands/my/index', $data);
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

    private function separateDemands($userId)
    {
        $data = $this->cleanDemands($userId);
        $notStarted = [];
        $inProgress = [];
        $finished = [];
        foreach ($data['demandas_limpas'] as $demands) {

            if ($demands['data_inicio'] == '-') {
                $notStarted[] = $demands;
            } else {
                if ($demands['data_concluido'] == '-') {
                    $inProgress[] = $demands;
                } else {
                    $finished[] = $demands;
                }
            }
        }
        $separated = ['NOT_STARTED' => $notStarted, 'IN_PROGRESS' => $inProgress, 'FINISHED' => $finished];
        return ['demandas_separadas' => $separated];
    }

    private function getUserByUsername()
    {
        $username = $_SESSION['username'];
        $userModel = new User;
        return ($userModel->getUser('nome_usuario', $username)[0]['id']);
    }
}
