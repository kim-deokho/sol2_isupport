<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>

        <div class="left_right_con">
            <div class="left_con">
                <div class="title_1 mt10">1차코드</div>                            
                <div class="table_wrap mt30">
                    <table class="ltable_1 t_effect_1" id="">
                        <thead>
                            <tr>
                                <th>코드번호</th>
                                <th class="mWt50p">코드명</th>
                                <th>사용유무</th>											
                            </tr>
                        </thead>
                        <tbody id="">	
<?                      foreach($mainCodes as $m_code) {?>                            								    
                            <tr class="list_main_code" data-code="<?=$m_code['cd_pid']?>" data-name="<?=$m_code['cd_name']?>">
                                <td><?=$m_code['cd_code']?></td>
                                <td><?=$m_code['cd_name']?></td>
                                <td><?=$m_code['cd_use']?></td>
                            </tr>
<?                      }?>
                        </tbody>
                    </table>
                </div> <!-- table_wrap -->
            </div> <!-- left_con -->

            <div class="right_con">
                <form name="csFrm" id="csFrm" method="post" target="hiddenFrame" onsubmit="gcUtil.loader()" action="/basic/execute">
                <input type="hidden" name="mode" id="mode" value="reg_code_sub">
                <input type="hidden" name="p_cd_pid" id="p_cd_pid">
                <div class="title_2 mt0">
                    <div>2차코드<span id="res_main_name" class="pos_rel ml5"></span></div>
                    <div>
                        <button type="button" class="bt_black" onclick="popRegCode();">등록</button>
                        <button type="button" class="bt_green js-save-btn" onclick="chgOrder();">순번변경</button>
                    </div>
                </div> <!-- title_2 -->
                <div class="precautions_1">※ 순번변경 : Drag&Drop으로 설정 후 ‘순번변경’ 버튼을 클릭해야 순번이 정상변경됩니다.</div>                            
                <div class="table_wrap mt10" id="res_code_sub_list">
                    <table class="ltable_1">
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
                            <tr>
                                <td colspan=10 class="txac">등록 할 코드를 선택해주세요.</td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- table_wrap -->
                </form>
            </div> <!-- right_con -->
        </div> <!-- left_right_con -->
                            
    </div> <!-- contents -->
</section>
<?
include_once 'popCodeRegForm.php';
?>
<script>
$(function(){
    $('.list_main_code').on('click', function(){
        setSubCodeList($(this).attr('data-code'), $(this).attr('data-name'));
    })
});
function setSubCodeList(p_pid, p_name) {
    var p_name = p_name || '';
    if(p_name) {
        $('#res_main_name').html('['+p_name+']');
        $('#main_code_name').html(p_name);
    }
    $.modal.close();    // 등록 모달창 닫기
    document.forms['csFrm'].p_cd_pid.value=p_pid;
    document.forms['regFrm'].p_cd_pid.value=p_pid;
    gcUtil.loader();
    $.ajax({
        data: {mode:'get_code_sub_list', p_pid:p_pid},
        type: "POST",
        url: "/basic/ajax_request",
        cache: false,
        dataType:'html',
        success: function(resHtml) {
            gcUtil.loader('hide');
            $('#res_code_sub_list').html(resHtml);
            $('#table_sub_code').tableDnD({
                onDrop: function(table, row) {
                    var rows = table.tBodies[0].rows;
                    for (var i=0; i<rows.length; i++) {
                        // console.log(i, rows[i].id, $('#_id_order_'+rows[i].id).html());
                        $('#_id_order_'+rows[i].id).html(i+1);
                    }

                }
            });
        }
    });
}
function popRegCode(cd_pid) {
    var f = document.forms['csFrm'];
    if(!f.p_cd_pid.value) {
        alertBox('1차코드를 선택 후 등록가능합니다.');
        return false;
    }
    var cd_pid = cd_pid || '';
    document.forms['regFrm'].cd_pid.value=cd_pid;
    if(cd_pid) {
        gcUtil.loader();
        $.ajax({
            data: {mode:'get_sub_code', cd_pid:cd_pid},
            type: "POST",
            url: "/basic/ajax_request",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                gcUtil.loader('hide');
                // console.log('res', resJson);
                if(!resJson.cd_pid) {
                    alertBox('해당정보를 가져오는데 실패했습니다.');
                }
                else {
                    setFormData('regFrm', resJson);
                    pop_modal('pop_code_reg');
                    setTimeout(function(){
                        $('#cd_name').focus();
                    }, 500);
                }
            }
        });
    }
    else {
        setFormData('regFrm');
        setRadio('cd_use', 'Y');
        pop_modal('pop_code_reg');
        setTimeout(function(){
            $('#cd_name').focus();
        }, 500);
    }
}
function regCode(f) {
    if(!getRadio('cd_use')) {
        alertBox('사용유무를 선택해주세요.');
        return false;
    }
    f.submit();

}

function chgOrder() {
    var arr_code=[];
    $('.sub_code_rows').each(function(){
        arr_code.push($(this).attr('id'));
    });

    if(arr_code.length<2) {
        alertBox('순번변경 할 리스트가 없습니다.');
        return false;
    }
    gcUtil.loader();
    $.ajax({
        data: {mode:'update_sub_code_order', ids:arr_code.join(',')},
        type: "POST",
        url: "/basic/execute",
        cache: false,
        dataType:'html',
        success: function(resHtml) {
            gcUtil.loader('hide');
            var msg='정상적으로 변경되었습니다.';
            if(resHtml=='no_ids') msg='변경 할 코드가 없습니다.';
            alertBox(msg);
        }
    });
}
</script>