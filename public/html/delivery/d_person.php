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
                                <option value="">배송예정일</option>
                            </select>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">매출처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">주문종류</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">배송기사</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt150" value="" placeholder="" />

                            <span class="ml20">상품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <span class="ml20">주문번호</span>
                            <input type="text" name="" class="mWt100" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">                            
                            <button type="button" class="bt_sblue" onclick="">거래내역서출력</button>

                            <div class="po_right">
                                <button type="button" class="bt_red" onclick="">기사배정취소</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:250%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
                                    <th>주문일</th>
                                    <th>배송예정일</th>
                                    <th>배송상태</th>
                                    <th>매출처</th>
                                    <th>주문구분</th>
                                    <th>배송메모</th>
                                    <th>배송기사</th>
                                    <th>방문일정</th>
                                    <th>배송완료일</th>
                                    <th>배송타입</th>
                                    <th>주문번호</th>
                                    <th>상세주문번호</th>
                                    <th>창고</th>
                                    <th>상품</th>
                                    <th>수량</th>
                                    <th class="mWt250">상담메모</th>
                                    <th>거래내역서</th>
                                    <th>수취인</th>
                                    <th>연락처1</th>
                                    <th>연락처2</th>
                                    <th>우편번호</th>
                                    <th class="mWt300">주소</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>상담자</th>
                                    <th>배송비</th>
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <?for($i=10;$i>0;$i--){?>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-01</td>
                                    <td>2020-01-01</td>
                                    <td>주문완료</td>
                                    <td>전화</td>
                                    <td>신규</td>
                                    <td>저녁에</td>
                                    <td><button type="button" class="small bt_black" onclick="assig_person();">배정</button></td>
                                    <td></td>
                                    <td>2020-01-01</td>
                                    <td>택배</td>
                                    <td>A11111111</td>
                                    <td>34643634</td>
                                    <td>강남매장</td>
                                    <td>커피포트 CF-123</td>
                                    <td>2</td>
                                    <td>문앞에 놓아주세요.</td>
                                    <td><button type="button" class="small bt_sblue" onclick="">보기</button></td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>0104454344</td>
                                    <td>12343</td>
                                    <td>서울시 강서구 영영동 23길</td>
                                    <td>35253252</td>
                                    <td>홍길동</td>
                                    <td>김상담</td>
                                    <td>15,000</td>
                                </tr>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-01</td>
                                    <td>2020-01-01</td>
                                    <td>주문완료</td>
                                    <td>전화</td>
                                    <td>신규</td>
                                    <td>저녁에</td>
                                    <td><a href="javascript:assig_person();">김기사</a></td>
                                    <td><a href="javascript:delivery_detail();">14:00</a></td>
                                    <td>2020-01-01</td>
                                    <td>택배</td>
                                    <td>A11111111</td>
                                    <td>34643634</td>
                                    <td>강남매장</td>
                                    <td>커피포트 CF-123</td>
                                    <td>2</td>
                                    <td>문앞에 놓아주세요.</td>
                                    <td><button type="button" class="small bt_sblue" onclick="">보기</button></td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>0104454344</td>
                                    <td>12343</td>
                                    <td>서울시 강서구 영영동 23길</td>
                                    <td>35253252</td>
                                    <td>홍길동</td>
                                    <td>김상담</td>
                                    <td>15,000</td>
                                </tr>
                                <?}?>                               
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
            include_once "pop_assig_person.php"; // 기사배정
            include_once "pop_delivery_detail.php"; // 상세처리내용
        ?>
	</body>
</html>

<script type="text/javascript">
    // 기사배정
    function assig_person(){
        modal('pop_assig_person');
    }

	// 상세처리내용
    function delivery_detail(){
        modal('pop_delivery_detail');
    }
</script>