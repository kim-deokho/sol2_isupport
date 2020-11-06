<?php namespace App\Models;

use CodeIgniter\Model;

class Counselmodel extends Model
{
    protected $table      = 'tb_member_counsel';
    protected $primaryKey = 'mc_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mb_pid', 'mc_code', 'mc_tel', 'mc_kind1', 'mc_kind2', 'mc_kind3', 'mc_contents', 'mc_file', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}