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
        $demands = [];
        foreach ($this->demands as $item) {
            $activity = $item['atividade_demanda'];

            if (isset($demands[$activity])) {
                $demands[$activity]++;
            } else {
                $demands[$activity] = 1;
            }
        }

        $activities = array_keys($demands);
        $quantities = array_values($demands);

        $data = [
            'activities' => $activities,
            'quantities' => $quantities
        ];

        $this->view('layouts/json', $data);
    }
}
