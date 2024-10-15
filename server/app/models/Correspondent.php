<?php

require_once('../app/core/Model.php');

class Correspondent extends Model
{
    protected $table = 'Correspondente';

    public function getAllCorrespondents()
    {
        return $this->findAll($this->table);
    }

    public function getCorrespondent($column, $value)
    {
        return $this->findByColumn($this->table, $column, $value);
    }

    public function getCorrespondentByCtrlDemandId($id)
    {
        $sql = "SELECT c.id, COALESCE(r_s.sigla, r_ent.sigla) AS remetente_sigla, COALESCE(d_s.sigla, d_ent.sigla) AS destinatario_sigla, c.data_respondido, c.controle_demanda_id FROM Correspondente AS c LEFT JOIN Agente AS ra ON c.agente_remetente_id = ra.id LEFT JOIN Agente AS da ON c.agente_destinatario_id = da.id LEFT JOIN Setor r_s ON ra.super_id = r_s.id AND ra.tipo = 'INTERNO' LEFT JOIN Entidade_Externa r_ent ON ra.super_id = r_ent.id AND ra.tipo = 'EXTERNO' LEFT JOIN Setor d_s ON da.super_id = d_s.id AND da.tipo = 'INTERNO' LEFT JOIN Entidade_Externa d_ent ON da.super_id = d_ent.id AND da.tipo = 'EXTERNO' WHERE c.controle_demanda_id = $id;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createCorrespondent($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (agente_remetente_id, agente_destinatario_id, controle_demanda_id) 
                VALUES (:agente_remetente_id, :agente_destinatario_id, :controle_demanda_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':agente_remetente_id', $data['agente_remetente_id']);
        $stmt->bindParam(':agente_destinatario_id', $data['agente_destinatario_id']);
        $stmt->bindParam(':controle_demanda_id', $data['controle_demanda_id']);
        return $stmt->execute();
    }
    public function updateCorrespondentDate($id)
    {
        $table = $this->table;
        $sql = "UPDATE $table SET data_respondido = now() WHERE controle_demanda_id = $id;";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }
}
