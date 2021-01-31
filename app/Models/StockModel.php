<?php namespace App\Models;

use App\Models\BaseModel;

class StockModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

    function getPurchaseList($options) {
        $builder = $this->dDB->table('tb_in_order a');
		$builder->join("tb_in_order_item b", "a.io_pid = b.io_pid");
		if($options['rcnt'] > 0) {
			$builder->select("SQL_CALC_FOUND_ROWS a.*", false);
		} else {
			$builder->select(" a.*, if(b.oi_kind ='A', '상품', '부품') kind_name, b.oi_pid, b.oi_num, b.pd_pid, b.oi_name, b.oi_qea, b.oi_re_qea, b.oi_kind", false);
		}


		$builder->select("(select ct_name from tb_customer where a.ct_pid = ct_pid and ct_del = 'N') as ct_name", false);
        if($options['searchSdate']) $builder->where('a.io_date >=', $options['searchSdate']);
		if($options['searchEdate']) $builder->where('a.io_date <=', $options['searchEdate']);
		if($options['searchCt']) $builder->where('a.ct_pid', $options['searchCt']);
		if($options['searchState']) $builder->where('a.io_state', $options['searchState']);
		if($options['searchMn']) $builder->where('a.reg_id', $options['searchMn']);
		if($options['searchNdate']) $builder->where('left(a.reg_date,10)', $options['searchNdate']);
		if($options['searchNkind'] == 'Y') $builder->wherein('io_state', array('A','B'));
		if($options['io_pid']) $builder->where('a.io_pid', $options['io_pid']);

        if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like('b.oi_name', $keyword);
        }

		$builder->where('a.io_del', 'N');
		$builder->where('b.oi_del', 'N');
		if($options['nogroup'] != 'Y') {
			$builder->select("count(oi_pid) as rowcnt", false);
			$builder->groupBy('a.io_pid');
		}

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.io_pid';
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

	function getPurItemList($options) {
		$builder = $this->dDB->table('tb_in_order_item a');
		$builder->select("SQL_CALC_FOUND_ROWS a.*", false);
		$builder->select("if(a.oi_kind ='A', '상품', '부품') kind_name", false);
		$builder->select("(select group_concat(concat(si_pid,'|',si_qea,'(',si_date,')')) from tb_stock_inout where a.oi_pid = oi_pid and si_del = 'N') as inqea", false)  ;
		$builder->select("(select group_concat(concat(oic_qea,'(',left(reg_date,10),')','|',oic_reson)) from tb_in_order_item_cancle where a.oi_pid = oi_pid and oic_del = 'N') as canqea", false) ;
		if($options['searchMn']) $builder->where('a.reg_id', $options['searchMn']);
		$builder->where('a.io_pid', $options["io_pid"]);
		$builder->where('a.oi_del', 'N');
		$rows = $builder->get()->getResultArray();
		//debug($options, $this->dDB->getLastQuery());
		return $rows;

	}

	function prodList($options) {
		$builder = $this->dDB->table('tb_product');
		if($options['sch_val']) $builder->like('pd_name', $options['sch_val']);
		$rows = $builder->get()->getResultArray();
		return $rows;
	}

	function partList($options) {
		$builder = $this->dDB->table('tb_part');
		if($options['sch_val']) $builder->like('pd_name', $options['sch_val']);
		if($options['pt_pid']) $builder->where('pt_pid', $options["pt_pid"]);
		$rows = $builder->get()->getResultArray();
		return $rows;
	}

	function getWearList($options) {
        $builder = $this->dDB->table('tb_stock_inout a');

		if($options['rcnt'] > 0) {
			$builder->select("SQL_CALC_FOUND_ROWS a.* ", false);
		} else {
			$builder->select(" a.* ", false);
		}
		$builder->select("if(a.si_p_kind = 'A', '상품','부품' ) as kind_name");
		$builder->select("(select ct_name from tb_customer where a.ct_pid = ct_pid and ct_del = 'N') as ct_name", false);
		if($options['searchKind'] == 'A') {
			$builder->select(" b.oi_num, b.oi_qea, b.oi_re_qea" );
			$builder->join('tb_in_order_item b', ' a.oi_pid = b.oi_pid', 'left');
		} else {
			$builder->select(" b.od_code, b.mb_pid" );
			$builder->join('tb_order b', ' a.oi_pid = b.od_pid', 'left');
		}


        if($options['searchSdate']) $builder->where('a.si_date >=', $options['searchSdate']);
		if($options['searchEdate']) $builder->where('a.si_date <=', $options['searchEdate']);
		if($options['searchCt']) $builder->where('a.ct_pid', $options['searchCt']);
		if($options['searchKind']) $builder->where('a.si_kind', $options['searchKind']);
		if($options['searchKind2']) $builder->where('a.si_kind2', $options['searchKind2']);
		if($options['searchPkind']) $builder->where('a.si_p_kind', $options['searchPkind']);
		if($options['searchSt']) $builder->where('a.si_store', $options['searchSt']);
		if($options['searchNdate']) $builder->where('left(a.reg_date,10)', $options['searchNdate']);
		if($options['si_pid']) $builder->where('a.si_pid', $options['si_pid']);
		if($options['si_num']) $builder->where('a.si_num', $options['si_num']);


        if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like('b.oi_name', $keyword);
        }

		$builder->where('a.si_del', 'N');

		if($options['nogroup'] != 'Y') {
			$builder->select("count(si_pid) as rowcnt", false);
			$builder->groupBy('a.si_num');
		}


        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.si_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
             //debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
			return $builder->countAllResults();
		}
    }

	function getStockStatusList($options) {
		$builder = $this->dDB->table('tb_stock a');
		$builder->join('tb_stock_inout b', ' b.si_p_kind = a.st_kind and b.pd_pid = a.pd_pid and b.si_store = a.st_store and b.si_del = "N"', 'left');
		$builder->select("SQL_CALC_FOUND_ROWS a.* ", false);
		if($options['searchKind'] == 'A') {

			$builder->join('tb_product c', 'a.pd_pid = c.pd_pid');
			$name = "c.pd_name";

			$builder->select("(select sum(if((op_step = 'A' or op_step = 'B' or op_step = 'C' or op_step = 'D') and op_kind = 'A', si_qea, 0)) from tb_order_product where pd_pid = a.pd_pid and op_store = a.st_store and op_del = 'N') as odsum");
			$builder->select("(select sum(sa_qea) from tb_stock_adjust where sa_kind = a.st_kind and pd_pid = a.pd_pid and sa_store = a.st_store and sa_store = 'N') as ajsum");
		} else {
			$builder->join('tb_part c', 'a.pd_pid = c.pt_pid');
			$name = "c.pt_name";
			$builder->select("c.pt_wages,c.pt_out_price,c.pt_tc_pid1,c.pt_tc_pid2");
		}
		$builder->select("sum(if(si_kind = 'A', si_qea, 0)) as insum");
		$builder->select("sum(if(si_kind = 'B' and si_kind2 != 'D', si_qea, 0)) as outsum");
		$builder->select("sum(if(si_kind = 'B' and si_kind2 = 'D', si_qea, 0)) as disum");

		$builder->select($name);
		$builder->select("(select ct_name from tb_customer where ct_pid = c.ct_pid) ct_name");




		if($options['searchSt']) $builder->where('a.st_store', $options['searchSt']);
		if($options['searchCt']) $builder->where('c.ct_pid', $options['searchCt']);
		if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like($name, $keyword);
        }

		$builder->where('a.st_kind', $options['searchKind']);



		$builder->groupBy("a.st_pid");

		if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.st_pid';
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

	function getStockMoveList($options) {
		$builder = $this->dDB->table('tb_stock_move a');
		if($options['rcnt'] > 0) {
			$builder->select("SQL_CALC_FOUND_ROWS a.* ", false);
		} else {
			$builder->select(" a.* ", false);
		}
		$builder->select("if(a.sm_p_kind = 'A', '상품','부품' ) as kind_name");

		if($options['sm_num']) $builder->where('a.sm_num', $options['sm_num']);
		if($options['searchSdate']) $builder->where('a.reg_date >=', $options['searchSdate']);
		if($options['searchEdate']) $builder->where('a.reg_date <=', $options['searchEdate']);
		if($options['searchStI']) $builder->where('a.sm_in_store', $options['searchStI']);
		if($options['searchStO']) $builder->where('a.sm_out_store', $options['searchStO']);

		if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like('a.sm_pd_name', $keyword);
        }

		$builder->where('a.sm_del', 'N');

		if($options['nogroup'] != 'Y') {
			$builder->select("count(sm_pid) as rowcnt", false);
			$builder->groupBy('a.sm_num');
		}

		if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.sm_pid';
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

	function getStockCheckList($options) {
		$builder = $this->dDB->table('tb_stock_real a');
		if($options['rcnt'] > 0) {
			$builder->select("SQL_CALC_FOUND_ROWS a.* ", false);
		} else {
			$builder->select(" a.* ", false);
		}

		$builder->select("(select group_concat(pc_name) from tb_product_category where pc_pid in (a.sr_pd_cate)) as pd_cate");

		if($options['sm_num']) $builder->where('a.sm_num', $options['sm_num']);
		if($options['searchSdate']) $builder->where('a.sr_date >=', $options['searchSdate']);
		if($options['searchEdate']) $builder->where('a.sr_date <=', $options['searchEdate']);
		if($options['searchSt']) $builder->where('a.sr_store', $options['searchSt']);

		if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like('a.sm_pd_name', $keyword);
        }



		if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.sr_pid';
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

	function getStockCheckItemList($options) {
		$builder = $this->dDB->table('tb_stock_real_item a');

		$builder->select("SQL_CALC_FOUND_ROWS a.* ", false);

		if($options['sr_pid']) $builder->where('a.sr_pid', $options['sr_pid']);

		if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.sr_pid';
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

	function getStockAdjustList($options) {
		$builder = $this->dDB->table('tb_stock_adjust a');
		if($options['rcnt'] > 0) {
			$builder->select("SQL_CALC_FOUND_ROWS a.* ", false);
		} else {
			$builder->select(" a.* ", false);
		}

		if($options['sm_num']) $builder->where('a.sm_num', $options['sm_num']);
		if($options['searchSdate']) $builder->where('a.reg_date >=', $options['searchSdate']." 00:00:00");
		if($options['searchEdate']) $builder->where('a.reg_date <=', $options['searchEdate']." 23:59:59");
		if($options['searchSt']) $builder->where('a.sa_store', $options['searchSt']);

		if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->where('(EXISTS(select 1 from tb_product where pd_name like "%'.$keyword.'%" AND a.pd_pid = pd_pid) or EXISTS(select 1 from tb_part where pt_name like "%'.$keyword.'%" AND a.pd_pid = pt_pid)) ');
        }



		if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.sa_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
            //debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
			return $builder->countAllResults();
		}
	}

	function getStockPartRequstList($options) {
		$builder = $this->dDB->table('tb_part_inout a');
		$builder->join("tb_part_inout_item b", "a.pi_pid = b.pi_pid");
		$builder->join("tb_part c", "b.pt_pid = c.pt_pid", 'left');

		$builder->select("SQL_CALC_FOUND_ROWS a.*", false);

        if($options['searchSdate']) $builder->where('a.reg_date >=', $options['searchSdate']." 00:00:00");
		if($options['searchEdate']) $builder->where('a.reg_date <=', $options['searchEdate']." 23:59:59");
		if($options['searchSt']) $builder->where('a.pi_store', $options['searchSt']);
		if($options['searchState']) $builder->where('a.pi_state', $options['searchState']);
		if($options['searchKind']) $builder->where('a.pi_kind', $options['searchKind']);
		if($options['searchMn']) $builder->where('a.pi_mn_pid', $options['searchMn']);
		if($options['pi_pid']) $builder->where('a.pi_pid', $options['pi_pid']);
		if($options['cate1']) $builder->where('c.pt_tc_pid1', $options['cate1']);
		if($options['cate2']) $builder->where('c.pt_tc_pid2', $options['cate2']);

        if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like('c.pt_name', $keyword);
        }

		$builder->where('a.pi_del', 'N');
		$builder->where('b.ii_del', 'N');
		if($options['nogroup'] != 'Y') {
			$builder->select("count(a.pi_pid) as rowcnt ", false);
			$builder->groupBy('a.pi_pid');
		} else {
			$builder->select("count(a.pi_pid) as rowcnt, b.pt_pid, b.pt_name, b.ii_qea, b.ii_real_qea, b.ii_pid ");
		}

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.pi_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
             //debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
			return $builder->countAllResults();
		}
	}

	function getStockPartDisposalList($options) {
		$builder = $this->dDB->table('tb_part_disuse a');
		$builder->join("tb_part_disuse_item b", "a.ds_pid = b.ds_pid");
		$builder->join("tb_part c", "b.pt_pid = c.pt_pid", 'left');

		$builder->select("SQL_CALC_FOUND_ROWS a.*", false);

        if($options['searchSdate']) $builder->where('a.reg_date >=', $options['searchSdate']." 00:00:00");
		if($options['searchEdate']) $builder->where('a.reg_date <=', $options['searchEdate']." 23:59:59");
		if($options['searchSt']) $builder->where('a.pi_store', $options['searchSt']);
		if($options['searchState']) $builder->where('a.pi_state', $options['searchState']);
		if($options['searchMn']) $builder->where('a.pi_mn_pid', $options['searchMn']);
		if($options['ds_pid']) $builder->where('a.ds_pid', $options['ds_pid']);
		if($options['cate1']) $builder->where('c.pt_tc_pid1', $options['cate1']);
		if($options['cate2']) $builder->where('c.pt_tc_pid2', $options['cate2']);

        if($options['searchWord']) {
            $keyword=trim($options['searchWord']);
            $builder->like('c.pt_name', $keyword);
        }

		//$builder->where('a.pi_del', 'N');
		//$builder->where('b.ii_del', 'N');
		if($options['nogroup'] != 'Y') {
			$builder->select("count(a.ds_pid) as rowcnt ", false);
			$builder->groupBy('a.ds_pid');
		} else {
			$builder->select("count(a.ds_pid) as rowcnt, b.pt_pid, b.pt_name, b.ii_qea, b.ii_real_qea, b.ii_pid ");
		}

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'a.ds_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
             //debug($options, $this->dDB->getLastQuery());
            return $rows;
		} else {
			return $builder->countAllResults();
		}
	}

}