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
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->  
			</div> <!-- modal_header -->

			<div class="modal_contents">
                <div class="table_wrap y_over">
					<div>상품명 : 티셔츠</div>
                    <table class="ltable_1 mt10" id="">
                        <thead>
                            <tr>
                                <th>NO.</th>
                                <th>상품코드</th>
                                <th>상품명</th>
                                <th>입고가</th>
								<th>적용일</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <?for($i=10;$i>0;$i--){?>
                            <tr>
                                <td><?=$i?></td>
                                <td>001001001-00001</td>
                                <td>티셔츠</td>
                                <td>7,000</td>
								<td>2020-02-01</td>
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

	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">    
</script>