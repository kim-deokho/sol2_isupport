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
                            <span>기간</span>
                            <select name="" class="wAuto">
                                <option value="">주문일</option>
                            </select>                            
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~ 
                            <input type="text" name="" class="date mWt100 txac" value="" />

							<span class="ml20">발행구분</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
								<option value="">세금계산서</option>
								<option value="">현금영수증</option>
								<option value="">기타</option>
                            </select>

                            <span class="ml20">발행여부</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
								<option value="">미발행</option>
								<option value="">발급완료</option>
								<option value="">전송완료</option>
								<option value="">취소</option>
                            </select>

                        </div> <!-- box_row -->

                        <div class="box_row mt10">
							<span>입금여부</span>
                            <select name="" class="wAuto">
                                <option value="">전체</option>
								<option value="">입금완료</option>
								<option value="">미입금</option>
								<option value="">입금취소</option>
                            </select>
                            
                            <span class="ml20">회원</span>
                            <select name="" class="wAuto">
                                <option value="">이름</option>
                            </select>
                            <input type="text" name="" class="mWt150" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="unite_tax();">세금계산서 묶음발행</button>
                                <button type="button" class="bt_black" onclick="unite_cash();">현금영수증 묶음발행</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
                        <table class="ltable_1 t_effect_1" id="" style="width:100%">
                            <thead>
                                <tr>									
                                    <th class="mWt50">No.</th> 
                                    <th class="mWt100">주문일</th>
									<th>고객명</th>
                                    <th>주문번호</th>
                                    <th>결제코드</th>
									<th>입금여부</th>
                                    <th class="mWt100">입금일</th>
                                    <th>입금액</th>
                                    <th>미입금액</th>
                                    <th>발행구분</th>
                                    <th class="mWt100">발행</th>
                                    <th>발행정보</th>
                                    <th class="mWt80">발행관리</th>                                    
                                    <th>총발행금액<br/></th>
									<th>총주문금액<br/>(미수금)</th>
                                </tr>                                
                            </thead>
                            <tbody id="">
								<tr>                                    
                                    <td>7</td>
                                    <td>2020-01-01</td>
									<td>최길동</td>
                                    <td>A589978435</td>
                                    <td>2546646</td>
									<td>환불요청</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="javascript:tax_bill();">세금계산서</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td>2020-02-27 (660,000) <span class="fw6">[발급완료]</span></td>                                    
                                    <td><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td>660,000</td>
									<td>660,000<br/>(660,000)</td>
                                </tr>
                                <tr>                                    
                                    <td rowspan="2">6</td>
                                    <td rowspan="2">2020-01-01</td>
									<td rowspan="2">홍길동</td>
                                    <td rowspan="2">A11111111</td>
                                    <td>4436448</td>
									<td>입금완료</td>
                                    <td>2020-01-02</td>
                                    <td>500,000</td>
                                    <td></td>
                                    <td><a href="javascript:tax_bill();">세금계산서</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td>2020-02-27 (200,000) <span class="fw6">[발급완료]</span><br/>2020-03-02 (300,000) <span class="fw6">[전송완료]</span></td>                                    
                                    <td rowspan="2"><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td rowspan="2">800,000</td>
									<td rowspan="2">1,000,000<br/>(500,000)</td>
                                </tr>
                                <tr>
                                    <td>4436433</td>
									<td>미입금</td>
                                    <td></td>
                                    <td></td>
									<td>500,000</td>
									<td><a href="javascript:tax_bill();">세금계산서</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td>2020-03-02 (300,000) <span class="fw6">[전송완료]</span></td>                                    
                                    <td></td>
                                </tr>
                                <tr>                                    
                                    <td>5</td>
                                    <td>2020-01-01</td>
									<td>최길동</td>
                                    <td>A333333333</td>
                                    <td>6546546</td>
									<td>입금완료</td>
                                    <td>2020-02-27</td>                                    
                                    <td>1,000,000</td>
                                    <td></td>
                                    <td><a href="javascript:cash_receipt();">현금영수증</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td>2020-03-21 (1,000,000) <span class="fw6">[전송완료]</span></td>                                    
                                    <td><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td>1,000,000</td>
									<td>1,000,000<br/>(0)</td>
                                </tr>   
								 <tr>                                    
                                    <td>4</td>
                                    <td>2020-01-01</td>
									<td>최길동</td>
                                    <td>A444444444</td>
                                    <td>6577666</td>
									<td>미입금</td>
                                    <td></td>                                    
                                    <td></td>
                                    <td>1,000,000</td>
                                    <td><a href="javascript:tax_bill();">세금계산서</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td>2020-03-21 (500,000) <span class="fw6 fcdb">[취소]</span></td>                                    
                                    <td><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td>0</td>
									<td>2,000,000<br/>(2,000,000)</td>
                                </tr> 
								 <tr>                                    
                                    <td>3</td>
                                    <td>2020-01-01</td>
									<td>김사장</td>
                                    <td>A555555555</td>
                                    <td>6444444</td>
									<td>입금완료</td>
                                    <td>2020-02-03</td>
                                    <td>350,000</td>
                                    <td></td>
                                    <td><a href="javascript:tax_etc();">기타</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td></td>                                    
                                    <td><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td>350,000</td>
									<td>750,000<br/>(400,000)</td>
                                </tr> 
								 <tr>                                    
                                    <td>2</td>
                                    <td>2020-01-01</td>
									<td>최길동</td>
                                    <td>A436464436</td>
                                    <td>6566634</td>
									<td>입금완료</td>
                                    <td>2020-02-03</td>
                                    <td>2,500,000</td>
                                    <td></td>
                                    <td><a href="javascript:tax_bill();">세금계산서</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td></td>                                    
                                    <td><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td>2,500,000</td>
									<td>2,500,000<br/>(0)</td>
                                </tr>
								<tr>                                    
                                    <td>1</td>
                                    <td>2020-01-01</td>
									<td>최길동</td>
                                    <td>A589978435</td>
                                    <td>2546646</td>
									<td>입금완료</td>
                                    <td>2020-02-03</td>
                                    <td>230,000</td>
                                    <td></td>
                                    <td><a href="javascript:tax_bill();">세금계산서</a></td>
                                    <td><button type="button" class="set_button" onclick="">발행</button></td>
                                    <td></td>                                    
                                    <td><button type="button" class="small bt_black" onclick="">관리</button></td>
                                    <td>230,000</td>
									<td>230,000<br/>(0)</td>
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
            include_once "pop_cash_receipt.php"; // 현금영수증
            include_once "pop_tax_bill.php"; // 세금계산서
			include_once "pop_tax_etc.php"; // 기타
        ?>
	</body>
</html>

<script type="text/javascript">
    // 현금영수증
    function cash_receipt(){
        modal('pop_cash_receipt');
    }

    // 세금계산서
    function tax_bill(){
        modal('pop_tax_bill');
    }

	// 기타
    function tax_etc(){
        modal('pop_tax_etc');
    }
</script>