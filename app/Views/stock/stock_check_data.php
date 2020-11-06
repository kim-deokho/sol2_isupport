<table class="ltable_1 t_effect_1" id="">
	<thead>
		<tr>
			<th class="mWt50">No.</th>
			<th>실사일</th>
			<th>실사번호</th>
			<th>창고</th>
			<th>상품카테고리</th>
			<th>부품카테고리</th>
			<th class="mWt300">비고</th>
			<th>실사자</th>
			<th>등록자</th>
		</tr>
	</thead>
	<tbody id="">
<?
    if($totCnt>0) {


        foreach($rows as $row) {
            echo '<tr onclick="view_item(\''.$row['sr_pid'].'\')">';
            echo '  <td >'.$num--.'</td>';
            echo '  <td >'.$row['sr_date'].'</td>';
            echo '  <td >'.$row['sr_num'].'</td>';
            echo '  <td >'.$setting["code"]["Storage"][$row['sr_store']]["cd_name"].'</td>';
			echo '  <td >'.$row['sr_pd_cate'] .'</td>';
            echo '  <td >'.$row['sr_pt_cate'] .'</td>';
			echo '  <td >'.$row['sr_memo'].'</td>';
			echo '  <td >'.$row['sr_mn_pid'].'</td>';
            echo '  <td >'.$row['reg_id'].'</td>';
			echo '</tr>';
        }
    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

	</tbody>
</table>