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

                    <div class="left_right_con">
						<div class="left_con">
                            <div class="buttonRight mb10">
                                <button type="button" class="bt_black" onclick="authority_reg();">등록</button>
                            </div>
                            <div class="table_wrap">
								<table class="ltable_1 t_effect_1" id="">
									<thead>
										<tr>
											<th>코드</th>
											<th class="mWt40p">권한명</th>
											<th>사용유무</th>
											<th>수정</th>
										</tr>
									</thead>
									<tbody id="">									    
                                        <tr>
                                            <td>01</td>
                                            <td>대표이사</td>
                                            <td>Y</td>
                                            <td><button type="button" class="small set_button" onclick="modal('pop_authority_reg');">수정</button></td>
                                        </tr>
                                        <tr>
                                            <td>02</td>
                                            <td>영업팀</td>
                                            <td>Y</td>
                                            <td><button type="button" class="small set_button" onclick="modal('pop_authority_reg');">수정</button></td>
                                        </tr>
                                        <tr>
                                            <td>03</td>
                                            <td>배송팀</td>
                                            <td>Y</td>
                                            <td><button type="button" class="small set_button" onclick="authority_reg();">수정</button></td>
                                        </tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</div> <!-- left_con -->

						<div class="right_con">
                            <div class="buttonRight mb10">
                                <button type="button" class="bt_black" onclick="">저장</button>
                            </div>
                            <div class="table_wrap">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>대메뉴</th>
											<th>소메뉴</th>
											<th class="mWt60">접근</th>
											<th class="mWt60">저장</th>
											<th class="mWt60">삭제</th>
                                            <th class="mWt60">출력</th>
                                            <th class="mWt60">엑셀</th>
										</tr>
									</thead>
									<tbody id="">                                        
                                        <tr>
                                            <td>대메뉴명</td>
                                            <td>소메뉴명</td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                            <td><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></td>
                                        </tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</div> <!-- right_con -->
					</div> <!-- left_right_con -->
                                        
                </div> <!-- contents -->
            </section>
        </div> <!-- container -->
		 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>

        <?
			include_once "pop_authority_reg.php"; // 권한등록
		?>
	</body>
</html>

<script type="text/javascript">
    // 권한등록
    function authority_reg(){
        modal('pop_authority_reg');
    }
</script>