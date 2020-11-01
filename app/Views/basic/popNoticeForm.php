<style type="text/css">
	#pop_notice_reg {max-width: 800px;}
</style>

<div id="pop_notice_reg" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>공지 등록</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="" target="hiddenFrame" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_notice">
        <input type="hidden" name="bd_pid" id="bd_pid" value="<?=$row['bd_pid']?>">
        <input type="hidden" class="hidden_file_del" name="file1_del" id="file1_del">
        <input type="hidden" class="hidden_file_del" name="file2_del" id="file2_del">
		<div class="table_wrap">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th class="mWt150">제목</th>
                        <td><input type="text" name="bd_title" id="bd_title" class="" value="<?=$row['bd_title']?>" required /></td>
                    </tr>
                    <tr>
                        <th>등록일</th>
                        <td><span id="reg_date"></span></td>
                    </tr>
                    <tr>
                        <th>내용</th>
                        <td><textarea name="bd_content" id="bd_content" class="txa_write" required><?=$row['bd_content']?></textarea></td>
                    </tr>
                    <tr>
                        <th class="mWt150">첨부</th>
                        <td>
                            <div class="file_wrap">
                                <button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
                                <span class="file_val" id="bd_org_file1"></span>
                                <span class="file_del"><img src="<?=IMG_DIR?>/pop_close.png" alt="삭제" data-target="file1_del" /></span>
                                <input type="file" name="file1" id="file1" class="hidden" value="" />
                            </div> <!-- file_wrap -->

                            <div class="file_wrap mt10">
                                <button type="button" class="bt_white_bor" onclick="">찾아보기</button>    
                                <span class="file_val" id="bd_org_file2"></span>
                                <span class="file_del"><img src="<?=IMG_DIR?>/pop_close.png" alt="삭제" data-target="file1_de2" /></span>
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
			<a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close">취소</button></a>
			<button type="submit" class="bt_black js-save-btn">저장</button>
        </div> <!-- buttonCenter -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->