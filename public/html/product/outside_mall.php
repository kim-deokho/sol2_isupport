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
                            <span>상품명</span>                            				
                            <input type="text" name="" class="mWt280" value="" placeholder="상품명" />

                            <span class="ml20">매출처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="outmall_reg();">엑셀업로드</button>
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="buttonRight">                        
                        <button type="button" class="set_button" onclick="">저장</button>
                    </div> <!-- buttonRight -->

                    <div class="table_wrap mt10">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt50">No.</th>
									<th>상품명</th>
									<th>상품코드</th>
									<th>매출처</th>
									<th class="mWt220">매출처상품코드</th>
									<th class="mWt320">비고</th>
								</tr>
							</thead>
							<tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>예쁜 양말 세트 A</td>
                                    <td>001001001-00001</td>
                                    <td>G마켓</td>
                                    <td><input type="text" name="" class="mWt200 h_20" value="" /></td>
                                    <td><input type="text" name="" class="mWt300 h_20" value="" /></td>
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
			include_once "pop_outmall_reg.php"; // 엑셀업로드
		?>
	</body>
</html>

<script type="text/javascript">
    // 엑셀업로드
    function outmall_reg(){
        modal('pop_outmall_reg');
    }
</script>