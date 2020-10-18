<?php namespace App\Controllers;

use App\Models\AuthorModel;

class Auth extends BaseController
{
    function __construct() {
        parent::init();
        $this->auth_model = new AuthorModel();
    }

    public function login()
	{
        $viewParams = $this->Params;
        $viewParams['login_fail']=$this->session->getFlashdata('login_fail');
		$this->_header('N');
		echo view('login', $viewParams);
		$this->_footer('N');
    }

    public function login_proc() {
        $returnURL = $this->Params['url'] ? $this->Params['url'] : '/';
        $result=array();

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
                    return redirect()->to(link_url('/auth/login/'));
                    exit;
                }
                if(!$this->session->get('menu')) {
                    $resMenu=$this->common_model->getManagerMenu(array('per_id'=>$mb['bn_pid'], 'mn_pid'=>$mb['mn_pid']));
                    if(!$resMenu['first_menu']) {
                        $this->session->setFlashdata('login_fail', '접속 가능한 권한이 없습니다.');
                        return redirect()->to(link_url('/auth/login/'));
                        exit;
                    }
                    $this->session->set('menu', $resMenu['menu']);
                }

                $this->session->set('isLogin', true);
                // 회원아이디 세션 생성
                $this->session->set('ss_mn_pid', $mb['mn_pid']);
                $this->session->set('ss_mn_name', $mb['mn_name']);
                $this->session->set('ss_mn_id', $mb['mn_id']);
                $this->session->set('ss_per_id', $mb['bn_pid']);    // 권한코드
                
    
                return redirect()->to(link_url($returnURL));
                exit;
            }
        }
        return redirect()->to(link_url('/auth/login/'));
    }
    
    public function logout() {        
        $this->session->destroy();		
        return redirect()->to(link_url('/'));        
    }
}