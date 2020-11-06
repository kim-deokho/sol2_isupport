<style type="text/css">
	#pop_invoice_upload {max-width: 500px;}    
    #pop_invoice_upload .file_wrap > span.file_val {width: calc(100% - 100px);}
</style>

<div id="pop_invoice_upload" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>송장번호 업로드</span>
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
						<th class="mWt100">파일업로드</th>
						<td>
							<div class="file_wrap">
								<button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
								<span class="file_val"></span>                                        
								<input type="file" name="" id="" class="hidden" value="" />
							</div> <!-- file_wrap -->
						</td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="pop_recautions mt10">
		※ 파일이름에 ‘한글‘ 사용불가<br />
		※ 시트는 1개만 사용 (시트명 ‘Sheet1’)<br />
		※ 엑셀 형식은 ‘발송일,주문상세번호,운송장번호’<br />
		※ 송장번호와 배송일이 입력되면 주문상태가 ‘배송중’으로 자동 변경됩니다.<br />
		</div> <!-- pop_recautions -->

		<div class="buttonCenter mt20">					
			<a href="#" rel="modal:close"><button type="button" class="bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>