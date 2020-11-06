<?php namespace App\Models;

use CodeIgniter\Model;

class StockCheckItemModel extends Model
{
    protected $table      = 'tb_stock_real_item';
    protected $primaryKey = 'si_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['sr_pid', 'si_store', 'st_kind', 'pd_pid', 'si_qea', 'st_qea', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}