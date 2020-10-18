<style type="text/css">
	#pop_code_reg {max-width: 500px;}
</style>

<div id="pop_code_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>코드 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" onsubmit="regCode(this);return false;" target="hiddenFrame" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_code">
        <input type="hidden" name="cd_pid" id="cd_pid">
        <input type="hidden" name="p_cd_pid" id="p_cd_pid">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">1차코드</th>
						<td><span id="main_code_name"></span></td>								
					</tr>
					<!-- <tr>
						<th>순번</th>
						<td><input type="text" name="" class="mWt200" value="" /></td>								
					</tr> -->
					<tr>
						<th>코드명</th>
						<td><input type="text" name="cd_name" id="cd_name" class="mWt200" value="" required/></td>								
					</tr>
					<tr>
						<th>사용유무</th>
						<td>
<?                          foreach(array('Y', 'N') as $i=>$use) echo '<label class="radioWrap '.($i==0?'':'ml30').'"><input type="radio" name="cd_use" value="'.$use.'"  /><i></i><span>'.$use.'</span></label>';?>
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

<script type="text/javascript">	
</script>