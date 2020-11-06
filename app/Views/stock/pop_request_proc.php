<style type="text/css">
    #pop_request_proc {max-width: 800px;}
    #pop_request_proc table.ltable_1 td {text-align:center;}
</style>

<div id="pop_request_proc" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>요청 처리</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm2" id="regFrm2" method="post"  target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" id="mode" value="reg_part_confirm">
		<input type="hidden" name="pi_pid" id="pi_pid" value="">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">처리일</th>
						<td><input type="text" name="ii_result_date" class="date mWt100 txac" value="<?=date('Y-m-d')?>" /></td>
						<td class="mWt100"></td>
						<td class="mWt250"></td>
					</tr>
					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>부품코드</th>
											<th class="mWt250">부품</th>
											<th>현재고</th>
											<th>요청수량</th>
											<th>처리수량</th>
										</tr>
									</thead>
									<tbody id="r_list">
										<tr>
											<td>001001001-00001</td>
											<td class="txal">양말 A</td>
											<td>5</td>
											<td></td>
											<td><input type="text" name="ii_real_qea[]" class="mWt60 h_20 txac" value="" /></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</td>
					</tr>
					<!-- <tr>
						<th>비고</th>
						<td colspan="3"><textarea name="" class="txa_small"></textarea></td>
					</tr> -->
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
		</form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>