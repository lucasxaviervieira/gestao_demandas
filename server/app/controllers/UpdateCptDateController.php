<?php

// ROUTE TO SEND DATA 
// update correspondent date

require_once('../app/models/Correspondent.php');


class UpdateCptDateController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $demandId = $_POST['id'];

            $correspondentModel = new Correspondent;

            $correspondentModel->updateCorrespondentDate($demandId);

            header("Location: http://gestaodemanda/demand?id=$demandId");
        } else {
            header("Location: http://gestaodemanda/");
        }
    }
}