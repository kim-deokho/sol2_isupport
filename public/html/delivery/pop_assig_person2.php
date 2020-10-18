<style type="text/css">
	#pop_assig_person2 {max-width: 500px;}        
    #pop_assig_person2 .y_over {max-height:300px;overflow-y:auto;}
</style>

<div id="pop_assig_person2" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>기사배정</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="table_wrap y_over">
			<table class="ltable_1" id="">
				<thead>
					<tr>
						<th>배송기사</th>
						<th>예정일건수</th>
						<th>당월건수</th>
						<th>선택</th>
					</tr>
				</thead>
				<tbody id="">
					<?for($i=20;$i>0;$i--){?>
					<tr>
						<td>김기사</td>
						<td>2</td>
						<td>15/5</td>
						<td><label class="radioWrap"><input type="radio" name="기사배정2[]" value="" /><i></i></label></td>
					</tr>
					<?}?>                                
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="pop_recautions mt10">
			※ ‘기사배정’이 되면 상태가  ‘방문예정’으로 자동 변경됩니다.<br />
			※ ‘방문일정’이 입력되면 기사배정을 수정&취소할 수 없습니다.<br />
		</div> <!-- pop_recautions -->                

		<div class="buttonCenter mt20">					
			<button type="button" class="bt_red" onclick="">배정취소</button>
			<button type="button" class="bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>