<?php namespace App\Models;

use CodeIgniter\Model;

class GiftModel extends Model
{
    protected $table      = 'tb_gift';
    protected $primaryKey = 'gt_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['gt_name', 'gt_dc', 'gt_type', 'gt_limit', 'gt_limit_day', 'gt_use_cnt', 'gt_use', 'gt_del', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}