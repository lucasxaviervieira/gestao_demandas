<?php

require_once('../app/core/Model.php');

class User extends Model
{
    protected $table = 'Usuario';

    public function getAllUsers()
    {
        return $this->findAll($this->table);
    }

    public function getUserById($id)
    {
        return $this->findByColumn($this->table, 'id', $id);
    }

    public function createUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO Usuario (nome_usuario, setor_id) VALUES (:username, :sector_id)");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':sector_id', $data['sector_id']);
        return $stmt->execute();
    }
}
