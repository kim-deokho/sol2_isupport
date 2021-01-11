<style type="text/css">
	#pop_bankbook_reg {max-width: 400px;}
</style>

<div id="pop_bankbook_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>결제입력(무통장)</span>
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
						<th class="mWt120">고객명</th>
						<td>김아빠</td>
					</tr>
					<tr>
						<th>입금은행</th>
						<td>
							<select name="" class="wAuto">
								<option value="">신한은행</option>
							</select>
						</td>								
					</tr>
					<tr>
						<th>계좌번호</th>
						<td>1234556677888888</td>
					</tr>                            
					<tr>
						<th>입금자명</th>
						<td><input type="text" name="" class="" value="" /></td>								
					</tr>
					<tr>
						<th>입금액</th>
						<td><input type="text" name="" class="txar" value="" /></td>								
					</tr>
					<tr>
						<th>입금예정일</th>
						<td><input type="text" name="" class="date" value="" /></td>
					</tr>
					<tr>
						<th>증빙</th>
						<td>
							<div>
								<select name="" id="pbbr_receipt_sel" class="wAuto">
									<option value="1">현금영수증</option>
									<option value="2">세금계산서</option>
									<option value="3">기타</option>
									<option value="4">발행안함</option>
								</select>
							</div> 
							<div class="pbbr_receipt_sh">
								<label class="radioWrap"><input type="radio" name="현금영수증구분" value="1" checked /><i></i><span>소득공제</span></label>
								<label class="radioWrap ml30"><input type="radio" name="현금영수증구분" value="2"  /><i></i><span>지출증빙</span></label>
							</div>
							<div class="mt5">
								<input type="text" name="" class="pbbr_receipt_input" value="" />
							</div>
						</td>
					</tr>                            
					<tr>
						<th>메모</th>
						<td><textarea name="" class="txa_base"></textarea></td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">					
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    // 영수증
    $("#pbbr_receipt_sel").on("change",function(){
        var receipt_val = $("#pbbr_receipt_sel > option:selected").val();
        if(receipt_val === "1"){
            $(".pbbr_receipt_sh").show();
            $("input.pbbr_receipt_input").prop('readonly', false);
		}else if(receipt_val === "2"){
            $(".pbbr_receipt_sh").hide();
            $("input.pbbr_receipt_input").prop('readonly', true);
        }else if(receipt_val === "3"){
            $(".pbbr_receipt_sh").hide();
            $("input.pbbr_receipt_input").prop('readonly', false);
        }else if(receipt_val === "4"){
            $(".pbbr_receipt_sh").hide();
            $("input.pbbr_receipt_input").hide();
		}
    });
</script>