<style type="text/css">
	#pop_closed_set {max-width: 350px;}
</style>

<div id="pop_closed_set" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>휴무설정</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="buttonRight">
			<button type="button" class="bt_gray" onclick="closed_add();">+ 휴무일 추가</button>
		</div> <!-- buttonRight -->

		<div class="table_wrap mt5">
			<table class="itable_1">
				<tbody>   
					<tr>
						<th class="mWt100">기사</th>
						<td>
						   <select name="" class="wAuto">
						   <option value="">선택</option>
							</select>
						</td>
					</tr>          
					<tr>
						<th class="mWt100">휴무일</th>
						<td>
							<div class="td_closed_date">
								<div><input type="text" name="" class="date mWt100 txac" value="" /></div>
							</div> <!-- td_closed_date -->
						</td>
					</tr>                            
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap --> 				

		<div class="buttonCenter mt40">	
			<a href="#" rel="modal:close"><button type="button" class="bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    $(document).on("click",".date",function(){
        $(".date").datepicker({
            yearRange: 'c-100:c+10',
            changeYear: true,
            changeMonth: true            
        });
        $(this).datepicker('show');
    });

    // 휴무일 추가
    function closed_add(){
        var ca_date = "<div class=\"mt5\"><input type=\"text\" name=\"\" class=\"date mWt100 txac\" value=\"\" /></div>";                
        var ca_last = $(".td_closed_date > div:last");
        ca_last.after(ca_date);        
    }    
</script>