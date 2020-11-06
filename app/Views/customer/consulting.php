
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
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

                    <div class="table_wrap" id="list_area">

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