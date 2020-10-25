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
        if($options['pd_use']) $builder->where('pd_use', $options['pd_use']);
        if($options['pc_pid1']) $builder->where('pc_pid1', $options['pc_pid1']);
        if($options['pc_pid2']) $builder->where('pc_pid2', $options['pc_pid2']);
        if($options['pc_pid3']) $builder->where('pc_pid3', $options['pc_pid3']);
        if($options['pd_kind']) $builder->where('pd_kind', $options['pd_kind']);
        if($options['pd_name']) $builder->like('pd_name', $options['pd_name']);
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
        $builder = $this->dDB->table('tb_product_category');
		$builder->selectMax('pc_code');
		if($options['parent_id']) {
			if($options['parent_id']=='#') $builder->where(array('pc_depth'=>'1'));
			else $builder->where('p_pc_parent', getSerial($options['parent_id'], 9, 'back'));
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
        $result=array();
        $cate_id=getSerial($params['id'], 9, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], 9, 'back');
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
        $result=array();
        $cate_id=getSerial($params['id'], 9, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], 9, 'back');
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
    function getPartsList($options) {
        // debug($options);
        $builder = $this->dDB->table('tb_part');
        if($options['select']) $builder->select($options['select'], false);
        if($options['pt_pid']) {
            $builder->where('pt_pid', $options['pt_pid']);
            return $builder->get()->getRowArray();
        }
        if($options['pt_use']) $builder->where('pt_use', $options['pt_use']);
        if($options['pt_tc_pid1']) $builder->where('pt_tc_pid1', $options['pt_tc_pid1']);
        if($options['pt_tc_pid2']) $builder->where('pt_tc_pid2', $options['pt_tc_pid2']);
        if($options['ct_pid']) $builder->where('ct_pid', $options['ct_pid']);
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
    function getPartCategorys($options=array()) {
        $builder = $this->dDB->table('tb_part_category');
		if($options['where']) $builder->where($options['where'], null, false);
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
        $builder = $this->dDB->table('tb_part_category');
		$builder->selectMax('tc_code');
		if($options['parent_id']) {
			if($options['parent_id']=='#') $builder->where(array('tc_depth'=>'1'));
			else $builder->where('p_tc_parent', getSerial($options['parent_id'], 9, 'back'));
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
        $result=array();
        $cate_id=getSerial($params['id'], 9, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], 9, 'back');
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
        $result=array();
        $cate_id=getSerial($params['id'], 9, 'back');
        $parent_cate_id=$params['parent_id']=='#'?null:getSerial($params['parent_id'], 9, 'back');
		$options=array(
			'where'=>array(
				'p_tc_parent'=>$parent_cate_id
				,'tc_name'=>$params['name']
				,'tc_code !='=>$params['cate_id']
			)
		);
        $isRow=$this->getPartCategoryData($options);
        if($isRow['tc_code']) return array('err'=>'동일한 카테고리명이 존재합니다.');

        $builder = $this->dDB->table('tb_part_category');
        $builder->set('reg_date', 'NOW()', false);
        $builder->update(array('tc_name'=>$params['name']), array('tc_code'=>$cate_id));
        return $result;
    }
    
}