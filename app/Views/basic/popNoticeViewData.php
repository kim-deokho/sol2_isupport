
<div class="table_wrap">
    <table class="itable_1">
        <tbody>
            <tr>
                <th class="mWt150">제목</th>
                <td><span id=""><?=$row['bd_title']?></span></td>
            </tr>
            <tr>
                <th>등록일</th>
                <td><?=$row['reg_date']?></td>
            </tr>
            <tr>
                <th>내용</th>
                <td><div class="view_content"><?=nl2br($row['bd_content'])?></div></td>
            </tr>
            <tr>
                <th class="mWt150">첨부</th>
                <td>
                    <div class="file_wrap"><a href="/basic/file_download/?filepath=<?=encryptURL(AWS_UPLOAD_HOST.$row['bd_file1'])?>&file_name=<?=urlencode($row['bd_org_file1'])?>"><?=$row['bd_org_file1']?></div>
                    <div class="file_wrap"><a href="/basic/file_download/?filepath=<?=encryptURL(AWS_UPLOAD_HOST.$row['bd_file2'])?>&file_name=<?=urlencode($row['bd_org_file2'])?>"><?=$row['bd_org_file2']?></div>
                </td>
            </tr>
            <tr>
                <th class="mWt150">링크</th>
                <td>
                    <div><a href="<?=$row['bd_link']?>" target="_blank"><?=$row['bd_link']?></a></div>
                </td>
            </tr>
        </tbody>
    </table> <!-- itable_1 -->
</div> <!-- table_Wrap -->

<div class="buttonCenter mt20">
    <a href="#" rel="modal:close"><button type="button" class="bt_gray modal_close">닫기</button></a>
    <button type="button" class="bt_black <?=$row['rg_id']!=$setting['session']['ss_mn_pid']?'js-save-btn':''?>" onclick="noticeWrite(event, '<?=$row['bd_pid']?>')">수정</button>
</div> 