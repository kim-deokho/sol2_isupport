<?php namespace App\Models;

use CodeIgniter\Model;

class ProductbomModel extends Model
{
    protected $table      = 'tb_product_bom';
    protected $primaryKey = 'pb_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pd_pid', 'pb_pd_pid', 'pb_cnt', 'pb_out_price','reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}