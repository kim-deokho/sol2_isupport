<style type="text/css">
    #pop_adjust_reg {max-width: 800px;}
    #pop_adjust_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_adjust_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>조정 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="adjust_check(this);return false;" target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" id="mode" value="reg_adjust">
		<input type="hidden" name="ra_pid" id="ra_pid" value="">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th>등록일</th>
						<td colspan="3"><input type="text" name="" class="date mWt100 txac" value="<?=date('Y-m-d')?>" /></td>
					</tr>
					<tr>
						<th class="mWt100">창고</th>
						<td>
							<select name="sa_store" id="sa_store" class="wAuto" onchange="option_setting()">
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?> ?>
							</select>
						</td>
						<th class="mWt100">유형</th>
						<td>
							<select name="sa_kind" class="wAuto">
								<option value="B">불량</option>
								<option value="C">파손</option>
								<option value="D">기타</option>
							</select>
						</td>
					</tr>



					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="input_box_type_s mt5">
								<div class="box_row">

									 <button type="button" class="bt_black" id="io_add" onclick="add_tr('A')">추가</button>
								</div> <!-- box_row -->
							</div> <!-- input_box_type_s -->
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>구분</th>
											<th class="mWt200">상품</th>
											<th>현재고</th>
											<th>조정후</th>
											<th>조정수량</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="p_list">
										<tr>
											<td>
												<select name="sa_p_kind[]" class="">
													<option value="A">상품</option>
													<option value="B">부품</option>
												</select>
											</td>
											<td >
												<input type="hidden" name="oi_pid[]" value="">
												<input type="hidden" name="oi_name[]" value="">
												<select name="pd_pid[]" class="mWt100p  sel2"/>

												</select>
											</td>
											<td><input type="text" name="st_qea[]" class="mWt60  txac" value="" readonly></td>
											<td><input type="text" name="sa_qea[]" class="mWt60  txac" value="" /></td>
											<td><input type="text" name="ad_qea[]" class="mWt60  txac" value="" readonly></td>
											<td><button type="button" class="small bt_red sa_del" onclick="">삭제</button></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</td>
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="sa_memo" class="txa_small"></textarea></td>
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

<script type="text/javascript">
</script>