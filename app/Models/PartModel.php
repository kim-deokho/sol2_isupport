<?php namespace App\Models;

use CodeIgniter\Model;

class PartModel extends Model
{
    protected $table      = 'tb_part';
    protected $primaryKey = 'pt_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pt_tc_pid1', 'pt_tc_pid2', 'pt_code', 'pt_name', 'pt_tc_code', 'pt_in_price', 'pt_out_price', 'pt_wages', 'ct_pid', 'pt_use', 'pt_bigo', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}