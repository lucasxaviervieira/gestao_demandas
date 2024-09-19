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

    public function createUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO Usuario (nome_usuario, setor_id) VALUES (:username, :sector_id)");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':sector_id', $data['sector_id']);
        return $stmt->execute();
    }
}