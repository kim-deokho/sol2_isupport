<style type="text/css">
    #pop_preturn_proc {max-width: 900px;}
    #pop_preturn_proc table.ltable_1 td {text-align:center;}
</style>

<div id="pop_preturn_proc" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>반입처리</span>
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
						<th class="mWt100">반입완료일</th>
						<td><input type="text" name="" class="date mWt100 txac" value="" /></td>
						<th class="mWt100">상태</th>
						<td>
							<select name="" class="wAuto">
								<option value="">반품요청</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>반품예정상품</th>
						<td colspan="3">                                    
							<div class="table_wrap">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th class="mWt300">상품</th>													
											<th>수량</th>
											<th>창고</th>
											<th>반입구분</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td class="txal">커피포트 CF-123</td>
											<td>1</td>
											<td>창고1</td>
											<td>정상</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                    
						</td>								
					</tr>
					<tr>
						<th>제품정보</th>
						<td colspan="3">
							<div class="input_box_type_s mt5">
								<div class="box_row">
									<span>상품검색</span>
									<select name="" class="wAuto">
										<option value="">전체</option>
									</select>
									<input type="text" name="" class="mWt300" value="" placeholder="" />
									<button type="button" class="bt_black" onclick="">추가</button>                                                                                        
								</div> <!-- box_row -->
							</div> <!-- input_box_type_s -->

							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th class="mWt300">상품</th>													
											<th>수량</th>
											<th>창고</th>
											<th>반입구분</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td class="txal">커피포트 CF-123</td>
											<td><input type="text" name="" class="mWt50 h_20 txac" value="" /></td>
											<td>
												<select name="" class="wAuto h_20">
													<option value="">강남매장</option>
												</select>
											</td>
											<td>
												<select name="" class="wAuto h_20">
													<option value="">정상</option>
												</select>
											</td>
											<td><button type="button" class="small bt_red" onclick="">삭제</button> </td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                    
						</td>								
					</tr>
					<tr>
						<th>배송비</th>
						<td>제품동봉 (3,000) <input type="text" name="" class="ml20 mWt130 h_20" value="" placeholder="배송비" /></td>
						<th>배송비 수령</th>
						<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
					</tr>                            
					<tr>
						<th>메모</th>
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