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
                            <span>상담일</span>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">인/아웃</span>
                            <select name="" class="wAuto">
                                <option value="">인</option>
                                <option value="">아웃</option>
                                <option value="">수동</option>
                            </select>

                            <span class="ml20">상담종류</span>
                            <select name="" class="wAuto">
                                <option value="">신규주문</option>
                                <option value="">재주문</option>
                                <option value="">상담전달</option>
                                <option value="">단순문의</option>
                                <option value="">반품교환</option>
                                <option value="">클레임</option>
                                <option value="">콜백</option>
                                <option value="">기타</option>
                            </select>

                            <span class="ml20">처리상태</span>
                            <select name="" class="wAuto">
                                <option value="">미처리</option>
                                <option value="">처리중</option>
                                <option value="">처리완료</option>
                            </select>                            
                        </div> <!-- box_row -->                    

                        <div class="box_row mt10">
                            <span>상담자</span>
                            <select name="" class="wAuto">
                                <option value="">홍길동</option>
                            </select>

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <span class="ml20">상담내용</span>                            
                            <input type="text" name="" class="mWt250" value="" placeholder="" />

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
                                    <th>상담일시</th>
                                    <th>인/아웃</th>
                                    <th>상담종류</th>
                                    <th class="mWt300">상담내용</th>
                                    <th>고객코드</th>
                                    <th>이름</th>
                                    <th>전화</th>
                                    <th>처리상태</th>
                                    <th>상담자</th>
                                    <th>녹취</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>2020-02-02 21:22:33</td>
                                    <td>아웃</td>
                                    <td>주문문의</td>
                                    <td>상담내용</td>
                                    <td>443433</td>
                                    <td>홍길동</td>
                                    <td>010-1234-2345</td>
                                    <td>처리중</td>
                                    <td>김상담</td>
                                    <td><button type="button" class="small set_button" onclick="">듣기</button></td>
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