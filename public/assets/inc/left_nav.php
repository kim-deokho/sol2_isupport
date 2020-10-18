<nav>
	<div class="left_nav">
		<ul>
			<?if($lastdirname === "basic"){// 기초관리?>
			<li id="company">
				<a href="./company.php">회사정보</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="staff">
				<a href="./staff.php">직원관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="authority">
				<a href="./authority.php">권한관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<li id="client">
				<a href="./client.php">거래처관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="code">
				<a href="./code.php">코드관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="policy">
				<a href="./policy.php">기본정책관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="promotion">
				<a href="./promotion.php">프로모션</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="notice">
				<a href="./notice.php">공지사항</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>

			<?}else if($lastdirname === "product"){// 상품관리?>
			<li id="p_category">
				<a href="./p_category.php">상품카테고리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="p_manage">
				<a href="./p_manage.php">상품관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="outside_mall">
				<a href="./outside_mall.php">외부몰상품연동</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<li id="parts_manage">
				<a href="./parts_manage.php">부품관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>	
			<li id="receve_price">
				<a href="./receve_price.php">입고가관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>	
			<?}else if($lastdirname === "customer"){// 고객관리?>
			<li id="member_manage">
				<a href="./member_manage.php">회원관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="consulting">
				<a href="./consulting.php">상담내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="cancel">
				<a href="./cancel.php">취소내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<li id="return_exchange">
				<a href="./return_exchange.php">반품교환내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="after_service">
				<a href="./after_service.php">AS내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="savings">
				<a href="./savings.php">적립금내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="gift_card">
				<a href="./gift_card.php">상품권내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="deposit">
				<a href="./deposit.php">예치금내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="member_status">
				<a href="./member_status.php">회원현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<?}else if($lastdirname === "delivery"){// 배송관리?>
			<li id="order_ledger">
				<a href="./order_ledger.php">주문원장</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="d_post">
				<a href="./d_post.php">택배배송관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="d_person">
				<a href="./d_person.php">기사배송관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<li id="p_return">
				<a href="./p_return.php">반입관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="order_keep">
				<a href="./order_keep.php">보관주문관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="as_manage">
				<a href="./as_manage.php">AS관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="assig_person">
				<a href="./assig_person.php">기사배정현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="area_manage">
				<a href="./area_manage.php">지역구관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="outside_mall_order">
				<a href="./outside_mall_order.php">외부몰주문연동</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<?}else if($lastdirname === "stock"){// 재고관리?>
			<li id="purchase_order">
				<a href="./purchase_order.php">구매발주관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="wear">
				<a href="./wear.php">입고관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="shipped">
				<a href="./shipped.php">출고관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<li id="stock_status">
				<a href="./stock_status.php">재고현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="stock_move">
				<a href="./stock_move.php">재고이동내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="stock_check">
				<a href="./stock_check.php">재고실사내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="stock_adjust">
				<a href="./stock_adjust.php">재고조정내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="parts_stock">
				<a href="./parts_stock.php">부품재고현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="parts_request">
				<a href="./parts_request.php">부품요청내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="parts_disposal">
				<a href="./parts_disposal.php">부품폐기내역</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<?}else if($lastdirname === "statistics"){// 통계?>
			<li id="order_sales">
				<a href="./order_sales.php">주문별 매출현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="product_sales">
				<a href="./product_sales.php">상품별 매출현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<?}else if($lastdirname === "accounting"){// 회계관리?>
			<li id="deposit_reg">
				<a href="./deposit_reg.php">입금등록</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="deposit_status">
				<a href="./deposit_status.php">입금현황</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="receipt">
				<a href="./receipt.php">증빙발행</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>			
			<li id="refund">
				<a href="./refund.php">환불관리</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<li id="as_deposit">
				<a href="./as_deposit.php">AS입금등록</a>
				<span><img src="../common/img/w_icon.png" alt="새창" /></span>
			</li>
			<?}?>
		</ul>
	</div> <!-- left_nav -->
</nav>

<script type="text/javascript">	
	// 2차메뉴 배경색
	$(document).ready(readyDoc);

	function readyDoc() {
		$("#<?=$pagename?>").addClass("set_bg");

		if("<?=$pagename?>" == "notice_write" || "<?=$pagename?>" == "notice_view"){
			$("#notice").addClass("set_bg");
		};
	};
</script>