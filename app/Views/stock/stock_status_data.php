<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>창고</th>
			<th>거래처</th>
			<th class="mWt300">제품명</th>
			<th>현재고</th>
			<th>출고대기</th>
			<th>가용재고</th>
			<th>입고합계</th>
			<th>출고합계</th>
			<th>조정</th>
			<th>폐기</th>
			<th>등록일</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {
		$tmp = "";

        foreach($rows as $row) {
            echo '<tr>';
            echo '  <td >'.$num--.'</td>';
            echo '  <td >'.$setting["code"]["Storage"][$row['st_store']]["cd_name"].'</td>';
            echo '  <td >'.$row['ct_name'].'</td>';
            echo '  <td >'.$row['pd_name'].'</td>';
			echo '  <td >'.number_format($row['st_qea']).'</td>';
            echo '  <td >'.number_format($row['odsum']).'</td>';
			echo '  <td >'.number_format($row['st_qea']-$row['odsum']).'</td>';
			echo '  <td >'.number_format($row['insum']).'</td>';
            echo '  <td >'.number_format($row['outsum']).'</td>';
            echo '  <td >'.number_format($row['ajtsum']).'</td>';
            echo '  <td >'.number_format($row['disum']).'</td>';
			echo '  <td >'.substr($row['reg_date'],0,10).'</td>';

            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

	</tbody>
</table>
