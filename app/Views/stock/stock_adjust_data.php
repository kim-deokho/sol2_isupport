
<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>등록일</th>
			<th>창고</th>
			<th>구분</th>
			<th>상품코드</th>
			<th class="mWt200">제품명</th>
			<th>조정전</th>
			<th>조정후</th>
			<th>조정수량</th>
			<th>등록자</th>
			<th>유형</th>
			<th class="mWt200">비고</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {
		$tmp = "";

        foreach($rows as $row) {
			if($row['sa_p_kind'] == 'A') {
				$kind = '상품';
				$category = $pd_data[$row['pd_pid']]['pd_pc_code'];
				$code = $pd_data[$row['pd_pid']]['pd_code'];
				$name = $pd_data[$row['pd_pid']]['pd_name'];
			} else {
				$kind = '부품';
				$category = $pt_data[$row['pd_pid']]['pt_tc_code'];
				$code = $pt_data[$row['pd_pid']]['pt_code'];
				$name = $pt_data[$row['pd_pid']]['pt_name'];
			}
            echo '<tr >';
            echo '  <td '.$rowspan.'>'.$num--.'</td>';
            echo '  <td '.$rowspan.'>'.substr($row['reg_date'],0,10).'</td>';
			echo '  <td '.$rowspan.'>'.$setting["code"]["Storage"][$row['sa_store']]["cd_name"].'</td>';
			echo '  <td '.$rowspan.'>'.$kind.'</td>';
            echo '  <td '.$rowspan.'>'.$code.'</td>';
			echo '  <td '.$rowspan.'>'.$name.'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['st_qea']).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['sa_qea']).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['sa_qea'] - $row['st_qea']).'</td>';
			echo '  <td '.$rowspan.'>'.($row['reg_id']).'</td>';
			echo '  <td '.$rowspan.'>'.$setting["code"]["sa_kind"][$row['sa_kind']].'</td>';
			echo '  <td '.$rowspan.'>'.($row['sa_memo']).'</td>';


			echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

	</tbody>
</table>
