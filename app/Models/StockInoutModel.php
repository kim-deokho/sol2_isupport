<?php namespace App\Models;

use CodeIgniter\Model;

class StockInoutModel extends Model
{
    protected $table      = 'tb_stock_inout';
    protected $primaryKey = 'si_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['oi_pid', 'ct_pid', 'si_kind', 'si_kind2', 'si_p_kind', 'pd_pid', 'si_pd_name', 'si_qea', 'si_store', 'si_memo', 'sm_pid', 'si_date', 'si_del', 'reg_id', 'reg_date', 'up_id', 'up_date', 'si_num'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}