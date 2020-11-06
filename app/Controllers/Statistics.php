<?php namespace App\Controllers;

use App\Models\BasicModel;

class Statistics extends BaseController
{
    function __construct() {
        $this->basic_model = new BasicModel();
    }

	public function index()
	{
        return redirect()->to('/statistics/order_sales');
    }

	public function order_sales()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('statistics/order_sales', $viewParams);
        $this->_footer();
	}

	public function product_sales()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('statistics/product_sales', $viewParams);
        $this->_footer();
	}
}