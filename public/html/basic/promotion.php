<?            
        include_once "../common/inc/head.php"; // head
	?>
    <body>
        <?            
            include_once "../common/inc/header.php"; // header
        ?>
        <div class="container">
            <?            
                include_once "../common/inc/left_nav.php"; // left_nav
            ?>    
            <section>
                <div class="contents">
					<?            
						include_once "../common/inc/page_name.php"; // page_name
					?>

                    <div class="search_box">
						<div class="box_row">
							<span>구분</span>
							<select name="" class="mWt100">
								<option value="">전체</option>
                            </select>
                            <span class="ml20">명칭</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />
                            <span class="ml20">사용여부</span>
							<select name="" class="mWt100">
								<option value="">전체</option>
							</select>
                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="event_reg();">프로모션등록</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt50">No.</th>
									<th>구분</th>
									<th>명칭</th>
									<th>기간</th>
									<th>기준</th>
									<th>할인</th>
									<th>대상</th>
									<th>사용여부</th>
									<th>등록일</th>
									<th>최종수정</th>
								</tr>
							</thead>
							<tbody id="">
							  <?for($i=20;$i>0;$i--){?>
							  <tr>
									<td><?=$i?></td>
									<td>배송비</td>
									<td>무료배송</td>
									<td>2020-01-01 ~ 2020-01-03</td>
									<td>양말A 5개</td>
									<td>무료</td>
									<td>창신유통</td>
									<td>Y</td>
									<td>2020-02-25</td>
									<td>2020-02-03 12:33 홍길동</td>
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
                </div> <!-- contents -->
            </section>
		</div> <!-- container -->
		 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>
		
		<?
			include_once "pop_event_reg.php"; // 프로모션등록
		?>
	</body>
</html>

<script type="text/javascript">
    // 프로모션등록
    function event_reg(){
        modal('pop_event_reg');
    }
</script>