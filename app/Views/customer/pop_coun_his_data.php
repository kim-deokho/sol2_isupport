<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>상담일시</th>
			<th>인/아웃</th>
			<th>상담종류</th>
			<th class="mWt180">상담내용</th>
			<th>전화</th>
			<th>처리상태</th>
			<th>상담자</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {
        foreach($rows as $row) {

            echo '<tr onclick="view_coun(\''.$row['mc_pid'].'\')">';
            echo '  <td>'.$num--.'</td>';
            echo '  <td>'.$row['reg_date'].'</td>';
            echo '  <td>'.$setting['code']['Counkind1'][$row['mc_kind1']]['cd_name'].'</td>';
            echo '  <td>'.$setting['code']['Counkind2'][$row['mc_kind2']]['cd_name'].'</td>';
            echo '  <td>'.$row['mc_contents'].'</td>';
            echo '  <td>'.$row['mc_tel'].'</td>';
            echo '  <td>'.$setting['code']['Counkind3'][$row['mc_kind3']].'</td>';
            echo '  <td>'.$row['reg_name'].'</td>';
            echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

	</tbody>
</table>