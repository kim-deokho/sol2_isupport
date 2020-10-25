<style type="text/css">
	#pop_parts_reg {max-width: 700px;}
</style>

<div id="pop_parts_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" target="hiddenFrame" autocomplete="off" action="/product/execute" >
        <input type="hidden" name="mode" id="mode" value="reg_part">
        <input type="hidden" name="pt_pid" id="pt_pid">
        <input type="hidden" name="is_double" id="is_double">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">부품코드</th>
						<td><input type="text" name="pt_code" id="pt_code" class="mWt200" value="" />
						<label class="chkWrap ml10" id="label_is_auto"><input type="checkbox" name="is_auto" value="Y" /><i></i><span>자동</span></label></td>								
					</tr>
					<tr>
						<th>등록일</th>
						<td><span id="reg_update"></span></td>								
					</tr>
					<tr>
						<th>매입처</th>
						<td>
                            <select class="buyer js-single-selector mWt250" name="ct_pid" id="ct_pid">
                                <option value="">-- 선택 --</option>
<?                              foreach($buyRows as $b_row) echo '<option value="'.$b_row['ct_pid'].'">'.$b_row['ct_name'].'</option>';?>
                            </select>
						</td>								
					</tr>
					<tr>
						<th>부품카테고리</th>
						<td>
                            <select name="pt_cate1" id="pt_cate1" id="pt_cate1" id="pt_cate1" class="wAuto part_categorys" onchange="cateCtr.chgCategory(this.value, 1, 'part_categorys', 'pt_cate')" required>
                                <option value="">전체</option>
<?                              foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
                            </select>
                            <select name="pt_cate2" id="pt_cate2" id="pt_cate2" id="pt_cate2" class="wAuto part_categorys" onchange="cateCtr.chgCategory(this.value, 2, 'part_categorys', 'pt_cate')">
                                <option value="">전체</option>
                            </select>
						</td>								
					</tr>
					<tr>
						<th>부품명</th>
						<td>
							<input type="text" name="pt_name" id="pt_name" class="mWt250" value="" required/>
							<button type="button" class="bt_black" onclick="chkDoubleName()">중복확인</button>
						</td>								
					</tr>
					<tr>
						<th>입고가</th>
						<td><input type="text" name="pt_in_price" id="pt_in_price" class="mWt200 txar input-comma" value="" /></td>								
					</tr>
					<tr>
						<th>부품가</th>
						<td><input type="text" name="pt_out_price" id="pt_out_price" class="mWt200 txar input-comma" value="" /></td>								
					</tr>
					<tr>
						<th>공임비</th>
						<td><input type="text" name="pt_wages" id="pt_wages" class="mWt200 txar input-comma" value="" /></td>								
					</tr>							
					<tr>
						<th>사용여부</th>
						<td>
							<label class="radioWrap"><input type="radio" name="pt_use" value="Y" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pt_use" value="N"  /><i></i><span>N</span></label>
						</td>
					</tr>							                        					
					<tr>
						<th>비고</th>
						<td><textarea name="pt_bigo" id="pt_bigo" class="txa_base"></textarea></td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black ml5">저장</button>
        </div> <!-- buttonCenter -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->