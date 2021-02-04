<?php namespace App\Models;

use CodeIgniter\Model;

class StockPartRequestModel extends Model
{
    protected $table      = 'tb_part_inout';
    protected $primaryKey = 'pi_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['pi_kind', 'pi_store', 'pi_memo', 'pi_mn_pid', 'pi_del', 'pi_state', 'pi_confirm_date', 'pi_result_confirm_yn', 'reg_id', 'reg_date', 'up_id', 'up_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}