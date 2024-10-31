<?php

// ROUTE TO PAGE
// page: "Home"


require_once('../app/core/Controller.php');

require_once('../app/models/DemandControl.php');


class HomeController extends Controller
{
    protected $demands;
    public function __construct()
    {
        parent::__construct();
        $demandCtrlModel = new DemandControl;
        $this->demands = $demandCtrlModel->getAllDemandCtrl();
    }
    public function index()
    {
        $data = $this->getCommonData();
        $this->view('home/index', $data);
    }

    public function demandsPerActivities()
    {
        $data = $this->fieldByQuantities('atividade_demanda');
        $this->view('layouts/json', $data);
    }

    public function situationOfDemands()
    {
        $data = $this->fieldByQuantities('situacao');
        $this->view('layouts/json', $data);
    }

    private function fieldByQuantities($field)
    {
        $data = [];
        foreach ($this->demands as $item) {
            $activity = $item[$field];

            if (isset($data[$activity])) {
                $data[$activity]++;
            } else {
                $data[$activity] = 1;
            }
        }
        return $data;
    }
}