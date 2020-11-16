 <section>
                <div class="contents">
					<?
						include_once "../common/inc/page_name.php"; // page_name
					?>

                    <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
					<div class="search_box">
						<div class="box_row">
							<span>구분</span>
							<select name="" class="mWt100">
								<option value="">전체</option>
                            </select>
                            <span class="ml20">명칭</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />
                            <span class="ml20">사용여부</span>
							<select name="" class="mWt100">
								<option value="">전체</option>
							</select>
                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="event_reg();">프로모션등록</button>
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
				<?
			include_once "pop_event_reg.php"; // 프로모션등록
		?>

<script type="text/javascript">
	sendSearch();
    // 프로모션등록
    function event_reg(){
        pop_modal('pop_event_reg');
    }
</script>