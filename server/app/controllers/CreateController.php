<?php

// ROUTE TO PAGE
// page: "Criar Demanda"

require_once('../app/core/Controller.php');

require_once('../app/models/User.php');

require_once('../app/models/Activity.php');

require_once('../app/models/Location.php');

require_once('../app/models/Sublocation.php');

require_once('../app/models/Type.php');

require_once('../app/models/ObjKeyRes.php');

require_once('../app/models/Agent.php');


class CreateController extends Controller
{
    public function index()
    {
        $data = $this->getCommonData();

        $users = $this->getUsers();

        $situations = $this->getAllActivity();

        $locations = $this->getAllLocation();

        $sublocations = $this->getAllSublocation();

        $types = $this->getAllType();

        $okr = $this->getAllObjKeyRes();

        $agents = $this->getAllAgents();

        $data = array_merge($data, $users);
        $data = array_merge($data, $situations);
        $data = array_merge($data, $locations);
        $data = array_merge($data, $sublocations);
        $data = array_merge($data, $types);
        $data = array_merge($data, $okr);
        $data = array_merge($data, $agents);

        $this->view('demands/create/index', $data);
    }

    private function getUsers()
    {
        $userModel = new User;
        $users = $userModel->getAllUsers();
        $data = ['usuarios' => $users];
        return $data;
    }

    private function getAllActivity()
    {
        $activityModel = new Activity;
        $activities = $activityModel->getActivity();
        $data = ['atividades' => $activities];
        return $data;
    }

    private function getAllLocation()
    {
        $locationModel = new Location;
        $locations = $locationModel->getLocation();
        $data = ['localizacacoes' => $locations];
        return $data;
    }

    private function getAllSublocation()
    {
        $sublocationModel = new Sublocation;
        $sublocations = $sublocationModel->getSublocation();
        $data = ['sublocalidades' => $sublocations];
        return $data;
    }

    private function getAllType()
    {
        $typeModel = new Type;
        $types = $typeModel->getType();
        $data = ['tipos' => $types];
        return $data;
    }

    private function getAllObjKeyRes()
    {
        $okrModel = new ObjKeyRes;
        $okr = $okrModel->getObjKeyRes();
        $data = ['okr' => $okr];
        return $data;
    }

    private function getAllAgents()
    {
        $agentModel = new Agent;
        $internalAgents = $agentModel->getInternalAgent();
        $externalAgents = $agentModel->getExternalAgent();

        $data = ['agentes' => ["interno" => $internalAgents, "externo" => $externalAgents]];
        return $data;
    }
}
