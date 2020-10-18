
<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?> 
        <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
        <input type="hidden" name="page" id="page" value="<?=$page?>">
        <div class="search_box mt10">
            <div class="box_row">
                <span>카테고리</span>
                <select name="cate1" id="cate1" class="wAuto sel_categorys" onchange="cateCtr.chgCategory(this.value, 1)">
                    <option value="">전체</option>
<?                  foreach($categorysJS as $code=>$cate) echo '<option value="'.$code.'" '.($code==$cate1?'selected':'').'>'.$cate['name'].'</option>';?>
                </select>
                <select name="cate2" id="cate2" class="wAuto sel_categorys" onchange="cateCtr.chgCategory(this.value, 2)">
                    <option value="">전체</option>
                </select>
                <select name="cate3" id="cate3" class="wAuto sel_categorys" onchange="cateCtr.chgCategory(this.value, 3)">
                    <option value="">전체</option>
                </select>

                <span class="ml20">구분</span>
                <select name="pd_kind" id="pd_kind" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($setting['code']['ProductKind'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$pd_kind?'selected':'').'>'.$info['cd_name'].'</option>';?>                      
                </select>
            </div> <!-- box_row -->
            <div class="box_row mt10">
                <span>상품명</span>
                <input type="text" name="pd_name" id="pd_name" class="mWt280" value="<?=$pd_name?>" placeholder="상품명" />

                <span class="ml20">사용여부</span>
                <select name="pd_use" id="pd_use" class="wAuto">
                    <option value="">전체</option>
<?                  foreach(array('Y', 'N') as $k) echo '<option value="'.$k.'" '.($k==$pd_use?'selected':'').'>'.$k.'</option>';?>      
                </select>

                <button type="submit" class="bt_navy ml10">조회</button>

                <div class="po_right">
                    <button type="button" class="bt_black" onclick="popProductFrm();">상품등록</button>
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
    include_once "popProductRegForm.php"; // 상품등록
?>
<script src="<?=JS_DIR?>/category.controller.js"></script>
<script type="text/javascript">
sendSearch();
cateCtr.categorysJS = <?=json_encode($categorysJS)?>;
cateCtr.set();
</script>