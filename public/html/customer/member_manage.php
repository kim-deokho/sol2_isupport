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

                    <div class="search_box mt10">						
                        <div class="box_row">
                            <span class="row2_span">고객검색</span>
                            <div class="row2_div">
                                <div>
                                    <select name="" class="wAuto">
                                        <option value="">이름</option>
                                    </select>                            				
                                    <input type="text" name="" class="mWt300" value="" placeholder="검색어" />
                                    <button type="button" class="bt_navy ml10" onclick="">조회</button><br />
                                </div>

                                <div class="mt5">
                                    <select name="" class="mWt700">
                                        <option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>
                                    </select>
                                </div>
                            </div> <!-- row2_div -->
                            
                            <div class="po_right mt13">
                                <button type="button" class="bt_150_40 bt_black" onclick="member_reg();">신규회원등록</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="m_manage_wrap">
                        <div class="mm_left_con">
                            <div class="title_2 mb5">
                                <div>
                                    고객기본정보
                                    <button type="button" class="bt_black ml10" onclick="">저장</button>
                                </div>

                                <div>
                                    <button type="button" class="bt_gray ml5" onclick="adress_reg();">배송지등록</button>
                                    <button type="button" class="set_button ml5" onclick="order_reg();">주문등록</button>
                                </div>
                            </div> <!-- title_2 -->

                            <div class="table_wrap mem_info">
                                <!-- 휴면계정일경우 시작 -->
                                <div class="dormant_wrap">
                                    <div class="dormant_bg"></div>
                                    <div class="dormant_text">휴면계정 입니다.</div>
                                </div> <!-- dormant_wrap -->                        
                                <!-- 휴면계정일경우 끝 -->
                            
                                <table class="itable_1">
									<tbody>
										<tr>
											<th class="mWt70">이름</th>
											<td class=""><input type="text" name="" class="mWt120" value="" /></td>
											<th class="mWt70">고객코드</th>
											<td><input type="text" name="" class="mWt120" value="" readonly /></td>
											<th class="mWt70">등록일</th>
											<td class=""><input type="text" name="" class="mWt100" value="" readonly /></td>
										</tr>
										<tr>
											<th>전화1</th>
											<td>
												<input type="text" name="" class="mWt120" value="" />
												<input type="text" name="" class="mWt50" value="" />
											</td>
											<th>담당자</th>
											<td><input type="text" name="" class="mWt120" value="" /></td>
											<th>수정일</th>
											<td><input type="text" name="" class="mWt100" value="" readonly /></td>                                    
										</tr>
										<tr>
											<th>전화2</th>
											<td>
												<input type="text" name="" class="mWt120" value="" />
												<input type="text" name="" class="mWt50" value="" />
											</td>
											<th>회원등급</th>
											<td>
												<select name="" class="mWt120">
													<option value="">VIP</option>
												</select>
												<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>수동</span></label>
											</td>
											<th>적립금</th>
											<td>
												<span class="vam_dib mWt120">345,000</span>
												<button type="button" class="bt_gray" onclick="">보기</button>
											</td>
										</tr>
										<tr>
											<th>전화3</th>
											<td>
												<input type="text" name="" class="mWt120" value="" />
												<input type="text" name="" class="mWt50" value="" />
											</td>
											<th>최종통화일</th>
											<td>2020-02-01 12:33</td>
											<th>상품권</th>
											<td>
												<span class="vam_dib mWt120">3개</span>
												<button type="button" class="bt_gray" onclick="">보기</button>
											</td>
										</tr>
										<tr>
											<th rowspan="2">수신동의</th>
											<td rowspan="2" colspan="3">
												<div>
													<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>개인정보</span></label>
													<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>문자</span></label>
													<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>메일</span></label>
													<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>전화(마케팅)</span></label>
												</div>                                        
												<div class="mt5">(최종 설정 : 2020-02-01 12:33)</div>
											</td>                                    
											<th>예치금</th>
											<td>
												<span class="vam_dib mWt120">552,000</span>
												<button type="button" class="bt_gray" onclick="">보기</button>
											</td>
										</tr>
										<tr>
											<th>탈퇴여부</th>
											<td>
												<div>
													<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>휴면</span></label>
													<label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>탈퇴</span></label>
												</div>
												<div class="mt5">(2020-02-01 12:33)</div>
											</td>                                                                        
										</tr>
										<tr>
											<th>주소</th>
											<td colspan="5">
												<div>
													<input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
													<button type="button" class="bt_white_bor" onclick="">주소찾기</button>
												</div>
												<div class="mt7">
													<input type="text" name="" class="mWt45p" value="" placeholder="기본주소" />
													<input type="text" name="" class="mWt45p" value="" placeholder="상세주소"  />
												</div>
											</td>
										</tr>
										<tr>
											<th>가입경로</th>
											<td>
												<select name="" class="wAuto">
													<option value="">온라인광고</option>
												</select>
											</td>
											<th>이메일</th>
											<td><input type="text" name="" class="" value="" /></td>
											<th>생년월일</th>
											<td><input type="text" name="" class="date mWt100" value="" /></td>                                    
										</tr>
										<tr>
											<th>회원구분</th>
											<td colspan="5">
												<label class="radioWrap"><input type="radio" name="회원구분" value="" checked /><i></i><span>개인회원</span></label>
												<label class="radioWrap ml30"><input type="radio" name="회원구분" value=""  /><i></i><span>기업회원</span></label>
												<select name="" class="wAuto">
													<option value="">거래처 설정</option>
												</select>
												<span class="vam_dib ml20">※ 세금계산서 발행의 경우, 기업회원으로 설정하세요.</span>
											</td>                                    
										</tr>
										<tr>
											<th>일반메모</th>
											<td colspan="3"><textarea name="" class="txa_base"></textarea></td>
											<th>관리자메모</th>
											<td><textarea name="" class="txa_base"></textarea></td>
										</tr>                                
									</tbody>
								</table> <!-- itable_1 -->
                            </div> <!-- table_Wrap -->
                        </div> <!-- mm_left_con -->

                        <div class="mm_right_con">
                            <div class="title_2">
                                <div>상담관리</div>

                                <div>
                                    <button type="button" class="set_button" onclick="modal('pop_as_reg');">AS등록</button>
                                    <button type="button" class="bt_gray ml5" onclick="modal('pop_coun_his')">상담내역</button>
                                </div>
                            </div> <!-- title_2 -->

                            <div class="table_wrap">
                                <table class="itable_1">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="" class="wAuto">
                                                    <option value="">전화1</option>
                                                    <option value="">전화2</option>
                                                    <option value="">전화3</option>
                                                </select>
                                                <select name="" class="wAuto">
                                                    <option value="">인</option>
                                                    <option value="">아웃</option>
                                                    <option value="">수동</option>
                                                </select>
                                                <select name="" class="wAuto">
                                                    <option value="">신규주문</option>
                                                    <option value="">재주문</option>
                                                    <option value="">상담전달</option>
                                                    <option value="">단순문의</option>
                                                    <option value="">반품교환</option>
                                                    <option value="">클레임</option>
                                                    <option value="">콜백</option>
                                                    <option value="">기타</option>
                                                </select>
                                                <select name="" class="wAuto">
                                                    <option value="">미처리</option>
                                                    <option value="">처리중</option>
                                                    <option value="">처리완료</option>
                                                </select>
                                            </td>								
                                        </tr>
                                        <tr>
                                            <td><textarea name="" class="mem_txa"></textarea></td>
                                        </tr>
                                    </tbody>
                                </table> <!-- itable_1 -->
                            </div> <!-- table_Wrap -->
                        </div> <!-- mm_right_con -->
                    </div> <!-- m_manage_wrap -->                    

                    <div class="tab_wrap mt10">
                        <div class="tab_base">
                            <a href="#m_tab1" title="m_tab1" id="a_t1" class="active">주문내역</a>
                            <a href="#m_tab2" title="m_tab2" id="a_t2">상담내역</a>
                            <a href="#m_tab3" title="m_tab3" id="a_t3">취소내역</a>
                            <a href="#m_tab4" title="m_tab4" id="a_t4">반품/교환내역</a>
                            <a href="#m_tab5" title="m_tab5" id="a_t5">환불내역</a>
                            <a href="#m_tab6" title="m_tab6" id="a_t6">AS내역</a>
                            <a href="#m_tab7" title="m_tab7" id="a_t7">미수금내역</a>
                        </div> <!-- tab_base -->

                        <div id="m_tab1" class="tab_base_con t_block">
                            <?
                                include_once "mem_tab_1.php"; // 주문내역
                            ?>
                        </div> <!-- m_tab1 / tab_base_con -->

                        <div id="m_tab2" class="tab_base_con">
                            <?
                                include_once "mem_tab_2.php"; // 상담내역
                            ?>
                        </div> <!-- m_tab2 / tab_base_con -->

                        <div id="m_tab3" class="tab_base_con">
                            <?
                                include_once "mem_tab_3.php"; // 취소내역
                            ?>
                        </div> <!-- m_tab3 / tab_base_con -->

                        <div id="m_tab4" class="tab_base_con">
                            <?
                                include_once "mem_tab_4.php"; // 반품/교환내역
                            ?>
                        </div> <!-- m_tab4 / tab_base_con -->

                        <div id="m_tab5" class="tab_base_con">
                            <?
                                include_once "mem_tab_5.php"; // 환불내역
                            ?>
                        </div> <!-- m_tab5 / tab_base_con -->

                        <div id="m_tab6" class="tab_base_con">
                            <?
                                include_once "mem_tab_6.php"; // AS내역
                            ?>
                        </div> <!-- m_tab6 / tab_base_con -->

                        <div id="m_tab7" class="tab_base_con">
                            <?
                                include_once "mem_tab_7.php"; // 미수금내역
                            ?>
                        </div> <!-- m_tab7 / tab_base_con -->
                    </div> <!-- tab_wrap -->
                    
                </div> <!-- contents -->
            </section>
		</div> <!-- container -->
				 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>

        <?
		    include_once "pop_member_reg.php"; // 신규회원등록
            include_once "pop_order_reg.php"; // 주문등록
            include_once "pop_order_cancel.php"; // 취소요청
            include_once "pop_order_return.php"; // 반품요청
            include_once "pop_order_exchange.php"; // 교환요청
            include_once "pop_as_reg.php"; // as등록
            include_once "pop_coun_his.php"; // 상담내역
            include_once "pop_adress_reg.php"; // 배송지등록
            include_once "pop_bankbook_reg.php"; // 무통장 입력
            include_once "pop_card_reg.php"; // 카드 입력
        ?>
	</body>
</html>

<script type="text/javascript">
    // 신규회원등록
    function member_reg(){
        modal('pop_member_reg');
    }

    // 배송지등록
    function adress_reg(){
        modal('pop_adress_reg');
    }

	// 주문등록
    function order_reg(){
        modal('pop_order_reg');
    }

	// as등록
    function as_reg(){
        modal('pop_as_reg');
    }

	// 상담내역
    function coun_his(){
        modal('pop_coun_his');
    }

</script>