<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use App\Models\CommonModel;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
    protected $helpers = ['public', 'url', 'cookie'];
    
    protected $setting;
    protected $session;
    protected $common_model;
    protected $Params;
    protected $paging_rcnt=20;


	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $Params = $request->getPost() ? $request->getPost() : $request->getGet();
        // $this->Params = array_map('trim', $Params);
        $this->Params = $Params;
        if(!is_cli()) {
            $this->session = \Config\Services::session();

            if(!$this->session->get('isLogin')) {
				$exp_path = explode('/', $_SERVER['REQUEST_URI']);
				if($exp_path[1]!='auth') {
					jsExecute('top.location.href="/auth/login"');
					exit;
				}
			}

            $this->setDefine();
        }
		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
    }

    function init() {
        $this->common_model = new CommonModel();
    }
    
    function setDefine() {
        $site_host=$_SERVER['HTTP_HOST'];
        $pk_name=get_cookie('pk_name');
        if(!get_cookie('pk_name')) {
            $exp_host = explode('.', $site_host);
            $pk_name=$exp_host[0];
        }
        if($pk_name=='local') $pk_name='sol2';
        set_cookie('pk_name', $pk_name, 0, $site_host);
        $upload_dir=FCPATH.'/assets/upload/'.$pk_name;
        
        define('IMG_DIR', '/assets/img');
		define('SITE_HOST', $site_host);
		
		define('CSS_DIR', '/assets/css');
		define('JS_DIR', '/assets/js');
        define('LIB_DIR', '/assets/lib');
		define('UPLOAD_HOST', $site_host);
        define('UPLOAD_DIR', $upload_dir);
        define('EDITOR_DIR', 'SE2');	// 에디터 (SE2, smarteditor2)
        
        define('BASE64_CHARS', '+/0123456789=ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz');
        define('ENCODE_KEY', '*6FQk9h8_j$2DysXwGp3PdgW1xM4laINAtqRrJcOef7BYuH5UzToCZmnL0vbSiKVE');
    }

    function _header($show='Y') {
        $viewParams=array('tDate'=>date('YmdH'));
		echo view('_head', $viewParams);
		
		if($show=='Y') {
            $menu=$this->session->get('menu');
            /*
            세션 생성이 처리하기 때문이 굳이 불필요.
            if(!$menu) {
                $resMenu=$this->common_model->getManagerMenu(array('per_id'=>$this->session->get('ss_per_id'), 'mn_pid'=>$this->session->get('ss_mn_pid')));
                $this->session->set('menu', $resMenu['menu']);
            }
            */

            $this->setting['menu']=$menu;
            $this->setting['HostUri']=gethostUri($_SERVER['REQUEST_URI']);
            $this->setting['session']=$this->session;

			$viewParams['setting']=$this->setting;
			echo view('_header', $viewParams);
		}

	}

	function _footer($show='Y') {
		$viewParams['show']=$show;
		echo view('_footer', $viewParams);
	}

    function _loadInfo($params=array()) {
		$arrNavi=array();
        $_uri=array();
		$e_uri=explode('?', $_SERVER['REQUEST_URI']);
		$exp_uri = explode('/', $e_uri[0]);
		foreach($exp_uri as $i=>$uri) {
			preg_match('/(.*)\?.*/i', $uri, $match);
			if(empty($uri) || $match[0]) continue;
			$_uri[] = empty($match[1]) ? $uri : $match[1];
        }
        $this->setting['_uri']=$_uri;
        // 관리자 로그인 접속가능영역
        if($this->session->userdata('ss_mb_level')) {
            if(!in_array($_uri[0], array('manager', 'member'))) {
                redirect(link_url('/manager'));
                exit;
            }
        }
        
        
		// Title
		foreach($arrNavi as $m=>$s) {
			if($m==$_uri[0]) {
				$active['name'] = $m;
				$active['navi']=array('link'=>$m, 'name'=>$s['title']);
				foreach((array)$s['link'] as $link=>$info) {
					$sub_uri = $_uri[1];
					if($link==$sub_uri) {
						$active['sub'] = $link;
						$active['navi']['link'] .= '::'.$link;
						$active['navi']['name'] .= '::'.$info['text'];
						break;
					}
				}
				break;
			}
		}
		$this->setting['Title'] = $this->config->item('site_name_kr').' '.$active['navi']['name'].' - '.$_SERVER['DOCUMENT_TITLE'];

		/*------------------------------------
		cmd별 자동 JS / CSS 로드
		------------------------------------*/
		/*
		추가 JS or CSS 파일
		*/
		$addFile=array(
			'default'=>array(
				'js'=>array('lang/'.$this->config->item('language').'/global', 'util', 'default')
            )
            ,'before'=>array(
				'js'=>array(
                    array('cmd'=>'mypage/room_deposit_payment_form', 'name'=>'payment', 'dir'=>JS_DIR.'/order')
                    ,array('cmd'=>'order/goods_payment', 'name'=>'payment', 'dir'=>JS_DIR.'/order')
                )
            )
            ,'after'=>array(
                'css'=>array(
                    array('cmd'=>'manager', 'name'=>'manager.custom', 'dir'=>'')
                )
            )
        );
        //if($params['view_target']=='iframe') unset($addFile['before']);
		$subSite=array('mypage', 'order');

		# 기본
		$addJS = array();$addCSS=array();
		if($addFile['default']) {
			foreach($addFile['default'] as $key=>$value) {
				foreach($value as $info) {
					$File = $this->_checkFile($info, $key);
					if($File) {						
						${add.strtoUpper($key)} = array_merge(${add.strtoUpper($key)}, $File);
					}
				}
			}
        }

		if($addFile['before']) {
			foreach($addFile['before'] as $key=>$value) {
				foreach($value as $info) {
					if(in_array($_uri[0], $subSite)) {
						if($info['cmd']!=$_uri[0] && $info['cmd']!=$_uri[0].'/'.$_uri[1] && $info['cmd']!=$_uri[0].'/'.$_uri[1].'/'.$_uri[2]) continue;
					} else {
						if(!in_array($info['cmd'], $_uri)) continue;
                    }


					if($info['dir']!='web') {
						$File = $this->_checkFile($info['name'], $key, $info['dir']);
						if($File) {							
							${add.strtoUpper($key)} = array_merge(${add.strtoUpper($key)}, $File);
						}
					} else {
                        
						/* 해당 디렉토리 파일존재유무 따지지않음 */
						${add.strtoUpper($key)} = array_merge(${add.strtoUpper($key)}, array($info['name']));
					}
				}
			}
		}

		foreach($_uri as $name) {
			$fileNames[] = $name;
			$jsFile = $this->_checkFile($fileNames, 'js');			
			$cssFile = $this->_checkFile($fileNames, 'css');
			if($jsFile) $addJS = array_merge($addJS, $jsFile);
			if($cssFile) $addCSS = array_merge($addCSS, $cssFile);
		}
		

		if($addFile['after']) {
			foreach($addFile['after'] as $key=>$value) {
				foreach($value as $info) {
					if(!in_array($info['cmd'], $_uri)) continue;
					if($info['dir']!='web') {
						$File = $this->_checkFile($info['name'], $key, $info['dir']);
						if($File) ${add.strtoUpper($key)} = array_merge(${add.strtoUpper($key)}, $File);
					} else {
						/* 해당 디렉토리 파일존재유무 따지지않음 */
						${add.strtoUpper($key)} = array_merge(${add.strtoUpper($key)}, array($info['name']));
					}
				}
			}
        }
        
        if(!$_uri) {
            $addJS[]=JS_DIR.'/ctr_reservation.js';
            $addJS[]=JS_DIR.'/main.js';
            $addCSS[]=CSS_DIR.'/main.css';
        }
        $this->addFile = array('JS'=>$addJS, 'CSS'=>$addCSS);
	}

	function _checkFile($files, $ext='js', $dir='') {
		$rootDir = $_SERVER['DOCUMENT_ROOT'];
		if($ext=='js') $defaultDir = $dir ? $dir : JS_DIR;
		else if($ext=='css') $defaultDir = $dir ? $dir : CSS_DIR;
		

		$addFile=$langFile=array();
		if(is_array($files)) {
			$filePath = $rootDir.$defaultDir;
			$file = '/'.implode('/', $files);
			if($ext=='js') if(file_exists($filePath.'/lang/'.$this->config->item('language').$file.'.'.$ext)) $langFile[] =$defaultDir.'/lang/'.$this->config->item('language').$file.'.'.$ext;
			if(file_exists($filePath.$file.'.'.$ext)) $addFile[] =$defaultDir.$file.'.'.$ext;
		} else {
			$filePath = $rootDir.$defaultDir;
			$file = '/'.$files;
			if($ext=='js') if(file_exists($filePath.'/lang/'.$this->config->item('language').$file.'.'.$ext)) $langFile[] = $defaultDir.'/lang/'.$this->config->item('language').$file.'.'.$ext;
			if(file_exists($filePath.$file.'.'.$ext)) $addFile[] = $defaultDir.$file.'.'.$ext;
		}
		$includeFile = array_merge($langFile, $addFile);
		return $includeFile ? $includeFile : false;
    }

}
