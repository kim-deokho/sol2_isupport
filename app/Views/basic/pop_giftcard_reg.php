<style type="text/css">
	#pop_giftcard_reg {max-width: 500px;}
</style>

<div id="pop_giftcard_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>상품권 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="giftFrm" id="giftFrm" method="post" onsubmit="regCode(this);return false;" target="hiddenFrame" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_gift">
        <input type="hidden" name="gt_pid" id="gt_pid">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">상품권명</th>
						<td><input type="text" name="gt_name" id="gt_name" class="mWt200" value="" /></td>
					</tr>
					<tr>
						<th>혜택설정</th>
						<td>
							<input type="text" name="gt_dc" id="gt_dc" class="mWt100 txar" value="" />
							<label class="radioWrap ml10"><input type="radio" name="gt_type" id="gt_type" value="A" checked /><i></i><span>%</span></label>
							<label class="radioWrap ml20"><input type="radio" name="gt_type" id="gt_type" value="B"  /><i></i><span>원</span></label>
						</td>
					</tr>
					<tr>
						<th>사용기간</th>
						<td>
							<label class="radioWrap"><input type="radio" name="gt_limit" id="gt_limit" value="A" checked /><i></i><span>무제한</span></label>
							<label class="radioWrap ml30"><input type="radio" name="gt_limit" id="gt_limit" value="B"  /><i></i><span>지급일로부터 <input type="text" name="gt_limit_day" id="gt_limit_day" class="mWt60 txar" value="" /> 일</span></label>
						</td>
					</tr>
					<tr>
						<th>사용가능횟수</th>
						<td>
							<label class="radioWrap"><input type="radio" name="gt_use_cnt" id="gt_use_cnt" value="A" checked /><i></i><span>무제한</span></label>
							<label class="radioWrap ml30"><input type="radio" name="gt_use_cnt" id="gt_use_cnt" value="B"  /><i></i><span>일회용</span></label>
						</td>
					</tr>
					<tr>
						<th>사용유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="gt_use" id="gt_use" value="Y" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml60"><input type="radio" name="gt_use" id="gt_use" value="N"  /><i></i><span>N</span></label>
						</td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close" onclick="">취소</button></a>
			<button type="submit" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
		</form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>