<table class="ltable_1 t_effect_1" id="">
    <thead>
        <tr>									
            <th class="mWt50">No.</th>
            <th>부서</th>
            <th>직위</th>
            <th>직책</th>
            <th>사원코드</th>
            <th>이름</th>
            <th>전화</th>
            <th>휴대폰</th>
            <th>아이디</th>
            <th>업무</th>
            <th>이메일</th>
            <th>입사일</th>
            <th>퇴사일</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            $exp_work=explode(',', $row['mn_work']);
            $arr_work=array();
            foreach($exp_work as $w) {
                if(in_array($w, array_keys($setting['code']['Works']))) array_push($arr_work, $setting['code']['Works'][$w]);
            }
            echo '<tr onclick="popManagerFrm(\''.$row['mn_pid'].'\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.$setting['code']['Departments'][$row['mn_department']]['cd_name'].'</td>';
            echo '  <td>'.$setting['code']['Positions'][$row['mn_position']]['cd_name'].'</td>';
            echo '  <td>'.$setting['code']['Dutys'][$row['mn_duty']]['cd_name'].'</td>';
            echo '  <td>'.$row['mn_no'].'</td>';
            echo '  <td>'.$row['mn_name'].'</td>';
            echo '  <td>'.setPhonePattern($row['mn_tel']).'</td>';
            echo '  <td>'.setPhonePattern($row['mn_hp']).'</td>';
            echo '  <td>'.$row['mn_id'].'</td>';
            echo '  <td>'.implode(',', $arr_work).'</td>';
            echo '  <td>'.$row['mn_email'].'</td>';
            echo '  <td>'.$row['mn_in_date'].'</td>';
            echo '  <td>'.$row['mn_out_date'].'</td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>    
    </tbody>
</table>