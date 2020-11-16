<?php namespace App\Models;

use CodeIgniter\Model;

class MemberLevelModel extends Model
{
    protected $table      = 'tb_member_level';
    protected $primaryKey = 'ml_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ml_name', 'ml_min', 'ml_max', 'ml_add_point', 'ml_auto', 'ml_use', 'ml_del', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}