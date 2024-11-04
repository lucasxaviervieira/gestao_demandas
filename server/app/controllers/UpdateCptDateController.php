<?php

// ROUTE TO SEND DATA 
// update correspondent date

require_once('../app/models/Correspondent.php');

require_once('../app/utils/ConstructUrl.php');


class UpdateCptDateController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demandId = $_POST['id'];

            $correspondentModel = new Correspondent;

            $correspondentModel->updateCorrespondentDate($demandId);

            $url = $this->getUrl("/demand?id=$demandId");
            header("Location: $url");
        } else {
            $url = $this->getUrl("/");
            header("Location: $url");
        }
    }
    private function getUrl($path)
    {
        $constructUrlModel = new ConstructUrl($path);
        $url = $constructUrlModel->getUrl();
        return $url;
    }
}
