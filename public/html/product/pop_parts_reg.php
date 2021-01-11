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
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">부품코드</th>
						<td><input type="text" name="" class="mWt200" value="" readonly />
						<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>자동</span></label></td>								
					</tr>
					<tr>
						<th>등록일</th>
						<td>2020-02-01   (최종수정 : 2020-02-01 홍길동)</td>								
					</tr>
					<tr>
						<th>매입처</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>								
					</tr>
					<tr>
						<th>부품카테고리</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>								
					</tr>
					<tr>
						<th>부품명</th>
						<td>
							<input type="text" name="" class="mWt250" value="" />
							<button type="button" class="bt_black" onclick="">중복확인</button>
						</td>								
					</tr>
					<tr>
						<th>입고가</th>
						<td><input type="text" name="" class="mWt200 txar" value="" /></td>								
					</tr>
					<tr>
						<th>부품가</th>
						<td><input type="text" name="" class="mWt200 txar" value="" /></td>								
					</tr>
					<tr>
						<th>공임비</th>
						<td><input type="text" name="" class="mWt200 txar" value="" /></td>								
					</tr>							
					<tr>
						<th>사용여부</th>
						<td>
							<label class="radioWrap"><input type="radio" name="부품사용여부" value="" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="부품사용여부" value=""  /><i></i><span>N</span></label>
						</td>
					</tr>							                        					
					<tr>
						<th>비고</th>
						<td><textarea name="" class="txa_base"></textarea></td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">		
</script>