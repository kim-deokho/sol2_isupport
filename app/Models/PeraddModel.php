<?php namespace App\Models;

use CodeIgniter\Model;

class PeraddModel extends Model
{
    protected $table      = 'tb_menu_add_authority';
    protected $primaryKey = 'aa_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mn_pid', 'mu_pid', 'aa_access', 'aa_save', 'aa_del', 'aa_print', 'aa_excel', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}