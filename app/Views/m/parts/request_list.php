<section>
    <div class="contents">     
        <form name="searchFrm" id="searchFrm">
        <input type="hidden" name="date_type" id="date_type" value="<?=$date_type?>">
        <input type="hidden" name="sort" id="sort" value="<?=$sort?>">
        <input type="hidden" name="p_kind" id="p_kind" value="<?=$p_kind?>">
        <div class="search_box">
            <div class="box_row">
                <span>요청일</span>
                <input type="text" name="sdate" class="date search mWt100" value="<?=$sdate?>" onFocus="this.blur()"/> ~ 
                <input type="text" name="edate" class="date search mWt100" value="<?=$edate?>" onFocus="this.blur()"/>        
            </div>
            <div class="box_row mt10">
                <span>부품명</span>

                    <select name="cate1" id="cate1" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 1, 'promotion')">
                        <option value="">1차카테고리</option>
<?                      foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'" '.($code==$cate1?'selected':'').'>'.$cate['name'].'</option>';?>
                    </select>
                    <select name="cate2" id="cate2" class="wAuto promotion" onchange="cateCtr.chgCategory(this.value, 2, 'promotion')">
                        <option value="">2차카테고리</option>
                    </select>
  
            </div> <!-- box_row -->

            <div class="box_row mt10">
                <input type="text" name="searchWord" class="mWt200 ml40" value="<?=$searchWord?>" placeholder="부품명" />
                <button type="submit" class="bt_pd bt_black">검색</button>
            </div> <!-- box_row -->

            <div class="box_row mt10">
                <span>구분</span>
                <div class="search_br ml15">
<?
                foreach(array(''=>'전체', 'A'=>'출고', 'B'=>'반입') as $k=>$t) echo '<button type="button" class="btn_pkind '.($k==$p_kind?'active':'').'" data-val="'.$k.'">'.$t.'</button> ';
?>
                </div>        
            </div>
        </div> <!-- search_box -->
        </form>
        <div class="bt_100p">
            <button type="button" class="bt_blue" onclick="win_load('/m/parts/request_list/reg')">부품요청</button>
        </div>

        <div class="list_top mt5">
            Total : <span id="result_cnt">0</span>
        </div> <!-- list_top -->
        <ul class="list_type1"></ul>          
    </div> 
</section>
<script type="text/javascript" src="<?=M_JS_DIR?>/list_common.js?ver=<?=$tDate?>"></script>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script>
$(function(){
    $('.btn_pkind').on('click', function() {
        let chk_val=$(this).data('val');
        $('.btn_pkind').removeClass('active');
        $('.btn_pkind').each(function(){
            let val = $(this).data('val');
            if(chk_val!=val) return true;
            document.forms['searchFrm'].p_kind.value=val;
            $(this).addClass('active');
        });
        sendSearch();
    });
    sendSearch();
});
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
if('<?=$cate1?>'!='') {
    $('#cate1').trigger('change');
    $('#cate2').val('<?=$cate2?>');
}
</script>
