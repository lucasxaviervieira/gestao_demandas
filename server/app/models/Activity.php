<?php

require_once('../app/core/Model.php');

class Activity extends Model
{
    protected $table = 'Atividade';

    public function getActivity()
    {
        return $this->findAll($this->table);
    }

    public function getActivityById($value, $column = 'id')
    {
        return $this->findByColumn($this->table, $column, $value);
    }
}