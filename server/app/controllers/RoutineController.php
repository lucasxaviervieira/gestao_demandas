<?php

// ROUTE TO DAILY BE UPDATE
// update formulas on each row from "Controle_Demanda" table

require_once('../app/models/DemandControl.php');

require_once('../app/models/Correspondent.php');

require_once('../app/utils/DeltaDays.php');

require_once('../app/utils/Situation.php');

require_once('../app/utils/Delayed.php');

class RoutineController
{
    public function index()
    {
        $demandCtrlModel = new DemandControl;
        $demands = $demandCtrlModel->getAllDemandCtrlID();
        foreach ($demands as $demand) {
            $this->updateCalcFields($demand['id']);
        }
    }

    private function getCalcDataByDemandId($demandId)
    {
        $demandCtrlModel = new DemandControl;
        $demand = $demandCtrlModel->getDemandCtrlById($demandId)[0];

        $correspondentModel = new Correspondent;
        $correspondents = $correspondentModel->getCorrespondentByCtrlDemandId($demandId);

        return array(
            "status" => $demand["status"],
            "atividade_cod" => $demand["atividade_cod"],
            "data_criado" => $demand["data_criado"],
            "data_inicio" => $demand["data_inicio"],
            "data_concluido" => $demand["data_concluido"],
            "previsao_entrega" => $demand["previsao_entrega"],
            "prazo_conclusao" => $demand["prazo_conclusao"],
            "correspondentes" => $correspondents
        );
    }

    private function updateCalcFields($id)
    {
        $data = $this->getCalcDataByDemandId($id);
        $createdDate = $data["data_criado"];
        $startDate = $data["data_inicio"];
        $completionDate = $data["data_concluido"];
        $completionDateLimit = $data["prazo_conclusao"];
        $predictedEnd = $data["previsao_entrega"];
        $status = $data["status"];


        // Situation

        $situationCalc = new Situation;
        $situation = $situationCalc->getSituation($data);

        // Delayed

        $delayed = new Delayed;
        $isLate = $delayed->isLate($predictedEnd, $completionDateLimit, $completionDate);


        // DeltaDays

        $deltaDays = new DeltaDays($status);

        $deltaStart = $deltaDays->daysToStart($createdDate, $startDate);
        $deltaEnd = $deltaDays->daysToFinish($startDate, $completionDate);
        $deltaLate = $deltaDays->daysLate($predictedEnd, $completionDate);
        $deltaLimit = $deltaDays->daysLimit($completionDateLimit, $completionDate);


        $data = array(
            "id" => $id,
            "situacao" => $situation,
            "atrasado" => $isLate,
            "dias_iniciar" => $deltaStart,
            "dias_concluir" => $deltaEnd,
            "dias_atrasado" => $deltaLate,
            "prazo_dias" => $deltaLimit,
        );

        $demandCtrlModel = new DemandControl;
        $demandCtrlModel->putCalcFields($data);
    }
}
