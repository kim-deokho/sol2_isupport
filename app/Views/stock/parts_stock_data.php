
<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>창고</th>
			<th>매입처</th>
			<th>카테고리</th>
			<th class="mWt300">부품명</th>
			<th>부품가</th>
			<th>공임비</th>
			<th>현재고</th>
			<th>폐기재고</th>
			<th>기사출고</th>
			<th>기사반입</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {
		$tmp = "";

        foreach($rows as $row) {


			$category = $pt_cate[$row['pt_tc_pid1']]['tc_name'];
			if($row['pt_tc_pid2']) {
				$category .= " > ".$pt_cate[$row['pt_tc_pid2']]['tc_name'];
			}


            echo '<tr >';
            echo '  <td '.$rowspan.'>'.$num--.'</td>';
			echo '  <td '.$rowspan.'>'.$setting["code"]["Storage"][$row['st_store']]["cd_name"].'</td>';
			echo '  <td '.$rowspan.'>'.$row['ct_name'].'</td>';
            echo '  <td '.$rowspan.'>'.$category.'</td>';
			echo '  <td '.$rowspan.'>'.$row['pt_name'].'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['pt_out_price']).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['pt_wages']).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['st_qea'] ).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['disum'] ).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['disum'] ).'</td>';
			echo '  <td '.$rowspan.'>'.number_format($row['disum'] ).'</td>';


			echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>
	</tbody>
</table>
