<style type="text/css">
    #pop_disposal_parts {max-width: 800px;}
    #pop_disposal_parts table.ltable_1 td {text-align:center;}
</style>

<div id="pop_disposal_parts" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품폐기</span>
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
						<th class="mWt80">폐기일</th>
						<td><input type="text" name="" class="date mWt100 txac" value="" /></td>
						<th class="mWt80">AS 접수번호</th>
						<td>AS20200101-001</td>
					</tr>                                                                        
					<tr>
						<th>폐기부품</th>
						<td colspan="3">
							<div class="input_box_type_s mt5">
								<div class="box_row">
									<span>부품검색</span>
									<select name="" class="wAuto">
										<option value="">1차카테</option>
									</select>
									<select name="" class="wAuto">
										<option value="">2차카테</option>
									</select>
									<input type="text" name="" class="mWt250" value="" placeholder="부품명" />
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
											<th>창고</th>
											<th>사유</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>펌프 > 하부</td>
											<td class="txal">하부 조임 나사 BC12</td>
											<td><input type="text" name="" class="mWt50 h_20 txac" value="" /></td>
											<td>
												<select name="" class="wAuto h_20">
													<option value="">강남창고</option>
												</select>
											</td>
											<td>
												<select name="" class="wAuto h_20">
													<option value="">파손</option>
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
						<th>비고</th>
						<td colspan="3"><textarea name="" class="txa_base"></textarea></td>
					</tr>                            						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->                            

		<div class="buttonCenter mt20">
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonRight -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>