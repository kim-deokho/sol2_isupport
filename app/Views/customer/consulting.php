
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
					<div class="search_box">
                        <div class="box_row">
                            <span>상담일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span>인/아웃</span>
							<select name="searchkind1" class="wAuto">
								<option value="">전체</option>
								<?foreach($setting['code']['Counkind1'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
							</select>

                            <span class="ml20">상담종류</span>
                            <select name="searchkind2" class="wAuto">
								<option value="">전체</option>
								<?foreach($setting['code']['Counkind2'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
							</select>

                            <span class="ml20">처리상태</span>
                            <select name="searchkind3" class="wAuto">
                                <option value="A">미처리</option>
                                <option value="B">처리중</option>
                                <option value="C">처리완료</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>상담자</span>
                            <select name="searchReg" class="wAuto">
								<option value="">전체</option>
								<?foreach($setting['manager'] as $row ) { if(strpos($row['mn_work'], 'cs') !== false) {echo '<option value="'.$row['mn_pid'].'">'.$row['mn_name'].'</option>';}}?>
							</select>

                            <span class="ml20">회원</span>
                            <select name="searchKey[]" class="multi_select" style="width:auto"  id="searchKey" multiple="multiple">
                                <option value="b.mb_name" selected>이름</option>
								<option value="b.mb_code">코드</option>
								<option value="concat(mb_tel1,mb_tel2,mb_tel3)">전화</option>
                            </select>
                            <input type="text" name="searchKey" class="mWt200" value="" placeholder="" />

                            <span class="ml20">상담내용</span>
                            <input type="text" name="searchCon" class="mWt250" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_green ml10" onclick="listExcel()">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
					</form>

                    <div class="table_wrap" id="list_area">

                    </div> <!-- table_wrap -->

					<div class="mResultTablePage mContentWrap" id="paging">

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
sendSearch();
</script>