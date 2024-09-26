<?php

require_once('../app/core/Model.php');

class Sublocation extends Model
{
    protected $table = 'Sublocalidade';

    public function getSublocation()
    {
        return $this->findAll($this->table);
    }

    public function getSublocationById($value, $column = 'id')
    {
        return $this->findByColumn($this->table, $column, $value);
    }
}
