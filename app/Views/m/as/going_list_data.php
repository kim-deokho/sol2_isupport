<?
if(count($rows)>0) {
    foreach($rows as $row) {
        echo '<li onclick="detailForm(\''.$row['ma_pid'].'\')">';
        echo '    <div>요청일 : '.dateFormat('Y-m-d', $row['request_date']).' &#124; 예정일 : '.dateFormat('Y-m-d', $row['aa_visit_date']).'</div>';
        echo '    <div>'.$row['ma_cut_name'].'('.$row['ma_cut_tel'].') <i>['.$row['aa_visit_time'].']</i></div>';
        echo '    <div>'.$row['ca_addr'].' '.$row['ca_addr2'].'</div>';
        echo '</li>';
    }
}
else echo '<li class="no_data">내역이 존재하지 않습니다.</li>';
?>