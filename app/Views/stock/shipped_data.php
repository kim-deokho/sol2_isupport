
<table class="ltable_1 t_effect_1" id="" style="width:150%">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>출고일</th>
			<th>출고번호</th>
			<th>유형</th>
			<th>창고</th>
			<th>거래처</th>
			<th>구분</th>
			<th class="mWt250">상품</th>
			<th>출고수량</th>
			<th>주문번호</th>
			<th>고객코드</th>
			<th>등록자</th>
			<th class="mWt300">비고</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {
		$tmp = "";

        foreach($rows as $row) {
			$i = 1;
			if($row["rowcnt"] > 1){
				$rowspan = 'rowspan="'.$row['rowcnt'].'"';
			} else {
				$rowspan = "";
			}

            echo '<tr onclick="shipped_reg(\''.$row['si_num'].'\', \''.$row['si_store'].'\', \''.$row['si_date'].'\')">';
            echo '  <td '.$rowspan.'>'.$num--.'</td>';
            echo '  <td '.$rowspan.'>'.$row['si_date'].'</td>';
            echo '  <td '.$rowspan.'>'.$row['si_num'].'</td>';
            echo '  <td '.$rowspan.'>'.$state[$row['si_kind2']].'</td>';
			echo '  <td '.$rowspan.'>'.$setting["code"]["Storage"][$row['si_store']]["cd_name"].'</td>';
            foreach($itemlist[$row['si_num']] as $row2) {
				if($i != 1) {
					echo '<tr onclick="shipped_reg(\''.$row['si_num'].'\',  \''.$row['si_store'].'\', \''.$row['si_date'].'\')">';
				}
				echo '  <td >'.$row2['ct_name'].'</td>';
				echo '  <td >'.$row2['kind_name'].'</td>';
				echo '  <td >'.$row2['si_pd_name'].'</td>';
				echo '  <td >'.number_format($row2['si_qea']).'</td>';
				echo '  <td >'.$row2['od_code'].'</td>';
				echo '  <td >'.$row2['mb_pid'].'</td>';
				echo '  <td >'.$row2['reg_name'].'</td>';
				echo '  <td >'.$row2['si_memo'].'</td>';
				if($i != count($itemList[$row['si_num']])) {
					echo '</tr>';
				}
				$i++;

			}
			echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

	</tbody>
</table>


