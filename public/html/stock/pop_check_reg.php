<style type="text/css">
	#pop_check_reg {max-width: 700px;}    
    #pop_check_reg .file_wrap > span.file_val {width: calc(100% - 180px);}
</style>

<div id="pop_check_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>실사 등록</span>
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
						<th>실사일</th>
						<td colspan="3"><input type="text" name="" class="date mWt100 txac" value="" /></td>
					</tr>
					<tr>
						<th class="mWt100">창고</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
						<th class="mWt100">실사자</th>
						<td>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>상품카테고리</th>
						<td colspan="3">
							<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>전체</span></label>
							<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>의류</span></label>
							<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>식품</span></label>
							<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>가전</span></label>
						</td>
					</tr>
					<tr>
						<th>부품카테고리</th>
						<td colspan="3">
							<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>펌프</span></label>
							<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>안마의자</span></label>
							<label class="chkWrap ml10"><input type="checkbox" name="" value="" /><i></i><span>TV</span></label>
						</td>
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><input type="text" name="" class="" value="" /></td>
					</tr>
					<tr>
						<th>상품다운로드</th>
						<td colspan="3">
							<button type="button" class="bt_green" onclick="">EXCEL</button>
							<span class="ml20">※ 선택한 카테고리의 BOM 상품목록(현재고) 다운로드</span>
						</td>
					</tr>
					<tr>
						<th class="mWt120">실사업로드</th>
						<td colspan="3">
							<div class="file_wrap">
								<button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
								<span class="file_val"></span>
								<button type="button" class="bt_navy" onclick="">업로드</button>
								<input type="file" name="" id="" class="hidden" value="" />
							</div> <!-- file_wrap -->
						</td>
					</tr>
					<tr>
						<th>재고조정</th>
						<td colspan="3">
							<label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>일괄 재고 자동 조정</span></label>
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