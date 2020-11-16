<table class="ltable_1 t_effect_1" id="">
    <thead>
        <tr>									
            <th class="mWt80">No.</th>
            <th>제목</th>
            <th class="mWt100">등록자</th>
            <th class="mWt150">등록일</th>
            <th class="mWt80">삭제</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            echo '<tr onclick="noticeWrite(event, \''.$row['bd_pid'].'\', \'view\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td class="txal"><div class="dis_inb mr5">'.$row['bd_title'].'</div>';
            if($row['bd_file1']) echo '<a href="/basic/file_download/?filepath='.encryptURL(AWS_UPLOAD_HOST.$row['bd_file1']).'&file_name='.urlencode($row['bd_org_file1']).'" onclick="event.cancelBubble=true" class="dis_inb mr5"><i class="fa fa-floppy-o fa-1" aria-hidden="true"></i></a>';
            if($row['bd_file2']) echo '<a href="/basic/file_download/?filepath='.encryptURL(AWS_UPLOAD_HOST.$row['bd_file2']).'&file_name='.urlencode($row['bd_org_file2']).'" onclick="event.cancelBubble=true" class="dis_inb mr5"><i class="fa fa-floppy-o fa-1" aria-hidden="true"></i></a>';
            if($row['bd_link']) echo '<a href="'.$row['bd_link'].'" onclick="event.cancelBubble=true" target="_blank"><i class="fa fa-link fa-1" aria-hidden="true"></i></a>';
            echo '</td>';
            echo '  <td>'.$row['mn_name'].'</td>';
            echo '  <td>'.dateFormat('Y-m-d', $row['mn_out_date']).'</td>';
            echo '  <td><button class="small set_button '.($row['rg_id']!=$setting['session']['ss_mn_pid']?'js-del-btn':'').'" style="background-color:#fa6b58" onclick="event.cancelBubble=true;confirmBox(\'정말 삭제하시겠습니까?\', noticeDel, \''.$row['bd_pid'].'\')">삭제</button></td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>    
    </tbody>
</table>