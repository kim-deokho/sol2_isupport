<style type="text/css">
	#pop_member_reg {max-width: 800px;}
</style>

<div id="pop_member_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>신규회원 등록</span>
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
						<th class="mWt70">이름</th>
						<td class=""><input type="text" name="" class="mWt120" value="" /></td>
						<th class="mWt70">고객코드</th>
						<td><input type="text" name="" class="mWt120" value="" readonly /></td>
					</tr>
					<tr>
						<th>전화1</th>
						<td>
							<input type="text" name="" class="mWt120" value="" />
							<input type="text" name="" class="mWt50" value="" />
						</td>
						<th>담당자</th>
						<td><input type="text" name="" class="mWt120" value="" /></td>                               
					</tr>
					<tr>
						<th>전화2</th>
						<td>
							<input type="text" name="" class="mWt120" value="" />
							<input type="text" name="" class="mWt50" value="" />
						</td>
						<th>회원등급</th>
						<td>
							<select name="" class="mWt120">
								<option value="">VIP</option>
							</select>
							<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>수동</span></label>
						</td>
					</tr>
					<tr>
						<th>전화3</th>
						<td>
							<input type="text" name="" class="mWt120" value="" />
							<input type="text" name="" class="mWt50" value="" />
						</td>
						<th>생년월일</th>
						<td><input type="text" name="" class="mWt120" value="" /></td>
					</tr>
					<tr>
						<th rowspan="2">수신동의</th>
						<td rowspan="2" colspan="3">
							<div>
								<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>개인정보</span></label>
								<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>문자</span></label>
								<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>메일</span></label>
								<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>전화(마케팅)</span></label>
							</div>                                        
						</td>                                    
					</tr>
					<tr>                                                                       
					</tr>
					<tr>
						<th>주소</th>
						<td colspan="3">
							<div>
								<input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
								<button type="button" class="bt_white_bor" onclick="">주소찾기</button>
							</div>
							<div class="mt7">
								<input type="text" name="" class="mWt45p" value="" placeholder="기본주소" />
								<input type="text" name="" class="mWt45p" value="" placeholder="상세주소"  />
							</div>
						</td>
					</tr>
					<tr>
						<th>가입경로</th>
						<td>
							<select name="" class="wAuto">
								<option value="">온라인광고</option>
							</select>
						</td>
						<th>이메일</th>
						<td><input type="text" name="" class="mWt200" value="" /></td>                              
					</tr>
					<tr>
						<th>회원구분</th>
						<td colspan="5">
							<label class="radioWrap"><input type="radio" name="회원구분" value="" checked /><i></i><span>개인회원</span></label>
							<label class="radioWrap ml30"><input type="radio" name="회원구분" value=""  /><i></i><span>기업회원</span></label>
							<select name="" class="wAuto">
								<option value="">거래처 설정</option>
							</select>
							<span class="vam_dib ml20">※ 세금계산서 발행 회원의 경우, 기업회원으로 설정하세요.</span>
						</td>                                    
					</tr>
					<tr>
						<th>일반메모</th>
						<td><textarea name="" class="txa_base"></textarea></td>
						<th>관리자메모</th>
						<td colspan="3"><textarea name="" class="txa_base"></textarea></td>
					</tr>                                
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>