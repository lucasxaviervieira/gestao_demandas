<?php

require_once('../app/core/Model.php');

class Document extends Model
{
    protected $table = 'Documento';

    public function getDocument()
    {
        return $this->findAll($this->table);
    }

    public function getDocumentByDemand($value, $column = 'demanda_id')
    {
        return $this->findByColumn($this->table, $column, $value);
    }

    public function createDocument($data)
    {
        $table = $this->table;
        $sql = "INSERT INTO $table (referencia, descricao, demanda_id)
                VALUES (:referencia, :descricao, :demanda_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':referencia', $data['referencia']);
        $stmt->bindParam(':descricao', $data['descricao']);
        $stmt->bindParam(':demanda_id', $data['demanda_id']);
        return $stmt->execute();
    }
}
