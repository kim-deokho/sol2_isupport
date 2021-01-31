<section>
    <form name="regFrm" id="regFrm" method="post" target="hiddenFrame" action="/m/parts/execute">
	<input type="hidden" name="mode" id="mode" value="reg_part_request">
	<input type="hidden" name="pi_pid" id="pi_pid" value="<?=$row['pi_pid']?>">
    <div class="contents">
        <div class="table_wrap">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th>요청일</th>
                        <td>
                            <input type="text" name="reg_date" class="date mWt100" value="<?=dateFormat('Y-m-d', $row['reg_date'])?>" onFocus="this.blur()"/>
                        </td>                                
                    </tr>
                    <tr>
                        <th>구분</th>
                        <td>
<?
                            foreach($setting['code']['pi_kind'] as $k=>$t) echo '<label class="radioWrap '.($k=='A'?'':'ml20').'"><input type="radio" name="pi_kind" value="'.$k.'" '.($k==$row['pi_kind']?'checked':'').' /><i></i><span class="fs14">'.$t.'</span></label>';
?>
                        </td>                                
                    </tr>
                    <tr>
                        <th>창고</th>
                        <td>
                            <select name="pi_store" id="pi_store" class="wAuto">
<?                              foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'" '.($part['cd_pid']==$row['pi_store']?'selected':'').'>'.$part['cd_name'].'</option>';?> ?>
							</select>
                        </td>                
                    </tr>
                    <tr>
                        <th>부품검색</th>
                        <td>
                            <div>
                                <select name="cate1" id="cate1" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
                                    <option value="">1차카테고리</option>
<?                                  foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'">'.$cate['name'].'</option>';?>
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
                            </div>
                        </td>                                
                    </tr>
                    <tr>
                        <th>요청부품</th>
                        <td>
                            <div id="select_part_list">
<?
                                foreach($rowParts as $apRow) {
                                    $qty=$apRow['ii_real_qea']?$apRow['ii_real_qea']:$apRow['ii_qea'];
                                    $partHtml='<div id="_id_part_'.$apRow['pt_pid'].'">';
                                    $partHtml.='    <div>'.$apRow['pt_name'].'</div>';
                                    $partHtml.='    <div>';
                                    $partHtml.='        현재고:'.number_format($stockRows[$apRow['pt_pid']]['st_qea']).' / ';
                                    $partHtml.='        요청수량:<select name="part[qty]['.$apRow['pt_pid'].']" class="part_qty_list mWt50">';
                                    for($i=1; $i<=10; $i++) $partHtml.='<option value="'.$i.'" '.($i==$qty?'selected':'').'>'.$i.'</option>';
                                    $partHtml.='        </select>';
                                    $partHtml.='    </div>';
                                    $partHtml.='    <input type="hidden" class="part_id_list" value="'.$apRow['pt_pid'].'">';
                                    $partHtml.='</div>';
                                    echo $partHtml;
                                }
?>
                            </div>
                        </td>                                
                    </tr>
                    <tr>
                        <th>비고</th>
                        <td>
                            <textarea name="pi_memo"><?=$row['pi_memo']?></textarea>
                        </td>                                
                    </tr>
                    <tr>
                        <th>처리자</th>
                        <td>
                            <?=$row['confirm_name']?> <?=dateFormat('Y-m-d H:i', $row['pi_confirm_date'])?>
                        </td>                
                    </tr>                                                      						
                </tbody>
            </table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->
        <div class="buttonCenter">
<?      
         echo '<button type="button" class="bt_100_32 bt_gray" onclick="history.back()">목록</button>';
        if(!$row['pi_pid']){      
            echo '<button type="submit" class="bt_100_32 bt_dark ml5">저장</button>';
        } else {
            if($row['pi_state']=='A') echo '<button type="button" class="bt_100_32 bt_red ml5" onclick="confirmBox(\'정말 취소하시겠습니까?\', cancelRequest, \''.$row['pi_pid'].'\')">요청취소</button>';
            else if($row['pi_state']=='B' && $row['pi_result_confirm_yn']=='N') echo '<button type="button" class="bt_100_32 bt_dark ml5" onclick="sendConfirm(\''.$row['pi_pid'].'\')">수령확인</button>';
            else if($row['pi_result_confirm_yn']=='Y') echo '<button type="button" class="bt_100_32 ml5">수령완료</button>';
        }
?>
        </div>
    </div>
    </form>
</section>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script>
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.itemJS = <?=json_encode($partRows)?>;
stockRows = <?=json_encode($stockRows)?>;
if('<?=$row['pi_pid']?>'!='') $('input, textarea, select').prop('disabled', true);
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

    let partHtml='<div id="_id_part_'+pt_pid+'">';
    partHtml+='    <div>'+pt_name+'</div>';
    partHtml+='    <div>';
    partHtml+='        현재고:'+inputNumberWithComma(stockRows[pt_pid]['st_qea'])+' / ';
    partHtml+='        요청수량:<select name="part[qty]['+pt_pid+']" class="part_qty_list mWt50">';
    for(var i=1; i<=stockRows[pt_pid]['st_qea']; i++) partHtml+='<option value="'+i+'">'+i+'</option>';
    partHtml+='        </select>';
    partHtml+='        <button type="button" class="bt_pd bt_black" onclick="delPart(\''+pt_pid+'\')">X</button>';
    partHtml+='    </div>';
    partHtml+='    <input type="hidden" class="part_id_list" value="'+pt_pid+'">';
    partHtml+='    <input type="hidden" name="part[name]['+pt_pid+']" value="'+pt_name+'">';
    partHtml+='</div>';
    $('#select_part_list').prepend(partHtml);
}

function delPart(pt_pid) {
    $('#_id_part_'+pt_pid).remove();
}

function sendConfirm(pi_pid) {
    $.ajax({
        data: {mode:'update_confirm', pi_pid:pi_pid},
        type: "POST",
        url: '/m/parts/execute',
        cache: false,
        dataType:'html',
        success: function(res) {
            if(res=='ok') alertBox("정상처리되었습니다.", win_load, '/m/parts/request_list');
        }
    });
}
function cancelRequest(pi_pid) {
    $.ajax({
        data: {mode:'canel_part_request', pi_pid:pi_pid},
        type: "POST",
        url: '/m/parts/execute',
        cache: false,
        dataType:'html',
        success: function(res) {
            if(res=='ok') alertBox("정상처리되었습니다.", win_load, '/m/parts/request_list');
        }
    });
}
</script>