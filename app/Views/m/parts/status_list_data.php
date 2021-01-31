<?
if(count($rows)>0) {
    echo '<div class="table_wrap_l">';
    echo '    <table class="ltable_2" id="">';
    echo '        <thead>';
    echo '            <tr>		';							
    echo '                <th class="mWt45p">부품명</th>';
    echo '                <th>신청</th>';
    echo '                <th>사용</th>';
    echo '                <th>반입</th>';
    echo '                <th>현재</th>';
    echo '            </tr>';
    echo '        </thead>';
    echo '        <tbody>';
    foreach($rows as $row) {
        echo '<tr>';
        echo '    <td class="p_name">';
        echo '        <div>'.$partCategorysData[$row['pt_tc_pid1']]['tc_name'].' > '.$partCategorysData[$row['pt_tc_pid2']]['tc_name'].'</div>';
        echo '       <div>'.$row['pt_name'].'</div>';
        echo '    </td>';
        echo '    <td>'.number_format($row['apply_cnt']).'</td>';
        echo '    <td>'.number_format($row['use_cnt']).'</td>';
        echo '    <td>'.number_format($row['return_cnt']).'</td>';
        echo '    <td>'.number_format($row['stock_cnt']).'</td>';
        echo '</tr>';
    }
    echo '       </tbody>';
    echo '    </table>';
    echo '</div>';
}
else echo '<li class="no_data">내역이 존재하지 않습니다.</li>';
?>