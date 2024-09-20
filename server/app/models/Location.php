<?php

require_once('../app/core/Model.php');

class Location extends Model
{
    protected $table = 'Localizacao';

    public function getLocation()
    {
        return $this->findAll($this->table);
    }

    public function getLocationById($value, $column = 'id')
    {
        return $this->findByColumn($this->table, $column, $value);
    }
}