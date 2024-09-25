<?php

require_once('../app/core/Model.php');

class Agent extends Model
{
    protected $table = 'Agente';

    public function getAllAgents()
    {
        return $this->findAll($this->table);
    }

    public function getAgent($column, $value)
    {
        return $this->findByColumn($this->table, $column, $value);
    }

    public function getInternalAgent()
    {
        $table = $this->table;
        $sql = "SELECT a.id, a.tipo, s.sigla FROM $table AS a, Setor AS s 
                WHERE a.super_id = s.id AND a.tipo = 'INTERNO';";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getExternalAgent()
    {
        $table = $this->table;
        $sql = "SELECT a.id, a.tipo, e.sigla FROM $table AS a, Entidade_Externa AS e
                WHERE a.super_id = e.id AND a.tipo = 'EXTERNO';";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createAgent($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (?) 
                VALUES (:?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':?', $data['?']);
        return $stmt->execute();
    }
}
