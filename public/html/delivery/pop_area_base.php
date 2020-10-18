<style type="text/css">
    #pop_area_base {max-width: 1000px;}
</style>

<div id="pop_area_base" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>기본지역등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
		<div class="two_areas">
			<div class="first_area mWt49p">
				<div class="title_1 mt0">시도</div>                            
				<div class="table_wrap mt20">
					<table class="ltable_1 t_effect_1" id="">
						<thead>
							<tr>
								<th>명칭</th>
								<th class="mWt80">사용여부</th>
								<th class="mWt80">관리</th>											
							</tr>
						</thead>
						<tbody id="">									    
							<tr>
								<td>서울,서울시,서울특별시</td>                                        
								<td>Y</td>
								<td><button type="button" class="small set_button" onclick="area_manage();">수정</button></td>
							</tr>
						</tbody>
					</table>
				</div> <!-- table_wrap -->
			</div> <!-- first_area -->

			<div class="second_area mWt49p">
				<div class="title_2 mt0">
					<div>시군구</div>
					<div><button type="button" class="bt_black" onclick="area_manage();">추가</button></div>
				</div> <!-- title_2 -->                        
				<div class="table_wrap mt10">
					<table class="ltable_1" id="">
						<thead>
							<tr>
								<th>명칭</th>
								<th class="mWt80">사용여부</th>
								<th class="mWt120">관리</th>											
							</tr>
						</thead>
						<tbody id="">                                        
							<tr>
								<td>강남구</td>                                        
								<td>Y</td>
								<td>
									<button type="button" class="small set_button" onclick="area_manage();">수정</button>
									<button type="button" class="small bt_red" onclick="area_manage_del();">삭제</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div> <!-- table_wrap -->
			</div> <!-- second_area -->
		</div> <!-- two_areas -->                
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/javascript">
    // 지역관리
    function area_manage(){
        modal('pop_area_manage');
    }

    // 시군구 삭제
    function area_manage_del(){
        var result = confirm('삭제하시겠습니까?');
        if(result) {             
        } else {
        }
    }
</script>