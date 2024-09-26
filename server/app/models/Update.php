<?php

require_once('../app/core/Model.php');

class Update extends Model
{
    protected $table = 'Atualizacao';

    public function getAllUpdates()
    {
        return $this->findAll($this->table);
    }

    public function getUpdate($column, $value)
    {
        return $this->findByColumn($this->table, $column, $value);
    }

    public function getLastUpdate()
    {
        $table = $this->table;
        $stmt = $this->db->prepare("SELECT data_atualizacao FROM $table ORDER BY data_atualizacao DESC LIMIT 1");
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function createUpdate($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (endereco_ip, usuario_id, controle_demanda_id)
                VALUES (:endereco_ip, :usuario_id, :controle_demanda_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':endereco_ip', $data['endereco_ip']);
        $stmt->bindParam(':usuario_id', $data['usuario_id']);
        $stmt->bindParam(':controle_demanda_id', $data['controle_demanda_id']);
        return $stmt->execute();
    }
}
