<style type="text/css">
    #pop_adjust_reg {max-width: 800px;}
    #pop_adjust_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_adjust_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>조정 등록</span>
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
						<td colspan="3"><input type="text" name="" class="date mWt100 txac" value="" /></td>                                
					</tr>
					<tr>
						<th class="mWt100">창고</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
						<th class="mWt100">유형</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
					</tr>                            
					<tr>
						<th>상품검색</th>
						<td colspan="3">
							<select name="" class="wAuto">
								<option value="">상품</option>
							</select>
							<input type="text" name="" class="mWt300" value="" />
						</td>
					</tr>
					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>구분</th>
											<th>상품코드</th>
											<th class="mWt200">상품</th>
											<th>현재고</th>
											<th>조정수량</th>
											<th>조정후</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>상품</td>
											<td>001001001-00001</td>
											<td class="txal">양말 A</td>
											<td>5</td>
											<td><input type="text" name="" class="mWt60 h_20 txac" value="" /></td>
											<td>6</td>
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

<script type="text/javascript">
</script>