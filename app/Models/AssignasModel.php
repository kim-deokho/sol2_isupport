<?php namespace App\Models;

use CodeIgniter\Model;

class AssignasModel extends Model
{
    protected $table      = 'tb_as_assign';
    protected $primaryKey = 'aa_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['mb_pid', 'ma_pid', 'mn_pid', 'aa_visit_date', 'aa_visit_time', 'aa_visit_kind', 'aa_visit_memo', 'aa_pay_kind', 'aa_free_year', 'aa_payment_kind', 'aa_payment_name', 'aa_payment_yn', 'aa_bank_acc', 'aa_acount_num', 'aa_travel_price', 'aa_total_price', 'aa_confirm_name', 'aa_confirm_kind', 'aa_confirm_tel', 'aa_confirm_sign', 'aa_state', 'aa_result_state', 'aa_result_code', 'aa_result_reason', 'aa_result_date', 'aa_matching_date', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}