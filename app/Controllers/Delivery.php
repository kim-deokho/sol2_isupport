<?php namespace App\Controllers;

use App\Models\BasicModel;
use App\Models\ManagerModel;
use App\Models\AfterserviceModel;
use App\Models\AssignasModel;
use App\Models\AshistoryModel;

use App\Libraries\Fixcodes;

class Delivery extends BaseController
{
    function __construct() {
        parent::init();
        $this->basic_model = new BasicModel();
        $this->manager_model = new ManagerModel();
        $this->assign_as_model = new AssignasModel();
        $this->afterservice_model = new AfterserviceModel();
        $this->as_history_model = new AshistoryModel();
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
        
        $viewParams=$this->Params;
        $viewParams['sdate']=date('Y').'-01-01';
        $viewParams['edate']=date('Y-m-d');
        $viewParams['setting']=$this->setting;
        $viewParams['fix_codes']=$this->fix_codes;
        $viewParams['cs_manager']=$this->manager_model->like('mn_work', 'cs')->findAll();
        $viewParams['as_manager']=$this->manager_model->like('mn_work', 'as')->findAll();
        
       
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
}