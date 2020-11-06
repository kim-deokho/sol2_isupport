<style type="text/css">
    #pop_as_proc {max-width: 1100px;}
    #pop_as_proc table.ltable_1 td {text-align:center;}
    #pop_as_proc #as_sign {width: 234px;height: 100px;border: 1px solid #d9d9d9;box-sizing: border-box;}
</style>

<div id="pop_as_proc" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>AS 처리</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="two_areas">
			<div class="first_area mWt66p">
				<div class="title_1_1">접수정보</div>
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt80">상담자</th>
								<td>김상담</td>
								<th class="mWt80">요청일</th>
								<td>
									<span>2020-01-01</span>
									<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>긴급</span></label>
								</td>
							</tr>                                                                        
							<tr>
								<th>제품정보</th>
								<td colspan="3">
									<div class="input_box_type_s">
										<div class="box_row">
											<span>상품검색</span>
											<input type="text" name="" class="mWt300" value="" placeholder="" />
										</div> <!-- box_row -->
									</div> <!-- input_box_type_s -->

									<div class="table_wrap mt5">
										<table class="ltable_1" id="">
											<thead>
												<tr>									
													<th>카테고리</th>													
													<th>매입처</th>
													<th>상품코드</th>
													<th class="mWt250">상품명</th>
												</tr>
											</thead>
											<tbody id="">
												<tr>
													<td>가전 > 안마</td>
													<td>코지마</td>
													<td>001001001-00001</td>
													<td class="txal">안마의자 CMC-1300A</td>                                                            
												</tr>
											</tbody>
										</table>
									</div> <!-- table_wrap -->                                    
								</td>								
							</tr>
							<tr>
								<th>제품시리얼</th>
								<td><input type="text" name="" class="" value="" placeholder="" /></td>
								<th>모델명</th>
								<td><input type="text" name="" class="" value="" placeholder="" /></td>
							</tr>
							<tr>
								<th>부위</th>
								<td>
									<select name="" class="">
										<option value="">소모품</option>
									</select>
								</td>
								<th>증상</th>
								<td>
									<select name="" class="">
										<option value="">파손</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>AS 수취인</th>
								<td><input type="text" name="" class="" value="" placeholder="" /></td>
								<th>구분</th>
								<td>
									<select name="" class="">
										<option value="">방문</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>AS 연락처1</th>
								<td><input type="text" name="" class="" value="" placeholder="" /></td>
								<th>AS 연락처2</th>
								<td><input type="text" name="" class="" value="" placeholder="" /></td>
							</tr>
							<tr>
								<th>AS 주소</th>
								<td colspan="3">
									<div>
										<button type="button" class="bt_white_bor" onclick="">주소찾기</button>
										<input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
										<button type="button" class="bt_gray ml10" onclick="">배송지선택</button>
									</div>
									<div class="mt7">
										<input type="text" name="" class="mWt48p" value="" placeholder="기본주소" />
										<input type="text" name="" class="mWt48p" value="" placeholder="상세주소"  />
									</div>
								</td>
							</tr>                                                               
							<tr>
								<th>상담내용</th>
								<td colspan="3"><textarea name="" class="txa_base mHt108"></textarea></td>
							</tr>                            						
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->

				<div class="title_1_1 mt20">부품정보</div>                        
				<div class="input_box_type_s mt5">
					<div class="box_row">
						<span>부품검색</span>
						<select name="" class="wAuto">
							<option value="">1차카테</option>
						</select>
						<select name="" class="wAuto">
							<option value="">2차카테</option>
						</select>
						<input type="text" name="" class="mWt300" value="" placeholder="" />
						<button type="button" class="bt_black" onclick="">추가</button>                                                                                        
					</div> <!-- box_row -->
				</div> <!-- input_box_type_s -->

				<div class="table_wrap mt5">
					<table class="ltable_1" id="">
						<thead>
							<tr>									
								<th>카테고리</th>													
								<th class="mWt200">부품명</th>
								<th>수량</th>
								<th>부품단가</th>
								<th>공임단가</th>
								<th>삭제</th>
							</tr>
						</thead>
						<tbody id="">
							<tr>
								<td>펌프 > 하부</td>
								<td class="txal">하부 조임 나사 BC12</td>
								<td><input type="text" name="" class="mWt50 h_20 txac" value="" /></td>
								<td class="txar">15,000</td>
								<td class="txar">5,000</td>
								<td><button type="button" class="small bt_red" onclick="">삭제</button> </td>
							</tr>
						</tbody>
					</table>
				</div> <!-- table_wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt32p">
				<div class="title_1_1">방문정보</div>
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt80">AS기사</th>
								<td>김기사</td>
							</tr>
							<tr>
								<th>처리상태</th>
								<td>
									<select name="" class="wAuto">
									<option value="">선택</option>
									 <option value="">방문예정</option>
									 <option value="">접수취소</option>
									 <option value="">방문연기</option>
									 </select>
								</td>                                        
							</tr>
							<tr>
								<th>방문일시</th>
								<td>
									<input type="text" name="" class="mt5 date mWt100 txac" value="" />
									<select name="" class="wAuto">
										<option value="">12:00</option>
									</select>
								</td>                                        
							</tr>
							<tr>
								<th>통화메모</th>
								<td><textarea name="" class="txa_small"></textarea></td>
							</tr>
							<tr>
								<th>일정안내문자</th>
								<td>
									<select name="" class="wAuto">
										<option value="">연락처1</option>
									</select>
									<button type="button" class="bt_black" onclick="">발송</button>
								</td>                                        
							</tr>                         						
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->

				<div class="title_1_1 mt20">처리정보</div>
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th>처리상태</th>
								<td><select name="" class="wAuto">
									 <option value="">선택</option>
									 <option value="">처리완료</option>
									 <option value="">미처리</option>
									 <option value="">재방문</option>
									 <option value="">방문연기</option>
									 </select>
								</td>
							</tr>
							<tr>
								<th>처리내용</th>
								<td><textarea name="" class="txa_small"></textarea></td>
							</tr>
							<tr>
								<th>사진</th>
								<td><button type="button" class="bt_white_bor" onclick="">사진보기(0)</button></td>                                        
							</tr>
							<tr>
								<th>요금</th>
								<td>
									<div>
										<select name="" class="wAuto">
											<option value="">무상</option>
										</select>
										<select name="" class="wAuto">
											<option value="">1년</option>
										</select>
									</div>

									<div class="table_wrap mt5">
										<table class="ltable_1" id="">
											<thead>
												<tr>									
													<th class="mWt70">부품비</th>													
													<th class="mWt70">공임비</th>
													<th>출장비</th>
												</tr>
											</thead>
											<tbody id="">
												<tr>
													<td>15,000</td>
													<td>5,000</td>
													<td><input type="text" name="" class="txar" value="" /></td>
												</tr>
												<tr>
													<td colspan="2" class="txac fw6">합계</td>                                                            
													<td><input type="text" name="" class="txar" value="" /></td>
												</tr>
											</tbody>
										</table>
									</div> <!-- table_wrap -->                                    
								</td>								
							</tr>
							<tr>
								<th>결제정보</th>
								<td>
									<div>
										<select name="" class="wAuto">
											<option value="">카드</option>
										</select>
										<select name="" class="wAuto">
											<option value="">신한카드</option>
										</select>
									</div>

									<div class="mt5">
										<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>입금확인</span></label>
										<span class="ml10">(승인 : 35243532)</span>
									</div>
								</td>                                        
							</tr>                                						
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->

				<div class="title_1_1 mt20">고객확인</div>
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt80">확인자</th>
								<td>
									<input type="text" name="" class="mWt100" value="" placeholder="" />
									<select name="" class="wAuto">
										<option value="">본인</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>서명</th>
								<td>
									<div id="as_sign"></div>
									<div class="buttonRight">
										<button type="button" class="bt_gray" onclick="as_sign_clear();">서명 지우기</button>
									</div>
								</td>
							</tr>                                                              						
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- second_area -->
		</div> <!-- two_areas -->                

		<div class="buttonRight mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonRight -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    // 사인삭제
    function as_sign_clear(){
        $("#as_sign").signature('clear');
    };
</script>