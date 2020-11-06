
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>기간</span>
                            <select name="" class="wAuto">
                                <option value="">배송예정일</option>
                            </select>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="" class="date mWt100 txac" value="" />
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>창고</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">매출처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">주문종류</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">택배사</span>
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

                        <div class="box_row mt10">
                            <button type="button" class="bt_sblue" onclick="invoice_form();">송장엑셀양식</button>
                            <button type="button" class="bt_sblue" onclick="">거래내역서출력</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="courier_set();">택배사지정</button>
                                <button type="button" class="bt_black" onclick="">송장엑셀작업</button>
                                <button type="button" class="bt_black" onclick="invoice_upload();">송장업로드</button>
                                <button type="button" class="bt_black" onclick="dvcomple_proc();">배송완료처리</button>
								<button type="button" class="bt_red" onclick="">택배사지정취소</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->

                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:250%">
                            <thead>
                                <tr>
                                    <th class="mWt50">No.</th>
                                    <th><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
                                    <th>주문일</th>
                                    <th>배송예정일</th>
                                    <th>배송상태</th>
                                    <th>매출처</th>
                                    <th>주문구분</th>
                                    <th>배송메모</th>
                                    <th>택배사</th>
                                    <th>송장번호</th>
                                    <th>배송완료일</th>
                                    <th>배송타입</th>
                                    <th>주문번호</th>
                                    <th>상세주문번호</th>
                                    <th>창고</th>
                                    <th>상품</th>
                                    <th>수량</th>
                                    <th class="mWt250">상담메모</th>
                                    <th>거래내역서</th>
                                    <th>수취인</th>
                                    <th>연락처1</th>
                                    <th>연락처2</th>
                                    <th>우편번호</th>
                                    <th class="mWt300">주소</th>
                                    <th>고객코드</th>
                                    <th>고객명</th>
                                    <th>상담자</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr>
                                    <td><?=$i?></td>
                                    <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                    <td>2020-01-01</td>
                                    <td>2020-01-01</td>
                                    <td>주문완료</td>
                                    <td>전화</td>
                                    <td>신규</td>
                                    <td>문앞</td>
                                    <td>우체국</td>
                                    <td><button type="button" class="small bt_black" onclick="invoice_input();">입력</button></td>
                                    <td><button type="button" class="small bt_black" onclick="dvcomple_proc();">처리</button></td>
                                    <td>택배</td>
                                    <td>A11111111</td>
                                    <td>34643634</td>
                                    <td>강남매장</td>
                                    <td>커피포트 CF-123</td>
                                    <td>2</td>
                                    <td>문앞에 놓아주세요.</td>
                                    <td><button type="button" class="small bt_sblue" onclick="">보기</button></td>
                                    <td>홍길동</td>
                                    <td>01011111111</td>
                                    <td>0104454344</td>
                                    <td>12343</td>
                                    <td>서울시 강서구 영영동 23길</td>
                                    <td>35253252</td>
                                    <td>홍길동</td>
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


        <?
            include_once "pop_courier_set.php"; // 택배사지정
            include_once "pop_invoice_form.php"; // 송장엑셀양식
            include_once "pop_invoice_upload.php"; // 송장업로드
            include_once "pop_invoice_input.php"; // 송장번호입력
            include_once "pop_dvcomple_proc.php"; // 배송완료처리
        ?>

<script type="text/javascript">
    // 파일업로드
    $(".file_wrap > button").on("click",function(){
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });

	// 택배사지정
    function courier_set(){
        modal('pop_courier_set');
    }

	// 송장엑셀양식
    function invoice_form(){
        modal('pop_invoice_form');
    }

	// 송장업로드
    function invoice_upload(){
        modal('pop_invoice_upload');
    }

	// 송장번호입력
    function invoice_input(){
        modal('pop_invoice_input');
    }

	// 배송완료처리
    function dvcomple_proc(){
        modal('pop_dvcomple_proc');
    }
</script>