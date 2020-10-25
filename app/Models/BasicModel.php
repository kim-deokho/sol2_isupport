<?php namespace App\Models;

use App\Models\BaseModel;

class BasicModel extends BaseModel
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

    function getManagerList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_manager');
        if($options['select']) $builder->select($options['select'], false);
        if($options['department']) $builder->where('mn_department', $options['department']);
        if($options['work_status']) {
            if($options['work_status']=='I') $builder->where('mn_out_date is null', null, false);
            else if($options['work_status']=='E') $builder->where('mn_out_date is not null', null, false);
        }
        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) array_push($OrWhere, $s_k.' like '.$this->dDB->escape('%'.$keyword.'%'));
            // debug($options, $OrWhere);
            // exit;
            $builder->where('('.implode(' or ', $OrWhere).')', null, false);
        }
        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'mn_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
            // debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
			return $builder->countAllResults();
		}    
    }

    function getManagerAddPermition($mn_pid) {
        $builder = $this->dDB->table('tb_menu_add_authority');
        $builder->where('mn_pid', $mn_pid);
        $rows = $builder->get()->getResultArray();
        // debug($options, $this->dDB->getLastQuery());
        return $rows;
    }

    function getTraderList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_customer');
        if($options['select']) $builder->select($options['select'], false);
        if($options['ct_kind']) $builder->where('ct_kind', $options['ct_kind']);
        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) array_push($OrWhere, $s_k.' like '.$this->dDB->escape('%'.$keyword.'%'));
            // debug($options, $OrWhere);
            // exit;
            $builder->where('('.implode(' or ', $OrWhere).')', null, false);
        }
        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'ct_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
            // debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
			return $builder->countAllResults();
		}    
    }
    
}