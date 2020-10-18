<?php namespace App\Models;

use CodeIgniter\Model;

class ManagerModel extends Model
{
    protected $table      = 'tb_manager';
    protected $primaryKey = 'mn_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mn_no', 'mn_id', 'mn_pw', 'mn_name', 'mn_department', 'mn_position', 'mn_duty', 'mn_work', 'bn_pid', 'mn_in_date', 'mn_out_date', 'mn_tel', 'mn_hp', 'mn_email', 'mn_com_tel', 'mn_add', 'mn_post', 'mn_addr', 'mn_addr2', 'mn_memo', 'reg_id', 'reg_date', 'up_id', 'up_date', 'mn_is_del'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}