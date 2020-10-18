<div class="popUp">
    <div class="popHeader">개별권한</div>
    <div class="popBody">
        <form name="psFrm" id="psFrm" method="post" target="hiddenFrame" onsubmit="gcUtil.loader()" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_addper_manager">
        <input type="hidden" name="mn_pid" id="mn_pid" value="<?=$mn_pid?>">
        <div class="buttonRight mb10 pos_rel">
            <div id="res_per_name"><?=$manager['mn_name']?></div>
            <button type="submit" class="bt_black js-save-btn">저장</button>
        </div>
        <table class="ltable_1">
            <thead>
                <tr>
                    <th>대메뉴</th>
                    <th>소메뉴</th>
                    <th class="mWt60"><label class="chkWrap"><input type="checkbox" class="allCheck" data-check="chk_access" /><i></i>접근</label></th>
                    <th class="mWt60"><label class="chkWrap"><input type="checkbox" class="allCheck" data-check="chk_save" /><i></i>저장</label></th>
                    <th class="mWt60"><label class="chkWrap"><input type="checkbox" class="allCheck" data-check="chk_del" /><i></i>삭제</label></th>
                    <th class="mWt60"><label class="chkWrap"><input type="checkbox" class="allCheck" data-check="chk_print" /><i></i>출력</label></th>
                    <th class="mWt60"><label class="chkWrap"><input type="checkbox" class="allCheck" data-check="chk_excel" /><i></i>엑셀</label></th>
                </tr>
            </thead>
            <tbody>
<?
            foreach($menuRows as $m_row) {
?>
                <tr>
                    <td rowspan=<?=count($m_row['sub'])?>><?=$m_row['menu_name']?></td>
<?
                foreach($m_row['sub'] as $n=>$s_row) {
                    if($n>0) echo '<tr>';
                    // 권한 
                    $permition=$pRows[$s_row['pid']];
                    $chk_access = $permition['access']=='Y' ? 'checked' : '';
                    $chk_save = $permition['save']=='Y' ? 'checked' : '';
                    $chk_del = $permition['del']=='Y' ? 'checked' : '';
                    $chk_print = $permition['print']=='Y' ? 'checked' : '';
                    $chk_excel = $permition['excel']=='Y' ? 'checked' : '';
?>            
                    <td class="txal">
                        <div class="dis_inb mWt100"><label class="chkWrap"><input type="checkbox" class="lineCheck" data-line="line_<?=$s_row['pid']?>" id="_id_<?=$s_row['pid']?>" /><i></i></label></div>
                        <div class="dis_inb"><label for="_id_<?=$s_row['pid']?>"><?=$s_row['menu_name']?></label></div>
                    </td>
                    <td><label class="chkWrap"><input type="checkbox" name="Per[<?=$s_row['pid']?>][access]" value="<?=$permition['aa_pid']?>" <?=$chk_access?> class="line_<?=$s_row['pid']?> chk_access" /><i></i></label></td>
                    <td><label class="chkWrap"><input type="checkbox" name="Per[<?=$s_row['pid']?>][save]" value="<?=$permition['aa_pid']?>" <?=$chk_save?> class="line_<?=$s_row['pid']?> chk_save" /><i></i></label></td>
                    <td><label class="chkWrap"><input type="checkbox" name="Per[<?=$s_row['pid']?>][del]" value="<?=$permition['aa_pid']?>" <?=$chk_del?> class="line_<?=$s_row['pid']?> chk_del" /><i></i></label></td>
                    <td><label class="chkWrap"><input type="checkbox" name="Per[<?=$s_row['pid']?>][print]" value="<?=$permition['aa_pid']?>" <?=$chk_print?> class="line_<?=$s_row['pid']?> chk_print" /><i></i></label></td>
                    <td><label class="chkWrap"><input type="checkbox" name="Per[<?=$s_row['pid']?>][excel]" value="<?=$permition['aa_pid']?>" <?=$chk_excel?> class="line_<?=$s_row['pid']?> chk_excel" /><i></i></label></td>
<?
                    if($n<count($m_row['sub'])-1) echo '</tr>';
                }      
            }
?>        									    
                            
            </tbody>
        </table>
        </form>
    </div>
</div>