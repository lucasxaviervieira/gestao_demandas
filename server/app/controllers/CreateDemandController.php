<?php

// ROUTE TO SEND DATA 
// create a new demand

// models
require_once('../app/models/Demand.php');

require_once('../app/models/Activity.php');

require_once('../app/models/DemandControl.php');

require_once('../app/models/Update.php');

require_once('../app/models/User.php');

require_once('../app/models/Correspondent.php');

require_once('../app/models/SeiProcess.php');

require_once('../app/models/Document.php');

// utils
require_once('../app/utils/PredictedDates.php');

require_once('../app/utils/DeltaDays.php');

class CreateDemandController
{

    protected $new_demand_id = null;
    protected $new_ctrl_demand_id = null;
    protected $grouped_pairs = null;

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->create($_POST);
                header('Location: http://gestaodemanda/create');
            } catch (Exception) {
                echo "A server error occurred. Please contact the administrator.";
            }
        } else {
            header('Location: http://gestaodemanda/');
        }
    }
    private function create($data)
    {
        $this->createDemand($data);
        $this->createDemandControl($data);

        $this->grouped_pairs = $this->getPairs($data);
        $this->loopOnPair('AGENT');
        $this->loopOnPair('SEI_PROCESS');
        $this->loopOnPair('DOCUMENT');

        $this->createUpdate();
    }

    private function nullifyField($field, $equal = "")
    {
        return $field == $equal ? null : $field;
    }

    private function getActivityCode($activity)
    {
        $activityModel = new Activity;
        $activity = $activityModel->getActivityById($activity)[0];
        return $activity['codigo'];
    }

    private function createDemand($data)
    {
        $activityCode = $this->getActivityCode($data['activity']);
        $okr = $activityCode == "OKR" ? $data['okr'] : null;

        $location = $this->nullifyField($data['location']);
        $sublocation = $this->nullifyField($data['sublocation']);
        $type = $this->nullifyField($data['type']);

        $newDemand = array(
            "atividade_id" => $data["activity"],
            "localizacao_id" => $location,
            "sublocalidade_id" => $sublocation,
            "tipo_id" => $type,
            "okr_id" => $okr,
            "observacao" => $data["observation"]
        );
        $demandModel = new Demand;
        $this->new_demand_id = $demandModel->createDemand($newDemand);
    }


    private function getFormulas($activity, $completionDateLimit)
    {
        // PredictedDates
        $predictedDaysModel = new PredictedDates;

        $activityCode = $this->getActivityCode($activity);

        $predictedStart = $predictedDaysModel->dateToStart($activityCode);
        $predictedEnd = $predictedDaysModel->dateToEnd($predictedStart, $activityCode);

        // DeltaDays
        $deltaDays = new DeltaDays();

        $currentDate = new DateTime();

        $deltaStart = $deltaDays->daysToStart($currentDate, null);
        $deltaEnd = $deltaDays->daysToFinish(null, null);
        $deltaLate = $deltaDays->daysLate($predictedEnd, null);
        $deltaLimit = $deltaDays->daysLimit($completionDateLimit, null);

        return array(
            "previsao_inicio" => $predictedStart,
            "previsao_entrega" => $predictedEnd,
            "dias_iniciar" => $deltaStart,
            "dias_concluir" => $deltaEnd,
            "dias_atrasado" => $deltaLate,
            "prazo_dias" => $deltaLimit,
        );
    }

    private function createDemandControl($data)
    {
        $urgency = $data['urgency'] == 'TRUE' ? true : false;

        $completionDateLimit = $this->nullifyField($data['completion-date-limit']);

        $activity = $data['activity'];

        $formulas = $this->getFormulas($activity, $completionDateLimit);

        $newDemandControl = array(
            "urgente" => $urgency,
            "prazo_conclusao" => $completionDateLimit,
            "status" => "ATIVO",
            "atrasado" => false,
            "data_inicio" => null,
            "data_concluido" => null,
            "previsao_inicio" => $formulas["previsao_inicio"], // FORMULA
            "previsao_entrega" => $formulas["previsao_entrega"], // FORMULA
            "dias_iniciar" => $formulas["dias_iniciar"], // FORMULA
            "dias_concluir" => $formulas["dias_concluir"], // FORMULA
            "dias_atrasado" => $formulas["dias_atrasado"], // FORMULA
            "prazo_dias" => $formulas["prazo_dias"], // FORMULA
            "prioridade" => 1, // FORMULA
            "situacao_id" => 1, // FORMULA
            "responsavel_id" => (int) $data['responsable'],
            "demanda_id" => $this->new_demand_id,
        );

        $demandCtrlModel = new DemandControl;

        $this->new_ctrl_demand_id = $demandCtrlModel->createDemandCtrl($newDemandControl);
    }

    private function createCorrespondent($senderAgent, $recipientAgent)
    {
        $sender = $this->nullifyField($senderAgent);
        $recipient = $this->nullifyField($recipientAgent);

        $newData = array(
            "agente_remetente_id" => $sender,
            "agente_destinatario_id" => $recipient,
            "controle_demanda_id" => $this->new_ctrl_demand_id,
        );
        $correspondentModel = new Correspondent;
        $correspondentModel->createCorrespondent($newData);
    }

    private function createSeiProcess($seiProcess, $processDescription)
    {
        $newProcess = array(
            "referencia" => $seiProcess,
            "descricao" => $processDescription,
            "demanda_id" => $this->new_demand_id
        );
        $processModel = new SeiProcess;
        $processModel->createSeiProcess($newProcess);
    }

    private function createDocument($document, $documentDescription)
    {
        $newDocument = array(
            "referencia" => $document,
            "descricao" => $documentDescription,
            "demanda_id" => $this->new_demand_id
        );
        $documentModel = new Document;
        $documentModel->createDocument($newDocument);
    }

    private function loopOnPair($case)
    {
        switch ($case) {
            case 'AGENT':
                $firstValue = 'sender-agent';
                $secondValue = 'recipient-agent';
                break;
            case 'SEI_PROCESS':
                $firstValue = 'sei-process';
                $secondValue = 'process-description';
                break;
            case 'DOCUMENT':
                $firstValue = 'document';
                $secondValue = 'document-description';
                break;
        }

        foreach ($this->grouped_pairs as $group) {
            $first = $group[$firstValue];
            $second = $group[$secondValue];
            if (isset($first) && isset($second)) {
                $this->chooseFunction($first, $second, $case);
            }
        }
    }

    private function chooseFunction($first, $second, $case)
    {
        switch ($case) {
            case 'AGENT':
                $this->createCorrespondent($first, $second);
                break;
            case 'SEI_PROCESS':
                $this->createSeiProcess($first, $second);
                break;
            case 'DOCUMENT':
                $this->createDocument($first, $second);
                break;
        }
    }

    private function getPairs($data)
    {

        $patterns = ['sender-agent', 'recipient-agent', 'sei-process', 'process-description', 'document', 'document-description'];

        $grouped_data = [];

        foreach ($data as $key => $value) {
            foreach ($patterns as $pattern) {
                if (preg_match('/^(' . preg_quote($pattern) . ')_(\d+)$/', $key, $matches)) {
                    $type = $matches[1];
                    $index = $matches[2];

                    if (!isset($grouped_data[$index])) {
                        $grouped_data[$index] = [];
                    }

                    $grouped_data[$index][$type] = $value;
                }
            }
        }
        return $grouped_data;
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
