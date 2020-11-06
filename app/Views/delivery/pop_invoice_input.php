<style type="text/css">
	#pop_invoice_input {max-width: 350px;}
</style>

<div id="pop_invoice_input" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>송장번호 입력</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="input_box_type_s">
			<div class="box_row">
				<span>송장번호</span>
				<input type="text" name="" class="mWt200" value="" placeholder="" />
			</div> <!-- box_row -->

			<div class="box_row mt15">
				<span class="mWt50 txac">배송일</span>
				<input type="text" name="" class="date mWt100 txac" value="" />
			</div> <!-- box_row -->
		</div> <!-- input_box_type_s -->                

		<div class="pop_recautions mt10">                    
			※ 송장번호와 배송일이 입력되면 주문상태가<br />‘배송중’으로 자동 변경됩니다.<br />
		</div> <!-- pop_recautions -->

		<div class="buttonCenter mt20">	
			<a href="#" rel="modal:close"><button type="button" class="bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>