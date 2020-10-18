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

                    <div class="search_box mt10">
						<div class="box_row">
                            <span>카테고리</span>
                            <select name="" class="wAuto">
								<option value="">전체</option>
                            </select>
                            <select name="" class="wAuto">
								<option value="">전체</option>
                            </select>    
							<span class="ml20">사용여부</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">                            
                            <span>부품명</span>                            				
                            <input type="text" name="" class="mWt280" value="" placeholder="부품명" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="parts_reg();">부품등록</button>    
                                <button type="button" class="bt_black ml10" onclick="category_set();">카테고리설정</button>
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt50">No.</th>
									<th>매입처</th>
									<th>카테고리</th>
									<th>부품코드</th>
									<th>부품명</th>
									<th>부품가</th>
									<th>공임비</th>
                                    <th>사용여부</th>
                                    <th>등록일</th>
								</tr>
							</thead>
							<tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>생생유통</td>
                                    <td>펌프 > 하부</td>
                                    <td>B001001-0001</td>
                                    <td>하부 조임 나사 BC12</td>                                    
                                    <td>15,000</td>
                                    <td>5,000</td>
                                    <td>Y</td>
                                    <td>2020-01-01</td>
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
            include_once "pop_parts_reg.php"; // 부품등록
            include_once "pop_category_set.php"; // 카테고리설정
		?>
	</body>
</html>

<script type="text/javascript">
    // 부품등록
    function parts_reg(){
        modal('pop_parts_reg');
    }

	// 카테고리설정
    function category_set(){
        modal('pop_category_set');
    }
</script>