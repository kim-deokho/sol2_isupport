<style type="text/css">
	#pop_giftcard_reg {max-width: 500px;}
</style>

<div id="pop_giftcard_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>상품권 등록</span>
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
						<th class="mWt120">상품권명</th>
						<td><input type="text" name="" class="mWt200" value="" /></td>								
					</tr>
					<tr>
						<th>혜택설정</th>
						<td>
							<input type="text" name="" class="mWt100 txar" value="" />
							<label class="radioWrap ml10"><input type="radio" name="혜택설정" value="" checked /><i></i><span>%</span></label>
							<label class="radioWrap ml20"><input type="radio" name="혜택설정" value=""  /><i></i><span>원</span></label> 
						</td>								
					</tr>
					<tr>
						<th>사용기간</th>
						<td>                                    
							<label class="radioWrap"><input type="radio" name="사용기간" value="" checked /><i></i><span>무제한</span></label>
							<label class="radioWrap ml30"><input type="radio" name="사용기간" value=""  /><i></i><span>지급일로부터 <input type="text" name="" class="mWt60 txar" value="" /> 일</span></label> 
						</td>
					</tr>
					<tr>
						<th>사용가능횟수</th>
						<td>
							<label class="radioWrap"><input type="radio" name="사용가능횟수" value="" checked /><i></i><span>무제한</span></label>
							<label class="radioWrap ml30"><input type="radio" name="사용가능횟수" value=""  /><i></i><span>일회용</span></label>
						</td>
					</tr>
					<tr>
						<th>사용유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="사용유무" value="" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml60"><input type="radio" name="사용유무" value=""  /><i></i><span>N</span></label>
						</td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close" onclick="">취소</button></a>
			<button type="button" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>