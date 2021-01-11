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
                                <option value="">요청일</option>
                            </select>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

							<span class="ml20">매출처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
							<select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>고객</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt150" value="" placeholder="" />

                            <span class="ml20">몰주문번호</span>
                            <input type="text" name="" class="mWt100" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="order_upload();">주문업로드</button>
								<button type="button" class="bt_black ml5" onclick="outside_mall_set();">몰양식설정</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:150%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th>등록일</th>
                                    <th>매출처</th>
                                    <th>몰주문번호</th>
                                    <th>몰상세주문번호</th>
                                    <th>몰주문일</th>
                                    <th>몰상품번호</th>
                                    <th class="mWt150">몰상품명</th>
                                    <th>수량</th>
                                    <th>몰판매가</th>
                                    <th>수수료율</th>
                                    <th>배송비</th>
                                    <th>결제금액</th>                                    
                                    <th>수취인</th>
                                    <th>수취인연락처1</th>
                                    <th>수취인연락처2</th>
                                    <th>우편번호</th>
                                    <th class="mWt300">수취인주소</th>
                                    <th class="mWt200">배송메세지</th>                                    
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <?for($i=20;$i>0;$i--){?>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td>2020-02-02</td>
                                    <td>옥션</td>
                                    <td>3432522</td>
                                    <td>3432522-000</td>
                                    <td>2020-02-01</td>
                                    <td>123456</td>
                                    <td>양말 A 세트</td>                                    
                                    <td>2</td>
                                    <td>20,000</td>
                                    <td>25%</td>
                                    <td>3,000</td>
                                    <td>18,000</td>
                                    <td>홍길동</td>
                                    <td>01000000000</td>                                    
                                    <td>0200000000</td>
                                    <td>34567</td>
                                    <td>서울시 영등포 여의로 43길 33</td>
                                    <td>빨리보내주세요.</td>
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
            include_once "pop_order_upload.php"; // 주문업로드
			include_once "pop_outside_mall_set.php"; // 몰양식설정
        ?>
	</body>
</html>

<script type="text/javascript">
	// 주문업로드
	function order_upload(){  
		modal('pop_order_upload');
	};
	// 몰양식설정
		function outside_mall_set(){  
		modal('pop_outside_mall_set');
	};
</script>