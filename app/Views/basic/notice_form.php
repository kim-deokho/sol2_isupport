<section>
    <div class="contents">
<?
    include_once APPPATH.'/Views/_page_path.php';
?>
    <form name="regFrm" id="regFrm" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="" target="hiddenFrame" action="/basic/execute">
    <input type="hidden" name="mode" id="mode" value="reg_notice">
    <input type="hidden" name="bd_pid" id="bd_pid" value="<?=$row['bd_pid']?>">

        <div class="table_wrap mt10">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th class="mWt150">제목</th>
                        <td><input type="text" name="bd_title" id="bd_title" class="" value="<?=$row['bd_title']?>" /></td>
                    </tr>
                    <tr>
                        <th>등록일</th>
                        <td><?=dateFormat('Y-m-d', $row['reg_date'])?></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><textarea name="bd_content" id="bd_content" class="txa_write"><?=$row['bd_content']?></textarea></td>
                    </tr>
                    <tr>
                        <th class="mWt150">첨부</th>
                        <td>
                            <div class="file_wrap">
                                <button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
                                <span class="file_val"></span>
                                <span class="file_del"><img src="<?=IMG_DIR?>/pop_close.png" alt="삭제" /></span>
                                <input type="file" name="file1" id="file1" class="hidden" value="" />
                            </div> <!-- file_wrap -->

                            <div class="file_wrap mt10">
                                <button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
                                <span class="file_val"></span>
                                <span class="file_del"><img src="<?=IMG_DIR?>/pop_close.png" alt="삭제" /></span>
                                <input type="file" name="file2" id="file2" class="hidden" value="" />
                            </div> <!-- file_wrap -->
                        </td>
                    </tr>
                    <tr>
                        <th class="mWt150">링크</th>
                        <td>
                            <div><input type="text" name="bd_link" id="bd_link" class="" value="<?=$row['bd_link']?>" /></div>
                        </td>
                    </tr>
                </tbody>
            </table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->

        <div class="buttonCenter mt20">
            <button type="button" class="bt_150_40 bt_gray" onclick="write_cancel();">취소</button>
            <button type="submit" class="bt_150_40 bt_black ml5 ">저장</button>
        </div> <!-- buttonCenter -->
    </div> <!-- contents -->
</section>

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