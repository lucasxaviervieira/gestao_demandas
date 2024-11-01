<?php

require_once('../app/models/Update.php');

require_once('../app/models/Sector.php');

require_once('../app/models/User.php');

require_once('../app/models/DailyAccess.php');

require_once('../app/utils/Routine.php');

class Controller
{
    public function __construct($page = null)
    {
        $this->firstAccessOnDay();
        $isConn = $this->authHelper();
        $this->changePage($isConn, $page);
    }

    public function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            extract($data);

            require_once $viewPath;
        } else {
            throw new \Exception("View {$view} not found.");
        }
    }

    public function getCommonData()
    {
        $username = $_SESSION['username'];
        $sector = $this->getSectorByUsername($username);

        $lastUpdate = new DateTime($this->getLastUpt());
        $lastUptTime = $lastUpdate->format('H:i:s');
        $lastUptDate = $lastUpdate->format('d/m/Y');

        $sectorId = $this->getMajorSector();
        $userId = $this->getMajorUser();

        $data = ['username' => $username, 'sector' => $sector, 'last_update' => ['time' => $lastUptTime, 'date' => $lastUptDate], 'sectorId' => $sectorId, 'userId' => $userId];
        return $data;
    }
    private function getLastUpt()
    {
        $updateModel = new Update;
        $lastUpdate = $updateModel->getLastUpdate();
        $lastUpdate = $lastUpdate['data_atualizacao'];
        return $lastUpdate;
    }
    private function getMajorSector()
    {
        $sectorModel = new Sector;
        $majorSector = $sectorModel->getMajorSectorId();
        return $majorSector;
    }

    private function getMajorUser()
    {
        $userModel = new User;
        $majorUser = $userModel->getMajorUserId();
        return $majorUser;
    }

    private function getSectorByUsername($username)
    {
        $userModel = new User;
        $user = $userModel->getUser('nome_usuario', $username);
        $sectorId = $user[0]['setor_id'];

        $sectorModel = new Sector;
        $sector = $sectorModel->getSectorByColumn('id', $sectorId);
        return $sector[0]['sigla'];
    }

    private function authHelper()
    {
        session_start();
        $isConnected = (isset($_SESSION['username'])) ?  'LOGGED' : 'NOT_LOGGED';
        return $isConnected;
    }

    private function changePage($conn, $page = null)
    {
        if ($page == 'LOGIN') {
            if ($conn == 'LOGGED') {
                header("Location: http://gestaodemanda/home");
            }
        } else {
            if ($conn == 'NOT_LOGGED') {
                header("Location: http://gestaodemanda/");
            }
        }
    }

    private function firstAccessOnDay()
    {
        $currentDate = date('Y-m-d');

        $dailyAccessModel = new DailyAccess;

        $lastAccess = $dailyAccessModel->getLastDailyAccess()[0]['data_hora_acessado'];
        $lastAccess = date('Y-m-d', strtotime($lastAccess));

        if ($currentDate != $lastAccess) {
            $dailyAccessModel->createDailyAccess();
            $routineModel = new Routine;
            $routineModel->dailyUpdate();
        }
    }
}