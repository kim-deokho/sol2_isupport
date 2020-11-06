
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>기사</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="closed_set();">휴무설정</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="buttonLeft mt20">
                        <button type="button" class="bt_black" onclick="">배송</button>
                        <button type="button" class="bt_gray ml5" onclick="">AS</button>
                    </div> <!-- buttonLeft -->
					<div class="calendar">
						<div>스케줄 (캘린더)</div>
					</div>
                </div> <!-- contents -->
            </section>


        <?
            include_once "pop_closed_set.php"; // 휴무설정
        ?>

<script type="text/javascript">
    // 휴무설정
    function closed_set(){
        modal('pop_closed_set');
    }
</script>