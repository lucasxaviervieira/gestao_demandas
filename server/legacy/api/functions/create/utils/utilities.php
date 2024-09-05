<?php

function appendDays($date, $days)
{
    $date = new DateTime($date);

    $date->modify("+$days days");

    return $date->format('Y-m-d');
}

function getResponsable($id)
{
    global $pdo;

    $sql = "SELECT nome FROM Responsavel WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return $stmt->fetchColumn();
}

function getDaysToAdd($id, $field)
{
    global $pdo;

    $sql = "SELECT $field FROM Demanda WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    return (int) $stmt->fetchColumn();
}

function startDate($data)
{
    $responsable = getResponsable($data["responsavel"]);

    if ($responsable) {
        if ($data['data_recebido']) {

            $demandId = $data['demanda'];
            $field = "prev_inicio_dias";
            $days_to_start = getDaysToAdd($demandId, $field);

            if ($days_to_start) {

                return appendDays($data['data_recebido'], $days_to_start);
            } else {
                return null;
            }
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function deliveryTime($prevStart, $data)
{
    if ($prevStart) {

        $demandId = $data['demanda'];
        $field = "prev_entrega";
        $days_to_start = getDaysToAdd($demandId, $field);

        switch ($days_to_start) {
            case 900:
                $data_recebido = new DateTime($data['data_recebido']);
                $day = $data_recebido->format('d');

                if ($day >= 6) {
                    $nextMonth = date('Y-m', strtotime('+1 month', strtotime($data['data_recebido'])));
                    $lastDayOfMonth = date('Y-m-t', strtotime($nextMonth));
                    return $lastDayOfMonth;
                } else {
                    $lastDayOfCurrMonth = date('Y-m-t', strtotime($data['data_recebido']));
                    return $lastDayOfCurrMonth;
                }
            case 901:
                $timeToAppend = 15;
                return appendDays($data['data_recebido'], $timeToAppend);
            default:
                return appendDays($prevStart, $days_to_start);
        }
    } else {
        return null;
    }
}

function switchSituation($data, $prevStart, $prevEnd)
{
    $responsable = getResponsable($data["responsavel"]); # C
    $demand = $data["demanda"]; # D
    $startDate = $data["data_inicio"]; # K
    $endDate = $data["data_final"]; # L
    $predictedStart = $prevStart; # M
    $predictedEnd = $prevEnd; # N
    $deliveryTime = $data["prazo_entrega_resposta"]; # Q
    $answeredDate = $data["data_respondido"]; # R



    $requiredDemands = [1, 2, 4, 5, 6, 10, 11, 14, 15];
    $verifyDemand = in_array($demand, $requiredDemands);

    $matrices = [8, 9];
    $verifyMatrices = in_array($demand, $matrices);

    $today = (new DateTime())->format('Y-m-d');

    if (isset($responsable)) {
        if ($verifyDemand || !isset($deliveryTime)) {
            if (!isset($startDate)) {
                ($today <= $predictedStart) ?
                    // NÃO INICIADO - EM DIA
                    $situation = 9
                    // NÃO INICIADO - EM ATRASO
                    : $situation = 8;
            } else {
                if (isset($endDate)) {
                    (isset($deliveryTime) && $demand == 1) ?
                        $referenceDate = new DateTime($deliveryTime)
                        : $referenceDate = new DateTime($predictedEnd);
                    ($endDate <= $referenceDate->format('Y-m-d')) ?
                        // CONCLUÍDO - EM DIA
                        $situation = 7
                        // CONCLUÍDO - EM ATRASO
                        : $situation = 6;
                } else {
                    ($startDate > $predictedStart || $today > $predictedEnd) ?
                        // ANDAMENTO - EM ATRASO
                        $situation = 4
                        // ANDAMENTO - EM DIA
                        : $situation = 5;
                }
            }
        } else if ($verifyMatrices) {
            if (!isset($answeredDate)) {
                if ($today <= $deliveryTime) {
                    // AGUARDANDO RESPOSTA - EM DIA
                    $situation = 3;
                } else {
                    // AGUARDANDO RESPOSTA - EM ATRASO
                    $situation = 2;
                }
            } else if ($answeredDate <= $deliveryTime) {
                // RESPONDIDO - EM DIA
                $situation = 11;
            } else {
                // RESPONDIDO - EM ATRASO
                $situation = 10;
            }
        } else {
            // NULL
            $situation = 1;
        }
    } else {
        // NULL
        $situation = 1;
    }

    return $situation;


    // 1	"null"
    // 2	"Aguardando Resposta - Em Atraso"
    // 3	"Aguardando Resposta - Em Dia"
    // 4	"Andamento - Em Atraso"
    // 5	"Andamento - Em Dia"
    // 6	"Concluído - Em Atraso"
    // 7	"Concluído - Em Dia"
    // 8	"Não Iniciado - Em Atraso"
    // 9	"Não Iniciado - Em Dia"
    // 10	"Respondido - Em Atraso"
    // 11	"Respondido - Em Dia"
    // 12	"Descontinuado"

    // if ($demand) {
    //     if ($verifyDemand || !isset($deliveryTime)) {
    //         if (!isset($data['data_inicio'])) {
    //             if ($today <= $data['previsao_inicio']) {
    //                 return 9;
    //             } else if ($today >= $data['previsao_inicio']) {
    //                 return 8;
    //             }
    //         } else if (isset($data['data_final'])) {
    //             if ($data['demanda'] == "Análises Ambientais" && isset($data['prazo_entrega_resposta'])) {
    //                 $referenceDate = new DateTime($data['prazo_entrega_resposta']);
    //             } else {
    //                 $referenceDate = new DateTime($data['previsao_entrega']);
    //             }
    //             if ($data['data_final'] <= $referenceDate->format('Y-m-d')) {
    //                 return 7;
    //             } else if ($data['data_final'] > $referenceDate->format('Y-m-d')) {
    //                 return 6;
    //             }
    //         } else if ($data['data_inicio'] > $data['previsao_inicio'] || $today > $data['previsao_entrega']) {
    //             return 4;
    //         } else if ($data['data_inicio'] <= $data['previsao_inicio']) {
    //             return 5;
    //         }
    //     } else if ($verifyMatrices) {
    //         if (!isset($data['data_respondido'])) {
    //             if ($today <= $data['prazo_entrega_resposta']) {
    //                 return 3;
    //             } else {
    //                 return 2;
    //             }
    //         } else {
    //             if ($data['data_respondido'] <= $data['prazo_entrega_resposta']) {
    //                 return 11;
    //             } else {
    //                 return 10;
    //             }
    //         }
    //     } else {
    //         return 1;
    //     }
    // } else {
    //     return 1;
    // }
}

function deltaTime($date_field_1, $date_field_2)
{
    if ($date_field_1 && $date_field_2) {
        $date_1 = new DateTime($date_field_1);
        $date_2 = new DateTime($date_field_2);
        if ($date_1 > $date_2) {
            $interval = $date_1->diff($date_2);

            $delta_time = $interval->format('%a');
            return (int) $delta_time;
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function deltaTimeStart($data)
{
    $date_field_1 = $data['data_inicio'];
    $date_field_2 = $data['data_recebido'];
    return deltaTime($date_field_1, $date_field_2);
}

function deltaTimeEnd($data)
{
    $date_field_1 = $data['data_final'];
    $date_field_2 = $data['data_recebido'];
    return deltaTime($date_field_1, $date_field_2);
}

function deltaTimeDelay($data)
{
    if (isset($data['data_recebido'])) {
        // do another verification if field 'situacao'
        $date_field_1 = $data['data_final'];
        $date_field_2 = $data['previsao_entrega'];
        return deltaTime($date_field_1, $date_field_2);
    } else {
        return null;
    }
}

function deltaTimeFrame($data)
{
    if ($data['prazo_entrega_resposta']) {
        $date1 = new DateTime($data['prazo_entrega_resposta']);
        $date2 = new DateTime();

        $interval = $date1->diff($date2);

        $delta_time = $interval->format('%a');
        return (int) $delta_time;
    } else {
        return null;
    }
}
