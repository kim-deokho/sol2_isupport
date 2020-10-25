<table class="ltable_1 t_effect_1" id="">
    <thead>
        <tr>									
            <th class="mWt50">No.</th>
            <th>매입처</th>
            <th>카테고리</th>
            <th>부품코드</th>
            <th>부품명</th>
            <th>부품가</th>
            <th>공임비</th>
            <th>사용여부</th>
            <th>등록일</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            $categoryPath = array($categorys[$row['pt_tc_pid1']]['tc_name']);
            if($row['pt_tc_pid2']) array_push($categoryPath, $categorys[$row['pt_tc_pid2']]['tc_name']);

            echo '<tr onclick="popPartsRegFrm(\''.$row['pt_pid'].'\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.$buyPids[$row['ct_pid']].'</td>';
            echo '  <td>'.implode(' > ', $categoryPath).'</td>';
            echo '  <td>'.$row['pt_code'].'</td>';
            echo '  <td>'.$row['pt_name'].'</td>';
            echo '  <td>'.number_format($row['pt_in_price']).'</td>';
            echo '  <td>'.number_format($row['pt_wages']).'</td>';
            echo '  <td>'.$row['pt_use'].'</td>';
            echo '  <td>'.dateFormat('Y-m-d', $row['reg_date']).'</td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?> 
    </tbody>
</table>