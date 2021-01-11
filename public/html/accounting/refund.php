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
                            <span>요청일</span>                                                       
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>상담자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">사유</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt150" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:200%">
                            <thead>
                                <tr>									
                                    <th rowspan="2" class="mWt50">No.</th>                                    
                                    <th rowspan="2" class="mWt100">요청일</th>
                                    <th rowspan="2">구분</th>
                                    <th rowspan="2">요청</th>
                                    <th rowspan="2"class="mWt50">승인</th>
                                    <th rowspan="2">상태</th>
                                    <th rowspan="2">환불금액</th>
                                    <th rowspan="2">환불방법</th>
                                    <th rowspan="2">배송비</th>
                                    <th rowspan="2">환불정보</th>
                                    <th rowspan="2">환불메모</th>
                                    <th rowspan="2">환불완료일</th>
                                    <th rowspan="2">사유서</th>                                    
                                    <th colspan="2">반품</th>
                                    <th colspan="3">교환</th>
                                    <th rowspan="2">사유</th>
                                    <th rowspan="2">상세사유</th>
                                    <th rowspan="2">상담자</th>
                                    <th rowspan="2">고객코드</th>
                                    <th rowspan="2">고객명</th>
                                    <th rowspan="2" class="mWt100">주문일</th>
                                </tr>
                                <tr>                               
                                    <th>상태</th>
                                    <th class="mWt100">완료일</th>
                                    <th>상태</th>
                                    <th class="mWt100">등록일</th>
                                    <th class="mWt100">완료일</th>
                                </tr>                                
                            </thead>
                            <tbody id="">
                                <tr>                                    
                                    <td>2</td>
                                    <td>2020-01-01</td>
                                    <td>교환</td>
                                    <td>선발송</td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><a href="javascript:">환불완료</a></td>
                                    <td>4,000</td>
                                    <td>입금별환불</td>                                    
                                    <td>제품동봉(3,000)</td>
                                    <td>국민은행 / 김고객 / 2355325235325</td>
                                    <td>무통장</td>                                    
                                    <td>2020-01-01</td>                                    
                                    <td><button type="button" class="small bt_sblue" onclick="">보기</button></td>
                                    <td><a href="javascript:">반입완료</a></td>
                                    <td>2020-01-01</td>
                                    <td><a href="javascript:">주문완료</a></td>
                                    <td>2020-01-01</td>
                                    <td></td>
                                    <td>주문오류</td>
                                    <td>주문을 잘못넣었음</td>
                                    <td>김상담</td>
                                    <td>1435325</td>
                                    <td>홍길동</td>
                                    <td>2020-01-01</td>
                                </tr>
                                <tr>                                    
                                    <td>1</td>
                                    <td>2020-01-01</td>
                                    <td>교환</td>
                                    <td></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><button type="button" class="small bt_black" onclick="refund_reg();">환불요청</button></td>
                                    <td>4,000</td>
                                    <td>입금별환불</td>                                    
                                    <td>제품동봉(3,000)</td>
                                    <td>승인취소</td>
                                    <td>신한카드</td>                                    
                                    <td></td>                                    
                                    <td><button type="button" class="small bt_sblue" onclick="">보기</button></td>
                                    <td><a href="javascript:">반입완료</a></td>
                                    <td>2020-01-01</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>김상담</td>
                                    <td>1435325</td>
                                    <td>홍길동</td>
                                    <td>2020-01-01</td>
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
            include_once "pop_refund_reg.php"; // 환불처리
        ?>
	</body>
</html>

<script type="text/javascript">
    // 환불처리
    function refund_reg(){
        modal('pop_refund_reg');
    }
</script>