<?php

// ROUTE TO PAGE
// page: "Home"


require_once('../app/core/Controller.php');

require_once('../app/models/DemandControl.php');


class HomeController extends Controller
{
    protected $demands;
    protected $situation_names = [
        'DESCONTINUADO' => 'DESCONTINUADO',
        'NAO_INICIADO' => 'NÃO INICIADO',
        'ANDAMENTO' => 'EM ANDAMENTO',
        'CONCLUIDO' => 'CONCLUÍDO',
        'AGUARDANDO_RES' => 'AGUARDANDO RESPOSTA',
        'RESPONDIDO' => 'RESPONDIDO'
    ];

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

    public function delayedSituations()
    {
        $data = [];

        foreach ($this->demands as $demand) {
            $situation = $demand["situacao"];
            $newSituation = $this->situation_names[$situation];
            $delayed = $demand["atrasado"] ? 'atrasado' : 'nao_atrasado';

            if (!isset($data[$newSituation])) {
                $data[$newSituation] = [
                    'atrasado' => 0,
                    'nao_atrasado' => 0,
                ];
            }

            $data[$newSituation][$delayed]++;
        }

        $this->view('layouts/json', $data);
    }

    private function fieldByQuantities($field)
    {
        $data = [];
        foreach ($this->demands as $item) {
            $newField = $item[$field];

            $newFieldItem = isset($this->situation_names[$newField]) ? $this->situation_names[$newField] : $newField;

            if (isset($data[$newFieldItem])) {
                $data[$newFieldItem]++;
            } else {
                $data[$newFieldItem] = 1;
            }
        }
        return $data;
    }
}