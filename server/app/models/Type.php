<?php

require_once('../app/core/Model.php');

class Type extends Model
{
    protected $table = 'Tipo';

    public function getType()
    {
        return $this->findAll($this->table);
    }

    public function getTypeById($value, $column = 'id')
    {
        return $this->findByColumn($this->table, $column, $value);
    }
}
