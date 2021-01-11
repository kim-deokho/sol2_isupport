<?php namespace App\Controllers\m;

use App\Models\BasicModel;

class Aservice extends \App\Controllers\BaseController
{
    function __construct() {
        $this->basic_model = new BasicModel();
    }

	public function index()
	{
        return redirect()->to('/m/aservice/status_list');
    }

	public function status_list()
	{
		$viewParams=$this->Params;

        $this->_mheader();

        $this->_mfooter();
	}
}