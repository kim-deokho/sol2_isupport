<?            
        include_once "../common/inc/head.php"; // head
	?>
    <body>
        <?            
            include_once "../common/inc/header.php"; // header
        ?>
        <div class="container">
            <?            
                include_once "../common/inc/left_nav.php"; // left_nav
            ?>    
            <section>
                <div class="contents">
					<?            
						include_once "../common/inc/page_name.php"; // page_name
					?>

                    <div class="search_box">
                        <div class="box_row">
                            <span>발주일</span>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

                            <span class="ml20">매입처</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>발주상태</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">발주자</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="purchase_reg();">발주등록</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:200%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th>                                    
                                    <th>발주일</th>
                                    <th>발주번호</th>
                                    <th>상태</th>
                                    <th>매입처</th>
                                    <th>총발주금액</th>
                                    <th>발주서</th>
                                    <th>발주자</th>
                                    <th class="mWt150">비고</th>
                                    <th>상세발주번호</th>
                                    <th class="mWt250">상품</th>
                                    <th>구분</th>
                                    <th>입고가</th>                                    
                                    <th>실입고가</th>
                                    <th>발주수량</th>
                                    <th>발주금액</th>
                                    <th>입고수량</th>
                                    <th>잔여수량</th>
                                    <th>발주취소</th>                                    
                                    <th>취소수량</th>
                                    <th class="mWt200">비고</th>
                                </tr>                                
                            </thead>
                            <tbody id="">
                                <tr>                                    
                                    <td rowspan="3">2</td>
                                    <td rowspan="3">2020-01-01</td>
                                    <td rowspan="3">B000003</td>
                                    <td rowspan="3">부분입고</td>
                                    <td rowspan="3">상생산업</td>
                                    <td rowspan="3">5,200,000</td>
                                    <td rowspan="3"><button type="button" class="small bt_sblue" onclick="">보기</button></td>                                    
                                    <td rowspan="3">김발주</td>
                                    <td rowspan="3"></td>
                                    <td>A000003-01</td>
                                    <td class="txal">양말 A</td>
                                    <td>상품</td>                                    
                                    <td>1,250</td>
                                    <td>1,100</td>
                                    <td>1,000</td>
                                    <td>1,100,000</td>
                                    <td>
                                        <a href="javascript:">350 (2020-01-01)</a><br />
                                        <a href="javascript:">350 (2020-02-02)</a>
                                    </td>
                                    <td>200</td>
                                    <td><button type="button" class="small bt_black" onclick="purchase_cancel();">취소</button></td>
                                    <td>100 (2020-02-01)</td>
                                    <td>공장재고부족</td>
                                </tr>
                                <tr>
                                    <td>A000003-01</td>
                                    <td class="txal">커피포터 B</td>
                                    <td>상품</td>                                    
                                    <td>1,250</td>
                                    <td>1,100</td>
                                    <td>1,000</td>
                                    <td>1,100,000</td>
                                    <td>
                                        <a href="javascript:">100 (2020-01-01)</a>
                                    </td>
                                    <td>200</td>
                                    <td><button type="button" class="small bt_black" onclick="purchase_cancel();">취소</button></td>
                                    <td>100 (2020-02-01)</td>
                                    <td>공장재고부족</td>
                                </tr>
                                <tr>
                                    <td>A000003-01</td>
                                    <td class="txal">칫솔 A</td>
                                    <td>상품</td>                                    
                                    <td>1,250</td>
                                    <td>1,100</td>
                                    <td>1,000</td>
                                    <td>1,100,000</td>
                                    <td>
                                        <a href="javascript:">100 (2020-01-01)</a>
                                    </td>
                                    <td>200</td>
                                    <td><button type="button" class="small bt_black" onclick="purchase_cancel();">취소</button></td>
                                    <td>100 (2020-02-01)</td>
                                    <td>공장재고부족</td>
                                </tr>
                                <tr>                                    
                                    <td>1</td>
                                    <td>2020-01-01</td>
                                    <td>B000003</td>
                                    <td>부분입고</td>
                                    <td>상생산업</td>
                                    <td>5,200,000</td>
                                    <td><button type="button" class="small bt_sblue" onclick="">보기</button></td>                                    
                                    <td>김발주</td>
                                    <td></td>
                                    <td>A000003-01</td>
                                    <td class="txal">핸드크림 SSS</td>
                                    <td>상품</td>                                    
                                    <td>1,250</td>
                                    <td>1,100</td>
                                    <td>1,000</td>
                                    <td>1,100,000</td>
                                    <td>
                                        <a href="javascript:">350 (2020-01-01)</a><br />
                                        <a href="javascript:">350 (2020-02-02)</a>
                                    </td>
                                    <td>200</td>
                                    <td><button type="button" class="small bt_black" onclick="purchase_cancel();">취소</button></td>
                                    <td>100 (2020-02-01)</td>
                                    <td>공장재고부족</td>
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
        </div> <!-- container -->
				 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>
        
        <?
            include_once "pop_purchase_reg.php"; // 발주등록
            include_once "pop_purchase_cancel.php"; // 발주취소
        ?>
	</body>
</html>

<script type="text/javascript">
    // 발주등록
    function purchase_reg(){
        modal('pop_purchase_reg');
    }

    // 발주취소
    function purchase_cancel(){
        modal('pop_purchase_cancel');
    }
</script>