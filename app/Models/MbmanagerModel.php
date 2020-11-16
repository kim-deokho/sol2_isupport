<?php namespace App\Models;

use App\Models\BaseModel;

class MbmanagerModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

	function getMemberList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_member a');
		$builder->select("a.*");
		$builder->select("(select max(od_date) from tb_order where mn_pid = a.mn_pid) mb_last_order_date");
		$builder->select("(select concat(reg_date,'|',mc_kind2) from tb_member_counsel where mn_pid = a.mn_pid order by mc_pid desc limit 0,1) mb_last_tel");
		$builder->select("(select mn_name from tb_manager where mn_pid = a.mn_pid) dam_name");
		$builder->select("(select count(od_order_price) from tb_order where mn_pid = a.mn_pid) mb_order_cnt");
		$builder->select("(select sum(od_order_price) from tb_order where mn_pid = a.mn_pid) mb_order_price");
		$builder->select("(select sum(ap_price) from tb_order_account where mn_pid = a.mn_pid) mb_account_price");
		$builder->select("(select sum(mp_point - mp_use_point) from tb_member_point where mn_pid = a.mn_pid) mb_point");
		$builder->select("(select count(mg_pid) from tb_member_gift where mn_pid = a.mn_pid) mb_gift");
		$builder->select("(select sum(md_balance) from tb_member_deposit where mn_pid = a.mn_pid) mb_deposit");
        if($options['select']) $builder->select($options['select'], false);
        if($options['mb_pid']) {
            $builder->where('mb_pid', $options['mb_pid']);
            return $builder->get()->getRowArray();
        }

		if($options['searchSdate'])  $builder->where('a.reg_date >=', $options['searchSdate']." 00:00:00");
		if($options['searchEdate'])  $builder->where('a.reg_date <=', $options['searchEdate']." 23:59:59");
		if($options['searchLevel'])  $builder->where('a.ml_pid', $options['searchLevel']);
		if($options['searchMn'])  $builder->where('a.mn_pid', $options['searchMn']);
		if($options['searchRoot'])  $builder->where('a.mb_in_root', $options['searchRoot']);
		if($options['searchInfo'])  $builder->where('a.mb_info_agree', $options['searchInfo']);
		if($options['searchSms'])  $builder->where('a.mb_sms_agree', $options['searchSms']);
		if($options['searchMail'])  $builder->where('a.mb_email_agree', $options['searchMail']);
		if($options['searchTel'])  $builder->where('a.mb_tel_agree', $options['searchTel']);

		if($options['searchDormant'] == '')  $builder->where('a.mb_dormant', 'N');
		if($options['searchwithdrawal'] == '')  $builder->where('a.mb_withdrawal', 'N');

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
		$builder->join('tb_member b', 'a.mb_pid = b.mb_pid');
		$builder->select("a.*");
		$builder->select("b.mb_code, b.mb_name");
		$builder->select("(select mn_name from tb_manager where mn_pid = a.reg_id) reg_name");
        if($options['select']) $builder->select($options['select'], false);
        if($options['mc_pid']) {
            $builder->where('mc_pid', $options['mc_pid']);
            return $builder->get()->getRowArray();
        }

		if($options['mb_pid'])  $builder->where('a.mb_pid', $options['mb_pid']);
		if($options['searchkind1'])  $builder->where('a.mc_kind1', $options['searchkind1']);
		if($options['searchkind2'])  $builder->where('a.mc_kind2', $options['searchkind2']);
		if($options['searchkind3'])  $builder->where('a.mc_kind3', $options['searchkind3']);
		if($options['searchSdate'])  $builder->where('a.reg_date >=', $options['searchSdate']." 00:00:00");
		if($options['searchEdate'])  $builder->where('a.reg_date <=', $options['searchEdate']." 23:59:59");
		if($options['searchReg'])  $builder->where('a.reg_id', $options['searchReg']);
		if($options['searchCon'])  $builder->like('a.mc_contents', $options['searchCon']);

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