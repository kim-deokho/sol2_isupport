<style type="text/css">
    #pop_purchase_cancel {max-width: 500px;}
</style>

<div id="pop_purchase_cancel" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>발주 취소</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regForm2" id="regForm2"  method="post" onsubmit="" target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" value="purch_cancel">
		<input type="hidden" name="oi_pid">
		<input type="hidden" name="oic_pd_name">
		<input type="hidden" name="pd_pid">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">발주상품</th>
						<td id="pd_name"></td>
					</tr>
					<tr>
						<th class="mWt100">취소수량</th>
						<td><input type="text" name="oic_qea" class="mWt100 txac" value="" required/></td>
					</tr>
					<tr>
						<th>비고</th>
						<td><textarea name="oic_reson" class="txa_small"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_gray pop_close" onclick="">취소</button></a>
			<button type="submit" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
		</form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>