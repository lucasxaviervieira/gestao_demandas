<?php

function updateDemand($id, $data)
{
    global $pdo;

    $sql = "UPDATE Controle_Demandas SET";

    $updateExpressions = [];

    $allowedColumns = [
        'area', 'prioridade', 'responsavel', 'demanda', 'sistema', 'sub_sistema',
        'tipo', 'detalhamento', 'observacoes', 'data_recebido', 'data_inicio', 'data_final', 'setor_responder',
        'prazo_entrega_resposta', 'data_respondido', 'sei_numero', 'numero_documento'
    ];

    $extraKeys = array_diff(array_keys($data), ['id']);

    if (empty($extraKeys)) {
        return ['error' => 'Missing some keys'];
    }

    foreach ($data as $key => $value) {
        if (in_array($key, $allowedColumns)) {
            $updateExpressions[] = "$key = :$key";
        }
    }

    $sql .= " " . implode(", ", $updateExpressions);

    $sql .= " WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':id', $id);
    foreach ($data as $key => $value) {
        if (in_array($key, $allowedColumns)) {
            $stmt->bindParam(":$key", $data[$key]);
        }
    }

    $stmt->execute();

    return ['message' => 'Demand updated successfully'];
}