<table class="ltable_1 t_effect_1">
	<thead>
		<th class="mWt50">No.</th>
		<th >거래처</th>
		<th >구분</th>
		<th >카테고리</th>
		<th >상품코드</th>
		<th >상품</th>
		<th >실사재고</th>
		<th >현재고</th>
		<th >차이수량</th>
	</thead>
	<tbody >
<?
    if($totCnt>0) {
		$tmp = "";

        foreach($rows as $row) {
			if($row['st_kind'] == 'A') {
				$kind = '상품';
				$c1 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],0,3);
				$c2 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],3,3);
				$c3 = substr($pd_data[$row['pd_pid']]['pd_pc_code'],6,3);

				if($c3 != '000') {

					$category = $pd_cate[$c1][$c2][$c3]['name'];
				} else if($c2 != '000') {

					$category = $pd_cate[$c1][$c2]['name'];
				} else {
					$category = $pd_cate[$c1]['name'];
				}
				$code = $pd_data[$row['pd_pid']]['pd_code'];
				$name = $pd_data[$row['pd_pid']]['pd_name'];
			} else {
				$kind = '부품';
				$c1 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],0,3);
				$c2 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],3,3);
				$c3 = substr($pd_data[$row['pd_pid']]['pt_pc_code'],6,3);
				if($c3 != '000') {
					$category = $pt_cate[$c1][$c2][$c3]['name'];
				} else if($c2 != '000') {
					$category = $pt_cate[$c1][$c2]['name'];
				} else {
					$category = $pt_cate[$c1]['name'];
				}
				$code = $pt_data[$row['pd_pid']]['pt_code'];
				$name = $pt_data[$row['pd_pid']]['pt_name'];
			}
            echo '<tr >';
            echo '  <td '.$rowspan.'>'.$num--.'</td>';
            echo '  <td '.$rowspan.'>'.$customer[$ct_pid]['ct_name'].'</td>';
			echo '  <td '.$rowspan.'>'.$kind.'</td>';
            echo '  <td '.$rowspan.'>'.$category.'</td>';
            echo '  <td '.$rowspan.'>'.$code.'</td>';
			echo '  <td '.$rowspan.'>'.$name.'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['si_qea']).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['st_qea']).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['si_qea'] - $row['st_qea']).'</td>';


			echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

	</tbody>
</table>