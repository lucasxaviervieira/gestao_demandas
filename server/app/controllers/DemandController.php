<?php

// ROUTE TO PAGE
// page: "Demand"

require_once('../app/core/Controller.php');

require_once('../app/models/DemandControl.php');

require_once('../app/models/Correspondent.php');

require_once('../app/models/SeiProcess.php');

require_once('../app/models/Document.php');

class DemandController extends Controller
{
    protected $control_demand_id;

    public function index()
    {
        $demandId = isset($_GET['id']) ? $_GET['id'] : 1;
        $demandId = (int) $demandId;

        $data = $this->getCommonData();

        $demands = $this->cleanDemand($demandId);

        $correspondents = $this->getCorrespondents($demandId);

        $processes = $this->getSeiProcesses($demandId);

        $documents = $this->getDocuments($demandId);

        $data = array_merge($data, $demands);
        $data = array_merge($data, $correspondents);
        $data = array_merge($data, $processes);
        $data = array_merge($data, $documents);

        $this->view('demands/index/index', $data);
    }

    private function getDemandById($demandId)
    {
        $demandCtrlModel = new DemandControl;
        $demands = $demandCtrlModel->getDemandCtrlById($demandId);
        return ['demanda' => $demands];
    }

    private function cleanDemand($demandId)
    {
        $data = $this->getDemandById($demandId);
        $newDemand = [];
        foreach ($data['demanda'] as $demands) {
            $cleanDemands = [];

            foreach ($demands as $key => $value) {
                $cleanDemands[$key] = $value === null ? '-' : $value;
                if (gettype($value) === 'boolean') {
                    $cleanDemands[$key] = $value == false ? 'não' : 'sim';
                }
            }
            $newDemand[] = $cleanDemands;
        }
        $cleanedDemands = ['demanda_limpa' => $newDemand];
        return $cleanedDemands;
    }

    private function getCorrespondents($demandId)
    {
        $correspondentModel = new Correspondent;
        $correspondents = $correspondentModel->getCorrespondentByCtrlDemandId($demandId);
        return ['correspondentes' => $correspondents];
    }

    private function getSeiProcesses($demandId)
    {
        $processModel = new SeiProcess;
        $processes = $processModel->getSeiProcessByDemand($demandId);
        return ['processos' => $processes];
    }

    private function getDocuments($demandId)
    {
        $documentModel = new Document;
        $documents = $documentModel->getDocumentByDemand($demandId);
        return ['documentos' => $documents];
    }
}
