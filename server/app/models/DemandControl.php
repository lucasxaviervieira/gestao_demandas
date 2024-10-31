<?php

require_once('../app/core/Model.php');

class DemandControl extends Model
{
    protected $table = 'Controle_Demanda';

    public function getAllDemandCtrl()
    {
        $sql = "SELECT cd.id, u.nome_usuario AS responsavel_demanda, at.nome AS atividade_demanda, l.nome AS localizacao_nome, sl.nome AS sublocalidade_nome, t.nome AS tipo_nome, cd.*, o.codigo AS okr_trimestre_ano FROM Controle_Demanda AS cd JOIN Usuario AS u ON cd.responsavel_id = u.id LEFT JOIN Demanda AS d ON cd.demanda_id = d.id LEFT JOIN Localizacao AS l ON d.localizacao_id = l.id LEFT JOIN Sublocalidade AS sl ON d.sublocalidade_id = sl.id LEFT JOIN Tipo AS t ON d.tipo_id = t.id LEFT JOIN Obj_Res_Cha AS o ON d.okr_id = o.id LEFT JOIN Atividade AS at ON d.atividade_id = at.id ORDER BY cd.data_criado DESC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllDemandCtrlID()
    {
        $table = $this->table;
        $sql = "SELECT id FROM $table;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDemandCtrlById($id)
    {
        $sql = "SELECT cd.id, u.nome_usuario AS responsavel_demanda, at.nome AS atividade_demanda, at.codigo AS atividade_cod, l.nome AS localizacao_nome, sl.nome AS sublocalidade_nome, t.nome AS tipo_nome, cd.*, d.observacao, o.codigo AS okr_trimestre_ano FROM Controle_Demanda AS cd JOIN Usuario AS u ON cd.responsavel_id = u.id LEFT JOIN Demanda AS d ON cd.demanda_id = d.id LEFT JOIN Localizacao AS l ON d.localizacao_id = l.id LEFT JOIN Sublocalidade AS sl ON d.sublocalidade_id = sl.id LEFT JOIN Tipo AS t ON d.tipo_id = t.id LEFT JOIN Obj_Res_Cha AS o ON d.okr_id = o.id LEFT JOIN Atividade AS at ON d.atividade_id = at.id WHERE cd.id = $id ORDER BY cd.data_criado DESC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDemandCtrlByUser($id)
    {
        $sql = "SELECT cd.id, at.nome AS atividade_demanda, l.nome AS localizacao_nome, sl.nome AS sublocalidade_nome, t.nome AS tipo_nome, cd.*, o.codigo AS okr_trimestre_ano FROM Controle_Demanda AS cd JOIN Demanda AS d ON cd.demanda_id = d.id LEFT JOIN Localizacao AS l ON d.localizacao_id = l.id LEFT JOIN Sublocalidade AS sl ON d.sublocalidade_id = sl.id LEFT JOIN Tipo AS t ON d.tipo_id = t.id LEFT JOIN Obj_Res_Cha AS o ON d.okr_id = o.id LEFT JOIN Atividade AS at ON d.atividade_id = at.id WHERE cd.responsavel_id = $id ORDER BY cd.data_criado DESC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDemandCtrlBySector($id)
    {
        $sql = "SELECT cd.id, u.nome_usuario AS responsavel_demanda, at.nome AS atividade_demanda, l.nome AS localizacao_nome, sl.nome AS sublocalidade_nome, t.nome AS tipo_nome, cd.*, o.codigo AS okr_trimestre_ano FROM Controle_Demanda AS cd JOIN Usuario AS u ON cd.responsavel_id = u.id LEFT JOIN Demanda AS d ON cd.demanda_id = d.id LEFT JOIN Localizacao AS l ON d.localizacao_id = l.id LEFT JOIN Sublocalidade AS sl ON d.sublocalidade_id = sl.id LEFT JOIN Tipo AS t ON d.tipo_id = t.id LEFT JOIN Obj_Res_Cha AS o ON d.okr_id = o.id LEFT JOIN Atividade AS at ON d.atividade_id = at.id WHERE u.setor_id = $id ORDER BY cd.data_criado DESC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function putDateOnDemand($id, $field)
    {
        $table = $this->table;
        $sql = "UPDATE $table SET $field = now() WHERE id = $id;";
        $stmt = $this->db->query($sql);
        return $stmt->execute();
    }

    public function putCalcFields($data)
    {
        $table = $this->table;
        $id = $data['id'];
        $situation = $data['situacao'];
        $delayed = $data['atrasado'] ? 'true' : 'false';
        $deltaStart = $data['dias_iniciar'];
        $deltaEnd = $data['dias_concluir'];
        $deltaLate = $data['dias_atrasado'];
        $deltaLimit = $data['prazo_dias'];

        $sql = "UPDATE $table SET situacao = '$situation', atrasado = $delayed, dias_iniciar = $deltaStart, dias_concluir = $deltaEnd, dias_atrasado = $deltaLate, prazo_dias = $deltaLimit WHERE id = $id;";
        $stmt = $this->db->query($sql);
        return $stmt->execute();
    }

    public function createDemandCtrl($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (prioridade, urgente, atrasado, data_inicio, data_concluido, prazo_conclusao, previsao_inicio, previsao_entrega, dias_iniciar, dias_concluir, dias_atrasado, prazo_dias, status, situacao, responsavel_id, demanda_id)
                VALUES (:prioridade, :urgente, :atrasado, :data_inicio, :data_concluido, :prazo_conclusao, :previsao_inicio, :previsao_entrega, :dias_iniciar, :dias_concluir, :dias_atrasado, :prazo_dias, :status, :situacao, :responsavel_id, :demanda_id)
                RETURNING id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':prioridade', $data['prioridade'], PDO::PARAM_INT);
        $stmt->bindValue(':urgente', $data['urgente'], PDO::PARAM_BOOL);
        $stmt->bindValue(':atrasado', $data['atrasado'], PDO::PARAM_BOOL);
        $stmt->bindValue(':data_inicio', $data['data_inicio'], PDO::PARAM_STR);
        $stmt->bindValue(':data_concluido', $data['data_concluido'], PDO::PARAM_STR);
        $stmt->bindValue(':prazo_conclusao', $data['prazo_conclusao'], PDO::PARAM_STR);
        $stmt->bindValue(':previsao_inicio', $data['previsao_inicio'], PDO::PARAM_STR);
        $stmt->bindValue(':previsao_entrega', $data['previsao_entrega'], PDO::PARAM_STR);
        $stmt->bindValue(':dias_iniciar', $data['dias_iniciar'], PDO::PARAM_INT);
        $stmt->bindValue(':dias_concluir', $data['dias_concluir'], PDO::PARAM_INT);
        $stmt->bindValue(':dias_atrasado', $data['dias_atrasado'], PDO::PARAM_INT);
        $stmt->bindValue(':prazo_dias', $data['prazo_dias'], PDO::PARAM_INT);
        $stmt->bindValue(':status', $data['status'], PDO::PARAM_STR);
        $stmt->bindValue(':situacao', $data['situacao'], PDO::PARAM_INT);
        $stmt->bindValue(':responsavel_id', $data['responsavel_id'], PDO::PARAM_INT);
        $stmt->bindValue(':demanda_id', $data['demanda_id'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }
}
