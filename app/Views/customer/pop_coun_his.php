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
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<form name="searchFrm" id="searchFrm">
		<input type="hidden" name="page" id="page" value="<?=$page?>">
		<input type="hidden" name="mode" id="mode" value="pop">
		<input type="hidden" name="mb_pid" id="mb_pid" value="">
		<div class="search_box">
			<div class="box_row">
				<span>상담일</span>
				<input type="text" name="searchSdate" class="date mWt80 txac" value="" /> ~
				<input type="text" name="searchEdate" class="date mWt80 txac" value="" />

				<span>인/아웃</span>
				<select name="searchkind1" class="wAuto">
					<option value="">전체</option>
					<?foreach($setting['code']['Counkind1'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
				</select>

				<span class="ml20">상담종류</span>
				<select name="searchkind2" class="wAuto">
					<option value="">전체</option>
					<?foreach($setting['code']['Counkind2'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
				</select>

				<span class="ml20">처리상태</span>
				<select name="searchkind3" class="wAuto">
					<option value="">전체</option>
					<option value="A">미처리</option>
					<option value="B">처리중</option>
					<option value="C">처리완료</option>
				</select>

				<span class="ml20">상담자</span>
				<select name="searchReg" class="wAuto">
					<option value="">전체</option>
					<?foreach($setting['manager'] as $row ) { if(strpos($row['mn_work'], 'cs') !== false) {echo '<option value="'.$row['mn_pid'].'">'.$row['mn_name'].'</option>';}}?>
				</select>

				<button type="button" class="bt_navy ml10" onclick="pop_sendSearch(1)">조회</button>

				<!-- <span class="ml20">전화</span>
				<select name="serchTel" class="wAuto">

				</select> -->
			</div> <!-- box_row -->


		</div> <!-- search_box -->
		</form>

		<div class="left_right_con_2">
			<div class="left_con">
				<div class="table_wrap" id="pop_list_area">

				</div> <!-- table_wrap -->

				<div class="mResultTablePage mContentWrap" id="pop_paging">

				</div> <!-- mResultTablePage -->
			</div> <!-- left_con -->

			<div class="right_con">
				<form name="cfm2" id="cfm2" method="post" action="execute" onsubmit="check_coun(this);return false;" target="hiddenFrame">
				<input type="hidden" name="mc_pid" id="mc_pid">
				<input type="hidden" name="mb_pid">
				<input type="hidden" name="mode" value="reg_cuon">
				<input type="hidden" name="mode2" value="pop">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt60">전화</th>
								<td>
									<select name="mc_tel" id="mc_tel" class="wAuto">

									</select>
								</td>
								<th class="mWt60">인/아웃</th>
								<td>
									<select name="mc_kind1" id="mc_kind1" class="wAuto">
										<?foreach($setting['code']['Counkind1'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
									</select>
								</td>
							</tr>
							<tr>
								<th>상담종류</th>
								<td>
									<select name="mc_kind2" id="mc_kind2" class="wAuto">
										<?foreach($setting['code']['Counkind2'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
									</select>
								</td>
								<th>처리상태</th>
								<td>
									<select name="mc_kind3" id="mc_kind3" class="wAuto">
										<option value="A">미처리</option>
										<option value="B">처리중</option>
										<option value="C">처리완료</option>
									</select>
								</td>
							</tr>
							<tr>
								<th>상담자</th>
								<td colspan="3">
									<span class="vam_dib mWt200" id='reg_name'></span>
									<button type="button" class="bt_gray" onclick="">녹취듣기</button>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<textarea name="mc_contents" id="mc_contents" class="txa_write"></textarea>
								</td>
							</tr>
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->

				<div class="buttonCenter mt10">
					<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
					<button type="submit" class="bt_150_40 bt_black" onclick="">저장</button>
				</div> <!-- buttonRight -->
				</form>
			</div> <!-- right_con -->
		</div> <!-- left_right_con_2 -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>