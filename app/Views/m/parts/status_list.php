<section>
    <div class="contents">     
        <form name="searchFrm" id="searchFrm">
        <div class="search_box">
            <div class="box_row">
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
        </div> <!-- search_box -->
        </form>
        <div class="list_top mt5">
            Total : <span id="result_cnt">0</span>
        </div> <!-- list_top -->
        <ul class="list_type1"></ul>          
    </div> 
</section>
<script type="text/javascript" src="<?=M_JS_DIR?>/list_common.js?ver=<?=$tDate?>"></script>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script>
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
$(function(){
    sendSearch();
});
</script>
