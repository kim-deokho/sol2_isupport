<?php namespace App\Models;

use CodeIgniter\Model;

class PurchaseCancelModel extends Model
{
    protected $table      = 'tb_in_order_item_cancle';
    protected $primaryKey = 'oic_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['oi_pid', 'pd_pid', 'oic_pd_name', 'oic_qea', 'oic_reson', 'reg_date', 'reg_id', 'up_id', 'up_date','oic_del'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}