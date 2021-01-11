<?            
        include_once "../common/inc/head.php"; // head
	?>
    <body>
        <?            
            include_once "../common/inc/header.php"; // header
        ?>
        <div class="container">
            <?            
                include_once "../common/inc/left_nav.php"; // left_nav
            ?>    
            <section>
                <div class="contents">
					<?            
						include_once "../common/inc/page_name.php"; // page_name
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
						<div class="title_1">할인 설정</div>
						<div class="mt20"><label class="radioWrap"><input type="radio" name="할인설정" value="" checked /><i></i><span class="fs14">자동할인 (주문 등록시 자동으로 할인금액 계산 (프로모션 + 상품권할인)</span></label></div>
						<div class="gray_box_ml20">
							<div>
								<span class="fs14 fw6">특별할인과 상품권할인 적용 순서 : </span>
								<label class="radioWrap ml20"><input type="radio" name="특별할인" value="" checked /><i></i><span>정상가 기준 동시적용</span></label>
								<label class="radioWrap ml20"><input type="radio" name="특별할인" value="" /><i></i><span>1.특별할인, 2.상품권할인 순차적용</span></label>
							</div>

							<div class="mt10">
								<span class="fs14 fw6">상품권과 적립금 동시 사용 가능 여부 : </span>
								<label class="radioWrap ml20"><input type="radio" name="동시사용" value="" checked /><i></i><span>사용가능</span></label>
								<label class="radioWrap ml20"><input type="radio" name="동시사용" value="" /><i></i><span>사용불가</span></label>
							</div>
						</div> <!-- gray_box_ml20 -->
						<div class="mt20"><label class="radioWrap"><input type="radio" name="할인설정" value="" /><i></i><span class="fs14">수동할인 (자동 계산되는 할인은 없으며, 할인이 필요한 경우 판매단가를 수동으로 입력)</span></label></div>
					</div> <!-- m_tab1 -->

					<div id="m_tab2" class="tab_base_con">
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
								<tbody id="">                                        
									<tr>
										<td><input type="text" name="" class="mWt200" value="" /></td>
										<td><input type="text" name="" class="mWt120 txar" value="" /> ~ <input type="text" name="" class="mWt120 txar" value="" /></td>
										<td><input type="text" name="" class="mWt100 txar" value="" /> %</td>
										<td>
											<select name="" class="mWt100">
												<option value="">자동</option>
												<option value="">수동</option>
											</select>
										</td>
										<td>
											<select name="" class="mWt100">
												<option value="">Y</option>
												<option value="">N</option>
											</select>
										</td>
										<td><button type="button" class="bt_red grade_del" onclick="">삭제</button></td>
									</tr>
								</tbody>
							</table>
						</div> <!-- table_wrap -->
						<div class="buttonCenter mt20">
							<button type="button" class="bt_gray" onclick="grade_add();">+ 추가</button>
						</div> <!-- buttonCenter -->

						<div class="title_1_1 mt20">자동 산출기간</div>
						<div>
							<label class="radioWrap ml20"><input type="radio" name="자동산출" value="" checked /><i></i><span>제한없음</span></label>
							<label class="radioWrap ml30"><input type="radio" name="자동산출" value="" /><i></i><span>적용일로부터</span></label>
							<select name="" class="mWt50" dir="rtl">
								<option value="">1</option>
							</select> 개월
							<label class="radioWrap ml30"><input type="radio" name="자동산출" value="" /><i></i><span>전년도 결제금액</span></label>
						</div>

						<div class="title_1_1 mt20">자동 적용기준</div>
						<div>
							<select name="" class="mWt60" dir="rtl">
								<option value="">1</option>
							</select> 개월
							<select name="" class="mWt60 ml20" dir="rtl">
								<option value="">1</option>
							</select> 일 마다
						</div>
						<div class="mt50 buttonCenter"><button type="button" class="bt_150_40 bt_black" onclick="">저장</button></div>
					</div> <!-- m_tab2 -->

					<div id="m_tab3" class="tab_base_con">
						<div class="title_2">
							<div>적립금 설정</div>
						</div> <!-- title_2 -->

						<div class="table_wrap">
							<table class="itable_1">
								<tbody>
									<tr>
										<th class="mWt200">적립금 기본설정</th>
										<td>총 결제금액의 <input type="text" name="" class="mWt60 txar" value="" /> %를 배송완료시 적립</td>
									</tr>
									<tr>
										<th>적립금 사용조건</th>
										<td>총 결제금액이 <input type="text" name="" class="mWt100 txar" value="" /> 원 이상일 때 사용가능</td>								
									</tr>
									<tr>
										<th>적립금 최소 사용금액</th>
										<td>최소 <input type="text" name="" class="mWt100 txar" value="" /> 원 이상부터 사용가능</td>								
									</tr>
									<tr>
										<th>적립금 절사기준</th>
										<td>
											<select name="" class="mWt150" dir="rtl">
												<option value="">1원단위절사</option>
											</select>
											※ 1원단위 절사이면 99.5원 계산시 90원 지급
										</td>
									</tr>
									<tr>
										<th>적립금 소멸 설정</th>
										<td>
											<label class="radioWrap"><input type="radio" name="적립금소멸" value="" checked /><i></i><span>소멸없음</span></label>
											<label class="radioWrap ml30"><input type="radio" name="적립금소멸" value=""  /><i></i><span>적립일로부터일 <input type="text" name="" class="mWt60 txar" value="" />이후 자동 소멸</span></label>
										</td>
									</tr>							
								</tbody>
							</table> <!-- itable_1 -->
						</div> <!-- table_Wrap -->
						<div class="mt50 buttonCenter"><button type="button" class="bt_150_40 bt_black" onclick="">저장</button></div>
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
									<?for($i=5;$i>0;$i--){?>
									<tr>
										<td>회원가입축하</td>
										<td>10%</td>
										<td>지급일로부터 30일</td>
										<td>일회용</td>
										<td>Y</td>
										<td>
											<button type="button" class="small set_button" onclick="giftcard_reg();">수정</button>    
											<button type="button" class="small bt_red" onclick="">삭제</button>
										</td>
									</tr>
									<?}?>
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
										<td><input type="text" name="" class="mWt120 txar" value="" /></td>
										<td><label class="radioWrap"><input type="radio" name="기본배송비" value="" checked/><i></i></label></td>
										<td class="txal"></td>
									</tr>
									<tr>
										<td>개별 배송비</td>
										<td></td>
										<td><label class="radioWrap"><input type="radio" name="기본배송비" value="" /><i></i></label></td>
										<td class="txal">※ 해당 상품의 수량별 배송비를 별도로 입력할 수 있습니다.</td>
									</tr>
									<tr>
										<td>직배송비</td>
										<td><button type="button" class="bt_sblue" onclick="direct_cost();">상세보기</button></td>
										<td><label class="radioWrap"><input type="radio" name="기본배송비" value="" /><i></i></label></td>
										<td class="txal">※ 매입처가 직배송하는 상품인 경우 해당 거래처의 책정 배송비를 설정합니다. </td>
									</tr>
									<tr>
										<td>수량별 배송비</td>
										<td><button type="button" class="bt_sblue" onclick="quantity_cost();">상세보기</button></td>
										<td><label class="radioWrap"><input type="radio" name="기본배송비" value="" /><i></i></label></td>
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
							<label class="radioWrap ml10"><input type="radio" name="배송타입" value="" checked /><i></i><span>택배배송</span></label>
							<label class="radioWrap ml30"><input type="radio" name="배송타입" value="" /><i></i><span>기사배송</span></label>
						</div>
						<div class="mt50 buttonCenter"><button type="button" class="bt_150_40 bt_black" onclick="">저장</button></div>
					</div> <!-- m_tab6 -->

					<div id="m_tab7" class="tab_base_con">
						<div class="title_2">
							<div>주문 처리단계 설정</div>
						</div> <!-- title_2 -->

						<div class="table_wrap">
							<table class="itable_1">
								<tbody>
									<tr>
										<th class="mWt150" rowspan="2">입금확인</th>
										<th class="mWt150">일반주문</th>
										<td class="mWt100"><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>필수</span></label></td>
										<td rowspan="2">
											※ 외상발송 가능 여부 설정<br />
											(‘입금확인’이 되어야지만 ‘상품결재’, ‘발송준비중’ 처리가능)
										</td>
									</tr>
									<tr>
										<th>교환주문</th>
										<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>필수</span></label></td>                                    
									</tr>
									<tr>
										<th rowspan="2">상품결재</th>
										<th>일반주문</th>
										<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>필수</span></label></td>
										<td rowspan="2">
											※ 관리자 주문 ‘승인’ 설정<br />
											(‘상품결재’가 되어야지만 ‘발송준비중’ 처리가능)
										</td>
									</tr>
									<tr>
										<th>교환주문</th>
										<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>필수</span></label></td>                                    
									</tr>
									<tr>
										<th colspan="2">[교환주문] 관리자 발송승인 여부</th>
										<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>필수</span></label></td>                                                                        
										<td>
											※ 관리자 교환주문 발송 ‘승인’ 설정 (선발송, 후발송)<br />
											(필수가 아닌 경우, 교환주문 접수자가 ‘승인’  가능)
										</td>
									</tr>
									<tr>
										<th colspan="2">[택배배송] 자동 배송완료일 설정</th>
										<td colspan="2">배송일로부터 <input type="text" name="" class="mWt60 txar" value="" /> 일 후 자동 배송완료 처리</td>
									</tr>							
								</tbody>
							</table> <!-- itable_1 -->
						</div> <!-- table_Wrap -->
						<div class="precautions_1 mt10">※ ‘상품결재, 교환주문 발송승인’의 관리자 지정은 각 관리자의 기초관리 > 직원관리에서 설정 가능</div>
						<div class="mt50 buttonCenter"><button type="button" class="bt_150_40 bt_black" onclick="">저장</button></div>
					</div> <!-- m_tab7 -->
					</div><!-- tab_wrap -->
                </div> <!-- contents -->
            </section>
        </div> <!-- container -->
		 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>

        <?
            include_once "pop_giftcard_reg.php"; // 상품권 등록
            include_once "pop_direct_cost.php"; // 직배송비
            include_once "pop_quantity_cost.php"; // 수량별 배송비
		?>
	</body>
</html>

<script type="text/javascript">
    // 회원등급 추가
    function grade_add(){
        var gt_tr = $("table.grade_table > tbody > tr").eq(0).html();        
        var tr_html = "<tr>";
            tr_html += gt_tr;
            tr_html += "</tr>";
        var tr_last = $("table.grade_table > tbody > tr:last");
        tr_last.after(tr_html);
    };

    // 회원등급 삭제
    $(document).on("click",".grade_del",function(){
        var tr_length = $("table.grade_table > tbody > tr").length;
        if(tr_length > 1){
            $(this).parents("tr").remove();
        };
    });

    $(document).on("click","table.grade_table > tbody > tr",function(){
        $("table.grade_table > tbody > tr").removeClass("active");
        $(this).addClass("active");
    });

    // 상품권 등록
    function giftcard_reg(){
        modal('pop_giftcard_reg');
    }

	 // 직배송비
    function direct_cost(){
        modal('pop_direct_cost');
    }

	 // 수량별 배송비
    function quantity_cost(){
        modal('pop_quantity_cost');
    }

</script>