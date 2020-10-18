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
                    
                    <div class="table_wrap mt10">
                        <table class="itable_1">
                            <tbody>
                                <tr>
                                    <th class="mWt150">제목</th>
                                    <td class="fw6">[공지] 전체 회식 알림 (2020.03.05 오후 7시  OO 식당)</td>
                                </tr>
                                <tr>
                                    <th>등록일</th>
                                    <td>2020-01-01 12:22:33</td>
                                </tr>
                                <tr>
                                    <th>내용</th>
                                    <td><textarea name="" class="txa_view">2월 15일까지 연말정산 서류 작성해서 김회계에게 전달 하세요. 첨부파일 확인.</textarea></td>
                                </tr>
                                <tr>
                                    <th class="mWt150">첨부</th>
                                    <td>
                                        <div class="file_wrap">
										<span class="file_link">연말정산서류양식.hwp</span> <button class="bt_text">삭제</button>
                                        </div> <!-- file_wrap -->

                                        <div class="file_wrap mt10">
										<span class="file_link">연말정산서류양식.hwp</span> <button class="bt_text">삭제</button>
                                        </div> <!-- file_wrap -->
                                    </td>
                                </tr>
                                <tr>
                                    <th class="mWt150">링크</th>
                                    <td>http://hometax.com</td>
                                </tr>
                            </tbody>
                        </table> <!-- itable_1 -->
                    </div> <!-- table_Wrap -->

                    <div class="buttonCenter mt20">
                        <button type="button" class="bt_150_40 bt_gray" onclick="notice_list();">목록</button>
                        <button type="button" class="bt_150_40 bt_black ml5" onclick="notice_edit()">수정</button>
                    </div> <!-- buttonCenter -->
                </div> <!-- contents -->
            </section>
        </div> <!-- container -->
				 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>

	</body>
</html>

<script type="text/javascript">    
    // 목록
    function notice_list(){
        location.href="./notice.php";
    };

    // 수정
    function notice_edit(){
        location.href="./notice_write.php";
    };
</script>