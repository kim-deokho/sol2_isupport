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

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />
                        </div> <!-- box_row -->                    

                        <div class="box_row mt10">
                            <span>상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                            
                            <span class="ml20">취소사유</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                            
                            <span class="ml20">상담자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select> 

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="">취소복구</button>
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:250%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>
                                    <th>선택</th>
                                    <th>요청일</th>
                                    <th>상세</th>
                                    <th>상태</th>
                                    <th>완료일</th>
                                    <th>상담자</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>주문일</th>
                                    <th class="mWt300">상품</th>
                                    <th>수량</th>
                                    <th>합계</th>
                                    <th>예상적립금</th>
                                    <th>결제금액</th>
                                    <th>입금금액</th>
                                    <th>미수금</th>
                                    <th>사용적립금</th>
                                    <th>사용예치금</th>
                                    <th>적립금환불</th>
                                    <th>취소사유</th>
                                    <th>결제환불방법</th>
                                    <th>결제환불정보</th>
                                    <th class="mWt450">환불메모</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-02</td>
                                    <td><button type="button" class="small set_button" onclick="">보기</button></td>
                                    <td>취소완료</td>
                                    <td>2020-01-02</td>
                                    <td>김상담</td>
                                    <td>1435325</td>
                                    <td>홍길동</td>
                                    <td>2020-01-01</td>
                                    <td class="txal">커피포트 CF-123</td>
                                    <td>1</td>
                                    <td>14,000</td>
                                    <td>250</td>
                                    <td>25,000</td>
                                    <td>15,000</td>
                                    <td>10,000</td>
                                    <td>1,500</td>
                                    <td>14,000</td>
                                    <td>0</td>
                                    <td>단순변심</td>
                                    <td>결제별환불</td>
                                    <td>국민 / 123345232464 / 김길동</td>
                                    <td class="txal">미수금에서 환불 상품 차감하고 나머지 차액만 계좌입금 요청 </td>
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

	</body>
</html>

<script type="text/javascript">	
</script>