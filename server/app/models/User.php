<?php

require_once('../app/core/Model.php');

class User extends Model
{
    protected $table = 'Usuario';

    public function getAllUsers()
    {

        $sql = "SELECT u.id, u.nome_usuario, s.sigla AS setor_sigla, s.nome AS setor_nome FROM Usuario AS u, Setor AS s WHERE u.setor_id = s.id ORDER BY s.sigla, u.nome_usuario;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getUser($column, $value)
    {
        return $this->findByColumn($this->table, $column, $value);
    }

    public function createUser($data)
    {
        $table = $this->table;
        $stmt = $this->db->prepare("INSERT INTO $table (nome_usuario, setor_id) VALUES (:username, :sector_id)");
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':sector_id', $data['sector_id']);
        return $stmt->execute();
    }

    public function getMajorUserId()
    {
        $sql = "SELECT u.id FROM Usuario AS u, Setor AS s WHERE u.setor_id = s.id ORDER BY s.sigla, u.nome_usuario FETCH FIRST 1 ROW ONLY;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
