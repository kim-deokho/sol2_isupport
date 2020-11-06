<style type="text/css">
    #pop_purchase_reg {max-width: 800px;}
    #pop_purchase_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_purchase_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>발주 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="purchase_check(this);return false;" target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" id="mode" value="reg_purchase">
		<input type="hidden" name="io_pid" id="io_pid" value="">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">발주일</th>
						<td class="mWt300"><input type="text" name="io_date" id="io_date" class="date mWt100 txac" value="<?=date("Y-m-d")?>" /></td>
						<th class="mWt100">발주처</th>
						<td>
							<select name="ct_pid" id="ct_pid" class="wAuto">
								<option value="">전체</option>
								<?foreach($setting['trader'] as $b_row) echo '<option value="'.$b_row['ct_pid'].'">'.$b_row['ct_name'].'</option>';?>
							</select>
						</td>
					</tr>
					<tr>
						<th>상품/부품</th>
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
											<th>수량</th>
											<th class="mWt80">입고단가</th>
											<th>실입고단가</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="p_list">
										<tr>
											<td>
												<select name="oi_kind[]" class="">
													<option value="A">상품</option>
													<option value="B">부품</option>
												</select>
											</td>
											<td class="txal">
												<input type="hidden" name="oi_pid[]" value="">
												<input type="hidden" name="oi_name[]" value="">
												<select name="pd_pid[]" class="mWt100p  sel2"/>

												</select>
											</td>
											<td><input type="text" name="oi_qea[]" class="mWt60  txac" value="" onkeyup="inputNumberAutoComma(this)" required/></td>
											<td><input type="text" name="oi_in_price[]" class="mWt100p txar no_border" value="" readonly/></td>
											<td><input type="text" name="oi_real_in_price[]" class="mWt110  txar" value=""  onkeyup="inputNumberAutoComma(this)" required/></td>
											<td><button type="button" class="small bt_red io_del" >삭제</button> </td>
										</tr>

									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</td>
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="io_bigo" id="io_bigo" class="txa_small"></textarea></td>
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