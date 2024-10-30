<?php

require_once('../app/core/Model.php');

class DailyAccess extends Model
{
    protected $table = 'Acesso_Diario';

    public function getAllDailyAccesses()
    {
        return $this->findAll($this->table);
    }

    public function getLastDailyAccess()
    {
        $table = $this->table;
        $sql = "SELECT data_hora_acessado FROM $table ORDER BY data_hora_acessado DESC LIMIT 1";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function createDailyAccess()
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (data_hora_acessado) VALUES (default)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute();
    }
}
