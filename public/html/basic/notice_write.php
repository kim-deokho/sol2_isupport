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
                                    <td><input type="text" name="" class="" value="" /></td>
                                </tr>
                                <tr>
                                    <th>등록일</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th>내용</th>
                                    <td><textarea name="" class="txa_write"></textarea></td>
                                </tr>
                                <tr>
                                    <th class="mWt150">첨부</th>
                                    <td>
                                        <div class="file_wrap">
                                            <button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
                                            <span class="file_val"></span>
                                            <span class="file_del"><img src="../common/img/pop_close.png" alt="삭제" /></span>
                                            <input type="file" name="" id="" class="hidden" value="" />
                                        </div> <!-- file_wrap -->

                                        <div class="file_wrap mt10">
                                            <button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
                                            <span class="file_val"></span>
                                            <span class="file_del"><img src="../common/img/pop_close.png" alt="삭제" /></span>
                                            <input type="file" name="" id="" class="hidden" value="" />
                                        </div> <!-- file_wrap -->
                                    </td>
                                </tr>
                                <tr>
                                    <th class="mWt150">링크</th>
                                    <td>
                                        <div><input type="text" name="" class="" value="" /></div>
                                        <div class="mt10"><input type="text" name="" class="" value="" /></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> <!-- itable_1 -->
                    </div> <!-- table_Wrap -->

                    <div class="buttonCenter mt20">
                        <button type="button" class="bt_150_40 bt_gray" onclick="write_cancel();">취소</button>
                        <button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
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
    // 파일첨부
    $(".file_wrap > button").on("click",function(){        
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });

    $(".file_wrap > .file_del").on("click",function(){        
        $(this).prev(".file_val").text("");
        $(this).next("input[type=file]").val("");
    });

    // 취소
    function write_cancel(){
        history.back();
    };
</script>