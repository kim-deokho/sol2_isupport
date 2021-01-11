<style type="text/css">
	#pop_product_reg {max-width: 900px;}
</style>

<div id="pop_product_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>상품 등록</span>
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
						<th class="mWt100">상품코드</th>
						<td class="mWt360"><input type="text" name="" class="mWt200" value="" readonly />
						<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>자동</span></label></td>
						<th class="mWt100">등록일</th>
						<td>2020-02-01   (최종수정 : 2020-02-01 홍길동)</td>
					</tr>
					<tr>
						<th>카테고리</th>
						<td colspan="3">
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>								
					</tr>
					<tr>
						<th>상품명</th>
						<td>
							<input type="text" name="" class="mWt250" value="" />
							<button type="button" class="bt_black" onclick="">중복확인</button>
						</td>
						<th>구분</th>
						<td>
							<select name="" class="wAuto">
								<option value="">상품</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>입고가</th>
						<td><input type="text" name="" class="mWt100" value="" /></td>
						<th>과세구분</th>
						<td>
							<label class="radioWrap"><input type="radio" name="과세구분" value="" checked /><i></i><span>과세</span></label>
							<label class="radioWrap ml20"><input type="radio" name="과세구분" value=""  /><i></i><span>비과세</span></label>
						</td>
					</tr>
					<tr>
						<th>정상가</th>
						<td><input type="text" name="" class="mWt100" value="" /></td>
						<th>사용유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="상품사용유무" value="" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="상품사용유무" value=""  /><i></i><span>N</span></label>
						</td>
					</tr>
					<tr>
						<th>매입처</th>
						<td>
							<input type="text" name="" class="mWt250" value="" />
							<button type="button" class="bt_black" onclick="">검색</button>
						</td>
						<th>품목단위</th>
						<td>
							<select name="" class="wAuto">
								<option value="">박스</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>바코드</th>
						<td>
							<div class="ppr_barcode">
								<span><input type="text" name="" class="" value="" /></span>	
								<span></span>
							</div> <!-- ppr_barcode -->
						</td>
						<th>상품이미지</th>
						<td>
							<div class="p_img_reg">
								<div class="lpr_photo"><img src="../common/img/img_none.jpg" id="p_img_prev" alt="상품이미지" /></div>
								<div class="lpr_button">
									<div><button type="button" class="bt_white_bor" onclick="p_img_reg();">찾아보기</button></div>
									<div><button type="button" class="bt_text" onclick="p_img_del();">삭제</button></div>                                                                                
								</div>
								<input type="file" name="" id="p_img_input" class="hidden" />
							</div> <!-- p_img_reg -->
						</td>
					</tr>
					<tr>
						<th>BOM여부</th>
						<td>
							<label class="radioWrap"><input type="radio" name="BOM여부" value="" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="BOM여부" value=""  /><i></i><span>N</span></label>
						</td>
						<th>배송타입</th>
						<td>
							<select name="" class="wAuto">
								<option value="">택배</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>판매기간</th>
						<td>
							<input type="text" name="" class="date mWt100 txac" value="" /> ~
							<input type="text" name="" class="date mWt100 txac" value="" />
						</td>
						<th>배송비설정</th>
						<td>
							<select name="" class="wAuto">
								<option value="">기본배송비</option>
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

		<div class="title_1">BOM 설정(판매)</div>
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>							
					<tr>
						<th class="mWt120">상품검색</th>
						<td>
							<input type="text" name="" class="mWt500" value="" />
							<button type="button" class="bt_black" onclick="">검색</button>
						</td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="table_wrap mt5">
			<table class="ltable_1" id="">
				<thead>
					<tr>									
						<th class="mWt50">No.</th>													
						<th>상품코드</th>
						<th>상품명</th>
						<th class="mWt80">수량</th>
						<th>입고가</th>
						<th>정상가</th>
						<th class="mWt100">삭제</th>
					</tr>
				</thead>
				<tbody id="">
					<tr>
						<td>1</td>
						<td>001001001-00001</td>
						<td>티셔츠</td>
						<td><input type="text" name="" class="mWt60 h_20" value="" /></td>													
						<td>5,000</td>
						<td>15,000</td>													
						<td><button type="button" class="small bt_red" onclick="">삭제</button></td>
					</tr>
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
	// 이미지 미리보기
	function readURL_p_img(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#p_img_prev').attr('src', e.target.result);
            }                   
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 이미지 변경
    $("#p_img_input").on("change",function(){			
        readURL_p_img(this);
    });

    // 이미지 찾아보기 클릭
    function p_img_reg() {        
		$("#p_img_input").click();        
    }

    // 이미지 삭제
    function p_img_del(){
        $('#p_img_prev').attr('src', '../common/img/img_none.jpg');
        $("#p_img_input").val("");
    }	
</script>