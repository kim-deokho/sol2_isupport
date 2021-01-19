<?php namespace App\Models;

use CodeIgniter\Model;

class AshistoryModel extends Model
{
    protected $table      = 'tb_as_history';
    protected $primaryKey = 'seq';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['aa_pid', 'tah_state', 'tah_detail', 'tah_memo', 'reg_id', 'reg_date'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = '';
    protected $dateFormat  = 'datetime';
}