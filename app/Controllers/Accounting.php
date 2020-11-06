<?php namespace App\Controllers;

use App\Models\BasicModel;

class Accounting extends BaseController
{
    function __construct() {
        $this->basic_model = new BasicModel();
    }

	public function index()
	{
        return redirect()->to('/accounting/deposit_reg');
    }

	public function deposit_reg()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('accounting/deposit_reg', $viewParams);
        $this->_footer();
	}

	public function deposit_status()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('accounting/deposit_status', $viewParams);
        $this->_footer();
	}

	public function receipt()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('accounting/receipt', $viewParams);
        $this->_footer();
	}

	public function refund()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('accounting/refund', $viewParams);
        $this->_footer();
	}

	public function as_deposit()
	{
		$viewParams=$this->Params;

        $this->_header();
        echo view('accounting/as_deposit', $viewParams);
        $this->_footer();
	}

}