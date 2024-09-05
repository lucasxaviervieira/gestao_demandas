<?php

function getAllDemands()
{
    global $pdo;
    $sql = "SELECT
            cd.id,
            a.nome AS area,
            p.nome AS prioridade,
            r.nome AS responsavel,
            d.nome AS demanda,
            s.nome AS sistema,
            ss.nome AS sub_sistema,
            t.nome AS tipo,
            cd.detalhamento,
            cd.observacoes,
            cd.data_recebido,
            cd.data_inicio,
            cd.data_final,
            cd.previsao_inicio,
            cd.previsao_entrega,
            sit.nome AS situacao,
            cd.setor_responder,
            cd.prazo_entrega_resposta,
            cd.data_respondido,
            cd.sei_numero,
            cd.numero_documento,
            cd.delta_t_inicio,
            cd.delta_t_final,
            cd.delta_t_atraso,
            cd.delta_t_prazo
            FROM
            Controle_Demandas cd
            INNER JOIN Area a ON cd.area = a.id
            INNER JOIN Prioridade p ON cd.prioridade = p.id
            INNER JOIN Responsavel r ON cd.responsavel = r.id
            INNER JOIN Demanda d ON cd.demanda = d.id
            INNER JOIN Sistema s ON cd.sistema = s.id
            INNER JOIN Sub_Sistema ss ON cd.sub_sistema = ss.id
            INNER JOIN Tipo t ON cd.tipo = t.id
            INNER JOIN Situacao sit ON cd.situacao = sit.id
            ORDER BY id ASC;";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getDemandById($id)
{
    try {
        global $pdo;
        $sql = "SELECT
            cd.id,
            a.nome AS area,
            p.nome AS prioridade,
            r.nome AS responsavel,
            d.nome AS demanda,
            s.nome AS sistema,
            ss.nome AS sub_sistema,
            t.nome AS tipo,
            cd.detalhamento,
            cd.observacoes,
            cd.data_recebido,
            cd.data_inicio,
            cd.data_final,
            cd.previsao_inicio,
            cd.previsao_entrega,
            sit.nome AS situacao,
            cd.setor_responder,
            cd.prazo_entrega_resposta,
            cd.data_respondido,
            cd.sei_numero,
            cd.numero_documento,
            cd.delta_t_inicio,
            cd.delta_t_final,
            cd.delta_t_atraso,
            cd.delta_t_prazo
            FROM
            Controle_Demandas cd
            INNER JOIN Area a ON cd.area = a.id
            INNER JOIN Prioridade p ON cd.prioridade = p.id
            INNER JOIN Responsavel r ON cd.responsavel = r.id
            INNER JOIN Demanda d ON cd.demanda = d.id
            INNER JOIN Sistema s ON cd.sistema = s.id
            INNER JOIN Sub_Sistema ss ON cd.sub_sistema = ss.id
            INNER JOIN Tipo t ON cd.tipo = t.id
            INNER JOIN Situacao sit ON cd.situacao = sit.id
            WHERE cd.id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException) {
        return ['error' => 'Error fetching demand'];
    }
}