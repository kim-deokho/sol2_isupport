<?php namespace App\Controllers;

use App\Models\BasicModel;
use App\Models\MbmanagerModel;
use App\Models\MemberModel;
use App\Models\TraderModel;
use App\Models\Counselmodel;



class Customer extends BaseController
{
    function __construct() {
        parent::init();
		$trader_model = new TraderModel();
		$this->basic_model = new BasicModel();
		$this->mbm_model = new MbmanagerModel();
		$this->member_model = new MemberModel();
		$this->counsel_model = new Counselmodel();


		// 매입처
        $this->setting['customer'] = $trader_model->where('ct_use', 'Y')->findAll();
		//가입경로
		if(!$this->setting['code']['Inroot']) $this->setting['code']['Inroot'] = $this->common_model->getCodeData(array('p_cd_code'=>'0301', 'returnType'=>'pid'));
		//전화종류
		if(!$this->setting['code']['Telkind1']) $this->setting['code']['Telkind1'] = $this->common_model->getCodeData(array('p_cd_code'=>'0310', 'returnType'=>'pid'));
		//상담종류
		if(!$this->setting['code']['Telkind2']) $this->setting['code']['Telkind2'] = $this->common_model->getCodeData(array('p_cd_code'=>'0311', 'returnType'=>'pid'));
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
				} else {
					$RegData['mb_info_agree_date'] = '';
					$RegData['mb_info_agree'] = 'N';
				}

				if($RegData['mb_sms_agree'] == 'Y' && $mdata['mb_sms_agree'] != 'Y') {
					$RegData['mb_sms_agree_date'] = date("Y-m-d H:i:s");
				} else {
					$RegData['mb_sms_agree_date'] = '';
					$RegData['mb_sms_agree'] = 'N';
				}

				if($RegData['mb_email_agree'] == 'Y' && $mdata['mb_email_agree'] != 'Y') {
					$RegData['mb_email_agree_date'] = date("Y-m-d H:i:s");
				} else {
					$RegData['mb_email_agree_date'] = '';
					$RegData['mb_email_agree'] = 'N';
				}

				if($RegData['mb_tel_agree'] == 'Y' && $mdata['mb_tel_agree'] != 'Y') {
					$RegData['mb_email_agree_date'] = date("Y-m-d H:i:s");
				} else {
					$RegData['mb_email_agree_date'] = '';
					$RegData['mb_tel_agree'] = 'N';
				}

				if($RegData['mb_dormant'] == 'Y' && $mdata['mb_dormant'] != 'Y') {
					$RegData['mb_dormant_date'] = date("Y-m-d H:i:s");
				} else {
					$RegData['mb_dormant_date'] = '';
					$RegData['mb_dormant'] = 'N';
				}

				if($RegData['mb_withdrawal'] == 'Y' && $mdata['mb_withdrawal'] != 'Y') {
					$RegData['mb_withdrawal_date'] = date("Y-m-d H:i:s");
				} else {
					$RegData['mb_withdrawal_date'] = '';
					$RegData['mb_withdrawal'] = 'N';
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
		}




		jsExecute($Scripts);
		exit;
	}

	//ajax용 처리
	function ajax_request() {
		if($this->Params['mode']=='serch_member') { //회원 검색 select option
			$this->Params['page'] = 1;
			$this->Params['rcnt'] = 0;
			$rows = $this->mbm_model->getmemberList($this->Params);
			$option = '<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>';
			foreach($rows as $row) {
				$option .= '<option value="'.$row['mb_pid'].'">'.$row['mb_code'].'|'.$row['mb_name'].'|'.$row['mb_tel1'].'|'.$row['mb_tel2'].'|'.$row['mb_addr'].' '.$row['mb_addr2'].'</option>';
			}
			echo $option;
		} else if($this->Params['mode']=='mem_sel') {
			$row = $this->mbm_model->getmemberList($this->Params);
			echo json_encode($row);
		} else if($this->Params['mode']=='coun_view') {
			$row = $this->mbm_model->getConsultingList($this->Params);
			echo json_encode($row);
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
}