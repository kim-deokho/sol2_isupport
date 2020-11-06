<style type="text/css">
	#pop_pay_reserve {max-width: 600px;}
    #pop_pay_reserve .pay_method_2 {display:none;}
    #pop_pay_reserve .file_wrap > span.file_val {width: calc(100% - 180px);}
    #pop_pay_reserve .y_over {max-height:200px;overflow-y:auto;}
</style>

<div id="pop_pay_reserve" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>적립금 지급</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="input_box_type_s">
			<div class="box_row pay_method">
				<span>구분</span>
				<label class="radioWrap ml10"><input type="radio" name="적립금지급구분" value="1" checked /><i></i><span>개별지급</span></label>
				<label class="radioWrap ml30"><input type="radio" name="적립금지급구분" value="2"  /><i></i><span>일괄지급</span></label>
			</div> <!-- box_row -->
		</div> <!-- input_box_type_s -->

		<div class="pay_method_1 mt10">
			<div class="table_wrap">
				<table class="itable_1">
					<tbody>
						<tr>
							<th class="mWt120">회원</th>
							<td>
								<div>
									<select name="" class="wAuto">
										<option value="">이름</option>
									</select>
									<input type="text" name="" class="mWt200" value="" placeholder="검색어" />
									<button type="button" class="bt_navy ml5" onclick="">조회</button><br />
								</div>

								<div class="mt5">
									<select name="" class="wAuto">
										<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>
									</select>
								</div>
							</td>
						</tr>
						<tr>
							<th>보유적립금</th>
							<td>52,360</td>
						</tr>
						<tr>
							<th>적립금명</th>
							<td><input type="text" name="" class="mWt200" value="" /></td>
						</tr>
						<tr>
							<th>적립금액</th>
							<td>
								<input type="text" name="" class="mWt150 txar" value="" />
								<span class="ml10">※ ‘-’ 금액입력시 차감</span>
							</td>
						</tr>
						<tr>
							<th>지급후 적립금</th>
							<td>62,360</td>
						</tr>
					</tbody>
				</table> <!-- itable_1 -->
			</div> <!-- table_Wrap -->
		</div> <!-- pay_method_1 -->

		<div class="pay_method_2 mt10">
			<div class="table_wrap">
				<table class="itable_1">
					<tbody>
						<tr>
							<th class="mWt120">파일업로드</th>
							<td>
								<div class="file_wrap">
									<button type="button" class="bt_white_bor" onclick="">찾아보기</button>
									<span class="file_val"></span>
									<button type="button" class="bt_navy" onclick="">업로드</button>
									<input type="file" name="" id="" class="hidden" value="" />
								</div> <!-- file_wrap -->
							</td>
						</tr>
					</tbody>
				</table> <!-- itable_1 -->
			</div> <!-- table_Wrap -->

			<div class="pop_recautions mt10">
				※ 파일이름에 ‘한글‘ 사용불가<br />
				※ 시트는 1개만 사용 (시트명 ‘Sheet1’)<br />
				※ 엑셀 형식은 ‘고객코드,고객명,적립금명,적립금액’<br />
			</div> <!-- pop_recautions -->

			<div class="table_wrap y_over mt10">
				<table class="ltable_1" id="">
					<thead>
						<tr>
							<th>고객코드</th>
							<th>고객명</th>
							<th>적립금</th>
							<th>적립금명</th>
						</tr>
					</thead>
					<tbody id="">
					<?for($i=8;$i>0;$i--){?>
						<tr>
							<td>35465745</td>
							<td>홍길동</td>
							<td>2,000</td>
							<td>이벤트 적립</td>
						</tr>
						<?}?>
					</tbody>
				</table>
			</div> <!-- table_wrap -->
		</div> <!-- pay_method_2 -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">지급</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
	// 행사등록 기준 선택
	$(".pay_method > label > input[type=radio]").on("click",function(){
		var pm_val = $(".pay_method > label > input[type=radio]:checked").val();
		if(pm_val === "1"){
			$(".pay_method_2").hide();
			$(".pay_method_1").show();
		}else if(pm_val === "2"){
			$(".pay_method_1").hide();
			$(".pay_method_2").show();
		}
	});

    // 파일업로드
    $(".file_wrap > button").on("click",function(){
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });
</script>