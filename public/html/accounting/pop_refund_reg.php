<style type="text/css">
    #pop_refund_reg {max-width: 900px;}
    #pop_refund_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_refund_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>환불 처리</span>
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
						<th class="mWt100">환불완료일</th>
						<td><input type="text" name="" class="date mWt100 txac" value="" /></td>
						<th class="mWt100">상태</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>환불금액</th>
						<td>4,000</td>
						<th>배송비청구</th>
						<td>환불차감 (3,000)</td>
					</tr>
					<tr>
						<th>환불방법</th>
						<td colspan="3">승인취소</td>
					</tr>
					<tr>
						<th>환불메모</th>
						<td colspan="3">삼성카드/45433454</td>
					</tr>
					<tr>
						<th>전체입금내역</th>
						<td colspan="3">
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>									
											<th>입금일</th>													
											<th>입금정보</th>
											<th>입금금액</th>
											<th class="fcdb">환불금액</th>
											<th class="mWt140">환불처리</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>2020-02-02</td>
											<td class="txal">무통장(신한은행 / 김고객 / 798000066667)</td>
											<td>10,000</td>
											<td class="fcdb">0</td>
											<td><input type="text" name="" class="mWt110 h_20 txar" value="" /></td>
										</tr>
										<tr>
											<td>2020-02-02</td>
											<td class="txal">카드(삼성/45433454)</td>
											<td>5,500</td>
											<td class="fcdb">-4,000</td>
											<td><input type="text" name="" class="mWt110 h_20 txar" value="" /></td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                     
						</td>								
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="" class="txa_small"></textarea></td>
					</tr>                                                       						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->
		<div class="precautions_1 mt10">
			※ ‘환불처리’는 다시 수정할 수 없으므로 신중하게 처리하세요.  (카드 : 자동승인취소 / 무통장 : 수동입금)
		</div> <!-- precautions_1 -->

		<div class="buttonCenter mt20">	
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>