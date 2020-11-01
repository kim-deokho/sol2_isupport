<?php namespace App\Controllers;

use App\Models\BasicModel;
use App\Models\ManagerModel;
use App\Models\AuthorModel;
use App\Models\PermainModel;
use App\Models\PersubModel;
use App\Models\PeraddModel;
use App\Models\CompanyModel;
use App\Models\TraderModel;
use App\Models\BoardModel;

use App\Libraries\Fileuploader;
use App\Libraries\Fixcodes;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Basic extends BaseController
{
    function __construct() {
        parent::init();
        $this->basic_model = new BasicModel();
        $this->manager_model = new ManagerModel();
        $this->permain_model = new PermainModel();
        $this->persub_model = new PersubModel();
        $this->peradd_model = new PeraddModel();
        $this->company_model = new CompanyModel();
        $this->board_model = new BoardModel();
        $this->fix_codes = new Fixcodes();
        
        //부서
        if(!$this->setting['code']['Departments']) $this->setting['code']['Departments']=$this->common_model->getCodeData(array('p_cd_code'=>'0101', 'returnType'=>'pid'));
        //직위
        if(!$this->setting['code']['Positions']) $this->setting['code']['Positions']=$this->common_model->getCodeData(array('p_cd_code'=>'0102', 'returnType'=>'pid'));
        //직책
        if(!$this->setting['code']['Dutys']) $this->setting['code']['Dutys']=$this->common_model->getCodeData(array('p_cd_code'=>'0103', 'returnType'=>'pid'));
        //업무
        if(!$this->setting['code']['Works']) $this->setting['code']['Works']=array('cs'=>'상담', 'delivery'=>'배송', 'as'=>'AS');
        //추가권한
        if(!$this->setting['code']['addPer']) $this->setting['code']['addPer']=array('item_pay'=>'상품결제', 'send_auth'=>'교환발송승인');
    }

	public function index()
	{
        $link=ManagerDefaultLink($this->session->get('menu'));
        return redirect()->to($link);
    }
    
    function manager_list() {    
        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
        $viewParams['permainRows']=$this->permain_model->findAll();
       
        $this->_header();
        echo view('basic/manager_list', $viewParams);
        $this->_footer();
    }

    function manager_list_data() {
        // debug($this->Params, $_GET, $_POST);
        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->basic_model->getManagerList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->basic_model->getManagerList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;
        $listHtml=view('basic/manager_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));

    }

    function manager_list_excel() {
        $this->Params['rcnt']=0;
        $this->Params['page']=1;
        $rows=$this->basic_model->getManagerList($this->Params);
        $datas=array();
        $totCnt = count($rows);
        if($totCnt<1) return;
        foreach($rows as $i=>$row) {
            $exp_work=explode(',', $row['mn_work']);
            $arr_work=array();
            foreach($exp_work as $w) {
                if(in_array($w, array_keys($this->setting['code']['Works']))) array_push($arr_work, $this->setting['code']['Works'][$w]);
            }
            $datas[$i]['no']=$totCnt--;
            $datas[$i]['department']=$this->setting['code']['Departments'][$row['mn_department']]['cd_name'];
            $datas[$i]['position']=$this->setting['code']['Positions'][$row['mn_position']]['cd_name'];
            $datas[$i]['duty']=$this->setting['code']['Dutys'][$row['mn_duty']]['cd_name'];
            $datas[$i]['m_no']=$row['mn_no'];
            $datas[$i]['m_name']=$row['mn_name'];
            $datas[$i]['m_tel']=setPhonePattern($row['mn_tel']);
            $datas[$i]['m_hp']=setPhonePattern($row['mn_hp']);
            $datas[$i]['m_id']=$row['mn_id'];
            $datas[$i]['m_work']=implode(',', $arr_work);
            $datas[$i]['m_email']=$row['mn_email'];
            $datas[$i]['m_in_date']=$row['mn_in_date'];
            $datas[$i]['m_out_date']=$row['mn_out_date'];
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'department',  '부서'),
            'C' => array(20, 'position', '직위'),
            'D' => array(20, 'duty', '직책'),
            'E' => array(20, 'm_no', '사원코드'),
            'F' => array(20, 'm_name', '이름'),
            'G' => array(20, 'm_tel', '전화'),
            'H' => array(20, 'm_hp', '휴대폰'),
            'I' => array(20, 'm_id', '아이디'),
            'J' => array(20, 'm_work', '업무'),
            'K' => array(20, 'm_email', '이메일'),
            'L' => array(20, 'm_in_date', '입사일'),
            'M' => array(20, 'm_out_date', '퇴사일')
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
                $sheet->setCellValue($key.$i, $row[$val[1]]);
            }
        }

        $filename = date('Ymd').'_'.get_cookie('pk_name').'_manager';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    function ajax_request() {
        if($this->Params['mode']=='get_manager') {  // 선택된 직원 정보가져오기
            $manager=$this->manager_model->find($this->Params['pid']);
            // debug($this->Params, $this->manager_model);
            echo json_encode($manager);
        }
        else if($this->Params['mode']=='get_permain') { // 선택된 상취 권한정보 가져오기
            $permain=$this->permain_model->find($this->Params['pid']);
            // debug($this->Params, $this->manager_model);
            echo json_encode($permain);
        }
        else if($this->Params['mode']=='get_permain_list') {    // 상위 권한리스트 가져오기
            $rows=$this->permain_model->findAll();
            $viewParams['rows']=$rows;
            echo view('basic/permain_list_frame', $viewParams);
        }
        else if($this->Params['mode']=='get_persub_list') { // 하위 권한리스트 가져오기
            $pRows=array();
            if($this->Params['p_pid']) {
                $rows=$this->persub_model->where('bn_pid', $this->Params['p_pid'])->findAll();
                foreach($rows as $row) $pRows[$row['mu_pid']]=$row;
            }
            $resMenu=$this->common_model->getManagerMenu();
            $viewParams['menuRows']=$resMenu['menu'];
            $viewParams['pRows']=$pRows;
            echo view('basic/persub_list_frame', $viewParams);
        }
        else if($this->Params['mode']=='get_code_sub_list') {   // 2차 코드 리스트 가져오기
            $rows=$this->common_model->getCodeData(array('where'=>array('p_cd_pid'=>$this->Params['p_pid'])));
            $viewParams['rows']=$rows;
            echo view('basic/code_sub_list_frame', $viewParams);
        }
        else if($this->Params['mode']=='get_sub_code') {    // 2차코드값 가져오기
            $rows=$this->common_model->getCodeData(array('where'=>array('cd_pid'=>$this->Params['cd_pid'])));
            echo json_encode($rows[0]);
        }
        else if($this->Params['mode']=='get_trader') {  // 선택된 거래처 정보가져오기
            $trader_model = new TraderModel();
            $trader=$trader_model->find($this->Params['pid']);
            // debug($this->Params, $this->manager_model);
            echo json_encode($trader);
        }
        else if($this->Params['mode']=='get_notice') {  // 공지사항 정보가져오기
            $notice=$this->board_model->find($this->Params['pid']);
            echo json_encode($notice);
        }
    }

    function execute() {
        if($this->Params['mode']=='reg_manager') {  // 직원등록
            $RegData=$this->Params;
            $Scripts=array();
            $managerRows=$this->manager_model->where(array('mn_id'=>$this->Params['mn_id'], 'mn_pid !='=>$this->Params['mn_pid']))->findAll();
            if(count($managerRows)>0) {
                $Scripts[]='parent.alertBoxFocus("이미 동일한 ID가 존재합니다.", parent.document.forms["regFrm"].mn_id)';
                jsExecute($Scripts);
                return;
            }
            $RegData['mn_work']=$RegData['mn_work_str'];
            $RegData['mn_add']=$RegData['mn_add_str'];
            if(!$this->Params['mn_out_date']) $RegData['mn_out_date']=null;
            $this->auth_model = new AuthorModel();
            if(!$this->Params['mn_pid']) {
                $RegData['mn_pw']=$this->auth_model->sql_password($this->Params['pwd']);
                $insert_id=$this->manager_model->insert($RegData);
                
                $upData=array('mn_no'=>$this->common_model->makeMnNo());
                $this->manager_model->update($insert_id, $upData);
            }
            else {
                unset($RegData['mn_pid']);
                if($this->Params['pwd_chg']=='Y' && $this->Params['pwd']) $RegData['mn_pw']=$this->auth_model->sql_password($this->Params['pwd']);
                $this->manager_model->update($this->Params['mn_pid'], $RegData);
            }
            jsExecute(array('parent.location.reload()'));
        }
        else if($this->Params['mode']=='reg_permain') { // 권한등록
            $RegData=$this->Params;
            $Scripts=array();
            $permainRows=$this->permain_model->where(array('bn_name'=>$this->Params['bn_name'], 'bn_pid !='=>$this->Params['bn_pid']))->findAll();
            if(count($permainRows)>0) {
                $Scripts[]='parent.alertBoxFocus("이미 동일한 권한명이 존재합니다.", parent.document.forms["regFrm"].bn_name)';
                jsExecute($Scripts);
                return;
            }
            $target_query_id='reg_id';
            if($this->Params['bn_pid']) $target_query_id='up_id';
            $RegData[$target_query_id]=$this->session->get('ss_mn_pid');
            $this->permain_model->save($RegData);
            jsExecute(array('parent.location.reload()'));
        }
        else if($this->Params['mode']=='reg_persub') {  // 권한의 상세 권한등록
            $resMenu=$this->common_model->getManagerMenu();
            $ChkPermition=$this->request->getPost('Per');
            foreach($resMenu['menu'] as $menu) {
                $existRow=array();
                foreach($menu['sub'] as $sub_menu) {
                    $data=array('bn_pid'=>$this->Params['bn_pid'], 'mu_pid'=>$sub_menu['pid'], 'ba_access'=>'N', 'ba_save'=>'N', 'ba_del'=>'N', 'ba_print'=>'N', 'ba_excel'=>'N');
                    
                    $existRow=$this->persub_model->where(array('bn_pid'=>$this->Params['bn_pid'], 'mu_pid'=>$sub_menu['pid']))->first();
                    
                    if(isset($ChkPermition[$sub_menu['pid']]['access'])) $data['ba_access']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['save'])) $data['ba_save']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['del'])) $data['ba_del']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['print'])) $data['ba_print']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['excel'])) $data['ba_excel']='Y';
                    // debug($data, $ChkPermition[$sub_menu['pid']]['access'], $sub_menu, $ChkPermition);
                    // exit;
                    
                    if($existRow['ba_pid']) {
                        if($data['ba_access']!=$exist['ba_access'] || $data['ba_save']!=$exist['ba_save'] || $data['ba_del']!=$exist['ba_del'] || $data['ba_print']!=$exist['ba_print'] || $data['ba_excel']!=$exist['ba_excel']) {
                            $data['up_id']=$this->session->get('ss_mn_pid');
                            $this->persub_model->update($existRow['ba_pid'], $data);
                        }
                    }
                    else {
                        $data['reg_id']=$this->session->get('ss_mn_pid');
                        $this->persub_model->insert($data);
                    }
                }
            }
            jsExecute(array('parent.gcUtil.loader("hide")', 'parent.alertBox("정상적으로 저장되었습니다.")'));
        }
        else if($this->Params['mode']=='reg_addper_manager') {  // 개별권한등록
            $resMenu=$this->common_model->getManagerMenu();
            $ChkPermition=$this->request->getPost('Per');
            foreach($resMenu['menu'] as $menu) {
                $existRow=array();
                foreach($menu['sub'] as $sub_menu) {
                    $data=array('mn_pid'=>$this->Params['mn_pid'], 'mu_pid'=>$sub_menu['pid'], 'aa_access'=>'N', 'aa_save'=>'N', 'aa_del'=>'N', 'aa_print'=>'N', 'aa_excel'=>'N');
                    
                    $existRow=$this->peradd_model->where(array('mn_pid'=>$this->Params['mn_pid'], 'mu_pid'=>$sub_menu['pid']))->first();
                    
                    if(isset($ChkPermition[$sub_menu['pid']]['access'])) $data['aa_access']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['save'])) $data['aa_save']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['del'])) $data['aa_del']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['print'])) $data['aa_print']='Y';
                    if(isset($ChkPermition[$sub_menu['pid']]['excel'])) $data['aa_excel']='Y';
                    // debug($data, $ChkPermition[$sub_menu['pid']]['access'], $sub_menu, $ChkPermition);
                    // exit;
                    
                    if($existRow['aa_pid']) {
                        if($data['aa_access']!=$exist['aa_access'] || $data['aa_save']!=$exist['aa_save'] || $data['aa_del']!=$exist['aa_del'] || $data['aa_print']!=$exist['aa_print'] || $data['aa_excel']!=$exist['aa_excel']) {
                            $data['up_id']=$this->session->get('ss_mn_pid');
                            $this->peradd_model->update($existRow['aa_pid'], $data);
                        }
                    }
                    else {
                        $data['reg_id']=$this->session->get('ss_mn_pid');
                        $this->peradd_model->insert($data);
                    }
                }
            }
            jsExecute(array('parent.gcUtil.loader("hide")', 'parent.alertBox("정상적으로 저장되었습니다.", parent.window.close)'));
        }
        else if($this->Params['mode']=='reg_company') { // 회사정보
            // ini_set('memory_limit','-1');
            $file_uploader = new Fileuploader();
            $dataParams=$this->Params;
            
            // 업체로고 이미지
            if($_FILES['file_com_logo']['name']) {
                $file_title="업체로고";
                $upFile=getAWSFileName($_FILES['file_com_logo']['name']);
                if($upFile['err_msg']) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$upFile['err_msg'].")', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
                $result=s3_upload($_FILES['file_com_logo']['tmp_name'],  $upFile['file']);
                // debug($upFile, $result);
                // exit;
                $dataParams['com_logo']=$upFile['file'];
            }

            // 업체도장이미지
            if($_FILES['file_com_seal']['name']) {
                $file_title="업체도장";
                $upFile=getAWSFileName($_FILES['file_com_seal']['name']);
                if($upFile['err_msg']) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$upFile['err_msg'].")', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
                $result=s3_upload($_FILES['file_com_seal']['tmp_name'],  $upFile['file']);
                $dataParams['com_seal']=$upFile['file'];
            }
            $target_query_id='reg_id';
            if($this->Params['com_pid']) $target_query_id='up_id';
            $dataParams[$target_query_id]=$this->session->get('ss_mn_pid');
            $this->company_model->save($dataParams);
            // debug($dataParams);
            $Scripts[] = "parent.alertBox('정상처리되었습니다.')";
            jsExecute($Scripts);
        }
        else if($this->Params['mode']=='reg_code') {    // 코드 관리 등록
            $Scripts=array();
            // debug($this->Params);
            // exit;
            if(!$this->Params['p_cd_pid']) {
                $Scripts[]='parent.alertBoxFocus("선택된 1차코드가 없습니다.")';
                jsExecute($Scripts);
                return;
            }
            $existRows=$this->common_model->getCodeData(array('where'=>array('cd_name'=>$this->Params['cd_name'], 'cd_pid !='=>$this->Params['cd_pid'])));
            if(count($existRows)>0) {
                $Scripts[]='parent.alertBoxFocus("이미 동일한 코드명이 존재합니다.", parent.document.forms["regFrm"].cd_name)';
                jsExecute($Scripts);
                return;
            }
            $this->Params['mn_pid']=$this->session->get('ss_mn_pid');
            if($this->Params['cd_pid']) {
                $this->common_model->UpdateCodeData($this->Params, array('cd_pid'=>$this->Params['cd_pid']));
                
            }
            else {
                $this->common_model->InsertCodeData($this->Params);
            }
            jsExecute(array('parent.setSubCodeList("'.$this->Params['p_cd_pid'].'")'));
        }
        else if($this->Params['mode']=='update_sub_code_order') {    // 코드 순서변경
            if(!$this->Params['ids']) exit('no_ids');
            $exp_ids=explode(',', $this->Params['ids']);
            $upData=array('mn_pid'=>$this->session->get('ss_mn_pid'));
            foreach($exp_ids as $i=>$id) {
                $upData['cd_order']=$i+1;
                $upWhere=array('cd_pid'=>$id);
                $this->common_model->UpdateCodeData($upData, $upWhere);
            }
            exit('ok');
        }
        if($this->Params['mode']=='reg_trader') {  // 거래처등록
            $trader_model = new TraderModel();
            $RegData=$this->Params;
            $Scripts=array();
            $isRow=$trader_model->where(array('ct_name'=>$this->Params['ct_name'], 'ct_pid !='=>$this->Params['ct_pid']))->first();
            if($isRow['ct_pid']) {
                $Scripts[]='parent.alertBoxFocus("이미 동일한 업체명 존재합니다.", parent.document.forms["regFrm"].ct_name)';
                jsExecute($Scripts);
                return;
            }
            if(!$this->Params['ct_out_date']) $RegData['ct_out_date']=null;
            if(!$this->Params['ct_pid']) {
                $RegData['ct_code']=$this->common_model->makeCtCode();
                $insert_id=$trader_model->insert($RegData);
            }
            else {
                unset($RegData['ct_pid']);
                $trader_model->update($this->Params['ct_pid'], $RegData);
            }
            jsExecute(array('parent.location.reload()'));
        }
        else if($this->Params['mode']=='reg_notice') {  // 공지등록/수정
            $dataParams=$this->Params;
            $dataParams['bd_notice']='Y';
            $row=array();
            if($this->Params['bd_pid']) {
                $row=$this->board_model->find($this->Params['bd_pid']);
                if($row['reg_id']!=$this->session->get('ss_mn_pid') && $row['bn_pid']!='1') {  //작성자 또는 최고관리자만 수정가능
                    $Scripts[] = "parent.alertBox('작성자 또는 최고관리자만 수정 가능합니다.', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
            }

            // 첨부파일1
            $is_file1_del=false;
            if($_FILES['file1']['name']) {
                $file_title="첨부파일1";
                $upFile=getAWSFileName($_FILES['file1']['name'], false);
                if($upFile['err_msg']) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$upFile['err_msg'].")', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
                $result=s3_upload($_FILES['file1']['tmp_name'],  $upFile['file']);
                $dataParams['bd_file1']=$upFile['file'];
                $dataParams['bd_org_file1']=$_FILES['file1']['name'];
                $is_file1_del=true;
            }
            else if($this->Params['file1_del']=='Y') {
                $dataParams['bd_file1']='';
                $dataParams['bd_org_file1']='';
                $is_file1_del=true;
            }

            // 첨부파일2
            $is_file2_del=false;
            if($_FILES['file2']['name']) {
                $file_title="첨부파일2";
                $upFile=getAWSFileName($_FILES['file2']['name'], false);
                if($upFile['err_msg']) {
                    $Scripts[] = "parent.alertBox('[".$file_title." 오류] 파일 업로드시 오류가 발생하였습니다.(".$upFile['err_msg'].")', parent.gcUtil.loader, 'hide')";
                    jsExecute($Scripts);
                    exit;
                }
                $result=s3_upload($_FILES['file2']['tmp_name'],  $upFile['file']);
                $dataParams['bd_file2']=$upFile['file'];
                $dataParams['bd_org_file2']=$_FILES['file2']['name'];
                $is_file2_del=true;
            }
            else if($this->Params['file2_del']=='Y') {
                $dataParams['bd_file2']='';
                $dataParams['bd_org_file2']='';
                $is_file2_del=true;
            }

            if($this->Params['bd_pid']) {   // 수정
                if($is_file1_del && $row['bd_file1']) s3_del($row['bd_file1']);
                if($is_file2_del && $row['bd_file2']) s3_del($row['bd_file2']);
                $dataParams['up_id']=$this->session->get('ss_mn_pid');
                $this->board_model->update($this->Params['bd_pid'], $dataParams);
            }
            else {  // 등록
                $dataParams['reg_id']=$this->session->get('ss_mn_pid');
                $this->board_model->insert($dataParams);
            }
            $Scripts[] = "parent.alertBox('정상처리되었습니다.', parent.location.reload())";
            jsExecute($Scripts);
        }
        else if($this->Params['mode']=='del_notice') {  // 공지삭제
            $result=array();
            $row=$this->board_model->find($this->Params['bd_pid']);
            if($row['reg_id']!=$this->session->get('ss_mn_pid') && $row['bn_pid']!='1') {  //작성자 또는 최고관리자만 삭제가능
                $result['err_msg'] = "작성자 또는 최고관리자만 삭제 가능합니다.";
            }
            else {
                $upData=array('bd_del'=>'Y', 'bd_del_date'=>date('Y-m-d H:i:s'));
                $this->board_model->update($this->Params['bd_pid'], $upData);
                $result['msg']="삭제되었습니다.";
            }
            echo json_encode($result);
        }
        
    }

    function company_form() {
        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
        $viewParams['row']=$this->company_model->orderBy('com_pid', 'desc')->first();

        $this->_header();
        echo view('basic/company_form', $viewParams);
        $this->_footer();
    }

    function permition_manage() {
        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;

        $this->_header();
        echo view('basic/permition_manage', $viewParams);
        $this->_footer();
    }

    function popPermitionAddForm($mn_pid='') {
        $resMenu=$this->common_model->getManagerMenu();
        $pRows=array();
        if($mn_pid) {
            $manager=$this->manager_model->find($mn_pid);
            $rows=$this->peradd_model->where('mn_pid', $mn_pid)->findAll();
            if(count($rows)<1) $rows=$this->persub_model->where('bn_pid', $manager['bn_pid'])->findAll();
            foreach($rows as $row) $pRows[$row['mu_pid']]=array('access'=>$row['aa_access']?$row['aa_access']:$row['ba_access'], 'save'=>$row['aa_save']?$row['aa_save']:$row['ba_save'], 'del'=>$row['aa_del']?$row['aa_del']:$row['ba_del'], 'print'=>$row['aa_print']?$row['aa_print']:$row['ba_print'], 'excel'=>$row['aa_excel']?$row['aa_excel']:$row['ba_excel']);
        }
        $viewParams['mn_pid']=$mn_pid;
        $viewParams['manager']=$manager;
        $viewParams['menuRows']=$resMenu['menu'];
        $viewParams['pRows']=$pRows;

        $this->_header('N');
        echo view('basic/popPermitionAddForm', $viewParams);
        $this->_footer('N');
    }

    function code_manage() {
        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
        $viewParams['mainCodes']=$this->common_model->getCodeData(array('where'=>array('p_cd_pid'=>0)));

        $this->_header();
        echo view('basic/code_manage', $viewParams);
        $this->_footer();
    }

    function trader_list() {    
        $viewParams=$this->Params;
        //매출처
        $this->setting['code']['OutKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0104', 'returnType'=>'pid'));
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;
       
        $this->_header();
        echo view('basic/trader_list', $viewParams);
        $this->_footer();
    }

    function trader_list_data() {
        // debug($this->Params, $_GET, $_POST);
        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->basic_model->getTraderList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->basic_model->getTraderList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        //매출처
        $this->setting['code']['OutKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0104', 'returnType'=>'pid'));
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;

        $listHtml=view('basic/trader_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));

    }

    function notice_list() {    
        $viewParams=$this->Params;
        $viewParams['sdate']=$this->Params['sdate']?$this->Params['sdate']:date('Y').'-01-01';
        $viewParams['edate']=$this->Params['edate']?$this->Params['edate']:date('Y-m-d');
        $viewParams['setting']=$this->setting;
       
        $this->_header();
        echo view('basic/notice_list', $viewParams);
        $this->_footer();
    }

    function notice_list_data() {
        // debug($this->Params, $_GET, $_POST);
        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->basic_model->getNoticeList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->basic_model->getNoticeList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;
        $listHtml=view('basic/notice_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
    }

    function notice_form() {
        $row=array();
        if($this->Params['pid']) $row=$this->board_model->find($this->Params['pid'])->first();
        $viewParams['row']=$row;
        $this->_header();
        echo view('basic/notice_form', $viewParams);
        $this->_footer();
    }

    function file_download() {
        $filepath=decryptURL($this->Params['filepath']);
        $filename=$this->Params['file_name'];
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: mime/type");
        header("Content-Transfer-Encoding: binary");
        // UPDATE: Add the below line to show file size during download.
        header('Content-Length: ' . filesize($filepath));

        readfile($filepath);
        exit;
    }

}
