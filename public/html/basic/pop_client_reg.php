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
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">업체코드</th>
						<td></td>
						<th class="mWt100">등록일</th>
						<td></td>
					</tr>
					<tr>
						<th>업체명</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>구분</th>
						<td>
							<select name="" class="">
								<option value="">매입처</option>
								<option value="">매출처</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>대표자명</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>매출처</th>
						<td>
							<select name="" class="">
								<option value="">온라인</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>업태</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>사업자번호</th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>전화1</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>업종</th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>전화2</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>이메일</th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>팩스</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th></th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>주소</th>
						<td colspan="3">
							<div>
								<input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
								<button type="button" class="bt_white_bor" onclick="">주소찾기</button>
							</div>
							<div class="mt7">
								<input type="text" name="" class="mWt49p" value="" placeholder="기본주소" />
								<input type="text" name="" class="mWt49p" value="" placeholder="상세주소"  />
							</div>
						</td>
					</tr>
					<tr>
						<th>거래유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="거래유무" value="" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="거래유무" value=""  /><i></i><span>N</span></label>
						</td>
						<th>거래중지일</th>
						<td><input type="text" name="" class="date mWt100 txac" value="" /></td>
					</tr>
					<tr>
						<th>담당자명</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>담당전화</th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>담당이메일</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th>담당휴대폰</th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>						
					<tr>
						<th>메모</th>
						<td colspan="3"><textarea name="" class="txa_base"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close">취소</button></a>
			<button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>