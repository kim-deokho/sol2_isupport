
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="tab_wrap mt10">
                        <div class="tab_base">
                            <a href="#m_tab1" title="m_tab1" id="a_t1" class="active">무통장</a>
                            <a href="#m_tab2" title="m_tab2" id="a_t2">카드</a>
                        </div> <!-- tab_base -->

                        <div id="m_tab1" class="tab_base_con t_block">
                            <div class="search_box">
                                <div class="box_row">
                                    <span>기간</span>
                                    <select name="" class="wAuto">
                                        <option value="">주문일</option>
                                    </select>
                                    <input type="text" name="" class="date mWt100 txac" value="" /> ~
                                    <input type="text" name="" class="date mWt100 txac" value="" />

                                    <span class="ml20">매출처</span>
                                    <select name="" class="wAuto">
                                        <option value="">전체</option>
                                    </select>

                                    <span class="ml20">상담자</span>
                                    <select name="" class="wAuto">
                                        <option value="">전체</option>
                                    </select>

                                    <span class="ml20">입금확인</span>
                                    <select name="" class="wAuto">
                                        <option value="">전체</option>
                                    </select>
                                </div> <!-- box_row -->

                                <div class="box_row mt10">
                                    <span>회원</span>
                                    <select name="" class="wAuto">
                                        <option value="">이름</option>
                                    </select>
                                    <input type="text" name="" class="mWt150" value="" placeholder="" />

                                    <span class="ml20">입금자명</span>
                                    <input type="text" name="" class="mWt120" value="" placeholder="" />

                                    <span class="ml20">입금액</span>
                                    <input type="text" name="" class="mWt120" value="" placeholder="" />

                                    <button type="button" class="bt_navy ml10" onclick="">조회</button>

                                    <div class="po_right">
                                        <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                                    </div> <!-- po_right // 오른쪽 버튼 -->
                                </div> <!-- box_row -->
                            </div> <!-- search_box -->

                            <div class="table_wrap">
                                <table class="ltable_1 t_effect_1" id="" style="width:150%">
                                    <thead>
                                        <tr>
                                            <th class="mWt50">No.</th>
                                            <th class="mWt130">주문일시</th>
                                            <th>매출처</th>
                                            <th>고객코드</th>
                                            <th>고객명</th>
                                            <th>입금자명</th>
                                            <th>입금액</th>
                                            <th class="mWt120">입금예정일</th>
                                            <th class="mWt120">입금일</th>
                                            <th>은행명</th>
                                            <th class="mWt80">입금확인</th>
                                            <th class="mWt80">상품결재</th>
                                            <th>주문번호</th>
                                            <th>미수금</th>
                                            <th>상담자</th>
                                            <th>확인자</th>
                                            <th class="mWt130">확인일시</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <?for($i=20;$i>0;$i--){?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td>2020-01-02 12:33</td>
                                            <td>전화</td>
                                            <td>235346</td>
                                            <td>홍길동</td>
                                            <td>김순이</td>
                                            <td>123,000</td>
                                            <td>2020-01-01</td>
                                            <td><input type="text" name="" class="date mWt90 h_20 txac" value="" /></td>
                                            <td>
                                                <select name="" class="wAuto h_20">
                                                    <option value="">국민은행</option>
                                                </select>
                                            </td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td>43457457</td>
                                            <td>0</td>
                                            <td>김상담</td>
                                            <td>박회계</td>
                                            <td>2020-02-01 12:33</td>
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
                        </div> <!-- m_tab1 / tab_base_con -->

                        <div id="m_tab2" class="tab_base_con">
                            <div class="search_box">
                                <div class="box_row">
                                    <span>기간</span>
                                    <select name="" class="wAuto">
                                        <option value="">주문일</option>
                                    </select>
                                    <input type="text" name="" class="date mWt100 txac" value="" /> ~
                                    <input type="text" name="" class="date mWt100 txac" value="" />

                                    <span class="ml20">매출처</span>
                                    <select name="" class="wAuto">
                                        <option value="">전체</option>
                                    </select>

                                    <span class="ml20">상담자</span>
                                    <select name="" class="wAuto">
                                        <option value="">전체</option>
                                    </select>

                                    <span class="ml20">입금확인</span>
                                    <select name="" class="wAuto">
                                        <option value="">전체</option>
                                    </select>
                                </div> <!-- box_row -->

                                <div class="box_row mt10">
                                    <span>회원</span>
                                    <select name="" class="wAuto">
                                        <option value="">이름</option>
                                    </select>
                                    <input type="text" name="" class="mWt150" value="" placeholder="" />

                                    <span class="ml20">카드사</span>
                                    <select name="" class="mWt120">
                                        <option value="">전체</option>
                                    </select>

                                    <span class="ml20">입금액</span>
                                    <input type="text" name="" class="mWt120" value="" placeholder="" />

                                    <button type="button" class="bt_navy ml10" onclick="">조회</button>

                                    <div class="po_right">
                                        <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                                    </div> <!-- po_right // 오른쪽 버튼 -->
                                </div> <!-- box_row -->
                            </div> <!-- search_box -->

                            <div class="table_wrap">
                                <table class="ltable_1 t_effect_1" id="" style="width:150%">
                                    <thead>
                                        <tr>
                                            <th class="mWt50">No.</th>
                                            <th class="mWt130">주문일시</th>
                                            <th>매출처</th>
                                            <th>고객코드</th>
                                            <th>고객명</th>
                                            <th>입금액</th>
                                            <th>카드사</th>
                                            <th>승인</th>
                                            <th class="mWt120">승인일</th>
                                            <th>승인번호</th>
                                            <th class="mWt80">입금확인</th>
                                            <th class="mWt80">상품결재</th>
                                            <th>주문번호</th>
                                            <th>미수금</th>
                                            <th>상담자</th>
                                            <th>확인자</th>
                                            <th class="mWt130">확인일시</th>
                                        </tr>
                                    </thead>
                                    <tbody id="">
                                        <?for($i=20;$i>0;$i--){?>
                                        <tr>
                                            <td><?=$i?></td>
                                            <td>2020-01-02 12:33</td>
                                            <td>전화</td>
                                            <td>235346</td>
                                            <td>홍길동</td>
                                            <td>123,000</td>
                                            <td>
                                                <select name="" class="wAuto h_20">
                                                    <option value="">신한카드</option>
                                                </select>
                                            </td>
                                            <td>자동</td>
                                            <td>2020-01-02</td>
                                            <td>46464</td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td>43457457</td>
                                            <td>0</td>
                                            <td>김상담</td>
                                            <td>박회계</td>
                                            <td>2020-02-01 12:33</td>
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
                        </div> <!-- m_tab2 / tab_base_con -->
                    </div> <!-- tab_wrap -->
                </div> <!-- contents -->
            </section>






<script type="text/javascript">
</script>