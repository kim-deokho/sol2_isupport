<style type="text/css">
    #pop_check_list {max-width: 800px;}
    #pop_check_list table.ltable_1 td {text-align:center;}
    #pop_check_list .wear_type_2 {display:none;}
	.search_box > .box_row > span {background-color:#f2f2f2}
</style>

<div id="pop_check_list" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>실사 내역</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="regFrm" id="regFrm" method="post"  target="hiddenFrame" action="/stock/stock_check_item_excel">
		<input type='hidden' name='sr_pid'>
		<div class="search_box">
			<div class="box_row">
				<span></span>
				<div class="po_right">
					<button type="submit" class="bt_green ml5" onclick="">EXCEL</button>
				</div> <!-- po_right // 오른쪽 버튼 -->
			</div> <!-- box_row -->
		</div>

		</form>
		<div class="table_wrap" id='i_list'>
			<!-- itable_1 -->
		</div> <!-- table_Wrap -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->
