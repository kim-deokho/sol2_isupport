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
							<span class="">상품코드</span>                            				
                            <input type="text" name="" class="mWt280" value="" placeholder="상품코드" />
							<span class="ml20">상품명</span>                            				
                            <input type="text" name="" class="mWt280" value="" placeholder="상품명" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt50">No.</th>
									<th>카테고리</th>
									<th>상품코드</th>
									<th>상품명</th>
									<th>구분</th>
									<th>입고가</th>
                                    <th>관리</th>
								</tr>
							</thead>
							<tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>의류 > 상의</td>
                                    <td>001001001-00001</td>
                                    <td>티셔츠</td>
                                    <td>상품</td>                                    
                                    <td>5,000</td>
                                    <td><button type="button" class="small set_button" onclick="receve_p_reg();">등록</button><button type="button" class="ml20 small set_button" onclick="receve_p_record();">상세이력</button></td>
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
            include_once "pop_receve_p_reg.php"; // 입고가등록
            include_once "pop_receve_p_record.php"; // 상세이력
		?>
	</body>
</html>

<script type="text/javascript">
    // 입고가등록
    function receve_p_reg(){
        modal('pop_receve_p_reg');
    }

	// 상세이력
    function receve_p_record(){
        modal('pop_receve_p_record');
    }
</script>