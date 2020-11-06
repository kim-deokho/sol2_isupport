<style type="text/css">
	#pop_check_reg {max-width: 700px;}
    #pop_check_reg .file_wrap > span.file_val {width: calc(100% - 180px);}
</style>

<div id="pop_check_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>실사 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="real_check(this);return false;" target="hiddenFrame" action="/stock/execute" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="mode" id="mode" value="reg_check">
		<input type="hidden" name="sr_pid" id="sr_pid" value="">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th>실사일</th>
						<td colspan="3"><input type="text" name="sr_date" class="date mWt100 txac" value="<?=date("Y-m-d")?>" /></td>
					</tr>
					<tr>
						<th class="mWt100">창고</th>
						<td>
							<select name="sr_store" class="wAuto">
								<option value="">선택</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?> ?>
							</select>
						</td>
						<th class="mWt100">실사자</th>
						<td>
							<select name="sr_mn_pid" class="wAuto">
								<option value="">선택</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>상품카테고리</th>
						<td colspan="3">
							<input type='hidden' name='sr_pd_cate'>
							<select class="multi_select" style="width:auto" name="pd_cate[]" id="pd_cate" multiple="multiple">
							<?foreach($pd_cate as $k => $v) echo '<option value="'.$k.'" >'.$v['pc_name'].'</option>';?>
							</select>
						</td>
					</tr>
					<tr>
						<th>부품카테고리</th>
						<td colspan="3">
							<input type='hidden' name='sr_pt_cate'>
							<select class="multi_select" style="width:auto" name="pt_cate[]" id="pt_cate" multiple="multiple">
							<?foreach($pt_cate as $k => $v) echo '<option value="'.$k.'" >'.$v['tc_name'].'</option>';?>
							</select>

						</td>
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><input type="text" name="sr_memo" class="" value="" /></td>
					</tr>
					<tr>
						<th>상품다운로드</th>
						<td colspan="3">
							<button type="button" class="bt_green" onclick="ex_down()">EXCEL</button>
							<span class="ml20">※ 선택한 카테고리의 목록(현재고) 다운로드</span>
						</td>
					</tr>
					<tr>
						<th class="mWt120">실사업로드</th>
						<td colspan="3">
							<div class="file_wrap">
								<button type="button" class="bt_white_bor find_file" data-target="file_stock_excel">찾아보기</button>
								<span class="file_val"></span>
								<!-- <button type="button" class="bt_navy" onclick="">업로드</button> -->
								<input type="file" name="file_stock_excel" id="file_stock_excel" class="hidden" value="" accept=".xls, .xlsx"/>
							</div> <!-- file_wrap -->
						</td>
					</tr>
					<tr>
						<th>재고반영</th>
						<td colspan="3">
							<label class="chkWrap"><input type="checkbox" name="sr_stock_use" value="Y" /><i></i><span>일괄 재고 조정</span></label>
						</td>
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