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
                            <span>등록일</span>
                            <input type="text" name="" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="" class="date mWt100 txac" value="" />                            
                            <span class="ml20">제목</span>
                            <input type="text" name="" class="mWt200" value="" placeholder="" />
                            <button type="button" class="bt_navy ml10" onclick="">조회</button>
                            
                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="notice_write();">글쓰기</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
                    
                    <div class="table_wrap">
						<table class="ltable_1 t_effect_1" id="">
							<thead>
								<tr>									
									<th class="mWt80">No.</th>
									<th>제목</th>
									<th class="mWt150">등록일</th>
								</tr>
							</thead>
							<tbody id="">
                                <?for($i=20;$i>0;$i--){?>
                                <tr onclick="notice_view()">
                                    <td><?=$i?></td>
                                    <td class="txal">[공지] 전체 회식 알림 (2020.03.05 오후 7시  OO 식당)</td>                                    
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
                </div> <!-- contents -->
            </section>
		</div> <!-- container -->
				 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>

	</body>
</html>

<script type="text/javascript">
	function notice_write(){
        location.href="./notice_write.php";		
    };

    function notice_view(){
        location.href="./notice_view.php";		
    }
</script>