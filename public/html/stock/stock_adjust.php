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
                            <span>등록일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="adjust_reg();">조정등록</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th>등록일</th>
                                    <th>창고</th>
                                    <th>구분</th>
                                    <th>상품코드</th>
                                    <th class="mWt200">제품명</th>
                                    <th>조정전</th>
                                    <th>조정수량</th>
                                    <th>조정후</th>
                                    <th>등록자</th>
                                    <th>유형</th>
                                    <th class="mWt200">비고</th>
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <?for($i=20;$i>0;$i--){?>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td>2020-01-01 12:33</td>
                                    <td>창고1</td>
                                    <td>상품</td>
                                    <td>001001001-00001</td>                         
                                    <td class="txal">양말 A</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>6</td>
                                    <td>김물류</td>
                                    <td>실사</td>
                                    <td class="txal"></td>
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
            include_once "pop_adjust_reg.php"; // 조정등록
        ?>
	</body>
</html>

<script type="text/javascript">
    // 조정등록
    function adjust_reg(){
        modal('pop_adjust_reg');
    }
</script>