
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>요청일</span>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <span class="ml20">구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">사유</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">주문번호</span>
                            <input type="text" name="" class="mWt100" value="" placeholder="" />

                            <span class="ml20">상담자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>미승인</span></label>

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
                                    <th rowspan="2" class="mWt50">No.</th>
                                    <th rowspan="2">선택</th>
                                    <th rowspan="2">요청일</th>
                                    <th rowspan="2">상세</th>
                                    <th rowspan="2">구분</th>
                                    <th rowspan="2">요청</th>
                                    <th rowspan="2">승인</th>
                                    <th colspan="2">반품</th>
                                    <th colspan="2">환불</th>
                                    <th colspan="3">교환</th>
                                    <th rowspan="2">상담자</th>
                                    <th rowspan="2">고객코드</th>
                                    <th rowspan="2">고객명</th>
                                    <th rowspan="2">주문일</th>
                                    <th rowspan="2" class="mWt250">상품</th>
                                    <th rowspan="2">수량</th>
                                    <th rowspan="2">사유</th>
                                    <th rowspan="2" class="mWt400">상세사유</th>
                                </tr>
                                <tr>
                                    <th>상태</th>
                                    <th>완료일</th>
                                    <th>상태</th>
                                    <th>완료일</th>
                                    <th>상태</th>
                                    <th>등록일</th>
                                    <th>완료일</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-02</td>
                                    <td><button type="button" class="small set_button" onclick="">보기</button></td>
                                    <td>교환</td>
                                    <td>선발송</td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td><a href="javascript:">반입완료</a></td>
                                    <td>2020-01-01</td>
                                    <td><a href="javascript:">환불완료</a></td>
                                    <td>2020-01-01</td>
                                    <td><a href="javascript:">주문완료</a></td>
                                    <td>2020-01-01</td>
                                    <td>2020-01-01</td>
                                    <td>김상담</td>
                                    <td>1435325</td>
                                    <td>홍길동</td>
                                    <td>2020-01-01</td>
                                    <td class="txal">커피포트 CF-123</td>
                                    <td>1</td>
                                    <td>주문오류</td>
                                    <td class="txal">주문을 잘못넣었음</td>
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