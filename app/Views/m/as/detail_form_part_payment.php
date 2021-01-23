<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th rowspan="2">부품</th>
            <td>
                <div>
                    <select name="cate1" id="cate1" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
                        <option value="">1차카테고리</option>
<?                      foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
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
                            $p_value=$p_row['pt_pid'].':'.addslashes($p_row['pt_name']).':'.$p_row['pt_out_price'].':'.$p_row['pt_wages'];
                            echo '<option value="'.$p_value.'">'.$p_row['pt_name'].'</option>';
                        }
?>
                    </select>
                    <!-- <input type="text" name="" class="bt2r" value="" placeholder="부품명" />
                    <button type="button" class="bt_pd bt_black" onclick="">추가</button> -->
                </div>
            </td>                                
        </tr>
        <tr>
            <td>
                <div id="select_part_list">
<?
                $totAsignPartPrice=0;
                $totAsignPartWages=0;
                foreach($assignPartList as $apRow) {
                    $partHtml='<div id="_id_part_'.$apRow['pt_pid'].'">';
                    $partHtml.='    <div>'.$apRow['aa_part_name'].'</div>';
                    $partHtml.='    <div>';
                    $partHtml.='        ('.number_format($apRow['aa_unit_price']).' / '.number_format($apRow['aa_wages']).')';
                    $partHtml.='        <select name="part[qty]['.$apRow['pt_pid'].']" class="part_qty_list mWt50" onchange="calcPartPay()">';
                    for($i=1; $i<=10; $i++) $partHtml.='<option value="'.$i.'" '.($i==$apRow['aa_qty']?'selected':'').'>'.$i.'</option>';
                    $partHtml.='        </select>';
                    $partHtml.='        <button type="button" class="bt_pd bt_black" onclick="delPart(\''.$apRow['pt_pid'].'\', \''.$apRow['ap_pid'].'\')">X</button>';
                    $partHtml.='    </div>';
                    $partHtml.='    <input type="hidden" class="part_id_list" value="'.$apRow['pt_pid'].'">';
                    $partHtml.='    <input type="hidden" class="part_pid_list" name="part[pid]['.$apRow['pt_pid'].']" value="'.$apRow['ap_pid'].'">';
                    $partHtml.='    <input type="hidden" class="part_name_list" name="part[name]['.$apRow['pt_pid'].']" value="'.$apRow['aa_part_name'].'">';
                    $partHtml.='    <input type="hidden" class="part_price_list" name="part[price]['.$apRow['pt_pid'].']" value="'.$apRow['aa_unit_price'].'">';
                    $partHtml.='    <input type="hidden" class="part_wages_list" name="part[wages]['.$apRow['pt_pid'].']" value="'.$apRow['aa_wages'].'">';
                    $partHtml.='</div>';
                    $totAsignPartPrice += ($apRow['aa_unit_price']*$apRow['aa_qty']);
                    $totAsignPartWages += ($apRow['aa_wages']*$apRow['aa_qty']);
                    echo $partHtml;
                }
?>

                </div>
            </td>                                
        </tr>                                    						
    </tbody>
</table> <!-- itable_1 -->

<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th>사진첨부</th>
            <td>
                <!-- <button type="button" class="bt_pd bt_white_bor" onclick="setFile()">사진첨부</button> -->
                <input name="files[]" type="file" multiple="multiple" id="file_multi" class="with-preview" />
                <ul class="thumb_list">
<?
                if(count($thumbList)>0) {
                    foreach($thumbList as $tRow) {
                        echo '<li id="_id_thumb_'.$tRow['at_pid'].'"><span><img src="'.IMG_DIR.'/btn_del.gif" style="width:auto;" onclick="delThumb(\''.$tRow['at_pid'].'\')"></span><img class="MultiFile-preview" src="'.AWS_UPLOAD_HOST.$tRow['thumb_img'].'"></li>';
                    }
                }
?>                    
                </ul>
            </td>                                
        </tr>
        <tr>
            <th>요금</th>
            <td>
                <div>
                    <select name="aa_pay_kind" id="aa_pay_kind" class="mWt100" onchange="chgPayKind(this.value)">
<?                      foreach(array('P'=>'유상', 'F'=>'무상') as $k=>$v) echo '<option value="'.$k.'" '.($k==$row['aa_pay_kind']?'selected':'').'>'.$v.'</option>';?>
                    </select>
                    <select name="aa_free_year" id="aa_free_year" class="mWt100 hidden">
<?                      for($i=1;$i<=10;$i++) echo '<option value="'.$i.'" '.($i==$row['aa_free_year']?'selected':'').'>'.$i.'년</option>';?>
                    </select>
                </div>

                <div class="table_wrap_l">
                    <table class="ltable_1" id="">
                        <thead>
                            <tr>									
                                <th>부품비</th>
                                <th>공임비</th>
                                <th>출장비</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <tr>
                                <td><span id="calc_out_price"><?=number_format($totAsignPartPrice)?></span></td>
                                <td><span id="calc_wages_price"><?=number_format($totAsignPartWages)?></span></td>
                                <td class="txar"><input type="text" name="aa_travel_price" id="aa_travel_price" class="mWt100 txar input-comma" value="<?=number_format($row['aa_travel_price'])?>" placeholder="0" onkeyup="calcPartPay()" /></td>
                            </tr>
                        </tbody>
                        <tfoot id="">
                            <tr>
                                <td colspan="3" class="fw6 txar">
                                    합계 : 
                                    <input type="text" name="aa_total_price" id="aa_total_price" class="mWt100 txar" value="<?=number_format($row['aa_total_price'])?>" readonly />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div> <!-- table_wrap_l -->
            </td>                                
        </tr>                                 						
    </tbody>
</table> <!-- itable_1 -->

<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th>확인자</th>
            <td>
                <input type="text" name="aa_confirm_name" class="mWt150" value="<?=$row['aa_confirm_name']?>" />
                <select name="aa_confirm_kind" class="wAuto">
<?                  foreach(array('M'=>'본인') as $k=>$v) echo '<option value="'.$k.'" '.($k==$row['aa_confirm_kind']?'selected':'').'>'.$v.'</option>';?>                    
                </select>
            </td>                                
        </tr>
        <tr>
            <th>연락처</th>
            <td>
                <input type="text" name="aa_confirm_tel" class="mWt150" value="<?=$row['aa_confirm_tel']?>" />
            </td>                                
        </tr>
        <tr>
            <th>서명</th>
            <td>
                <div id="signature-pad" class="signature-pad">
                    <div class="signature-pad--body">
                        <canvas class="sign_set"></canvas>
                        <div style="background:url('<?=$row['aa_confirm_sign']?>') no-repeat center;background-size:contain;width:100%;height:90px;" class="sign_img"></div>
                    </div>
                    <div class="signature-pad--footer">
                        <div class="signature-pad--actions">
                            <div>
                                <button type="button" class="bt_100_32 bt_blue sign_set" data-action="clear">지우기</button>
                                <button type="button" class="bt_100_32 bt_dark sign_set" data-action="save-png">저장</button>
                                <button type="button" class="bt_100_32 bt_gray sign_img" onclick="signCancel()">서명취소</button>
                            </div>                            
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>결제정보</th>
            <td>
                <div>
                    <select name="aa_payment_kind" class="wAuto" onchange="chgPayType(this.value)">
                        <option value="">- 선택 -</option>
<?                      foreach(array('C'=>'카드', 'P'=>'현금', 'B'=>'무통장') as $k=>$v) echo '<option value="'.$k.'" '.($k==$row['aa_payment_kind']?'selected':'').'>'.$v.'</option>';?> 
                    </select>
                    <select name="card_name" id="card_name" class="wAuto pay_type_sub <?=$row['aa_payment_kind']=='C'?'':'hidden'?>">
                        <option value="">- 선택 -</option>
<?                      foreach($fix_codes->CardCompany as $k) echo '<option value="'.$k.'" '.($k==$row['aa_payment_name']?'selected':'').'>'.$k.'</option>';?>                        
                    </select>
                    <input type="text" name="aa_acount_num" id="aa_acount_num" class="mWt100 pay_type_sub <?=$row['aa_payment_kind']=='C'?'':'hidden'?>" value="<?=$row['aa_acount_num']?>" placeholder="승인번호" />
                    <input type="text" name="bank_name" id="bank_name" class="mWt60 pay_type_sub <?=$row['aa_payment_kind']=='B'?'':'hidden'?>" value="<?=$row['aa_payment_name']?>" placeholder="은행명" />
                    <input type="text" name="aa_bank_acc" id="aa_bank_acc" class="mWt100 pay_type_sub <?=$row['aa_payment_kind']=='B'?'':'hidden'?>" value="<?=$row['aa_bank_acc']?>" placeholder="입금계좌" />
                </div>

                <div>
                    <label class="chkWrap"><input type="checkbox" name="aa_payment_yn" value="Y" <?=$row['aa_payment_yn']=='Y'?'checked':''?> /><i></i><span>입금확인</span></label>
                </div>
                
                <!-- <div>
                    <button type="button" class="bt_pd bt_red" onclick="">결제취소</button>
                </div> -->
            </td>                                
        </tr>                                                     						
    </tbody>
</table>
<!-- <script type="text/javascript" src='<?=M_JS_DIR?>/lib/jquery.form.js'></script>
<script type="text/javascript" src='<?=M_JS_DIR?>/lib/jquery.MetaData.js'></script> -->
<script type="text/javascript" src="<?=M_JS_DIR?>/lib/jquery.MultiFile.js"></script>
<script type="text/javascript" src="<?=M_JS_DIR?>/signature.js"></script>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script>
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.itemJS = <?=json_encode($partRows)?>;
cateCtr.item_selector='select_part';
$(function() {
    $('#file_multi').MultiFile({
        onFileChange: function(){
			console.log('TEST CHANGE:', this, arguments);
		}
        ,STRING : {
            remove: '<img src="<?=IMG_DIR?>/btn_del.gif" style="width:auto">'
        }
    });
})

if('<?=$row['aa_confirm_sign']?>'=='') {
    $('.sign_set').removeClass('hidden');
    $('.sign_img').addClass('hidden');
}
else {
    $('.sign_set').addClass('hidden');
    $('.sign_img').removeClass('hidden');
}

wrapper.querySelector("[data-action=save-png]").addEventListener("click", function (event) {
    if (signaturePad.isEmpty()) {
        alertBox("서명란에 서명을 해주세요.");
    } else {
        var dataURL = signaturePad.toDataURL();
        saveSign(dataURL);
    }
});

function signCancel() {
    saveSign();
    $('.sign_set').removeClass('hidden');
    $('.sign_img').addClass('hidden');
    $('img.sign_img').remove();
}

function saveSign(sign) {
    var sign = sign || '';
    $.ajax({
        url : '/m/aservice/ajax_request',
        data : {mode:'update_sign', aa_pid:document.forms['aFrm'].aa_pid.value, sign:sign},
        type: "POST",
        cache: false,
        dataType:'html',
        success: function(res) {
            if(res=='ok' && sign) alertBox('저장되었습니다.');
        }
        ,error: function() {
            alertBox('Error');
        }
    });
}

function setPart(val) {
    if(!val) return false;
    let is_exists=false;
    // console.log($('.part_id_list').html());
    $('.part_id_list').each(function(){
        let exp_pid=val.split(':');
        let pid = exp_pid[0];

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

    let partHtml='<div id="_id_part_'+pt_pid+'">';
    partHtml+='    <div>'+pt_name+'</div>';
    partHtml+='    <div>';
    partHtml+='        ('+inputNumberWithComma(pt_price)+' / '+inputNumberWithComma(pt_wages)+')';
    partHtml+='        <select name="part[qty]['+pt_pid+']" class="part_qty_list mWt50" onchange="calcPartPay()">';
    for(var i=1; i<=10; i++) partHtml+='<option value="'+i+'">'+i+'</option>';
    partHtml+='        </select>';
    partHtml+='        <button type="button" class="bt_pd bt_black" onclick="delPart(\''+pt_pid+'\')">X</button>';
    partHtml+='    </div>';
    partHtml+='    <input type="hidden" class="part_id_list" value="'+pt_pid+'">';
    partHtml+='    <input type="hidden" class="part_name_list" name="part[name]['+pt_pid+']" value="'+pt_name+'">';
    partHtml+='    <input type="hidden" class="part_price_list" name="part[price]['+pt_pid+']" value="'+pt_price+'">';
    partHtml+='    <input type="hidden" class="part_wages_list" name="part[wages]['+pt_pid+']" value="'+pt_wages+'">';
    partHtml+='</div>';
    $('#select_part_list').append(partHtml);

    calcPartPay();
}

function delPart(pt_pid, pid) {
    var pid = pid || '';
    $('#_id_part_'+pt_pid).remove();
    if(pid) {
        $.ajax({
            url : '/m/aservice/ajax_request',
            data : {mode:'delete_sign_part', pid:pid},
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(res) {
                if(res=='ok') calcPartPay();
                else alertBox('삭제 오류!');
            }
            ,error: function() {
                alertBox('Error');
            }
        });
    }
    else calcPartPay();
}

function calcPartPay() {
    let calc_out_price=0;
    let calc_wages_price=0;
    let travel_price = $('#aa_travel_price').val() ? $('#aa_travel_price').val() : '0';
    // console.log('travel_price', travel_price);
    travel_price = travel_price.replace(/,/g, '');
    $('.part_price_list').each(function(i){
        let price = $(this).val() ? parseFloat($(this).val()) : 0;
        // console.log(i, price, $('.part_qty_list:eq('+i+')').val());
        calc_out_price += price * $('.part_qty_list:eq('+i+')').val();
    });
    $('.part_wages_list').each(function(i){
        let price = $(this).val() ? parseFloat($(this).val()) : 0;
        // console.log(i, price, $('.part_qty_list:eq('+i+')').val());
        calc_wages_price += price * $('.part_qty_list:eq('+i+')').val();
    });
    // console.log(calc_out_price, calc_wages_price, travel_price);
    let total_price = parseFloat(calc_out_price) + parseFloat(calc_wages_price) + parseFloat(travel_price);
    $('#calc_out_price').html(inputNumberWithComma(calc_out_price));
    $('#calc_wages_price').html(inputNumberWithComma(calc_wages_price));
    $('#aa_total_price').val(inputNumberWithComma(total_price));
}

function setFile() {
    // console.log('click', $('#file_multi').length, $('#file_multi').html());
    let file_cnt=$('input[name="files[]"]').length;
    if(file_cnt==1) $('input[id="file_multi"]').click();
    else $('input[id="file_multi_F'+(file_cnt-1)+'"]').click();
}
function chgPayKind(val) {
    if(val=='F') $('#aa_free_year').removeClass('hidden');
    else $('#aa_free_year').addClass('hidden');
}
function chgPayType(val) {
    $('.pay_type_sub').addClass('hidden');
    if(val=='C') {
        $('#card_name').removeClass('hidden');
        $('#aa_acount_num').removeClass('hidden');
    }
    else if(val=='B') {
        $('#bank_name').removeClass('hidden');
        $('#aa_bank_acc').removeClass('hidden');
    }
}
function delThumb(pid) {
    if(pid) {
        $.ajax({
            url : '/m/aservice/ajax_request',
            data : {mode:'delete_sign_thumb', pid:pid},
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(res) {
                if(res=='ok') $('#_id_thumb_'+pid).remove();
                else alertBox('삭제 오류!');
            }
            ,error: function() {
                alertBox('Error');
            }
        });
    }
}
</script>
