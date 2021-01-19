<section>
    <div class="contents">     
        <form name="searchFrm" id="searchFrm">
        <input type="hidden" name="date_type" id="date_type" value="<?=$date_type?>">
        <input type="hidden" name="sort" id="sort" value="<?=$sort?>">
        <input type="hidden" name="is_payment" id="is_payment" value="<?=$is_payment?>">
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

            <div class="box_row mt10">
                <span>상태</span>
                <div class="search_br ml15">
                    <button type="button" class="btn_is_payment">미결제</button>
                </div>        
            </div>
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
    $('.btn_is_payment').on('click', function() {
        if($(this).hasClass('active')) {
            f.is_payment.value='';
            $(this).removeClass('active');
        }
        else {
            f.is_payment.value='N';
            $(this).addClass('active');
        }
        sendSearch();
    });
    sendSearch();
    
});
</script>
