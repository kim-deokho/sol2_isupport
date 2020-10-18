<style type="text/css">
    #pop_wear_reg {max-width: 800px;}
    #pop_wear_reg table.ltable_1 td {text-align:center;}
    #pop_wear_reg .wear_type_2 {display:none;}
</style>

<div id="pop_wear_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>입고 등록</span>
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
						<th class="mWt100">입고일</th>
						<td class="mWt300"><input type="text" name="" class="date mWt100 txac" value="" /></td>
						<th class="mWt100">유형</th>
						<td>
							<select name="" id="wear_type_sel" class="wAuto">
								<option value="1">발주</option>
								<option value="2">기타</option>
							</select>
						</td>
					</tr>
					<tr class="wear_type_1">
						<th>발주검색</th>
						<td colspan="3"><input type="text" name="" class="mWt300" value="" /></td>
					</tr>
					<tr class="wear_type_2">
						<th>상품검색</th>
						<td colspan="3"><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>상품</th>
						<td colspan="3">
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th>상세발주번호</th>													
											<th>매입처</th>
											<th>구분</th>
											<th>상품</th>
											<th>잔여발주수량</th>
											<th>입고수량</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>A000003-01</td>
											<td>상생산업</td>
											<td>상품</td>
											<td>양말 A</td>
											<td>1,000</td>
											<td><input type="text" name="" class="mWt60 h_20 txac" value="" /></td>
											<td><button type="button" class="small bt_red" onclick="">삭제</button> </td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                     
						</td>								
					</tr>
					<tr>
						<th>창고</th>
						<td colspan="3">
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
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
    // 유형
    $("#wear_type_sel").on("change",function(){
        var type_val = $("#wear_type_sel > option:selected").val();
        if(type_val === "1"){
            $(".wear_type_2").hide();
            $(".wear_type_1").show();
        }else if(type_val === "2"){
            $(".wear_type_1").hide();
            $(".wear_type_2").show();
        }
    });    
</script>