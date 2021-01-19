<?
if(count($rows)>0) {
    foreach($rows as $row) {
        echo '<tr>';
        echo '    <td>'.$row['mn_name'].'</td>';
        echo '    <td>'.number_format($row['reserve_cnt']).'</td>';
        echo '    <td>'.number_format($row['ing_cnt']+$row['end_cnt']).'/'.number_format($row['end_cnt']).'</td>';
        echo '    <td><label class="radioWrap"><input type="radio" name="as_manager[]" value="'.$row['mn_pid'].'" '.($asRow['mn_pid']==$row['mn_pid']?'checked':'').' /><i></i></label></td>';
        echo '</tr>';
    }
}
else echo '<tr><td colspan="5">등록된 AS기사가 존재하지 않습니다.</td></tr>';
?>