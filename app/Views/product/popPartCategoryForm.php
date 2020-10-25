<style type="text/css">
    #pop_category_set {max-width: 400px;}
    .left_right_con > .left_con {float:none;width:auto;}
</style>

<div id="pop_category_set" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>부품 카테고리 설정</span>
			<span></span>
		</div> <!-- modal_title -->
		<!-- <div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> -->
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="left_right_con">
			<div class="left_con">
				<div class="category_wrap">
                    <div class="mostCategoryAdd" onclick="createRoot()">+ 최상위 카테고리 추가</div>
                    <div id='jstree_category'></div>
				</div> <!-- category_wrap -->
			</div> <!-- left_con -->
        </div> <!-- left_right_con -->
        <button type="button" class="bt_black buttonCenter mt10" onclick="win_load('reload')">적용</button>
	</div> <!-- modal_contents -->
</div> <!-- modal -->