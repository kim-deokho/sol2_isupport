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

                    <div class="search_box mt10">
						<div class="box_row">
							<span>부서</span>
							<select name="" class="wAuto">
								<option value="">전체</option>
                            </select>
                            <span class="ml20">근무</span>
							<select name="" class="wAuto">
								<option value="">전체</option>
							</select>
                            <span class="ml20">직원</span>
                            <input type="text" name="" class="mWt150" value="" placeholder="이름,연락처" />
                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="staff_reg();">직원등록</button>
                                <button type="button" class="bt_green ml10" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt50">No.</th>
									<th>부서</th>
									<th>직위</th>
									<th>직책</th>
									<th>사원코드</th>
									<th>이름</th>
									<th>전화</th>
									<th>휴대폰</th>
									<th>아이디</th>
									<th>업무</th>
									<th>이메일</th>
                                    <th>입사일</th>
                                    <th>퇴사일</th>
								</tr>
							</thead>
							<tbody id="">
							  <?for($i=20;$i>0;$i--){?>
							  <tr>
									<td><?=$i?></td>
									<td>배송팀</td>
									<td>차장</td>
									<td>팀장</td>
									<td>20200000</td>
									<td>김대리</td>
									<td>02-1234-5678</td>
									<td>010-1234-5678</td>
									<td>abcd1234</td>
									<td>배송</td>
									<td>abcd1234@ibuild.kr</td>
                                    <td>2020-04-13</td>
                                    <td>2020-04-13</td>
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
			include_once "pop_staff_reg.php"; // 직원등록
		?>
	</body>
</html>

<script type="text/javascript">
    // 직원등록
    function staff_reg(){
        modal('pop_staff_reg');
    }
</script>