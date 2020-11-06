
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>기간</span>
                            <select name="" class="wAuto">
                                <option value="">방문일</option>
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
                        <table class="ltable_1 t_effect_1" id="">
                            <thead>
                                <tr>
                                    <th class="mWt50">No.</th>
                                    <th class="mWt100">방문일</th>
                                    <th>접수번호</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>입금자명</th>
                                    <th>금액</th>
                                    <th class="mWt110">입금일</th>
                                    <th class="mWt190">결제수단</th>
                                    <th class="mWt60">입금확인</th>
                                    <th>승인번호</th>
                                    <th>AS기사</th>
                                    <th>상담자</th>

                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td>2020-01-01</td>
                                    <td>AS20200101-001</td>
                                    <td>235346</td>
                                    <td>홍길동</td>
                                    <td>김순이</td>
                                    <td>123,000</td>
                                    <td><input type="text" name="" class="date mWt90 h_20 txac" value="" /></td>
                                    <td>
                                        <select name="" class="wAuto h_20">
                                            <option value="">무통장</option>
                                        </select>
                                        <select name="" class="wAuto h_20">
                                            <option value="">국민은행</option>
                                        </select>
                                    </td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>34325232</td>
                                    <td>김기사</td>
                                    <td>김상담</td>
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






<script type="text/javascript">
</script>