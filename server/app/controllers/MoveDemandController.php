<?php

// ROUTE TO SEND DATA 
// acrescent date to demand control

require_once('../app/models/DemandControl.php');


class MoveDemandController
{
    public function startDemand()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demand_id = $_POST['id'];

            $demandCtrlModel = new DemandControl;

            $demandCtrlModel->putDateOnDemand($demand_id, "data_inicio");

            header("Location: http://gestaodemanda/my");
        }
    }

    public function finishDemand()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demand_id = $_POST['id'];

            $demandCtrlModel = new DemandControl;

            $demandCtrlModel->putDateOnDemand($demand_id, "data_concluido");

            header("Location: http://gestaodemanda/my");
        }
    }
}
