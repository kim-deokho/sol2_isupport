<section>
    <div class="contents">     
        <form name="searchFrm" id="searchFrm">
        <input type="hidden" name="date_type" id="date_type" value="<?=$date_type?>">
        <input type="hidden" name="sort" id="sort" value="<?=$sort?>">
        <input type="hidden" name="is_hurryup" id="is_hurryup">
        <div class="search_box">
            <div class="box_row date_area">
                <span>요청일</span>
                <button type="button" class="ud_bt up" data-type="request_date" data-sort="desc">up</button>
                <button type="button" class="ud_bt down" data-type="request_date" data-sort="asc">down</button>

                <span class="sbml">배정일</span>
                <button type="button" class="ud_bt up" data-type="aa_matching_date" data-sort="desc">up</button>
                <button type="button" class="ud_bt down" data-type="aa_matching_date" data-sort="asc">down</button>
            </div> <!-- box_row -->

            <div class="box_row mt10">
                <span>고객명</span>
                <input type="text" name="search_member" class="mWt180" placeholder="이름/연락처" value="<?=$search_member?>" />
                <button type="submit" class="bt_pd bt_black">검색</button>
            </div> <!-- box_row -->

            <div class="box_row mt10">
                <span>상태</span>
                <div class="search_br ml15">
                    <button type="button" class="btn_hurryup">긴급</button>
                </div>        
            </div> <!-- box_row -->
        </div> <!-- search_box -->
        </form>

        <div class="list_top mt5">
            Total : <span id="result_cnt">0</span>
        </div> <!-- list_top -->
        <ul class="list_type1"></ul>          
    </div> 
</section>
<script type="text/javascript" src="<?=M_JS_DIR?>/list_common.js?ver=<?=$tDate?>"></script>
<script>
$(function(){
    $('.date_area button').on('click', function(){
        $('.date_area button').removeClass('active');
        $(this).addClass('active');
        f.date_type.value = $(this).data('type');
        f.sort.value = $(this).data('sort');
        sendSearch();
    });
    $('.btn_hurryup').on('click', function() {
        if($(this).hasClass('active')) {
            f.is_hurryup.value='N';
            $(this).removeClass('active');
        }
        else {
            f.is_hurryup.value='Y';
            $(this).addClass('active');
        }
        sendSearch();
    });
    sendSearch();
    
});
</script>
