<?php namespace App\Models;

use CodeIgniter\Model;

class AssignthumbsModel extends Model
{
    protected $table      = 'tb_as_assign_thumbs';
    protected $primaryKey = 'at_pid';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['aa_pid', 'thumb_img'];

    protected $useTimestamps = false;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $dateFormat  = 'datetime';
}