<style type="text/css">
    #pop_request_reg {max-width: 800px;}
    #pop_request_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_request_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품 요청</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="adjust_check(this);return false;" target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" id="mode" value="reg_part_request">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th>등록일</th>
						<td><input type="text" name="" class=" mWt100 txac" value="<?=date('Y-m-d')?>" readonly/></td>
						<th>구분</th>
						<td>
							<label class="radioWrap"><input type="radio" name="pi_kind" value="A" checked /><i></i><span>출고</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pi_kind" value="B"  /><i></i><span>반입</span></label>
						</td>
					</tr>
					<tr>
						<th class="mWt100">창고</th>
						<td>

							<select name="pi_store" id="pi_store" class="wAuto">
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?> ?>
							</select>
						</td>
						<th class="mWt100">요청자</th>
						<td>
							<select name="pi_mn_pid" class="wAuto">
								<option value="">선택</option>
								<?foreach($setting['manager'] as $mn) echo '<option value="'.$mn['mn_pid'].'" >'.$mn['mn_name'].'</option>';?> ?>
							</select>
						</td>
					</tr>

					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="input_box_type_s mt5">
								<div class="box_row">

									 <button type="button" class="bt_black" id="io_add" onclick="add_tr()">추가</button>
								</div> <!-- box_row -->
							</div> <!-- input_box_type_s -->
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th class="mWt250">부품</th>
											<th>현재고</th>
											<th>요청수량</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="p_list">
										<tr>
											<td class="txal">
											<input type='hidden' name='pt_name[]'>
												<select name="pt_pid[]" class="mWt100p  sel2"/>

												</select>
											</td>
											<td><input type='text' name='st_qea[]' class="mWt60  txac" readonly></td>
											<td><input type="text" name="ii_qea[]" class="mWt60  txac" value="" /></td>
											<td><button type="button" class="small bt_red sa_del" onclick="">삭제</button></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</td>
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="pi_memo" class="txa_small"></textarea></td>
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