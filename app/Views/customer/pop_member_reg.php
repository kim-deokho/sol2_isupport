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
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post" onsubmit="member_check(this);return false;" target="hiddenFrame" action="/customer/execute">
		<input type="hidden" name="mode" id="mode" value="reg_member">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt70">이름</th>
						<td class=""><input type="text" name="mb_name" class="mWt120" value="" required/></td>
						<th class="mWt70">고객코드</th>
						<td><input type="text" name="mb_code" class="mWt120" value="" readonly /></td>
					</tr>
					<tr>
						<th>전화1</th>
						<td>
							<input type="number" name="mb_tel1" class="mWt120" value="" required/>
							<input type="text" name="mb_fm1" class="mWt50" value="" />
						</td>
						<th>담당자</th>
						<td>
							<select name="mn_pid" class="wAuto">
							<option value="">선택</option>
							<?foreach($setting['manager'] as $row ) { if(strpos($row['mn_work'], 'cs') !== false) {echo '<option value="'.$row['mn_pid'].'">'.$row['mn_name'].'</option>';}}?>
							</select>
						</td>
					</tr>
					<tr>
						<th>전화2</th>
						<td>
							<input type="number" name="mb_tel2" class="mWt120" value="" />
							<input type="text" name="mb_fm2" class="mWt50" value="" />
						</td>
						<th>회원등급</th>
						<td>
							<select name="ml_pid" class="mWt120">
								<option value="">VIP</option>
							</select>
							<label class="chkWrap"><input type="checkbox" name="ml_noauto" value="Y" /><i></i><span>수동</span></label>
						</td>
					</tr>
					<tr>
						<th>전화3</th>
						<td>
							<input type="number" name="mb_tel3" class="mWt120" value="" />
							<input type="text" name="mb_fm3" class="mWt50" value="" />
						</td>
						<th>생년월일</th>
						<td><input type="text" name="mb_birthday" class="mWt120 date" value="" /></td>
					</tr>
					<tr>
						<th rowspan="2">수신동의</th>
						<td rowspan="2" colspan="3">
							<div>
								<label class="chkWrap"><input type="checkbox" name="mb_info_agree" value="Y" /><i></i><span>개인정보</span></label>
								<label class="chkWrap ml20"><input type="checkbox" name="mb_sms_agree" value="Y" /><i></i><span>문자</span></label>
								<label class="chkWrap ml20"><input type="checkbox" name="mb_email_agree" value="Y" /><i></i><span>메일</span></label>
								<label class="chkWrap ml20"><input type="checkbox" name="mb_tel_agree" value="Y" /><i></i><span>전화(마케팅)</span></label>
							</div>
						</td>
					</tr>
					<tr>
					</tr>
					<tr>
						<th>주소</th>
						<td colspan="3">
							<div>
								<input type="text" name="mb_post" id="reg_mb_post" class="mWt80" value="" placeholder="우편번호" />
								<button type="button" class="bt_white_bor" onclick="pop_post('reg_mb_post','reg_mb_addr','reg_mb_addr2')">주소찾기</button>
							</div>
							<div class="mt7">
								<input type="text" name="mb_addr" id="reg_mb_addr" class="mWt45p" value="" placeholder="기본주소" />
								<input type="text" name="mb_addr2" id="reg_mb_addr2" class="mWt45p" value="" placeholder="상세주소"  />
							</div>
						</td>
					</tr>
					<tr>
						<th>가입경로</th>
						<td>
							<select name="mb_in_root" class="wAuto">
								<option value="">선택</option>
								<?foreach($setting['code']['Inroot'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
							</select>
						</td>
						<th>이메일</th>
						<td><input type="email" name="mb_email" class="mWt200" value="" /></td>
					</tr>
					<tr>
						<th>회원구분</th>
						<td colspan="5">
							<label class="radioWrap"><input type="radio" name="mb_kind" value="A" checked /><i></i><span>개인회원</span></label>
							<label class="radioWrap ml30"><input type="radio" name="mb_kind" value="B"  /><i></i><span>기업회원</span></label>
							<select name="ct_pid" class="wAuto">
								<option value="">선택</option>
								<?foreach($setting['customer'] as $row ) echo '<option value="'.$row['ct_pid'].'">'.$row['ct_name'].'</option>'?>

							</select>
							<span class="vam_dib ml20">※ 세금계산서 발행 회원의 경우, 기업회원으로 설정하세요.</span>
						</td>
					</tr>
					<tr>
						<th>일반메모</th>
						<td><textarea name="mb_memo" class="txa_base"></textarea></td>
						<th>관리자메모</th>
						<td colspan="3"><textarea name="mb_admin_memo" class="txa_base"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
		</form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>