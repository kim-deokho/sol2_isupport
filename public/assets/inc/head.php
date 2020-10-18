<?php
	$tDate = date("YmdHis");

	// 현재페이지
	$php_self = explode("/",$_SERVER[PHP_SELF]);
	$url_cnt = count($php_self)-1;
	$this_page = $php_self[$url_cnt];
	$pagename=substr_replace($this_page, '', -4);

	// 현재폴더
	function get_dirname() {
		$dir = getcwd(); // 현재 디렉토리명을 반환하는 PHP 함수이다.
		$temp = explode("/", $dir);
		$dirname = $temp[sizeof($temp)-1];
		return $dirname;
	}
	$lastdirname = get_dirname();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>ISUPPORT SOL - ver.01</title>
		<link rel="stylesheet" type="text/css" href="../common/css/reset.css">
		<link rel="stylesheet" type="text/css" href="../common/css/jquery-ui.css">
		<link rel="stylesheet" type="text/css" href="../common/css/jquery.modal.min.css">
		<link rel="stylesheet" type="text/css" href="../common/css/multiple-select.css">
		<link rel="stylesheet" type="text/css" href="../common/css/common.css?ver=<?=$tDate?>">
		
		 <!-- 디자인 색상 선택 -->
		<link rel="stylesheet" type="text/css" href="../common/css/type_blue.css">
	
		<!-- 디자인 색상 선택 
		<link rel="stylesheet" type="text/css" href="../common/css/type_blue.css">
		<link rel="stylesheet" type="text/css" href="../common/css/type_yellow.css">
		<link rel="stylesheet" type="text/css" href="../common/css/type_orange.css">
		<link rel="stylesheet" type="text/css" href="../common/css/type_green.css">
		<link rel="stylesheet" type="text/css" href="../common/css/type_purple.css">
		-->
		
		<link rel="stylesheet" type="text/css" href="../common/css/layout.css?ver=<?=$tDate?>">
		<script type="text/javascript" src="../common/js/jquery-1.12.4.min.js"></script>
		<script type="text/javascript" src="../common/js/jquery-ui.js"></script>
		<script type="text/x-javascript" src="../common/js/jquery.modal.min.js"></script>
		<script type="text/javascript" src="../common/js/jquery.signature.min.js"></script>
		<script type="text/javascript" src="../common/js/multiple-select.min.js"></script>
		<script type="text/javascript" src="../common/js/layout.js?ver=<?=$tDate?>"></script>
		<!--[if lt IE 9]>
			<script src="../common/js/html5shiv.min.js"></script>
		<![endif]-->
	</head>