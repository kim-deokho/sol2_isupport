	<?            
        include_once "../common/inc/head.php"; // head
	?>
<body>
		<div class="login_wrap">
		  <div class="box">
			<div class="logo_name">
				<!--로고가 등록되지 않은경우 회사명 텍스트 출력 -->
				<!--<span class="logo_img"><img src="../common/img/logo.png" alt="LOGO" /></span>-->
				<span class="logo_txt">LOGO</span>
			</div>

			<div class="id_pw">
				<input type="text" name="" value="" placeholder="ID" />
				<input type="password" name="" value="" placeholder="PASSWORD" />
			</div> <!-- id_pw -->				

			<div class="login_button">
				<button type="button" class="set_bg" onclick="login()">LOGIN</button>
			</div> <!-- buttonCenter -->

			<div class="login_copy">
				Copyright © <span class="fw6">ISUPPORT Solution.</span> All Rights Reserved.
			</div> <!-- copyrigtht -->
		 </div> <!-- box -->
		 </div> <!-- login_wrap -->
	</body>
</html>

<script type="text/javascript">
	function login() {
		var url = "../basic/company.php";
		location.href=url;
	};
</script>