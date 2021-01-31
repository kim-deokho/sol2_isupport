<?php namespace App\Models;

class BaseModel
{
    protected $dDB;
    function __construct() {
        $this->dDB = \Config\Database::connect();
        if(!is_cli()) $this->session = \Config\Services::session();
    }

    //SQL_CALC_FOUND_ROWS를 활용한 리스트 목록수 구하는 함수
	public function found_rows() {
		$query = $this->dDB->query("SELECT FOUND_ROWS() AS total", false);

		return $query->getUnbufferedRow("array");
	}
    
}