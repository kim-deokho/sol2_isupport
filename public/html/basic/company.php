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

                    <div class="table_wrap mWt900">
                        <table class="itable_1">
                            <tbody>
                                <tr>
                                    <th class="mWt150">회사명</th>
                                    <td class="mWt300"><input type="text" name="" class="mWt200" value="" /></td>
                                    <th class="mWt150">법인번호</th>
                                    <td class="mWt300"><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>
                                <tr>
                                    <th>대표자명</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                    <th>사업자번호</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>
                                <tr>
                                    <th>업태</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                    <th>종목</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>
                                <tr>
                                    <th>전화</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                    <th>휴대폰</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>
                                <tr>
                                    <th>팩스</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                    <th>이메일</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>
                                <tr>
                                    <th>업체로고<br />(투명(PNG)이미지 300&times;100 권장)</th>
                                    <td>
                                        <div class="logo_photo_reg">
                                            <div class="lpr_photo"><img src="../common/img/logo_photo.jpg" id="logo_prev" alt="logo" /></div>
                                            <div class="lpr_button">
                                                <div><button type="button" class="bt_white_bor" onclick="logo_reg();">찾아보기</button></div>
                                                <div><button type="button" class="bt_text" onclick="logo_del();">삭제</button></div>                                                                                
                                            </div>
                                            <input type="file" name="" id="logo_input" class="hidden" />
                                        </div> <!-- logo_photo_reg -->
                                    </td>
                                    <th>업체도장<br />(투명(PNG)이미지 150&times;150 권장)</th>
                                    <td>
                                        <div class="stamp_photo_reg">
                                            <div class="lpr_photo"><img src="../common/img/stamp_photo.jpg" id="stamp_prev" alt="stamp" /></div>
                                            <div class="lpr_button">
                                                <div><button type="button" class="bt_white_bor" onclick="stamp_reg();">찾아보기</button></div>
                                                <div><button type="button" class="bt_text" onclick="stamp_del();">삭제</button></div>                                                                                
                                            </div>
                                            <input type="file" name="" id="stamp_input" class="hidden" />
                                        </div> <!-- stamp_photo_reg -->
                                    </td>
                                </tr>
                                <tr>
                                    <th>주소</th>
                                    <td colspan="3">
                                        <div>
                                            <input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
                                            <button type="button" class="bt_white_bor" onclick="">주소찾기</button>
                                        </div>
                                        <div class="mt7">
                                            <input type="text" name="" class="mWt45p" value="" placeholder="기본주소" />
                                            <input type="text" name="" class="mWt45p" value="" placeholder="상세주소"  />
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table> <!-- itable_1 -->
                    </div> <!-- table_Wrap -->

                    <div class="title_1">※ 세금계산서 업무 담당자</div>
                    <div class="table_wrap mWt900">
                        <table class="itable_1">
                            <tbody>
                                <tr>
                                    <th class="mWt150">담당자명</th>
                                    <td class="mWt350"><input type="text" name="" class="mWt200" value="" /></td>
                                    <th class="mWt150">담당 전화</th>
                                    <td class="mWt350"><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>
                                <tr>
                                    <th>담당 이메일</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                    <th>담당 휴대폰</th>
                                    <td><input type="text" name="" class="mWt200" value="" /></td>
                                </tr>                                
                                <tr>
                                    <th>메모</th>
                                    <td colspan="3"><textarea name="" class="txa_base"></textarea></td>
                                </tr>
                            </tbody>
                        </table> <!-- itable_1 -->
                    </div> <!-- table_Wrap -->
                    <div class="buttonRight mt10  mWt900">
                        <button type="button" class="bt_150_40 bt_black" onclick="">저장</button>
                    </div>

                </div> <!-- contents -->
            </section>
        </div> <!-- container -->
		 
	<?            
        include_once "../common/inc/footer.php"; // footer
	?>

	</body>
</html>

<script type="text/javascript">
    // 로고 미리보기
    function readURL_logo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#logo_prev').attr('src', e.target.result);
            }                   
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 로고 이미지 변경
    $("#logo_input").on("change",function(){			
        readURL_logo(this);
    });

    // 로고 찾아보기 클릭
    function logo_reg() {        
        $("#logo_input").click();        
    }

    // 로고 삭제
    function logo_del(){
        $('#logo_prev').attr('src', '../common/img/logo_photo.jpg');
        $("#logo_input").val("");
    }

    // 도장 미리보기
    function readURL_stamp(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#stamp_prev').attr('src', e.target.result);
            }                   
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 도장 이미지 변경
    $("#stamp_input").on("change",function(){			
        readURL_stamp(this);
    });

    // 도장 찾아보기 클릭
    function stamp_reg() {        
        $("#stamp_input").click();        
    }

    // 도장 삭제
    function stamp_del(){
        $('#stamp_prev').attr('src', '../common/img/stamp_photo.jpg');
        $("#stamp_input").val("");
    }
</script>