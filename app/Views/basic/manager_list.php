<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>
        <div class="search_box mt10">
            <div class="box_row">
                <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
                <input type="hidden" name="page" id="page" value="<?=$page?>">
                <span>부서</span>
                <select name="department" id="department" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($setting['code']['Departments'] as $part) echo '<option value="'.$part['cd_pid'].'" '.($part['cd_pid']==$department?'selected':'').'>'.$part['cd_name'].'</option>';?>
                </select>
                <span class="ml20">근무</span>
                <select name="work_status" id="work_status" class="wAuto">
                    <option value="">전체</option>
<?                  foreach(array('I'=>'근무중', 'E'=>'퇴사') as $k=>$v) echo '<option value="'.$k.'" '.($k==$work_status?'selected':'').'>'.$v.'</option>';?>
                </select>
                <span class="ml20">직원</span>
                <select class="multi_select" style="width:auto" name="searchKey[]" id="searchKey" multiple="multiple">
<?                  foreach(array('mn_name'=>'이름', 'mn_hp'=>'휴대폰', 'mn_id'=>'아이디') as $sk=>$sv) echo '<option value="'.$sk.'" selected>'.$sv.'</option>';?>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="검색어" />
                <button type="submit" class="bt_navy ml10">조회</button>
                </form>

                <div class="po_right">
                    <button type="button" class="bt_black" onclick="popManagerFrm();">직원등록</button>
                    <button type="button" class="bt_green ml10 js-excel-btn" onclick="listExcel()">EXCEL</button>
                </div> <!-- po_right // 오른쪽 버튼 -->

            </div> <!-- box_row -->
        </div> <!-- search_box -->

        <?# 리스트 영역?>
        <div class="table_wrap" id="list_area"></div>

        <?# 페이징 영역?>
        <div class="mResultTablePage mContentWrap" id="paging"></div>
    </div> <!-- contents -->
</section>
<?
include_once 'popManagerRegForm.php';
?>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=JS_DIR?>/daum.post.ctr.js"></script>
<script>
sendSearch();
function popManagerFrm(pid) {
    var pid = pid || '';
    document.forms['regFrm'].mn_pid.value=pid;
    if(pid) {
        gcUtil.loader();
        $.ajax({
            data: {mode:'get_manager', pid:pid},
            type: "POST",
            url: "/basic/ajax_request",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                gcUtil.loader('hide');
                // console.log('res', resJson);
                if(!resJson.mn_pid) {
                    alertBox('직원정보를 가져오는데 실패했습니다.');
                }
                else {
                    $('#pwd').addClass('mWt50p');
                    $('#chk_pwd').removeClass('d_none');
                    setFormData('regFrm', resJson);
                    pop_modal('pop_manager_reg');
                }
            }
        });
    }
    else {
        $('#pwd').removeClass('mWt50p');
        $('#chk_pwd').addClass('d_none');
        $('#regFrm #mn_no').html('');
        $('#regFrm #reg_date').html('');
        setFormData('regFrm');
        pop_modal('pop_manager_reg');
    }
}
function regManager(f) {
    if(!f.mn_pid.value || $('input[id="chg_pwd"]').is(':checked')) {
        if(f.pwd.value!=f.pwd_confirm.value) {
            alertBoxFocus('비밀번호 확인값이 일치하지 않습니다.', f.pwd_confirm);
            return false;
        }
    }
    gcUtil.loader();
    var arr_work=[];
    $('input[name="mn_work"]').each(function(i){
        if($(this).is(':checked')) arr_work.push($(this).val());
    });
    f.mn_work_str.value=arr_work.join(',');

    var arr_add=[];
    $('input[name="mn_add"]').each(function(){
        if($(this).is(':checked')) arr_add.push($(this).val());
    });
    f.mn_add_str.value=arr_add.join(',');

    f.submit();

}

function popAdd() {
    PopUpWindowNameOpen('/basic/popPermitionAddForm/'+document.forms['regFrm'].mn_pid.value, '_pop_add', 700, 1400);
}
</script>