<style type="text/css">
	#pop_category_set {max-width: 800px;}
</style>

<div id="pop_category_set" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품 카테고리 설정</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="left_right_con">
			<div class="left_con">
				<div class="category_wrap">
					<div class="mostCategoryAdd" onclick="">+ 최상위 카테고리 추가</div>                        
					<div class="mMenuTree">
						001 펌프
					</div>
				</div> <!-- category_wrap -->
			</div> <!-- left_con -->

			<div class="right_con">
				<div class="table_wrap">
					<table class="itable_1">
						<tbody>
							<tr>
								<th class="mWt150">현재 카테고리</th>
								<td></td>								
							</tr>
							<tr>
								<th>카테고리코드</th>
								<td><input type="text" name="" class="" value="" readonly /></td>								
							</tr>
							<tr>
								<th>카테고리명</th>
								<td><input type="text" name="" class="" value="" /></td>								
							</tr>
							<tr>
								<th>하위 카테고리 추가</th>
								<td><button type="button" class="bt_gray" onclick="categoryChildrenAdd_click();">+ 하위추가</button></td>
							</tr>							
						</tbody>
					</table> <!-- itable_1 -->
				</div> <!-- table_Wrap -->

				<div class="buttonCenter mt15">
					<button type="button" class="bt_red" onclick="delButton_click();">삭제</button>
					<button type="button" class="bt_black ml5" onclick="saveButton_click();">저장</button>
				</div> <!-- buttonCenter -->
			</div> <!-- right_con -->
		</div> <!-- left_right_con -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    // 하위추가
    function categoryChildrenAdd_click(){
        alert_layer("더 이상 하위카테고리를<br/> 생성할 수 없습니다.")
    }

    // 삭제
    function delButton_click(){
        alert_layer("설정된 상품이 존재합니다.<br/> 상품 카테고리를 변경 후 삭제하세요.")
    }
</script>