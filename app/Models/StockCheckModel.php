<?php namespace App\Models;

use CodeIgniter\Model;

class StockCheckModel extends Model
{
    protected $table      = 'tb_stock_real';
    protected $primaryKey = 'sr_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['sr_num', 'sr_store', 'sr_date', 'sr_pd_cate', 'sr_pt_cate', 'sr_mn_pid', 'sr_memo', 'sr_stock_use', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}