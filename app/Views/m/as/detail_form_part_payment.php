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
                <div id="select_part_list"></div>
                <!-- <div>
                    <div>하부 조임 나사 BC12</div>
                    <div>
                        (15,000 / 5,000)
                        <select name="" class="mWt50">
                            <option value="">1</option>
                        </select>
                        <button type="button" class="bt_pd bt_black" onclick="">X</button>
                    </div>
                </div>

                <div>
                    <div>
                        하부 받침 WE-456
                    </div>
                    <div>
                        (15,000 / 5,000)
                        <select name="" class="mWt50">
                            <option value="">1</option>
                        </select>
                        <button type="button" class="bt_pd bt_black" onclick="">X</button>
                    </div>
                </div> -->
            </td>                                
        </tr>                                    						
    </tbody>
</table> <!-- itable_1 -->

<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th>사진첨부</th>
            <td>
                <input name="files[]" type="file" multiple="multiple" class="multi with-preview" />
                <button type="button" class="bt_pd bt_white_bor" onclick="">사진첨부</button>
            </td>                                
        </tr>
        <tr>
            <th>요금</th>
            <td>
                <div>
                    <select name="" class="">
                        <option value="">유상</option>
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
                                <td><span id="calc_out_price">0</span></td>
                                <td><span id="calc_wages_price">0</span></td>
                                <td class="txar"><input type="text" name="aa_travel_price" id="aa_travel_price" class="mWt100 txar input-comma" value="<?=$row['aa_travel_price']?>" placeholder="0" onkeyup="calcPartPay()" /></td>
                            </tr>
                        </tbody>
                        <tfoot id="">
                            <tr>
                                <td colspan="3" class="fw6 txar">
                                    합계 : 
                                    <input type="text" name="aa_total_price" id="aa_total_price" class="mWt100 txar" value="<?=$row['aa_total_price']?>" readonly />
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
                <input type="text" name="" class="mWt150" value="" />
                <select name="" class="wAuto">
                    <option value="">본인</option>
                </select>
            </td>                                
        </tr>
        <tr>
            <th>연락처</th>
            <td>
                <input type="text" name="" class="mWt150" value="" />
            </td>                                
        </tr>
        <tr>
            <th>서명</th>
            <td>
                <div id="signature-pad" class="signature-pad">
                    <div class="signature-pad--body">
                        <canvas class="sign_set"></canvas>
                        <img src="<?=$row['aa_confirm_sign']?>" class="sign_img">
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
                    <select name="" class="wAuto">
                        <option value="">카드</option>
                    </select>
                    <select name="" class="wAuto">
                        <option value="">삼성카드</option>
                    </select>
                </div>

                <div>
                    <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>입금확인</span></label>
                </div>
                
                <div>
                    <button type="button" class="bt_pd bt_red" onclick="">결제취소</button>
                </div>
            </td>                                
        </tr>                                                     						
    </tbody>
</table>
<script type="text/javascript" src="<?=M_JS_DIR?>/lib/jquery.MultiFile.min.js"></script>
<script type="text/javascript" src="<?=M_JS_DIR?>/signature.js"></script>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script>
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.itemJS = <?=json_encode($partRows)?>;
cateCtr.item_selector='select_part';


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
    let is_exists=false;
    $('.part_id_list').each(function(){
        if($(this).val()!==val) return true;
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

function delPart(pid) {
    $('#_id_part_'+pid).remove();
    calcPartPay();
}

function calcPartPay() {
    let calc_out_price=0;
    let calc_wages_price=0;
    let travel_price = $('#aa_travel_price').val() ? $('#aa_travel_price').val() : '0';
    console.log('travel_price', travel_price);
    travel_price = travel_price.replace(/,/g, '');
    $('.part_price_list').each(function(i){
        let price = $(this).val() ? parseFloat($(this).val()) : 0;
        console.log(i, price, $('.part_qty_list:eq('+i+')').val());
        calc_out_price += price * $('.part_qty_list:eq('+i+')').val();
    });
    $('.part_wages_list').each(function(i){
        let price = $(this).val() ? parseFloat($(this).val()) : 0;
        console.log(i, price, $('.part_qty_list:eq('+i+')').val());
        calc_wages_price += price * $('.part_qty_list:eq('+i+')').val();
    });
    console.log(calc_out_price, calc_wages_price, travel_price);
    let total_price = parseFloat(calc_out_price) + parseFloat(calc_wages_price) + parseFloat(travel_price);
    $('#calc_out_price').html(inputNumberWithComma(calc_out_price));
    $('#calc_wages_price').html(inputNumberWithComma(calc_wages_price));
    $('#aa_total_price').val(inputNumberWithComma(total_price));
}
</script>
