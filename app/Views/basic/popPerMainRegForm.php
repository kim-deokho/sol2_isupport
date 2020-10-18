<style type="text/css">
	#pop_permition_reg {max-width: 350px;}
</style>

<div id="pop_permition_reg"  class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>권한 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
		</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" onsubmit="regPermain(this);return false;" target="hiddenFrame" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_permain">
        <input type="hidden" name="bn_pid" id="bn_pid">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">권한명</th>
						<td><input type="text" name="bn_name" id="bn_name" class="mWt200" value="" required/></td>
					</tr>
					<tr>
						<th>사용유무</th>
						<td>
<?                          foreach(array('Y', 'N') as $i=>$use) echo '<label class="radioWrap '.($i==0?'':'ml30').'"><input type="radio" name="bn_use" value="'.$use.'"  /><i></i><span>'.$use.'</span></label>';?>
						</td>
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
