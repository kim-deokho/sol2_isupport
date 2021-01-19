<section>
    <div class="contents">     
        <form name="searchFrm" id="searchFrm">
        <input type="hidden" name="date_type" id="date_type" value="<?=$date_type?>">
        <input type="hidden" name="sort" id="sort" value="<?=$sort?>">
        <div class="search_box">
            <div class="box_row">
                <span>예정일</span>
                <input type="text" name="sdate" class="date search mWt100" value="<?=$sdate?>" onFocus="this.blur()"/> ~ 
                <input type="text" name="edate" class="date search mWt100" value="<?=$edate?>" onFocus="this.blur()"/>        
            </div> <!-- box_row -->

            <div class="box_row mt10">
                <span>고객명</span>
                <input type="text" name="search_member" class="mWt180" value="<?=$search_member?>" placeholder="이름/연락처" />
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
    sendSearch();
});
</script>
