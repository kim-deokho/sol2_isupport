<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'tb_product';
    protected $primaryKey = 'pd_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pc_pid1', 'pc_pid2', 'pc_pid3', 'pd_code', 'pd_name', 'pd_kind', 'pd_in_price', 'pd_out_price', 'pd_tax', 'pd_use', 'ct_pid', 'pd_unit', 'pd_barcode', 'pd_img', 'pd_bom', 'pd_dely_type', 'pd_sdate', 'pd_edate', 'pd_delivery_kind', 'pd_delivery_charge', 'pd_bigo', 'reg_id', 'reg_date', 'up_id', 'up_date', 'mn_is_del'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}