<?
if(count($rows)>0) {
    foreach($rows as $row) {
        echo '<li onclick="detailForm(\''.$row['pi_pid'].'\')">';
        echo '    <div>요청일 : '.dateFormat('Y-m-d', $row['reg_date']).' '.($row['pi_result_confirm_yn']=='Y'?'<span class="fc04">[수령완료]</span>':'').'</div>';
        echo '    <div>'.$setting['code']['Storage'][$row['pi_store']]['cd_name'].'<i>['.($row['pi_confirm_date']?dateFormat('Y-m-d ', $row['pi_confirm_date']):'').$setting['code']['pi_kind'][$row['pi_kind']].'/'.$setting['code']['pi_state'][$row['pi_state']].']</i>'.'</div>';
        foreach($row['items'] as $item) echo '<div>'.$item['pt_name'].' ('.number_format($item['ii_qea']).')</div>';
        echo '</li>';
    }
}
else echo '<li class="no_data">내역이 존재하지 않습니다.</li>';
?>