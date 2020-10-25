<table class="ltable_1" id="tb_bom_list">
    <thead>
        <tr>									
            <th class="mWt50">No.</th>													
            <th>상품코드</th>
            <th>상품명</th>
            <th class="mWt80">수량</th>
            <th>입고가</th>
            <th>정상가</th>
            <th class="mWt100">삭제</th>
        </tr>
    </thead>
    <tbody>
<?
    $tot=count($rows);
    foreach($rows as $i=>$row) {
?>
        <tr id="tr_<?=$i?>">
            <td><?=$i+1?></td>
            <td><?=$row['pd_code']?></td>
            <td><?=$row['pd_name']?></td>
            <td><input type="text" name="Data[cnt][]" class="mWt60 h_20 txar bom_products input-comma" data-pid="<?=$row['pb_pd_pid']?>" onkeyup="inputNumberAutoComma(this)" value="<?=number_format($row['pb_cnt'])?>" <?=$IsDiabled?'readonly':''?> /></td>													
            <td><?=number_format($row['pd_in_price'])?></td>
            <td><input type="text" name="Data[price][]" onkeyup="inputNumberAutoComma(this)" class="mWt100 h_20 txar input-comma" value="<?=number_format($row['pb_out_price'])?>" <?=$IsDiabled?'readonly':''?> /></td>													
            <td><button type="button" class="small bt_red js-del-btn <?=$IsDiabled?'d_none':''?>" onclick="delBomData('<?=$i?>')">삭제</button></td>
            <input type="hidden" name="Data[pd_pid][]" value="<?=$row['pb_pd_pid']?>">
            <input type="hidden" name="Data[pb_pid][]" value="<?=$row['pb_pid']?>">
        </tr>
        
<?
    }
    echo '<tr id="tr_no_data" class="'.(count($rows)>0?'d_none':'').'"><td colspan="10" class="no_data">등록된 상품이 없습니다.</td></tr>';
?>    
        
    </tbody>
</table>