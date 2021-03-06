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
                            <span>창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">매입처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">부품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th>창고</th>
                                    <th>매입처</th>
                                    <th>카테고리</th>
                                    <th class="mWt300">부품명</th>
                                    <th>부품가</th>
                                    <th>공임비</th>
                                    <th>현재고</th>
                                    <th>폐기재고</th>
                                    <th>기사출고</th>
                                </tr>                                
                            </thead>
                            <tbody id="">                                
                                <?for($i=20;$i>0;$i--){?>
                                <tr>                                    
                                    <td><?=$i?></td>
                                    <td>창고1</td>
                                    <td>상생산업</td>
                                    <td>안마의자 > 하부</td>
                                    <td class="txal">PCB, 3D컨트롤, A80</td>
                                    <td>1,000</td>
                                    <td>1,000</td>
                                    <td>50</td>                                    
                                    <td>5</td>
                                    <td>3</td>
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