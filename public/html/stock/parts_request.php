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
                            <span>요청일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>요청자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">부품명</span>
                            <select name="" class="wAuto">
                                <option value="">1차카테고리</option>
                            </select>
                            <select name="" class="wAuto">
                                <option value="">2차카테고리</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="request_reg();">부품요청</button>
                                <button type="button" class="bt_red" onclick="">요청취소</button>
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
                                    <th>요청일</th>
									<th>구분</th>
                                    <th>상태</th>
                                    <th>요청자</th>
                                    <th>부품코드</th>
                                    <th class="mWt200">부품명</th>
                                    <th>요청수량</th>
                                    <th>창고</th>
                                    <th>처리</th>
                                    <th>처리일시</th>
                                    <th>처리수량</th>
                                    <th class="mWt200">비고</th>
                                </tr>                                
                            </thead>
                            <tbody id="">
                                <tr>                                    
                                    <td rowspan="2">2</td>
                                    <td rowspan="2"><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td rowspan="2">2020-01-01</td>
									<td rowspan="2">출고</td>
                                    <td rowspan="2">요청</td>
                                    <td rowspan="2">김기사</td>
                                    <td>001001001-00001</td>                         
                                    <td class="txal">PCB, 3D컨트롤, A80</td>
                                    <td>2</td>
                                    <td rowspan="2">창고1</td>
                                    <td rowspan="2"><button type="button" class="small bt_black" onclick="request_proc();">요청처리</button></td>
                                    <td></td>
                                    <td></td>
                                    <td rowspan="2" class="txal"></td>
                                </tr>
                                <tr>
                                    <td>001001001-00001</td>                         
                                    <td class="txal">PCB, 3D컨트롤, A80</td>
                                    <td>2</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>                                    
                                    <td>1</td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-01</td>
									<td>반입</td>
                                    <td>완료</td>
                                    <td>박기사</td>
                                    <td>001001001-00001</td>                         
                                    <td class="txal">PCB, 3D컨트롤, A80</td>
                                    <td>1</td>
                                    <td>창고1</td>
                                    <td></td>
                                    <td>2020-01-01</td>
                                    <td>1</td>
                                    <td class="txal">남은 부품 반입함</td>
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
        
        <?
            include_once "pop_request_reg.php"; // 부품요청
            include_once "pop_request_proc.php"; // 요청처리
        ?>
	</body>
</html>

<script type="text/javascript">
    // 부품요청
    function request_reg(){
        modal('pop_request_reg');
    }

    // 요청처리
    function request_proc(){
        modal('pop_request_proc');
    }
</script>