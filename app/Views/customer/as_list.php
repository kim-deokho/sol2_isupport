

<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>
        <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
        <input type="hidden" name="page" id="page" value="<?=$page?>">
        <div class="search_box mt10">
            <div class="box_row">
                <span>기간</span>
                <select name="date_type" class="wAuto">
                    <option value="request_date">요청일</option>
                </select>
                <input type="text" name="sdate" id="sdate" class="date mWt100 txac" value="<?=$sdate?>" > ~
                <input type="text" name="edate" id="edate" class="date mWt100 txac" value="<?=$edate?>" >   
                <span>상태</span>
                <select name="search_state" id="search_state" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($fix_codes->AsState as $k=>$v) echo '<option value="'.$k.'" '.($k==$search_state?'selected':'').'>'.$v.'</option>';?>
                </select>
                <span class="ml20">상담자</span>
                <select name="search_cs" id="search_cs" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($cs_manager as $info) echo '<option value="'.$info['mn_pid'].'" '.($info['mn_pid']==$search_cs?'selected':'').'>'.$info['mn_name'].'</option>';?>
                </select>
            </div>
            <div class="box_row mt10">
                <span>구분</span>
                <select name="search_kind" id="search_kind" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($setting['code']['AsKind'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$search_kind?'selected':'').'>'.$info['cd_name'].'</option>';?>
                </select>
                <span class="ml20">AS기사</span>
                <select name="search_as" id="search_as" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($as_manager as $info) echo '<option value="'.$info['mn_pid'].'" '.($info['mn_pid']==$search_as?'selected':'').'>'.$info['mn_name'].'</option>';?>
                </select>
                <span>회원</span>
                <select name="searchKey[]" class="multi_select" style="width:auto"  id="searchKey" multiple="multiple">
                    <option value="mb_name|ma_cut_name" selected>이름</option>
                    <option value="mb_code">코드</option>
                    <option value="concat(mb_tel1,mb_tel2,mb_tel3)|concat(ma_cut_tel,ma_cut_tel2)">전화</option>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="" />

                <button type="submit" class="bt_navy ml10">조회</button>

                <div class="po_right">
                    <button type="button" class="bt_black ml10" onclick="alert('요청취소????')">요청취소</button>
                    <button type="button" class="bt_green ml10 js-excel-btn" onclick="listExcel()">EXCEL</button>
                </div> <!-- po_right // 오른쪽 버튼 -->
            </div> <!-- box_row -->
        </div> <!-- search_box -->
        </form>

        <?# 리스트 영역?>
        <div class="table_wrap" id="list_area"></div>

        <?# 페이징 영역?>
        <div class="mResultTablePage mContentWrap" id="paging"></div>
    </div> <!-- contents -->
</section>
<?
    include_once APPPATH."Views/delivery/pop_as_proc.php"; // AS 처리
?>
<script type="text/javascript" src="<?=M_JS_DIR?>/lib/jquery.MultiFile.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // $('.js-single-selector').select2();
});
sendSearch();

function as_view(ma_pid){
    $.ajax({
        url : '/delivery/detailAsAssignForm/'+ma_pid,
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            var f = document.forms['asFrm'];
            // console.log(resJson.row);
            // return;
            if(resJson.row.aa_pid) {
                f.aa_pid.value = resJson.row.aa_pid;
                f.ma_pid.value = resJson.row.ma_pid;
                f.mc_pid.value = resJson.row.mc_pid;
                f.mb_pid.value = resJson.row.mb_pid;
            }

            if(resJson.html) {
                // $('#as_form_box').html('');
                // $('#as_form_box').append(resJson.html);
                $('#disposal_form_box').html('');
                $('#as_form_box').html(resJson.html);
                $('#pd_pid').trigger('change');
                pop_modal('pop_as_proc');
                $('.part_form input, .part_form select, .part_form textarea, .part_form button').prop('disabled', true);
                $('#as_apply_form input, #as_apply_form select, #as_apply_form textarea, #as_apply_form button').prop('disabled', true);
            }
        }
    });
}
// 배송지등록
function adress_reg(callback){
    list_dely(callback);
    pop_modal('pop_adress_reg', callback ? 'N' : 'Y');
}

//배송지 목록
function list_dely(callback) {

    $("#bsf")[0].reset();
    $("#dy_pid").val('');
    var dataParams ={mode:'dely_list',mb_pid:document.forms['asFrm'].mb_pid.value};
    if(callback) {
        dataParams.order='Y';
        dataParams.callback=callback;
    }
    // console.log(callback, dataParams);
    gcUtil.loader('show', '#pop_dlist_area');
    $.ajax({
        data: dataParams,
        type: "POST",
        url: '/customer/ajax_request',
        cache: false,
        dataType:'json',
        success: function(resJson) {
            // console.log(resJson);
            gcUtil.loader('hide', '#pop_dlist_area');
            $('#pop_dlist_area').html(resJson.html);
        }
    });
}

function selectDelivery(target_id) {
    var result = $('#'+target_id).data('select');
    var f = document.forms['asFrm'];
    f.ma_cut_name.value = result.dy_name ? result.dy_name : '';
    f.ma_cut_tel.value = result.dy_tel ? result.dy_tel : '';
    f.ma_cut_tel2.value = result.dy_tel2 ? result.dy_tel2 : '';
    f.ca_post.value = result.dy_post ? result.dy_post : '';
    f.ca_addr.value = result.dy_addr ? result.dy_addr : '';
    f.ca_addr2.value = result.dy_addr2 ? result.dy_addr2 : '';
    close_modal();
}

//배송지 삭제
function del_dely(dy_pid) {
    f = document.forms['bsf'];
    f.dy_pid.value = dy_pid;
    f.mode.value = 'del_dely';
    f.submit();
    f.mode.value = 'reg_dely';

}

//기본배송지 설정
function basic_dely(dy_pid) {
    f = document.forms['bsf'];
    f.dy_pid.value = dy_pid;
    f.mode.value = 'basic_dely';
    f.submit();
    f.mode.value = 'reg_dely';
}

function view_dely(dy_pid, dy_name, dy_tel1, dy_tel2, dy_post, dy_addr, dy_addr2) {
    $("#dy_pid").val(dy_pid);
    $("#dy_name").val(dy_name);
    $("#dy_tel1").val(dy_tel1);
    $("#dy_tel2").val(dy_tel2);
    $("#dy_post").val(dy_post);
    $("#dy_addr").val(dy_addr);
    $("#dy_addr2").val(dy_addr2);
}
</script>