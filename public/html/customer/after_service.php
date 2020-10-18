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
                            <span>기간</span>
                            <select name="" class="wAuto">
                                <option value="">요청일</option>
                            </select>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상담자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->                    

                        <div class="box_row mt10">
                            <span>구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                            
                            <span class="ml20">AS기사</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>                            

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="">요청취소</button>
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:200%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>
                                    <th>선택</th>
                                    <th>요청일</th>
                                    <th>접수번호</th>
                                    <th>상담자</th>
                                    <th>고객명</th>
                                    <th>연락처1</th>
                                    <th>구매처</th>
                                    <th>구분</th>
                                    <th>긴급</th>
                                    <th>상태</th>
                                    <th>연기/재방문</th>
                                    <th>AS처리</th>
                                    <th>완료일</th>
                                    <th>AS기사</th>
                                    <th>방문일정</th>
                                    <th class="mWt300">상담내용</th>
                                    <th class="mWt250">취소/미처리 사유</th>
                                    <th class="mWt250">상품</th>
                                    <th>부위</th>
                                    <th>증상</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-02</td>
                                    <td>AS20200101-001</td>
                                    <td>김상담</td>
                                    <td>홍길동</td>
                                    <td>01012345678</td>
                                    <td>강남1매장</td>
                                    <td>방문</td>
                                    <td>Y</td>
                                    <td>완료</td>
                                    <td>연기</td>
                                    <td><button type="button" class="small set_button" onclick="">보기</button></td>
                                    <td>2020-01-01</td>
                                    <td>김기사</td>
                                    <td>2020-01-01 14:00</td>
                                    <td class="txal">여러 번 AS를 한 상태. 빨리 방문 요청</td>
                                    <td class="txal">김상담 / 작동이 다시 잘됨</td>
                                    <td class="txal">안마의자 CMC-1300A</td>
                                    <td>소모품</td>
                                    <td>파손</td>
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