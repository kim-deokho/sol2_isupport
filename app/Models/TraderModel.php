<?php namespace App\Models;

use CodeIgniter\Model;

class TraderModel extends Model
{
    protected $table      = 'tb_customer';
    protected $primaryKey = 'ct_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ct_code', 'ct_name', 'ct_kind', 'ct_ceo', 'ct_business_conditions', 'ct_business_type', 'ct_tel', 'ct_tel2', 'ct_email', 'ct_fax', 'ct_post', 'ct_addr', 'ct_addr2', 'ct_out_kind', 'ct_use', 'ct_out_date', 'ct_dname', 'ct_dtel', 'ct_dhp', 'ct_demail', 'ct_memo', 'ct_delivery_charge_cnt', 'ct_delivery_charge', 'ct_no', 'reg_id', 'reg_date', 'up_id', 'up_date', 'mn_is_del'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}