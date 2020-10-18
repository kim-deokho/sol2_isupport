<style type="text/css">
    #pop_area_set {max-width: 600px;}
    #pop_area_set .y_over {max-height:500px;overflow-y:auto;}
</style>

<div id="pop_area_set" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>지역설정</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="input_box_type_s mt5">
			<div class="box_row">
				<span>기사</span>
				<div class="vam_dib">김기사</div>
			</div> <!-- box_row -->

			<div class="box_row mt10">
				<span>지역</span>                        
				<select name="" class="wAuto">
					<option value="">시도선택</option>
				</select>
				<select name="sigungu" class="sigungu mWt320" multiple="multiple">
					<option value="">시군구선택1</option>										
					<option value="">시군구선택2</option>										
					<option value="">시군구선택3</option>										
					<option value="">시군구선택4</option>										
					<option value="">시군구선택5</option>
				</select>
				<button type="button" class="bt_black" onclick="">추가</button>
			</div> <!-- box_row -->
		</div> <!-- input_box_type_s -->

		<div class="table_wrap y_over mt5">
			<table class="ltable_1" id="">
				<thead>
					<tr>									
						<th>시도</th>													
						<th>시군구</th>
						<th class="mWt80">삭제</th>
					</tr>
				</thead>
				<tbody id="">
					<?for($i=20;$i>0;$i--){?>
					<tr>
						<td>서울,서울시,서울특별시</td>
						<td>강남구</td>
						<td><button type="button" class="small bt_red" onclick="">삭제</button> </td>
					</tr>
					<?}?>
				</tbody>
			</table>
		</div> <!-- table_wrap -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    // multipleSelect
    $(".sigungu").multipleSelect({
        placeholder: "시군구선택",
        selectAll: false,            
        multiple: true,            
        multipleWidth: 280
    });
</script>