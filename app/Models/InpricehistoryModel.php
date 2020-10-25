<?php namespace App\Models;

use CodeIgniter\Model;

class InpricehistoryModel extends Model
{
    protected $table      = 'tb_product_inprice_history';
    protected $primaryKey = 'pi_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pd_pid', 'pi_in_price', 'pi_in_date', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}