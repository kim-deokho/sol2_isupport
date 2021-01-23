<?php namespace App\Models;

use CodeIgniter\Model;

class AssignpartModel extends Model
{
    protected $table      = 'tb_as_assign_part';
    protected $primaryKey = 'ap_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['aa_pid', 'pt_pid', 'aa_part_name', 'aa_qty', 'aa_unit_price', 'aa_wages', 'aa_price', 'reg_id', 'reg_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = '';
    protected $dateFormat  = 'datetime';
}