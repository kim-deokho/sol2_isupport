<style type="text/css">
    #pop_merge_member {max-width: 1100px;}
    #pop_merge_member .arrow_button {width:100%;text-align:center;}
    #pop_merge_member .arrow_button > img {width:24px;cursor:pointer;}
</style>

<div id="pop_merge_member" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>회원병합</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="title_1_1">고객정보 병합</div>
		<div class="three_areas">
			<div class="first_area mWt45p">
				<div class="search_box">
					<div class="box_row">
						<span class="row2_span">고객1</span>
						<div class="row2_div">
							<div>
								<select name="" class="wAuto">
									<option value="">이름</option>
								</select>
								<input type="text" name="" class="mWt150" value="" placeholder="검색어" />
								<button type="button" class="bt_navy ml10" onclick="">조회</button><br />
							</div>

							<div class="mt5">
								<select name="" class="mWt360">
									<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>
								</select>
							</div>
						</div> <!-- row2_div -->

						<div class="po_right">
							<button type="button" class="bt_red" onclick="">삭제</button>
						</div> <!-- po_right // 오른쪽 버튼 -->
					</div> <!-- box_row -->
				</div> <!-- search_box -->

				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt70">이름</th>
								<td>홍길동</td>
								<th class="mWt70">고객코드</th>
								<td>33525232</td>
							</tr>
							<tr>
								<th>전화1</th>
								<td>010123456567</td>
								<th>가입일</th>
								<td>2020-01-01</td>
							</tr>
							<tr>
								<th>전화2</th>
								<td>010123456567</td>
								<th>담당자</th>
								<td>김담당</td>
							</tr>
							<tr>
								<th>전화3</th>
								<td>010123456567</td>
								<th>회원구분</th>
								<td>기업</td>
							</tr>
							<tr>
								<th>주소</th>
								<td colspan="3">(12345)서울시 영등포구 여의도동 여의빌딩 35호</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt10p">
				<div class="arrow_button mt100" onclick=""><img src="<?=IMG_DIR?>/right_arrow.png" alt="오른쪽" /></div>
				<div class="arrow_button mt10" onclick=""><img src="<?=IMG_DIR?>/left_arrow.png" alt="왼쪽" /></div>
			</div> <!-- second_area -->

			<div class="third_area mWt45p">
				<div class="search_box">
					<div class="box_row">
						<span class="row2_span">고객2</span>
						<div class="row2_div">
							<div>
								<select name="" class="wAuto">
									<option value="">이름</option>
								</select>
								<input type="text" name="" class="mWt150" value="" placeholder="검색어" />
								<button type="button" class="bt_navy ml10" onclick="">조회</button><br />
							</div>

							<div class="mt5">
								<select name="" class="mWt360">
									<option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>
								</select>
							</div>
						</div> <!-- row2_div -->

						<div class="po_right">
							<button type="button" class="bt_red" onclick="">삭제</button>
						</div> <!-- po_right // 오른쪽 버튼 -->
					</div> <!-- box_row -->
				</div> <!-- search_box -->

				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt70">이름</th>
								<td>홍길동</td>
								<th class="mWt70">고객코드</th>
								<td>33525232</td>
							</tr>
							<tr>
								<th>전화1</th>
								<td>010123456567</td>
								<th>가입일</th>
								<td>2020-01-01</td>
							</tr>
							<tr>
								<th>전화2</th>
								<td>010123456567</td>
								<th>담당자</th>
								<td>김담당</td>
							</tr>
							<tr>
								<th>전화3</th>
								<td>010123456567</td>
								<th>회원구분</th>
								<td>기업</td>
							</tr>
							<tr>
								<th>주소</th>
								<td colspan="3">(12345)서울시 영등포구 여의도동 여의빌딩 35호</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->
			</div> <!-- third_area -->
		</div> <!-- three_areas -->

		<div class="title_1_1 mt20">주문정보 병합</div>
		<div class="three_areas">
			<div class="first_area mWt45p">
				<div class="table_wrap">
					<table class="ltable_1" id="">
						<thead>
							<tr>
								<th><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
								<th>주문번호</th>
								<th>주문일</th>
								<th>구분</th>
								<th class="mWt150">주문상품</th>
								<th>결제금액</th>
							</tr>
						</thead>
						<tbody id="">
							<tr>
								<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
								<td>A1111111</td>
								<td>2020-01-01</td>
								<td>주문</td>
								<td class="txal">양말 A 10SER (1)</td>
								<td>25,500</td>
							</tr>
						</tbody>
					</table>
				</div> <!-- table_wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt10p">
				<div class="arrow_button mt30" onclick=""><img src="<?=IMG_DIR?>/right_arrow.png" alt="오른쪽" /></div>
				<div class="arrow_button mt10" onclick=""><img src="<?=IMG_DIR?>/left_arrow.png" alt="왼쪽" /></div>
			</div> <!-- second_area -->

			<div class="third_area mWt45p">
				<div class="table_wrap">
					<table class="ltable_1" id="">
						<thead>
							<tr>
								<th><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
								<th>주문번호</th>
								<th>주문일</th>
								<th>구분</th>
								<th class="mWt150">주문상품</th>
								<th>결제금액</th>
							</tr>
						</thead>
						<tbody id="">
							<tr>
								<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
								<td>A1111111</td>
								<td>2020-01-01</td>
								<td>주문</td>
								<td class="txal">양말 A 10SER (1)</td>
								<td>25,500</td>
							</tr>
						</tbody>
					</table>
				</div> <!-- table_wrap -->
			</div> <!-- third_area -->
		</div> <!-- three_areas -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>