<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>

        <div class="left_right_con">
            <div class="left_con">
                <div class="buttonRight mb10">
                    <button type="button" class="bt_black" onclick="popPermitionForm(event)">등록</button>
                </div>
                <div class="table_wrap" id="res_permain_list"></div> <!-- table_wrap -->
            </div> <!-- left_con -->

            <div class="right_con">
                <form name="psFrm" id="psFrm" method="post" target="hiddenFrame" onsubmit="gcUtil.loader()" action="/basic/execute">
                <input type="hidden" name="mode" id="mode" value="reg_persub">
                <input type="hidden" name="bn_pid" id="bn_pid">
                <div class="buttonRight mb10 pos_rel" style="min-height:26px;">
                    <div id="res_main_name"></div>
                    <button type="submit" class="bt_black js-save-btn">저장</button>
                </div>
                <div class="table_wrap" id="res_persub_list">
                    <table class="ltable_1">
                        <thead>
                            <tr>
                                <th>대메뉴</th>
                                <th>소메뉴</th>
                                <th class="mWt60">접근</th>
                                <th class="mWt60">저장</th>
                                <th class="mWt60">삭제</th>
                                <th class="mWt60">출력</th>
                                <th class="mWt60">엑셀</th>
                            </tr>
                        </thead>
                        <tbody>                                        
                            <tr>
                                <td colspan=10 class="txac">등록 할 권한을 선택해주세요.</td>
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
include_once 'popPerMainRegForm.php';
?>
<script>
listPermition();
function popPermitionForm(evt, pid) {
    evt.preventDefault();
    evt.stopPropagation();

    var pid = pid || '';
    document.forms['regFrm'].bn_pid.value=pid;
    if(pid) {
        gcUtil.loader();
        $.ajax({
            data: {mode:'get_permain', pid:pid},
            type: "POST",
            url: "/basic/ajax_request",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                gcUtil.loader('hide');
                // console.log('res', resJson);
                if(!resJson.bn_pid) {
                    alertBox('권한정보를 가져오는데 실패했습니다.');
                }
                else {
                    setFormData('regFrm', resJson);
                    pop_modal('pop_permition_reg');
                }
            }
        });
    }
    else {
        setFormData('regFrm');
        setRadio('bn_use', 'Y');
        pop_modal('pop_permition_reg');
    }
}
function listPermition() {
    $.ajax({
        data: {mode:'get_permain_list'},
        type: "POST",
        url: "/basic/ajax_request",
        cache: false,
        dataType:'html',
        success: function(resHtml) {
            $('#res_permain_list').html(resHtml);
        }
        ,error : function(err) {
            console.log('err', err);
        }
    });
}
function listPermitionSub(p_pid, p_name) {
    $('#res_main_name').html(p_name);
    document.forms['psFrm'].bn_pid.value=p_pid;
    gcUtil.loader();
    $.ajax({
        data: {mode:'get_persub_list', p_pid:p_pid},
        type: "POST",
        url: "/basic/ajax_request",
        cache: false,
        dataType:'html',
        success: function(resHtml) {
            gcUtil.loader('hide');
            $('#res_persub_list').html(resHtml);
            // 체크/해제
            attachEvt();
        }
    });

}
function regPermain(f) {
    if(!getRadio('bn_use')) {
        alertBox('사용유무를 선택해주세요.');
        return false;
    }
    f.submit();

}
</script>