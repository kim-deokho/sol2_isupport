<table class="ltable_1 t_effect_1" id="" style="width:200%">
    <thead>
        <tr>
            <th class="mWt50">No.</th>
            <th>선택</th>
            <th>요청일</th>
            <th>접수번호</th>
            <th>상담자</th>
            <th>고객명</th>
            <th>연락처1</th>
            <th>구매처</th>
            <th>구분</th>
            <th>긴급</th>
            <th>상태</th>
            <th>완료상태</th>
            <th>AS기사</th>
            <th>방문일정</th>
            <th>AS처리</th>
            <th>완료일</th>
            <th class="mWt300">상담내용</th>
            <th class="mWt300">취소/미처리 사유</th>
            <th class="mWt250">상품</th>
            <th>부위</th>
            <th>증상</th>
        </tr>
    </thead>
    <tbody>
<?
    if($totCnt>0) {
        foreach($rows as $row) {
            echo '<tr>';
            echo '  <td>'.$num--.'</td>';
            echo '  <td><label class="chkWrap"><input type="checkbox" name="pid" value="'.$row['aa_pid'].'"><i></i></label></td>';
            echo '  <td>'.dateFormat('Y-m-d', $row['request_date']).'</td>';
            echo '  <td>'.$row['ma_code'].'</td>';
            echo '  <td>'.$row['cs_manager_name'].'</td>';
            echo '  <td>'.$row['ma_cut_name'].'</td>';
            echo '  <td>'.$row['ma_cut_tel'].'</td>';
            echo '  <td>구매처</td>';
            echo '  <td>'.$setting['code']['AsKind'][$row['ma_kind']]['cd_name'].'</td>';
            echo '  <td>'.$row['ma_is_hurryup'].'</td>';

            echo '  <td>'.$fix_codes->AsState[$row['aa_state']].'</td>';
            echo '  <td>'.$fix_codes->AsResultState[$row['aa_result_state']].'</td>';
            echo '  <td>'.$row['as_manager_name'].'</td>';
            echo '  <td>'.($row['aa_visit_date']?$row['aa_visit_date'].' '.$row['aa_visit_time']:'').'</td>';
            echo '  <td><button type="button" class="small bt_sblue" onclick="as_view(\''.$row['ma_pid'].'\');">보기</button></td>';
            echo '  <td>'.dateFormat('Y-m-d', $row['aa_result_date']).'</td>';
            echo '  <td class="txal">'.$row['mc_contents'].'</td>';
            echo '  <td class="txal">취소/미처리 사유</td>';
            echo '  <td class="txal">'.$row['product_name'].'</td>';
            echo '  <td>'.$setting['code']['AsPart'][$row['ma_part']]['cd_name'].'</td>';
            echo '  <td>'.$setting['code']['AsSymptom'][$row['ma_symptom']]['cd_name'].'</td>';
        }
    }
    else echo '<tr><td colspan="29">내역이 존재하지 않습니다.</td></tr>';
?>
    </tbody>
</table>