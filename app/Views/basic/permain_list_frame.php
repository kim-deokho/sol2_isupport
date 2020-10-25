<table class="ltable_1 t_effect_1">
    <thead>
        <tr>
            <th>코드</th>
            <th class="mWt40p">권한명</th>
            <th>사용유무</th>
            <th>수정</th>
        </tr>
    </thead>
    <tbody>
<?
    if(count($rows)>0) {
        foreach($rows as $row) {
?>
            <tr onclick="listPermitionSub('<?=$row['bn_pid']?>', '<?=$row['bn_name']?>')">
                <td><?=getSerial($row['bn_pid'], 3)?></td>
                <td><?=$row['bn_name']?></td>
                <td><?=$row['bn_use']?></td>
                <td><button type="button" class="small set_button" onclick="popPermitionForm(event, '<?=$row['bn_pid']?>');">수정</button></td>
            </tr>
<?            
        }
    }
    else echo '<tr><td colspan=10 class="txac">등록된 내용이 없습니다.</td></tr>';
?>        									    
                            
    </tbody>
</table>