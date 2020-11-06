<form name="requestFrm"  id="requestFrm" method="post" action="/stock/execute" target="hiddenFrame">
<input type="hidden" name="mode" id="mode" value="canel_part_request">
<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th class="mWt50"><label class="chkWrap"><input type="checkbox" name="" value="" class="allCheck" data-check="pi_check"/><i></i></label></th>
			<th>요청일</th>
			<th>구분</th>
			<th>상태</th>
			<th>요청자</th>
			<th>부품코드</th>
			<th class="mWt200">부품명</th>
			<th>요청수량</th>
			<th>창고</th>
			<th>처리</th>
			<th>처리일시</th>
			<th>처리수량</th>
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
			echo '	<td '.$rowspan.'><label class="chkWrap"><input type="checkbox" name="pi_pid[]" class="pi_check" value="'.$row['pi_pid'].'" '.$disabled.' /><i></i></label></td>';
			echo '  <td '.$rowspan.'>'.substr($row['reg_date'],0,10).'</td>';
            echo '  <td '.$rowspan.'>'.($row['pi_kind'] == 'A' ? '출고':'반입').'</td>';
            echo '  <td '.$rowspan.'>'.$setting['code']['pi_state'][$row['pi_state']].'</td>';
            echo '  <td '.$rowspan.'>'.$setting['manager'][$row['pi_mn_pid']]['mn_name'].'</td>';

			$i = 1;
			foreach($itemlist[$row['pi_pid']] as $row2) {
				if($i != 1) {
					echo '<tr>';
				}

            echo '  <td>'.$pt_data[$row2['pt_pid']]['pt_code'].'</td>';
            echo '  <td class="txal">'.$row2['pt_name'].'</td>';
			echo '  <td>'.$row2['ii_qea'].'</td>';
            if($i == 1) {
			echo '  <td '.$rowspan.'>'.$setting["code"]["Storage"][$row['pi_store']]["cd_name"].'</td>';
				if($row['pi_confirm_date'] || $row['pi_state'] == 'C') {
					echo '<td></td>';
				} else {
					echo '  <td '.$rowspan.'><button type="button" class="small bt_black" onclick="request_proc(\''.$row['pi_pid'].'\');">요청처리</button></td>';
				}
			echo '  <td>'.$row['pi_confirm_date'].'</td>';
			}
			echo '  <td>'.number_format($row2['ii_real_qea']).'</td>';
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
</form>