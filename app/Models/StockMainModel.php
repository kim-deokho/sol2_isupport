<?php namespace App\Models;

use CodeIgniter\Model;

class StockMainModel extends Model
{
    protected $table      = 'tb_stock';
    protected $primaryKey = 'st_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['st_store', 'pd_pid', 'st_qea', 'st_kind', 'reg_id', 'up_id', 'up_date','st_del'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}