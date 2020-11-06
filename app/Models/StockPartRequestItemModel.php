<?php namespace App\Models;

use CodeIgniter\Model;

class StockPartRequestItemModel extends Model
{
    protected $table      = 'tb_part_inout_item';
    protected $primaryKey = 'ii_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pi_pid', 'pt_pid', 'pt_name', 'ii_qea', 'ii_real_qea', 'ii_del', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}