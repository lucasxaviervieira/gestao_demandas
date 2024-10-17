<?php

// ROUTE TO SEND DATA 
// acrescent date to demand control

require_once('../app/models/DemandControl.php');

require_once('../app/utils/DeltaDays.php');



class MoveDemandController
{
    public function startDemand()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demandId = $_POST['id'];

            $demandCtrlModel = new DemandControl;

            $demandCtrlModel->putDateOnDemand($demandId, "data_inicio");
            $this->updateDeltaDays($demandId);

            header("Location: http://gestaodemanda/my");
        }
    }

    public function finishDemand()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demandId = $_POST['id'];

            $demandCtrlModel = new DemandControl;

            $demandCtrlModel->putDateOnDemand($demandId, "data_concluido");
            $this->updateDeltaDays($demandId);

            header("Location: http://gestaodemanda/my");
        }
    }

    private function getDatesByDemandId($demandId)
    {
        $demandCtrlModel = new DemandControl;
        $demand = $demandCtrlModel->getDemandCtrlById($demandId);
        return array(
            "data_criado" => $demand[0]["data_criado"],
            "data_inicio" => $demand[0]["data_inicio"],
            "data_concluido" => $demand[0]["data_concluido"],
            "previsao_entrega" => $demand[0]["previsao_entrega"],
            "prazo_conclusao" => $demand[0]["prazo_conclusao"],
        );
    }

    private function updateDeltaDays($id)
    {
        $dates = $this->getDatesByDemandId($id);
        $createdDate = $dates["data_criado"];
        $startDate = $dates["data_inicio"];
        $completionDate = $dates["data_concluido"];
        $predictedEnd = $dates["previsao_entrega"];
        $completionDateLimit = $dates["prazo_conclusao"];

        $deltaDays = new DeltaDays();

        $deltaStart = $deltaDays->daysToStart($createdDate, $startDate);
        $deltaEnd = $deltaDays->daysToFinish($startDate, $completionDate);
        $deltaLate = $deltaDays->daysLate($predictedEnd, $completionDate);
        $deltaLimit = $deltaDays->daysLimit($completionDateLimit, $completionDate);

        $data = array(
            "id" => $id,
            "dias_iniciar" => $deltaStart,
            "dias_concluir" => $deltaEnd,
            "dias_atrasado" => $deltaLate,
            "prazo_dias" => $deltaLimit,
        );

        $demandCtrlModel = new DemandControl;
        $demandCtrlModel->putDeltaDays($data);
    }
}
