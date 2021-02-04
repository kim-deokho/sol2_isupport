<?php namespace App\Controllers;

use App\Models\BasicModel;
use App\Models\ManagerModel;
use App\Models\AfterserviceModel;
use App\Models\AssignasModel;
use App\Models\AshistoryModel;
use App\Models\MemberasModel;
use App\Models\CounselModel;
use App\Models\ProductModel;
use App\Models\PcmanageModel;
use App\Models\PartModel;
use App\Models\AssignpartModel;
use App\Models\AssignthumbsModel;
use App\Models\PartdisuseModel;
use App\Models\PartdisuseitemModel;
use App\Models\TraderModel;

use App\Libraries\Fixcodes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Delivery extends BaseController
{
    function __construct() {
        parent::init();
        $this->basic_model = new BasicModel();
        $this->manager_model = new ManagerModel();
        $this->assign_as_model = new AssignasModel();
        $this->afterservice_model = new AfterserviceModel();
        $this->as_history_model = new AshistoryModel();
        $this->member_as_model = new MemberasModel();
        $this->counsel_model = new CounselModel();
        $this->product_model = new ProductModel();
        $this->pcmanage_model = new PcmanageModel();
        $this->part_model = new PartModel();
        $this->assign_part_model = new AssignpartModel();
        $this->assign_thumbs_model = new AssignthumbsModel();
        $this->part_disuse_model = new PartdisuseModel();
        $this->part_disuse_item_model = new PartdisuseitemModel();
        $this->trader_model = new TraderModel();

        $this->fix_codes = new Fixcodes();
    }

	public function index()
	{
        return redirect()->to('/delivery/order_ledger');
    }

	public function order_ledger()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/order_ledger', $viewParams);
        $this->_footer();
	}

	public function d_post()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/d_post', $viewParams);
        $this->_footer();
	}

	public function d_person()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/d_person', $viewParams);
        $this->_footer();
	}

	public function p_return()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/p_return', $viewParams);
        $this->_footer();
	}

	public function order_keep()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/order_keep', $viewParams);
        $this->_footer();
	}

	public function as_manage()
	{
        //AS구분
        if(!$this->setting['code']['AsKind']) $this->setting['code']['AsKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0314'));

        // 매입처
        $this->setting['customer'] = $this->trader_model->where('ct_use', 'Y')->findAll();
        
        $viewParams=$this->Params;
        $viewParams['sdate']=date('Y').'-01-01';
        $viewParams['edate']=date('Y-m-d');
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;
        $viewParams['cs_manager']=$this->manager_model->like('mn_work', 'cs')->findAll();
        $viewParams['as_manager']=$this->manager_model->like('mn_work', 'as')->findAll();
        $viewParams['categorys']=$this->pcmanage_model->getCategorys(array('type'=>'pid'));

        // 부품정보 (재고등록된 부품)
        $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true);
        $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'), $partRows);

        // 부품정보 (모든 부품)
        // $partRows=$this->pcmanage_model->getPartsList(array('page'=>1));
        // $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'));
        
        $viewParams['partCategorysJS']=$partCategorysJS;
        $viewParams['partRows']=$partRows;
       
        $this->_header();
        echo view('delivery/as_manage', $viewParams);
        $this->_footer();
    }
    
    function as_manage_data() {
        //AS구분
        if(!$this->setting['code']['AsKind']) $this->setting['code']['AsKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0314', 'returnType'=>'pid'));
        //AS부위
        if(!$this->setting['code']['AsPart']) $this->setting['code']['AsPart']=$this->common_model->getCodeData(array('p_cd_code'=>'0312', 'returnType'=>'pid'));
        //AS증상
        if(!$this->setting['code']['AsSymptom']) $this->setting['code']['AsSymptom']=$this->common_model->getCodeData(array('p_cd_code'=>'0313', 'returnType'=>'pid'));

        $this->Params['rcnt']=$this->paging_rcnt;
        if(!$this->Params['date_type']) $this->Params['date_type']='request_date';
        if(!$this->Params['sdate']) $this->Params['sdate']=date('Y').'-01-01';
        if(!$this->Params['edate']) $this->Params['edate']=date('Ymd');
        $viewParams=$this->Params;
        $rows=$this->afterservice_model->getAfterserviceList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->afterservice_model->getAfterserviceList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;
        $listHtml=view('delivery/as_manage_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
    }

    function as_manage_excel() {
        //AS구분
        if(!$this->setting['code']['AsKind']) $this->setting['code']['AsKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0314', 'returnType'=>'pid'));
        //AS부위
        if(!$this->setting['code']['AsPart']) $this->setting['code']['AsPart']=$this->common_model->getCodeData(array('p_cd_code'=>'0312', 'returnType'=>'pid'));
        //AS증상
        if(!$this->setting['code']['AsSymptom']) $this->setting['code']['AsSymptom']=$this->common_model->getCodeData(array('p_cd_code'=>'0313', 'returnType'=>'pid'));

        $this->Params['rcnt']=$this->paging_rcnt;
        if(!$this->Params['date_type']) $this->Params['date_type']='request_date';
        if(!$this->Params['sdate']) $this->Params['sdate']=date('Y').'-01-01';
        if(!$this->Params['edate']) $this->Params['edate']=date('Ymd');
        $viewParams=$this->Params;
        $rows=$this->afterservice_model->getAfterserviceList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->afterservice_model->getAfterserviceList($this->Params);
        
        foreach($rows as $i=>$row) {
            $datas[$i]['no']=$totCnt--;
            $datas[$i]['request_date']=dateFormat('Y-m-d', $row['request_date']);
            $datas[$i]['ma_code']=$row['ma_code'];
            $datas[$i]['cs_manager_name']=$row['cs_manager_name'];
            $datas[$i]['ma_cut_name']=$row['ma_cut_name'];
            $datas[$i]['ma_cut_tel']=$row['ma_cut_tel'];
            $datas[$i]['buy_com']=$row['ord_buy']?$row['ord_buy']:$row['ma_order_memo'];

            $datas[$i]['ma_kind']=$this->setting['code']['AsKind'][$row['ma_kind']]['cd_name'];
            $datas[$i]['ma_is_hurryup']=$row['ma_is_hurryup'];
            $datas[$i]['aa_state']=$this->fix_codes->AsState[$row['aa_state']];
            $datas[$i]['aa_result_state']=$this->fix_codes->AsResultState[$row['aa_result_state']];
            $datas[$i]['as_manager_name']=$row['as_manager_name'];
            $datas[$i]['visit_date']=($row['aa_visit_date']?$row['aa_visit_date'].' '.$row['aa_visit_time']:'');
            $datas[$i]['aa_result_date']=$row['aa_result_date']?dateFormat('Y-m-d', $row['aa_result_date']):'';
            $datas[$i]['mc_contents']=$row['mc_contents'];
            $datas[$i]['product_name']=$row['product_name'];
            $datas[$i]['ma_part']=$this->setting['code']['AsPart'][$row['ma_part']]['cd_name'];
            $datas[$i]['ma_symptom']=$this->setting['code']['AsSymptom'][$row['ma_symptom']]['cd_name'];
            $datas[$i]['aa_total_price']=number_format($row['aa_total_price']);
            $datas[$i]['aa_payment_yn']=$row['aa_payment_yn']?$row['aa_payment_yn']:'N';
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(15, 'request_date',  '요청일'),
            'C' => array(50, 'ma_code', '접수번호'),
            'D' => array(30, 'cs_manager_name', '상담자'),
            'E' => array(50, 'ma_cut_name', '고객명'),
            'F' => array(15, 'ma_cut_tel', '연락처'),
            'G' => array(15, 'buy_com', '구매처'),
            'H' => array(15, 'ma_kind', '구분'),
            'I' => array(15, 'ma_is_hurryup', '긴급'),
            'J' => array(15, 'aa_state', '상태'),
            'K' => array(15, 'aa_result_state', '완료상태'),
            'L' => array(15, 'as_manager_name', 'AS기사'),
            'M' => array(15, 'visit_date', '방문일정'),
            'N' => array(15, 'aa_result_date', '완료일'),
            'O' => array(15, 'mc_contents', '상담내용'),
            'P' => array(15, 'product_name', '상품'),
            'Q' => array(15, 'ma_part', '부위'),
            'R' => array(15, 'ma_symptom', '증상'),
            'S' => array(15, 'aa_total_price', '요금'),
            'T' => array(15, 'aa_payment_yn', '입금확인')
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

        $filename = date('Ymd').'_as_manage_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
        
    }

    //ajax용 처리
	function ajax_request() {
		if($this->Params['mode']=='search_as_manager') {
            $asRow=array();
            if($this->Params['aa_pid']) $asRow=$this->assign_as_model->find($this->Params['aa_pid']);
            
            $rows=$this->afterservice_model->getAsManagerStatusCountList();
            
            $viewParams=$this->Params;
            $viewParams['rows']=$rows;
            $viewParams['asRow']=$asRow;
            $listHtml = view('delivery/pop_assig_person2_list', $viewParams);
            
            echo json_encode(array('row'=>$asRow, 'html'=>$listHtml));
        }
        else if($this->Params['mode']=='delete_disposal_part') {
            $this->part_disuse_item_model->delete($this->Params['pid']);
            echo 'ok';
        }
        else if($this->Params['mode']=='update_payment') {
            $this->assign_as_model->update($this->Params['pid'], array('aa_payment_yn'=>$this->Params['payment_yn']));
            echo 'ok';
        }
        
     }

	public function assig_person()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/assig_person', $viewParams);
        $this->_footer();
	}

	public function area_manage()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/area_manage', $viewParams);
        $this->_footer();
	}

	public function outside_mall_order()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/outside_mall_order', $viewParams);
        $this->_footer();
	}

    function execute() {
        $Script=array();
        if($this->Params['mode']=='select_as_manager') {
            if(!$this->Params['as_manager'][0]) {
                jsExecute('parent.alertBox("기사를 선택해주세요.")');
                return false;
            }
            $chgState='11';
            $upData=array('aa_state'=>$chgState, 'mn_pid'=>$this->Params['as_manager'][0], 'aa_matching_date'=>date('Y-m-d H:i:s'));
            $this->assign_as_model->update($this->Params['aa_pid'], $upData);

            // 로그
            $logData=array('aa_pid'=>$this->Params['aa_pid'], 'tah_state'=>$chgState, 'tah_memo'=>$this->fix_codes->AsState[$chgState], 'reg_id'=>$this->session->get('ss_mn_pid'));
            $this->as_history_model->insert($logData);
            
            echo 'ok';
        }
        else if($this->Params['mode']=='cancel_as_manager') {
            $chgState='01';
            $upData=array('aa_state'=>$chgState, 'mn_pid'=>null, 'aa_matching_date'=>null);
            $this->assign_as_model->update($this->Params['aa_pid'], $upData);

            // 로그
            $logData=array('aa_pid'=>$this->Params['aa_pid'], 'tah_state'=>$chgState, 'tah_memo'=>'기사배정취소', 'reg_id'=>$this->session->get('ss_mn_pid'));
            $this->as_history_model->insert($logData);
            echo 'ok';
        }
    }

    function detailAsAssignForm($ma_pid) {
        $view_file='delivery/pop_as_proc_form.php';
        $queryParams['date_type']='request_date';
        $queryParams['page']=1;
        $queryParams['ma_pid']=$ma_pid;
        
        $rows=$this->afterservice_model->getAfterserviceList($queryParams);
        $viewParams['row']=$rows[0];
        if(!$viewParams['row']['aa_pid']) {
            echo 'no-data';
            return;
        }
        // debug($viewParams['row']);
        // exit;
        $viewParams['exp_visit_time']=explode(':', $viewParams['row']['aa_visit_time']);

        //AS구분
        if(!$this->setting['code']['AsKind']) $this->setting['code']['AsKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0314', 'returnType'=>'pid'));
        //AS부위
        if(!$this->setting['code']['AsPart']) $this->setting['code']['AsPart']=$this->common_model->getCodeData(array('p_cd_code'=>'0312', 'returnType'=>'pid'));
        //AS증상
        if(!$this->setting['code']['AsSymptom']) $this->setting['code']['AsSymptom']=$this->common_model->getCodeData(array('p_cd_code'=>'0313', 'returnType'=>'pid'));

        
        // 처리가능한 상태값
        $viewParams['use_state']=array('01', '11', '21', '31', '41');

        // 처리완료 처리시 처리가능한 상태값
        $viewParams['use_result_state']=array('0320', '0318', '0317', '0316');
        // 처리완료 처리 상세사유
        $use_result_code=array();
        if($viewParams['row']['aa_result_state']) $use_result_code=$this->common_model->getCodeData(array('p_cd_code'=>$viewParams['row']['aa_result_state'], 'returnType'=>'pid'));
        $viewParams['use_result_code']=$use_result_code;

        $viewParams['productRows']=$this->product_model->findAll();
        // debug($viewParams['productRows']);
        
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;
        $viewParams['session']=$this->session;
        $viewParams['add_form_file']='detail_form_part_payment.php';

        // 부품정보
        $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true);
        $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'), $partRows);
        $viewParams['partCategorysJS']=$partCategorysJS;
        $viewParams['partRows']=$partRows;
        // debug($partCategorysJS, $partRows);
        // exit;

        // 처리 부품목록
        $viewParams['assignPartList']=$this->assign_part_model->where('aa_pid', $viewParams['row']['aa_pid'])->orderBy('ap_pid', 'desc')->findAll();
        // debug($viewParams['assignPartList']);
        // exit;
        

        // 첨부파일목록
        $viewParams['thumbList']=$this->assign_thumbs_model->where('aa_pid', $viewParams['row']['aa_pid'])->orderBy('at_pid', 'desc')->findAll();

        $formHtml = view('delivery/pop_as_proc_form', $viewParams);
        echo json_encode(array('row'=>$viewParams['row'], 'html'=>$formHtml));
    }

    function update_as() {
        $result=array();
        $dataParams=$this->Params;

        if(!$dataParams['ma_is_hurryup']) $dataParams['ma_is_hurryup']='N';
        if($dataParams['aa_state']>='21') {   // 방문예정
            if(!$dataParams['aa_visit_date'] || !$dataParams['visit_hour'] || !$dataParams['visit_min']) {
                $result['err_msg']="방문일시를 입력해주세요.";
                echo json_encode($result);
                return false;
            }
            $dataParams['aa_visit_time']=$dataParams['visit_hour'].':'.$dataParams['visit_min'];
        }

        if($dataParams['aa_state']=='41') { // 처리완료
            if(!$dataParams['aa_result_state'] || !$dataParams['aa_result_code']) {
                $result['err_msg']="처리 및 사유를 선택해주세요.";
                echo json_encode($result);
                return false;
            }
            $dataParams['aa_result_date']=$this->now_date;
        }
        else {
            $dataParams['aa_result_state']=null;
            $dataParams['aa_result_code']=null;
            $dataParams['aa_result_reason']=null;
            $dataParams['aa_result_date']=null;
        }
        if(!$dataParams['aa_payment_yn']) $dataParams['aa_payment_yn']='N'; // 입금확인

        $dataParams['aa_payment_name']=null;
        $dataParams['aa_bank_acc']=null;
        $dataParams['aa_acount_num']=null;
        if($dataParams['aa_payment_kind']=='C') {   // 카드결제
            $dataParams['aa_payment_name']=$dataParams['card_name'];
            $dataParams['aa_acount_num']=$this->Params['aa_acount_num'];
        }
        else if($dataParams['aa_payment_kind']=='B') {   // 무통장
            $dataParams['aa_payment_name']=$dataParams['bank_name'];
            $dataParams['aa_bank_acc']=$this->Params['aa_bank_acc'];
        }
        if($dataParams['aa_travel_price']) $dataParams['aa_travel_price']=str_replace(',', '', $dataParams['aa_travel_price']);
        if($dataParams['aa_total_price']) $dataParams['aa_total_price']=str_replace(',', '', $dataParams['aa_total_price']);

        
        $this->counsel_model->transBegin();
        $this->member_as_model->transBegin();
        $this->assign_as_model->transBegin();
        $this->as_history_model->transBegin();

        // as상담 업데이트
        $this->counsel_model->update($dataParams['mc_pid'], $dataParams);

        // as신청 업데이트
        $this->member_as_model->update($dataParams['ma_pid'], $dataParams);
        
        if($dataParams['aa_state']) {
            // as방문(기사) 업데이트
            $this->assign_as_model->update($dataParams['aa_pid'], $dataParams);

            
            // 로그            
            $logData=array('aa_pid'=>$this->Params['aa_pid'], 'tah_state'=>$dataParams['aa_state'], 'tah_detail'=>$dataParams['aa_result_state'], 'tah_memo'=>serialize($datazParams), 'reg_id'=>$this->session->get('as_mn_pid'));
            $this->as_history_model->insert($logData);
        }

        if($this->counsel_model->transStatus()===TRUE && $this->member_as_model->transStatus()===TRUE && $this->assign_as_model->transStatus()===TRUE && $this->as_history_model->transStatus()===TRUE) {
            $this->counsel_model->transCommit();
            $this->member_as_model->transCommit();
            $this->assign_as_model->transCommit();
            $this->as_history_model->transCommit();
        }
        else {
            $this->counsel_model->transRollback();
            $this->member_as_model->transRollback();
            $this->assign_as_model->transRollback();
            $this->as_history_model->transRollback();
            $result['err_msg']="Database Error!";
            echo json_encode($result);
            exit;
        }

        // 첨부 이미지
        if($_FILES['files']) {
            foreach($_FILES['files']['name'] as $fi=>$file_name) {
                if(!$file_name) continue;
                $file_title="첨부파일";
                $upFile=getAWSFileName($file_name);
                if($upFile['err_msg']) {
                    $result['err_msg']="[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$upFile['err_msg'].")";
                    echo json_encode($result);
                    exit;
                }
                $result=s3_upload($_FILES['files']['tmp_name'][$fi],  $upFile['file']);
                $thumbData=array('aa_pid'=>$dataParams['aa_pid'],'thumb_img'=>$upFile['file']);
                $this->assign_thumbs_model->insert($thumbData);                
            }
        }

        // 처리 부품
        if($dataParams['part']) {
            $this->assign_part_model->transStart();
            foreach($dataParams['part']['qty'] as $n_pt_pid=>$qty) {
                $partData=array(
                    'aa_pid'=>$dataParams['aa_pid']
                    ,'pt_pid'=>$n_pt_pid
                    ,'aa_part_name'=>$dataParams['part']['name'][$n_pt_pid]
                    ,'aa_qty'=>$qty
                    ,'aa_unit_price'=>$dataParams['part']['price'][$n_pt_pid]
                    ,'aa_wages'=>$dataParams['part']['wages'][$n_pt_pid]
                );
                $partData['aa_price']=(floatval($partData['aa_unit_price'])+floatval($partData['aa_wages']))*$partData['aa_qty'];
                if($dataParams['part']['pid'][$n_pt_pid]) {
                    $this->assign_part_model->update($dataParams['part']['pid'][$n_pt_pid], $partData);
                }
                else {
                    $partData['reg_id']=$this->session->get('as_mn_pid');
                    $this->assign_part_model->insert($partData);
                }
            }
            $this->assign_part_model->transComplete();
        }

        // 재방문(0318), 방문연기(0317)
        if(in_array($dataParams['aa_result_state'], array('0318', '0317'))) {
            $counsel_row=$this->counsel_model->find($dataParams['mc_pid']);
            $member_as_row=$this->member_as_model->find($dataParams['ma_pid']);
            $assign_as_row=$this->assign_as_model->find($dataParams['aa_pid']);
            unset($counsel_row['mc_pid'], $counsel_row['reg_date'], $member_as_row['ma_pid'], $member_as_row['reg_date']);
            // AS접수코드
            $row = $this->counsel_model->selectMax('mc_code')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];
            if($row == ""){
                $sn = "0001";
            } else {
                $sn = (int)$row['mc_code'] +1 ;
                $sn = getSerial($sn,4);
            }
            $counsel_row['mc_code'] = "CS".date('Ymd')."-".$sn;
            $member_as_row['mc_pid'] = $this->counsel_model->insert($counsel_row);
            

            // AS관리(기사)코드
            $row = $this->member_as_model->selectMax('ma_code')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];
            if($row == ""){
                $sn = "0001";
            } else {
                $sn = (int)$row['ma_code']+1 ;
                $sn = getSerial($sn,4);
            }
            $member_as_row['ma_code'] = "AS".date('Ymd')."-".$sn;
            $member_as_row['p_ma_pid'] = $dataParams['ma_pid'];

            $newAssignData=array();
            $newAssignData['ma_pid'] = $this->member_as_model->insert($member_as_row);
            $newAssignData['mb_pid']=$assign_as_row['mb_pid'];
            
            /**
             * 재방문 처리시
             * - 같은 기사가 배정된 AS접수건으로 신규생성 
            */
            if($dataParams['aa_result_state']=='0318') {
                $new_state='11';
                $newAssignData['aa_state']=$new_state;
                $newAssignData['mn_pid']=$assign_as_row['mn_pid'];
                $newAssignData['aa_matching_date']=$this->now_date;
            } 
            /**
             * 방문연기 처리시
             * - 기사가 배정되지 않은 AS접수건으로 신규생성 
            */
            else if($dataParams['aa_result_state']=='0317') {
                $new_state='01';
                $newAssignData['aa_state']=$new_state;
            }
            $aa_insert_id=$this->assign_as_model->insert($newAssignData);

            // 로그
            $logData=array('aa_pid'=>$aa_insert_id, 'tah_state'=>$new_state, 'tah_memo'=>$this->fix_codes->AsState[$new_state], 'reg_id'=>$this->session->get('as_mn_pid'));
            $this->as_history_model->insert($logData);
        }
        $result['ok_msg']="정상적으로 처리되었습니다.";
        echo json_encode($result);
    }

    function detailDisposalPartForm($aa_pid) {
        $queryParams['date_type']='request_date';
        $queryParams['page']=1;
        $queryParams['aa_pid']=$aa_pid;
        $queryParams['search_as']=$this->session->get('as_mn_pid');
        
        $rows=$this->afterservice_model->getAfterserviceList($queryParams);
        $viewParams['row']=$rows[0];

        $viewParams['aa_pid']=$aa_pid;
        $viewParams['productRows']=$this->product_model->findAll();

        //창고
        if(!$this->setting['code']['Storage']) $this->setting['code']['Storage'] = $this->common_model->getCodeData(array('p_cd_code'=>'0501', 'returnType'=>'pid'));
        
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;
        $viewParams['session']=$this->session;
        $viewParams['return_url']='/m/aservice/complete_list';

        // 부품정보
        $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true);
        $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'), $partRows);
        $viewParams['partCategorysJS']=$partCategorysJS;
        $viewParams['partRows']=$partRows;

        // 처리 부품목록
        $viewParams['apList']=$this->assign_part_model->where('aa_pid', $aa_pid)->orderBy('ap_pid', 'desc')->findAll();

        // 폐기부품
        $viewParams['dRow']=$this->part_disuse_model->where('aa_pid', $aa_pid)->first();

        // 폐기부품 리스트
        if($viewParams['dRow']['ds_pid']) $viewParams['dpList']=$this->part_disuse_item_model->where('ds_pid', $viewParams['dRow']['ds_pid'])->orderBy('di_pid', 'desc')->findAll();

        // debug($viewParams['row'], $viewParams['dRow']);
        // exit;

        $formHtml = view('delivery/pop_disposal_parts_form', $viewParams);
        echo json_encode(array('aa_pid'=>$viewParams['row']['aa_pid'], 'ds_pid'=>$viewParams['dRow']['ds_pid'], 'html'=>$formHtml));

    }

    function reg_disposal_part() {
        $result=array();
        $dataParams=$this->Params;
        if($dataParams['ds_pid']) {
            $this->part_disuse_model->update($dataParams['ds_pid'], $dataParams);
        }
        else {
            $dataParams['reg_id']=$this->session->get('ss_mn_pid');
            $insert_id=$this->part_disuse_model->insert($dataParams);
        }

        // 처리 부품
        if($dataParams['part']) {
            $this->part_disuse_item_model->transStart();
            foreach($dataParams['part']['qty'] as $n_pt_pid=>$qty) {
                $partData=array(
                    'pt_pid'=>$n_pt_pid
                    ,'pt_name'=>$dataParams['part']['name'][$n_pt_pid]
                    ,'di_qty'=>$qty
                    ,'di_store'=>$dataParams['part']['store'][$n_pt_pid]
                    ,'di_reason_code'=>$dataParams['part']['reason'][$n_pt_pid]
                );
                if($dataParams['part']['pid'][$n_pt_pid]) {
                    $this->part_disuse_item_model->update($dataParams['part']['pid'][$n_pt_pid], $partData);
                }
                else {
                    $partData['ds_pid']=$dataParams['ds_pid']?$dataParams['ds_pid']:$insert_id;
                    $partData['reg_id']=$this->session->get('ss_mn_pid');
                    $this->part_disuse_item_model->insert($partData);
                }
            }
            $this->part_disuse_item_model->transComplete();
        }
        $result['ok_msg']="정상적으로 처리되었습니다.";
        echo json_encode($result);
    }
}