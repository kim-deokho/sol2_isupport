<?
if(count($rows)>0) {
    foreach($rows as $row) {
        $payText='';
        if($row['aa_pay_kind']=='F') $payText='무상';
        else if($row['aa_pay_kind']=='P') $payText='유상 '.number_format($row['aa_total_price']);

        $btnDispose='<button type="button" class="dispose" onclick="win_load(\'/m/aservice/complete_list/'.$row['aa_pid'].'\')">부품폐기등록</button>';
        if($row['disposal_yn']=='Y') $btnDispose='<button type="button" class="dispose_ok">부품폐기등록[완료]</button>';

        echo '<li>';
        echo '    <div>요청일 : '.dateFormat('Y-m-d', $row['request_date']).' &#124; 처리일 : '.dateFormat('Y-m-d', $row['aa_result_date']).'</div>';
        echo '    <div>'.$row['ma_cut_name'].'('.$row['ma_cut_tel'].') <i>['.$payText.']</i></div>';
        echo '    <div>'.$row['ca_addr'].' '.$row['ca_addr2'].'</div>';
        echo '    <div>'.$btnDispose.'</div>';
        echo '</li>';
    }
}
else echo '<li class="no_data">내역이 존재하지 않습니다.</li>';
?>