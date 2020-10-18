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
                            <span>입고일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">매입처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">유형</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="wear_reg();">입고등록</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:150%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th>입고일</th>
                                    <th>입고번호</th>
                                    <th>유형</th>
                                    <th>창고</th>
                                    <th>매입처</th>
                                    <th>구분</th>
                                    <th class="mWt250">상품</th>
                                    <th>입고수량</th>
                                    <th>상세발주코드</th>
                                    <th>잔여/발주</th>
                                    <th>등록자</th>
                                    <th class="mWt300">비고</th>
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <?for($i=20;$i>0;$i--){?>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td>2020-01-01</td>
                                    <td>N00000005</td>
                                    <td>발주</td>
                                    <td>강남매장</td>
                                    <td>상생산업</td>
                                    <td>상품</td>                                    
                                    <td class="txal">양말 A</td>
                                    <td>350</td>
                                    <td>A000003-01</td>
                                    <td>200/1,000</td>
                                    <td>김발주</td>                                    
                                    <td class="txal">주문번호[A11111111]</td>
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
            include_once "pop_wear_reg.php"; // 입고등록
        ?>
	</body>
</html>

<script type="text/javascript">
    // 입고등록
    function wear_reg(){
        modal('pop_wear_reg');
    }
</script>