<style type="text/css">
	#pop_direct_cost {max-width: 600px;}
</style>

<div id="pop_direct_cost" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>직배송비 설정</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="search_box">
			<div class="box_row">
				<span>매입처</span>
				<input type="text" name="" class="mWt300" value="" placeholder="" />
			</div> <!-- box_row -->
		</div> <!-- search_box -->

		<div class="table_wrap">
			<table class="ltable_1" id="">
				<thead>
					<tr>									
						<th>매입처</th>
						<th class="mWt100">기준수량</th>
						<th class="mWt150">금액</th>
						<th class="mWt150">관리</th>
					</tr>
				</thead>
				<tbody id="">
					<?for($i=5;$i>0;$i--){?>
					<tr>
						<td>나래유통조합</td>
						<td><input type="text" name="" class="mWt80 h_20 txar" value="" /></td>
						<td><input type="text" name="" class="mWt130 h_20 txar" value="" /></td>
						<td>
							<button type="button" class="small set_button" onclick="">수정</button>
							<button type="button" class="small bt_red" onclick="">삭제</button>
						</td>
					</tr>
					<?}?>
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="mResultTablePage mContentWrap" id="">
			<div class="pageFirstButton pageButton">
				<img src="../common/img/button_list_big1_first.png" class="" alt="처음으로" >
			</div>
			<div class="pagePrevButton pageButton">
				<img src="../common/img/button_list_big1_prev.png" alt="이전으로" >
			</div>
			<div class="pageNum"><span class="on">1</span><span>2</span></div>
			<div class="pageNextButton pageButton">
				<img src="../common/img/button_list_big1_next.png" alt="다음으로" >
			</div>
			<div class="pageLastButton pageButton">
				<img src="../common/img/button_list_big1_last.png" alt="마지막으로" >
			</div>
		</div> <!-- mResultTablePage -->            				
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>