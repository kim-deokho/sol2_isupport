<table class="ltable_1 t_effect_1" id="">
    <thead>
        <tr>
            <th class="mWt50">No.</th>
            <th>매입처</th>
            <th>카테고리</th>
            <th>상품코드</th>
            <th>상품명</th>
            <th>구분</th>
            <th>입고가</th>
            <th>정상가</th>
            <th>사용유무</th>
            <th>등록일</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            $categoryPath = array($categorys[$row['pc_pid1']]['pc_name']);
            if($row['pc_pid2']) array_push($categoryPath, $categorys[$row['pc_pid2']]['pc_name']);
            if($row['pc_pid3']) array_push($categoryPath, $categorys[$row['pc_pid3']]['pc_name']);
            echo '<tr onclick="popProductFrm(\''.$row['pd_pid'].'\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.$buyPids[$row['ct_pid']].'</td>';
            echo '  <td>'.implode(' > ', $categoryPath).'</td>';
            echo '  <td>'.$row['pd_code'].'</td>';
            echo '  <td>'.$row['pd_name'].'</td>';
            echo '  <td>'.$setting['code']['ProductKind'][$row['pd_kind']]['cd_name'].'</td>';
            echo '  <td>'.number_format($row['pd_in_price']).'</td>';
            echo '  <td>'.number_format($row['pd_out_price']).'</td>';
            echo '  <td>'.$row['pd_use'].'</td>';
            echo '  <td>'.dateFormat('Y-m-d', $row['reg_date']).'</td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?> 
    </tbody>
</table>