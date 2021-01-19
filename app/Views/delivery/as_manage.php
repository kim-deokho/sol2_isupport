

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
                    <option value="">요청일</option>
                </select>
                <input type="text" name="sdate" id="sdate" class="date mWt100 txac" value="<?=$sdate?>" > ~
                <input type="text" name="edate" id="edate" class="date mWt100 txac" value="<?=$edate?>" >    
            </div>  
            <div class="box_row mt10">
                <span>상태</span>
                <select name="search_state" id="search_state" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($fix_codes->AsState as $k=>$v) echo '<option value="'.$k.'" '.($k==$search_state?'selected':'').'>'.$v.'</option>';?>
                </select>
                <span class="ml20">결과상태</span>
                <select name="search_result_state" id="search_result_state" class="wAuto" disabled>
                    <option value="">전체</option>
<?                  foreach($fix_codes->AsResultState as $k=>$v) echo '<option value="'.$k.'" '.($k==$search_result_state?'selected':'').'>'.$v.'</option>';?>
                </select>
                <span class="ml20">상담자</span>
                <select name="search_cs" id="search_cs" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($cs_manager as $info) echo '<option value="'.$info['mn_pid'].'" '.($info['mn_pid']==$search_cs?'selected':'').'>'.$info['mn_name'].'</option>';?>
                </select>
                <span class="ml20">구분</span>
                <select name="search_kind" id="search_kind" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($setting['code']['AsKind'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$search_kind?'selected':'').'>'.$info['cd_name'].'</option>';?>
                </select>
                <span class="ml20">AS기사</span>
                <select name="search_as" id="search_as" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($as_manager as $info) echo '<option value="'.$info['mn_pid'].'" '.($info['mn_pid']==$search_as?'selected':'').'>'.$info['mn_name'].'</option>';?>
                </select>
            </div> <!-- box_row -->
            <div class="box_row mt10">
                <span>회원</span>
                <select name="searchKey[]" class="multi_select" style="width:auto"  id="searchKey" multiple="multiple">
                    <option value="mb_name|ma_cut_name" selected>이름</option>
                    <option value="mb_code">코드</option>
                    <option value="concat(mb_tel1,mb_tel2,mb_tel3)|concat(ma_cut_tel,ma_cut_tel2)">전화</option>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="" />

                <span>상품명</span>
                <input type="text" name="search_product" id="search_product" class="mWt200" value="<?=$search_product?>" placeholder="" />

                <button type="submit" class="bt_navy ml10">조회</button>

                <div class="po_right">
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
    include_once "pop_assig_person2.php"; // 기사배정
    include_once "pop_as_proc.php"; // AS 처리
    include_once "pop_disposal_parts.php"; // 부품폐기
?>
<script type="text/javascript">
$(document).ready(function() {
    // $('.js-single-selector').select2();
});
sendSearch();

// 기사배정
function assig_person2(aa_pid){
    var f = document.forms['asmFrm'];
    f.aa_pid.value = aa_pid;
    $.ajax({
        url : 'ajax_request',
        data : {mode:'search_as_manager', aa_pid:aa_pid},
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            $('#pop_assig_person2 table tbody').html(resJson.html);
            if(resJson.row.aa_visit_date) $('#btn_asm_cancel').prop('disabled', true);
            else $('#btn_asm_cancel').prop('disabled', false);
            pop_modal('pop_assig_person2');
        }
    });
}

function asmCancel(f) {
    confirmBox("정말 취소하시겠습니까?", function(){
        $.ajax({
            url : 'execute',
            data : {mode:'cancel_as_manager', aa_pid:f.aa_pid.value},
            type: "POST",
            cache: false,
            dataType:'html',
            success: function(resHtml) {
                if(resHtml=='ok') {
                    alertBox("기사배정이 취소되었습니다.", resultReList);
                }
                else alertBox("취소시 오류발생.");
            }
        });
    });
    
}

function asmSave() {
    $.ajax({
        url : 'execute',
        data : $('#asmFrm').serialize(),
        type: "POST",
        cache: false,
        dataType:'html',
        success: function(resHtml) {
            if(resHtml=='ok') {
                alertBox("기사배정이 완료되었습니다.", resultReList);
            }
            else alertBox("배정시 오류발생.");
        }
    });
}

// 상품등록
function as_proc(){
    pop_modal('pop_as_proc');
    // 사인 실행
    $("#as_sign").signature();
}

// 부품폐기
function disposal_parts(){
    pop_modal('pop_disposal_parts');
}

</script>