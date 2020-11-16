<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>
        <div class="search_box mt10">
            <div class="box_row">
                <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
                <input type="hidden" name="page" id="page" value="<?=$page?>">
                <span>구분</span>
                <select name="ct_kind" id="ct_kind" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($fix_codes->TraderKind as $k=>$v) echo '<option value="'.$k.'" '.($k==$trader_kind?'selected':'').'>'.$v.'</option>';?>
                </select>
                <span class="ml20">거래처</span>
                <select class="multi_select" style="width:auto" name="searchKey[]" id="searchKey" multiple="multiple">
<?                  foreach(array('ct_name'=>'업체명', 'ct_no'=>'사업자번호') as $sk=>$sv) echo '<option value="'.$sk.'" selected>'.$sv.'</option>';?>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="검색어" />
                <button type="submit" class="bt_navy ml10">조회</button>
                </form>

                <div class="po_right">
                    <button type="button" class="bt_black" onclick="popTraderRegFrm();">거래처등록</button>
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
include_once 'popTraderRegForm.php';
?>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=JS_DIR?>/daum.post.ctr.js"></script>
<script>
sendSearch();
daumPost.post_id='ct_post';
daumPost.addr_id='ct_addr';
daumPost.addrDetail_id='ct_addr2';
daumPost.addrExtra_id='ct_addr2';
function popTraderRegFrm(pid) {
    var pid = pid || '';
    document.forms['regFrm'].ct_pid.value=pid;
    if(pid) {
        gcUtil.loader();
        $.ajax({
            data: {mode:'get_trader', pid:pid},
            type: "POST",
            url: "/basic/ajax_request",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                gcUtil.loader('hide');
                // console.log('res', resJson);
                if(!resJson.ct_pid) {
                    alertBox('거래처정보를 가져오는데 실패했습니다.');
                }
                else {
                    setFormData('regFrm', resJson);
                    pop_modal('pop_client_reg');
                }
            }
        });
    }
    else {
        $('#regFrm #ct_code').html('');
        $('#regFrm #reg_date').html('');
        setFormData('regFrm');
        pop_modal('pop_client_reg');
    }
}
</script>