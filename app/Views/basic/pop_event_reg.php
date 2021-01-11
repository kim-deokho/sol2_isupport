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
		<form name="regForm" id="regForm"  method="post" target="hiddenFrame" onsubmit="form_check(this);return false;" action="/basic/execute">
		<input type="hidden" name='mode' value='reg_promotion'>
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">구분</th>
						<td class="mWt300">
							<select name="pm_kind" class="wAuto">
								<option value="A">상품</option>
								<option value="B">주문</option>
								<option value="C">배송비</option>
							</select>
						</td>
						<th class="mWt100">사용여부</th>
						<td>
							<label class="radioWrap"><input type="radio" name="pm_use" value="Y" checked /><i></i><span>사용</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pm_use" value="N"  /><i></i><span>미사용</span></label>
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
						<td colspan="3"><input type="text" name="pm_name" class="mWt300" value="" /></td>
					</tr>
					<tr>
						<th>기간</th>
						<td colspan="3">
							<label class="radioWrap"><input type="radio" name="pm_limit" value="A" checked /><i></i><span>무기한</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pm_limit" value="B"  /><i></i><span>기한설정</span></label>
							<input type="text" name="pm_limit_sdate" class="date mWt100 txac ml10" value="" /> ~
							<input type="text" name="pm_limit_edate" class="date mWt100 txac" value="" />
						</td>
					</tr>
					<tr>
						<th>기준</th>
						<td colspan="3">
							<div class="e_standard">
								<label class="radioWrap"><input type="radio" name="pm_standard" value="A" checked /><i></i><span>결제금액기준</span></label>
								<label class="radioWrap ml20"><input type="radio" name="pm_standard" value="B"  /><i></i><span>상품기준</span></label>
							</div> <!-- e_standard -->

							<!-- 결제금액기준 -->
							<div class="esta_1 mt10">
								<input type="text" name="pm_standard_min" class="mWt120 txar" value="" /> ~
								<input type="text" name="pm_standard_max" class="mWt120 txar" value="" />
							</div> <!-- esta_1 -->

							<!-- 상품기준 -->
							<div class="esta_2">
								<div class="multi_wrap mt5">
									<input type='hidden' name='pm_standard_list'>
									<select name="pm_standard_kind" id="" class="wAuto">
										<option value="A">상품</option>
										<option value="B">카테고리</option>
										<option value="C">매입처</option>
									</select>
									<span class="s_prod">
									<select name="st_product" class="wAuto select2-view ">
										<option value=''>상품선택</option>
										<?foreach($pd_rows as $pd_row) echo '<option value="'.$pd_row['pd_pid'].'">'.$pd_row['pd_name'].'</option>';?>
									</select>
									</span>
									<span class="s_cate d_none_no_im">
									<select name="st_category" id="cate1" class="wAuto promotion " onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
										<option value="">카테고리선택</option>
										<?foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
									</select>
									<select name="st_category2" id="cate2" class="wAuto promotion " onchange="cateCtr.chgCategory(this.value, 2, 'promotion')">
										<option value="">카테고리선택</option>
									</select>
									<select name="st_category3" id="cate3" class="wAuto promotion" >
										<option value="">카테고리선택</option>
									</select>
									</span>
									<span class="s_cus d_none_no_im">
									<select name="s_tcustomer" id="" class="wAuto select2-view s_cus">
										<option value="">매입처선택</option>
										<?foreach($ct_rows as $ct_row) echo '<option value="'.$ct_row['ct_pid'].'">'.$ct_row['ct_name'].'</option>';?>
									</select>
									</span>
									<button type='button' class='bt_black' onclick='add_s_kind()'>추가</button>
									<div  id="s_kind"></div>
								</div> <!-- multi_wrap -->

							</div> <!-- esta_2 -->
						</td>
					</tr>
					<tr>
						<th>할인</th>
						<td colspan="3">
							<div class="e_discount">
								<label class="radioWrap"><input type="radio" name="pm_dc_kind" value="A" checked /><i></i><span>상품할인</span></label>
								<label class="radioWrap ml20"><input type="radio" name="pm_dc_kind" value="B"  /><i></i><span>배송비할인</span></label>
								<label class="radioWrap ml20"><input type="radio" name="pm_dc_kind" value="C"  /><i></i><span>사은품</span></label>
							</div> <!-- e_discount -->

							<div class="edis_1 mt10">
								<input type="text" name="pm_dc" class="mWt100" value="" placeholder="할인" />
								<select name="pm_dc_per" class="mWt120">
									<option value="A">정률 (%)</option>
									<option value="B">정액(원)</option>
								</select>
							</div> <!-- edis_1 -->

							<div class="edis_3">
								<div class="multi_wrap mt5">
									<select name="dc_product" class="wAuto select2-view">
										<option value=''>선택</option>
										<?foreach($pd_rows as $pd_row) echo '<option value="'.$pd_row['pd_pid'].'">'.$pd_row['pd_name'].'</option>';?>
									</select>
									<button type='button' class='bt_black' onclick='add_d_kind()'>추가</button>
									<div  id="d_kind"></div>
								</div> <!-- multi_wrap -->
							</div> <!-- edis_3 -->
						</td>
					</tr>
					<tr>
						<th>대상</th>
						<td colspan="3">
							<div class="e_target">
								<label class="radioWrap"><input type="radio" name="pm_mem_kind" value="A" checked /><i></i><span>회원등급별</span></label>
								<label class="radioWrap ml20"><input type="radio" name="pm_mem_kind" value="B"  /><i></i><span>회원별</span></label>
								<label class="radioWrap ml20"><input type="radio" name="pm_mem_kind" value="C"  /><i></i><span>매출처별</span></label>
							</div> <!-- e_target -->

							<div >
								<div class="multi_wrap mt5 ">
									<input type='hidden' name='pm_mem_list'>
									<select name="pm_mem_level" id="" class="wAuto etar_1">
										<option value="">VIP1</option>
									</select>
									<input type='hidden' name='pm_mem_pid'>
									<input type='text' name="pm_mem_val" id="" class="wAuto etar_2" placeholder='회원명, 회원코드' onkeyUp='sch_cus(this.value)'>
									<div id='mem_list' class="d_none_no_im">
										<table class="ltable_1 t_effect_1">
											<thead>
											<tr>
												<th>코드</th><th>이름</th><th>전화번호</th>
											</tr>
											</thead>
											<tbody  id='mem_table'>
											</tbody>
										</table>
									</div>


									<select name="pm_mem_cus" id="" class="wAuto etar_3">
										<option value="">VIP3</option>
									</select>

									<button type='button' class='bt_black' onclick='add_m_kind()'>추가</button>
									<div  id="m_kind"></div>
								</div> <!-- multi_wrap -->
							</div> <!-- etar_1 -->


						</td>
					</tr>
					<tr>
						<th>적용우선순위</th>
						<td colspan="3"><input type="number" name="pm_order" class="mWt100" value="" /></td>
					</tr>
					<tr>
						<th>중복적용여부</th>
						<td colspan="3">
							<label class="radioWrap"><input type="radio" name="pm_over" value="Y" checked /><i></i><span>중복할인</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pm_over" value="N"  /><i></i><span>중복불가</span></label>
						</td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
		</form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
	$(".select2-view").select2({width:'100px'});

	$("select[name='pm_standard_kind']").on("change", function(){
		if(this.value == 'A') {
			$(".s_prod").show();
			$(".s_cate").hide();
			$(".s_cus").hide();
		} else if(this.value == 'B') {
			$(".s_prod").hide();
			$(".s_cate").show();
			$(".s_cus").hide();
		} else {
			$(".s_prod").hide();
			$(".s_cate").hide();
			$(".s_cus").show();
		}
		$("#s_kind").html('');
	});
	// 행사등록 기준 선택
	$(".e_standard > label > input[type=radio]").on("click",function(){
		var es_val = $(".e_standard > label > input[type=radio]:checked").val();
		if(es_val === "A"){
			$(".esta_2").hide();
			$(".esta_1").show();
		}else if(es_val === "B"){
			$(".esta_1").hide();
			$(".esta_2").show();
		}
	});

	// 행사등록 할인 선택
	$(".e_discount > label > input[type=radio]").on("click",function(){
		var ed_val = $(".e_discount > label > input[type=radio]:checked").val();
		if(ed_val === "A" || ed_val === "B"){
			$(".edis_3").hide();
			$(".edis_1").show();
		}
		else if(ed_val === "C"){
			$(".edis_1").hide();
			$(".edis_3").show();
		}
	});

	// 행사등록 대상 선택
	$(".e_target > label > input[type=radio]").on("click",function(){
		var et_val = $(".e_target > label > input[type=radio]:checked").val();
		if(et_val === "A"){
			$(".etar_2").hide();
			$(".etar_3").hide();
			$(".etar_1").show();
		}else if(et_val === "B"){
			$(".etar_1").hide();
			$(".etar_3").hide();
			$(".etar_2").show();
		}
		else if(et_val === "C"){
			$(".etar_1").hide();
			$(".etar_2").hide();
			$(".etar_3").show();
		}
	});

	function add_s_kind() {

		if($("select[name='pm_standard_kind']").val() == 'A') {
			pid = $("select[name='st_product']").val();
			text = $("select[name='st_product'] option:checked").text();
		} else if($("select[name='pm_standard_kind']").val() == 'B') {
			pid1 = $("select[name='st_category']").val();
			text1 = $("select[name='st_category'] option:checked").text();
			pid2 = $("select[name='st_category2']").val();
			text2 = $("select[name='st_category2'] option:checked").text();
			pid3 = $("select[name='st_category3']").val();
			text3 = $("select[name='st_category3'] option:checked").text();
			pid = pid1;
			text = text1;
			if(pid2) {
				pid += ">"+pid2;
				text += ">"+text2;
			}
			if(pid3) {
				pid += ">"+pid3;
				text += ">"+text2;
			}
		} else {
			pid = $("select[name='s_tcustomer']").val();
			text = $("select[name='s_tcustomer'] option:checked").text();
		}

		if($("#s_kind > span[pid='"+pid+"']").html() != undefined) {
			return;
		}


		html = '<span class="multi_val" onclick="$(this).remove()" pid="'+pid+'">'+text+'</span>';

		$("#s_kind").append(html);
	}

	function form_check(f) {
		alert("a")
		$("input[name='pm_standard_list']").val('');
		if($("input[name='pm_standard']:checked").val() == 'B') {
			var p_list = '';
			st_pid = Array();
			$("#s_kind > span").each(function() {
				st_pid.push($(this).attr("pid")+"ㅫ"+$(this).text());
			});

			$("input[name='pm_standard_list']").val(st_pid.join("ㅩ"));
		}


		var p_list = '';
		me_pid = Array();
		$("#m_kind > span").each(function() {
			me_pid.push($(this).attr("pid")+"ㅫ"+$(this).text());
		});

		$("input[name='pm_mem_list']").val(me_pid.join("ㅩ"));

		f.submit();

	}

	function sch_cus(v) {
		if(v.length > 1) {
			searchKey = Array("a.mb_name", "a.mb_code");
			$.ajax({
				data: {mode:'serch_member', searchKey:searchKey, searchWord:v, mode2 :'table'},
				type: "POST",
				url: "/Customer/ajax_request",
				cache: false,
				dataType:'html',
				success: function(res) {
					$("#mem_table").html(res);
					$("#mem_list").show();
				}
			});
		} else {
			$("#mem_list").hide();
		}
	}

	function cus_click(pid, name) {
		$("input[name='pm_mem_pid']").val(pid);
		$("input[name='pm_mem_val']").val(name);
		$("#mem_list").hide();
	}

	function add_m_kind() {
		val =$("input[name='pm_mem_kind']:checked").val() ;
		if(val == 'A') {
			pid = $("select[name='pm_mem_level']").val();
			text = $("select[name='pm_mem_level'] option:checked").text();
		} else if(val == 'B') {
			pid = $("input[name='pm_mem_pid']").val();
			text = $("input[name='pm_mem_val']").val();
		} else {
			pid = $("select[name='pm_mem_cus']").val();
			text = $("select[name='pm_mem_cus'] option:checked").text();
		}

		if($("#m_kind > span[pid='"+pid+"']").html() != undefined) {
			return;
		}


		html = '<span class="multi_val" onclick="$(this).remove()" pid="'+pid+'">'+text+'</span>';

		$("#m_kind").append(html);
	}
</script>