<table class="ltable_1 t_effect_1" id="">
    <thead>
        <tr>
            <th class="mWt50">No.</th>
            <th>업체코드</th>
            <th>업체명</th>
            <th>구분</th>
            <th>전화번호</th>
            <th>대표자명</th>
            <th>사업자번호</th>
            <th>등록일</th>
            <th>거래유무</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            echo '<tr onclick="popTraderRegFrm(\''.$row['ct_pid'].'\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.$row['ct_code'].'</td>';
            echo '  <td>'.$row['ct_name'].'</td>';

            echo '  <td>'.$fix_codes->TraderKind[$row['ct_kind']].'</td>';
            echo '  <td>'.setPhonePattern($row['ct_tel']).'</td>';
            echo '  <td>'.$row['ct_ceo'].'</td>';
            echo '  <td>'.$row['ct_no'].'</td>';
            echo '  <td>'.dateFormat('Y-m-d', $row['reg_date']).'</td>';
            echo '  <td>'.$row['ct_use'].'</td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="9">내역이 존재하지 않습니다.</td></tr>';
?>
    </tbody>
</table>