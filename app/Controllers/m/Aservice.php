<?php namespace App\Controllers\m;

use App\Models\BasicModel;
use App\Models\AfterserviceModel;
use App\Models\ProductModel;
use App\Models\MemberasModel;
use App\Models\AssignasModel;
use App\Models\AshistoryModel;
use App\Models\CounselModel;
use App\Models\PcmanageModel;
use App\Models\PartModel;
use App\Models\AssignpartModel;
use App\Models\AssignthumbsModel;
use App\Models\PartdisuseModel;
use App\Models\PartdisuseitemModel;


use App\Libraries\Fixcodes;

class Aservice extends \App\Controllers\BaseController
{
    function __construct() {
        parent::init();
        $this->basic_model = new BasicModel();
        $this->afterservice_model = new AfterserviceModel();
        $this->product_model = new ProductModel();
        $this->assign_as_model = new AssignasModel();
        $this->as_history_model = new AshistoryModel();
        $this->member_as_model = new MemberasModel();
        $this->counsel_model = new CounselModel();
        $this->pcmanage_model = new PcmanageModel();
        $this->part_model = new PartModel();
        $this->assign_part_model = new AssignpartModel();
        $this->assign_thumbs_model = new AssignthumbsModel();
        $this->fix_codes = new Fixcodes();
        $this->part_disuse_model = new PartdisuseModel();
        $this->part_disuse_item_model = new PartdisuseitemModel();

    }

	public function index()
	{
        return redirect()->to('/m/aservice/status_list');
    }

	public function status_list($id='')
	{
        $viewParams=$this->Params;
        if($id) {
            $view_file='m/as/detail_form';
            $queryParams['date_type']='request_date';
            $queryParams['page']=1;
            $queryParams['ma_pid']=$id;
            $queryParams['search_as']=$this->session->get('as_mn_pid');
            
            $rows=$this->afterservice_model->getAfterserviceList($queryParams);
            $viewParams['row']=$rows[0];
            if(!$viewParams['row']['aa_pid']) return redirect()->to('/m/aservice/status_list'); 
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
            $viewParams['use_state']=array('11', '21', '41');

            // 처리완료 처리시 처리가능한 상태값
            $viewParams['use_result_state']=array('0317', '0315');
            // 처리완료 처리 상세사유
            $use_result_code=array();
            if($viewParams['row']['aa_result_state']) $use_result_code=$this->common_model->getCodeData(array('p_cd_code'=>$viewParams['row']['aa_result_state'], 'returnType'=>'pid'));
            $viewParams['use_result_code']=$use_result_code;

            $viewParams['productRows']=$this->product_model->findAll();
            
            $viewParams['setting']=$this->setting;
            $viewParams['fix_codes']=$this->fix_codes;
            $viewParams['session']=$this->session;
            $viewParams['return_url']='/m/aservice/status_list';
        }
        else {
            $view_file='m/as/status_list';
            if(!$viewParams['date_type']) $viewParams['date_type']='request_date';
            if(!$viewParams['sort']) $viewParams['sort']='desc';
        }

        $this->_mheader();
        $footParams['bottom_navi']=$this->setting['menus'][$this->uri->getSegment(2)]['sub'];
        $footParams['active_uri'] = $this->uri->getSegment(3);
        $footParams['default_uri'] = '/m/'.$this->uri->getSegment(2);
        echo view($view_file, $viewParams);
        echo view('m/_navi_footer', $footParams);
        $this->_mfooter();
    }
    
    function status_list_data() {
        $viewParams=$this->Params;
        $viewParams['search_as']=$this->session->get('as_mn_pid');
        $viewParams['search_state']='11';

        if(!$viewParams['date_type']) $viewParams['date_type']='request_date';
        if(!$viewParams['sort']) $viewParams['sort']='desc';
        

        $totCnt=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['page']=1;
        $rows=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;

        $listHtml = view('m/as/status_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
    }

    public function going_list($id='')
	{
        $viewParams=$this->Params;
        if($id) {
            $view_file='m/as/detail_form';
            $queryParams['date_type']='request_date';
            $queryParams['page']=1;
            $queryParams['ma_pid']=$id;
            $queryParams['search_as']=$this->session->get('as_mn_pid');
            
            $rows=$this->afterservice_model->getAfterserviceList($queryParams);
            $viewParams['row']=$rows[0];
            if(!$viewParams['row']['aa_pid']) return redirect()->to('/m/aservice/going_list'); 
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
            $viewParams['use_state']=array('11', '21', '31', '41');

            // 처리완료 처리시 처리가능한 상태값
            $viewParams['use_result_state']=array('0318', '0317', '0316');
            // 처리완료 처리 상세사유
            $use_result_code=array();
            if($viewParams['row']['aa_result_state']) $use_result_code=$this->common_model->getCodeData(array('p_cd_code'=>$viewParams['row']['aa_result_state'], 'returnType'=>'pid'));
            $viewParams['use_result_code']=$use_result_code;

            $viewParams['productRows']=$this->product_model->findAll();
            
            $viewParams['setting']=$this->setting;
            $viewParams['fix_codes']=$this->fix_codes;
            $viewParams['session']=$this->session;
            $viewParams['return_url']='/m/aservice/going_list';
        }
        else {
            $view_file='m/as/going_list';
            if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
            if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');
            if(!$viewParams['date_type']) $viewParams['date_type']='aa_visit_date';
            if(!$viewParams['sort']) $viewParams['sort']='asc';
        }

        $this->_mheader();
        $footParams['bottom_navi']=$this->setting['menus'][$this->uri->getSegment(2)]['sub'];
        $footParams['active_uri'] = $this->uri->getSegment(3);
        $footParams['default_uri'] = '/m/'.$this->uri->getSegment(2);
        echo view($view_file, $viewParams);
        echo view('m/_navi_footer', $footParams);
        $this->_mfooter();
    }
    
    function going_list_data() {
        $viewParams=$this->Params;
        $viewParams['search_as']=$this->session->get('as_mn_pid');
        $viewParams['search_state']='21';

        if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
        if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');
        if(!$viewParams['date_type']) $viewParams['date_type']='aa_visit_date';
        if(!$viewParams['sort']) $viewParams['sort']='asc';
        

        $totCnt=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['page']=1;
        $rows=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;

        $listHtml = view('m/as/going_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
    }

    public function progress_list($id='')
	{
        $viewParams=$this->Params;
        if($id) {
            $view_file='m/as/detail_form';
            $queryParams['date_type']='request_date';
            $queryParams['page']=1;
            $queryParams['ma_pid']=$id;
            $queryParams['search_as']=$this->session->get('as_mn_pid');
            
            $rows=$this->afterservice_model->getAfterserviceList($queryParams);
            $viewParams['row']=$rows[0];
            if(!$viewParams['row']['aa_pid']) return redirect()->to('/m/aservice/progress_list'); 
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
            $viewParams['use_state']=array('21', '31', '41');

            // 처리완료 처리시 처리가능한 상태값
            $viewParams['use_result_state']=array('0320', '0318', '0317', '0316');
            // 처리완료 처리 상세사유
            $use_result_code=array();
            if($viewParams['row']['aa_result_state']) $use_result_code=$this->common_model->getCodeData(array('p_cd_code'=>$viewParams['row']['aa_result_state'], 'returnType'=>'pid'));
            $viewParams['use_result_code']=$use_result_code;

            $viewParams['productRows']=$this->product_model->findAll();

            // AS기사 부품재고
            $viewParams['userStockParts']=$this->pcmanage_model->userStockPartList(array('mn_pid'=>$this->session->get('as_mn_pid')));
            
            $viewParams['setting']=$this->setting;
            $viewParams['fix_codes']=$this->fix_codes;
            $viewParams['session']=$this->session;
            $viewParams['return_url']='/m/aservice/progress_list';
            $viewParams['add_form_file']='detail_form_part_payment.php';

            // 부품정보
            $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true, $this->session->get('as_mn_pid'));
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
        }
        else {
            $view_file='m/as/progress_list';
            if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
            if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');
            if(!$viewParams['date_type']) $viewParams['date_type']='aa_visit_date';
            if(!$viewParams['sort']) $viewParams['sort']='asc';
        }

        $this->_mheader();
        $footParams['bottom_navi']=$this->setting['menus'][$this->uri->getSegment(2)]['sub'];
        $footParams['active_uri'] = $this->uri->getSegment(3);
        $footParams['default_uri'] = '/m/'.$this->uri->getSegment(2);
        echo view($view_file, $viewParams);
        echo view('m/_navi_footer', $footParams);
        $this->_mfooter();
    }
    
    function progress_list_data() {
        $viewParams=$this->Params;
        $viewParams['search_as']=$this->session->get('as_mn_pid');
        $viewParams['search_state']='31';

        if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
        if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');
        if(!$viewParams['date_type']) $viewParams['date_type']='aa_visit_date';
        if(!$viewParams['sort']) $viewParams['sort']='asc';
        

        $totCnt=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['page']=1;
        $rows=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;

        $listHtml = view('m/as/progress_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
    }

    public function complete_list($id='')
	{
        $viewParams=$this->Params;
        if($id) {
            $view_file='m/as/disposal_form';
            $queryParams['date_type']='request_date';
            $queryParams['page']=1;
            $queryParams['aa_pid']=$id;
            $queryParams['search_as']=$this->session->get('as_mn_pid');
            
            $rows=$this->afterservice_model->getAfterserviceList($queryParams);
            $viewParams['row']=$rows[0];

            $viewParams['aa_pid']=$id;
            // $viewParams['productRows']=$this->product_model->findAll();
            
            $viewParams['setting']=$this->setting;
            $viewParams['fix_codes']=$this->fix_codes;
            $viewParams['session']=$this->session;
            $viewParams['return_url']='/m/aservice/complete_list';

            //창고
            if(!$this->setting['code']['Storage']) $this->setting['code']['Storage'] = $this->common_model->getCodeData(array('p_cd_code'=>'0501', 'returnType'=>'pid'));

            // 부품정보
            $partRows=$this->pcmanage_model->getPartsList(array('page'=>1));
            $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'));
            $viewParams['partCategorysJS']=$partCategorysJS;
            $viewParams['partRows']=$partRows;
            // debug($partCategorysJS, $partRows);
            // exit;

            // 처리 부품목록
            $viewParams['assignPartList']=$this->assign_part_model->where('aa_pid', $id)->orderBy('ap_pid', 'desc')->findAll();
        }
        else {
            $view_file='m/as/complete_list';
            if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
            if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');
            if(!$viewParams['date_type']) $viewParams['date_type']='aa_result_date';
            if(!$viewParams['sort']) $viewParams['sort']='desc';
        }

        $viewParams['setting']=$this->setting;

        $this->_mheader();
        $footParams['bottom_navi']=$this->setting['menus'][$this->uri->getSegment(2)]['sub'];
        $footParams['active_uri'] = $this->uri->getSegment(3);
        $footParams['default_uri'] = '/m/'.$this->uri->getSegment(2);
        echo view($view_file, $viewParams);
        echo view('m/_navi_footer', $footParams);
        $this->_mfooter();
    }
    
    function complete_list_data() {
        $viewParams=$this->Params;
        $viewParams['search_as']=$this->session->get('as_mn_pid');
        $viewParams['search_state']='41';

        if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
        if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');
        if(!$viewParams['date_type']) $viewParams['date_type']='aa_result_date';
        if(!$viewParams['sort']) $viewParams['sort']='asc';
        

        $totCnt=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['page']=1;
        $rows=$this->afterservice_model->getAfterserviceList($viewParams);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;

        $listHtml = view('m/as/complete_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
    }

    
    //ajax용 처리
	function ajax_request() {
		if($this->Params['mode']=='get_code_data') {
            $code_data=$this->common_model->getCodeData(array('p_cd_code'=>$this->Params['code'], 'returnType'=>'pid'));
            
            echo json_encode($code_data);
        }
        else if($this->Params['mode']=='update_sign') { // 사인 업데이트
            $this->assign_as_model->update($this->Params['aa_pid'], array('aa_confirm_sign'=>$this->Params['sign']));
            echo 'ok';
        }
        else if($this->Params['mode']=='delete_sign_part') { // 부품삭제
            $this->assign_part_model->delete($this->Params['pid']);
            echo 'ok';
        }
        else if($this->Params['mode']=='delete_sign_thumb') { // 첨부파일 삭제
            $this->assign_thumbs_model->delete($this->Params['pid']);
            echo 'ok';
        }
    }

    function update_as() {
        $Scripts=array();
        $dataParams=$this->Params;
        // debug($dataParams);
        // exit;

        if(!$dataParams['ma_is_hurryup']) $dataParams['ma_is_hurryup']='N';
        if($dataParams['aa_state']=='21') {   // 방문예정
            if(!$dataParams['aa_visit_date'] || !$dataParams['visit_hour'] || !$dataParams['visit_min']) {
                jsExecute('parent.alertBox("방문일시를 입력해주세요.")');
                return false;
            }
            $dataParams['aa_visit_time']=$dataParams['visit_hour'].':'.$dataParams['visit_min'];
        }

        if($dataParams['aa_state']=='41') { // 처리완료
            if(!$dataParams['aa_result_state'] || !$dataParams['aa_result_code']) {
                jsExecute('parent.alertBox("처리 및 사유를 선택해주세요.")');
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
            $dataParams['aa_acount_num']=$dataParams['aa_acount_num'];
        }
        else if($dataParams['aa_payment_kind']=='B') {   // 무통장
            $dataParams['aa_payment_name']=$dataParams['bank_name'];
            $dataParams['aa_bank_acc']=$this->Params['aa_bank_acc'];
        }
        if($dataParams['aa_travel_price']) $dataParams['aa_travel_price']=str_replace(',', '', $dataParams['aa_travel_price']);
        if($dataParams['aa_total_price']) $dataParams['aa_total_price']=str_replace(',', '', $dataParams['aa_total_price']);

        // as신청 업데이트
        $this->member_as_model->transBegin();
        $this->member_as_model->update($dataParams['ma_pid'], $dataParams);


        // as방문(기사) 업데이트
        $this->assign_as_model->transBegin();
        $this->assign_as_model->update($dataParams['aa_pid'], $dataParams);

        
        // 로그
        $this->as_history_model->transBegin();
        $logData=array('aa_pid'=>$this->Params['aa_pid'], 'tah_state'=>$dataParams['aa_state'], 'tah_detail'=>$dataParams['aa_result_state'], 'tah_memo'=>serialize($datazParams), 'reg_id'=>$this->session->get('as_mn_pid'));
        $this->as_history_model->insert($logData);

        if($this->member_as_model->transStatus()===TRUE && $this->assign_as_model->transStatus()===TRUE && $this->as_history_model->transStatus()===TRUE) {
            $this->member_as_model->transCommit();
            $this->assign_as_model->transCommit();
            $this->as_history_model->transCommit();
        }
        else {
            $this->member_as_model->transRollback();
            $this->assign_as_model->transRollback();
            $this->as_history_model->transRollback();
            $Scripts[] = "parent.alertBox('Database Error!')";
            jsExecute($Scripts);
            exit;
        }

        // 첨부 이미지
        if($_FILES['files']) {
            foreach($_FILES['files']['name'] as $fi=>$file_name) {
                if(!$file_name) continue;
                $file_title="첨부파일";
                $upFile=getAWSFileName($file_name);
                if($upFile['err_msg']) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$upFile['err_msg'].")')";
                    jsExecute($Scripts);
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
            unset($counsel_row['mc_pid'], $member_as_row['ma_pid']);
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

        jsExecute('parent.alertBox("정상적으로 처리되었습니다.", parent.win_load, "'.$this->Params['return_url'].'")');

    }

    function reg_disposal_part() {
        // debug($this->Params);
        $dataParams=$this->Params;
        $dataParams['reg_id']=$this->session->get('as_mn_pid');
        if($dataParams['aa_pid']=='reg') {
            unset($dataParams['aa_pid']);
            if($dataParams['ma_code']) {
                $row=$this->member_as_model->select('*, (select aa_pid from tb_as_assign where tb_member_as.ma_pid=ma_pid) as aa_pid')->where('ma_code', $dataParams['ma_code'])->first();
                if($row['aa_pid']) $dataParams['aa_pid']=$row['aa_pid'];
                else {
                    jsExecute('parent.alertBox("입력한 AS접수번호가 존재하지 않습니다.")');
                    exit;
                }
            }
        }
        $insert_id=$this->part_disuse_model->insert($dataParams);

        // 처리 부품
        if($dataParams['part']) {
            $this->part_disuse_item_model->transStart();
            foreach($dataParams['part']['qty'] as $n_pt_pid=>$qty) {
                $partData=array(
                    'ds_pid'=>$insert_id
                    ,'pt_pid'=>$n_pt_pid
                    ,'pt_name'=>$dataParams['part']['name'][$n_pt_pid]
                    ,'di_qty'=>$qty
                    ,'di_store'=>$dataParams['part']['store'][$n_pt_pid]
                    ,'di_reason_code'=>$dataParams['part']['reason'][$n_pt_pid]
                );
                $partData['reg_id']=$this->session->get('as_mn_pid');
                $this->part_disuse_item_model->insert($partData);
            }
            $this->part_disuse_item_model->transComplete();
        }
        jsExecute('parent.alertBox("정상적으로 처리되었습니다.", parent.win_load, "'.$this->Params['return_url'].'")');
    }
}