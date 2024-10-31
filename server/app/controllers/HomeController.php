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

    public function demandsPerSituation()
    {
        $demands_per_situation = [];
        foreach ($this->demands as $item) {
            $activity = $item['atividade_demanda'];

            if (isset($demands_per_situation[$activity])) {
                $demands_per_situation[$activity]++;
            } else {
                $demands_per_situation[$activity] = 1;
            }
        }

        $activities = array_keys($demands_per_situation);
        $situations = array_values($demands_per_situation);

        $data = [
            'activities' => $activities,
            'situations' => $situations
        ];

        $this->view('layouts/json', $data);
    }
}
