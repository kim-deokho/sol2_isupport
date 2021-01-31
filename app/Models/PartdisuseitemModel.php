<?php namespace App\Models;

use CodeIgniter\Model;

class PartdisuseitemModel extends Model
{
    protected $table      = 'tb_part_disuse_item';
    protected $primaryKey = 'di_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ds_pid', 'pt_pid', 'pt_name', 'di_store', 'di_qty', 'di_reason_code', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}