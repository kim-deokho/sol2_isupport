<style type="text/css">
	#pop_as_cancel {max-width: 500px;}
</style>

<div id="pop_as_cancel" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>요청취소</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="cFrm" id="cFrm" method="post" target="hiddenFrame" action="/customer/execute">
        <input type="hidden" name="mode" id="mode" value="update_as_cancel">
        <input type="hidden" name="pids" id="pids">
        <input type="hidden" name="aa_state" id="aa_state" value="41">
        <input type="hidden" name="aa_result_state" id="aa_result_state" value="0315">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">취소사유</th>
						<td>
                            <select name="aa_result_code">
<?                              foreach($setting['code']['AsCancelType'] as $info) echo '<option value="'.$info['cd_code'].'">'.$info['cd_name'].'</option>';?>                                
                            </select>
                        </td>								
					</tr>
					<tr>
						<th>상세사유</th>
						<td><textarea name="aa_result_reason" class="txa_base"></textarea></td>								
					</tr>						
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close">취소</button></a>
			<button type="submit" class="bt_black js-save-btn">저장</button>
        </div> <!-- buttonCenter -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->