<?php
if( ! function_exists('debug')) {
	function debug(){
		$sapi_name=php_sapi_name();

		$args=func_get_args();
		$style2="word-break:break-all;word-wrap:break-word;";
		$style="margin:5px 0px 5px 0px;color:white;background-color:black;line-height:1.5em;font-size:11px;font-family:Verdana;padding:5px;text-align:left;float:none;clear:both;display:block;position: static;";
		if( preg_match('/msie ([\d\.]+)/i', $_SERVER['HTTP_USER_AGENT']) ) $style2="word-break:break-all;word-wrap:break-word;";
		$_DEBUG_ID='nKDebug';
		/*스타일 적용*/
		if(is_string($args[0])) {
			if(preg_match('/^(style=)(.+)/i', $args[0])){
				$style .=str_replace(array('\'', "\"", "style="), '', array_shift($args) );
			}
			else if(preg_match('/^(id=)(.+)/i', $args[0])) {
				$_DEBUG_ID =str_replace(array('\'', "\"", "style="), '', array_shift($args) );
			}
		}
		if($sapi_name!='cli') echo "\n<!--{{".$_DEBUG_ID."}}-->\n<div style=\"$style\">\n<xmp style='$style2;white-space:pre-wrap;'>";
		print_r(count($args)>1?$args:$args[0]);
		if($sapi_name!='cli')  echo "</xmp></div>\n";
	}
}
/**
 * URL 암호화 함수
 */
function encryptURL($String){
   return strtr(base64_encode($String), BASE64_CHARS, ENCODE_KEY);
}
/**
 * URL 복호화 함수
 */
function decryptURL($Encoded){
   return base64_decode(strtr($Encoded, ENCODE_KEY, BASE64_CHARS));
}

function jsExecute($js_script) {
	print '<script language="JavaScript">';
	foreach((array) $js_script as $command) print str_replace(';', '', $command).';';
	print '</script>';
}

function link_url($url, $protocol='http', $addQuery='') {
	if($protocol=='javascript') return 'javascript:'.$url.';';
	else if(!$protocol) $protocol='http';
    // $protocol='https';
	$appendQuery = array('api', 'site', 'h');
	$exp_url=array();
	$exp_url = explode('?', $url);
	$keys=array();
	## 중복 Params 체크
	if($exp_url[1]) {
		$exp_param = explode('&', $exp_url[1]);
		foreach($exp_param as $str_param) {
			$exp_key = explode('=', $str_param);
			if(strtolower($exp_key[0])=='returnurl') {
				$sub_url = urldecode($exp_key[1]);
				$sub_exp_url = explode('?', $sub_url);
				$sub_exp_param = explode('&', $sub_exp_url[1]);
				foreach($sub_exp_param as $sub_str_param) {
					$sub_exp_key = explode('=', $sub_str_param);
					$keys[] = $sub_exp_key[0];
				}
			} else {
				$keys[] = $exp_key[0];
			}
		}
	}
	$params = is_array($_GET) ? $_GET : array($_GET);
	$Query='';
	$inQuery=array();
	foreach($params as $k=>$v) {
		if(!in_array($k, $appendQuery) || in_array($k, $keys)) continue;
		$Query[] = $k.'='.$v;
		$inQuery[] = $k;
	}
	if($addQuery) {
		if(is_array($addQuery)) {
			foreach($addQuery as $ak=>$av) $Query[] = $ak.'='.$av;
		}
	}
	if(is_array($Query)) $Query = '?'.implode('&', $Query);


	#$url = $exp_url[0];		// QueryString 제거

	return $protocol.'://'.$_SERVER['HTTP_HOST'].$url.$Query;
}

function dateFormat($format='y/m/d H:i', $dateTime=null, $isKor=false){
	$dateTime=is_null($dateTime) ? time() : $dateTime;
	if( !preg_match('/^([\d]{10,})/', $dateTime) ){
		$dateTime=strtotime($dateTime);
	}

	$returnValue=date($format, $dateTime);
	if($isKor) {
		$returnValue=str_replace(array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'), array('일요일', '월요일', '화요일', '수요일', '목요일', '금요일', '토요일'), $returnValue);
		$returnValue=str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'), array('일', '월', '화', '수', '목', '금', '토'), $returnValue);
		$returnValue=str_replace(array('am', 'pm', 'AM', 'PM'), array('오전', '오후', '오전', '오후'), $returnValue);
	}
	return $returnValue;
}

/*
* 길이만큼 숫자 0붙이기
*/
function getSerial($val, $len, $pos='') {
	$strLen = strlen($val);
	if($strLen >= $len) {
		$value = substr($val, 0, $len);
	} else {
		for($i=0, $lens=$len-$strLen; $i < $lens; $i++) $zero .= "0";
		$value = $pos=='back' ? $val.$zero : $zero.$val;
	}
	return $value;
}

function sendFormData($Data, $Action, $Target='_top'){
    if(is_string($Data)) parse_str($Data, $Params);
    else $Params=$Data;

    $Action = $Action.($_SERVER['REDIRECT_QUERY_STRING'] ? '?'.$_SERVER['REDIRECT_QUERY_STRING']:'');

    echo "<html><body><form name='tmpFrm' method='POST' action='$Action' target='$Target'>";
    array_walk($Params,'array2element');
    die("</form></body><script>document.forms['tmpFrm'].submit();</script></html>");
}

function gethostUri($url, $index='') {
    $uri=str_replace(array('https://', 'http://', $_SERVER['HTTP_HOST']), '', $url);
    $exp_uri = explode('?', $uri);
    $result = explode('/', $exp_uri[0]);
    return $index ? $result[$index] : $result;
}

function setPhonePattern($val) {
    return $val;
}

function ManagerDefaultLink($menu='') {
    $link='';
    foreach($menu as $main_menu) {
        if($_SERVER['REQUEST_URI']=='/') {
            $link=$main_menu['sub'][0]['menu_url'];
            break;
        }
        if($main_menu['menu_url']!=$_SERVER['REQUEST_URI']) continue;
        $link=$main_menu['sub'][0]['menu_url'];
        break;
    }
    if(!$link) {
        jsExecute(array('alert("접속가능한 권한이 없습니다.\\n로그아웃 됩니다!")', 'top.location.href="/auth/logout"'));
        exit;
    }
    return $link;
}