<style type="text/css">
	#pop_event_reg {max-width: 800px;}
</style>

<div id="pop_event_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>프로모션 등록</span>
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
						<td class="mWt300">
							<select name="" class="wAuto">
								<option value="">상품</option>
							</select>
						</td>
						<th class="mWt100">사용여부</th>
						<td>
							<label class="radioWrap"><input type="radio" name="행사사용여부" value="" checked /><i></i><span>사용</span></label>
							<label class="radioWrap ml20"><input type="radio" name="행사사용여부" value=""  /><i></i><span>미사용</span></label>
						</td>
					</tr>
					<tr>
						<th>등록일</th>
						<td>2020-04-21</td>
						<th>최종수정</th>
						<td>2020-04-21 12:22 홍길동</td>
					</tr>
					<tr>
						<th>명칭</th>
						<td colspan="3"><input type="text" name="" class="mWt300" value="" /></td>
					</tr>
					<tr>
						<th>기간</th>
						<td colspan="3">
							<label class="radioWrap"><input type="radio" name="행사기간" value="" checked /><i></i><span>무기한</span></label>
							<label class="radioWrap ml20"><input type="radio" name="행사기간" value=""  /><i></i><span>기한설정</span></label>
							<input type="text" name="" class="date mWt100 txac ml10" value="" /> ~ 
							<input type="text" name="" class="date mWt100 txac" value="" />
						</td>
					</tr>
					<tr>
						<th>기준</th>
						<td colspan="3">
							<div class="e_standard">
								<label class="radioWrap"><input type="radio" name="행사기준" value="1" checked /><i></i><span>결제금액기준</span></label>
								<label class="radioWrap ml20"><input type="radio" name="행사기준" value="2"  /><i></i><span>상품기준</span></label>
							</div> <!-- e_standard -->

							<!-- 결제금액기준 -->
							<div class="esta_1 mt10">
								<input type="text" name="" class="mWt120 txar" value="" /> ~ 
								<input type="text" name="" class="mWt120 txar" value="" />
							</div> <!-- esta_1 -->
							
							<!-- 상품기준 -->
							<div class="esta_2">
								<div class="multi_wrap mt5">
									<select name="" id="" class="wAuto">
										<option value="">상품</option>
									</select>
									<input type="text" name="" class="mWt120" value="" placeholder="상품명" />
									<span class="multi_val" id="" onclick="">상품명</span>
								</div> <!-- multi_wrap -->

								<div class="multi_wrap">
									<select name="" id="" class="wAuto">
										<option value="">카테고리</option>
									</select>
									<select name="" id="" class="wAuto">
										<option value="">잡화</option>
									</select>
									<select name="" id="" class="wAuto">
										<option value="">액세서리</option>
									</select>
									<select name="" id="" class="wAuto">
										<option value="">귀걸이</option>
									</select>											
									<span class="multi_val" id="" onclick="">상품명</span>
								</div> <!-- multi_wrap -->

								<div class="multi_wrap">
									<select name="" id="" class="wAuto">
										<option value="">매입처</option>
									</select>
									<input type="text" name="" class="mWt120" value="" placeholder="매입처명" />
									<span class="multi_val" id="" onclick="">매입처명</span>
								</div> <!-- multi_wrap -->
							</div> <!-- esta_2 -->
						</td>							
					</tr>
					<tr>
						<th>할인</th>
						<td colspan="3">
							<div class="e_discount">
								<label class="radioWrap"><input type="radio" name="행사할인" value="1" checked /><i></i><span>상품할인</span></label>
								<label class="radioWrap ml20"><input type="radio" name="행사할인" value="2"  /><i></i><span>배송비할인</span></label>
								<label class="radioWrap ml20"><input type="radio" name="행사할인" value="3"  /><i></i><span>사은품</span></label>
							</div> <!-- e_discount -->

							<div class="edis_1 mt10">
								<input type="text" name="" class="mWt100" value="" placeholder="상품할인" />
								<select name="" class="mWt120">
									<option value="">정률 (%)</option>
									<option value="">정액(원)</option>
								</select> 
							</div> <!-- edis_1 -->

							<div class="edis_2 mt10">
								<input type="text" name="" class="mWt100" value="" placeholder="배송비할인" />
								<select name="" class="mWt120">
									<option value="">정률 (%)</option>
									<option value="">정액(원)</option>
								</select> 
							</div> <!-- edis_2 -->

							<div class="edis_3">
								<div class="multi_wrap mt5">											
									<input type="text" name="" class="mWt200" value="" placeholder="상품명" />
									<span class="multi_val" id="" onclick="">상품명</span>
								</div> <!-- multi_wrap -->
							</div> <!-- edis_3 -->
						</td>
					</tr>
					<tr>
						<th>대상</th>
						<td colspan="3">
							<div class="e_target">
								<label class="radioWrap"><input type="radio" name="행사대상" value="1" checked /><i></i><span>회원등급별</span></label>
								<label class="radioWrap ml20"><input type="radio" name="행사대상" value="2"  /><i></i><span>회원별</span></label>
								<label class="radioWrap ml20"><input type="radio" name="행사대상" value="3"  /><i></i><span>매출처별</span></label>
							</div> <!-- e_target -->

							<div class="etar_1">
								<div class="multi_wrap mt5">
									<select name="" id="" class="wAuto">
										<option value="">VIP</option>
									</select>
									<span class="multi_val" id="" onclick="">VIP</span>                                        
								</div> <!-- multi_wrap -->
							</div> <!-- etar_1 -->

							<div class="etar_2">
								<div class="multi_wrap mt5">
									<input type="text" name="" class="mWt200" value="" placeholder="이름,고객코드" />
									<span class="multi_val" id="" onclick="">이름(고객코드)</span>                                      
								</div> <!-- multi_wrap -->
							</div> <!-- etar_2 -->

							<div class="etar_3">
								<div class="multi_wrap mt5">
									<select name="" id="" class="wAuto">
										<option value="">온라인</option>
									</select>
									<span class="multi_val" id="" onclick="">온라인</span>                                        
								</div> <!-- multi_wrap -->
							</div> <!-- etar_3 -->
						</td>
					</tr>
					<tr>
						<th>적용우선순위</th>
						<td colspan="3"><input type="text" name="" class="mWt100" value="" /></td>
					</tr>
					<tr>
						<th>중복적용여부</th>
						<td colspan="3">
							<label class="radioWrap"><input type="radio" name="행사중복적용여부" value="" checked /><i></i><span>중복할인</span></label>
							<label class="radioWrap ml20"><input type="radio" name="행사중복적용여부" value=""  /><i></i><span>중복불가</span></label>
						</td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close">취소</button></a>
			<button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
	// 행사등록 기준 선택
	$(".e_standard > label > input[type=radio]").on("click",function(){
		var es_val = $(".e_standard > label > input[type=radio]:checked").val();		
		if(es_val === "1"){
			$(".esta_2").hide();
			$(".esta_1").show();
		}else if(es_val === "2"){
			$(".esta_1").hide();
			$(".esta_2").show();
		}
	});

	// 행사등록 할인 선택
	$(".e_discount > label > input[type=radio]").on("click",function(){
		var ed_val = $(".e_discount > label > input[type=radio]:checked").val();		
		if(ed_val === "1"){
			$(".edis_2").hide();
			$(".edis_3").hide();
			$(".edis_1").show();
		}else if(ed_val === "2"){
			$(".edis_1").hide();
			$(".edis_3").hide();
			$(".edis_2").show();
		}
		else if(ed_val === "3"){
			$(".edis_1").hide();
			$(".edis_2").hide();
			$(".edis_3").show();
		}
	});

	// 행사등록 대상 선택
	$(".e_target > label > input[type=radio]").on("click",function(){		
		var et_val = $(".e_target > label > input[type=radio]:checked").val();		
		if(et_val === "1"){
			$(".etar_2").hide();
			$(".etar_3").hide();
			$(".etar_1").show();
		}else if(et_val === "2"){
			$(".etar_1").hide();
			$(".etar_3").hide();
			$(".etar_2").show();
		}
		else if(et_val === "3"){
			$(".etar_1").hide();
			$(".etar_2").hide();
			$(".etar_3").show();
		}
	});
</script>