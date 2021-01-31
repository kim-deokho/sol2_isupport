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

include_once ROOTPATH.'inc/s3.lib.php';

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
    protected $uri;
    protected $bottom_navi;
    protected $now_date;


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
            $this->uri = service('uri');
            $exp_path=explode('/', $_SERVER['REQUEST_URI']);
            if($this->uri->getSegment(1)=='m') {
                if(!$this->session->get('as_mn_pid') && !$this->request->isAJAX()) {
                    if($this->uri->getSegment(2)!='auth') {
                        jsExecute('top.location.href="/m/auth/login"');
                        exit;
                    }
                }

            }
            else {
                if(!$this->session->get('isLogin') && !$this->request->isAJAX()) {
                    if($this->uri->getSegment(1)!='auth') {
                        jsExecute('top.location.href="/auth/login"');
                        exit;
                    }
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

        $this->now_date=date('Y-m-d H:i:s');
        
        define('SITE_HOST', $site_host);

        define('IMG_DIR', '/assets/img');
		define('CSS_DIR', '/assets/css');
        define('JS_DIR', '/assets/js');

        define('M_IMG_DIR', '/assets/m/img');
        define('M_CSS_DIR', '/assets/m/css');
        define('M_JS_DIR', '/assets/m/js');
        
        define('LIB_DIR', '/assets/lib');
		define('UPLOAD_HOST', $site_host);
        define('UPLOAD_DIR', $upload_dir);
        define('AWS_UPLOAD_HOST', 'https://isupport.kr.object.ncloudstorage.com/');
        define('AWS_UPLOAD_DIR', 'upload/'.$pk_name);
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
    
    function _mheader($show='Y') {
        $viewParams=array('tDate'=>date('YmdH'));
		echo view('m/_head', $viewParams);
		
		if($show=='Y') {
            $menus=array(
                'delivery'=>array(
                    'label'=>'배송관리'
                    ,'sub'=>array(
                        array('label'=>'배정현황', 'link'=>'status_list')
                        ,array('label'=>'배송중', 'link'=>'progress_list')
                        ,array('label'=>'배송완료', 'link'=>'complete_list')
                    )
                )
                ,'aservice'=>array(
                    'label'=>'AS관리'
                    ,'sub'=>array(
                        array('label'=>'배정현황', 'link'=>'status_list')
                        ,array('label'=>'방문예정', 'link'=>'going_list')
                        ,array('label'=>'처리중', 'link'=>'progress_list')
                        ,array('label'=>'처리완료', 'link'=>'complete_list')
                    )
                )
                ,'parts'=>array(
                    'label'=>'부품'
                    ,'sub'=>array(
                        array('label'=>'부품현황', 'link'=>'status_list')
                        ,array('label'=>'요청내역', 'link'=>'request_list')
                        ,array('label'=>'폐기내역', 'link'=>'disposal_list')
                    )
                )
            );
            $this->setting['menus']=$menus;
            $HostUri=gethostUri($_SERVER['REQUEST_URI']);
            $this->setting['HostUri']=$HostUri;
            $this->setting['session']=$this->session;
            $page_title='';
            foreach ($menus[$HostUri[2]]['sub'] as $value) {
                if($value['link']!=$HostUri[3]) continue;
                $page_title=$value['label'];
                break;
            }
            $this->setting['page_title']='['.$menus[$HostUri[2]]['label'].']'.$page_title;

			$viewParams['setting']=$this->setting;
			echo view('m/_header', $viewParams);
		}

	}

	function _mfooter($show='Y') {
        $viewParams['show']=$show;
		echo view('m/_footer', $viewParams);
	}


}
