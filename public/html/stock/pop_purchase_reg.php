<style type="text/css">
    #pop_purchase_reg {max-width: 800px;}
    #pop_purchase_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_purchase_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>발주 등록</span>
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
						<th class="mWt100">발주일</th>
						<td class="mWt300"><input type="text" name="" class="date mWt100 txac" value="" /></td>
						<th class="mWt100">매입처</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>상품/부품</th>
						<td colspan="3">                                    
							<div class="input_box_type_s mt5">
								<div class="box_row">
									<span>검색</span>
									<select name="" class="wAuto">
										<option value="">상품</option>
									</select>
									<input type="text" name="" class="mWt250" value="" />
									<button type="button" class="bt_black" onclick="">추가</button>                                                                                        
								</div> <!-- box_row -->
							</div> <!-- input_box_type_s -->

							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th>구분</th>													
											<th class="mWt200">상품</th>
											<th>수량</th>
											<th class="mWt80">입고단가</th>
											<th>실입고단가</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>상품</td>
											<td class="txal">커피포트 CF-123</td>
											<td><input type="text" name="" class="mWt60 h_20 txac" value="" /></td>
											<td>1,250</td>
											<td><input type="text" name="" class="mWt110 h_20 txar" value="" /></td>
											<td><button type="button" class="small bt_red" onclick="">삭제</button> </td>
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