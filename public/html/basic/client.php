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
                            <span>구분</span>
                            <select name="" class="wAuto">
								<option value="">전체</option>
                            </select>							
                            <span class="ml20">거래처</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="거래처명, 사업자번호" />
                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="client_reg();">거래처등록</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt50">No.</th>
									<th>업체코드</th>
									<th>업체명</th>
									<th>구분</th>
									<th>전화번호</th>
									<th>대표자명</th>
									<th>사업자번호</th>
									<th>등록일</th>
									<th>거래유무</th>
								</tr>
							</thead>
							<tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>010101</td>
                                    <td>나래유통</td>
                                    <td>매출처</td>
                                    <td>02-1234-5678</td>
                                    <td>김길동</td>
                                    <td>020-2456-3456</td>
                                    <td>2020-02-01</td>
                                    <td>Y</td>
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
			include_once "pop_client_reg.php"; // 거래처등록
		?>
	</body>
</html>

<script type="text/javascript">
    // 거래처등록
    function client_reg(){
        modal('pop_client_reg');
    }
</script>