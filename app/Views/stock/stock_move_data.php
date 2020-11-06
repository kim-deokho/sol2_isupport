<table class="ltable_1 t_effect_1" id="" style="width:150%">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>등록일</th>
			<th>이동번호</th>
			<th>보낸창고</th>
			<th>받는창고</th>
			<th>거래처</th>
			<th>구분</th>
			<th class="mWt250">제품명</th>
			<th>이동수량</th>
			<th>등록자</th>
			<th class="mWt300">비고</th>
			<th class="mWt200">보낸창고승인</th>
			<th class="mWt200">받는창고승인</th>
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
			if($row['sm_out_mn_pid'] ||$row['sm_in_mn_pid']) {
				$link = '';
			} else {
				$link = 'onclick="move_reg(\''.$row['sm_num'].'\', \''.$row['sm_out_store'].'\', \''.$row['sm_in_store'].'\', \''.substr($row['reg_date'],0,10).'\')"';
			}
            echo '<tr '.$link.'>';
            echo '  <td '.$rowspan.'>'.$num--.'</td>';
            echo '  <td '.$rowspan.'>'.substr($row['reg_date'],0,10).'</td>';
			echo '  <td '.$rowspan.'>'.$row['sm_num'].'</td>';
            echo '  <td '.$rowspan.'>'.$setting["code"]["Storage"][$row['sm_out_store']]["cd_name"].'</td>';
            echo '  <td '.$rowspan.'>'.$setting["code"]["Storage"][$row['sm_in_store']]["cd_name"].'</td>';

			foreach($itemlist[$row['sm_num']] as $row2) {
				if($i != 1) {
					echo '<tr '.$link.'>';
				}
				echo '  <td >'.$row['ct_name'].'</td>';
				echo '  <td >'.$row2['kind_name'].'</td>';
				echo '  <td >'.$row2['sm_pd_name'].'</td>';
				echo '  <td >'.number_format($row2['sm_qea']).'</td>';
				echo '  <td >'.$row2['reg_name'].'</td>';
				echo '  <td >'.$row2['sm_memo'].'</td>';
				if($i == 1) {
					if($row2['sm_out_mn_pid']) {
						echo '  <td '.$rowspan.'>'.$row2['sm_out_date'].'</td>';
					} else {
						echo '<td '.$rowspan.' onclick="event.cancelBubble=true;"><button type="button" class="small set_button" onclick="confirmBox(\'보내는 창고 승인 하시겠습니까?\', move_confrim, \'B,'.$row['sm_num'].'\')">승인</button></td>';
					}
					if($row2['sm_in_mn_pid']) {
						echo '  <td '.$rowspan.'>'.$row2['sm_in_date'].'</td>';
					} else {
						echo '<td '.$rowspan.' onclick="event.cancelBubble=true;"><button type="button" class="small set_button" onclick="confirmBox(\'받는 창고 승인 하시겠습니까?\', move_confrim, \'A,'.$row['sm_num'].'\')">승인</button></td>';
					}
				}
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