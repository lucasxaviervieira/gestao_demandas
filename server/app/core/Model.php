<?php

require_once('../app/core/Database.php');

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function findAll($table)
    {
        $stmt = $this->db->query("SELECT * FROM $table");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByColumn($table, $column, $value)
    {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE $column = :value");
        $stmt->bindParam(':value', $value, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}