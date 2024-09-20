<?php

require_once('../app/core/Model.php');

class DemandControl extends Model
{
    protected $table = 'Controle_Demanda';

    public function getAllDemandCtrl()
    {
        return $this->findAll($this->table);
    }

    public function getDemandCtrl($id, $column = 'id')
    {
        return $this->findByColumn($this->table, $column, $id);
    }
}
