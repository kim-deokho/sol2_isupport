<style type="text/css">
    #pop_as_reg {max-width: 900px;}
    #pop_as_reg table.ltable_1 td {text-align:center;}
</style>

<div id="pop_as_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>AS 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->
    <form name="asFrm" id="asFrm" method="post" action="/customer/execute" target="hiddenFrame">
    <input type="hidden" name="mode" id="mode" value="add_member_as">
    <input type="hidden" name="mb_pid" id="mb_pid">
    <input type="hidden" name="od_pid" id="od_pid">
	<div class="modal_contents">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th>상담기록</th>
						<td colspan="3">
							<select name="mc_tel" class="mc_tel wAuto"></select>
							<select name="mc_kind1" class="wAuto" required>
                                <option value="">전화종류</option>
                            <?foreach($setting['code']['Counkind1'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
                            </select>
                            <select name="mc_kind2" class="wAuto" required>
                                <option value="">상담종류</option>
                            <?foreach($setting['code']['Counkind2'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
                            </select>
                            <select name="mc_kind3" class="wAuto">
                                <option value="A">미처리</option>
                                <option value="B">처리중</option>
                                <option value="C">처리완료</option>
                            </select>

							<label class="chkWrap ml20"><input type="checkbox" name="ma_is_hurryup" value="Y" /><i></i><span class="fcdb">긴급</span></label>
						</td>
					</tr>
					<tr>
						<th>구매정보</th>
						<td colspan="3">
							<div>
								<span class="fw6 mr10">주문검색</span>
								<input type="text" name="" class="mWt600" value="" />
							</div>
							<div class="table_wrap mt5">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th class="mWt100">주문일</th>
											<th>주문번호</th>
											<th>주문상세번호</th>
											<th>수취인</th>
											<th>매출처</th>
										</tr>
									</thead>
									<tbody id="">
										<tr>
											<td>2020-01-01</td>
											<td><a href="javascript:">A11111111</a></td>
											<td>3464363345</td>
											<td>김엄마</td>
											<td>매장 > 강남1매장</td>
										</tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
							<div class="mt5">
								<span class="fw6 mr10">확인불가</span>
								<label class="chkWrap"><input type="checkbox" name="ma_no_order" id="ma_no_order" value="Y" /><i></i></label>
								<input type="text" name="ma_order_memo" class="mWt500 ml10" value="" />
							</div>
						</td>
					</tr>
					<tr>
						<th>제품정보</th>
						<td colspan="3">
							<div>
								<select class="js-single-selector" name="pd_pid" id="pd_pid" onchange="setProduct(this.value)" style="width:100%;">
                                    <option value="">-- 상품선택 --</option>
<?                                  foreach($productRows as $p_row) echo '<option value="'.$p_row['pd_pid'].'">'.$p_row['pd_name'].'</option>';?>
                                </select>
							</div>
							<div class="table_wrap mt5">
								<table class="ltable_1" id="as_product">
									<thead>
										<tr>
											<th>카테고리</th>
											<th>매입처</th>
											<th>상품코드</th>
											<th>상품명</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div> <!-- table_wrap -->
						</td>
					</tr>
					<tr>
						<th class="mWt100">제품시리얼</th>
						<td><input type="text" name="ma_serial" id="ma_serial" class="" value="" /></td>
						<th class="mWt100">모델명</th>
						<td><input type="text" name="ma_model" id="ma_model" class="" value="" /></td>
					</tr>
					<tr>
						<th>부위</th>
						<td>
							<select name="ma_part" class="wAuto">
<?                              foreach($setting['code']['AsPart'] as $info) echo '<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';?>
							</select>
						</td>
						<th>증상</th>
						<td>
							<select name="ma_symptom" class="wAuto">
<?                              foreach($setting['code']['AsSymptom'] as $info) echo '<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';?>
							</select>
						</td>
					</tr>
					<tr>
						<th>AS 수취인</th>
						<td><input type="text" name="ma_cut_name" class="mWt120" value="" /></td>
						<th>구분</th>
						<td>
							<select name="ma_kind" class="wAuto">
<?                              foreach($setting['code']['AsKind'] as $info) echo '<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';?>
							</select>
						</td>
					</tr>
					<tr>
						<th>AS 연락처1</th>
						<td><input type="text" name="ma_cut_tel" class="mWt120"  /></td>
						<th>AS 연락처2</th>
						<td><input type="text" name="ma_cut_tel2" class="mWt120" value="" /></td>
					</tr>
					<tr>
                        <th>주소</th>
                        <td colspan="3">
                            <div>
                                <input type="text" name="ca_post" id="ca_post" class="mWt80" value="" placeholder="우편번호" required readonly />
                                <button type="button" class="bt_white_bor" onclick="pop_post('ca_post', 'ca_addr', 'ca_addr2')">주소찾기</button>
                                <button type="button" class="bt_gray ml10" onclick="adress_reg('selectDelivery')">배송지선택</button>
                            </div>
                            <div class="mt7">
                                <input type="text" name="ca_addr" id="ca_addr" class="mWt45p" value="" placeholder="기본주소" required readonly/>
                                <input type="text" name="ca_addr2" id="ca_addr2" class="mWt45p" value="" placeholder="상세주소" required />
                            </div>
                        </td>
					</tr>
					<tr>
						<th>상담내용</th>
						<td colspan="3"><textarea name="mc_contents" class="txa_base" required></textarea></td>
					</tr>
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="buttonCenter mt20">
			<a href="javascript:void(0)" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close">취소</button></a>
			<button class="bt_150_40 bt_black ml5">저장</button>
		</div> <!-- buttonCenter -->
    </div> <!-- modal_contents -->
    </form>
</div> <!-- modal -->

<script type="text/javascript">
</script>