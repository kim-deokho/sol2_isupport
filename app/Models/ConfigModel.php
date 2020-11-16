<?php namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
    protected $table      = 'tb_config';
    protected $primaryKey = 'cf_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['cf_dc_kind', 'cf_cd_order', 'cf_over_use', 'cf_point_basic', 'cf_point_use_price', 'cf_point_min_price', 'cf_point_cut', 'cf_point_del', 'cf_point_del_day', 'cf_delivery_charge_kind', 'cf_delivery_charge_basic', 'cf_delivery_type', 'cf_order_deposit_use', 'cf_exchange_deposit_use', 'cf_order_approval_use', 'cf_exchange_approval_use', 'cf_order_admin_use', 'cf_delivery_date', 'cf_ml_period', 'cf_ml_period_month', 'cf_ml_auto_month', 'cf_ml_auto_day', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}