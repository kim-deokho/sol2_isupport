
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>주문일</span>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="" class="date mWt100 txac" value="" />
                            <button type="button" class="small bt_dark" onclick="">오늘</button>
                            <button type="button" class="small bt_dark" onclick="">어제</button>
                            <button type="button" class="small bt_dark" onclick="">7일</button>
                            <button type="button" class="small bt_dark" onclick="">한달</button>
                            <button type="button" class="small bt_dark" onclick="">당월</button>
                            <button type="button" class="small bt_dark" onclick="">전월</button>
                            <button type="button" class="small bt_dark" onclick="">일년</button>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>기준</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="table_wrap">
                        <table class="ltable_1" id="">
                            <thead>
                                <tr>
                                    <th>매입처</th>
                                    <th>상품명</th>
                                    <th><i>주문수량</i></th>
                                    <th>입고가</th>
                                    <th>입고합계</th>
                                    <th>정상가</th>
                                    <th><i>판매합계</i></th>
                                    <th><i>이익</i></th>
                                    <th><i>이익율</i></th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <tr class="tr_total">
                                    <td colspan="2">합계</td>
                                    <td>12</td>
                                    <td>9,999</td>
                                    <td>9,999</td>
                                    <td>99,999</td>
                                    <td>99,999</td>
                                    <td>99,999</td>
                                    <td>80%</td>
                                </tr>
                                <?for($i=10;$i>0;$i--){?>
                                <tr>
                                    <td>영신유통</td>
                                    <td>컬러양말 AA</td>
                                    <td>2</td>
                                    <td>9,999</td>
                                    <td>9,999</td>
                                    <td>99,999</td>
                                    <td>99,999</td>
                                    <td>99,999</td>
                                    <td>80%</td>
                                </tr>
                                <?}?>
                            </tbody>
                        </table>
                    </div> <!-- table_wrap -->
                </div> <!-- contents -->
            </section>


<script type="text/javascript">
</script>