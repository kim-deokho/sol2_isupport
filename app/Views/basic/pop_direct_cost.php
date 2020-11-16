<style type="text/css">
	#pop_direct_cost {max-width: 700px;}
</style>

<div id="pop_direct_cost" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span id='dc_title'>직배송비 설정</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="chargeFrm" id="chargeFrm" method="post" onsubmit="regCode(this);return false;" target="hiddenFrame" action="/basic/execute">
		<input type="hidden" name="mode" id="mode" value="reg_dcharge">
        <input type="hidden" name="dc_pid" id="dc_pid">
		<input type="hidden" name="dc_kind" id="dc_kind">
		<div class="search_box">
			<div class="box_row">
				<span>명칭</span>
				<input type="text" name="dc_name" id="dc_name" class="mWt300" value="" placeholder="" />
			</div> <!-- box_row -->

			<div class="box_row mt10">
				<span>기존수량</span>
				<input type="text" name="dc_delivery_charge_cnt" id="dc_delivery_charge_cnt" class="mWt120 txar input-comma" value="" placeholder="" />
				<span class="ml20">금액</span>
				<input type="text" name="dc_delivery_charge" id="dc_delivery_charge" class="mWt120 txar input-comma" value="" placeholder="" />
				<button type="submit" class="ml10 bt_black" onclick="">등록</button>
				<button type="button" class="ml10 bt_black" onclick="reset_charge()">초기화</button>

			</div> <!-- box_row -->
		</div> <!-- search_box -->
		</form>

		<div class="table_wrap" id="d_list">

		</div> <!-- table_wrap -->


	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>