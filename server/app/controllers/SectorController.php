<?php

// ROUTE TO PAGE
// page: "Setores"

require_once('../app/core/Controller.php');

require_once('../app/models/Sector.php');

require_once('../app/models/DemandControl.php');

class SectorController extends Controller
{
    public function index()
    {
        $sectorId = isset($_GET['id']) ? $_GET['id'] : 1;
        $sectorId = (int) $sectorId;

        $data = $this->getNavbarData();

        $sectors = $this->getSectors();
        $sectors = ['setores' => $sectors];

        $demands = $this->cleanDemands($sectorId);

        $data = array_merge($data, $sectors);
        $data = array_merge($data, $demands);

        $this->view('demands/sectors/index', $data);
    }
    private function getSectors()
    {
        $sectorModel = new Sector;
        $sectors = $sectorModel->quantityBySectors();
        $data = ['setores' => $sectors];
        return $data;
    }
    private function getDemandsBySector($sectorId)
    {
        $demandCtrlModel = new DemandControl;
        $demand = $demandCtrlModel->getDemandCtrlBySector($sectorId);
        $data = ['demandas' => $demand];
        return $data;
    }
    private function cleanDemands($sectorId)
    {
        $data = $this->getDemandsBySector($sectorId);
        $newDemand = [];
        foreach ($data['demandas'] as $demands) {
            $cleanDemands = [];

            foreach ($demands as $key => $value) {
                $cleanDemands[$key] = $value === null ? '-' : $value;
                if (gettype($value) === 'boolean') {
                    $cleanDemands[$key] = $value == false ? 'não' : 'sim';
                }
            }
            $newDemand[] = $cleanDemands;
        }
        $cleanedDemands = ['demandas_limpas' => $newDemand];
        return $cleanedDemands;
    }
}