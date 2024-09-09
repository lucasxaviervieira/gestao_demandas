<?php

namespace App\Core;

class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll($table) {
        $stmt = $this->db->query("SELECT * FROM $table");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByColumn($table, $column) {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE column = :column");
        $stmt->bindParam(':column', $column, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}