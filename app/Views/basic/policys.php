
            <section>
                <div class="contents">
					<?
        include_once APPPATH.'/Views/_page_path.php';
?>

					 <div class="tab_wrap mt10 mWt900">
                        <div class="tab_base">
                            <a href="#m_tab1" title="m_tab1" id="a_t1" class="active">할인설정</a>
                            <a href="#m_tab2" title="m_tab2" id="a_t2">회원등급설정</a>
							<a href="#m_tab3" title="m_tab3" id="a_t3">적립금설정</a>
							<a href="#m_tab4" title="m_tab4" id="a_t4">상품권설정</a>
							<a href="#m_tab5" title="m_tab5" id="a_t5">계좌번호설정</a>
							<a href="#m_tab6" title="m_tab6" id="a_t6">기본배송비설정</a>
							<a href="#m_tab7" title="m_tab7" id="a_t7">주문처리단계설정</a>
                        </div> <!-- tab_base -->


					<div id="m_tab1" class="tab_base_con t_block">
						<form name='cf1' id='cf1' method="post" onsubmit="" target="hiddenFrame" action="/basic/execute">
						<input type='hidden' name='mode' value='reg_config'>
						<div class="title_1">할인 설정</div>
						<div class="mt20"><label class="radioWrap"><input type="radio" name="cf_dc_kind" value="Y" <?=$row['cf_dc_kind'] != 'N' ? 'checked':''?> /><i></i><span class="fs14">자동할인 (주문 등록시 자동으로 할인금액 계산 (프로모션 + 상품권할인)</span></label></div>
						<div class="gray_box_ml20">
							<div>
								<span class="fs14 fw6">특별할인과 상품권할인 적용 순서 : </span>
								<label class="radioWrap ml20"><input type="radio" name="cf_cd_order" value="Y"  <?=$row['cf_cd_order'] != 'N' ? 'checked':''?> /><i></i><span>정상가 기준 동시적용</span></label>
								<label class="radioWrap ml20"><input type="radio" name="cf_cd_order" value="N"  <?=$row['cf_cd_order'] == 'N' ? 'checked':''?>/><i></i><span>1.특별할인, 2.상품권할인 순차적용</span></label>
							</div>

							<div class="mt10">
								<span class="fs14 fw6">상품권과 적립금 동시 사용 가능 여부 : </span>
								<label class="radioWrap ml20"><input type="radio" name="cf_over_use" value="Y"  <?=$row['cf_over_use'] != 'N' ? 'checked':''?> /><i></i><span>사용가능</span></label>
								<label class="radioWrap ml20"><input type="radio" name="cf_over_use" value="N"  <?=$row['cf_over_use'] == 'N' ? 'checked':''?>/><i></i><span>사용불가</span></label>
							</div>
						</div> <!-- gray_box_ml20 -->
						<div class="mt20"><label class="radioWrap"><input type="radio" name="cf_dc_kind" value="N" <?=$row['cf_dc_kind'] == 'N' ? 'checked':''?> /><i></i><span class="fs14">수동할인 (자동 계산되는 할인은 없으며, 할인이 필요한 경우 판매단가를 수동으로 입력)</span></label></div>

						<div class="mt50 buttonCenter"><button type="submit" class="bt_150_40 bt_black" onclick="">저장</button></div>
						</form>
					</div> <!-- m_tab1 -->


					<div id="m_tab2" class="tab_base_con">
						<form name='cf1' id='cf1' method="post" onsubmit="" target="hiddenFrame" action="/basic/execute">
						<input type='hidden' name='mode' value='reg_config'>
						<div class="title_2">
							<div>회원등급 설정</div>
						</div> <!-- title_2 -->

						<div class="table_wrap mt10">
							<table class="ltable_1 grade_table" id="">
								<thead>
									<tr>
										<th>등급명</th>
										<th>결제금액</th>
										<th>추가적립</th>
										<th>수동/자동</th>
										<th>사용여부</th>
										<th>삭제</th>
									</tr>
								</thead>
								<tbody id="p_list">
									<?
										if(count($level_rows) == 0) {
											$level_rows[]['one'] = "one";
										}
										foreach($level_rows as $l_row) {
									?>
									<tr>
										<td><input type="text" name="ml_name[]" class="mWt200" value="<?=$l_row['ml_name']?>" /><input type="hidden" name="ml_pid[]" class="mWt200" value="<?=$l_row['ml_pid']?>" /></td>
										<td><input type="text" name="ml_min[]" class="mWt120 txar input-comma" value="<?=$l_row['ml_min']?>" /> ~ <input type="text" name="ml_max[]" class="mWt120 txar input-comma" value="<?=$l_row['ml_max']?>" /></td>
										<td><input type="text" name="ml_add_point[]" class="mWt100 txar" value="<?=$l_row['ml_add_point']?>" maxlength='3'/> %</td>
										<td>
											<select name="ml_auto[]" class="mWt100">
												<option value="Y" <?=$l_row['ml_auto'] == 'Y' ? 'selected':''?>>자동</option>
												<option value="N" <?=$l_row['ml_auto'] == 'N' ? 'selected':''?>>수동</option>
											</select>
										</td>
										<td>
											<select name="ml_use[]" class="mWt100">
												<option value="Y" <?=$l_row['ml_use'] == 'Y' ? 'selected':''?>>Y</option>
												<option value="N" <?=$l_row['ml_use'] == 'N' ? 'selected':''?>>N</option>
											</select>
										</td>
										<td><button type="button" class="bt_red grade_del" onclick="">삭제</button></td>
									</tr>
									<?}?>
								</tbody>
							</table>
						</div> <!-- table_wrap -->
						<div class="buttonCenter mt20">
							<button type="button" class="bt_gray" onclick="grade_add();">+ 추가</button>
						</div> <!-- buttonCenter -->

						<div class="title_1_1 mt20">자동 산출기간</div>
						<div>
							<label class="radioWrap ml20"><input type="radio" name="cf_ml_period" value="A" <?=$row['cf_ml_period'] == 'A' ? 'checked':''?> /><i></i><span>제한없음</span></label>
							<label class="radioWrap ml30"><input type="radio" name="cf_ml_period" value="B" <?=$row['cf_ml_period'] == 'B' ? 'checked':''?>/><i></i><span>적용일로부터</span></label>
							<select name="cf_ml_period_month" class="mWt50" dir="rtl">
								<?for($i=0;$i<13;$i++){?>
								<option value="<?=$i?>" <?=$i == $row['cf_ml_period_month'] ? 'selected':''?>><?=$i?></option>
								<?}?>
							</select> 개월 전
							<label class="radioWrap ml30"><input type="radio" name="cf_ml_period" value="C" <?=$row['cf_ml_period'] == 'C' ? 'checked':''?>/><i></i><span>전년도 결제금액</span></label>
						</div>

						<div class="title_1_1 mt20">자동 적용기준</div>
						<div>
							<select name="cf_ml_auto_month" class="mWt60" dir="rtl">
								<?for($i=0;$i<13;$i++){?>
								<option value="<?=$i?>" <?=$i == $row['cf_ml_auto_month'] ? 'selected':''?>><?=$i?></option>
								<?}?>
							</select> 개월
							<select name="cf_ml_auto_day" class="mWt60 ml20" dir="rtl">
								<?for($i=0;$i<31;$i++){?>
								<option value="<?=$i?>" <?=$i == $row['cf_ml_auto_month'] ? 'selected':''?>><?=$i?></option>
								<?}?>
							</select> 일 마다 (ex) 2020년 11월 8일에 적용 후 2개월 3일 으로 설정시 2021년 1월 3일에 적용)
						</div>
						<div class="mt50 buttonCenter"><button type="submit" class="bt_150_40 bt_black" onclick="">저장</button></div>
						</form>
					</div> <!-- m_tab2 -->

					<div id="m_tab3" class="tab_base_con">
						<form name='cf3' id='cf3' method="post" onsubmit="" target="hiddenFrame" action="/basic/execute">
						<input type='hidden' name='mode' value='reg_config'>
						<div class="title_2">
							<div>적립금 설정</div>
						</div> <!-- title_2 -->

						<div class="table_wrap">
							<table class="itable_1">
								<tbody>
									<tr>
										<th class="mWt200">적립금 기본설정</th>
										<td>총 결제금액의 <input type="text" name="cf_point_basic" class="mWt60 txar input-comma" value="<?=number_format($row['cf_point_basic'])?>" /> %를 배송완료시 적립</td>
									</tr>
									<tr>
										<th>적립금 사용조건</th>
										<td>총 결제금액이 <input type="text" name="cf_point_use_price" class="mWt100 txar input-comma" value="<?=number_format($row['cf_point_use_price'])?>" /> 원 이상일 때 사용가능</td>
									</tr>
									<tr>
										<th>적립금 최소 사용금액</th>
										<td>최소 <input type="text" name="cf_point_min_price" class="mWt100 txar input-comma" value="<?=number_format($row['cf_point_min_price'])?>" /> 원 이상부터 사용가능</td>
									</tr>
									<tr>
										<th>적립금 절사기준</th>
										<td>
											<select name="cf_point_cut" class="mWt150" dir="rtl">
												<?for($i=1;$i<10000;$i=$i*10){?>
												<option value="<?=$i?>" <?=$i == $row['cf_point_cut'] ? "selected":""?>><?=$i?>원단위절사</option>
												<?}?>
											</select>
											※ 1원단위 절사이면 99.5원 계산시 90원 지급
										</td>
									</tr>
									<tr>
										<th>적립금 소멸 설정</th>
										<td>
											<label class="radioWrap"><input type="radio" name="cf_point_del" value="N" <?=$row['cf_point_del'] != 'Y' ? "checked":""?> /><i></i><span>소멸없음</span></label>
											<label class="radioWrap ml30"><input type="radio" name="cf_point_del" value="Y"  <?=$row['cf_point_del'] == 'Y'  ? "checked":""?>/><i></i><span>적립일로부터일 <input type="text" name="cf_point_del_day" class="mWt60 txar" value="<?=$row['cf_point_del_day']?>" />이후 자동 소멸</span></label>
										</td>
									</tr>
								</tbody>
							</table> <!-- itable_1 -->
						</div> <!-- table_Wrap -->
						<div class="mt50 buttonCenter"><button type="submit" class="bt_150_40 bt_black" onclick="">저장</button></div>
						</form>
					</div> <!-- m_tab3 -->

					<div id="m_tab4" class="tab_base_con">
						<div class="title_2">
							<div>상품권 설정</div>
							<div><button type="button" class="bt_black" onclick="giftcard_reg();">상품권 등록</button></div>
						</div> <!-- title_2 -->

						<div class="table_wrap mt10">
							<table class="ltable_1 t_effect_1" id="">
								<thead>
									<tr>
										<th>상품권명</th>
										<th>할인혜택</th>
										<th>사용기간</th>
										<th>사용가능횟수</th>
										<th>사용유무</th>
										<th class="mWt150">혜택설정</th>
									</tr>
								</thead>
								<tbody id="">
									<?
									if(count($gift_rows) > 0) {
									foreach($gift_rows as $g_row) {
									?>
									<tr>
										<td><?=$g_row['gt_name']?></td>
										<td><?=$g_row['gt_dc']?><?=$g_row['gt_type'] == 'A' ? '%':'원'?></td>
										<td><?=$g_row['gt_limit'] == 'A' ? '무제한':'지급일로부터 '.$g_row['gt_limit_day'].'일'?> </td>
										<td><?=$g_row['gt_use_cnt'] == 'A' ? '무제한':'일회용'?></td>
										<td><?=$g_row['gt_use']?></td>
										<td>
											<button type="button" class="small set_button" onclick="giftcard_reg('<?=$g_row['gt_pid']?>');">수정</button>
											<button type="button" class="small bt_red" onclick="confirmBox('삭제하시겠습니가?', del_gift, '<?=$g_row['gt_pid']?>')">삭제</button>
										</td>
									</tr>
									<?
										}
									} else echo '<tr><td colspan="6">내역이 존재하지 않습니다.</td></tr>';
									?>
								</tbody>
							</table>
						</div> <!-- table_wrap -->
					</div> <!-- m_tab4 -->

					<div id="m_tab5" class="tab_base_con">
						<div class="mWt50p">
							<div class="title_2">
								<div>계좌번호 설정 <span class="ml20 fs13 fw5">※ 은행명은 코드관리에서 등록합니다.</span></div>
							</div> <!-- title_2 -->

							<div class="table_wrap mt10">
								<table class="ltable_1 t_effect_1" id="">
									<thead>
										<tr>
											<th class="mWt200">은행명</th>
											<th>계좌번호</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>국민</td>
											<td><input type="text" name="" class="mWt90p" value="" /></td>
										</tr>
										<tr>
											<td>신한</td>
											<td><input type="text" name="" class="mWt90p" value="" /></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</div> <!-- mWt50p -->
						<div class="mt50 buttonCenter"><button type="button" class="bt_150_40 bt_black" onclick="">저장</button></div>
					</div> <!-- m_tab5 -->

					<div id="m_tab6" class="tab_base_con">
						<form name='cf6' id='cf6' method="post" onsubmit="" target="hiddenFrame" action="/basic/execute">
						<input type='hidden' name='mode' value='reg_config'>
						<div class="title_2">
							<div>기본배송비 설정</div>
						</div> <!-- title_2 -->

						<div class="table_wrap mt10">
							<table class="ltable_1" id="">
								<thead>
									<tr>
										<th>종류</th>
										<th>설정</th>
										<th class="mWt70">기본설정</th>
										<th class="mWt60p">설명</th>
									</tr>
								</thead>
								<tbody id="">
									<tr>
										<td>기본 배송비</td>
										<td><input type="text" name="cf_delivery_charge_basic" class="mWt120 txar input-comma" value="<?=number_format($row['cf_delivery_charge_basic'])?>" /></td>
										<td><label class="radioWrap"><input type="radio" name="cf_delivery_charge_kind" value="A" <?=$row['cf_delivery_charge_kind'] == 'A' ? "checked":""?>/><i></i></label></td>
										<td class="txal"></td>
									</tr>
									<tr>
										<td>개별 배송비</td>
										<td></td>
										<td><label class="radioWrap"><input type="radio" name="cf_delivery_charge_kind" value="B" <?=$row['cf_delivery_charge_kind'] == 'B' ? "checked":""?>/><i></i></label></td>
										<td class="txal">※ 해당 상품의 수량별 배송비를 별도로 입력할 수 있습니다.</td>
									</tr>
									<tr>
										<td>직배송비</td>
										<td><button type="button" class="bt_sblue" onclick="direct_cost('A');">상세보기</button></td>
										<td><label class="radioWrap"><input type="radio" name="cf_delivery_charge_kind" value="C" <?=$row['cf_delivery_charge_kind'] == 'C' ? "checked":""?>/><i></i></label></td>
										<td class="txal">※ 매입처가 직배송하는 상품인 경우 해당 거래처의 책정 배송비를 설정합니다. </td>
									</tr>
									<tr>
										<td>수량별 배송비</td>
										<td><button type="button" class="bt_sblue" onclick="direct_cost('B');">상세보기</button></td>
										<td><label class="radioWrap"><input type="radio" name="cf_delivery_charge_kind" value="D" <?=$row['cf_delivery_charge_kind'] == 'D' ? "checked":""?>/><i></i></label></td>
										<td class="txal">
											<div>※  해당 상품의 상품수량(부피,무게를 고려한) 배송비가 다른 경우 설정합니다.</div>
											<div class="mt5">※  여러 개의 수량별 배송비 설정 가능</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div> <!-- table_wrap -->
						<div class="precautions_1 mt10">※ 상품 등록시 기본배송비 / 개별배송비 / 수량별배송비 / 직배송비 중 한가지 설정 가능 / 배송비 할인을 적용할지 여부 설정 가능</div>
						<div class="title_1_1 mt20">기본 배송타입 설정 <span class="fw5">(상품 등록시 자동 설정되는 배송타입)</span></div>
						<div>
							<label class="radioWrap ml10"><input type="radio" name="cf_delivery_type" value="A" <?=$row['cf_delivery_type'] == 'A' ? "checked":""?> /><i></i><span>택배배송</span></label>
							<label class="radioWrap ml30"><input type="radio" name="cf_delivery_type" value="B" <?=$row['cf_delivery_type'] == 'B' ? "checked":""?>/><i></i><span>기사배송</span></label>
						</div>
						<div class="mt50 buttonCenter"><button type="submit" class="bt_150_40 bt_black" onclick="">저장</button></div>
						</form>
					</div> <!-- m_tab6 -->

					<div id="m_tab7" class="tab_base_con">
						<div class="title_2">
							<div>주문 처리단계 설정</div>
						</div> <!-- title_2 -->

						<div class="table_wrap">
							<form name='cf7' id='cf7' method="post" onsubmit="" target="hiddenFrame" action="/basic/execute">
							<input type='hidden' name='mode' value='reg_config'>
							<input type='hidden' name='ckmode' value='cf7'>
							<table class="itable_1">
								<tbody>
									<tr>
										<th class="mWt150" rowspan="2">입금확인</th>
										<th class="mWt150">일반주문</th>
										<td class="mWt100"><label class="chkWrap"><input type="checkbox" name="cf_order_deposit_use" value="Y" <?=$row['cf_order_deposit_use'] == 'Y' ? "checked":""?>/><i></i><span>필수</span></label></td>
										<td rowspan="2">
											※ 외상발송 가능 여부 설정<br />
											(‘입금확인’이 되어야지만 ‘상품결재’, ‘발송준비중’ 처리가능)
										</td>
									</tr>
									<tr>
										<th>교환주문</th>
										<td><label class="chkWrap"><input type="checkbox" name="cf_exchange_deposit_use" value="Y" <?=$row['cf_exchange_deposit_use'] == 'Y' ? "checked":""?>/><i></i><span>필수</span></label></td>
									</tr>
									<tr>
										<th rowspan="2">상품결재</th>
										<th>일반주문</th>
										<td><label class="chkWrap"><input type="checkbox" name="cf_order_approval_use" value="Y" <?=$row['cf_order_approval_use'] == 'Y' ? "checked":""?>/><i></i><span>필수</span></label></td>
										<td rowspan="2">
											※ 관리자 주문 ‘승인’ 설정<br />
											(‘상품결재’가 되어야지만 ‘발송준비중’ 처리가능)
										</td>
									</tr>
									<tr>
										<th>교환주문</th>
										<td><label class="chkWrap"><input type="checkbox" name="cf_exchange_approval_use" value="Y" <?=$row['cf_exchange_approval_use'] == 'Y' ? "checked":""?>/><i></i><span>필수</span></label></td>
									</tr>
									<tr>
										<th colspan="2">[교환주문] 관리자 발송승인 여부</th>
										<td><label class="chkWrap"><input type="checkbox" name="cf_order_admin_use" value="Y" <?=$row['cf_order_admin_use'] == 'Y' ? "checked":""?>/><i></i><span>필수</span></label></td>
										<td>
											※ 관리자 교환주문 발송 ‘승인’ 설정 (선발송, 후발송)<br />
											(필수가 아닌 경우, 교환주문 접수자가 ‘승인’  가능)
										</td>
									</tr>
									<tr>
										<th colspan="2">[택배배송] 자동 배송완료일 설정</th>
										<td colspan="2">배송일로부터 <input type="text" name="cf_delivery_date" class="mWt60 txar" value="<?=$row['cf_delivery_date']?>" /> 일 후 자동 배송완료 처리</td>
									</tr>
								</tbody>
							</table> <!-- itable_1 -->
						</div> <!-- table_Wrap -->
						<div class="precautions_1 mt10">※ ‘상품결재, 교환주문 발송승인’의 관리자 지정은 각 관리자의 기초관리 > 직원관리에서 설정 가능</div>
						<div class="mt50 buttonCenter"><button type="submit" class="bt_150_40 bt_black" onclick="">저장</button></div>
						</form>
					</div> <!-- m_tab7 -->
					</div><!-- tab_wrap -->
                </div> <!-- contents -->
            </section>



        <?
            include_once "pop_giftcard_reg.php"; // 상품권 등록
            include_once "pop_direct_cost.php"; // 직배송비
            include_once "pop_quantity_cost.php"; // 수량별 배송비
		?>

<script type="text/javascript">
    // 회원등급 추가
    function grade_add(){
        var gt_tr = $("#p_list tr:eq(0)").clone();
		gt_tr.find("input[type='text']").val("");
		gt_tr.find("input[type='hidden']").val("");
        var tr_last = $("#p_list");
        tr_last.append(gt_tr);
    };

    // 회원등급 삭제
    $(document).on("click",".grade_del",function(){
        var tr_length = $("table.grade_table > tbody > tr").length;
        if(tr_length > 1){
			confirmBox("삭제 하시겠습니까?", del_level, $(this));

        } else {
			alertBox("회원등급은 하나 이상이여야 합니다.");
		};
    });

    $(document).on("click","table.grade_table > tbody > tr",function(){
        $("table.grade_table > tbody > tr").removeClass("active");
        $(this).addClass("active");
    });

	function del_level(obj) {
		tr = $(obj).parents("tr");
		ml_pid = tr.find("input[name='ml_pid[]']").val();
		if(ml_pid) {
			$.ajax({
				data : {mode:'del_level',ml_pid:ml_pid},
				url : 'execute',
				dataType : 'json',
				type : 'POST',
				cache: false,
				success : function(res) {
					alertbox(res.msg);
					$(obj).parents("tr").remove();
				}

			});
		} else {
			$(obj).parents("tr").remove();
		}

	}

    // 상품권 등록
    function giftcard_reg(gt_pid){
		if(gt_pid) {
			$.ajax({
				data : {mode:'get_gift',gt_pid:gt_pid},
				url : 'ajax_request',
				dataType : 'json',
				type : 'POST',
				cache: false,
				success : function(res) {
					setFormData('giftFrm', res);
					pop_modal('pop_giftcard_reg');
				}

			});
		} else {
			$("#gt_pid").val('');
			setFormData('giftFrm');
			pop_modal('pop_giftcard_reg');
		}

    }

	//상품권삭제
	function del_gift(gt_pid) {
		$.ajax({
			data : {mode:'del_gift',gt_pid:gt_pid},
			url : 'execute',
			dataType : 'json',
			type : 'POST',
			cache: false,
			success : function(res) {
				alertBox(res.msg);
				location.reload();
			}

		});
	}

	 // 직배송비
    function direct_cost(kind){

		$("#dc_kind").val(kind);
		if(kind == 'A') {
			$("#dc_title").text("직배송비 설정");
		} else {
			$("#dc_title").text("수량별 배송비 설정");
		}

		dCharge_list(kind)
		pop_modal('pop_direct_cost');


    }

	function dCharge_list(kind) {
		reset_charge();
		$.ajax({
			data : {mode:'get_dcharge_list',kind:kind},
			url : 'ajax_request',
			dataType : 'html',
			type : 'POST',
			cache: false,
			success : function(res) {
				$("#d_list").html(res);
			}

		});
	}

	 // 수량별 배송비
    function quantity_cost(){
        pop_modal('pop_quantity_cost');
    }

	function mod_dcharge(pid, name, cnt, price) {
		$("#dc_pid").val(pid);
		$("#dc_name").val(name);
		$("#dc_delivery_charge_cnt").val(cnt);
		$("#dc_delivery_charge").val(price);
	}

	function reset_charge() {
		f= document.forms['chargeFrm'];
		f.reset();
		f.dc_pid.value = '';
	}

	function del_dcharge(dc_pid) {
		$.ajax({
			data : {mode:'del_dcharge',dc_pid:dc_pid},
			url : 'execute',
			dataType : 'json',
			type : 'POST',
			cache: false,
			success : function(res) {
				alertBox(res.msg, dCharge_list, $("#dc_kind").val());

			}

		});
	}

</script>