<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\PcmanageModel;

class Product extends BaseController
{
    function __construct() {
        parent::init();
        $this->product_model = new ProductModel();
        $this->pcmanage_model = new PcmanageModel();
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
    }
    
    function item_list() {    
        //상품구분
        if(!$this->setting['code']['ProductKind']) $this->setting['code']['ProductKind']=$this->common_model->getCodeData(array('p_cd_code'=>'0201', 'returnType'=>'pid'));
        //품목단위
        if(!$this->setting['code']['ProductUnit']) $this->setting['code']['ProductUnit']=$this->common_model->getCodeData(array('p_cd_code'=>'0202', 'returnType'=>'pid'));

        $categorysJS=$this->pcmanage_model->getCategorys(array('type'=>'js'));

        $viewParams=$this->Params;
        $viewParams['setting']=$this->setting;
        $viewParams['categorysJS']=$categorysJS;
        //$viewParams['rows']=$this->product_model->findAll();
       
        $this->_header();
        echo view('product/item_list', $viewParams);
        $this->_footer();
    }

    function item_list_data() {
        $this->Params['rcnt']=$this->paging_rcnt;
        $viewParams=$this->Params;
        $rows=$this->pcmanage_model->getProductList($this->Params);
        unset($this->Params['page']);
        $totCnt=$this->pcmanage_model->getProductList($this->Params);
        $viewParams['totCnt']=$totCnt;
        $viewParams['rows']=$rows;
        $viewParams['num'] = $totCnt - (($viewParams['page']-1)*$viewParams['rcnt']);
        $viewParams['setting']=$this->setting;
        $listHtml=view('product/item_list_data', $viewParams);
        echo json_encode(array('totCnt'=>$totCnt, 'rcnt'=>$viewParams['rcnt'], 'page'=>$viewParams['page'], 'html'=>$listHtml));

    }

	public function external()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('product/external', $viewParams);
        $this->_footer();
	}

	public function part_list()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('product/part_list', $viewParams);
        $this->_footer();
	}

	public function inprice_list()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('product/inprice_list', $viewParams);
        $this->_footer();
	}
}