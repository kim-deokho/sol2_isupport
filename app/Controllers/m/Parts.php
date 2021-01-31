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

use App\Models\StockModel;
use App\Models\StockMainModel;
use App\Models\StockPartRequestModel;
use App\Models\StockPartRequestItemModel;


use App\Libraries\Fixcodes;

class Parts extends \App\Controllers\BaseController
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

        $this->stock_model = new StockModel();
        $this->stock_main_model = new StockMainModel();
        $this->part_request_model = new StockPartRequestModel();
        $this->part_request_item_model = new StockPartRequestItemModel();

        //창고
        if(!$this->setting['code']['Storage']) $this->setting['code']['Storage'] = $this->common_model->getCodeData(array('p_cd_code'=>'0501', 'returnType'=>'pid'));
        // 부품요청상태
        $this->setting['code']['pi_state'] =  Array("A" => "요청","B" => "완료","C" => "취소");
        $this->setting['code']['pi_kind'] =  Array("A" => "출고","B" => "반입");

    }

	public function index()
	{
        return redirect()->to('/m/parts/status_list');
    }

	public function status_list()
	{
        $viewParams=$this->Params;
        $view_file='m/parts/status_list';
        $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true);
        $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'), $partRows);

        $viewParams['partRows']=$partRows;
        $viewParams['partCategorysJS']=$partCategorysJS;

        $this->_mheader();
        $footParams['bottom_navi']=$this->setting['menus'][$this->uri->getSegment(2)]['sub'];
        $footParams['active_uri'] = $this->uri->getSegment(3);
        $footParams['default_uri'] = '/m/'.$this->uri->getSegment(2);
        echo view($view_file, $viewParams);
        echo view('m/_navi_footer', $footParams);
        $this->_mfooter();
    }
    
    function status_list_data() {
        $viewParams=$queryParams=$this->Params;
        $queryParams['mn_pid']=$this->session->get('as_mn_pid');
        $rows=$this->pcmanage_model->userStockPartList($queryParams);
        $totCnt=count($rows);

        $viewParams['partCategorysData']=$this->pcmanage_model->getPartCategorys(array('type'=>'pid'));
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;

        $listHtml = view('m/parts/status_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
    }

    public function request_list($pi_pid='')
	{
        $viewParams=$this->Params;
        if($pi_pid) {
            $view_file='m/parts/request_form';
            if($pi_pid!='reg') {
                $row = $this->part_request_model->select('*, (select mn_name from tb_manager where mn_pid=tb_part_inout.pi_confirm_mn_pid) confirm_name')->find($pi_pid);
                $rowParts=$this->part_request_item_model->where(array('pi_pid'=>$pi_pid, 'ii_del'=>'N'))->findAll();
            }
            else {
                $row = array('reg_date'=>date('Y-m-d'), 'pi_kind'=>'A');
                $rowParts=array();
            }
            // debug($row);
            // exit;
            
            // 현재고 체크를 위해
            $stockRows=$this->stock_main_model->where(array('st_kind'=>'B', 'st_del'=>'N'))->findAll();
            foreach($stockRows as $stock) $stockRows[$stock['pd_pid']]=$stock;

            $partRows=$this->pcmanage_model->getPartsList(array('page'=>1), true);
            $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'), $partRows);
            // debug($rowParts, $partRows);
            // exit;

            
            $viewParams['setting']=$this->setting;
            $viewParams['fix_codes']=$this->fix_codes;
            $viewParams['session']=$this->session;
            $viewParams['row'] = $row;
            $viewParams['rowParts'] = $rowParts;
            $viewParams['partRows']=$partRows;
            $viewParams['stockRows']=$stockRows;
            $viewParams['partCategorysJS']=$partCategorysJS;
            $viewParams['return_url']='/m/parts/request_list';
            $viewParams['pi_pid']=$pi_pid;
        }
        else {
            if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
            if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');

            $view_file='m/parts/request_list';
            $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'));

            $viewParams['partCategorysJS'] = $partCategorysJS;

            if(!$viewParams['date_type']) $viewParams['date_type']='reg_date';
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

	public function request_list_data()
	{
        $viewParams=$queryParams=$this->Params;
        $queryParams['searchMn']=$this->session->get('as_mn_pid');
        $queryParams['searchSdate']=$viewParams['sdate'];
        $queryParams['searchEdate']=$viewParams['edate'];
        $queryParams['searchKind']=$viewParams['p_kind'];

        $queryParams['page']=1;
        $rows=$this->stock_model->getStockPartRequstList($queryParams);
        $totCnt=count($rows);
        $itemList=array();
        foreach($rows as $i=>$row) {
            $rows[$i]['items']=$this->part_request_item_model->where(array('pi_pid'=>$row['pi_pid'], 'ii_del'=>'N'))->findAll();
        }
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['setting']=$this->setting;

        $listHtml = view('m/parts/request_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
        
    }
    
    public function disposal_list($type='')
	{
        $viewParams=$this->Params;
        if($type=='reg') {
            $view_file='m/as/disposal_form';
            
            $viewParams['setting']=$this->setting;
            $viewParams['fix_codes']=$this->fix_codes;
            $viewParams['session']=$this->session;
            $viewParams['aa_pid']=$type;
            $viewParams['return_url']='/m/parts/disposal_list';

            // 부품정보
            $partRows=$this->pcmanage_model->getPartsList(array('page'=>1));
            $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'));
            $viewParams['partCategorysJS']=$partCategorysJS;
            $viewParams['partRows']=$partRows;
            // debug($partCategorysJS, $partRows);
            // exit;
        }
        else {
            if(!$viewParams['sdate']) $viewParams['sdate']=date('Y-m-d');
            if(!$viewParams['edate']) $viewParams['edate']=date('Y-m-d');

            $view_file='m/parts/disposal_list';
            $partCategorysJS=$this->pcmanage_model->getPartCategorys(array('type'=>'js'));

            $viewParams['partCategorysJS'] = $partCategorysJS;
        }


        $this->_mheader();
        $footParams['bottom_navi']=$this->setting['menus'][$this->uri->getSegment(2)]['sub'];
        $footParams['active_uri'] = $this->uri->getSegment(3);
        $footParams['default_uri'] = '/m/'.$this->uri->getSegment(2);
        
        echo view($view_file, $viewParams);
        echo view('m/_navi_footer', $footParams);
        $this->_mfooter();
	}

	public function disposal_list_data()
	{
        $viewParams=$queryParams=$this->Params;

        $queryParams['mn_pid']=$this->session->get('as_mn_pid');
        $rows=$this->afterservice_model->getDisposalPartList($queryParams);
        $totCnt=count($rows);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['setting']=$this->setting;

        $listHtml = view('m/parts/disposal_list_data', $viewParams);

        echo json_encode(array('totCnt'=>$totCnt, 'html'=>$listHtml));
        
	}
    

    function execute() {
        if($this->Params['mode'] == 'reg_part_request') { //부품요청
			$RegData=$this->Params;
            $Scripts=array();

			$RegData['pi_mn_pid'] = $this->session->get('as_mn_pid');
			$RegData['reg_id'] = $this->session->get('as_mn_pid');
			$insert_id=$this->part_request_model->insert($RegData);

			if(count($this->Params['part']['qty']) > 0) {
                foreach($this->Params['part']['qty'] as $pt_pid=>$qty) {
					if($qty > 0) {
						$iRegData["pt_pid"] = $pt_pid;
						$iRegData["pi_pid"] = $insert_id;
						$iRegData["pt_name"] = $this->Params['part']['name'][$pt_pid];
						$iRegData["ii_qea"] = $qty;
						$iRegData['reg_id'] = $this->session->get('as_mn_pid');
						$this->part_request_item_model->insert($iRegData);
						//debug($iRegData, $this->oitem_model->dDB->getLastQuery());
					}
				}

			}

			$msg="정상적으로 등록되었습니다.";

			$Scripts[] = "parent.alertBox('".$msg."', parent.win_load, '/m/parts/request_list')";
            jsExecute($Scripts);
		} else if($this->Params['mode'] == 'canel_part_request') { //부품요청취소
            $UpData['pi_state'] = 'C';
            $UpData['up_id'] = $this->session->get('as_mn_pid');
            $this->part_request_model->update($this->Params['pi_pid'], $UpData);
            echo 'ok';
        }
        else if($this->Params['mode']=='update_confirm') {
            $this->part_request_model->update($this->Params['pi_pid'], array('pi_result_confirm_yn'=>'Y', 'up_id'=>$this->session->get('as_mn_pid')));
            echo 'ok';
        }
    }

    
}