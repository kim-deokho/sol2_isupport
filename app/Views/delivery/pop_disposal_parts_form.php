		<div class="table_wrap">
			<table class="itable_1">
				<tbody>
					<tr>
						<th class="mWt80">폐기일</th>
						<td><input type="text" name="ds_date" class="date mWt100" value="<?=$dRow['ds_date']?>"/></td>
						<th class="mWt80">AS 접수번호</th>
						<td><?=$row['ma_code']?></td>
					<tr>
					<tr>
						<th>폐기부품</th>
						<td colspan="3">
							<div class="input_box_type_s mt5">
                                <div>
                                    <select name="cate1" id="cate1" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
                                        <option value="">1차카테고리</option>
<?                                      foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
                                    </select>
                                    <select name="cate2" id="cate2" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 2, 'promotion')">
                                        <option value="">2차카테고리</option>
                                    </select>
                                </div>

                                <div class="mt5">
                                    <select class="js-single-selector" name="select_part" id="select_part" class="bt2r" style="width:100%;" onchange="setPart(this.value)">
                                        <option value="">선택</option>
<?                      
                                        foreach($partRows as $p_row) {
                                            $p_value=$p_row['pt_pid'].':'.addslashes($p_row['pt_name']).':'.$p_row['pt_out_price'].':'.$p_row['pt_wages'];
                                            echo '<option value="'.$p_value.'">'.$p_row['pt_name'].'</option>';
                                        }
?>
                                    </select>
                                </div>
							</div> <!-- input_box_type_s -->

							<div class="table_wrap mt5">
								<table class="ltable_1" id="disposal_part_tb">
									<thead>
										<tr>
											<th class="mWt200">부품명</th>
											<th>수량</th>
											<th>창고</th>
											<th>사유</th>
											<th>삭제</th>
										</tr>
									</thead>
									<tbody id="">
<?
                                    if($dpList) {
                                        foreach($dpList as $dpRow) {
                                            $partHtml='<tr id="_id_part_'.$dpRow['pt_pid'].'">';
                                            $partHtml.='    <td class="txal">'.$dpRow['pt_name'].'</td>';
                                            $partHtml.='    <td><input type="text" name="part[qty]['.$dpRow['pt_pid'].']" class="part_qty_list mWt50 h_20 txac" value="'.$dpRow['di_qty'].'" /></td>';
                                            $partHtml.='    <td class="txal"><select name="part[store]['.$dpRow['pt_pid'].']" class="part_store_list wAuto">';
                                            foreach($setting['code']['Storage'] as $info) $partHtml.='<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$dpRow['di_store']?'selected':'').'>'.$info['cd_name'].'</option>';
                                            $partHtml.='        </select></td>';
                                            $partHtml.='        <td><select name="part[reason]['.$dpRow['pt_pid'].']" class="part_reason_list wAuto">';
                                            foreach($fix_codes->disposalReasonCode as $k=>$t) $partHtml.='<option value="'.$k.'" '.($k==$row['di_reason_code']?'selected':'').'>'.$t.'</option>';
                                            $partHtml.='        </select></td>';
                                            $partHtml.='        <td><button type="button" class="small bt_red" onclick="delPart(\''.$dpRow['pt_pid'].'\', \''.$dpRow['di_pid'].'\')">삭제</button></td>';
                                            $partHtml.='    <input type="hidden" class="part_pid_list" name="part[pid]['.$dpRow['pt_pid'].']" value="'.$dpRow['di_pid'].'">';
                                            $partHtml.='    <input type="hidden" class="part_name_list" name="part[name]['.$dpRow['pt_pid'].']" value="'.$dpRow['pt_name'].'">';
                                            $partHtml.='    <input type="hidden" class="part_id_list" value="'.$dpRow['pt_pid'].'">';
                                            $partHtml.='    </tr>';
                                            echo $partHtml;
                                        }
                                    }
                                    else {
                                        foreach($apList as $apRow) {
                                            $partHtml='<tr id="_id_part_'.$apRow['pt_pid'].'">';
                                            $partHtml.='    <td class="txal">'.$apRow['aa_part_name'].'</td>';
                                            $partHtml.='    <td><input type="text" name="part[qty]['.$apRow['pt_pid'].']" class="part_qty_list mWt50 h_20 txac" value="'.$apRow['aa_qty'].'" /></td>';
                                            $partHtml.='    <td class="txal"><select name="part[store]['.$apRow['pt_pid'].']" class="part_store_list wAuto">';
                                            foreach($setting['code']['Storage'] as $info) $partHtml.='<option value="'.$info['cd_pid'].'">'.$info['cd_name'].'</option>';
                                            $partHtml.='        </select></td>';
                                            $partHtml.='        <td><select name="part[reason]['.$apRow['pt_pid'].']" class="part_reason_list wAuto">';
                                            foreach($fix_codes->disposalReasonCode as $k=>$t) $partHtml.='<option value="'.$k.'">'.$t.'</option>';
                                            $partHtml.='        </select></td>';
                                            $partHtml.='        <td><button type="button" class="small bt_red" onclick="delPart(\''.$apRow['pt_pid'].'\')">삭제</button></td>';
                                            $partHtml.='    <input type="hidden" class="part_name_list" name="part[name]['.$apRow['pt_pid'].']" value="'.$apRow['pt_name'].'">';
                                            $partHtml.='    <input type="hidden" class="part_id_list" value="'.$apRow['pt_pid'].'">';
                                            $partHtml.='    </tr>';
                                            echo $partHtml;
                                        }
                                    }
?>
									</tbody>
								</table>
							</div> <!-- table_wrap -->                                   
						</td>								
					</tr>
					<tr>
						<th>비고</th>
						<td colspan="3"><textarea name="ds_memo" class="txa_base"><?=$dRow['ds_memo']?></textarea></td>
					</tr>                            						
				</tbody>
			</table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->

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
    let pt_price = exp_val[2];
    let pt_wages = exp_val[3];

    let partHtml='<tr id="_id_part_'+pt_pid+'">';
    partHtml+='    <td>'+pt_name+'</td>';
    partHtml+='    <td><input type="text" name="part[qty]['+pt_pid+']" class="mWt50 h_20 txac part_qty_list" value="1" onkeyup="calcPartPay()" /></td>';
    partHtml+='    <td class="txar">'+inputNumberWithComma(pt_price)+'</td>';
    partHtml+='    <td class="txar">'+inputNumberWithComma(pt_wages)+'</td>';
    partHtml+='    <td><button type="button" class="small bt_red" onclick="delPart(\''+pt_pid+'\')">삭제</button></td>';
    partHtml+='    <input type="hidden" class="part_id_list" value="'+pt_pid+'">';
    partHtml+='    <input type="hidden" class="part_name_list" name="part[name]['+pt_pid+']" value="'+pt_name+'">';
    partHtml+='    <input type="hidden" class="part_price_list" name="part[price]['+pt_pid+']" value="'+pt_price+'">';
    partHtml+='    <input type="hidden" class="part_wages_list" name="part[wages]['+pt_pid+']" value="'+pt_wages+'">';
    partHtml+='</tr>';
    $('#disposal_part_tb tbody').prepend(partHtml);
}

function delPart(pt_pid, di_pid) {
    var di_pid = di_pid || '';
    $('#_id_part_'+pt_pid).remove();
    if(di_pid) {
        $.ajax({
            url : '/delivery/ajax_request',
            data : {mode:'delete_disposal_part', di_pid:di_pid},
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(res) {
                if(res!='ok') alertBox('삭제 오류!');
            }
            ,error: function() {
                alertBox('Error');
            }
        });
    }
}
</script>
        