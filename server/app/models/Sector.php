<?php

require_once('../app/core/Model.php');

class Sector extends Model
{
    protected $table = 'Setor';

    public function getAllSectors()
    {
        return $this->findAll($this->table);
    }

    public function getSectorByColumn($column, $value)
    {
        return $this->findByColumn($this->table, $column, $value);
    }

    public function quantityBySectors()
    {
        $sql = "SELECT s.id, s.sigla, count(1) as quantidade FROM Controle_Demanda AS cd JOIN Usuario AS u ON u.id = cd.responsavel_id LEFT JOIN Setor AS s ON s.id = u.setor_id GROUP BY s.id, s.sigla ORDER BY quantidade DESC;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getMajorSectorId()
    {
        $sql = "SELECT s.id FROM Controle_Demanda AS cd JOIN Usuario AS u ON u.id = cd.responsavel_id LEFT JOIN Setor AS s ON s.id = u.setor_id GROUP BY s.id, s.sigla ORDER BY count(1) DESC FETCH FIRST 1 ROW ONLY;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
