<table class="ltable_1 t_effect_1" id="">
				<thead>
					<tr>

						<th>수취인</th>
						<th>연락처1</th>
						<th>연락처2</th>
						<th>우편번호</th>
						<th class="mWt250">주소1</th>
						<th class="mWt200">주소2</th>
						<?if($order == 'Y'){?><th>적용</th><?}?>
						<th>기본배송지</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="">
<?
    if(count($rows)>0) {
		foreach($rows as $row) {
			echo '<tr onclick="view_dely(\''.$row['dy_pid'].'\',\''.$row['dy_name'].'\',\''.$row['dy_tel1'].'\',\''.$row['dy_tel2'].'\',\''.$row['dy_post'].'\',\''.$row['dy_addr'].'\',\''.$row['dy_addr2'].'\')">';
			echo '  <td>'.$row['dy_name'].'</td>';
			echo '  <td>'.$row['dy_tel1'].'</td>';
			echo '  <td>'.$row['dy_tel2'].'</td>';
			echo '  <td>'.$row['dy_post'].'</td>';
			echo '  <td>'.$row['dy_addr'].'</td>';
			echo '  <td>'.$row['dy_addr2'].'</td>';
			if($order == 'Y') echo '	<td><button type="button" class="small bt_gray" onclick="">적용</button></td>';
			echo '  <td><label class="radioWrap"><input type="radio" name="dy_basic[]" value="'.$row['dy_pid'].'" onclick="confirmBox(\'해당주소를 기본배송지로 설정하시겠습니까?\', basic_dely, \''.$row['dy_pid'].'\')" '.($row['dy_basic'] == 'Y' ? 'checked':'').'/><i></i></label></td>';
			echo '  <td><button type="button" class="bt_red" onclick="del_dely(\''.$row['dy_pid'].'\')">삭제</button></td>';
			echo '</tr>';
		}

    }
    else echo '<tr><td colspan="20">내역이 존재하지 않습니다.</td></tr>';
?>

				</tbody>
			</table>