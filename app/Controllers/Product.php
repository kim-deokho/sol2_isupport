<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\ProductbomModel;
use App\Models\PcmanageModel;
use App\Models\TraderModel;
use App\Models\PartModel;
use App\Models\InpricehistoryModel;

use App\Libraries\Fileuploader;
use App\Libraries\Fixcodes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Product extends BaseController
{
    function __construct() {
        parent::init();
        $this->product_model = new ProductModel();
        $this->product_bom_model = new ProductbomModel();
        $this->pcmanage_model = new PcmanageModel();
        $this->part_model = new PartModel();
        $this->fix_codes = new Fixcodes();
        $this->inprice_history_model = new InpricehistoryModel();
        
    }

	public function index()
	{
        $link=ManagerDefaultLink($this->session->get('menu'));
        return redirect()->to($link);
    }

	public function categorys()
	{
        $viewParams=$this->Params;
        $categorysJS=$this->pcmanage_model->getCategorys(array('type'=>'tree'));

		$viewParams['categorysJS']=$categorysJS;

        $this->_header();
        echo view('product/categorys', $viewParams);
        $this->_footer();
    }

    function getCategoryNewNodeId() {
		$options=array('parent_id'=>$this->Params['parent_id']);
		$NewNodeId=$this->pcmanage_model->getCategoryNewNodeId($options);
		echo json_encode(array('id'=>$NewNodeId));
	}

	function getCategoryData() {
		$this->Params=$this->input->post();
		$this->load->model('item_model');
		$categorys=$this->item_model->getCategorys(null, array('where'=>'cate_code="'.$this->Params['cate_code'].'"'));
		#debug($categorys);
		#exit;
		echo json_encode($categorys[0]);
    }

    function ajax_request() {
        if($this->Params['mode']=='chk_double_pdname') {  // 상품명 중복체크
            $where=array('pd_name'=>$this->Params['pd_name']);
            if($this->Params['pd_pid']) $where['pd_pid !=']=$this->Params['pd_pid'];
            $manager=$this->p_model->find($this->Params['pid']);
            // debug($this->Params, $this->manager_model);
            echo json_encode($manager);
        }
        else if($this->Params['mode']=='get_product') { // 상품정보
            $product=$this->product_model->find($this->Params['pid']);
            // 상품의 주문건수(주문건수가 있으면 수정불가)
            $ord_cnt=$this->pcmanage_model->getProductOrderCnt(array('pd_pid'=>$this->Params['pd_pid']));
            $product['ord_cnt']=$ord_cnt;

            // debug($this->Params, $this->manager_model);
            echo json_encode($product);
        }
        else if($this->Params['mode']=='get_part') { // 부품정보
            $part=$this->part_model->find($this->Params['pid']);
            echo json_encode($part);
        }
        else if($this->Params['mode']=='get_inprice_history') { // 입고가이력
            $rows=$this->inprice_history_model->select('tb_product_inprice_history.*, (select pd_code from tb_product where pd_pid=tb_product_inprice_history.pd_pid) as pd_code, (select pd_name from tb_product where pd_pid=tb_product_inprice_history.pd_pid) as pd_name')->where('pd_pid', $this->Params['pd_pid'])->findAll();
            $data=array();
            $totCnt=count($rows);
            foreach($rows as $i=>$row) {
                $data[$i]['no']=$totCnt--;
                $data[$i]['pd_code']=$row['pd_code'];
                $data[$i]['pd_name']=$row['pd_name'];
                $data[$i]['in_price']=number_format($row['pi_in_price']);
                $data[$i]['in_date']=$row['pi_in_date'];
            }
            echo json_encode(array('data'=>$data));
        }
    }

    function chkDoubleName($options=array()) {
        $options=$options ? $options : $this->Params;
        if($options['type']=='part') {
            $where=array('pt_name'=>$options['pt_name']);
            if($options['pt_pid']) $where['pt_pid !=']=$options['pt_pid'];
            $row=$this->part_model->where($where)->first();
            $result = $row['pd_pid'] ? true : false;
        }
        else {
            $where=array('pd_name'=>$options['pd_name']);
            if($options['pd_pid']) $where['pd_pid !=']=$options['pd_pid'];
            $row=$this->product_model->where($where)->first();
            $result = $row['pd_pid'] ? true : false;
        }
        if($this->request->isAJAX()) {
            echo json_encode(array('result'=>$result));
            exit;
        }
        return $result;
    }
    
    function execute() {
        // 상품카테고리관리
		if($this->Params['mode']=='addCategoryNode') {
            $this->Params['reg_id']=$this->session->get('ss_mn_pid');
            $result=$this->pcmanage_model->addCategoryNode($this->Params);
			echo json_encode($result);
			return;
		}
		else if($this->Params['mode']=='deleteCategoryNode') {
			$result=$this->pcmanage_model->deleteCategoryNode($this->Params);
			echo json_encode($result);
			return;
		}
		else if($this->Params['mode']=='updateCategoryName') {
			$result=$this->pcmanage_model->updateCategoryName($this->Params);
			echo json_encode($result);
			return;
        }
        else if($this->Params['mode']=='reg_product') { // 상품등록/수정
            $queryData=$this->Params;
            
            $file_uploader = new Fileuploader();
            if(!$this->Params['pd_pid'] && $this->Params['is_double']!='N') {
                $Scripts[] = "parent.alertBox('상품명 중복확인이 되지 않았습니다.', parent.gcUtil.loader, 'hide')";
                $Scripts[] = "parent.document.forms['regFrm'].pd_name.focus()";
                jsExecute($Scripts);
                exit;
            }
            // 상품명 중복체크
            $doubleParams=array('type'=>'product', 'pd_name'=>$this->Params['pd_name']);
            if($this->Params['pd_pid']) $doubleParams['pd_pid']=$this->Params['pd_pid'];
            if($this->chkDoubleName($doubleParams)) {
                $Scripts[] = "parent.alertBox('동일한 상품명이 존재합니다.', parent.gcUtil.loader, 'hide')";
                $Scripts[] = "parent.document.forms['regFrm'].pd_name.focus()";
                jsExecute($Scripts);
                exit;
            }

            // 상품판매기간
            if($this->Params['pd_sdate']>$this->Params['pd_edate']) {
                $Scripts[] = "parent.alertBox('판매종료일이 판매시작일 보다 빠릅니다.', parent.gcUtil.loader, 'hide')";
                $Scripts[] = "parent.document.forms['regFrm'].pd_edate.focus()";
                jsExecute($Scripts);
                exit;
            }

            // 상품 이미지
            // debug($_FILES, $this->Params);
            // exit;
            if($_FILES['file_pd_img']['name']) {
                $file_title="상품이미지";
                if($_FILES['file_pd_img']['error']>0) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$_FILES['file_pd_img']['error'].")', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
                $res=$file_uploader->fileImgUpload($_FILES['file_pd_img'], $file_title, true);
                if($res['status']<0) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] ".$res['msg']."', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
                $queryData['pd_img']=$res['file_name'];
            }
            else {
                if(!$this->Params['pd_pid']) {
                    $Scripts[] = "parent.alertBox('상품 이미지를 반듯이 등록해주세요.', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
            }

            $queryData['pd_in_price']=str_replace(',', '', $queryData['pd_in_price']);
            $queryData['pd_out_price']=str_replace(',', '', $queryData['pd_out_price']);
            $queryData['pd_delivery_charge']=str_replace(',', '', $queryData['pd_delivery_charge']);

            if($this->Params['pd_pid']) {   // 수정
                $this->product_model->update($this->Params['pd_pid'], $queryData);

                // BOM수정
                if(count($this->Params['Data'])>0) {
                    // 삭제건 삭제
                    $existsPids=array_filter($this->Params['Data']['pb_pid']);
                    if(count($existsPids)>0) $this->product_bom_model->where('pd_pid', $this->Params['pd_pid'])->whereNotIn('pb_pid', $existsPids)->delete();

                    $bomData=array('pd_pid'=>$this->Params['pd_pid']);
                    foreach($this->Params['Data']['cnt'] as $i=>$cnt) {
                        unset($bomData['reg_id'], $bomData['up_id']);
                        $bomData['pb_pd_pid']=$this->Params['Data']['pd_pid'][$i];
                        $bomData['pb_out_price']=str_replace(',', '', $this->Params['Data']['price'][$i]);
                        $bomData['pb_cnt']=str_replace(',', '', $cnt);
                        if(!$bomData['pb_pd_pid'] || !$bomData['pb_out_price'] || !$bomData['pb_cnt']) continue;

                        if($this->Params['Data']['pb_pid'][$i]) {
                            $bomData['up_id']=$this->session->get('ss_mn_pid');
                            $this->product_bom_model->update($this->Params['Data']['pb_pid'][$i], $bomData);
                        }
                        else {
                            $bomData['reg_id']=$this->session->get('ss_mn_pid');
                            $this->product_bom_model->insert($bomData);
                        }
                    }
                }
                else {
                    // BOM 초기화
                    $this->product_bom_model->where('pd_pid', $this->Params['pd_pid'])->delete();
                }

                // 입고가 변경이력
                if($this->Params['old_in_price']!=$this->Params['pd_in_price']) {
                    $historyData=array(
                        'pd_pid'=>$this->Params['pd_pid']
                        ,'pi_in_price'=>$this->Params['pd_in_price']
                        ,'pi_in_date'=>date('Y-m-d')
                        ,'reg_id'=>$this->session->get('ss_mn_pid')
                    );
                    $this->inprice_history_model->insert($historyData);
                }
                $msg="정상적으로 수정되었습니다.";
            }
            else {  // 등록
                $cate_code=$this->Params['pd_cate1'].($this->Params['pd_cate2']?$this->Params['pd_cate2']:'000').($this->Params['pd_cate3']?$this->Params['pd_cate3']:'000');
                $queryData['pd_pc_code']=$cate_code;

                // 카테고리 PID 매칭 등록
                $category_rows=$this->pcmanage_model->getCategorys();
                $queryData['pc_pid1']=null;
                $queryData['pc_pid2']=null;
                $queryData['pc_pid3']=null;
                foreach($category_rows as $c_row) {
                    if($c_row['pc_code']==$this->Params['pd_cate1'].'000000') $queryData['pc_pid1']=$c_row['pc_pid'];
                    else if($c_row['pc_code']==$this->Params['pd_cate1'].$this->Params['pd_cate2'].'000') $queryData['pc_pid2']=$c_row['pc_pid'];
                    else if($c_row['pc_code']==$this->Params['pd_cate1'].$this->Params['pd_cate2'].$this->Params['pd_cate3']) $queryData['pc_pid3']=$c_row['pc_pid'];
                }

                if($this->Params['is_auto']=='Y') { // 상품번호 자동생성
                    $cnt=$this->product_model->where('pd_pc_code', $cate_code)->countAllResults();
                    $queryData['pd_code']='PR'.$cate_code.'-'.getSerial($cnt+1, 5);
                }
                // 상품코드 중복체크
                $existsRow=$this->product_model->where('pd_code', $queryData['pd_code'])->first();
                if($existsRow['pd_code']) {
                    $Scripts[] = "parent.alertBox('동일한 상품코드가 존재합니다.', parent.gcUtil.loader, 'hide')";
                    $Scripts[] = "parent.document.forms['regFrm'].pd_code.focus()";
                    jsExecute($Scripts);
                    exit;
                }
                
                // 상품등록
                $insert_id=$this->product_model->insert($queryData);

                // BOM등록
                if(count($this->Params['Data'])>0) {
                    $bomData=array('pd_pid'=>$insert_id, 'reg_id'=>$this->session->get('ss_mn_pid'));
                    foreach($this->Params['Data']['cnt'] as $i=>$cnt) {
                        $bomData['pb_pd_pid']=$this->Params['Data']['pd_pid'][$i];
                        $bomData['pb_out_price']=str_replace(',', '', $this->Params['Data']['price'][$i]);
                        $bomData['pb_cnt']=str_replace(',', '', $cnt);
                        if(!$bomData['pb_pd_pid'] || !$bomData['pb_out_price'] || !$bomData['pb_cnt']) continue;
                        $this->product_bom_model->insert($bomData);
                    }
                }
                $msg="정상적으로 등록되었습니다.";
            }
            $Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
            jsExecute($Scripts);
            exit;
        }
        /* 부품카테고리 / 부품관리 */
		if($this->Params['mode']=='addPartCategoryNode') {
            $this->Params['reg_id']=$this->session->get('ss_mn_pid');
            $result=$this->pcmanage_model->addPartCategoryNode($this->Params);
			echo json_encode($result);
			return;
		}
		else if($this->Params['mode']=='deletePartCategoryNode') {
			$result=$this->pcmanage_model->deletePartCategoryNode($this->Params);
			echo json_encode($result);
			return;
		}
		else if($this->Params['mode']=='updatePartCategoryName') {
			$result=$this->pcmanage_model->updatePartCategoryName($this->Params);
			echo json_encode($result);
			return;
        }
        else if($this->Params['mode']=='reg_part') { // 부품등록/수정
            $queryData=$this->Params;
            
            // 부품명 중복체크
            $doubleParams=array('type'=>'part', 'pt_name'=>$this->Params['pt_name']);
            if($this->Params['pt_pid']) $doubleParams['pt_pid']=$this->Params['pt_pid'];
            if($this->chkDoubleName($doubleParams)) {
                $Scripts[] = "parent.alertBox('동일한 부품명이 존재합니다.', parent.gcUtil.loader, 'hide')";
                $Scripts[] = "parent.document.forms['regFrm'].pt_name.focus()";
                jsExecute($Scripts);
                exit;
            }

            $queryData['pt_in_price']=str_replace(',', '', $queryData['pt_in_price']);
            $queryData['pt_out_price']=str_replace(',', '', $queryData['pt_out_price']);
            $queryData['pt_wages']=str_replace(',', '', $queryData['pt_wages']);

            if($this->Params['pt_pid']) {   // 수정
                $this->product_model->update($this->Params['pd_pid'], $queryData);

                $msg="정상적으로 수정되었습니다.";
            }
            else {  // 등록
                $cate_code=$this->Params['pt_cate1'].($this->Params['pt_cate2']?$this->Params['pt_cate2']:'000');
                $queryData['pt_tc_code']=$cate_code;

                // 카테고리 PID 매칭 등록
                $category_rows=$this->pcmanage_model->getPartCategorys();
                
                $queryData['pt_tc_pid1']=null;
                $queryData['pt_tc_pid2']=null;
                foreach($category_rows as $c_row) {
                    if($c_row['tc_code']==$this->Params['pt_cate1'].'000') $queryData['pt_tc_pid1']=$c_row['tc_pid'];
                    else if($c_row['tc_code']==$this->Params['pt_cate1'].$this->Params['pt_cate2']) $queryData['pt_tc_pid2']=$c_row['tc_pid'];
                }

                if($this->Params['is_auto']=='Y') { // 부품번호 자동생성
                    $cnt=$this->part_model->where('pt_tc_code', $cate_code)->countAllResults();
                    $queryData['pt_code']='PT'.$cate_code.'-'.getSerial($cnt+1, 5);
                }
                // 부품코드 중복체크
                $existsRow=$this->part_model->where('pt_code', $queryData['pt_code'])->first();
                if($existsRow['pt_code']) {
                    $Scripts[] = "parent.alertBox('동일한 부품코드가 존재합니다.', parent.gcUtil.loader, 'hide')";
                    $Scripts[] = "parent.document.forms['regFrm'].pt_code.focus()";
                    jsExecute($Scripts);
                    exit;
                }
                
                // 부품등록
                $insert_id=$this->part_model->insert($queryData);
                $msg="정상적으로 등록되었습니다.";
            }
            $Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
            jsExecute($Scripts);
            exit;
        }
        else if($this->Params['mode']=='reg_product_inprice') {    // 입고가 등록
            // 입고가 수정
            $this->Params['pi_in_price']=str_replace(',', '', $this->Params['pi_in_price']);
            $this->product_model->update($this->Params['pd_pid'], array('pd_in_price'=>$this->Params['pi_in_price']));

            // 입고가 이력등록
            $historyData=$this->Params;
            $historyData['reg_id']=$this->session->get('ss_mn_pid');
            $this->inprice_history_model->insert($historyData);
            $Scripts[] = "parent.alertBox('등록되었습니다.', parent.win_load)";
            jsExecute($Scripts);
            exit;
        }
    }
    
    function item_list() {    
        $trader_model = new TraderModel();
        //상품구분
        if(!$this->setting['code']['ProductKind']) $this->setting['code']['ProductKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0201', 'returnType'=>'pid'));
        //품목단위
        if(!$this->setting['code']['ProductUnit']) $this->setting['code']['ProductUnit']=$this->common_model->getCodeData(array('p_cd_code'=>'0202', 'returnType'=>'pid'));

        $categorysJS=$this->pcmanage_model->getCategorys(array('type'=>'js'));

        // 매입처
        $buyRows=$trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();
        

        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
        $viewParams['categorysJS']=$categorysJS;
        $viewParams['buyRows']=$buyRows;
        $viewParams['fix_codes']=$this->fix_codes;
        $viewParams['productRows']=$this->product_model->findAll();
       
        $this->_header();
        echo view('product/item_list', $viewParams);
        $this->_footer();
    }

    function item_list_data() {
        $trader_model = new TraderModel();
        //상품구분
        if(!$this->setting['code']['ProductKind']) $this->setting['code']['ProductKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0201', 'returnType'=>'pid'));
        
        // 매입처
        $buyRows=$trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();
        $buyPids=array();
        foreach($buyRows as $b_row) $buyPids[$b_row['ct_pid']]=$b_row['ct_name'];

        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->pcmanage_model->getProductList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->pcmanage_model->getProductList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;
        $viewParams['buyPids']=$buyPids;
        $viewParams['categorys']=$this->pcmanage_model->getCategorys(array('type'=>'pid'));
        $listHtml=view('product/item_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
    }

    function item_list_excel() {
        $trader_model = new TraderModel();
        $this->Params['rcnt']=0;
        $this->Params['page']=1;
        $rows=$this->pcmanage_model->getProductList($this->Params);
        //상품구분
        $ProductKind=$this->common_model->getCodeData(array('p_cd_code'=>'0201', 'returnType'=>'pid'));
        
        // 매입처
        $buyRows=$trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();
        $buyPids=array();
        foreach($buyRows as $b_row) $buyPids[$b_row['ct_pid']]=$b_row['ct_name'];

        // 카테고리
        $categorys=$this->pcmanage_model->getCategorys(array('type'=>'pid'));

        $datas=array();
        $totCnt = count($rows);
        if($totCnt<1) return;
        foreach($rows as $i=>$row) {
            $categoryPath = array($categorys[$row['pc_pid1']]['pc_name']);
            if($row['pc_pid2']) array_push($categoryPath, $categorys[$row['pc_pid2']]['pc_name']);
            if($row['pc_pid3']) array_push($categoryPath, $categorys[$row['pc_pid3']]['pc_name']);

            $datas[$i]['no']=$totCnt--;
            $datas[$i]['buyer']=$buyPids[$row['ct_pid']];
            $datas[$i]['category']=implode(' > ', $categoryPath);
            $datas[$i]['pd_code']=$row['pd_code'];
            $datas[$i]['pd_name']=$row['pd_name'];
            $datas[$i]['pd_kind']=$ProductKind[$row['pd_kind']]['cd_name'];
            $datas[$i]['in_price']=number_format($row['pd_in_price']);
            $datas[$i]['out_price']=number_format($row['pd_out_price']);
            $datas[$i]['is_use']=$row['pd_use'];
            $datas[$i]['reg_date']=dateFormat('Y-m-d', $row['reg_date']);
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(15, 'buyer',  '매입처'),
            'C' => array(50, 'category', '카테고리'),
            'D' => array(30, 'pd_code', '상품코드'),
            'E' => array(50, 'pd_name', '상품명'),
            'F' => array(15, 'pd_kind', '구분'),
            'G' => array(15, 'in_price', '입고가'),
            'H' => array(15, 'out_price', '정상가'),
            'I' => array(15, 'is_use', '사용유무'),
            'J' => array(15, 'reg_date', '등록일')
        );

        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $cellName=$key.$i;
                $sheet->setCellValue($cellName, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_product_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    function getBomProductData() {
        // 현재 등록되어 있는 BOM상품 리스트
        $rows = $this->product_bom_model->select('tb_product_bom.*, (select pd_code from tb_product where pd_pid=tb_product_bom.pb_pd_pid) pd_code, (select pd_name from tb_product where pd_pid=tb_product_bom.pb_pd_pid) pd_name, (select pd_in_price from tb_product where pd_pid=tb_product_bom.pb_pd_pid) pd_in_price', false)->where('pd_pid', $this->Params['pd_pid'])->orderBy('pb_pid', 'asc')->findAll();
        // debug($rows, $this->product_bom_model->builder()->getLastQuery());

        $viewParams=$this->Params;
        $viewParams['rows']=$rows;
        $viewParams['IsDiabled']=$this->Params['ord_cnt']>0?true:false;

        echo view('product/popProductBomList', $viewParams);
    }

	public function external()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('product/external', $viewParams);
        $this->_footer();
	}

    
    function part_list() { 
        $trader_model = new TraderModel();
        $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'));

        // 카테고리 설정을 위한
        $partCategorysTree=$this->pcmanage_model->getPartCategorys(array('type'=>'tree'));

        // 매입처
        $buyRows=$trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();
        
        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
        $viewParams['partCategorysJS']=$partCategorysJS;
        $viewParams['partCategorysTree']=$partCategorysTree;
        $viewParams['buyRows']=$buyRows;
       
        $this->_header();
        echo view('product/part_list', $viewParams);
        $this->_footer();
    }

    function part_list_data() {
        $trader_model = new TraderModel();
        // 매입처
        $buyRows=$trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();
        $buyPids=array();
        foreach($buyRows as $b_row) $buyPids[$b_row['ct_pid']]=$b_row['ct_name'];
        

        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->pcmanage_model->getPartsList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->pcmanage_model->getPartsList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;
        $viewParams['buyPids']=$buyPids;
        $viewParams['categorys']=$this->pcmanage_model->getPartCategorys(array('type'=>'pid'));
        // debug($viewParams['categorys']);
        $listHtml=view('product/part_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
    }

    function part_list_excel() {
        $trader_model = new TraderModel();
        $this->Params['rcnt']=0;
        $this->Params['page']=1;
        $rows=$this->pcmanage_model->getPartsList($this->Params);
        // 매입처
        $buyRows=$trader_model->where('ct_use', 'Y')->whereIn('ct_kind', array('B', 'C'))->findAll();
        $buyPids=array();
        foreach($buyRows as $b_row) $buyPids[$b_row['ct_pid']]=$b_row['ct_name'];

        // 카테고리
        $categorys=$this->pcmanage_model->getPartCategorys(array('type'=>'pid'));

        $datas=array();
        $totCnt = count($rows);
        if($totCnt<1) return;
        foreach($rows as $i=>$row) {
            $categoryPath = array($categorys[$row['pt_tc_pid1']]['tc_name']);
            if($row['pt_tc_pid2']) array_push($categoryPath, $categorys[$row['pt_tc_pid2']]['tc_name']);

            $datas[$i]['no']=$totCnt--;
            $datas[$i]['buyer']=$buyPids[$row['ct_pid']];
            $datas[$i]['category']=implode(' > ', $categoryPath);
            $datas[$i]['pt_code']=$row['pt_code'];
            $datas[$i]['pt_name']=$row['pt_name'];
            $datas[$i]['in_price']=number_format($row['pt_in_price']);
            $datas[$i]['pt_wages']=number_format($row['pt_wages']);
            $datas[$i]['is_use']=$row['pt_use'];
            $datas[$i]['reg_date']=dateFormat('Y-m-d', $row['reg_date']);
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(15, 'buyer',  '매입처'),
            'C' => array(50, 'category', '카테고리'),
            'D' => array(30, 'pt_code', '부품코드'),
            'E' => array(50, 'pt_name', '부품명'),
            'F' => array(15, 'in_price', '부품가'),
            'G' => array(15, 'pt_wages', '공임비'),
            'H' => array(15, 'is_use', '사용유무'),
            'I' => array(15, 'reg_date', '등록일')
        );

        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $cellName=$key.$i;
                $sheet->setCellValue($cellName, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_part_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    function getPartCategoryNewNodeId() {
		$options=array('parent_id'=>$this->Params['parent_id']);
		$NewNodeId=$this->pcmanage_model->getPartCategoryNewNodeId($options);
		echo json_encode(array('id'=>$NewNodeId));
    }
    
    /** 입고가관리 */
    function inprice_list() {
        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
       
        $this->_header();
        echo view('product/inprice_list', $viewParams);
        $this->_footer();
    }

    function inprice_list_data() {
        //상품구분
        if(!$this->setting['code']['ProductKind']) $this->setting['code']['ProductKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0201', 'returnType'=>'pid'));
        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->pcmanage_model->getProductList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->pcmanage_model->getProductList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;

        $viewParams['categorys']=$this->pcmanage_model->getCategorys(array('type'=>'pid'));
        $listHtml=view('product/inprice_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
    }

    function inprice_list_excel() {
        $this->Params['rcnt']=0;
        $this->Params['page']=1;
        $rows=$this->pcmanage_model->getProductList($this->Params);
        //상품구분
        $ProductKind=$this->common_model->getCodeData(array('p_cd_code'=>'0201', 'returnType'=>'pid'));

        // 카테고리
        $categorys=$this->pcmanage_model->getCategorys(array('type'=>'pid'));

        $datas=array();
        $totCnt = count($rows);
        if($totCnt<1) return;
        foreach($rows as $i=>$row) {
            $categoryPath = array($categorys[$row['pc_pid1']]['pc_name']);
            if($row['pc_pid2']) array_push($categoryPath, $categorys[$row['pc_pid2']]['pc_name']);
            if($row['pc_pid3']) array_push($categoryPath, $categorys[$row['pc_pid3']]['pc_name']);

            $datas[$i]['no']=$totCnt--;
            $datas[$i]['category']=implode(' > ', $categoryPath);
            $datas[$i]['pd_code']=$row['pd_code'];
            $datas[$i]['pd_name']=$row['pd_name'];
            $datas[$i]['pd_kind']=$ProductKind[$row['pd_kind']]['cd_name'];
            $datas[$i]['in_price']=number_format($row['pd_in_price']);
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(50, 'category', '카테고리'),
            'C' => array(30, 'pd_code', '상품코드'),
            'D' => array(50, 'pd_name', '상품명'),
            'E' => array(15, 'pd_kind', '구분'),
            'F' => array(15, 'in_price', '입고가')
        );

        

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($cells as $key => $val) {
            $cellName = $key.'1';

            $sheet->getColumnDimension($key)->setWidth($val[0]);
            $sheet->getRowDimension('1')->setRowHeight(25);
            $sheet->setCellValue($cellName, $val[2]);
            $sheet->getStyle($cellName)->getFont()->setBold(true);
            $sheet->getStyle($cellName)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle($cellName)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        for ($i = 2; $row = array_shift($datas); $i++) {
            foreach ($cells as $key => $val) {
                $cellName=$key.$i;
                $sheet->setCellValue($cellName, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_inprice_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}