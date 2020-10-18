<?php
	$tDate = date("YmdHis");

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
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="HandheldFriendly" content="true">
		<meta name="format-detection" content="telephone=no">
		<title>ISUPPORT - 기사모바일</title>
		<link rel="stylesheet" type="text/css" href="../common/css/reset.css">
		<link rel="stylesheet" type="text/css" href="../common/css/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="../common/css/jquery.modal.min.css">
		<link rel="stylesheet" type="text/css" href="../common/css/signature-pad.css">
		<link rel="stylesheet" type="text/css" href="../common/css/common.css?ver=<?=$tDate?>">		
		<link rel="stylesheet" type="text/css" href="../common/css/m_layout.css?ver=<?=$tDate?>">

		<script type="text/javascript" src="../common/js/jquery-3.4.1.min.js"></script>
		<script type="text/javascript" src="../common/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="../common/js/jquery.modal.min.js"></script>
		<script type="text/javascript" src="../common/js/signature_pad.umd.js"></script>
		<script type="text/javascript" src="../common/js/m_layout.js?ver=<?=$tDate?>"></script>
    </head>