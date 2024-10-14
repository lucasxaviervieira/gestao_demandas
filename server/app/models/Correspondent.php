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
        $sql = "SELECT c.id, ra.tipo AS tipo_remetente, ra.super_id AS remetente_id, da.tipo AS tipo_destinatario, da.super_id AS destinatario_id, c.controle_demanda_id FROM Correspondente AS c LEFT JOIN Agente AS ra ON c.agente_remetente_id = ra.id LEFT JOIN Agente AS da ON c.agente_destinatario_id = da.id WHERE c.controle_demanda_id = $id;";
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
}