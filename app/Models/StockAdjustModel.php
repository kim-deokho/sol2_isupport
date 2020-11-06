<?php namespace App\Models;

use CodeIgniter\Model;

class StockAdjustModel extends Model
{
    protected $table      = 'tb_stock_adjust';
    protected $primaryKey = 'sa_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 'sa_kind','sa_store', 'sa_p_kind', 'pd_pid', 'sa_qea', 'st_qea', 'sa_memo', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}