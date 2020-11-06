
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
					<div class="search_box">
                        <div class="box_row">
                            <span>폐기일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span class="ml20">창고</span>
                            <select name="searchSt" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">처리자</span>
                            <select name="searchMn" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['manager'] as $mn) echo '<option value="'.$mn['mn_pid'].'" >'.$mn['mn_name'].'</option>';?> ?>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>부품명</span>
                             <select  name="cate1" id="cate1" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 1)">
                                <option value="">전체</option>
								<?foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'" '.($code==$cate1?'selected':'').'>'.$cate['name'].'</option>';?>
                            </select>
                            <select  name="cate2" id="cate2" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 2)">
                                <option value="">전체</option>
                            </select>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_red" onclick="">폐기취소</button>
                                <button type="button" class="bt_green ml5" onclick="">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
					</form>

                    <div class="table_wrap" id="list_area">

                    </div> <!-- table_wrap -->

					<div class="mResultTablePage mContentWrap" id="paging">

					</div> <!-- mResultTablePage -->
                </div> <!-- contents -->
            </section>




<script src="<?=JS_DIR?>/category.controller.js"></script>

<script type="text/javascript">
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.set();
sendSearch();
</script>