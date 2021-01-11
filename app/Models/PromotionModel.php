<?php namespace App\Models;

use CodeIgniter\Model;

class PromotionModel extends Model
{
    protected $table      = 'tb_promotion';
    protected $primaryKey = 'pm_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pm_kind', 'pm_use', 'pm_name', 'pm_limit', 'pm_limit_sdate', 'pm_limit_stime', 'pm_limit_edate', 'pm_limit_etime', 'pm_standard', 'pm_standard_min', 'pm_standard_max', 'pm_standard_kind', 'pm_standard_mem', 'pm_standard_list', 'pm_dc_kind', 'pm_dc', 'pm_gift', 'pm_mem_kind', 'pm_mem_list', 'pm_order', 'pm_over', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}