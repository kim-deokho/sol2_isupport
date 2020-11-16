<header>
	<div class="header_wrap set_bor">
		<div class="logo_name">
			<!--로고가 등록되지 않은경우 회사명 텍스트 출력 -->
			<!--<span class="logo_img"><img src="../common/img/logo.png" alt="LOGO" /></span>-->
			<span class="logo_txt">LOGO</span>
		</div> <!-- logo_name -->

		<div class="top_menu">
			<ul>
				<li id="basic"><a href="../basic/company.php">기초관리</a></li>
				<li id="product"><a href="../product/p_category.php">상품관리</a></li>
				<li id="customer"><a href="../customer/member_manage.php">고객관리</a></li>
				<li id="delivery"><a href="../delivery/order_ledger.php">배송관리</a></li>
				<li id="stock"><a href="../stock/purchase_order.php">재고관리</a></li>
				<li id="statistics"><a href="../statistics/order_sales.php">통계</a></li>
				<li id="accounting"><a href="../accounting/deposit_reg.php">회계관리</a></li>
			</ul>
		</div> <!-- top_menu -->

		<div class="user_box">
			<div><img src="../common/img/mb.png" />김대리님 접속중</div>
			<div>
				<span onclick="">비밀번호변경</span>
				<span onclick="">로그아웃</span>
			</div>
		</div> <!-- user_box -->
	</div> <!-- header_wrap -->
</header>

<!-- 경고창 시작 -->
<div class="alert_layer">
	<div class="alert_bg"></div>    
	<div class="alert_contents">
		<div class="alert_text"></div>
		<div class="alert_button">확인</div>
	</div>
</div> <!-- alert_layer -->
<!-- 경고창 끝 -->

<script type="text/javascript">
	// 1차메뉴 글자색
	$("#<?=$lastdirname?>").children("a").addClass("set_color");
</script>