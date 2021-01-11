<style type="text/css">
	#pop_order_cancel {max-width: 1100px;}
</style>

<div id="pop_order_cancel" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>주문취소(입금전)</span>
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
						<th class="mWt80">주문일</th>
						<td><input type="text" name="" class="mWt100 txac" value="" readonly /></td>
						<th class="mWt120">고객명(고객코드)</th>
						<td>기영상사 (13243223)</td>
						<th class="mWt80">전화1</th>
						<td>010-1234-5678</td>
					</tr>
					<tr>
						<th>등록자</th>
						<td>김전화  (담당자 : 김상담)</td>
						<th>회원등급</th>
						<td>VIP</td>
						<th>회원구분</th>
						<td>기업회원 (<span class="set_color">기영상사</span>)</td>
					</tr>
					<tr>
						<th>매출처</th>
						<td>
							<select name="" class="wAuto readonly">
								<option value="">전화</option>
							</select>
							<select name="" class="wAuto readonly">
								<option value="">강남1센터</option>
							</select>
						</td>
						<th>주문종류</th>
						<td>
							<select name="" class="wAuto readonly">
								<option value="">재주문</option>
							</select>
						</td>
						<th>주문경로</th>
						<td>
							<select name="" class="wAuto readonly">
								<option value="">영업1팀</option>
							</select>
						</td>                                
					</tr>                                                     						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="table_wrap mt5">
			<table class="ltable_1" id="">
				<thead>
					<tr>									
						<th>주문번호</th>
						<th>상세주문번호</th>
						<th class="mWt400">상품</th>
						<th>정상단가</th>
						<th>수량</th>
						<th>판매단가</th>
						<th>합계</th>
					</tr>
				</thead>
				<tbody id="">
					<tr>
						<td>4464646</td>
						<td>1224442</td>
						<td class="txal">어린이 밍키침대 BD1234</td>                                
						<td>10,000</td>
						<td><input type="text" name="" class="mWt50 txac" value="" /></td>
						<td>7,000</td>
						<td>14,000</td>
					</tr>
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="input_box_type_s mt20 mb10">
			<div class="box_row">
				<span>요청일</span>
				<input type="text" name="" class="date mWt100 txac" value="" />

				<span class="ml20">처리자</span>
				<input type="text" name="" class="mWt120" value="" placeholder="" />
			</div> <!-- box_row -->
		</div> <!-- input_box_type_s -->                
		
		<div class="three_areas">
			<div class="first_area mWt32p">                        
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt120">상품합계(A)</th>
								<td>25,000  <span class="fca4">(-14,000)</span></td>
							</tr>
							<tr>
								<th>배송비합계(B)</th>
								<td>25,000  <span class="fca4">()</span></td>
							</tr>
							<tr>
								<th>주문합계(C=A+B)</th>
								<td>26,500  <span class="fca4">(-14,000)</span></td>
							</tr>
							<tr class="fcdb">
								<th>상품 취소</th>
								<td><input type="text" name="" class="mWt120 txar fcdb" value="" /></td>
							</tr>
							<tr class="fcdb">
								<th>배송비 취소</th>
								<td><input type="text" name="" class="mWt120 txar fcdb" value="" /></td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt32p ml2p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr class="mHt47">
								<th class="mWt120">사용적립금(D)</th>
								<td>1,000  <span class="fca4">()</span></td>
							</tr>
							<tr class="mHt46">
								<th>사용예치금(E)</th>
								<td>0  <span class="fca4">()</span></td>
							</tr>
							<tr class="mHt46 fc10">
								<th>사용적립금취소</th>
								<td>0</td>
							</tr>
							<tr class="mHt46 fc10">
								<th>사용예치금취소</th>
								<td>0</td>
							</tr>                                    
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->                        
			</div> <!-- second_area -->

			<div class="third_area mWt32p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr class="mHt47">
								<th class="mWt110">결제금액(F=C-D-E)</th>
								<td>25,000  <span class="fca4">(-14,000)</span></td>
							</tr>
							<tr class="mHt46">
								<th>입금금액(G)</th>
								<td>
									<div>15,500  <span class="fca4">(-4,000)</span></div>
									<div>무통장 10,000 / 카드 5,500</div>
								</td>
							</tr>
							<tr class="mHt46">
								<th>미수금(F-G)</th>
								<td>10,000  <span class="fca4">(-10,000)</span></td>
							</tr>
							<tr class="mHt46">
								<th>적립금</th>
								<td>2,550  <span class="fca4">(-1,400)</span></td>
							</tr>                                    
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->                       
			</div> <!-- second_area -->
		</div> <!-- three_areas -->

		<div class="two_areas mt10">
			<div class="first_area mWt50p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100" rowspan="2">취소사유</th>
								<td>
									<select name="" class="wAuto">
										<option value="">단순변심</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><textarea name="" class="txa_base mHt120"></textarea></td>
							</tr>                                    
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->                        
			</div> <!-- first_area -->

			<div class="second_area mWt48p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100">입금환불금액</th>
								<td>4,000</td>
							</tr>
							<tr>
								<th>입금환불방법</th>
								<td>
									<label class="radioWrap"><input type="radio" name="취소환불방법" value="" checked /><i></i><span>입금별환불</span></label>
									<label class="radioWrap ml30"><input type="radio" name="취소환불방법" value=""  /><i></i><span>예치금환불</span></label>
								</td>
							</tr>
							<tr>
								<th>입금환불정보</th>
								<td>
									<div>
										<select name="" class="wAuto">
											<option value="">국민은행</option>
										</select>
									</div>

									<div>
										<input type="text" name="" class="mWt220" value="" placeholder="환불계좌번호" />
										<input type="text" name="" class="mWt120" value="" placeholder="예금주" />
									</div>
								</td>
							</tr>
							<tr>
								<th>환불메모</th>
								<td><textarea name="" class="txa_small"></textarea></td>
							</tr>                                    
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- second_area -->
		</div> <!-- two_areas -->

		<div class="buttonRight mt10">
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div>

	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>