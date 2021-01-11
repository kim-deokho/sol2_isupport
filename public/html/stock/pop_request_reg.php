<style type="text/css">
    #pop_request_reg {max-width: 800px;}
    #pop_request_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_request_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품 요청</span>
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
						<th>등록일</th>
						<td><input type="text" name="" class="date mWt100 txac" value="" /></td>    
						<th>구분</th>
						<td>
							<label class="radioWrap"><input type="radio" name="출고" value="" checked /><i></i><span>출고</span></label>
							<label class="radioWrap ml20"><input type="radio" name="반입" value=""  /><i></i><span>반입</span></label>
						</td>
					</tr>
					<tr>
						<th class="mWt100">창고</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
						<th class="mWt100">요청자</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
					</tr>                            
					<tr>
						<th>부품검색</th>
						<td colspan="3">
							<select name="" class="wAuto">
								<option value="">1차카테고리</option>
							</select>
							<select name="" class="wAuto">
								<option value="">2차카테고리</option>
							</select>
							<input type="text" name="" class="mWt300" value="" />
							<button type="button" class="bt_black" onclick="">추가</button>
						</td>
					</tr>
					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>부품코드</th>
											<th class="mWt250">부품</th>
											<th>현재고</th>
											<th>요청수량</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>001001001-00001</td>
											<td class="txal">양말 A</td>
											<td>5</td>
											<td><input type="text" name="" class="mWt60 h_20 txac" value="" /></td>
											<td><button type="button" class="small bt_red" onclick="">삭제</button></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                     
						</td>								
					</tr>                            
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="" class="txa_small"></textarea></td>
					</tr>                                                       						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">	
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>