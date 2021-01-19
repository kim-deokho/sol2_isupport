<section>
    <form name="aFrm" id="aFrm" method="post" enctype="multipart/form-data" action="/m/aservice/update_as" target="hiddenFrame">
    <input type="hidden" name="aa_pid" value="<?=$row['aa_pid']?>">
    <input type="hidden" name="ma_pid" value="<?=$row['ma_pid']?>">
    <input type="hidden" name="mc_pid" value="<?=$row['mc_pid']?>">
    <input type="hidden" name="return_url" value="<?=$return_url?>">
    <div class="contents"> 
        <div class="table_wrap">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th>요청일</th>
                        <td>
                            <div class="right_chk">
                                <div><?=dateFormat('Y-m-d', $row['request_date'])?> (<?=$row['cs_manager_name']?>)</div>
                                <label class="chkWrap"><span class="fs14 fce41 mr5">긴급</span><input type="checkbox" name="ma_is_hurryup" value="Y" <?=$row['ma_is_hurryup']=='Y'?'checked':''?> /><i></i></label>
                            </div>
                        </td>                                
                    </tr>
                    <tr>
                        <th>AS수취인</th>
                        <td>
                            <input type="text" name="ma_cut_name" class="mWt120" value="<?=$row['ma_cut_name']?>" required />
                        </td>                
                    </tr>            
                    <tr>
                        <th>AS연락처</th>
                        <td>
<?
                            $telText=array();
                            if($row['ma_cut_tel']) array_push($telText, '<a href="tel:'.$row['ma_cut_tel'].'">'.$row['ma_cut_tel'].'</a>');
                            if($row['ma_cut_tel2']) array_push($telText, '<a href="tel:'.$row['ma_cut_tel2'].'">'.$row['ma_cut_tel2'].'</a>');
                            echo implode(' / ', $telText);
?>                
                        </td>                                
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td>
                            <div>
                                <button type="button" class="bt_pd bt_white_bor" onclick="pop_post('ca_post', 'ca_addr', 'ca_addr2')">주소찾기</button>
                                <input type="text" name="ca_post" id="ca_post" class="mWt70" value="<?=$row['ca_post']?>" placeholder="우편번호" required readonly />
                                <!-- <button type="button" class="bt_pd bt_gray" onclick="adress_reg('selectDelivery')">배송지선택</button> -->
                            </div>
                            <div>
                                <input type="text" name="ca_addr" id="ca_addr" value="<?=$row['ca_addr']?>" placeholder="기본주소" required readonly/>
                                <input type="text" name="ca_addr2" id="ca_addr2" value="<?=$row['ca_addr2']?>" placeholder="상세주소" required />
                            </div>
                        </td>                                
                    </tr>
                    <tr>
                        <th>상담메모</th>
                        <td>
                            <?=nl2br($row['mc_contents'])?>
                        </td>                                
                    </tr>
                    <tr>
                        <th>제품정보</th>
                        <td>
                            <span id="result_product_name"><?=$row['product_name']?$row['product_name']:'없음'?></span>
                            <button type="button" class="bt_pd bt_gray" onclick="$('.select_product').toggle()">변경</button>
                            <div class="select_product">
								<select class="js-single-selector" name="pd_pid" id="pd_pid" style="width:100%;" onchange="setProduct(this.id)">
                                    <option value="" data-name="없음">- 없음 -</option>
<?                                  foreach($productRows as $p_row) echo '<option value="'.$p_row['pd_pid'].'" '.($p_row['pd_pid']==$row['pd_pid']?'selected':'').' data-name="'.$p_row['pd_name'].'">'.$p_row['pd_name'].'</option>';?>
                                </select>
							</div>
                        </td>                                
                    </tr>
                    <tr>
                        <th>제품시리얼</th>
                        <td>
                            <input type="text" name="ma_serial" class="" value="<?=$row['ma_serial']?>" />
                        </td>                
                    </tr>
                    <tr>
                        <th>모델명</th>
                        <td>
                            <input type="text" name="ma_model" class="" value="<?=$row['ma_model']?>" />
                        </td>                
                    </tr>
                    <tr>
                        <th>부위</th>
                        <td>
                            <select name="ma_part" class="">
<?                              foreach($setting['code']['AsPart'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['ma_part']?'selected':'').'>'.$info['cd_name'].'</option>';?>
                            </select>
                        </td>                
                    </tr>
                    <tr>
                        <th>증상</th>
                        <td>
                            <select name="ma_symptom" class="">
<?                              foreach($setting['code']['AsSymptom'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['ma_symptom']?'selected':'').'>'.$info['cd_name'].'</option>';?>
                            </select>
                        </td>                
                    </tr>                                               						
                </tbody>
            </table> <!-- itable_1 -->

            <table class="itable_1 mt10">
                <tbody>
                    <tr>
                        <th>AS기사</th>
                        <td>
                            <?=$session->get('as_mn_name')?>
                        </td>                                
                    </tr>    
                    <tr>
                        <th>상태</th>
                        <td>
                            <select name="aa_state" onchange="chgState(this.value)">
<?                      
                                foreach($fix_codes->AsState as $k=>$t) {
                                    if(!in_array($k, $use_state)) continue;
                                    echo '<option value="'.$k.'" '.($k==$row['aa_state']?'selected':'').'>'.$t.'</option>';

                                }
?>
                            </select>
                        </td>                                
                    </tr>          
                    <tr>
                        <th>방문일시</th>
                        <td>
                            <input type="text" name="aa_visit_date" class="date mWt100" value="<?=$row['aa_visit_date']?>" onFocus="this.blur()"/>
                            <select name="visit_hour" class="wAuto">
                                <option value="">-시-</option>
<?                      
                                for($h=0;$h<24;$h++) {
                                    $hh=getSerial($h, 2);
                                    echo '<option value="'.$hh.'" '.($hh==$exp_visit_time[0]?'selected':'').'>'.$hh.'시</option>';
                                }
?>                    
                            </select>
                            <select name="visit_min" class="wAuto">
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
                        <td>
                            <textarea name="aa_visit_memo"><?=$row['aa_visit_memo']?></textarea>
                        </td>                                
                    </tr>
                    <tr>
                        <th>일정안내문자</th>
                        <td>
                            <select name="sms_tel" class="wAuto">
<?
                                if($row['ma_cut_tel']) echo '<option value="'.$row['ma_cut_tel'].'">'.$row['ma_cut_tel'].'</option>';
                                if($row['ma_cut_tel2']) echo '<option value="'.$row['ma_cut_tel2'].'">'.$row['ma_cut_tel2'].'</option>';
?>                    
                            </select>
                            <button type="button" class="bt_pd bt_black" onclick="return false;sendInfoSMS()">발송</button>
                        </td>                                
                    </tr>                                                   						
                </tbody>
            </table> <!-- itable_1 -->

            <table class="result_box itable_1 mt10 hidden">
                <tbody>
                    <tr>
                        <th>처리</th>
                        <td>
                            <select name="aa_result_state" id="aa_result_state" onchange="getResultStateCode(this.value)">
                                <option value="">-선택-</option>
<?                              foreach($use_result_state as $code) echo '<option value="'.$code.'" '.($code==$row['aa_result_state']?'selected':'').'>'.$fix_codes->AsResultState[$code].'</option>';?>                    
                            </select>
                        </td>                                
                    </tr>
                    <tr>
                        <th>사유</th>
                        <td>
                            <select name="aa_result_code" id="aa_result_code">
<?                              foreach($use_result_code as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$row['aa_result_code']?'selected':'').'>'.$info['cd_name'].'</option>';?>                    
                            </select>
                        </td>                                
                    </tr>
                    <tr>
                        <th>상세사유</th>
                        <td>
                            <textarea name="aa_result_reason"><?=$row['aa_result_reason']?></textarea>
                        </td>                                
                    </tr>                                        						
                </tbody>
            </table> <!-- itable_1 -->   
<?
            if($add_form_file) include_once $add_form_file;
?>                     
        </div> <!-- table_Wrap -->
        <div class="buttonCenter">
            <button type="button" class="bt_100_32 bt_gray" onclick="history.back()">목록</button>
            <button class="bt_100_32 bt_dark ml5">저장</button>
        </div>
    </div>
    </form>
</section>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=M_JS_DIR?>/daum.post.ctr.js"></script>
<script>
$(document).ready(function() {
    $('.js-single-selector').select2();
    $('.select_product').hide();
});
function getResultStateCode(code) {
    $('#aa_result_code option').remove();
    $.ajax({
        url : '/m/aservice/ajax_request/get_code_data',
        data : {mode:'get_code_data', code:code},
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            for(var i in resJson) $('#aa_result_code').append('<option value="'+resJson[i]['cd_pid']+'">'+resJson[i]['cd_name']+'</option>');
        }
    });
}
function chgState(code) {
    if(code=='41') $('.result_box').removeClass('hidden');
    else $('.result_box').addClass('hidden');
}
function setProduct(id) {
    $('#result_product_name').html($('#'+id+' option:selected').data('name'));
    $('.select_product').hide();
}
</script>