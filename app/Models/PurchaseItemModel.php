<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseItemModel extends Model
{
    protected $table      = 'tb_in_order_item';
    protected $primaryKey = 'oi_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['oi_kind', 'pd_pid', 'io_pid', 'oi_num', 'oi_name', 'oi_in_price', 'oi_real_in_price', 'oi_real_in_price', 'reg_date', 'oi_qea', 'oi_re_qea', 'reg_id', 'reg_date', 'up_id', 'up_date','oi_del'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}