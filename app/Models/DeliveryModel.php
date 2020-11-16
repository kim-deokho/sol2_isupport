<?php namespace App\Models;

use CodeIgniter\Model;

class DeliveryModel extends Model
{
    protected $table      = 'tb_member_delivery';
    protected $primaryKey = 'dy_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mb_pid', 'dy_name', 'dy_tel1', 'dy_tel2', 'dy_post', 'dy_addr', 'dy_addr2', 'dy_basic', 'dy_del', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}