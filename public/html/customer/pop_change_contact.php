<style type="text/css">
	#pop_change_contact {max-width: 600px;}    
    #pop_change_contact .file_wrap > span.file_val {width: calc(100% - 180px);}
    #pop_change_contact .y_over {max-height:200px;overflow-y:auto;}
</style>

<div id="pop_change_contact" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>담당자 변경</span>
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
						<th class="mWt120">파일업로드</th>
						<td>
							<div class="file_wrap">
								<button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
								<span class="file_val"></span>
								<button type="button" class="bt_navy" onclick="">업로드</button>
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
			※ 엑셀 형식은 ‘고객코드,고객명’<br />
		</div> <!-- pop_recautions -->

		<div class="title_1_1">총20건</div>
		<div class="table_wrap y_over">
			<table class="ltable_1" id="">
				<thead>
					<tr>
						<th>고객코드</th>
						<th>고객명</th>
						<th>담당자</th>
					</tr>
				</thead>
				<tbody id="">
					<?for($i=20;$i>0;$i--){?>
					<tr>
						<td>35465745</td>
						<td>홍길동</td>
						<td>김담당</td>
					</tr>
					<?}?>                                
				</tbody>
			</table>
		</div> <!-- table_wrap -->

		<div class="table_wrap mt20">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt120">변경담당자</th>
						<td>
							<select name="" class="wAuto">
								<option value="">박담당</option>
							</select>
						</td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>