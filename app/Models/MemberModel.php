<?php namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model
{
    protected $table      = 'tb_member';
    protected $primaryKey = 'mb_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mb_name', 'mb_code', 'mb_tel1', 'mb_tel2', 'mb_tel3', 'mb_fm1', 'mb_fm2', 'mb_fm3', 'mn_pid', 'ml_pid', 'mb_last_tel_date', 'mb_post', 'mb_addr', 'mb_addr2', 'mb_in_root', 'mb_email', 'mb_birthday', 'mb_kind', 'ct_pid', 'mb_memo', 'mb_admin_memo', 'mb_info_agree', 'mb_info_agree_date', 'mb_sms_agree', 'mb_sms_agree_date', 'mb_email_agree', 'mb_email_agree_date', 'mb_tel_agree', 'mb_post', 'mb_tel_agree_date', 'mb_dormant', 'mb_dormant_date', 'mb_withdrawal', 'mb_withdrawal_date', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}