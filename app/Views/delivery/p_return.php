
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

                            <span class="ml20">구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상담자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">사유</span>
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

                            <span class="ml20">상품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <span class="ml20">주문번호</span>
                            <input type="text" name="" class="mWt100" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:150%">
                            <thead>
                                <tr>
                                    <th class="mWt50">No.</th>
                                    <th>요청일</th>
                                    <th>상태</th>
                                    <th>반입완료일</th>
                                    <th>상담자</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>주문일</th>
                                    <th>주문번호</th>
                                    <th class="mWt300">상품</th>
                                    <th>수량</th>
                                    <th>사유</th>
                                    <th class="mWt200">상세사유</th>
                                    <th>반입처리</th>
                                    <th>반입구분</th>
                                    <th>처리자</th>
                                    <th class="mWt250">메모</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <tr>
                                    <td rowspan="2">2</td>
                                    <td rowspan="2">2020-01-02</td>
                                    <td rowspan="2">반입완료</td>
                                    <td rowspan="2">2020-01-01</td>
                                    <td rowspan="2">김상담</td>
                                    <td rowspan="2">35253253</td>
                                    <td rowspan="2">홍길동</td>
                                    <td rowspan="2">2020-01-20</td>
                                    <td rowspan="2">A11111111</td>
                                    <td class="txal">양말 A - 10SET</td>
                                    <td>1</td>
                                    <td rowspan="2">주문오류</td>
                                    <td rowspan="2">잘못넣었음</td>
                                    <td rowspan="2"><button type="button" class="small bt_sblue" onclick="preturn_proc();">처리내역</button></td>
                                    <td>정상</td>
                                    <td rowspan="2">김물류</td>
                                    <td rowspan="2" class="txal">배송비 5,000원 동봉</td>
                                </tr>
                                <tr>
                                    <td class="txal">커피포트 CF-123</td>
                                    <td>1</td>
                                    <td>폐기</td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>2020-01-02</td>
                                    <td>반품요청</td>
                                    <td></td>
                                    <td>김상담</td>
                                    <td>35253253</td>
                                    <td>홍길동</td>
                                    <td>2020-01-20</td>
                                    <td>A11111111</td>
                                    <td class="txal">양말 A - 10SET</td>
                                    <td>1</td>
                                    <td>주문오류</td>
                                    <td></td>
                                    <td><button type="button" class="small bt_black" onclick="preturn_proc();">반입처리</button></td>
                                    <td>정상</td>
                                    <td></td>
                                    <td class="txal"></td>
                                </tr>
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


        <?
            include_once "pop_preturn_proc.php"; // 반입처리
        ?>

<script type="text/javascript">
    // 반입처리
    function preturn_proc(){
        modal('pop_preturn_proc');
    }
</script>