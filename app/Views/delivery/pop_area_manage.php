<style type="text/css">
	#pop_area_manage {max-width: 500px;}
</style>

<div id="pop_area_manage" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>지역 관리</span>
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
						<th class="mWt100">구분</th>
						<td>시도/시군구</td>								
					</tr>
					<tr>
						<th>명칭</th>
						<td><input type="text" name="" class="" value="" /></td>								
					</tr>
					<tr>
						<th>사용유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="지역사용유무" value="" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml30"><input type="radio" name="지역사용유무" value=""  /><i></i><span>N</span></label>
						</td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->
		<div class="precautions_1 mt5">※ 명칭이 여러가지 키워드인 경우 ‘ , ’ (콤마)로 구분해서 입력하세요.</div>

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>