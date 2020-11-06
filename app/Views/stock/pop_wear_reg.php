<style type="text/css">
    #pop_wear_reg {max-width: 800px;}
    #pop_wear_reg table.ltable_1 td {text-align:center;}
    #pop_wear_reg .wear_type_2 {display:none;}
</style>

<div id="pop_wear_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>입고 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="wear_check(this);return false;" target="hiddenFrame" action="/stock/execute">
		<input type="hidden" name="mode" id="mode" value="reg_wear">
		<input type="hidden" name="si_num" id="si_num" value="">
		<input type="hidden" name="si_kind" id="si_kind" value="A">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">입고일</th>
						<td class="mWt300"><input type="text" name="si_date" class="date mWt100 txac" value="<?=date("Y-m-d")?>" /></td>
						<th class="mWt100">유형</th>
						<td>
							<select name="si_kind2" id="si_kind2" class="wAuto" >
								<option value="A">발주</option>
								<option value="E">기타</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>창고</th>
						<td colspan="3">
							<select name="si_store" class="wAuto" required>
								<option value="">선택</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?> ?>
							</select>
						</td>
					</tr>
					<tr class="wear_type_1">
						<th >검색</th>
						<td colspan="3">
							<select name="sch_pkind" style="display:none" class="wAuto">
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
											<th>상세발주번호</th>
											<th>매입처</th>
											<th>구분</th>
											<th>상품</th>
											<th>잔여발주수량</th>
											<th>입고수량</th>
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
						<td colspan="3"><textarea name="si_memo" class="txa_small"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">

</script>