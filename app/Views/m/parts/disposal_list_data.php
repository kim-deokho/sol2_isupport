<?
if(count($rows)>0) {
    foreach($rows as $row) {
        echo '<li>';
        echo '    <div>처리일 : '.dateFormat('Y-m-d', $row['aa_result_date']).' &#124; 폐기일 : '.dateFormat('Y-m-d', $row['ds_date']).'</div>';
        if($row['ma_cut_name']) echo '    <div>'.$row['ma_cut_name'].'('.$row['ma_cut_tel'].') </div>';
        else echo '<div class="fc163">[AS비연동 폐기등록]</div>';
        foreach($row['parts'] as $part) echo '<div>'.$part['pt_name'].' ('.number_format($part['qty']).')</div>';
        echo '</li>';
    }
}
else echo '<li class="no_data">내역이 존재하지 않습니다.</li>';
?>