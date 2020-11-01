<?php namespace App\Models;

use CodeIgniter\Model;

class BoardModel extends Model
{
    protected $table      = 'tb_board';
    protected $primaryKey = 'bd_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['bs_pid', 'bd_notice', 'bd_title', 'bd_content', 'bd_file1', 'bd_file2', 'bd_org_file1', 'bd_org_file2', 'bd_link', 'bd_del', 'bd_del_date', 'reg_id', 'up_id'];

    protected $useTimestamps = true;
    protected $createdField  = 'reg_date';
    protected $updatedField  = 'up_date';
    protected $dateFormat  = 'datetime';
}