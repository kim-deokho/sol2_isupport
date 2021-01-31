<div class="first_area mWt66p">
    <div class="title_1_1">접수정보</div>
    <div class="table_wrap">
        <table class="itable_1">
            <tbody>
                <tr>
                    <th class="mWt80">상담자</th>
                    <td><?=$row['cs_manager_name']?></td>
                    <th class="mWt80">요청일</th>
                    <td>
                        <span><?=dateFormat('Y-m-d', $row['request_date'])?></span>
                        <label class="chkWrap ml20"><input type="checkbox" name="ma_is_hurryup" value="Y" <?=$row['ma_is_hurryup']=='Y'?'checked':''?> /><i></i><span>긴급</span></label>
                    </td>
                </tr>                                                                        
                <tr>
                    <th>제품정보</th>
                    <td colspan="3">
                        <div class="input_box_type_s">
                            <div class="box_row">
                                <!-- <span>상품검색</span> -->
                                <select class="js-single-selector" name="pd_pid" id="pd_pid" onchange="setProduct(this.value)" style="width:100%;">
                                    <option value="">-- 상품선택 --</option>
<?                                  
                                    foreach($productRows as $p_row) {
                                        $is_selected=false;
                                        if($p_row['pd_pid']==$row['pd_pid']) {
                                            $is_selected=true;
                                        }
                                        echo '<option value="'.$p_row['pd_pid'].'" '.($is_selected?'selected':'').'>'.$p_row['pd_name'].'</option>';
                                    }
?>
                                </select>
                            </div> <!-- box_row -->
                        </div> <!-- input_box_type_s -->

                        <div class="table_wrap mt5">
                            <table class="ltable_1" id="as_product">
                                <thead>
                                    <tr>									
                                        <th>카테고리</th>
                                        <th>매입처</th>
                                        <th>상품코드</th>
                                        <th>상품명</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div> <!-- table_wrap -->                                    
                    </td>								
                </tr>
                <tr>
                    <th>제품시리얼</th>
                    <td><input type="text" name="ma_serial" class="" value="<?=$row['ma_serial']?>" placeholder="" /></td>
                    <th>모델명</th>
                    <td><input type="text" name="ma_model" class="" value="<?=$row['ma_model']?>" placeholder="" /></td>
                </tr>
                <tr>
                    <th>부위</th>
                    <td>
                        <select name="ma_part" class="wAuto">
<?                          foreach($setting['code']['AsPart'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['ma_part']?'selected':'').'>'.$info['cd_name'].'</option>';?>
						</select>
                    </td>
                    <th>증상</th>
                    <td>
                        <select name="ma_symptom" class="wAuto">
<?                          foreach($setting['code']['AsSymptom'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['ma_symptom']?'selected':'').'>'.$info['cd_name'].'</option>';?>
						</select>
                    </td>
                </tr>
                <tr>
                    <th>AS 수취인</th>
                    <td><input type="text" name="ma_cut_name" class="" value="<?=$row['ma_cut_name']?>" placeholder="" /></td>
                    <th>구분</th>
                    <td>
                        <select name="ma_kind" class="wAuto">
<?                         foreach($setting['code']['AsKind'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['ma_kind']?'selected':'').'>'.$info['cd_name'].'</option>';?>
						</select>
                    </td>
                </tr>
                <tr>
                    <th>AS 연락처1</th>
                    <td><input type="text" name="ma_cut_tel" class="" value="<?=$row['ma_cut_tel']?>" placeholder="" /></td>
                    <th>AS 연락처2</th>
                    <td><input type="text" name="ma_cut_tel2" class="" value="<?=$row['ma_cut_tel2']?>" placeholder="" /></td>
                </tr>
                <tr>
                    <th>AS 주소</th>
                    <td colspan="3">
                        <div>
                            <input type="text" name="ca_post" id="ca_post" class="mWt80" value="<?=$row['ca_post']?>" placeholder="우편번호" required readonly />
                            <button type="button" class="bt_white_bor" onclick="pop_post('ca_post', 'ca_addr', 'ca_addr2')">주소찾기</button>
                            <button type="button" class="bt_gray ml10" onclick="adress_reg('selectDelivery')">배송지선택</button>
                        </div>
                        <div class="mt7">
                            <input type="text" name="ca_addr" id="ca_addr" class="mWt48p" value="<?=$row['ca_addr']?>" placeholder="기본주소" required readonly/>
                            <input type="text" name="ca_addr2" id="ca_addr2" class="mWt48p" value="<?=$row['ca_addr2']?>" placeholder="상세주소" required />
                        </div>
                    </td>
                </tr>                                                               
                <tr>
                    <th>상담내용</th>
                    <td colspan="3"><textarea name="mc_contents" class="txa_base mHt108"><?=$row['mc_contents']?></textarea></td>
                </tr>                            						
            </tbody>
        </table> <!-- itable_1 -->
    </div> <!-- table_Wrap -->

    <div class="part_form">
        <div class="title_1_1 mt20">부품정보</div>                        
        <div class="input_box_type_s mt5">
            <div class="box_row">
                <div>
                    <select name="cate1" id="cate1" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
                        <option value="">1차카테고리</option>
<?                      foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
                    </select>
                    <select name="cate2" id="cate2" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 2, 'promotion')">
                        <option value="">2차카테고리</option>
                    </select>
                </div>

                <div class="mt10">
                    <select class="js-single-selector" name="select_part" id="select_part" style="width:100%;" onchange="setPart(this.value)">
                        <option value="">선택</option>
<?                      
                        foreach($partRows as $p_row) {
                            $p_value=$p_row['pt_pid'].':'.addslashes($p_row['pt_name']).':'.$p_row['pt_out_price'].':'.$p_row['pt_wages'];
                            echo '<option value="'.$p_value.'">'.$p_row['pt_name'].'</option>';
                        }
?>
                    </select>
                </div>                                                                   
            </div> <!-- box_row -->
        </div> <!-- input_box_type_s -->
    

        <div class="table_wrap mt5">
            <table class="ltable_1" id="part_tb">
                <thead>
                    <tr>									
                        <!-- <th>카테고리</th>													 -->
                        <th class="mWt200">부품명</th>
                        <th>수량</th>
                        <th>부품단가</th>
                        <th>공임단가</th>
                        <th>삭제</th>
                    </tr>
                </thead>
                <tbody id="">
<?
                $totAsignPartPrice=0;
                $totAsignPartWages=0;
                foreach($assignPartList as $apRow) {
                    $partHtml='<tr id="_id_part_'.$apRow['pt_pid'].'">';
                    $partHtml.='    <td>'.$apRow['aa_part_name'].'</td>';
                    $partHtml.='    <td><input type="text" name="part[qty]['.$apRow['pt_pid'].']" class="mWt50 h_20 txac part_qty_list" value="'.$apRow['aa_qty'].'" onkeyup="calcPartPay()" /></td>';
                    $partHtml.='    <td class="txar">'.number_format($apRow['aa_unit_price']).'</td>';
                    $partHtml.='    <td class="txar">'.number_format($apRow['aa_wages']).'</td>';
                    $partHtml.='    <td><button type="button" class="small bt_red" onclick="delPart(\''.$apRow['pt_pid'].'\', \''.$apRow['ap_pid'].'\')">삭제</button></td>';
                    $partHtml.='    <input type="hidden" class="part_id_list" value="'.$apRow['pt_pid'].'">';
                    $partHtml.='    <input type="hidden" class="part_pid_list" name="part[pid]['.$apRow['pt_pid'].']" value="'.$apRow['ap_pid'].'">';
                    $partHtml.='    <input type="hidden" class="part_name_list" name="part[name]['.$apRow['pt_pid'].']" value="'.$apRow['aa_part_name'].'">';
                    $partHtml.='    <input type="hidden" class="part_price_list" name="part[price]['.$apRow['pt_pid'].']" value="'.$apRow['aa_unit_price'].'">';
                    $partHtml.='    <input type="hidden" class="part_wages_list" name="part[wages]['.$apRow['pt_pid'].']" value="'.$apRow['aa_wages'].'">';
                    $partHtml.='</tr>';
                    $totAsignPartPrice += ($apRow['aa_unit_price']*$apRow['aa_qty']);
                    $totAsignPartWages += ($apRow['aa_wages']*$apRow['aa_qty']);
                    echo $partHtml;
                }
?>
                </tbody>
            </table>
        </div> <!-- table_wrap -->
    </div>
</div> <!-- first_area -->

<div class="second_area mWt32p" id="as_apply_form">
    <div class="title_1_1">방문정보</div>
    <div class="table_wrap">
        <table class="itable_1">
            <tbody>
                <tr>
                    <th class="mWt80">AS기사</th>
                    <td><?=$row['as_manager_name']?$row['as_manager_name']:'미지정'?></td>
                </tr>
                <tr>
                    <th>처리상태</th>
                    <td>
                        <select name="aa_state" id="aa_state" data-state="11" onchange="chgState(this.value)">
<?                      
                            foreach($fix_codes->AsState as $k=>$t) {
                                if(!in_array($k, $use_state)) continue;
                                echo '<option value="'.$k.'" '.($k==$row['aa_state']?'selected':'').' '.($k=='01'?'disabled':'').'>'.$t.'</option>';

                            }
?>
                        </select>
                    </td>                                        
                </tr>
                <tr>
                    <th>방문일시</th>
                    <td>
                        <input type="text" name="aa_visit_date" id="aa_visit_date" data-state="11" class="mt5 date mWt100 txac" value="<?=$row['aa_visit_date']?>" />
                        <select name="visit_hour" data-state="11" class="wAuto">
                            <option value="">-시-</option>
<?                      
                            for($h=0;$h<24;$h++) {
                                $hh=getSerial($h, 2);
                                echo '<option value="'.$hh.'" '.($hh==$exp_visit_time[0]?'selected':'').'>'.$hh.'시</option>';
                            }
?>                    
                        </select>
                        <select name="visit_min" data-state="11" class="wAuto">
                            <option value="">-분-</option>
<?                      
                            for($m=0;$m<=59;$m+=10) {
                                $mm=getSerial($m, 2);
                                echo '<option value="'.$mm.'" '.($mm==$exp_visit_time[1]?'selected':'').'>'.$mm.'분</option>';
                            }
?>                 
                        </select>
                    </td>                                        
                </tr>
                <tr>
                    <th>통화메모</th>
                    <td><textarea name="aa_visit_memo" data-state="11" class="txa_small"><?=$row['aa_visit_memo']?></textarea></td>
                </tr>
                <tr>
                    <th>일정안내문자</th>
                    <td>
                        <select name="sms_tel" data-state="11" class="wAuto">
<?
                            if($row['ma_cut_tel']) echo '<option value="'.$row['ma_cut_tel'].'">'.$row['ma_cut_tel'].'</option>';
                            if($row['ma_cut_tel2']) echo '<option value="'.$row['ma_cut_tel2'].'">'.$row['ma_cut_tel2'].'</option>';
?>                    
                        </select>
                        <button type="button" data-state="11" class="bt_black" onclick="return false;sendInfoSMS()">발송</button>
                    </td>                                        
                </tr>                         						
            </tbody>
        </table> <!-- itable_1 -->
    </div> <!-- table_Wrap -->

    <div class="title_1_1 mt20">처리정보</div>
    <div class="table_wrap">
        <table class="itable_1">
            <tbody>
                <tr>
                    <th>처리상태</th>
                    <td>
                        <select name="aa_result_state" id="aa_result_state" onchange="getResultStateCode(this.value)">
                            <option value="">-선택-</option>
<?                          foreach($use_result_state as $code) echo '<option value="'.$code.'" '.($code==$row['aa_result_state']?'selected':'').'>'.$fix_codes->AsResultState[$code].'</option>';?>                    
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>사유</th>
                    <td>
                        <select name="aa_result_code" id="aa_result_code">
<?                          foreach($use_result_code as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['aa_result_code']?'selected':'').'>'.$info['cd_name'].'</option>';?>                    
                        </select>
                    </td>                                
                </tr>
                <tr>
                    <th>처리내용</th>
                    <td><textarea name="aa_result_reason" class="txa_small"><?=$row['aa_result_reason']?></textarea></td>
                </tr>
                <tr>
                    <th>사진</th>
                    <td>
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
                                <option value="">- 선택 -</option>
<?                              foreach(array('P'=>'유상', 'F'=>'무상') as $k=>$v) echo '<option value="'.$k.'" '.($k==$row['aa_pay_kind']?'selected':'').'>'.$v.'</option>';?>
                            </select>
                            <select name="aa_free_year" id="aa_free_year" class="mWt100 dis_n">
<?                              for($i=1;$i<=10;$i++) echo '<option value="'.$i.'" '.($i==$row['aa_free_year']?'selected':'').'>'.$i.'년</option>';?>
                            </select>
                        </div>

                        <div class="table_wrap mt5">
                            <table class="ltable_1" id="">
                                <thead>
                                    <tr>									
                                        <th class="mWt70">부품비</th>	
                                        <th class="mWt70">공임비</th>
                                        <th>출장비</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    <tr>
                                        <td><span id="calc_out_price"><?=number_format($totAsignPartPrice)?></span></td>
                                        <td><span id="calc_wages_price"><?=number_format($totAsignPartWages)?></span></td>
                                        <td class="txar"><input type="text" name="aa_travel_price" id="aa_travel_price" class="mWt100 txar input-comma" value="<?=number_format($row['aa_travel_price'])?>" placeholder="0" onkeyup="calcPartPay()" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="fw6 txac">합계</td>
                                        <td>
                                            <input type="text" name="aa_total_price" id="aa_total_price" class="mWt100 txar" value="<?=number_format($row['aa_total_price'])?>" readonly />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- table_wrap -->                                    
                    </td>								
                </tr>
                <tr>
                    <th>결제정보</th>
                    <td>
                        <div>
                            <select name="aa_payment_kind" class="wAuto" onchange="chgPayType(this.value)">
                                <option value="">- 선택 -</option>
<?                              foreach(array('C'=>'카드', 'P'=>'현금', 'B'=>'무통장') as $k=>$v) echo '<option value="'.$k.'" '.($k==$row['aa_payment_kind']?'selected':'').'>'.$v.'</option>';?> 
                            </select>
                            <select name="card_name" id="card_name" class="wAuto pay_type_sub <?=$row['aa_payment_kind']=='C'?'':'dis_n'?>">
                                <option value="">- 선택 -</option>
<?                              foreach($fix_codes->CardCompany as $k) echo '<option value="'.$k.'" '.($k==$row['aa_payment_name']?'selected':'').'>'.$k.'</option>';?>                        
                            </select>
                            <input type="text" name="aa_acount_num" id="aa_acount_num" class="mWt80 pay_type_sub <?=$row['aa_payment_kind']=='C'?'':'dis_n'?>" value="<?=$row['aa_acount_num']?>" placeholder="승인번호" />
                            <input type="text" name="bank_name" id="bank_name" class="mWt80 pay_type_sub <?=$row['aa_payment_kind']=='B'?'':'dis_n'?>" value="<?=$row['aa_payment_name']?>" placeholder="은행명" />
                            <input type="text" name="aa_bank_acc" id="aa_bank_acc" class="mWt80 pay_type_sub <?=$row['aa_payment_kind']=='B'?'':'dis_n'?>" value="<?=$row['aa_bank_acc']?>" placeholder="입금계좌" />
                        </div>

                        <div class="mt5">
                            <label class="chkWrap"><input type="checkbox" name="aa_payment_yn" value="Y" <?=$row['aa_payment_yn']=='Y'?'checked':''?> /><i></i><span>입금확인</span></label>
                            <!-- <span class="ml10">(승인 : 35243532)</span> -->
                        </div>
                    </td>                                        
                </tr>                                						
            </tbody>
        </table> <!-- itable_1 -->
    </div> <!-- table_Wrap -->

    <div class="title_1_1 mt20">고객확인</div>
    <div class="table_wrap">
        <table class="itable_1">
            <tbody>
                <tr>
                    <th class="mWt80">확인자</th>
                    <td>
                        <input type="text" name="aa_confirm_name" class="mWt100" value="<?=$row['aa_confirm_name']?>" placeholder="" />
                        <select name="aa_confirm_kind" class="wAuto">
<?                          foreach(array('M'=>'본인') as $k=>$v) echo '<option value="'.$k.'" '.($k==$row['aa_confirm_kind']?'selected':'').'>'.$v.'</option>';?>                    
                        </select>
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
                        <!-- <div id="as_sign"></div>
                        <div class="buttonRight">
                            <button type="button" class="bt_gray" onclick="as_sign_clear();">서명 지우기</button>
                        </div> -->
                    </td>
                </tr>                                                              						
            </tbody>
        </table> <!-- itable_1 -->
    </div> <!-- table_Wrap -->
</div> <!-- second_area -->

<script type="text/javascript" src="<?=M_JS_DIR?>/signature_pad.umd.js"></script>
<script type="text/javascript" src="<?=M_JS_DIR?>/signature.js"></script>
<script>
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.itemJS = <?=json_encode($partRows)?>;
cateCtr.item_selector='select_part';
$(function(){
    // if('<?=$row['aa_state']?>'=='01') {
    //     $('.part_form input, .part_form select, .part_form textarea, .part_form button').prop('disabled', true);
    //     $('#as_apply_form input, #as_apply_form select, #as_apply_form textarea, #as_apply_form button').prop('disabled', true);
    // }
    

	$(".date").datepicker({
		yearRange: 'c-100:c+10',
		changeYear: true,
		changeMonth: true
	});

    $('.js-single-selector').select2();
    $('#aa_state').trigger('change');

    if('<?=$row['aa_confirm_sign']?>'=='') {
        $('.sign_set').removeClass('hidden');
        $('.sign_img').addClass('hidden');
    }
    else {
        $('.sign_set').addClass('hidden');
        $('.sign_img').removeClass('hidden');
    }

    $('#file_multi').MultiFile({
        afterFileAppend: function(element, value, master_element) {
			$('input[type=file]').prop('disabled', false);
		}
        ,STRING : {
            remove: '<img src="<?=IMG_DIR?>/btn_del.gif" style="width:auto">'
        }
    });

    wrapper.querySelector("[data-action=save-png]").addEventListener("click", function (event) {
        if (signaturePad.isEmpty()) {
            alertBox("서명란에 서명을 해주세요.");
        } else {
            var dataURL = signaturePad.toDataURL();
            saveSign(dataURL);
        }
    });
    fixSizeCanvas(227, 94);
    
});

function chgState(code) {
    if(code<='11') {
        $('.part_form input, .part_form select, .part_form textarea, .part_form button').prop('disabled', true);
        $('#as_apply_form input, #as_apply_form select, #as_apply_form textarea, #as_apply_form button').prop('disabled', true);
    }
    else {
        $('.part_form input, .part_form select, .part_form textarea, .part_form button').prop('disabled', false);
        $('#as_apply_form input, #as_apply_form select, #as_apply_form textarea, #as_apply_form button').prop('disabled', false);
    }
    $('#aa_state').prop('disabled', false);
}

function getResultStateCode(code) {
    $('#aa_result_code option').remove();
    if(code) {
        $.ajax({
            url : '/m/aservice/ajax_request/get_code_data',
            data : {mode:'get_code_data', code:code},
            type: "POST",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                console.log(resJson);
                for(var i in resJson) $('#aa_result_code').append('<option value="'+resJson[i]['cd_pid']+'">'+resJson[i]['cd_name']+'</option>');
            }
        });
    }

}

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
        data : {mode:'update_sign', aa_pid:document.forms['asFrm'].aa_pid.value, sign:sign},
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
    $('#part_tb tbody').prepend(partHtml);

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
    console.log($('.part_price_list').length, calc_out_price, calc_wages_price, travel_price);
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
    if(val=='F') $('#aa_free_year').removeClass('dis_n');
    else $('#aa_free_year').addClass('dis_n');
}
function chgPayType(val) {
    console.log('val', val);
    $('.pay_type_sub').addClass('dis_n');
    if(val=='C') {
        $('#card_name').removeClass('dis_n');
        $('#aa_acount_num').removeClass('dis_n');
    }
    else if(val=='B') {
        $('#bank_name').removeClass('dis_n');
        $('#aa_bank_acc').removeClass('dis_n');
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