<?php

include "/xampp/htdocs/api/db/config.php";

include "/xampp/htdocs/api/functions/demand_control.php";

header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

header("Access-Control-Allow-Headers: Content-Type, Authorization");

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    if (isset($_GET['id'])) {
      $demandId = $_GET['id'];
      $result = getDemandById($demandId);
    } else {
      $result = getAllDemands();
    }
    echo json_encode($result);
    break;
  case 'POST':
    $data = json_decode(file_get_contents("php://input"), true);

    $requiredKeys = ['area', 'prioridade', 'responsavel', 'demanda', 'sistema', 'sub_sistema', 'tipo', 'detalhamento', 'observacoes', 'data_recebido', 'data_inicio', 'data_final', 'setor_responder', 'prazo_entrega_resposta', 'data_respondido', 'sei_numero', 'numero_documento'];

    $missingKeys = array_diff($requiredKeys, array_keys($data));

    if (!empty($missingKeys)) {
      $result = ['error' => 'Missing values for keys: ' . implode(', ', $missingKeys)];
    } else {
      $result = createDemand($data);
    }
    echo json_encode($result);
    break;
  case 'PUT':
  case 'PATCH':
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['id'])) {
      $demandId = $data['id'];
      $result = updateDemand($demandId, $data);
    } else {
      $result = ['error' => 'Missing demand ID'];
    }
    echo json_encode($result);
    break;
  case 'DELETE':
    $demandId = $_GET['id'];
    if (isset($demandId)) {
      $result = deleteDemand($demandId);
    } else {
      $result = ['error' => 'Missing demand ID'];
    }
    echo json_encode($result);
    break;
}
$pdo = null;