<style type="text/css">
    #pop_order_upload {max-width: 1100px;}
</style>

<div id="pop_order_upload" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>주문업로드</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">파일업로드</th>
						<td>
							  <select name="" class="wAuto">
								 <option value="">옥션</option>
							  </select>
							  <input type="text" name="" class="mWt200" value="" />
							  <button type="button" class="bt_white_bor" onclick="">찾아보기</button>
							  <button type="button" class="ml10 bt_black" onclick="order_upload();">불러오기</button>
						 </td>
					</tr>      						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="pop_recautions mt10">
		※ 파일이름에 ‘한글‘ 사용불가 / 시트는 1개만 사용 (시트명 ‘Sheet1’)하며, 몰별 엑셀 양식을 설정 후 업로드 하세요.
		</div> <!-- pop_recautions -->   

		<div class="table_wrap mt10">
			   <table class="ltable_1" id="" style="width:180%">
				   <thead>
						<tr>									
							<th class="mWt50">No.</th>                                    
							<th>등록일</th>
							<th>매출처</th>
							<th>몰주문번호</th>
							<th>몰상세주문번호</th>
							<th>몰주문일</th>
							<th>몰상품번호</th>
							<th class="mWt150">몰상품명</th>
							<th>수량</th>
							<th>몰판매가</th>
							<th>수수료율</th>
							<th>배송비</th>
							<th>결제금액</th>                                    
							<th>수취인</th>
							<th>수취인연락처1</th>
							<th>수취인연락처2</th>
							<th>우편번호</th>
							<th class="mWt300">수취인주소</th>
							<th class="mWt200">배송메세지</th>  
							<th>삭제</th>
						</tr>                                
					</thead>
					<tbody id="">                                
						<?for($i=10;$i>0;$i--){?>
						<tr>                                    
							<td><?=$i?></td>
							<td>2020-02-02</td>
							<td>옥션</td>
							<td>3432522</td>
							<td>3432522-000</td>
							<td>2020-02-01</td>
							<td>123456</td>
							<td>양말 A 세트</td>                                    
							<td>2</td>
							<td>20,000</td>
							<td>25%</td>
							<td>3,000</td>
							<td>18,000</td>
							<td>홍길동</td>
							<td>01000000000</td>                                    
							<td>0200000000</td>
							<td>34567</td>
							<td>서울시 영등포 여의로 43길 33</td>
							<td>빨리보내주세요.</td>
							<td><button type="button" class="small bt_red" onclick="">삭제</button></td>
						</tr>                                
						<?}?>                               
					</tbody>
			   </table>
		</div> <!-- table_wrap -->            

		<div class="buttonCenter mt20">					
			<button type="button" class="bt_150_40 bt_sblue" onclick="">업로드</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">   
</script>