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
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>보낸창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">받는창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="move_reg();">이동등록</button>
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
                                    <th>이동번호</th>
                                    <th>보낸창고</th>
                                    <th>받는창고</th>
                                    <th>매입처</th>
                                    <th>구분</th>
                                    <th class="mWt250">제품명</th>
                                    <th>이동수량</th>
                                    <th>등록자</th>
                                    <th class="mWt300">비고</th>
                                    <th class="mWt200">보낸창고승인</th>
                                    <th class="mWt200">받는창고승인</th>
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <?for($i=10;$i>0;$i--){?>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td>2020-01-01</td>
                                    <td>T00000004</td>
                                    <td>창고1</td>
                                    <td>강남매장</td>
                                    <td>상생산업</td>
                                    <td>상품</td>                                    
                                    <td class="txal">양말 A</td>
                                    <td>5</td>
                                    <td>김물류</td>
                                    <td class="txal">매장에 3개 가져감</td>
                                    <td><button type="button" class="small set_button" onclick="">승인</button></td>
                                    <td><button type="button" class="small set_button" onclick="">승인</button></td>
                                </tr>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td>2020-01-01</td>
                                    <td>T00000004</td>
                                    <td>창고1</td>
                                    <td>강남매장</td>
                                    <td>상생산업</td>
                                    <td>상품</td>                                    
                                    <td class="txal">양말 A</td>
                                    <td>5</td>
                                    <td>김물류</td>
                                    <td class="txal">매장에 3개 가져감</td>
                                    <td>김물류 (2020-01-01 12:33)</td>
                                    <td>박팀장 (2020-01-01 12:33)</td>
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
            include_once "pop_move_reg.php"; // 이동등록
        ?>
	</body>
</html>

<script type="text/javascript">
    // 이동등록
    function move_reg(){
        modal('pop_move_reg');
    }
</script>