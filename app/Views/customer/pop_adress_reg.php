<style type="text/css">
	#pop_adress_reg {max-width: 1000px;}
</style>

<div id="pop_adress_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>배송지 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="bsf" id="bsf" action="execute" onsubmit="check_coun(this);return false;" target="hiddenFrame">
		<input type="hidden" name="dy_pid" id="dy_pid">
		<input type="hidden" name="mb_pid">
		<input type="hidden" name="mode" value="reg_dely">
		<div class="search_box">
			<div class="box_row">
				<span>수취인</span>
				<input type="text" name="dy_name" id="dy_name" class="mWt120" value="" placeholder="" required/>
				<span class="ml20">연락처1</span>
				<input type="text" name="dy_tel1" id="dy_tel1" class="mWt150" value="" placeholder="" required/>
				<span class="ml20">연락처2</span>
				<input type="text" name="dy_tel2" id="dy_tel2" class="mWt150" value="" placeholder="" required/>
			</div> <!-- box_row -->

			<div class="box_row mt10">
				<span>주소</span>
				<button type="button" class="bt_white_bor" onclick="pop_post('dy_post','dy_addr','dy_addr2')">주소찾기</button>
				<input type="text" name="dy_post" id="dy_post" class="mWt80" value="" placeholder="우편번호" readonly required/>
				<input type="text" name="dy_addr" id="dy_addr" class="mWt270" value="" placeholder="주소1" readonly required/>
				<input type="text" name="dy_addr2" id="dy_addr2" class="mWt200" value="" placeholder="주소2" />

				<div class="po_right">
					<div><button type="submit" class="bt_black" onclick="">저장</button>
					<button type="reset" class="bt_black" onclick="$('#dy_pid').val('')">초기화</button>
					<!--수정, 등록, 리셋--></div>
				</div> <!-- po_right // 오른쪽 버튼 -->
			</div> <!-- box_row -->
		</div> <!-- search_box -->
		</form>

		<div class="table_wrap" id='pop_dlist_area'>

		</div> <!-- table_wrap -->

	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>