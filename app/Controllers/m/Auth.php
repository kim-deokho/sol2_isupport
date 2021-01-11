<?php namespace App\Controllers\m;

use App\Models\AuthorModel;
use App\Models\PermainModel;

class Auth extends \App\Controllers\BaseController
{
    function __construct() {
        parent::init();
        $this->auth_model = new AuthorModel();
    }

    public function login()
	{
        $viewParams = $this->Params;
        $viewParams['login_fail']=$this->session->getFlashdata('login_fail');
		$this->_mheader('N');
		echo view('m/login', $viewParams);
		$this->_mfooter('N');
    }

    public function login_proc() {
        $returnURL = $this->Params['url'] ? $this->Params['url'] : '/m';
        $result=array();

        $this->Params['work_type']='as';
        $mb=$this->auth_model->getManagerAuth($this->Params);
        $LoginPass=true;
        if ($mb['err']) {
            $this->session->setFlashdata('login_fail', $mb['err']);
            $LoginPass=false;
        }
        if($LoginPass) {
            if($mb['mn_no']) {
                if($mb['mn_out_date']) {
                    $this->session->setFlashdata('login_fail', '퇴사 처리된 직원으로 접속이 불가능합니다.');
                    return redirect()->to(link_url('/m/auth/login/'));
                    exit;
                }
                $permain_model = new PermainModel();
                $permain=$permain_model->find($mb['bn_pid']);
                if($permain['bn_use']!='Y') {
                    $this->session->setFlashdata('login_fail', '사용자의 권한제한으로 접속이 불가능합니다.');
                    return redirect()->to(link_url('/m/auth/login/'));
                    exit;
                }
                // 회원아이디 세션 생성
                $this->session->set('as_mn_pid', $mb['mn_pid']);
                $this->session->set('as_mn_name', $mb['mn_name']);
                $this->session->set('as_mn_id', $mb['mn_id']);
                
    
                return redirect()->to(link_url($returnURL));
                exit;
            }
        }
        return redirect()->to(link_url('/m/auth/login/'));
    }
    
    public function logout() {        
        $this->session->destroy();		
        return redirect()->to(link_url('/m'));        
    }
}