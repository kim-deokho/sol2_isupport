<style type="text/css">
	#pop_coun_his {max-width: 1100px;}
</style>

<div id="pop_coun_his" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>상담내역</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="search_box">
			<div class="box_row">
				<span>상담일</span>
				<input type="text" name="" class="date mWt100 txac" value="" /> ~ 
				<input type="text" name="" class="date mWt100 txac" value="" />
				
				<span class="ml20">전화</span>
				<select name="" class="wAuto">
					<option value="">전화1</option>
					<option value="">전화2</option>
					<option value="">전화3</option>
				</select>
			</div> <!-- box_row -->                    

			<div class="box_row mt10">
				<span>인/아웃</span>
				<select name="" class="wAuto">
					<option value="">인</option>
					<option value="">아웃</option>
					<option value="">수동</option>
				</select>

				<span class="ml20">상담종류</span>
				<select name="" class="wAuto">
					<option value="">신규주문</option>
					<option value="">재주문</option>
					<option value="">상담전달</option>
					<option value="">단순문의</option>
					<option value="">반품교환</option>
					<option value="">클레임</option>
					<option value="">콜백</option>
					<option value="">기타</option>
				</select>

				<span class="ml20">처리상태</span>
				<select name="" class="wAuto">
					<option value="">미처리</option>
					<option value="">처리중</option>
					<option value="">처리완료</option>
				</select>

				<span class="ml20">상담자</span>
				<select name="" class="wAuto">
					<option value="">홍길동</option>
				</select>

				<button type="button" class="bt_navy ml10" onclick="">조회</button>                       
			</div> <!-- box_row -->
		</div> <!-- search_box -->

		<div class="left_right_con_2">
			<div class="left_con">
				<div class="table_wrap">
					<table class="ltable_1 t_effect_1" id="">
						<thead>
							<tr>									
								<th class="mWt50">No.</th>
								<th>상담일시</th>
								<th>인/아웃</th>
								<th>상담종류</th>
								<th class="mWt180">상담내용</th>
								<th>전화</th>
								<th>처리상태</th>
								<th>상담자</th>
							</tr>
						</thead>
						<tbody id="">
							<?for($i=8;$i>0;$i--){?>
							<tr>
								<td><?=$i?></td>
								<td>2020-02-02<br />21:22:33</td>
								<td>아웃</td>
								<td>주문문의</td>
								<td>상담내용</td>
								<td>010-1234-2345</td>
								<td>처리중</td>
								<td>김상담</td>
							</tr>
							<?}?>
						</tbody>
					</table>
				</div> <!-- table_wrap -->

				<div class="mResultTablePage mContentWrap" id="">
					<div class="pageFirstButton pageButton">
						<img src="../common/img/button_list_big1_first.png" class="" alt="처음으로" >
					</div>
					<div class="pagePrevButton pageButton">
						<img src="../common/img/button_list_big1_prev.png" alt="이전으로" >
					</div>
					<div class="pageNum"><span class="on">1</span><span>2</span></div>
					<div class="pageNextButton pageButton">
						<img src="../common/img/button_list_big1_next.png" alt="다음으로" >
					</div>
					<div class="pageLastButton pageButton">
						<img src="../common/img/button_list_big1_last.png" alt="마지막으로" >
					</div>
				</div> <!-- mResultTablePage --> 
			</div> <!-- left_con -->

			<div class="right_con">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt60">전화</th>
								<td>
									<select name="" class="wAuto">
										<option value="">전화1</option>
										<option value="">전화2</option>
										<option value="">전화3</option>
									</select>
								</td>								
								<th class="mWt60">인/아웃</th>
								<td>
									<select name="" class="wAuto">
										<option value="">인</option>
										<option value="">아웃</option>
										<option value="">수동</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>상담종류</th>
								<td>
									<select name="" class="wAuto">
										<option value="">신규주문</option>
										<option value="">재주문</option>
										<option value="">상담전달</option>
										<option value="">단순문의</option>
										<option value="">반품교환</option>
										<option value="">클레임</option>
										<option value="">콜백</option>
										<option value="">기타</option>
									</select>
								</td>								
								<th>처리상태</th>
								<td>
									<select name="" class="wAuto">
										<option value="">미처리</option>
										<option value="">처리중</option>
										<option value="">처리완료</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>상담자</th>
								<td colspan="3">
									<span class="vam_dib mWt200">김상담</span>
									<button type="button" class="bt_gray" onclick="">녹취듣기</button>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<textarea name="" class="txa_write"></textarea>
								</td>
							</tr>                                    							
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
				
				<div class="buttonCenter mt10">   
					<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
					<button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
				</div> <!-- buttonRight -->
			</div> <!-- right_con -->
		</div> <!-- left_right_con_2 -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">	
</script>