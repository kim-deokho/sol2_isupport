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
                            <div class="title_1 mt10">1차코드</div>                            
                            <div class="table_wrap mt30">
								<table class="ltable_1 t_effect_1" id="">
									<thead>
										<tr>
											<th>코드번호</th>
											<th class="mWt50p">코드명</th>
											<th>사용유무</th>											
										</tr>
									</thead>
									<tbody id="">									    
                                        <tr>
                                            <td>10001</td>
                                            <td>부서</td>
                                            <td>Y</td>
                                        </tr>
                                        <tr>
                                            <td>10002</td>
                                            <td>직책</td>
                                            <td>Y</td>
                                        </tr>
                                        <tr>
                                            <td>10003</td>
                                            <td>회원등급</td>
                                            <td>Y</td>
                                        </tr>
									</tbody>
								</table>
							</div> <!-- table_wrap -->
						</div> <!-- left_con -->

						<div class="right_con">
                            <div class="title_2 mt0">
                                <div>2차코드</div>
                                <div><button type="button" class="bt_black" onclick="code_reg();">등록</button></div>
                            </div> <!-- title_2 -->
                            <div class="precautions_1">※ ‘수정’ 버튼이 없는 코드는 수정이 불가능한 코드입니다.</div>                            
                            <div class="table_wrap mt10">
								<table class="ltable_1" id="">
									<thead>
										<tr>
											<th>코드번호</th>
											<th>순번</th>
											<th class="mWt40p">코드명</th>
											<th>사용유무</th>
											<th>관리</th>
										</tr>
									</thead>
									<tbody id="">                                        
                                        <tr>
                                            <td>01</td>
                                            <td>1</td>
                                            <td>영업팀</td>
                                            <td>Y</td>
                                            <td><button type="button" class="small set_button" onclick="code_reg();">수정</button></td>
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
			include_once "pop_code_reg.php"; // 코드등록
		?>
	</body>
</html>

<script type="text/javascript">
    // 코드등록
    function code_reg(){
        modal('pop_code_reg');
    }
</script>