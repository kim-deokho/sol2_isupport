<?php namespace App\Models;

use CodeIgniter\Model;

class ChargeModel extends Model
{
    protected $table      = 'tb_delivery_charge';
    protected $primaryKey = 'dc_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['dc_kind', 'dc_name', 'dc_delivery_charge_cnt', 'dc_delivery_charge', 'dc_del', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}