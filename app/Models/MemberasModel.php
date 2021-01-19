<?php namespace App\Models;

use CodeIgniter\Model;

class MemberasModel extends Model
{
    protected $table      = 'tb_member_as';
    protected $primaryKey = 'ma_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mb_pid', 'mc_pid', 'ma_code', 'od_pid', 'ma_no_order', 'ma_order_memo', 'pd_pid', 'ma_serial', 'ma_model', 'ma_part', 'ma_symptom', 'ma_kind', 'ma_cut_name', 'ma_cut_tel', 'ma_cut_tel2', 'ca_post', 'ca_addr', 'ca_addr2', 'ma_is_hurryup', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}