<style type="text/css">
    #pop_move_reg {max-width: 800px;}
    #pop_move_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_move_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>이동등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="move_check(this);return false;" target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" id="mode" value="reg_move">
		<input type="hidden" name="sm_num" id="sm_num" value="">
		<input type="hidden" name="del_sm_pid" id="del_sm_pid" value="">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th>등록일</th>
						<td colspan="3"><input type="text" name="r_date" class="date mWt100 txac" value="<?=date("Y-m-d")?>" readonly/></td>
					</tr>
					<tr>
						<th class="mWt100">보낸창고</th>
						<td>
							<select name="sm_out_store" class="wAuto">
								<option value="">선택</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?> ?>
							</select>
						</td>
						<th class="mWt100">받는창고</th>
						<td>
							<select name="sm_in_store" class="wAuto">
								<option value="">선택</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?> ?>
							</select>
						</td>
					</tr>
					<tr>
						<th>상품검색</th>
						<td colspan="3">
							<select name="sch_pkind" class="wAuto">
								<option value="A">상품</option>
								<option value="B">부품</option>
							</select>
							<select name="sch_pid" id="sch_pid" onchange="sch_chagne()">
							</select>
						</td>
					</tr>
					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>매입처</th>
											<th>구분</th>
											<th>상품</th>
											<th>현재고</th>
											<th>이동수량</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="p_list">

									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</td>
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="sm_memo" class="txa_small"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
		</form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>