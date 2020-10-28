<table class="ltable_1 t_effect_1" id="">
    <thead>
        <tr>
            <th class="mWt50">No.</th>
            <th>카테고리</th>
            <th>상품코드</th>
            <th>상품명</th>
            <th>구분</th>
            <th>입고가</th>
            <th>관리</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            $categoryPath = array($categorys[$row['pc_pid1']]['pc_name']);
            if($row['pc_pid2']) array_push($categoryPath, $categorys[$row['pc_pid2']]['pc_name']);
            if($row['pc_pid3']) array_push($categoryPath, $categorys[$row['pc_pid3']]['pc_name']);
            echo '<tr>';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.implode(' > ', $categoryPath).'</td>';
            echo '  <td>'.$row['pd_code'].'</td>';
            echo '  <td id="target_p_name_'.$row['pd_pid'].'">'.$row['pd_name'].'</td>';
            echo '  <td>'.$setting['code']['ProductKind'][$row['pd_kind']]['cd_name'].'</td>';
            echo '  <td id="target_p_price_'.$row['pd_pid'].'">'.number_format($row['pd_in_price']).'</td>';
            echo '  <td><button type="button" class="small set_button js-save-btn" onclick="popInpriceRegFrm(\''.$row['pd_pid'].'\');">등록</button><button type="button" class="ml20 small set_button" onclick="popHistory(\''.$row['pd_pid'].'\');">상세이력</button></td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?> 
    </tbody>
</table>