<?php namespace App\Controllers;

use App\Models\BasicModel;

class Delivery extends BaseController
{
    function __construct() {
        $this->basic_model = new BasicModel();
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
		$viewParams=$this->Params;

        $this->_header();
        echo view('delivery/as_manage', $viewParams);
        $this->_footer();
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


}