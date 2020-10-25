<style type="text/css">
	#pop_client_reg {max-width: 800px;}
</style>

<div id="pop_client_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>거래처 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" target="hiddenFrame" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_trader">
        <input type="hidden" name="ct_pid" id="ct_pid">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">업체코드</th>
						<td><span id="ct_code"></span></td>
						<th class="mWt100">등록일</th>
						<td><span id="reg_date"></span></td>
					</tr>
					<tr>
						<th>업체명</th>
						<td><input type="text" name="ct_name" id="ct_name" class="" value="" required /></td>
						<th>구분</th>
						<td>
							<select name="ct_kind" id="ct_kind" class="">
<?                          foreach($fix_codes->TraderKind as $k=>$v) echo '<option value="'.$k.'">'.$v.'</option>';?>
							</select>
						</td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td><input type="text" name="ct_ceo" id="ct_ceo" class="" value="" /></td>
						<th>매출처</th>
						<td>
							<select name="ct_out_kind" id="ct_out_kind" class="">
<?                              foreach($setting['code']['OutKind'] as $out_kind) echo '<option value="'.$out_kind['cd_pid'].'" >'.$out_kind['cd_name'].'</option>';?>
							</select>
						</td>
					</tr>
					<tr>
						<th>업태</th>
						<td><input type="text" name="ct_business_conditions" id="ct_business_conditions" class="" value="" /></td>
						<th>사업자번호</th>
						<td><input type="text" name="ct_no" id="ct_no" class="" value="" /></td>
					</tr>
					<tr>
						<th>전화1</th>
						<td><input type="text" name="ct_tel" id="ct_tel" class="" value="" /></td>
						<th>업종</th>
						<td><input type="text" name="ct_business_type" id="ct_business_type" class="" value="" /></td>
					</tr>
					<tr>
						<th>전화2</th>
						<td><input type="text" name="ct_tel" id="ct_tel" class="" value="" /></td>
						<th>이메일</th>
						<td><input type="text" name="ct_email" id="ct_email" class="" value="" /></td>
					</tr>
					<tr>
						<th>팩스</th>
						<td><input type="text" name="ct_fax" id="ct_fax" class="" value="" /></td>
						<th></th>
						<td><!-- <input type="text" name="" class="" value="" /> --></td>
					</tr>
					<tr>
						<th>주소</th>
						<td colspan="3">
                            <div>
                                <input type="text" name="ct_post" id="ct_post" class="mWt80" value="" placeholder="우편번호" required readonly />
                                <button type="button" class="bt_white_bor" onclick="daumPost.pop()">주소찾기</button>
                            </div>
                            <div class="mt7">
                                <input type="text" name="ct_addr" id="ct_addr" class="mWt49p" value="" placeholder="기본주소" required readonly/>
                                <input type="text" name="ct_addr2" id="ct_addr2" class="mWt49p" value="" placeholder="상세주소" required />
                            </div>
                        </td>
					</tr>
					<tr>
						<th>거래유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="ct_use" value="Y" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="ct_use" value="N"  /><i></i><span>N</span></label>
						</td>
						<th>거래중지일</th>
						<td><input type="text" name="ct_out_date" id="ct_out_date" class="date mWt100 txac" value="" /></td>
					</tr>
					<tr>
						<th>담당자명</th>
						<td><input type="text" name="ct_dname" id="ct_dname" class="" value="" /></td>
						<th>담당전화</th>
						<td><input type="text" name="ct_dtel" id="ct_dtel" class="" value="" /></td>
					</tr>
					<tr>
						<th>담당이메일</th>
						<td><input type="email" name="ct_demail" id="ct_demail" class="" value="" /></td>
						<th>담당휴대폰</th>
						<td><input type="text" name="ct_dhp" id="ct_dhp" class="" value="" /></td>
					</tr>						
					<tr>
						<th>메모</th>
						<td colspan="3"><textarea name="ct_memo" id="ct_memo" class="txa_base"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black ml5 js-save-btn">저장</button>
		</div> <!-- buttonCenter -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>