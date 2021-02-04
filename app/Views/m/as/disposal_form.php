<section>
    <form name="aFrm" id="aFrm" method="post" enctype="multipart/form-data" action="/m/aservice/reg_disposal_part" target="hiddenFrame">
    <input type="hidden" name="aa_pid" value="<?=$aa_pid?>">
    <input type="hidden" name="return_url" value="<?=$return_url?>">
    <div class="contents"> 
        <div class="table_wrap">
        <table class="itable_1">
            <tbody>
                <tr>
                    <th>폐기일</th>
                    <td>
                        <input type="text" name="ds_date" class="date mWt100" value="<?=date('Y-m-d')?>" required/>
                    </td>                                
                </tr>
                <tr>
                    <th>AS접수번호</th>
                    <td>
<?
                    if($row['ma_code']) echo $row['ma_code'];
                    else echo '<input type="text" name="ma_code" class="" value=""/>';
?>                        
                    </td>                
                </tr>
                <tr>
                    <th>부품검색</th>
                    <td>
                        <div>
                            <select name="cate1" id="cate1" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
                                <option value="">1차카테고리</option>
<?                              foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
                            </select>
                            <select name="cate2" id="cate2" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 2, 'promotion')">
                                <option value="">2차카테고리</option>
                            </select>
                        </div>

                        <div>
                            <select class="js-single-selector" name="select_part" id="select_part" class="bt2r" style="width:100%;" onchange="setPart(this.value)">
                                <option value="">선택</option>
<?                      
                                foreach($partRows as $p_row) {
                                    $p_value=$p_row['pt_pid'].':'.addslashes($p_row['pt_name']);
                                    echo '<option value="'.$p_value.'">'.$p_row['pt_name'].'</option>';
                                }
?>
                            </select>
                        </div>
                    </td>                                
                </tr>
                <tr>
                    <th>폐기부품</th>
                    <td>
                        <div id="select_part_list">
<?
                        if($assignPartList) {
                            foreach($assignPartList as $ap_row) {
                                $partHtml='<div id="_id_part_'.$ap_row['pt_pid'].'">';
                                $partHtml.='    <div class="fw6">'.$ap_row['aa_part_name'].'</div>';
                                $partHtml.='    <div>';
                                $partHtml.='        수량: <select name="part[qty]['.$ap_row['pt_pid'].']" class="part_qty_list wAuto" onchange="calcPartPay()">';
                                for($i=1; $i<=10; $i++) $partHtml.='<option value="'.$i.'" '.($i==$ap_row['aa_qty']?'selected':'').'>'.$i.'</option>';
                                $partHtml.='        </select>';
                                $partHtml.='        창고: <select name="part[store]['.$ap_row['pt_pid'].']" class="part_store_list wAuto">';
                                foreach($setting['code']['Storage'] as $info) $partHtml.='<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';
                                $partHtml.='        </select>';
                                $partHtml.='        사유: <select name="part[reason]['.$ap_row['pt_pid'].']" class="part_reason_list wAuto">';
                                foreach($fix_codes->disposalReasonCode as $k=>$v) $partHtml.='<option value="'.$k.'">'.$v.'</option>';
                                $partHtml.='        </select>';
                                $partHtml.='        <button type="button" class="bt_pd bt_black" onclick="delPart(\''.$ap_row['pt_pid'].'\')">X</button>';
                                $partHtml.='    </div>';
                                $partHtml.='    <input type="hidden" class="part_id_list" value="'.$ap_row['pt_pid'].'">';
                                $partHtml.='    <input type="hidden" class="part_name_list" name="part[name]['.$ap_row['pt_pid'].']" value="'.$ap_row['aa_part_name'].'">';
                                $partHtml.='</div>';
                                echo $partHtml;
                            }
                        }
?>                            
                        </div>
                    </td>                                
                </tr>
                <tr>
                    <th>비고</th>
                    <td>
                        <textarea name="ds_memo"></textarea>
                    </td>                                
                </tr>                                                      						
            </tbody>
        </table> <!-- itable_1 -->   
                
        </div> <!-- table_Wrap -->
        <div class="buttonCenter">
            <button type="button" class="bt_100_32 bt_gray" onclick="history.back()">목록</button>
            <button class="bt_100_32 bt_dark ml5">저장</button>
        </div>
    </div>
    </form>
</section>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script>
$(document).ready(function() {
    $('.js-single-selector').select2();
});
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.itemJS = <?=json_encode($partRows)?>;
cateCtr.item_selector='select_part';
var Stores = <?=json_encode($setting['code']['Storage'])?>;
var disposalReasonCode = <?=json_encode($fix_codes->disposalReasonCode)?>;
function setPart(val) {
    if(!val) return false;
    let is_exists=false;
    // console.log($('.part_id_list').html());
    $('.part_id_list').each(function(){
        let exp_pid=val.split(':');
        let pid = exp_pid[0];
        console.log(val, pid, $(this).val());

        if(pid!=$(this).val()) return true;
        is_exists=true;
        return false;
    });

    if(is_exists) {
        alertBox("이미 선택한 부품입니다.");
        return false;
    }
    let exp_val=val.split(':');
    let pt_pid = exp_val[0];
    let pt_name = exp_val[1];

    let partHtml='<div id="_id_part_'+pt_pid+'">';
    partHtml+='    <div class="fw6">'+pt_name+'</div>';
    partHtml+='    <div>';
    partHtml+='        수량: <select name="part[qty]['+pt_pid+']" class="part_qty_list wAuto" onchange="calcPartPay()">';
    for(var i=1; i<=10; i++) partHtml+='<option value="'+i+'">'+i+'</option>';
    partHtml+='        </select>';
    partHtml+='        창고: <select name="part[store]['+pt_pid+']" class="part_store_list wAuto">';
    for(let i in Stores) partHtml+='<option value="'+Stores[i]['cd_pid']+'">'+Stores[i]['cd_name']+'</option>';
    partHtml+='        </select>';
    partHtml+='        사유: <select name="part[reason]['+pt_pid+']" class="part_reason_list wAuto">';
    for(let k in disposalReasonCode) partHtml+='<option value="'+k+'">'+disposalReasonCode[k]+'</option>';
    partHtml+='        </select>';
    partHtml+='        <button type="button" class="bt_pd bt_black" onclick="delPart(\''+pt_pid+'\')">X</button>';
    partHtml+='    </div>';
    partHtml+='    <input type="hidden" class="part_id_list" value="'+pt_pid+'">';
    partHtml+='    <input type="hidden" class="part_name_list" name="part[name]['+pt_pid+']" value="'+pt_name+'">';
    partHtml+='</div>';
    $('#select_part_list').prepend(partHtml);
}

function delPart(pt_pid) {
    $('#_id_part_'+pt_pid).remove();
}
</script>