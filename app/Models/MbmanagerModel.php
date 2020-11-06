<?php namespace App\Models;

use App\Models\BaseModel;

class MbmanagerModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

	function getmemberList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_member');
        if($options['select']) $builder->select($options['select'], false);
        if($options['mb_pid']) {
            $builder->where('mb_pid', $options['mb_pid']);
            return $builder->get()->getRowArray();
        }

        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) array_push($OrWhere, $s_k.' like '.$this->dDB->escape('%'.$keyword.'%'));

            $builder->where('('.implode(' or ', $OrWhere).')', null, false);
        }

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'mb_pid';
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

	function getConsultingList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_member_counsel a');
		$builder->select("*");
		$builder->select("(select mn_name from tb_manager where mn_pid = a.reg_id) reg_name");
        if($options['select']) $builder->select($options['select'], false);
        if($options['mc_pid']) {
            $builder->where('mc_pid', $options['mc_pid']);
            return $builder->get()->getRowArray();
        }

		if($options['mb_pid'])  $builder->where('mb_pid', $options['mb_pid']);
		if($options['searchkind1'])  $builder->where('mc_kind1', $options['searchkind1']);
		if($options['searchkind2'])  $builder->where('mc_kind2', $options['searchkind2']);
		if($options['searchkind3'])  $builder->where('mc_kind3', $options['searchkind3']);
		if($options['searchSdate'])  $builder->where('reg_date >=', $options['searchSdate']." 00:00:00");
		if($options['searchEdate'])  $builder->where('reg_date <=', $options['searchEdate']." 23:59:59");
		if($options['searchReg'])  $builder->where('reg_id', $options['searchReg']);



        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) array_push($OrWhere, $s_k.' like '.$this->dDB->escape('%'.$keyword.'%'));

            $builder->where('('.implode(' or ', $OrWhere).')', null, false);
        }

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'mc_pid';
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