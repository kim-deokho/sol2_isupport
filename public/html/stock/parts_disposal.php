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
                            <span>폐기일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">처리자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>부품명</span>
                            <select name="" class="wAuto">
                                <option value="">1차카테고리</option>
                            </select>
                            <select name="" class="wAuto">
                                <option value="">2차카테고리</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_red" onclick="">폐기취소</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>
                                    <th class="mWt50"><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
                                    <th>폐기일</th>
                                    <th>처리자</th>
                                    <th>AS접수번호</th>
                                    <th>창고</th>
                                    <th>카테고리</th>
                                    <th class="mWt200">부품</th>
                                    <th>수량</th>
                                    <th>사유</th>
                                    <th class="mWt200">비고</th>
                                </tr>                                
                            </thead>
                            <tbody id="">
                                <tr>                                    
                                    <td rowspan="2">2</td>
                                    <td rowspan="2"><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td rowspan="2">2020-01-01</td>
                                    <td rowspan="2">김기사</td>
                                    <td rowspan="2">AS20200101-001</td>
                                    <td>창고1</td>                         
                                    <td>펌프 > 하부</td>
                                    <td class="txal">하부 조임 나사 BC12</td>
                                    <td>1</td>
                                    <td>파손</td>
                                    <td rowspan="2" class="txal"></td>
                                </tr>
                                <tr>
                                    <td>창고1</td>                         
                                    <td>펌프 > 하부</td>
                                    <td class="txal">하부 조임 나사 BC12</td>
                                    <td>1</td>
                                    <td>파손</td>                                    
                                </tr>
                                <tr>                                    
                                    <td>2</td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-01</td>
                                    <td>최기사</td>
                                    <td>AS20200101-001</td>
                                    <td>창고1</td>                         
                                    <td>펌프 > 하부</td>
                                    <td class="txal">하부 조임 나사 BC12</td>
                                    <td>1</td>
                                    <td>분실</td>
                                    <td class="txal"></td>
                                </tr>
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