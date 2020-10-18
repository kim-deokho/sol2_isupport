<style type="text/css">
	#pop_card_reg {max-width: 400px;}
	#pop_card_reg tr.auth_manual {display:none;}
</style>

<div id="pop_card_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>결제입력(카드)</span>
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
						<th class="mWt120">고객명</th>
						<td>김아빠</td>
					</tr>
					<tr>
						<th>승인방법</th>
						<td>
							<div class="auth_method">
								<label class="radioWrap"><input type="radio" name="카드승인방법" value="1" checked /><i></i><span>수기결제</span></label>
								<label class="radioWrap ml30"><input type="radio" name="카드승인방법" value="2"  /><i></i><span>SMS결제</span></label>
							</div>
						</td>								
					</tr>
					<tr class="auth_auto">
						<th>카드사</th>
						<td>
							<select name="" class="wAuto">
								<option value="">신한카드</option>
							</select>
						</td>								
					</tr>
					<tr class="auth_manual">
						<th>SMS 발송번호</th>
						<td>
							<input type="text" name="" class="mWt150 txac" value="" />
							<select name="" class="wAuto">
								<option value="">전화1</option>
								<option value="">전화2</option>
								<option value="">전화3</option>
								<option value="">입력</option>
							</select>  
						</td>
					</tr>
					<tr class="auth_auto">
						<th>카드번호</th>
						<td>
							<input type="text" name="" class="mWt50 txac" value="" />
							<input type="text" name="" class="mWt50 txac" value="" />
							<input type="text" name="" class="mWt50 txac" value="" />
							<input type="text" name="" class="mWt50 txac" value="" />
						</td>								
					</tr>
					<tr class="auth_auto">
						<th>유효기간</th>
						<td>
							<select name="" class="wAuto">
								<option value="">01</option>
							</select> 월 / 
							<select name="" class="wAuto">
								<option value="">2020</option>
							</select> 년
						</td>
					</tr>
					<tr class="auth_auto">
						<th>할부개월</th>
						<td>
							<select name="" class="wAuto">
								<option value="">일시불</option>
							</select> 개월
						</td>
					</tr>
					<tr>
						<th>입금액</th>
						<td><input type="text" name="" class="txar" value="" /></td>								
					</tr>
					<tr>
						<th>승인일</th>
						<td><input type="text" name="" class="date" value="" /></td>
					</tr>
					<tr>
						<th>승인번호</th>
						<td><input type="text" name="" class="" value="" /></td>								
					</tr>
					<tr>
						<th>메모</th>
						<td><textarea name="" class="txa_base"></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">					
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
	// 행사등록 기준 선택
	$(".auth_method > label > input[type=radio]").on("click",function(){
		var am_val = $(".auth_method > label > input[type=radio]:checked").val();		
		if(am_val === "1"){
			$("tr.auth_manual").hide();
			$("tr.auth_auto").show();
		}else if(am_val === "2"){
			$("tr.auth_auto").hide();
			$("tr.auth_manual").show();
		}
	});
</script>