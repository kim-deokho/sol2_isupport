<style type="text/css">
    #pop_as_reg {max-width: 900px;}
    #pop_as_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_as_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>AS 등록</span>
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
						<th>상담기록</th>
						<td colspan="3">
							<select name="" class="wAuto">
								<option value="">전화1</option>
								<option value="">전화2</option>
								<option value="">전화3</option>
							</select>
							<select name="" class="wAuto">
								<option value="">인</option>
								<option value="">아웃</option>
								<option value="">수동</option>
							</select>
							<select name="" class="wAuto">
								<option value="">신규주문</option>
								<option value="">재주문</option>
								<option value="">상담전달</option>
								<option value="">단순문의</option>
								<option value="">반품교환</option>
								<option value="">클레임</option>
								<option value="">콜백</option>
								<option value="">기타</option>
							</select>
							<select name="" class="wAuto">
								<option value="">미처리</option>
								<option value="">처리중</option>
								<option value="">처리완료</option>
							</select>

							<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span class="fcdb">긴급</span></label>
						</td>
					</tr>
					<tr>
						<th>구매정보</th>
						<td colspan="3">
							<div>
								<span class="fw6 mr10">주문검색</span>
								<input type="text" name="" class="mWt600" value="" />
							</div>
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th class="mWt100">주문일</th>													
											<th>주문번호</th>
											<th>주문상세번호</th>
											<th>수취인</th>
											<th>매출처</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>2020-01-01</td>
											<td><a href="javascript:">A11111111</a></td>
											<td>3464363345</td>
											<td>김엄마</td>
											<td>매장 > 강남1매장</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
							<div class="mt5">
								<span class="fw6 mr10">확인불가</span>
								<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label>
								<input type="text" name="" class="mWt500 ml10" value="" />
							</div>
						</td>								
					</tr>
					<tr>
						<th>제품정보</th>
						<td colspan="3">
							<div>
								<span class="fw6 mr10">상품검색</span>
								<input type="text" name="" class="mWt400" value="" />
							</div>
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th>카테고리</th>													
											<th>매입처</th>
											<th>상품코드</th>
											<th>상품명</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>가전 > 안마</td>
											<td>코지마</td>
											<td>001001001-00001</td>
											<td>안마의자 CMC-1300A</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                    
						</td>								
					</tr>
					<tr>
						<th class="mWt100">제품시리얼</th>
						<td><input type="text" name="" class="" value="" /></td>
						<th class="mWt100">모델명</th>
						<td><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>부위</th>
						<td>
							<select name="" class="wAuto">
								<option value="">소모품</option>
							</select>
						</td>
						<th>증상</th>
						<td>
							<select name="" class="wAuto">
								<option value="">파손</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>AS 수취인</th>
						<td><input type="text" name="" class="mWt120" value="" /></td>
						<th>구분</th>
						<td>
							<select name="" class="wAuto">
								<option value="">방문</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>AS 연락처1</th>
						<td><input type="text" name="" class="mWt120" value="" /></td>
						<th>AS 연락처2</th>
						<td><input type="text" name="" class="mWt120" value="" /></td>
					</tr>
					<tr>
						<th>주소</th>
						<td colspan="3">
							<div>
								<input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
								<button type="button" class="bt_white_bor" onclick="">주소찾기</button>
								<button type="button" class="bt_gray ml10" onclick="">배송지선택</button>
							</div>
							<div class="mt7">
								<input type="text" name="" class="mWt45p" value="" placeholder="기본주소" />
								<input type="text" name="" class="mWt45p" value="" placeholder="상세주소"  />
							</div>
						</td>
					</tr>
					<tr>
						<th>상담내용</th>
						<td colspan="3"><textarea name="" class="txa_base"></textarea></td>
					</tr>                            						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">		
</script>