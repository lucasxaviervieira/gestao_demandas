<?php

require_once('../app/core/Model.php');

class DemandControl extends Model
{
    protected $table = 'Controle_Demanda';

    public function getAllDemandCtrl()
    {
        return $this->findAll($this->table);
    }

    public function getDemandCtrlByUser($id)
    {
        $sql = "SELECT cd.id, s.descricao AS situacao, at.nome AS atividade_demanda, cd.status, cd.prioridade, cd.urgente, cd.atrasado, cd.data_criado, cd.data_inicio ,cd.data_concluido, cd.prazo_conclusao, cd.previsao_inicio, cd.previsao_entrega, cd.dias_iniciar, cd.dias_concluir, cd.dias_atrasado, cd.prazo_dias FROM Controle_Demanda AS cd JOIN Situacao AS s ON cd.situacao_id = s.id LEFT JOIN Demanda AS d ON cd.demanda_id = d.id LEFT JOIN Atividade AS at ON d.atividade_id = at.id WHERE cd.responsavel_id = $id;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createDemandCtrl($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (prioridade, urgente, atrasado, data_inicio, data_concluido, prazo_conclusao, previsao_inicio, previsao_entrega, dias_iniciar, dias_concluir, dias_atrasado, prazo_dias, status, responsavel_id, situacao_id, demanda_id)
                VALUES (:prioridade, :urgente, :atrasado, :data_inicio, :data_concluido, :prazo_conclusao, :previsao_inicio, :previsao_entrega, :dias_iniciar, :dias_concluir, :dias_atrasado, :prazo_dias, :status, :responsavel_id, :situacao_id, :demanda_id)
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
        $stmt->bindValue(':responsavel_id', $data['responsavel_id'], PDO::PARAM_INT);
        $stmt->bindValue(':situacao_id', $data['situacao_id'], PDO::PARAM_INT);
        $stmt->bindValue(':demanda_id', $data['demanda_id'], PDO::PARAM_INT);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }
}
