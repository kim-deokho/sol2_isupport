<?php namespace App\Controllers;

use App\Models\BasicModel;
use App\Models\MbmanagerModel;
use App\Models\MemberModel;
use App\Models\TraderModel;
use App\Models\CounselModel;
use App\Models\DeliveryModel;
use App\Models\ProductModel;
use App\Models\PcmanageModel;
use App\Models\MemberasModel;
use App\Models\AssignasModel;
use App\Models\AshistoryModel;
use App\Models\PartModel;
use App\Models\AssignpartModel;
use App\Models\AssignthumbsModel;
use App\Models\PartdisuseModel;
use App\Models\PartdisuseitemModel;
use App\Models\ManagerModel;
use App\Models\AfterserviceModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Libraries\Fixcodes;

class Customer extends BaseController
{
    function __construct() {
        parent::init();
		$this->trader_model = new TraderModel();
		$this->basic_model = new BasicModel();
		$this->mbm_model = new MbmanagerModel();
		$this->member_model = new MemberModel();
		$this->counsel_model = new CounselModel();
		$this->delivery_model = new DeliveryModel();
        $this->product_model = new ProductModel();
        $this->pcmanage_model = new PcmanageModel();
        $this->member_as_model = new MemberasModel();
        $this->assign_as_model = new AssignasModel();
        $this->as_history_model = new AshistoryModel();
        $this->fix_codes = new Fixcodes();
        $this->part_model = new PartModel();
        $this->assign_part_model = new AssignpartModel();
        $this->assign_thumbs_model = new AssignthumbsModel();
        $this->part_disuse_model = new PartdisuseModel();
        $this->part_disuse_item_model = new PartdisuseitemModel();
        $this->manager_model = new ManagerModel();
        $this->afterservice_model = new AfterserviceModel();


		// 매입처
        $this->setting['customer'] = $this->trader_model->where('ct_use', 'Y')->findAll();
		//가입경로
		if(!$this->setting['code']['Inroot']) $this->setting['code']['Inroot'] = $this->common_model->getCodeData(array('p_cd_code'=>'0301', 'returnType'=>'pid'));
		//전화종류
		if(!$this->setting['code']['Counkind1']) $this->setting['code']['Counkind1'] = $this->common_model->getCodeData(array('p_cd_code'=>'0310', 'returnType'=>'pid'));
		//상담종류
		if(!$this->setting['code']['Counkind2']) $this->setting['code']['Counkind2'] = $this->common_model->getCodeData(array('p_cd_code'=>'0311', 'returnType'=>'pid'));
		//상담처리
		$this->setting['code']['Counkind3'] = array("A"=>"미처리","B"=>"처리중","C"=>"처리완료") ;
		//직원
		if(!$this->setting['manager']) $this->setting['manager'] = $this->getManagerList();
    }

	public function index()
	{
        return redirect()->to('/customer/member_manage');
    }

	function getManagerList() {
		$options['page'] = 1;
		$options['rcnt'] = 0;
		$rows = $this->basic_model->getManagerList($options);
		foreach($rows as $row) {
			$data[$row['mn_pid']] = $row;
		}

		return $data;
	}

	//실행 모듈 모음
	function execute($remode='') {
		if($this->Params['mode'] == 'reg_member') {
			$RegData = $this->Params;
			$msg="정상적으로 등록되었습니다.";

			if(!$this->Params['mb_pid']) {
				$rows = $this->member_model->selectMax('mb_code')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];

				if($rows == ""){
					$sn = "0001";
				} else {
					$sn = (int)$rows['mb_code'] +1 ;
					$sn = getSerial($sn,4);
				}

				$RegData['mb_code'] = "CU".date('Ymd')."-".$sn;

				if($RegData['mb_info_agree'] == 'Y') {
					$RegData['mb_info_agree_date'] = date("Y-m-d H:i:s");
				}

				if($RegData['mb_sms_agree'] == 'Y') {
					$RegData['mb_sms_agree_date'] = date("Y-m-d H:i:s");
				}

				if($RegData['mb_email_agree'] == 'Y') {
					$RegData['mb_email_agree_date'] = date("Y-m-d H:i:s");
				}

				if($RegData['mb_tel_agree'] == 'Y') {
					$RegData['mb_tel_agree_date'] = date("Y-m-d H:i:s");
				}

				$RegData['reg_id'] = $this->session->get('ss_mn_pid');
				$insert_id=$this->member_model->insert($RegData);

				$Scripts[] = "parent.alertBox('".$msg."', parent.win_load)";
			}
			else {
				$mdata = $this->member_model->find($this->Params['mb_pid']);

				if($RegData['mb_info_agree'] == 'Y' && $mdata['mb_info_agree'] != 'Y') {
					$RegData['mb_info_agree_date'] = date("Y-m-d H:i:s");
				} else if($RegData['mb_info_agree'] != 'Y'){
					$RegData['mb_info_agree_date'] = '';
					$RegData['mb_info_agree'] = 'N';
				} else {
					unset($RegData['mb_info_agree_date']);
					unset($RegData['mb_info_agree']);
				}

				if($RegData['mb_sms_agree'] == 'Y' && $mdata['mb_sms_agree'] != 'Y') {
					$RegData['mb_sms_agree_date'] = date("Y-m-d H:i:s");
				} else if($RegData['mb_sms_agree'] != 'Y'){
					$RegData['mb_sms_agree_date'] = '';
					$RegData['mb_sms_agree'] = 'N';
				} else {
					unset($RegData['mb_sms_agree_date']);
					unset($RegData['mb_sms_agree']);
				}

				if($RegData['mb_email_agree'] == 'Y' && $mdata['mb_email_agree'] != 'Y') {
					$RegData['mb_email_agree_date'] = date("Y-m-d H:i:s");
				} else if($RegData['mb_email_agree'] != 'Y'){
					$RegData['mb_email_agree_date'] = '';
					$RegData['mb_email_agree'] = 'N';
				} else {
					unset($RegData['mb_email_agree_date']);
					unset($RegData['mb_email_agree']);
				}

				if($RegData['mb_tel_agree'] == 'Y' && $mdata['mb_tel_agree'] != 'Y') {
					$RegData['mb_email_agree_date'] = date("Y-m-d H:i:s");
				} else if($RegData['mb_tel_agree'] != 'Y'){
					$RegData['mb_email_agree_date'] = '';
					$RegData['mb_tel_agree'] = 'N';
				} else {
					unset($RegData['mb_email_agree_date']);
					unset($RegData['mb_tel_agree']);
				}

				if($RegData['mb_dormant'] == 'Y' && $mdata['mb_dormant'] != 'Y') {
					$RegData['mb_dormant_date'] = date("Y-m-d H:i:s");
				} else if($RegData['mb_dormant'] != 'Y'){
					$RegData['mb_dormant_date'] = '';
					$RegData['mb_dormant'] = 'N';
				} else {
					unset($RegData['mb_dormant_date']);
					unset($RegData['mb_dormant']);
				}

				if($RegData['mb_withdrawal'] == 'Y' && $mdata['mb_withdrawal'] != 'Y') {
					$RegData['mb_withdrawal_date'] = date("Y-m-d H:i:s");
				} else if($RegData['mb_withdrawal'] != 'Y'){
					$RegData['mb_withdrawal_date'] = '';
					$RegData['mb_withdrawal'] = 'N';
				} else {
					unset($RegData['mb_withdrawal_date']);
					unset($RegData['mb_withdrawal']);
				}

				$RegData['up_id'] = $this->session->get('ss_mn_pid');
				$this->member_model->update($this->Params['mb_pid'], $RegData);
//debug($this->member_model);
				$Scripts[] = "parent.alertBox('".$msg."', parent.change_mem)";
			}

		} else if($this->Params['mode'] == 'dormant_change') {
			$RegData['mb_dormant'] = 'N';
			$RegData['mb_dormant_date'] = '';
			$RegData['up_id'] = $this->session->get('ss_mn_pid');
			$this->member_model->update($this->Params['mb_pid'], $RegData);

			$msg = "휴면계정이 복구 되었습니다.";

			$Scripts[] = "parent.alertBox('".$msg."', parent.change_mem)";
		}else if($this->Params['mode'] == 'reg_cuon') {
			$RegData = $this->Params;
			$msg="정상적으로 등록되었습니다.";

			if(!$this->Params['mc_pid']) {
				$rows = $this->counsel_model->selectMax('mc_code')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];
				if($rows == ""){
					$sn = "0001";
				} else {
					$sn = (int)$rows['mc_code'] +1 ;
					$sn = getSerial($sn,4);
				}

				$RegData['mc_code'] = "CS".date('Ymd')."-".$sn;
				$RegData['reg_id'] = $this->session->get('ss_mn_pid');
				$insert_id=$this->counsel_model->insert($RegData);

			} else {
				$insert_id=$this->counsel_model->update($this->Params['mc_pid'], $RegData);
			}

			if($this->Params['mode2'] == 'pop') {
				$Scripts[] = "parent.alertBox('".$msg."', parent.pop_sendSearch)";
			} else {
				$Scripts[] = "parent.alertBox('".$msg."', parent.change_mem)";
			}
		}else if($this->Params['mode'] == 'reg_dely') {
			$RegData = $this->Params;
			$msg="정상적으로 등록되었습니다.";

			if(!$this->Params['dy_pid']) {
				$RegData['reg_id'] = $this->session->get('ss_mn_pid');
				$insert_id=$this->delivery_model->insert($RegData);

			} else {
				$RegData['up_id'] = $this->session->get('ss_mn_pid');
				$insert_id=$this->delivery_model->update($this->Params['dy_pid'], $RegData);
			}


			$Scripts[] = "parent.alertBox('".$msg."', parent.list_dely)";

		} else if($this->Params['mode'] == 'del_dely') {
			$RegData['dy_del'] = 'Y';
			$RegData['up_id'] = $this->session->get('ss_mn_pid');
			$this->delivery_model->update($this->Params['dy_pid'], $RegData);
			$msg="정상적으로 삭제되었습니다.";
			$Scripts[] = "parent.alertBox('".$msg."', parent.list_dely)";
		} else if($this->Params['mode'] == 'basic_dely') {
			$RegData['dy_basic'] = 'N';
			$RegData['up_id'] = $this->session->get('ss_mn_pid');
			$rows = $this->delivery_model->select('dy_pid')->where('mb_pid',$this->Params['mb_pid'])->findAll();
			foreach($rows as $row) {
				$pid[] = $row['dy_pid'];
			}
			$this->delivery_model->update($pid ,$RegData);

			$RegData['dy_basic'] = 'Y';
			$RegData['up_id'] = $this->session->get('ss_mn_pid');
			$this->delivery_model->update($this->Params['dy_pid'], $RegData);

			$msg="정상적으로 적용되었습니다.";
			$Scripts[] = "parent.alertBox('".$msg."', parent.list_dely)";
        }
        else if($this->Params['mode']=='add_member_as') {
            $RegData=$this->Params;
            //상담접수
            if(!$this->Params['mc_pid']) {
                $rows = $this->counsel_model->selectMax('mc_code')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];
                
                if($rows == ""){
                    $sn = "0001";
                } else {
                    $sn = (int)$rows['mc_code'] +1 ;
                    $sn = getSerial($sn,4);
                }

                $RegData['mc_code'] = "CS".date('Ymd')."-".$sn;
                $RegData['reg_id'] = $this->session->get('ss_mn_pid');
                $insert_id=$this->counsel_model->insert($RegData);  
                $RegData['mc_pid']=$insert_id;
            }
            else {
				$this->counsel_model->update($this->Params['mc_pid'], $RegData);
			}

            // AS접수
            if(!$this->Params['ma_pid']) {
                $rows = $this->member_as_model->selectMax('ma_code')->where('left(reg_date, 10)', date("Y-m-d"))->find()[0];
                
                if($rows == ""){
                    $sn = "0001";
                } else {
                    $sn = (int)$rows['ma_code'] +1 ;
                    $sn = getSerial($sn,4);
                }
                $RegData['ma_code'] = "AS".date('Ymd')."-".$sn;
                $as_insert_id=$this->member_as_model->insert($RegData);  //회원 AS접수

                // 기사 AS접수
                $RegData['ma_pid']=$as_insert_id;
                $aa_insert_id=$this->assign_as_model->insert($RegData);

                // 로그
                $logState='01';
                $logData=array('aa_pid'=>$aa_insert_id, 'tah_state'=>$logState, 'tah_memo'=>$this->fix_codes->AsState[$logState], 'reg_id'=>$this->session->get('ss_mn_pid'));
                $this->as_history_model->insert($logData);
            }
            else {
				$this->member_as_model->update($this->Params['ma_pid'], $RegData);
            }
            $msg="정상적으로 처리되었습니다.";
            $Scripts[] = "parent.alertBox('".$msg."', parent.regAsComplete)";

        }
        else if($this->Params['mode']=='update_as_cancel') {
            $this->assign_as_model->transBegin();
            $exp_pid=explode(',', $this->Params['pids']);
            $upData=$this->Params;
            $upData['up_id']=$this->session->get('ss_mn_pid');
            $this->assign_as_model->update($exp_pid, $upData);

            // 로그
            $this->as_history_model->transBegin();
            foreach($exp_pid as $aa_pid) {
                $logState=$this->Params['aa_result_state'];
                $logData=array('aa_pid'=>$aa_pid, 'tah_state'=>$this->Params['aa_state'], 'tah_detail'=>$this->Params['aa_result_state'], 'tah_memo'=>$this->Params['aa_result_reason'], 'reg_id'=>$this->session->get('ss_mn_pid'));
                $this->as_history_model->insert($logData);
            }
            if ($this->assign_as_model->transStatus() === FALSE || $this->as_history_model->transStatus() === FALSE) {
                $this->assign_as_model->transRollback();
                $this->as_history_model->transRollback();
                $msg="처리 오류 발생";
            }
            else {
                $this->assign_as_model->transCommit();
                $this->as_history_model->transCommit();
                $msg="정상처리되었습니다.";
            }
            $Scripts[] = "parent.alertBox('".$msg."', parent.win_load, 'href')";

        }
		jsExecute($Scripts);
		exit;
	}

	//ajax용 처리
	function ajax_request() {
		if($this->Params['mode']=='serch_member') { //회원 검색 select option
			$this->Params['page'] = 1;
			$this->Params['rcnt'] = 0;
			$rows = $this->mbm_model->getMemberList($this->Params);
			if($this->Params['mode2']=='table') {
				$option = '';
			} else {
				$option = '<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>';
			}
			foreach($rows as $row) {
				if($this->Params['mode2']=='table') {
					$option .= '<tr onclick="cus_click(\''.$row['mb_pid'].'\',\''.$row['mb_name'].'\')"><td>'.$row['mb_code'].'</td><td>'.$row['mb_name'].'</td><td>'.$row['mb_tel1'].'</td></tr>';
				} else {
					$option .= '<option value="'.$row['mb_pid'].'">'.$row['mb_code'].'|'.$row['mb_name'].'|'.$row['mb_tel1'].'|'.$row['mb_tel2'].'|'.$row['mb_addr'].' '.$row['mb_addr2'].'</option>';
				}
			}
			echo $option;
		} else if($this->Params['mode']=='mem_sel') {
			$row = $this->mbm_model->getMemberList($this->Params);
			echo json_encode($row);
		} else if($this->Params['mode']=='coun_view') {
			$row = $this->mbm_model->getConsultingList($this->Params);
			echo json_encode($row);
		} else if($this->Params['mode']=='dely_list') {
            $rows = $this->delivery_model->where("mb_pid",$this->Params['mb_pid'])->where('dy_del', 'N')->findAll();
            $viewParams=$this->Params;
			$viewParams['rows'] = $rows;
			$listHtml=view('customer/delivery_data', $viewParams);
			 echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
		}
	}

	public function member_manage()
	{
        //AS부위
        if(!$this->setting['code']['AsPart']) $this->setting['code']['AsPart']=$this->common_model->getCodeData(array('p_cd_code'=>'0312'));
        //AS증상
        if(!$this->setting['code']['AsSymptom']) $this->setting['code']['AsSymptom']=$this->common_model->getCodeData(array('p_cd_code'=>'0313'));
        //AS구분
        if(!$this->setting['code']['AsKind']) $this->setting['code']['AsKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0314'));

        $viewParams=$this->Params;
        $viewParams['productRows']=$this->product_model->findAll();
        $viewParams['categorys']=$this->pcmanage_model->getCategorys(array('type'=>'pid'));
        $viewParams['setting']=$this->setting;

        $this->_header();
        echo view('customer/member_manage', $viewParams);
        $this->_footer();
	}

	public function consulting()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/consulting', $viewParams);
        $this->_footer();
	}

	public function consulting_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
        $viewParams=$this->Params;
        $rows=$this->mbm_model->getConsultingList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->mbm_model->getConsultingList($this->Params);
		$viewParams['setting'] = $this->setting;
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->io_state;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);

		if($this->Params['mode'] == 'pop') {
			$uri = 'pop_coun_his_data';
		} else {
			$uri = 'consulting_data';
		}

        $listHtml=view('customer/'.$uri, $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function consulting_excel()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
        $viewParams=$this->Params;
        $rows=$this->mbm_model->getConsultingList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->mbm_model->getConsultingList($this->Params);

		foreach($rows as $i=>$row) {


            $datas[$i]['no']=$totCnt--;
            $datas[$i]['mc_kind1']=$this->setting['code']['Counkind1'][$row['mc_kind1']]['cd_name'];
            $datas[$i]['mc_kind2']=$this->setting['code']['Counkind2'][$row['mc_kind2']]['cd_name'];
            $datas[$i]['mc_kind3']=$this->setting['code']['Counkind3'][$row['mc_kind3']];
            $datas[$i]['mc_contents']=$row['mc_contents'];
            $datas[$i]['mb_code']=$row['mb_code'];
            $datas[$i]['mb_name']=$row['mb_name'];
            $datas[$i]['mc_tel']=$row['mc_tel'];
            $datas[$i]['reg_name']=$row['reg_name'];
            $datas[$i]['reg_date']= $row['reg_date'];
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(15, 'reg_date',  '상담일시'),
            'C' => array(50, 'mc_kind1', '인/아웃'),
            'D' => array(30, 'mc_kind2', '상담종류'),
            'E' => array(50, 'mc_contents', '상담내용'),
            'F' => array(15, 'mb_code', '고객코드'),
            'G' => array(15, 'mb_name', '이름'),
            'H' => array(15, 'mc_tel', '전화번호'),
            'I' => array(15, 'mc_kind3', '처리상태'),
            'J' => array(15, 'reg_name', '상담자')
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

        $filename = date('Ymd').'_consulting_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
	}

	public function cancel()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/cancel', $viewParams);
        $this->_footer();
	}

	public function return_exchange()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/return_exchange', $viewParams);
        $this->_footer();
	}

	public function _as_list()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/after_service', $viewParams);
        $this->_footer();
	}

	public function savings()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/savings', $viewParams);
        $this->_footer();
	}

	public function gift_card()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/gift_card', $viewParams);
        $this->_footer();
	}

	public function deposit()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/deposit', $viewParams);
        $this->_footer();
	}

	public function member_status()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('customer/member_status', $viewParams);
        $this->_footer();
	}

	public function member_status_data()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
        $viewParams=$this->Params;
        $rows=$this->mbm_model->getMemberList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->mbm_model->getMemberList($this->Params);
		$viewParams['setting'] = $this->setting;
        $viewParams['totCnt'] = $totCnt;
        $viewParams['rows'] = $rows;
		$viewParams['state'] = $this->io_state;

        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);

		if($this->Params['mode'] == 'pop') {
			$uri = 'pop_coun_his_data';
		} else {
			$uri = 'consulting_data';
		}

        $listHtml=view('customer/member_status_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
	}

	public function member_status_excel()
	{
		$this->Params['rcnt'] = $this->paging_rcnt;
		$this->Params['page'] = $this->Params['page'] ? $this->Params['page'] : 1;
        $viewParams=$this->Params;
        $rows=$this->mbm_model->getMemberList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->mbm_model->getMemberList($this->Params);
		foreach($rows as $i=>$row) {
			$tmp = explode('|', $row['mb_last_tel']);

			$agree  = array();
			if($row['mb_info_agree'] == 'Y') {
				$agree[] = '개인정보';
			}

			if($row['mb_sms_agree'] == 'Y') {
				$agree[] = '문자';
			}

			if($row['mb_email_agree'] == 'Y') {
				$agree[] = '이메일';
			}

			if($row['mb_tel_agree'] == 'Y') {
				$agree[] = '전화';
			}

			$bigo = '';
			if($row['mb_dormant'] == 'Y') {
				$bigo = '휴면('.$row['mb_dormant_date'].')';
			}

			if($row['mb_withdrawal'] == 'Y') {
				$bigo = '탈퇴('.$row['mb_withdrawal_date'].')';
			}


            $datas[$i]['no']=$totCnt--;
			$datas[$i]['mb_code']=$row['mb_code'];
            $datas[$i]['mb_name']=$row['mb_name'];
			$datas[$i]['reg_date']= $row['reg_date'];
			$datas[$i]['mb_last_order_date']= $row['mb_last_order_date'];
			$datas[$i]['mb_last_tel_date']= $tmp['0'];
			$datas[$i]['mb_last_tel_kind']= $tmp['1'];
			$datas[$i]['mb_level']= $row['mb_level'];
			$datas[$i]['mb_kind']= $row['mb_kind']  == 'A' ? '일반':'기업';
			$datas[$i]['dam_name']= $row['dam_name'];
			$datas[$i]['mb_order_cnt']= number_format($row['mb_order_cnt']);
			$datas[$i]['mb_order_price']= number_format($row['mb_order_price']);
			$datas[$i]['mb_account_price']= number_format($row['mb_account_price']);
			$datas[$i]['misu']= number_format($row['mb_order_price']-$row['mb_account_price']);
			$datas[$i]['mb_point']= number_format($row['mb_point']);
			$datas[$i]['mb_gift']= number_format($row['mb_gift']);
			$datas[$i]['mb_deposit']= number_format($row['mb_deposit']);
			$datas[$i]['mb_in_root']=$this->setting['code']['Inroot'][$row['mb_in_root']]['cd_name'];
			$datas[$i]['mb_email']= $row['mb_email'];
			$datas[$i]['mb_birthday']= $row['mb_birthday'];
			$datas[$i]['agree']= implode(',',$agree);
            $datas[$i]['mb_tel1']= $row['mb_tel1'];
			$datas[$i]['mb_tel2']= $row['mb_tel2'];
			$datas[$i]['mb_post']= $row['mb_post'];
			$datas[$i]['mb_addr']= $row['mb_addr'];
			$datas[$i]['mb_addr2']= $row['mb_addr2'];
			$datas[$i]['bigo']= $bigo;
        }

        $cells = array(
            'A' => array(15, 'no', 'No'),
            'B' => array(20, 'mb_code',  '고객코드'),
            'C' => array(20, 'mb_name', '고객명'),
            'D' => array(15, 'reg_date', '가입일'),
            'E' => array(15, 'mb_last_order_date', '최종주문일'),
            'F' => array(15, 'mb_last_tel_date', '최종토화일'),
            'G' => array(15, 'mb_last_tel_kind', '최종통화구분'),
            'H' => array(15, 'mb_level', '회원등급'),
            'I' => array(15, 'mb_kind', '회원구분'),
            'J' => array(15, 'dam_name', '담당자'),
            'K' => array(15, 'mb_order_cnt', '주문건수'),
            'L' => array(15, 'mb_order_price', '결제금액'),
            'M' => array(15, 'mb_account_price', '입금금액'),
            'N' => array(15, 'misu', '미수금'),
            'O' => array(15, 'mb_point', '적립금'),
            'P' => array(15, 'mb_gift', '상품권'),
            'Q' => array(15, 'mb_deposit', '예치금'),
            'R' => array(15, 'mb_in_root', '가입경로'),
            'S' => array(15, 'mb_email', '이메일'),
            'T' => array(15, 'mb_birthday', '생년월일'),
            'U' => array(15, 'agree', '수신동의'),
            'V' => array(15, 'mb_tel1', '전화1'),
            'W' => array(15, 'mb_tel2', '전화2'),
            'X' => array(15, 'mb_post', '우편번호'),
            'Y' => array(35, 'mb_addr', '주소'),
            'Z' => array(25, 'mb_addr2', '상세주소'),
            'AA' => array(15, 'bigo', '탈퇴여부')
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

        $filename = date('Ymd').'_member_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
    
    public function as_list()
	{
        //AS구분
        if(!$this->setting['code']['AsKind']) $this->setting['code']['AsKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0314'));

        //AS취소사유
        if(!$this->setting['code']['AsCancelType']) $this->setting['code']['AsCancelType']=$this->common_model->getCodeData(array('p_cd_code'=>'0315', 'returnType'=>'pid'));

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

        // 부품정보
        $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true);
        $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'), $partRows);
        $viewParams['partCategorysJS']=$partCategorysJS;
        $viewParams['partRows']=$partRows;
       
        $this->_header();
        echo view('customer/as_list', $viewParams);
        $this->_footer();
    }
    
    function as_list_data() {
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
        $listHtml=view('customer/as_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
    }

    function as_list_excel() {
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
            $datas[$i]['buy_com']='구매처';

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
            $datas[$i]['result_reason']=$row['aa_result_reason'];
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
            'P' => array(30, 'result_reason', '취소/미처리 사유'),
            'Q' => array(15, 'product_name', '상품'),
            'R' => array(15, 'ma_part', '부위'),
            'S' => array(15, 'ma_symptom', '증상')
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

        $filename = date('Ymd').'_as_list';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
        
    }
}