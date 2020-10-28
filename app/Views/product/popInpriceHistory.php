<style type="text/css">
	#pop_receve_p_record {max-width: 600px;}        
    #pop_receve_p_record .y_over {max-height:500px;overflow-y:auto;}
</style>

<div id="pop_receve_p_record" class="modal">
    <div class="modal_header">
        <div class="modal_title">
            <span>상세이력</span>
            <span></span>
        </div> <!-- modal_title -->
        <div class="modal_close">
            <a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
        </div> <!-- modal_close -->  
    </div> <!-- modal_header -->

    <div class="modal_contents">
        <div class="table_wrap y_over">
            <div class="fs14  fw4">상품명 : <span id="history_product_name"></span></div>
            <table class="ltable_1 mt10" id="data_history_table">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>상품코드</th>
                        <th>상품명</th>
                        <th>입고가</th>
                        <th>적용일</th>
                    </tr>
                </thead>
            </table>
        </div> <!-- table_wrap -->

	</div> <!-- modal_contents -->
</div> <!-- modal -->