<?php
namespace app\index\model;

class AuxiliaryDetail extends Base
{
    public function getALlWithSort ($where = [], $field = true)
    {
        return $this->field($field)->where($where)->order('sorted')->select();
    }
}