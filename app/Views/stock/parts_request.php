
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
					<div class="search_box">
                        <div class="box_row">
                            <span>요청일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span class="ml20">창고</span>
                            <select name="searchSt" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">상태</span>
                            <select name="searchState" class="wAuto">
                                <option value="">전체</option>
								<option value="A">요청</option>
								<option value="B">완료</option>
								<option value="C">취소</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>요청자</span>
                            <select name="searchMn" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['manager'] as $mn) echo '<option value="'.$mn['mn_pid'].'" >'.$mn['mn_name'].'</option>';?> ?>
                            </select>

                            <span class="ml20">부품명</span>
                            <select  name="cate1" id="cate1" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 1)">
                                <option value="">전체</option>
								<?foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'" '.($code==$cate1?'selected':'').'>'.$cate['name'].'</option>';?>
                            </select>
                            <select  name="cate2" id="cate2" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 2)">
                                <option value="">전체</option>
                            </select>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1);">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="request_reg();">부품요청</button>
                                <button type="button" class="bt_red" onclick="request_cancel();">요청취소</button>
                                <button type="button" class="bt_green ml5" onclick="listExcel()">EXCEL</button>
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
            include_once "pop_request_reg.php"; // 부품요청
            include_once "pop_request_proc.php"; // 요청처리
        ?>
<script src="<?=JS_DIR?>/category.controller.js"></script>

<script type="text/javascript">
var tmpHtml;
var pd_option;
var pt_option;
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.set();
	$(document).ready(function(){
		//$(".sel2").select2({width: '100%'});
		tmpHtml = $("#p_list tr:eq(0)").clone();
		$("#p_list tr:eq(0)").remove();



		$("body").on("change","select[name='pt_pid[]']",function(){
			tr = $(this).parent().parent();
			stock = $(this).children("option:selected").attr("stock");

			pt_name = $(this).children("option:selected").text();
			tr.find("input[name='st_qea[]']").val(inputNumberWithComma(stock));
			tr.find("input[name='pt_name[]']").val(pt_name);

		});



		$("body").on("click",".sa_del",function(){
			cnt = $("#p_list tr").length;

			tr = $(this).parent().parent();

			confirmBox("삭제 하시겠습니까?", row_del, {tr:tr});
		});

		option_setting();
	}
	);

	function option_setting() {
		store = $("#pi_store").val();


		$.ajax({
			data: {mode:'get_oikind', kind:'B', store:store},
			type: "POST",
			url: "/stock/ajax_request",
			cache: false,
			dataType:'html',
			success: function(res) {
				pt_option = res;
			}
		});
	}

	function add_tr(){
		//cnt = $("#p_list tr").length - 1;
		cnt = $("#p_list tr").length;
		html = tmpHtml;
		html.find("input[type='text']").val("");

		html.find("input[type='hidden']").val("");
		$("#p_list:last").append(html);
		cnt = $("#p_list tr").length-1;
		tmpHtml = $("#p_list tr:eq("+cnt+")").clone();
		tr = $("#p_list tr:eq("+cnt+")");

		p_name = tr.find("select[name='pt_pid[]']");
		tr.find(".select2").remove();
		tr.find("select[name='pt_pid[]'] option").remove();
		p_name.html(pt_option);
		tr.find("select[name='pt_pid[]']").select2({width: '100%'});


	}

	function adjust_check(f) {
		check = true;
		$("select[name='pt_pid[]']").each(function(){
			if(this.value != "") {
				check = false;
			}
		});

		if(check) {
			alertBox("부품은 1개이상 존재 해야 합니다.");
			return;
		}
		//return false;
		f.submit();
	}

	function row_del(obj) {
		$(obj.tr).remove();
	}

	function request_cancel() {
		cnt = $("input[name='pi_pid[]']:checked").length;
		if(cnt == 0) {
			alertBox("선택된 요청이 없습니다.");
			return;
		}

		f = document.forms['requestFrm'];
		f.submit();
	}

sendSearch();
    // 부품요청
    function request_reg(){
		$("#p_list ").empty();
		add_tr();
        pop_modal('pop_request_reg');
    }

    // 요청처리
    function request_proc(pid){
		$.ajax({
			data: {mode:'get_re_item', pi_pid:pid},
			type: "POST",
			url: "/stock/ajax_request",
			cache: false,
			dataType:'html',
			success: function(res) {
				$("#pi_pid").val(pid);
				$("#r_list").html(res);
				pop_modal('pop_request_proc');
			}
		});

    }
</script>