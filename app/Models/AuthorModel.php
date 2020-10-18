<?php namespace App\Models;

use App\Models\BaseModel;

class AuthorModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

    function getManagerAuth($options) {
        $builder = $this->dDB->table('tb_manager');
        $builder->where('mn_id', $options['user_id']);
        $user=$builder->get()->getRowArray();
        $result=$user;
        if($user['mn_id']) {
            if($user['mn_pw']!=$this->sql_password($options['user_pwd'])) {
                $result['err']='비밀번호가 일치하지 않습니다.';
            }
        }
        else $result['err']='존재하지 않는 ID 입니다.';
        return $result;
    }

    function sql_password($value) {
        $sql="select password(".$this->dDB->escape($value).") as pwd";
        $row = $this->dDB->query($sql)->getRowArray();

        return $row['pwd'];
    }
    
}