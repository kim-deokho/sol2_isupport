<style type="text/css">
    #pop_invoice_form {max-width: 800px;}    
    #pop_invoice_form .arrow_button {width:100%;text-align:center;}
    #pop_invoice_form .arrow_button > img {width:24px;cursor:pointer;}
    #pop_invoice_form .up_down_button {font-size:0;}
    #pop_invoice_form .up_down_button > span {vertical-align:middle;display:inline-block;cursor:pointer}
</style>

<div id="pop_invoice_form" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>송장엑셀양식</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">                
		<div class="three_areas">
			<div class="first_area mWt45p">
				<div class="title_1_1">전체 항목</div>
				<ul class="list_type_1 mt25">                            
					<li>주문일</li>
					<li>배송예정일</li>
					<li>배송상태</li>
					<li>배송완료일</li>
					<li>매출처</li>
					<li>주문구분</li>
					<li>고객코드</li>
					<li>고객명</li>
					<li>배송타입</li>
				</ul> <!-- list_type_1 -->                        
			</div> <!-- first_area -->

			<div class="second_area mWt10p">
				<div class="arrow_button mt140" onclick=""><img src="../common/img/right_arrow.png" alt="오른쪽" /></div>
				<div class="arrow_button mt10" onclick=""><img src="../common/img/left_arrow.png" alt="왼쪽" /></div>
			</div> <!-- second_area -->

			<div class="third_area mWt45p">
				<div class="title_2_1">
					<div>설정 항목</div>
					<div class="up_down_button">
						<span onclick=""><img src="../common/img/up_top.jpg" alt="맨위" /></span>
						<span onclick=""><img src="../common/img/up.jpg" alt="위로" /></span>
						<span onclick=""><img src="../common/img/down.jpg" alt="아래로" /></span>
						<span onclick=""><img src="../common/img/down_bottom.jpg" alt="맨아래" /></span>
					</div>
				</div> <!-- title_2_1 -->
				<ul class="list_type_1">                            
					<li>주문일</li>
					<li>배송예정일</li>
					<li>배송상태</li>
					<li>배송완료일</li>
					<li>매출처</li>
					<li>주문구분</li>
					<li>고객코드</li>
					<li>고객명</li>
					<li>배송타입</li>
				</ul> <!-- list_type_1 -->
			</div> <!-- third_area -->
		</div> <!-- three_areas -->

		<div class="buttonCenter mt30">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>