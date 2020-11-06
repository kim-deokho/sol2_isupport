<table class="ltable_1 t_effect_1" id="" style="width:150%">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>발주일</th>
			<th>발주번호</th>
			<th>상태</th>
			<th>발주처</th>
			<th>총발주금액</th>
			<th>발주서</th>
			<th>발주자</th>
			<th class="mWt150">비고</th>
			<th>상세발주번호</th>
			<th class="mWt250">상품</th>
			<th>구분</th>
			<th>입고가</th>
			<th>실입고가</th>
			<th>발주수량</th>
			<th>발주금액</th>
			<th>입고수량</th>
			<th>잔여수량</th>
			<th>발주취소</th>
			<th>취소수량</th>
			<th class="mWt200">취소비고</th>
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



            echo '<tr onclick="purchase_reg(\''.$row['io_pid'].'\')">';

            echo '  <td '.$rowspan.'>'.$num--.'</td>';
            echo '  <td '.$rowspan.'>'.$row['io_date'].'</td>';
            echo '  <td '.$rowspan.'>'.$row['io_num'].'</td>';
            echo '  <td '.$rowspan.'>'.$state[$row['io_state']].'</td>';
            echo '  <td '.$rowspan.'>'.$row['ct_name'].'</td>';
            echo '  <td '.$rowspan.'>'.number_format($row['io_price']).'</td>';
            echo '  <td '.$rowspan.' onclick="event.cancelBubble=true;"><button type="button" class="small bt_sblue">보기</button></td>';
            echo '  <td '.$rowspan.'>'.$row['mn_name'].'</td>';
            echo '  <td '.$rowspan.'>'.$row['io_bigo'].'</td>';
			$i = 1;
			foreach($itemlist[$row['io_pid']] as $row2) {
				if($i != 1) {
					echo '<tr onclick="purchase_reg(\''.$row['io_pid'].'\')">';
				}
				$itmp = explode(",", $row2["inqea"]);
				$iqea = "";
				foreach($itmp as $k=>$v) {
					$itmp2 = explode("|", $v);
					$iqea .= '<a href="javascript:" onclick="view_in('.$itmp[0].')">'.$itmp2[1].'</a><br />';
				}

				$ctmp = explode(",", $row2["canqea"]);
				$cqea = "";
				$cbigo = "";
				foreach($ctmp as $k=>$v) {
					$ctmp2 = explode("|", $v);
					$cqea .= $ctmp2[0].'<br />';
					$cbigo .= $ctmp2[1].'<br />';
				}
            echo '  <td>'.$row2['oi_num'].'</td>';
            echo '  <td>'.$row2['oi_name'].'</td>';
            echo '  <td>'.$row2['kind_name'].'</td>';
            echo '  <td>'.number_format($row2['oi_in_price']).'</td>';
			echo '  <td>'.number_format($row2['oi_real_in_price']).'</td>';
			echo '  <td>'.number_format($row2['oi_qea']).'</td>';
			echo '  <td>'.number_format($row2['oi_real_in_price']*$row2['oi_qea']).'</td>';
			echo '  <td>'.number_format($iqea).'</td>';
			echo '  <td>'.number_format($row2['oi_re_qea']).'</td>';
			echo '	<td onclick="event.cancelBubble=true;"><button type="button" class="small bt_black" onclick="purchase_cancel(\''.$row2['oi_pid'].'\',\''.$row2['pd_pid'].'\',\''.$row2['oi_name'].'\');">취소</button></td>';
			echo '  <td>'.$cqea.'</td>';
			echo '  <td>'.$cbigo.'</td>';
				if($i != count($itemList[$row['io_pid']])) {
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