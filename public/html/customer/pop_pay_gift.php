<style type="text/css">
    #pop_pay_gift {max-width: 700px;}
    #pop_pay_gift .y_over {max-height:200px;overflow-y:auto;}
</style>

<div id="pop_pay_gift" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>상품권 지급</span>
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
						<th>가입일</th>
						<td colspan="3">
							<input type="text" name="" class="date mWt100 txac" value="" /> ~ 
							<input type="text" name="" class="date mWt100 txac" value="" />
						</td>								
					</tr>
					<tr>
						<th>최종주문일</th>
						<td colspan="3">
							<input type="text" name="" class="date mWt100 txac" value="" /> ~ 
							<input type="text" name="" class="date mWt100 txac" value="" />
						</td>								
					</tr>
					<tr>
						<th>회원등급</th>
						<td>
							<select name="" class="wAuto">
								<option value="">선택</option>
							</select>
						</td>
						<th>회원구분</th>
						<td>
							<select name="" class="wAuto">
								<option value="">선택</option>
							</select>
						</td>									
					</tr>
					<tr>
						<th class="mWt120">회원</th>
						<td colspan="3">
							<div>
								<select name="" class="wAuto">
									<option value="">이름</option>
								</select>                            				
								<input type="text" name="" class="mWt200" value="" placeholder="검색어" />
								<button type="button" class="bt_navy ml5" onclick="">조회</button><br />
							</div>

							<div class="mt5">
								<select name="" class="wAuto">
									<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>
								</select>
							</div>
						</td>
					</tr>                                
					<tr>
						<th>지급상품권</th>
						<td colspan="3">
							<select name="" class="wAuto">
								<option value="">선택</option>
							</select>
						</td>								
					</tr>                                                       
					<tr>
						<th>지급한고객</th>
						<td colspan="3">
							<label class="radioWrap"><input type="radio" name="상품권지급고객" value="1" checked /><i></i><span>전체지급</span></label>
							<label class="radioWrap ml30"><input type="radio" name="상품권지급고객" value="2"  /><i></i><span>선택한고객</span></label>
						</td>
					</tr>                                                            
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="table_wrap y_over mt10">
			<table class="ltable_1" id="">
				<thead>
					<tr>
						<th class="mWt50">No.</th>
						<th><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
						<th>고객코드</th>
						<th>고객명</th>
						<th>전화1</th>
						<th>회원등급</th>
						<th>회원구분</th>
					</tr>
				</thead>
				<tbody id="">
				<?for($i=8;$i>0;$i--){?>
					<tr>
						<td><?=$i?></td>
						<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>      
						<td>35465745</td>
						<td>홍길동</td>
						<td>01012345678</td>
						<td>VIP</td>
						<td>기업</td>
					</tr>
					<?}?>
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="buttonCenter mt20">	
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">지급</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>