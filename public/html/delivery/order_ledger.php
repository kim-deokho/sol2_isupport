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

                            <span class="ml20">배송타입</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상품결제</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->                    

                        <div class="box_row mt10">
                            <span>상태</span>
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

                            <span class="ml20">주문경로</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상담자</span>
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

                            <div class="po_right">                                
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:250%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>
                                    <th>주문일시<br />(배송예정일)</th>
                                    <th>매출처<br />(구분)</th>
                                    <th>고객코드<br />(고객명)</th>
                                    <th>고객등급<br />(고객구분)</th>
                                    <th>주문종류<br />(주문경로)</th>
                                    <th>결제금액</th>
                                    <th>입금금액</th>
                                    <th class="mWt200">상담메모</th>
                                    <th>주문번호</th>
                                    <th>상세주문번호</th>
                                    <th>상태</th>
                                    <th>배송타입</th>
                                    <th>입금확인</th>
                                    <th>상품결재</th>
                                    <th>창고</th>
                                    <th>상품</th>
                                    <th>수량</th>
                                    <th>합계</th>
                                    <th>수취인</th>
                                    <th>연락처1</th>
                                    <th class="mWt300">주소</th>
                                    <th>배송메모</th>
                                    <th>배송정보</th>
                                    <th>배송일</th>
                                    <th>배송완료일</th>
                                    <th>담당자</th>
                                    <th>등록자</th>
                                    <th>미수금</th>
                                    <th>사용적립금</th>
                                    <th>사용예치금</th>
                                    <th>사용상품권</th>
                                    <th>배송비</th>
                                    <th>적립금</th>
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <tr>
                                    <td rowspan="3">2</td>
                                    <td rowspan="3">2020-01-01 11:22<br />(2020-01-01)</td>
                                    <td rowspan="3">전화<br />(주문)</td>
                                    <td rowspan="3">35253252<br />(홍길동)</td>
                                    <td rowspan="3">VIP<br />(기업)</td>
                                    <td rowspan="3">신규<br />(신문광고)</td>
                                    <td rowspan="3">25,500</td>
                                    <td rowspan="3">카드 5,000<br />무통장 5,000</td>
                                    <td rowspan="3">보관상품 10개씩 나누어 배송해주세요. 매주 월요일</td>
                                    <td rowspan="3">A11111111</td>
                                    <td>45436563</td>
                                    <td>배송완료</td>
                                    <td>
                                        <select name="" class="wAuto h_20">
                                            <option value="">택배</option>
                                        </select>
                                    </td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>강남매장</td>
                                    <td>어린이 밍키침대 BD1234</td>
                                    <td>2</td>
                                    <td>14,000</td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>(12343) 서울시 강서구 영영동 23길</td>
                                    <td>문앞</td>
                                    <td>우체국 (1234556666)</td>
                                    <td>2020-03-20</td>
                                    <td>2020-03-23</td>
                                    <td rowspan="3">김담당</td>
                                    <td rowspan="3">김전화</td>
                                    <td rowspan="3">15,500</td>
                                    <td rowspan="3">1,000</td>
                                    <td rowspan="3">0</td>
                                    <td rowspan="3">5% 할인</td>
                                    <td rowspan="3">1,500</td>                                    
                                    <td rowspan="3">2,550</td>                                    
                                </tr>
                                <tr>
                                    <td>45436563</td>
                                    <td>배송완료</td>
                                    <td>
                                        <select name="" class="wAuto h_20">
                                            <option value="">택배</option>
                                        </select>
                                    </td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>강남매장</td>
                                    <td>어린이 밍키침대 BD1234</td>
                                    <td>2</td>
                                    <td>14,000</td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>(12343) 서울시 강서구 영영동 23길</td>
                                    <td>문앞</td>
                                    <td>우체국 (1234556666)</td>
                                    <td>2020-03-20</td>
                                    <td>2020-03-23</td>
                                </tr>
                                <tr>
                                    <td>45436563</td>
                                    <td>배송완료</td>
                                    <td>
                                        <select name="" class="wAuto h_20">
                                            <option value="">택배</option>
                                        </select>
                                    </td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>강남매장</td>
                                    <td>어린이 밍키침대 BD1234</td>
                                    <td>2</td>
                                    <td>14,000</td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>(12343) 서울시 강서구 영영동 23길</td>
                                    <td>문앞</td>
                                    <td>우체국 (1234556666)</td>
                                    <td>2020-03-20</td>
                                    <td>2020-03-23</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020-01-01 11:22<br />(2020-01-01)</td>
                                    <td>전화<br />(주문)</td>
                                    <td>35253252<br />(홍길동)</td>
                                    <td>VIP<br />(기업)</td>
                                    <td>신규<br />(신문광고)</td>
                                    <td>25,500</td>
                                    <td>카드 5,000<br />무통장 5,000</td>
                                    <td>보관상품 10개씩 나누어 배송해주세요. 매주 월요일</td>
                                    <td>A11111111</td>
                                    <td>45436563</td>
                                    <td>배송완료</td>
                                    <td>
                                        <select name="" class="wAuto">
                                            <option value="">택배</option>
                                        </select>
                                    </td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>강남매장</td>
                                    <td>어린이 밍키침대 BD1234</td>
                                    <td>2</td>
                                    <td>14,000</td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>(12343) 서울시 강서구 영영동 23길</td>
                                    <td>문앞</td>
                                    <td>우체국 (1234556666)</td>
                                    <td>2020-03-20</td>
                                    <td>2020-03-23</td>
                                    <td>김담당</td>
                                    <td>김전화</td>
                                    <td>15,500</td>
                                    <td>1,000</td>
                                    <td>0</td>
                                    <td>5% 할인</td>
                                    <td>1,500</td>                                    
                                    <td>2,550</td>                                    
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

	</body>
</html>

<script type="text/javascript">	
</script>