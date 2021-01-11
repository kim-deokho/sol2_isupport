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
                            <span>주문일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />
                            <button type="button" class="small bt_dark" onclick="">오늘</button>
                            <button type="button" class="small bt_dark" onclick="">어제</button>
                            <button type="button" class="small bt_dark" onclick="">7일</button>
                            <button type="button" class="small bt_dark" onclick="">한달</button>
                            <button type="button" class="small bt_dark" onclick="">당월</button>
                            <button type="button" class="small bt_dark" onclick="">전월</button>
                            <button type="button" class="small bt_dark" onclick="">일년</button>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>기준</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="two_areas">
                        <div class="first_area mWt49p">
                            <div class="title_1_1">일별매출 - 총매출</div>
                            <div class="graph_wrap">
                                그래프
                            </div> <!-- graph_wrap -->
                        </div> <!-- first_area -->

                        <div class="second_area mWt49p">
                            <div class="title_1_1">일별매출 – 매출처별(전화,매장,온라인,기타)</div>
                            <div class="graph_wrap">
                                그래프
                            </div> <!-- graph_wrap -->
                        </div> <!-- second_area -->
                    </div> <!-- two_areas -->
                    
                    <div class="table_wrap mt15">
                        <table class="ltable_1" id="">
                            <thead>
                                <tr>									
                                    <th rowspan="2" class="mWt90">주문일</th>                                    
                                    <th colspan="2">총매출</th>
                                    <th colspan="2">미수금</th>
                                    <th colspan="8">매출처별</th>
                                    <th colspan="4">결제수단별</th>
                                    <th colspan="2">환불</th>
                                </tr>
                                <tr>									
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                    <th>전화금액</th>
                                    <th>건수</th>
                                    <th>매장금액</th>
                                    <th>건수</th>
                                    <th>온라인금액</th>
                                    <th>건수</th>
                                    <th>기타금액</th>
                                    <th>건수</th>
                                    <th>카드</th>
                                    <th>건수</th>
                                    <th>무통장</th>
                                    <th>건수</th>
                                    <th>금액</th>
                                    <th>건수</th>
                                </tr>                                
                            </thead>
                            <tbody id="">
                                <tr class="tr_total">                                    
                                    <td>합계</td>
                                    <td>999,999,000</td>
                                    <td>999</td>
                                    <td>999,999</td>
                                    <td>99</td>
                                    <td>999,999</td>
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td class="fcdb">99,999</span></td>                                    
                                    <td class="fcdb">-9</td>
                                </tr>                                
                                <?for($i=10;$i>0;$i--){?>
                                <tr>                                    
                                    <td>2020-02-02</td>
                                    <td>999,999,000</td>
                                    <td>999</td>
                                    <td>999,999</td>
                                    <td>99</td>
                                    <td>999,999</td>
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td>999,999</td>                                    
                                    <td>99</td>
                                    <td class="fcdb">99,999</span></td>                                    
                                    <td class="fcdb">-9</td>
                                </tr>                                 
                                <?}?>
                            </tbody>
                        </table>
                    </div> <!-- table_wrap -->
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