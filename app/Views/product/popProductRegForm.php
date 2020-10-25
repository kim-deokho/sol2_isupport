<style type="text/css">
	#pop_product_reg {max-width: 900px;}
</style>

<div id="pop_product_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>상품 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" target="hiddenFrame"  enctype="multipart/form-data" autocomplete="off" action="/product/execute" >
        <input type="hidden" name="mode" id="mode" value="reg_product">
        <input type="hidden" name="pd_pid" id="pd_pid">
        <input type="hidden" name="is_double" id="is_double">
        <input type="hidden" name="old_in_price" id="old_in_price">
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt100">상품코드</th>
						<td class="mWt360"><input type="text" name="pd_code" id="pd_code" class="mWt200" value=""/>
						<label class="chkWrap ml10" id="label_is_auto"><input type="checkbox" name="is_auto" value="Y" /><i></i><span>자동</span></label></td>
						<th class="mWt100">등록일</th>
						<td><span id="reg_update"></span></td>
					</tr>
					<tr>
						<th>카테고리</th>
						<td colspan="3">
                            <select name="pd_cate1" id="pd_cate1" id="pd_cate1" id="pd_cate1" class="wAuto product_categorys" onchange="cateCtr.chgCategory(this.value, 1, 'product_categorys', 'pd_cate')" required>
                                <option value="">전체</option>
<?                              foreach($categorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
                            </select>
                            <select name="pd_cate2" id="pd_cate2" id="pd_cate2" id="pd_cate2" class="wAuto product_categorys" onchange="cateCtr.chgCategory(this.value, 2, 'product_categorys', 'pd_cate')">
                                <option value="">전체</option>
                            </select>
                            <select name="pd_cate3" id="pd_cate3" id="pd_cate3" id="pd_cate3" class="wAuto product_categorys" onchange="cateCtr.chgCategory(this.value, 3, 'product_categorys', 'pd_cate')">
                                <option value="">전체</option>
                            </select>
						</td>								
					</tr>
					<tr>
						<th>상품명</th>
						<td>
							<input type="text" name="pd_name" id="pd_name" class="mWt250" value="" required/>
							<button type="button" class="bt_black" onclick="chkDoubleName()">중복확인</button>
						</td>
						<th>구분</th>
						<td>
                            <select name="pd_kind" id="pd_kind" class="wAuto">
<?                              foreach($setting['code']['ProductKind'] as $info) echo '<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';?>                      
                            </select>
						</td>
					</tr>
					<tr>
						<th>입고가</th>
						<td><input type="text" name="pd_in_price" id="pd_in_price" class="mWt100 txar input-comma" value="" /></td>
						<th>과세구분</th>
						<td>
							<label class="radioWrap"><input type="radio" name="pd_tax" value="Y" checked /><i></i><span>과세</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pd_tax" value="N"  /><i></i><span>비과세</span></label>
						</td>
					</tr>
					<tr>
						<th>정상가</th>
						<td><input type="text" name="pd_out_price" id="pd_out_price" class="mWt100 txar input-comma" value="" /></td>
						<th>사용유무</th>
						<td>
							<label class="radioWrap"><input type="radio" name="pd_use" value="Y" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pd_use" value="N"  /><i></i><span>N</span></label>
						</td>
					</tr>
					<tr>
						<th>매입처</th>
						<td>
                            <select class="buyer js-single-selector mWt250" name="ct_pid" id="ct_pid">
                                <option value="">-- 선택 --</option>
<?                              foreach($buyRows as $b_row) echo '<option value="'.$b_row['ct_pid'].'">'.$b_row['ct_name'].'</option>';?>
                            </select>
						</td>
						<th>품목단위</th>
						<td>
							<select name="pd_unit" id="pd_unit" class="wAuto">
<?                              foreach($setting['code']['ProductUnit'] as $info) echo '<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';?>  
							</select>
						</td>
					</tr>
					<tr>
						<th>바코드</th>
						<td>
							<div class="ppr_barcode">
								<span><input type="text" name="pd_barcode" id="pd_barcode" class="" value="" /></span>	
								<span></span>
							</div> <!-- ppr_barcode -->
						</td>
						<th>상품이미지</th>
						<td>
							<div class="p_img_reg">
                                <div class="lpr_photo"><img src="<?=IMG_DIR?>/img_none.jpg" id="p_img_prev" alt="이미지" /></div>
                                <div class="lpr_button">
                                    <div><button type="button" class="bt_white_bor find_file" data-target="file_pd_img">찾아보기</button></div>
                                    <div><button type="button" class="bt_text del_file"  data-prev="p_img_prev" data-empty="<?=IMG_DIR?>/img_none.jpg" data-input="file_pd_img">삭제</button></div>                                                                                
                                </div>
                                <input type="file" name="file_pd_img" id="file_pd_img" class="hidden prev_file" data-prev="p_img_prev" />
							</div> <!-- p_img_reg -->
						</td>
					</tr>
					<tr>
						<th>BOM여부</th>
						<td>
							<label class="radioWrap"><input type="radio" name="pd_bom" value="Y" checked /><i></i><span>Y</span></label>
							<label class="radioWrap ml20"><input type="radio" name="pd_bom" value="N"  /><i></i><span>N</span></label>
						</td>
						<th>배송타입</th>
						<td>
							<select name="pd_dely_type" id="pd_dely_type" class="wAuto">
<?                              foreach($fix_codes->DeliveryType as $k=>$v) echo '<option value="'.$k.'">'.$v.'</option>';?>                                
							</select>
						</td>
					</tr>
					<tr>
						<th>판매기간</th>
						<td>
							<input type="text" name="pd_sdate" id="pd_sdate" class="date mWt100 txac" value="" required /> ~
							<input type="text" name="pd_edate" id="pd_edate" class="date mWt100 txac" value="" required />
						</td>
						<th>배송비설정</th>
						<td>
							<select name="pd_delivery_kind" id="pd_delivery_kind" class="wAuto" onchange="chgDeliveryKind(this.value)">
<?                              foreach($fix_codes->DeliverySetting as $k=>$v) echo '<option value="'.$k.'">'.$v.'</option>';?>     
							</select>
                            <input type="text" name="pd_delivery_charge" id="pd_delivery_charge" class="mWt100 txar input-comma" placeholder="개별배송비용" readonly>
						</td>
					</tr>                            					
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="pd_bigo" id="pd_bigo" class="txa_small"></textarea></td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

		<div class="title_1">BOM 설정(판매)</div>
		<div class="table_wrap">
			<table class="itable_1">
				<tbody>							
					<tr>
						<th class="mWt120">상품선택</th>
						<td>
                            <select class="js-single-selector" name="search_bom" id="search_bom" onchange="setBomData(this.value)" style="width:100%;">
                                <option value="">-- 선택 --</option>
<?                              foreach($productRows as $p_row) echo '<option value="'.$p_row['pd_pid'].'|@|'.$p_row['pd_code'].'|@|'.$p_row['pd_name'].'|@|'.$p_row['pd_in_price'].'">'.$p_row['pd_name'].'&nbsp;&nbsp;&nbsp;( '.$p_row['pd_code'].' )</option>';?>
                            </select>
						</td>
					</tr>							
				</tbody>
			</table> <!-- itable_1 -->
		</div> <!-- table_Wrap -->

        <?# BOM 상품리스트?>
		<div class="table_wrap mt5" id="id_bom_product_list">
            <table class="ltable_1" id="tb_bom_list">
                <thead>
                    <tr>									
                        <th class="mWt50">No.</th>													
                        <th>상품코드</th>
                        <th>상품명</th>
                        <th class="mWt80">수량</th>
                        <th>입고가</th>
                        <th>정상가</th>
                        <th class="mWt100">삭제</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="tr_no_data">
                        <td colspan="10" class="no_data">등록된 상품이 없습니다.</td>
                    </tr>
                </tbody>
            </table>
        </div>

		<div class="buttonCenter mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
			<button type="submit" class="bt_150_40 bt_black ml5">저장</button>
		</div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
    </form>
</div> <!-- modal -->