<?php

require_once('../app/core/Model.php');

class ObjKeyRes extends Model
{
    protected $table = 'Obj_Res_Cha';

    public function getObjKeyRes()
    {
        return $this->findAll($this->table);
    }

    public function getObjKeyResById($value, $column = 'id')
    {
        return $this->findByColumn($this->table, $column, $value);
    }
}
