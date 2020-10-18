<?php namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    protected $table      = 'tb_company';
    protected $primaryKey = 'com_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['com_name', 'ceo_name', 'corporate_body_no', 'com_no', 'com_business_conditions', 'com_business_type', 'com_tel', 'com_hp', 'com_fax', 'com_email', 'com_post', 'com_addr', 'com_addr2', 'accounting_officer', 'accounting_officer_tel1', 'accounting_officer_tel2', 'accounting_officer_email', 'com_logo', 'com_seal', 'com_memo', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}