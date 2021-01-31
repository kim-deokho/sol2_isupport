<?php namespace App\Models;

use App\Models\BaseModel;

class PcmanageModel extends BaseModel
{
    function __construct() {
        parent::__construct();
    }

    function getProductList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_product');
        if($options['select']) $builder->select($options['select'], false);
        if($options['pd_pid']) {
            $builder->where('pd_pid', $options['pd_pid']);
            return $builder->get()->getRowArray();
        }
        if($options['search_use']) $builder->where('pd_use', $options['search_use']);
        if($options['search_kind']) $builder->where('pd_kind', $options['search_kind']);
        $search_cate_id='';
        if($options['cate1']) $search_cate_id.=$options['cate1'];
        if($options['cate2']) $search_cate_id.=$options['cate2'];
        if($options['cate3']) $search_cate_id.=$options['cate3'];
        if($search_cate_id) $builder->like('pd_pc_code', $search_cate_id, 'after');
        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) array_push($OrWhere, $s_k.' like '.$this->dDB->escape('%'.$keyword.'%'));
            
            $builder->where('('.implode(' or ', $OrWhere).')', null, false);
        }

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'pd_pid';
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

    function getCategorys($options=array()) {
        $builder = $this->dDB->table('tb_product_category');
		if($options['where']) $builder->where($options['where'], null, false);
		$builder->orderBy('pc_code', 'asc');
        $rows = $builder->get()->getResultArray();
		if($options['type']=='js') {
			foreach($rows as $row) {
				$code01=substr($row['pc_code'], 0, 3);
				$code02=substr($row['pc_code'], 3, 3);
				$code03=substr($row['pc_code'], 6, 3);
				if($row['pc_depth']==1) $categorys[$code01]=array('name'=>$row['pc_name'], 'code'=>$row['pc_code']);
				else if($row['pc_depth']==2) $categorys[$code01][$code02]=array('name'=>$row['pc_name'], 'code'=>$row['pc_code']);
				else if($row['pc_depth']==3) $categorys[$code01][$code02][$code03]=array('name'=>$row['pc_name'], 'code'=>$row['pc_code']);
            }
			return $categorys;
        } 
        else if($options['type']=='tree') {
			foreach($rows as $i=>$row) {
                $category_id=str_replace('000', '', $row['pc_code']);
                $parent_category_id=str_replace('000', '', $row['p_pc_parent']);
                
				// $categorys[$i]=array('id'=>$row['pc_code'], 'text'=>$row['pc_name']);
                // $categorys[$i]['parent']=$row['pc_depth']==1?'#':$row['pc_depth'];
                $categorys[$i]=array('id'=>$category_id, 'text'=>$row['pc_name']);
                $categorys[$i]['parent']=$row['pc_depth']==1?'#':$parent_category_id;
                $categorys[$i]['type']=$row['pc_depth']==3?'file':'folder';

			}
			return $categorys;
        }
        else if($options['type']=='pid') {
            foreach($rows as $i=>$row) {
                $categorys[$row['pc_pid']]=$row;
            }
            return $categorys;
        }
		return $rows;
    }
    
    function getCategoryNewNodeId($options) {
        $max_depth=$params['max_depth']?$params['max_depth']:3;
        $max_length=$max_depth*3;

        $builder = $this->dDB->table('tb_product_category');
		$builder->selectMax('pc_code');
		if($options['parent_id']) {
			if($options['parent_id']=='#') $builder->where(array('pc_depth'=>'1'));
			else $builder->where('p_pc_parent', getSerial($options['parent_id'], $max_length, 'back'));
		}
		if($options['name']) $builder->where('pc_name', $options['name']);
		if($options['depth']) $builder->where('pc_depth', $options['depth']);
		$row=$builder->get()->getRowArray();
		if($row['pc_code']) {
            $cate_id=str_replace('000', '', $row['pc_code']);
			// 숫자 길이가 길어지면 정상적인 숫자로 읽어 들이지 못함. 마지막 depth값만 +1
			$id_befor=substr($cate_id, 0, strlen($cate_id)-3);
			$id_back=substr($cate_id, -3);

			$int_id=intval($id_back);
			$bId = $int_id+1;
			$serialId=getSerial($bId, strlen($id_back));
			$newId = $id_befor.$serialId;

			return $newId;
		}
		else {
			$newId='001';
			return ($options['parent_id']!='#'?$options['parent_id']:'').$newId;
		}
	}

	function addCategoryNode($params) {
        $max_depth=$params['max_depth']?$params['max_depth']:3;
        $max_length=$max_depth*3;

        $result=array();
        $cate_id=getSerial($params['id'], $max_length, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], $max_length, 'back');
		$options=array(
			'where'=>array(
				'p_pc_parent'=>$parent_cate_id
				,'pc_name'=>$params['name']
			)
		);
		$isRow=$this->getCategoryData($options);
        if($isRow['pc_code']) return array('err'=>'동일한 카테고리명이 존재합니다.');
        
        $p_pc_pid=null;
        if($parent_cate_id!=null) {
            $parentRow=$this->getCategoryData(array('where'=>array('pc_code'=>$parent_cate_id)));
            $p_pc_pid=$parentRow['pc_pid'];
        }
		
		$Data=array(
			'pc_code'=>$cate_id
			,'pc_name'=>$params['name']
			,'p_pc_pid'=>$p_pc_pid
			,'p_pc_parent'=>$parent_cate_id
            ,'pc_depth'=>strlen($params['id'])/3
            ,'reg_id'=>$params['reg_id']
        );
        $builder = $this->dDB->table('tb_product_category');
        $builder->set('reg_date', 'NOW()', false);
        $builder->insert($Data);
        return $result;
	}

	function getCategoryData($options) {
		$builder = $this->dDB->table('tb_product_category');
		if($options['where']) $builder->where($options['where']);
		$builder->orderBy('pc_code', 'asc');
		$row = $builder->get()->getRowArray();
		return $row;
	}

	function deleteCategoryNode($params) {
        $result=array();
        $obuilder = $this->dDB->table('tb_order_product');
        $obuilder->like('op_pc_code', $params['id'], 'after');
        $cnt=$obuilder->countAllResults();
        if($cnt>0) return array('err'=>number_format($cnt).'건의 주문상품건이 존재하여 삭제가 불가능합니다.');

        $builder = $this->dDB->table('tb_product_category');
		$builder->like('pc_code', $params['id'], 'after');
        $builder->delete();
        return $result;
    }
    
    function updateCategoryName($params) {
        $max_depth=$params['max_depth']?$params['max_depth']:3;
        $max_length=$max_depth*3;

        $result=array();
        $cate_id=getSerial($params['id'], $max_length, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], $max_length, 'back');
		$options=array(
			'where'=>array(
				'p_pc_parent'=>$parent_cate_id
				,'pc_name'=>$params['name']
				,'pc_code !='=>$params['cate_id']
			)
		);
        $isRow=$this->getCategoryData($options);
        if($isRow['pc_code']) return array('err'=>'동일한 카테고리명이 존재합니다.');

        $builder = $this->dDB->table('tb_product_category');
        $builder->set('reg_date', 'NOW()', false);
        $builder->update(array('pc_name'=>$params['name']), array('pc_code'=>$cate_id));
        return $result;
    }

    // 상품의 주문된 상품수
    function getProductOrderCnt($options) {
        $builder = $this->dDB->table('tb_order_product');
        $builder->where('pd_pid', $options['pd_pid']);
        $cnt=$builder->countAllResults();
        return $cnt;
    }

    // 부품관리
    function getPartsList($options, $stock_check=false, $user_id='') {
        // debug($options);
        $builder = $this->dDB->table('tb_part');
        if($stock_check) {  // 재고로 등록된 부품
            if($user_id) {  // AS기사의 재고가 있는 부품
                $partsRows=$this->userStockPartList(array('mn_pid'=>$user_id));
                // $partPid=array();
                // foreach($partsRows as $pRow) {
                //     array_push($partPid, $pRow['pt_pid']);
                // }
                // $pidData=array_unique($partPid);
                $builder->whereIn('pt_pid', array_keys($partsRows));

            }
            else {
                $builder->join('tb_stock', 'tb_part.pt_pid=tb_stock.pd_pid', 'right');
                $builder->where(array('st_kind'=>'B', 'st_del'=>'N', 'st_qea >'=>0));
            }
        }
        if($options['select']) $builder->select($options['select'], false);
        if($options['pt_pid']) {
            $builder->where('pt_pid', $options['pt_pid']);
            return $builder->get()->getRowArray();
        }
        if($options['search_use']) $builder->where('pt_use', $options['search_use']);
        if($options['ct_pid']) $builder->where('ct_pid', $options['ct_pid']);
        $search_cate_id='';
        if($options['cate1']) $search_cate_id.=$options['cate1'];
        if($options['cate2']) $search_cate_id.=$options['cate2'];
        if($search_cate_id) $builder->like('pt_tc_code', $search_cate_id, 'after');
        if($options['searchWord'] && $options['searchKey']) {
            if(!is_array($options['searchKey'])) $options['searchKey']=array($options['searchKey']);
            $keyword=trim($options['searchWord']);
            $OrWhere=array();
            foreach($options['searchKey'] as $s_k) array_push($OrWhere, $s_k.' like '.$this->dDB->escape('%'.$keyword.'%'));
            
            $builder->where('('.implode(' or ', $OrWhere).')', null, false);
        }

        if($options['page'] > 0) {
            $order=$options['order']?$options['order']:'pt_pid';
            $sort=$options['sort']?$options['sort']:'desc';
			$builder->orderBy($order, $sort);
			if($options['rcnt'] > 0) {
				$snum = ($options['page']-1)*$options['rcnt'];
				$builder->limit($options['rcnt'], $snum);
            }
            $rows = $builder->get()->getResultArray();
            return $rows;
		} else {
			return $builder->countAllResults();
		}    
    }

    /* 부품카테고리 */
    function getPartCategorys($options=array(), $partData='') {
        $builder = $this->dDB->table('tb_part_category');
        if($options['where']) $builder->where($options['where'], null, false);
        if($partData) {
            $categoryPid=array();
            foreach($partData as $part) {
                array_push($categoryPid, $part['pt_tc_pid1'], $part['pt_tc_pid2']);
            }
            $pidData=array_unique($categoryPid);
            $builder->whereIn('tc_pid', $pidData);
        }
		$builder->orderBy('tc_code', 'asc');
        $rows = $builder->get()->getResultArray();
		if($options['type']=='js') {
			foreach($rows as $row) {
				$code01=substr($row['tc_code'], 0, 3);
				$code02=substr($row['tc_code'], 3, 3);
				$code03=substr($row['tc_code'], 6, 3);
				if($row['tc_depth']==1) $categorys[$code01]=array('name'=>$row['tc_name'], 'code'=>$row['tc_code']);
				else if($row['tc_depth']==2) $categorys[$code01][$code02]=array('name'=>$row['tc_name'], 'code'=>$row['tc_code']);
				else if($row['tc_depth']==3) $categorys[$code01][$code02][$code03]=array('name'=>$row['tc_name'], 'code'=>$row['tc_code']);
            }
			return $categorys;
        } 
        else if($options['type']=='tree') {
			foreach($rows as $i=>$row) {
                $category_id=str_replace('000', '', $row['tc_code']);
                $parent_category_id=str_replace('000', '', $row['p_tc_parent']);
                
				// $categorys[$i]=array('id'=>$row['tc_code'], 'text'=>$row['tc_name']);
                // $categorys[$i]['parent']=$row['tc_depth']==1?'#':$row['tc_depth'];
                $categorys[$i]=array('id'=>$category_id, 'text'=>$row['tc_name']);
                $categorys[$i]['parent']=$row['tc_depth']==1?'#':$parent_category_id;
                $categorys[$i]['type']=$row['tc_depth']==3?'file':'folder';

			}
			return $categorys;
        }
        else if($options['type']=='pid') {
            foreach($rows as $i=>$row) {
                $categorys[$row['tc_pid']]=$row;
            }
            return $categorys;
        }
		return $rows;
    }
    
    function getPartCategoryNewNodeId($options) {
        $max_depth=$params['max_depth']?$params['max_depth']:2;
        $max_length=$max_depth*3;

        $builder = $this->dDB->table('tb_part_category');
		$builder->selectMax('tc_code');
		if($options['parent_id']) {
			if($options['parent_id']=='#') $builder->where(array('tc_depth'=>'1'));
			else $builder->where('p_tc_parent', getSerial($options['parent_id'], $max_length, 'back'));
		}
		if($options['name']) $builder->where('tc_name', $options['name']);
		if($options['depth']) $builder->where('tc_depth', $options['depth']);
		$row=$builder->get()->getRowArray();
		if($row['tc_code']) {
            $cate_id=str_replace('000', '', $row['tc_code']);
			// 숫자 길이가 길어지면 정상적인 숫자로 읽어 들이지 못함. 마지막 depth값만 +1
			$id_befor=substr($cate_id, 0, strlen($cate_id)-3);
			$id_back=substr($cate_id, -3);

			$int_id=intval($id_back);
			$bId = $int_id+1;
			$serialId=getSerial($bId, strlen($id_back));
			$newId = $id_befor.$serialId;

			return $newId;
		}
		else {
			$newId='001';
			return ($options['parent_id']!='#'?$options['parent_id']:'').$newId;
		}
	}

	function addPartCategoryNode($params) {
        $max_depth=$params['max_depth']?$params['max_depth']:2;
        $max_length=$max_depth*3;
        $result=array();
        $cate_id=getSerial($params['id'], $max_length, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], $max_length, 'back');
		$options=array(
			'where'=>array(
				'p_tc_parent'=>$parent_cate_id
				,'tc_name'=>$params['name']
			)
		);
		$isRow=$this->getPartCategoryData($options);
        if($isRow['tc_code']) return array('err'=>'동일한 카테고리명이 존재합니다.');
        
        $p_tc_pid=null;
        if($parent_cate_id!=null) {
            $parentRow=$this->getPartCategoryData(array('where'=>array('tc_code'=>$parent_cate_id)));
            $p_tc_pid=$parentRow['tc_pid'];
        }
		
		$Data=array(
			'tc_code'=>$cate_id
			,'tc_name'=>$params['name']
			,'p_tc_pid'=>$p_tc_pid
			,'p_tc_parent'=>$parent_cate_id
            ,'tc_depth'=>strlen($params['id'])/3
            ,'reg_id'=>$params['reg_id']
        );
        $builder = $this->dDB->table('tb_part_category');
        $builder->set('reg_date', 'NOW()', false);
        $builder->insert($Data);
        return $result;
	}

	function getPartCategoryData($options) {
		$builder = $this->dDB->table('tb_part_category');
		if($options['where']) $builder->where($options['where']);
		$builder->orderBy('tc_code', 'asc');
		$row = $builder->get()->getRowArray();
		return $row;
	}

	function deletePartCategoryNode($params) {
        $result=array();

        $builder = $this->dDB->table('tb_part_category');
		$builder->like('tc_code', $params['id'], 'after');
        $builder->delete();
        return $result;
    }
    
    function updatePartCategoryName($params) {
        $max_depth=$params['max_depth']?$params['max_depth']:2;
        $max_length=$max_depth*3;
        $result=array();
        $cate_id=getSerial($params['id'], $max_length, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], $max_length, 'back');
		$options=array(
			'where'=>array(
				'p_tc_parent'=>$parent_cate_id
				,'tc_name'=>$params['name']
				,'tc_code !='=>$cate_id
			)
        );
        
        $isRow=$this->getPartCategoryData($options);
        if($isRow['tc_code']) return array('err'=>'동일한 카테고리명이 존재합니다.');

        $builder = $this->dDB->table('tb_part_category');
        $builder->set('reg_date', 'NOW()', false);
        $builder->update(array('tc_name'=>$params['name']), array('tc_code'=>$cate_id));
        return $result;
    }

    function userStockPartList($options=array()) {
        if(!$options['mn_pid']) $options['mn_pid']=$this->session->get('as_mn_pid');
        $sql="
            SELECT *, (apply_cnt-use_cnt-return_cnt) stock_cnt FROM (
                select 
                    t3.*, SUM(IF(pi_kind='A', ii_real_qea, 0)) apply_cnt,  SUM(IF(pi_kind='B', ii_real_qea, 0)) return_cnt , (select count(*) from tb_as_assign ta join tb_as_assign_part tb on ta.aa_pid=tb.aa_pid where ta.mn_pid=t1.pi_mn_pid and tb.pt_pid=t2.pt_pid) use_cnt 
                from 
                    tb_part_inout t1 join tb_part_inout_item t2 on t1.pi_pid=t2.pi_pid join tb_part t3 on t2.pt_pid=t3.pt_pid 
                where 
                    t1.pi_mn_pid=".$this->dDB->escape($options['mn_pid'])." and pi_del='N' and ii_del='N' and pi_result_confirm_yn='Y' group by pt_pid
            ) TT
            WHERE
                (apply_cnt-use_cnt-return_cnt) > 0
        ";
        if($options['cate1']) $sql .= " AND pt_tc_pid=".$this->dDB->escape($options['cate1']);
        if($options['cate2']) $sql .= " AND pt_tc_pid2=".$this->dDB->escape($options['cate2']);
        if($options['searchWord']) $sql .= " AND pt_name like ".$this->dDB->escape('%'.$options['searchWord'].'%');
        $rows = $this->dDB->query($sql)->getResultArray();
        $result=array();
        foreach($rows as $i=>$row) {
            $result[$row['pt_pid']]=$row;
        }
        return $result;
    }
    
}