<?php namespace App\Controllers;

use App\Models\BasicModel;
use App\Models\MbmanagerModel;
use App\Models\MemberModel;
use App\Models\TraderModel;
use App\Models\Counselmodel;
use App\Models\DeliveryModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Customer extends BaseController
{
    function __construct() {
        parent::init();
		$trader_model = new TraderModel();
		$this->basic_model = new BasicModel();
		$this->mbm_model = new MbmanagerModel();
		$this->member_model = new MemberModel();
		$this->counsel_model = new Counselmodel();
		$this->delivery_model = new DeliveryModel();


		// 매입처
        $this->setting['customer'] = $trader_model->where('ct_use', 'Y')->findAll();
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
			debug($this->delivery_model);
			$msg="정상적으로 적용되었습니다.";
			$Scripts[] = "parent.alertBox('".$msg."', parent.list_dely)";
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
			$option = '<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>';
			foreach($rows as $row) {
				$option .= '<option value="'.$row['mb_pid'].'">'.$row['mb_code'].'|'.$row['mb_name'].'|'.$row['mb_tel1'].'|'.$row['mb_tel2'].'|'.$row['mb_addr'].' '.$row['mb_addr2'].'</option>';
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
			$viewParams['rows'] = $rows;
			$listHtml=view('customer/delivery_data', $viewParams);
			 echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));
		}
	}

	public function member_manage()
	{
		$viewParams=$this->Params;

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

	public function after_service()
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
}