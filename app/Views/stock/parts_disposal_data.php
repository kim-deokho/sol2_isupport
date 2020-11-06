
<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th class="mWt50"><label class="chkWrap"><input type="checkbox" name="" value="" /><i></i></label></th>
			<th>폐기일</th>
			<th>처리자</th>
			<th>AS접수번호</th>
			<th>창고</th>
			<th>카테고리</th>
			<th class="mWt200">부품</th>
			<th>수량</th>
			<th>사유</th>
			<th class="mWt200">비고</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {
		$tmp = "";

        foreach($rows as $row) {

			if($row["rowcnt"] > 1){
				$rowspan = 'rowspan="'.$row['rowcnt'].'"';
			} else {
				$rowspan = "";
			}

			if($row['pi_state'] == 'A') {
				$disabled = "";
			} else {
				$disabled = "disabled";
			}


            echo '<tr>';

            echo '  <td '.$rowspan.'>'.$num--.'</td>';
			echo '	<td '.$rowspan.'><label class="chkWrap"><input type="checkbox" name="ds_pid[]" class="pi_check" value="'.$row['ds_pid'].'" '.$disabled.' /><i></i></label></td>';
			echo '  <td '.$rowspan.'>'.substr($row['reg_date'],0,10).'</td>';
			echo '  <td '.$rowspan.'>'.$setting['manager'][$row['reg_id']]['mn_name'].'</td>';
			echo '  <td '.$rowspan.'>'.$row['as'].'</td>';
            echo '  <td '.$rowspan.'>'.$setting['code']['pi_state'][$row['pi_state']].'</td>';


			$i = 1;
			foreach($itemlist[$row['pi_pid']] as $row2) {
				if($i != 1) {
					echo '<tr>';
				}

            echo '  <td>'.$pt_data[$row2['pt_pid']]['pt_code'].'</td>';
            echo '  <td class="txal">'.$row2['pt_name'].'</td>';
			echo '  <td>'.$row2['di_qea'].'</td>';
			if($i == 1) {
			echo '  <td '.$rowspan.'>'.$row['pi_memo'].'</td>';
			}
				if($i != count($itemList[$row['pi_pid']])) {
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
