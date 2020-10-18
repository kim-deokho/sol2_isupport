<?php namespace App\Models;

use CodeIgniter\Model;

class PersubModel extends Model
{
    protected $table      = 'tb_menu_basic_authority';
    protected $primaryKey = 'ba_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['bn_pid', 'mu_pid', 'ba_access', 'ba_save', 'ba_del', 'ba_print', 'ba_excel', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}