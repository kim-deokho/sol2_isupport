<?php namespace App\Models;

use CodeIgniter\Model;

class PartdisuseModel extends Model
{
    protected $table      = 'tb_part_disuse';
    protected $primaryKey = 'ds_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['aa_pid', 'ds_date', 'ds_memo', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}