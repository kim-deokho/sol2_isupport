<?php namespace App\Models;

use CodeIgniter\Model;

class StockMoveModel extends Model
{
    protected $table      = 'tb_stock_move';
    protected $primaryKey = 'sm_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['sm_num', 'sm_p_kind', 'pd_pid', 'ct_pid', 'sm_pd_name', 'sm_qea', 'sm_out_store', 'sm_in_store', 'sm_out_mn_pid', 'sm_out_date', 'sm_in_mn_pid', 'sm_in_date', 'sm_memo', 'sm_del', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}