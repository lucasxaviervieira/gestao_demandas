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
}
