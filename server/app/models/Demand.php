<?php

require_once('../app/core/Model.php');

class Demand extends Model
{
    protected $table = 'Demanda';

    public function getAllDemandCtrl()
    {
        return $this->findAll($this->table);
    }

    public function createDemand($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (atividade_id, localizacao_id, sublocalidade_id, tipo_id, okr_id, observacao) 
                VALUES (:atividade_id, :localizacao_id, :sublocalidade_id, :tipo_id, :okr_id, :observacao)
                RETURNING id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':atividade_id', $data['atividade_id']);
        $stmt->bindParam(':localizacao_id', $data['localizacao_id']);
        $stmt->bindParam(':sublocalidade_id', $data['sublocalidade_id']);
        $stmt->bindParam(':tipo_id', $data['tipo_id']);
        $stmt->bindParam(':okr_id', $data['okr_id']);
        $stmt->bindParam(':observacao', $data['observacao']);
        if ($stmt->execute()) {
            return $stmt->fetchColumn();
        }
        return false;
    }
}
