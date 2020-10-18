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
                            <span>지급일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />
                        </div> <!-- box_row -->                    

                        <div class="box_row mt10">
                            <span>예치금명</span>
                            <input type="text" name="" class="mWt210" value="" placeholder="" />
                            
                            <span class="ml20">지급자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">                                
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1" id="">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th>지급일</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>예치금</th>
                                    <th>누적금액</th>
                                    <th>예치금명</th>
                                    <th>지급자</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>2020-01-02</td>
                                    <td>35465745</td>
                                    <td>홍길동</td>
                                    <td>-3,000</td>
                                    <td>7,000</td>                                    
                                    <td>주문사용 (A353252)</td>
                                    <td>김상담</td>
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
			include_once "pop_pay_gift.php"; // 상품권지급
		?>
	</body>
</html>

<script type="text/javascript">    
</script>