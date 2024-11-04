<?php

// ROUTE TO SEND DATA 
// acrescent date to demand control

require_once('../app/models/DemandControl.php');

require_once('../app/models/Correspondent.php');

require_once('../app/utils/DeltaDays.php');

require_once('../app/utils/Situation.php');

require_once('../app/utils/Delayed.php');

require_once('../app/utils/ConstructUrl.php');


class MoveDemandController
{
    public function startDemand()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demandId = $_POST['id'];

            $demandCtrlModel = new DemandControl;

            $demandCtrlModel->putDateOnDemand($demandId, "data_inicio");
            $this->updateCalcFields($demandId);

            $url = $this->getUrl("/my");
            header("Location: $url");
        }
    }

    public function finishDemand()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demandId = $_POST['id'];

            $demandCtrlModel = new DemandControl;

            $demandCtrlModel->putDateOnDemand($demandId, "data_concluido");
            $this->updateCalcFields($demandId);

            $url = $this->getUrl("/my");
            header("Location: $url");
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
        $predictedEnd = $data["previsao_entrega"];
        $completionDateLimit = $data["prazo_conclusao"];

        // Situation

        $situationCalc = new Situation;
        $situation = $situationCalc->getSituation($data);

        // Situation

        $delayed = new Delayed;
        $isLate = $delayed->isLate($predictedEnd, $completionDateLimit, $completionDate);

        // DeltaDays

        $deltaDays = new DeltaDays();

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

    private function getUrl($path)
    {
        $constructUrlModel = new ConstructUrl($path);
        $url = $constructUrlModel->getUrl();
        return $url;
    }
}