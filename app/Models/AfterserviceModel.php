<?php namespace App\Models;

use App\Models\BaseModel;

class AfterserviceModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

    function getAfterserviceList(array $options=array()) {
        if($options['page']>0) $querySelect = '*';
        else $querySelect = 'count(*) cnt';
        $sql='
            select '.$querySelect.' from (
                select
                    t1.*, 
                    ma_code, od_pid, ma_no_order, ma_order_memo, ma_serial, ma_model, ma_part, ma_symptom, ma_kind, ma_cut_name, ma_cut_tel, ma_cut_tel2, ca_post, ca_addr, ca_addr2, ma_is_hurryup, t2.reg_id as cs_manager_id, t2.pd_pid,
                    (select pd_name from tb_product where pd_pid=t2.pd_pid) product_name,  
                    (select mn_name from tb_manager where mn_pid=t2.reg_id) cs_manager_name,
                    (select mn_name from tb_manager where mn_pid=t1.mn_pid) as_manager_name,
                    (select mb_code from tb_member where mb_pid=t2.mb_pid) mb_code,
                    (select mb_name from tb_member where mb_pid=t2.mb_pid) mb_name,
                    (select mb_tel1 from tb_member where mb_pid=t2.mb_pid) mb_tel1,
                    (select mb_tel2 from tb_member where mb_pid=t2.mb_pid) mb_tel2,
                    (select mb_tel3 from tb_member where mb_pid=t2.mb_pid) mb_tel3,
                    IF((select count(*) from tb_as_assign_part where aa_pid=t1.aa_pid) > 0, "Y", "N") assign_part_yn,
                    IF((select count(*) from tb_part_disuse where aa_pid=t1.aa_pid) > 0, "Y", "N") disposal_yn,
                    t2.reg_date as request_date, 
                    t3.mc_pid, mc_contents
                from
                    tb_as_assign t1 left join tb_member_as t2 on t1.ma_pid=t2.ma_pid left join tb_member_counsel t3 on t2.mc_pid=t3.mc_pid
            ) TA
        ';
        $sqlWheres=array();
        if($options['sdate']) $sqlWheres[] = 'left('.$options['date_type'].', 10)>='.$this->dDB->escape($options['sdate']);
        if($options['edate']) $sqlWheres[] = 'left('.$options['date_type'].', 10)<='.$this->dDB->escape($options['edate']);
        if($options['search_state']) $sqlWheres[] = 'aa_state='.$this->dDB->escape($options['search_state']);
        if($options['search_result_state']) $sqlWheres[] = 'aa_result_state='.$this->dDB->escape($options['search_result_state']);
        if($options['is_hurryup']) $sqlWheres[ ]='ma_is_hurryup='.$this->dDB->escape($options['is_hurryup']);
        if($options['search_cs']) $sqlWheres[] = 'cs_manager_id='.$this->dDB->escape($options['search_cs']);
        if($options['search_as']) $sqlWheres[] = 'mn_pid='.$this->dDB->escape($options['search_as']);
        if($options['search_kind']) $sqlWheres[] = 'ma_kind='.$this->dDB->escape($options['search_kind']);
        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) {
                $exp_k = explode('|', $s_k);
                foreach($exp_k as $e_k) array_push($OrWhere, $e_k.' like '.$this->dDB->escape('%'.$keyword.'%'));
            }
            $sqlWheres[] = '('.implode(' or ', $OrWhere).')';
        }
        if($options['search_product']) $sqlWheres[] = 'product_name like '.$this->dDB->escape('%'.$options['search_product'].'%');
        if($options['search_member']) $sqlWheres[] = '(ma_cut_name like '.$this->dDB->escape('%'.$options['search_member'].'%').' OR concat(ma_cut_tel,"|",ma_cut_tel2) like '.$this->dDB->escape('%'.$options['search_member'].'%').')';
        if($options['ma_pid']) $sqlWheres[] = 'ma_pid='.$this->dDB->escape($options['ma_pid']);
        if($options['aa_pid']) $sqlWheres[] = 'aa_pid='.$this->dDB->escape($options['aa_pid']);
        if($options['is_payment']=='N') $sqlWheres[] = 'aa_payment_yn='.$this->dDB->escape($options['is_payment']).' and aa_total_price>0';
        
        if(count($sqlWheres)>0) $sql .= ' WHERE '.implode(' AND ', $sqlWheres);

        if($options['page'] > 0) {
            $sort = $options['sort'] ? $options['sort'] : 'DESC';
            $sql .= ' ORDER BY '.$options['date_type'].' '.$sort;
			if($options['rcnt'] > 0) {
                $snum = ($options['page']-1)*$options['rcnt'];
                $sql .= ' LIMIT '.$snum.', '.$options['rcnt'];
            }
            $rows = $this->dDB->query($sql)->getResultArray();
            // debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
            $row = $this->dDB->query($sql)->getRowArray();
            return $row['cnt'];
		}
    }

    function getAsManagerStatusCountList() {
        $sdate=date('Y-m').'-01';
        $edate=date('Y-m').'-31';
        $builder = $this->dDB->table('tb_manager a');
        $builder->select("a.*, (select count(*) from tb_as_assign where mn_pid=a.mn_pid and aa_visit_date is null) reserve_cnt, (select count(*) from tb_as_assign where mn_pid=a.mn_pid and aa_visit_date>='".$sdate."' and aa_visit_date<='".$edate."' and aa_state in ('21', '31')) ing_cnt, (select count(*) from tb_as_assign where mn_pid=a.mn_pid and aa_visit_date>='".$sdate."' and aa_visit_date<='".$edate."' and aa_state = '41') end_cnt", false);
        $builder->like('mn_work', 'as');
        return $builder->get()->getResultArray();
    }

    function getDisposalPartList($options) {
        $sql="
            SELECT 
                * 
                ,(select ma_cut_name from tb_member_as where ma_pid=TT.ma_pid) ma_cut_name
                ,(select ma_cut_tel from tb_member_as where ma_pid=TT.ma_pid) ma_cut_tel
            FROM (
                SELECT 
                    t1.*
                    ,t2.ds_date, t2.ds_memo
                    ,(select ma_pid from tb_as_assign where t2.aa_pid=aa_pid) ma_pid
                    ,(select mn_pid from tb_as_assign where t2.aa_pid=aa_pid) mn_pid
                    ,(select aa_result_date from tb_as_assign where t2.aa_pid=aa_pid) aa_result_date
                    -- ,t4.ma_cut_name, t4.ma_cut_tel
                    ,t5.pt_tc_pid1, t5.pt_tc_pid2
                FROM 
                    tb_part_disuse_item t1 left join tb_part_disuse t2 on t1.ds_pid=t2.ds_pid left join tb_part t5 on t1.pt_pid=t5.pt_pid
                WHERE
                    t2.reg_id=".$this->dDB->escape($options['mn_pid'])."
            ) TT
                WHERE
                    ds_date >= ".$this->dDB->escape($options['sdate'])." and ds_date <= ".$this->dDB->escape($options['edate'])."
        ";
        if($options['cate1']) $sql .= " and pt_tc_pid1=".$this->dDB->escape($options['cate1']);
        if($options['cate2']) $sql .= " and pt_tc_pid2=".$this->dDB->escape($options['cate2']);
        if($options['searchWord']) $sql .= " and pt_name like ".$this->dDB->escape('%'.$options['searchWord'].'%');
        $rows = $this->dDB->query($sql)->getResultArray();
        // debug($sql, $rows);
        // exit;
        $reuslt=array();
        foreach($rows as $row) {
            if(!$result[$row['ds_pid']]) $result[$row['ds_pid']]=$row;
            $result[$row['ds_pid']]['parts'][]=array('pt_pid'=>$row['pt_pid'], 'pt_name'=>$row['pt_name'], 'qty'=>$row['di_qty']);
        }
        return $result;
    }
    
}