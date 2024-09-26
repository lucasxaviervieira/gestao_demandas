<?php

require_once('../app/models/Demand.php');

require_once('../app/models/Activity.php');

require_once('../app/models/DemandControl.php');

require_once('../app/models/Update.php');

require_once('../app/models/User.php');

require_once('../app/models/Correspondent.php');


class CreateDemandController
{

    protected $new_demand_id = null;
    protected $new_ctrl_demand_id = null;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->create($_POST);
            header('Location: http://gestaodemanda/create');
        } else {
            header('Location: http://gestaodemanda/');
        }
    }
    private function create($data)
    {
        $this->createDemand($data);
        $this->createDemandControl($data);
        $this->getAgents($data);
        $this->createUpdate();
    }

    private function createDemand($data)
    {
        $activityModel = new Activity;
        $activityName = $activityModel->getActivityById($data['activity'])[0];
        $activityName = $activityName['codigo'];

        if ($activityName != "OKR") {
            $data["okr"] = null;
        }

        $newDemand = array(
            "atividade_id" => $data["activity"],
            "localizacao_id" => $data["location"],
            "sublocalidade_id" => $data["sublocation"],
            "tipo_id" => $data["type"],
            "okr_id" => $data["okr"],
            "observacao" => $data["observation"]
        );

        $demandModel = new Demand;
        $this->new_demand_id = $demandModel->createDemand($newDemand);
    }

    private function createDemandControl($data)
    {
        $urgency = $data['urgency'] == 'TRUE' ? true : false;

        $newDemandControl = array(
            "prioridade" => 1,
            "urgente" => $urgency,
            "atrasado" => false,
            "data_inicio" => $data['start_date'],
            "data_concluido" => null,
            "prazo_conclusao" => null,
            "previsao_inicio" => null,
            "previsao_entrega" => null,
            "dias_iniciar" => 1,
            "dias_concluir" => 2,
            "dias_atrasado" => 3,
            "prazo_dias" => 4,
            "status" => $data['status'],
            "responsavel_id" => (int) $data['responsable'],
            "situacao_id" => 1,
            "demanda_id" => $this->new_demand_id,
        );

        $demandCtrlModel = new DemandControl;

        $this->new_ctrl_demand_id = $demandCtrlModel->createDemandCtrl($newDemandControl);
    }

    private function createCorrespondent($senderAgent, $recipientAgent)
    {
        $newData = array(
            "agente_remetente_id" => $senderAgent,
            "agente_destinatario_id" => $recipientAgent,
            "controle_demanda_id" => $this->new_ctrl_demand_id,
        );

        $correspondentModel = new Correspondent;
        $correspondentModel->createCorrespondent($newData);
    }

    private function getAgents($data)
    {

        foreach ($data as $key => $value) {
            $senderAgent = null;
            $recipientAgent = null;
            if (strpos($key, 'sender-agent') === 0) {
                $senderAgent = $value;
            } else if (strpos($key, 'recipient-agent') === 0) {
                $recipientAgent = $value;
            }
            if ($senderAgent != null || $recipientAgent != null) {
                $this->createCorrespondent($senderAgent, $recipientAgent);
            }
        }
    }


    private function createUpdate()
    {
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_id = $this->getUserByUsername();
        $newData = array(
            "endereco_ip" => $ip_address,
            "usuario_id" => $user_id,
            "controle_demanda_id" => $this->new_ctrl_demand_id,
        );
        $updateModel = new Update;
        $updateModel->createUpdate($newData);
    }

    private function getUserByUsername()
    {
        session_start();
        $username = $_SESSION['username'];
        $userModel = new User;
        return ($userModel->getUser('nome_usuario', $username)[0]['id']);
    }
}
