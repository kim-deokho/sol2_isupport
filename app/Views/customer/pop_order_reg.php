<style type="text/css">
	#pop_order_reg {max-width: 1100px;}
</style>

<div id="pop_order_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>주문등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt80">주문일</th>
						<td><input type="text" name="" class="date mWt100 txac" value="" /></td>
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
							<select name="" class="wAuto">
								<option value="">전화</option>
							</select>
							<select name="" class="wAuto">
								<option value="">강남1센터</option>
							</select>
						</td>
						<th>주문종류</th>
						<td>
							<select name="" class="wAuto">
								<option value="">재주문</option>
							</select>
						</td>
						<th>주문경로</th>
						<td>
							<select name="" class="wAuto">
								<option value="">영업1팀</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="search_box mt5">
			<div class="box_row">
				<span>상품검색</span>
				<select name="" class="wAuto">
					<option value="">전체</option>
				</select>
				<input type="text" name="" class="mWt300" value="" placeholder="" />
				<button type="button" class="bt_black" onclick="">추가</button>
				<button type="button" class="bt_gray ml5" onclick="adress_reg();">배송지등록</button>

				<div class="po_right">
					<button type="button" class="set_button" onclick="order_cancel();">취소요청</button>
					<button type="button" class="set_button" onclick="order_return();">반품요청</button>
					<button type="button" class="set_button" onclick="order_exchange();">교환요청</button>
				</div> <!-- po_right // 오른쪽 버튼 -->
			</div> <!-- box_row -->
		</div> <!-- search_box -->

		<div class="table_wrap">
			<table class="ltable_1 t_effect_1" id="" style="width:200%">
				<thead>
					<tr>
						<th>선택</th>
						<th>상태</th>
						<th>보관</th>
						<th>창고</th>
						<th>배송타입</th>
						<th class="mWt250">상품</th>
						<th>정상단가</th>
						<th>가용재고</th>
						<th>수량</th>
						<th>판매단가</th>
						<th>합계</th>
						<th>배송지</th>
						<th>수취인</th>
						<th>연락처1</th>
						<th class="mWt350">주소</th>
						<th>배송예정일</th>
						<th>배송정보</th>
						<th>배송일</th>
						<th>배송완료일</th>
						<th>삭제</th>
					</tr>
				</thead>
				<tbody id="">
					<?for($i=3;$i>0;$i--){?>
					<tr>
						<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
						<td>주문완료</td>
						<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
						<td>
							<select name="" class="wAuto h_20">
								<option value="">창고선택</option>
							</select>
						</td>
						<td>
							<select name="" class="wAuto h_20">
								<option value="">택배</option>
							</select>
						</td>
						<td class="txal">어린이 밍키침대 BD1234</td>
						<td>100,000</td>
						<td>100</td>
						<td><input type="text" name="" class="mWt40 h_20 txar" value="" /></td>
						<td><input type="text" name="" class="mWt80 h_20 txar" value="" /></td>
						<td>110,000</td>
						<td><button type="button" class="small bt_gray" onclick="adress_reg();">선택</button></td>
						<td>김아빠</td>
						<td>010-1111-1111</td>
						<td>(12343) 서울시 강서구 영영동 23길</td>
						<td><input type="text" name="" class="date mWt90 h_20 txac" value="" /></td>
						<td>우체국 (1234556666)</td>
						<td>2020-03-20</td>
						<td>2020-03-20</td>
						<td><button type="button" class="small bt_red" onclick="">삭제</button></td>
					</tr>
					<?}?>
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="two_areas mt5">
			<div class="first_area mWt48p">
				<div class="title_1_1">배송메모</div>
				<div><textarea name="" class="txa_small"></textarea></div>
			</div> <!-- first_area -->

			<div class="second_area mWt48p">
				<div class="title_1_1">상담메모</div>
				<div><textarea name="" class="txa_small"></textarea></div>
			</div> <!-- second_area -->
		</div> <!-- two_areas -->

		<div class="three_areas mt10">
			<div class="first_area mWt32p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100">상품금액</th>
								<td>42,800</td>
							</tr>
							<tr>
								<th>프로모션</th>
								<td>-1,000</td>
							</tr>
							<tr>
								<th>상품권사용</th>
								<td>
									<div>
										<select name="" class="wAuto">
											<option value="">5% 할인</option>
										</select>
									</div>

									<div class="mt5">-6,800</div>
								</td>
							</tr>
							<tr class="mHt60 fc10 fs15">
								<th>상품 합계</th>
								<td>25,000</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt32p ml2p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100">배송비</th>
								<td>3,000</td>
							</tr>
							<tr>
								<th>프로모션</th>
								<td>-500</td>
							</tr>
							<tr class="mHt55">
								<th>배송비조정</th>
								<td>
									<input type="text" name="" class="mWt100 txar" value="" />
									<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>무료</span></label>
								</td>
							</tr>
							<tr class="mHt60 fc10  fs15">
								<th>배송비 합계</th>
								<td>1,500</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- second_area -->

			<div class="third_area mWt32p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100">주문합계</th>
								<td>26,500</td>
							</tr>
							<tr>
								<th>적립금사용</th>
								<td>
									<div>잔액 : 234,400</div>

									<div class="mt5">
										<input type="text" name="" class="mWt100 txar" value="" />
										<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>전액</span></label>
									</div>
								</td>
							</tr>
							<tr>
								<th>예치금사용</th>
								<td>
									<div>잔액 : 2,400</div>

									<div class="mt5">
										<input type="text" name="" class="mWt100 txar" value="" />
										<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>전액</span></label>
									</div>
								</td>
							</tr>
							<tr class="fcdb fs15">
								<th>결제금액</th>
								<td>1,500</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- second_area -->
		</div> <!-- three_areas -->

		<div class="two_areas mt10">
			<div class="first_area mWt32p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100">예상적립금</th>
								<td class="txar">2,550</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt66p">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt100">입금</th>
								<td>
									<select name="" id="podr_pay_sel" class="wAuto">
										<option value="1">무통장</option>
										<option value="2">카드</option>
									</select>
									<button type="button" class="set_button ml10" onclick="pay_reg();">입금등록</button>
								</td>
							</tr>
							<tr>
								<th>입금금액</th>
								<td>
									<div>
										2020-02-02 12:33    무통장(신한/계좌번호/예금주명)   <span class="fw6">10,000</span>
										<button type="button" class="bt_navy small ml5" onclick="">수정</button>
									</div>

									<div>
										2020-02-02 12:33    카드(국민/승인번호)    <span class="fw6">5,500</span>
										<button type="button" class="bt_navy small ml5" onclick="">취소</button>
									</div>
								</td>
							</tr>
							<tr>
								<th>미수금</th>
								<td><span class="fw6">10,000</span></td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- second_area -->
		</div> <!-- two_areas -->

		<div class="buttonRight mt20">
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal-->


<script type="text/javascript">
    // 취소요청
    function order_cancel(){
        modal('pop_order_cancel');
    };

    // 반품요청
    function order_return(){
        modal('pop_order_return');
    };

    // 교환요청
    function order_exchange(){
        modal('pop_order_exchange');
    };

    // 입금등록
    function pay_reg(){
        var pay_val = $("#podr_pay_sel > option:selected").val();
        if(pay_val === "1"){
            modal('pop_bankbook_reg');
        }else if(pay_val === "2"){
            modal('pop_card_reg');
        }
    }
</script>