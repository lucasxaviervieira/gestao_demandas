<?php

include "/xampp/htdocs/api/functions/create/utils/utilities.php";


function createDemand($data)
{
    global $pdo;

    $prevStart = startDate($data);
    $data['previsao_inicio'] = $prevStart;

    $prevEnd = deliveryTime($prevStart, $data);
    $data['previsao_entrega'] = $prevEnd;

    $data['situacao'] = switchSituation($data, $prevStart, $prevEnd);

    $data['delta_t_inicio'] = deltaTimeStart($data);
    $data['delta_t_final'] = deltaTimeEnd($data);
    $data['delta_t_atraso'] = deltaTimeDelay($data);
    $data['delta_t_prazo'] = deltaTimeFrame($data);


    $sql = "INSERT INTO Controle_Demandas (
                detalhamento,
                observacoes,
                data_recebido,
                data_inicio,
                data_final,
                previsao_inicio,
                previsao_entrega,
                setor_responder,
                prazo_entrega_resposta,
                data_respondido,
                sei_numero,
                numero_documento,
                delta_t_inicio,
                delta_t_final,
                delta_t_atraso,
                delta_t_prazo,
                area,
                prioridade,
                responsavel,
                demanda,
                sistema,
                sub_sistema,
                tipo,
                situacao
                ) VALUES (
                :detalhamento,
                :observacoes,
                :data_recebido,
                :data_inicio,
                :data_final,
                :previsao_inicio,
                :previsao_entrega,
                :setor_responder,
                :prazo_entrega_resposta,
                :data_respondido,
                :sei_numero,
                :numero_documento,
                :delta_t_inicio,
                :delta_t_final,
                :delta_t_atraso,
                :delta_t_prazo,
                :area,
                :prioridade,
                :responsavel,
                :demanda,
                :sistema,
                :sub_sistema,
                :tipo,
                :situacao
                ) RETURNING id;";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($data);
    $id = $stmt->fetchColumn();

    return ['message' => 'Demand created successfully', 'id' => $id];
}
