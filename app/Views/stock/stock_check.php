
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>
					<form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
                    <div class="search_box">
                        <div class="box_row">
                            <span>실사일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span class="ml20">창고</span>
                            <select name="searchSt" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="check_reg();">실사등록</button>
                                <!-- <button type="button" class="bt_green ml5" onclick="listExcel()">EXCEL</button> -->
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




        <?
            include_once "pop_check_reg.php"; // 실사등록
			include_once "pop_check_list.php"; // 실사내역
        ?>


<script type="text/javascript">

sendSearch();

	function real_check(f) {
		if($("select[name='sr_store']").val() == '') {
			alertBox('창고를 선택하세요');
			return;
		}

		if($("input[name='file_stock_excel']").val() == '') {
			alertBox('실사재고자료 엑셀을 선택하세요');
			return;
		}
		pd_cate = $("#pd_cate").multipleSelect("getSelects",'text');
		pt_cate = $("#pt_cate").multipleSelect("getSelects",'text');
		f.sr_pd_cate.value = pd_cate;
		f.sr_pt_cate.value = pt_cate;

		f.submit();
	}

	function ex_down() {
		if($("select[name='sr_store']").val() == '') {
			alertBox('창고를 선택하세요');
			return;
		}
		pd_cate = $("#pd_cate").multipleSelect("getSelects");
		pt_cate = $("#pt_cate").multipleSelect("getSelects");
		if(pd_cate == '' && pt_cate == '') {
			alertBox('카테고리를 선택하세요');
			return;
		}

		f = document.forms['regFrm'];

		f.mode.value = "real_excel";
		f.submit();
		f.mode.value = "reg_check";
	}
    // 실사등록
    function check_reg(){
        pop_modal('pop_check_reg');
    }

	function view_item(pid) {
		var pid = pid || "";
		gcUtil.loader('show');
		$.ajax({
			data: {sr_pid:pid},
			type: "POST",
			url: "stock_check_item",
			cache: false,
			dataType:'json',
			success: function(resJson) {
				 console.log(resJson);
				gcUtil.loader('hide');
				$('#i_list').html(resJson.html);
				pop_modal('pop_check_list');
				$("input[name='sr_pid']").val(pid);

			}
		});
	}


</script>