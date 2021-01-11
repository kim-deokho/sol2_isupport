<style type="text/css">
	#pop_adress_reg {max-width: 1000px;}
</style>

<div id="pop_adress_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>배송지 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->  
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="search_box">
			<div class="box_row">
				<span>수취인</span>
				<input type="text" name="" class="mWt120" value="" placeholder="" />
				<span class="ml20">연락처1</span>
				<input type="text" name="" class="mWt150" value="" placeholder="" />
				<span class="ml20">연락처2</span>
				<input type="text" name="" class="mWt150" value="" placeholder="" />
			</div> <!-- box_row -->

			<div class="box_row mt10">
				<span>주소</span>
				<button type="button" class="bt_white_bor" onclick="">주소찾기</button>
				<input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
				<input type="text" name="" class="mWt270" value="" placeholder="주소1" />
				<input type="text" name="" class="mWt200" value="" placeholder="주소2" />

				<div class="po_right">
					<div><button type="button" class="bt_black" onclick="">등록</button> <!--수정, 등록, 리셋--></div>
				</div> <!-- po_right // 오른쪽 버튼 -->
			</div> <!-- box_row -->
		</div> <!-- search_box -->

		<div class="table_wrap">
			<table class="ltable_1 t_effect_1" id="">
				<thead>
					<tr>									
						<th>선택</th>
						<th>수취인</th>
						<th>연락처1</th>
						<th>연락처2</th>
						<th>우편번호</th>
						<th class="mWt250">주소1</th>
						<th class="mWt200">주소2</th>
						<th>적용</th>
						<th>기본배송지</th>
					</tr>
				</thead>
				<tbody id="">
					<?for($i=5;$i>0;$i--){?>
					<tr>
						<td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
						<td>김길동</td>
						<td>010-1234-1234</td>
						<td>010-1234-1234</td>
						<td>12345</td>
						<td></td>
						<td></td>
						<td><button type="button" class="small bt_gray" onclick="">적용</button></td>
						<td><label class="radioWrap"><input type="radio" name="기본배송지[]" value="" /><i></i></label></td>
					</tr>
					<?}?>
				</tbody>
			</table>
		</div> <!-- table_wrap -->
		<div class="buttonWrap mt10">
			<div class="btLeft">
				<button type="button" class="bt_red" onclick="">삭제</button>
			</div> <!-- btLeft -->

			<div class="btRight">
				<button type="button" class="bt_black" onclick="">기본배송지설정</button>
			</div> <!-- btRight -->
		</div> <!-- buttonWrap -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
</script>