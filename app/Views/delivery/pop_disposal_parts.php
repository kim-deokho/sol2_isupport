<style type="text/css">
    #pop_disposal_parts {max-width: 800px;}
    #pop_disposal_parts table.ltable_1 td {text-align:center;}
</style>

<div id="pop_disposal_parts" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품폐기</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="disFrm" id="disFrm" method="post" autocomplete="off" onsubmit="RegDisposalParts();return false;" enctype="multipart/form-data" target="hiddenFrame" action="/delivery/update_as">
        <input type="hidden" name="aa_pid">
        <input type="hidden" name="ds_pid">
		<div class="table_wrap" id="disposal_form_box"></div>                      

		<div class="buttonCenter mt20">
			<button type="submit" class="js-save-btn bt_150_40 bt_black">저장</button>
        </div> <!-- buttonRight -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->
<script>
function RegDisposalParts() {
    var f = $('#disFrm')[0];
    var data = new FormData(f);
    $.ajax({
        url : '/delivery/reg_disposal_part',
        enctype: 'multipart/form-data',
        processData: false, // 필수 
        contentType: false, // 필수
        data : data,
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            if(resJson.err_msg) {
                alertBox(resJson.err_msg);
            }
            else if(resJson.ok_msg) {
                alertBox(resJson.ok_msg, win_load, 'reload');
            }
        }
    });
    return false;
}
</script>

