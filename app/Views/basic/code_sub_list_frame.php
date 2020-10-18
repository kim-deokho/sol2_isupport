<table class="ltable_1" id="table_sub_code">
    <thead>
        <tr>
            <th>순번</th>
            <th>코드번호</th>
            <th class="mWt40p">코드명</th>
            <th>사용유무</th>
            <th>관리</th>
        </tr>
    </thead>
    <tbody>                
<?
    if(count($rows)>0) {
        $num=1;
        foreach($rows as $row) {
?>                                
        <tr class="sub_code_rows" id="<?=$row['cd_pid']?>">
            <td id="_id_order_<?=$row['cd_pid']?>"><?=$num++?></td>
            <td><?=$row['cd_code']?></td>
            <td><?=$row['cd_name']?></td>
            <td><?=$row['cd_use']?></td>
            <td><button type="button" class="small set_button" onclick="popRegCode('<?=$row['cd_pid']?>');">수정</button></td>
        </tr>
<?
        }
    }
    else echo '<td colspan=10 class="txac">등록된 코드가 없습니다.</td>';
?>        
    </tbody>
</table>