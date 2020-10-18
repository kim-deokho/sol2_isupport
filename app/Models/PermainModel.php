<?php namespace App\Models;

use CodeIgniter\Model;

class PermainModel extends Model
{
    protected $table      = 'tb_menu_basic_name';
    protected $primaryKey = 'bn_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['bn_name', 'bn_use', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}