<style type="text/css">
    #pop_receve_p_reg {max-width: 350px;}
    #pop_receve_p_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_receve_p_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>입고가등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" target="hiddenFrame" autocomplete="off" action="/product/execute" >
        <input type="hidden" name="mode" id="mode" value="reg_product_inprice">
        <input type="hidden" name="pd_pid" id="pd_pid">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">상품명</th>
						<td><span id="product_name"></span></td>
					</tr>                            
					<tr>
						<th>입고가</th>
						<td><span id="product_in_price"></span></td>
					</tr>
					 <tr>
						<th>적용입고가</th>
						<td><input type="text" name="pi_in_price" id="pi_in_price" class="mWt100 txar input-comma" value="" required/></td>
					</tr>
					<tr>
						<th>적용일</th>
						<td><input type="text" name="pi_in_date" id="pi_in_date" class="date mWt100 txac" value="" required/></td>
					</tr>                                                       						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">		
			<a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close" onclick="">취소</button></a>
			<button type="submit" class="bt_black ml5">저장</button>
        </div> <!-- buttonCenter -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->