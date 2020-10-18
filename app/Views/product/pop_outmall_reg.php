<style type="text/css">
    #pop_outmall_reg {max-width: 350px;}
    #pop_outmall_reg .file_val {height:25px;border-bottom:1px solid #eee}
    #pop_outmall_reg .om_down > a {font-size:14px;font-weight:600;color:#1075c1;text-decoration:underline}
</style>

<div id="pop_outmall_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>엑셀 업로드</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="file_wrap mt10">                                     
			<button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
			<input type="file" name="" id="" class="hidden" value="" />
		</div> <!-- file_wrap -->
		<div class="om_down mt20"><a href="javascript:">엑셀양식 다운로드</a></div>

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close" onclick="">취소</button></a>
			<button type="button" class="bt_black ml5" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    // 파일첨부
    $(".file_wrap > button").on("click",function(){        
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });
</script>