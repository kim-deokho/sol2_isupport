<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>
        <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
        <input type="hidden" name="page" id="page" value="<?=$page?>">
        <div class="search_box mt10">
            <div class="box_row">
                <span>검색구분</span>
                <select class="multi_select" style="width:auto" name="searchKey[]" id="searchKey" multiple="multiple">
<?                  foreach(array('pd_name'=>'상품명', 'pd_code'=>'상품코드') as $sk=>$sv) echo '<option value="'.$sk.'" selected>'.$sv.'</option>';?>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="검색어" />

                <button type="submit" class="bt_navy ml10">조회</button>

                <div class="po_right">
                    <button type="button" class="bt_green ml10 js-excel-btn" onclick="listExcel()">EXCEL</button>
                </div> <!-- po_right // 오른쪽 버튼 -->
            </div>
        </div> <!-- search_box -->
        </form>

        <?# 리스트 영역?>
        <div class="table_wrap" id="list_area"></div>

        <?# 페이징 영역?>
        <div class="mResultTablePage mContentWrap" id="paging"></div>
    </div> <!-- contents -->
</section>
<?
    include_once "popInpriceRegForm.php"; // 입고가등록
    include_once "popInpriceHistory.php"; // 상세이력
?>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-single-selector').select2();
});
sendSearch();
// 입고가등록
function popInpriceRegFrm(pid){
    var f = document.forms['regFrm'];
    f.reset();
    f.pd_pid.value=pid;
    $('#product_name').html($('#target_p_name_'+pid).html());
    $('#product_in_price').html($('#target_p_price_'+pid).html());
    pop_modal('pop_receve_p_reg');
}

// 상세이력
var historyTable='';
function popHistory(pid){
    $('#history_product_name').html($('#target_p_name_'+pid).html());
    var data_url='/product/ajax_request/?mode=get_inprice_history&pd_pid='+pid;
    if(!historyTable) {
        historyTable = $('#data_history_table').DataTable( {
            ajax: {
                url: data_url,
                dataSrc: 'data'
            }
            ,columns: [
                { "data": "no" },
                { "data": "pd_code" },
                { "data": "pd_name" },
                { "data": "in_price" },
                { "data": "in_date" }
            ]
            ,"searching": false
            ,"bInfo" : false
            ,"lengthChange": false
            ,"ordering": false
            ,"language": {
                "emptyTable": "내역이 존재하지 않습니다.",
                "loadingRecords": "로딩중...",
                "processing":     "잠시만 기다려 주세요...",
                "paginate": {
                    "next": "다음",
                    "previous": "이전"
                }
            }
        } );
    }
    else {
        historyTable.ajax.url(data_url);
        historyTable.ajax.reload();
    }
    pop_modal('pop_receve_p_record');
}

</script>