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

                    <div class="search_box">
                        <div class="box_row">
                            <span>기간</span>
                            <select name="" class="wAuto">
                                <option value="">가입일</option>
                            </select>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">회원등급</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">회원구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>  
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>담당자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">가입경로</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">수신동의</span>
                            <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>개인정보</span></label>
                            <label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>문자</span></label>
                            <label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>메일</span></label>
                            <label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>전화</span></label>
                        </div> <!-- box_row -->                     

                        <div class="box_row mt10">
                            <span>휴먼포함</span>
                            <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label>

                            <span class="ml20">탈퇴포함</span>
                            <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label>

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="merge_member();">회원병합</button>
                                <button type="button" class="bt_black" onclick="change_contact();">담당자변경</button>
                                <button type="button" class="bt_black" onclick="change_grade();">등급변경</button>
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1" id="" style="width:250%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>가입일</th>
                                    <th>최종주문일</th>
                                    <th>최종통화일</th>
                                    <th>최종통화구분</th>
                                    <th>회원등급</th>
                                    <th>회원구분</th>
                                    <th>담당자</th>
                                    <th>주문건수</th>
                                    <th>결제금액</th>
                                    <th>입금금액</th>
                                    <th>미수금</th>
                                    <th>적립금</th>
                                    <th>상품권</th>
                                    <th>예치금</th>
                                    <th>가입경로</th>
                                    <th>이메일</th>
                                    <th>생년월일</th>
                                    <th>수신동의</th>
                                    <th>전화1</th>
                                    <th>전화2</th>
                                    <th>우편번호</th>
                                    <th>주소1</th>
                                    <th>주소2</th>
                                    <th>탈퇴여부</th>
                                </tr>
                            </thead>
                            <tbody id="">                                
                                <tr>
                                    <td>1</td>                                    
                                    <td>35465745</td>
                                    <td>홍길동</td>
                                    <td>2020-01-02</td>
                                    <td>2020-01-02</td>
                                    <td>2020-01-02</td>
                                    <td>주문문의</td>
                                    <td>VIP</td>
                                    <td>기업</td>
                                    <td>김상담</td>
                                    <td>34</td>
                                    <td>5,450,000</td>
                                    <td>5,000,000</td>
                                    <td>450,000</td>
                                    <td>34,500</td>
                                    <td><a href="javascript:">3개</a></td>
                                    <td>432,000</td>
                                    <td>온라인광고</td>
                                    <td>abc@naver.com</td>
                                    <td>2020-01-01</td>
                                    <td>개인정보, 문자, 메일, 전화</td>
                                    <td>01012345678</td>
                                    <td>01022222222</td>
                                    <td>44563</td>
                                    <td>서울시 영등포구</td>
                                    <td>여의빌딩 505호</td>
                                    <td></td>
                                </tr>
                                <tr class="tr_inactive">
                                    <td>2</td>                                    
                                    <td>35465745</td>
                                    <td>홍길동</td>
                                    <td>2020-01-02</td>
                                    <td>2020-01-02</td>
                                    <td>2020-01-02</td>
                                    <td>주문문의</td>
                                    <td>VIP</td>
                                    <td>기업</td>
                                    <td>김상담</td>
                                    <td>34</td>
                                    <td>5,450,000</td>
                                    <td>5,000,000</td>
                                    <td>450,000</td>
                                    <td>34,500</td>
                                    <td><a href="javascript:">3개</a></td>
                                    <td>432,000</td>
                                    <td>온라인광고</td>
                                    <td>abc@naver.com</td>
                                    <td>2020-01-01</td>
                                    <td>개인정보, 문자, 메일, 전화</td>
                                    <td>01012345678</td>
                                    <td>01022222222</td>
                                    <td>44563</td>
                                    <td>서울시 영등포구</td>
                                    <td>여의빌딩 505호</td>
                                    <td>휴면(2020-01-01)</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- table_wrap -->

					<div class="mResultTablePage mContentWrap" id="">
						<div class="pageFirstButton pageButton">
							<img src="../common/img/button_list_big1_first.png" class="" alt="처음으로" >
						</div>
						<div class="pagePrevButton pageButton">
							<img src="../common/img/button_list_big1_prev.png" alt="이전으로" >
						</div>
						<div class="pageNum"><span class="on">1</span><span>2</span></div>
						<div class="pageNextButton pageButton">
							<img src="../common/img/button_list_big1_next.png" alt="다음으로" >
						</div>
						<div class="pageLastButton pageButton">
							<img src="../common/img/button_list_big1_last.png" alt="마지막으로" >
						</div>
					</div> <!-- mResultTablePage -->
                </div> <!-- contents -->
            </section>
        </div> <!-- container -->
   		 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>
     
        <?
            include_once "pop_merge_member.php"; // 회원병합
            include_once "pop_change_contact.php"; // 담당자변경
            include_once "pop_change_grade.php"; // 등급변경
        ?>
	</body>
</html>

<script type="text/javascript">
    // 파일업로드
    $(".file_wrap > button").on("click",function(){        
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });
    
    // 회원병합
    function merge_member(){
        modal('pop_merge_member');
    } 

    // 담당자변경
    function change_contact(){
        modal('pop_change_contact');
    }  

    // 등급변경
    function change_grade(){
        modal('pop_change_grade');
    }     
</script>