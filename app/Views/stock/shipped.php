
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>
					<form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
                    <div class="search_box">
                        <div class="box_row">
                            <span>출고일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span class="ml20">거래처</span>
                            <select name="searchCt" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['trader'] as $b_row) echo '<option value="'.$b_row['ct_pid'].'">'.$b_row['ct_name'].'</option>';?>
                            </select>

                            <span class="ml20">유형</span>
                            <select name="searchKind2" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['so_state'] as $k=>$v) echo '<option value="'.$k.'">'.$v.'</option>';?>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>구분</span>
                            <select name="searchPkind" class="wAuto">
                                <option value="">전체</option>
								<option value="A">상품</option>
								<option value="B">부품</option>
                            </select>

                            <span class="ml20">창고</span>
                            <select name="searchSt" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="shipped_reg();">출고등록</button>
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
            include_once "pop_shipped_reg.php"; // 입고등록
        ?>


<script type="text/javascript">
	$(document).ready(function(){
		//$(".sel2").select2({width: '100%'});
		tmpHtml = $("#p_list tr:eq(0)").clone();


		$.ajax({
			data: {mode:'get_oikind', kind:'A'},
			type: "POST",
			url: "/stock/ajax_request",
			cache: false,
			dataType:'html',
			success: function(res) {
				pd_option = res;
			}
		});

		$.ajax({
			data: {mode:'get_oikind', kind:'B'},
			type: "POST",
			url: "/stock/ajax_request",
			cache: false,
			dataType:'html',
			success: function(res) {
				pt_option = res;
			}
		});


		$("select[name='sch_pkind']").on("change",function(){
			tr = $(this).parent().parent();
			tr.find(".select2").remove();
			if($(this).val() == 'A') {
				option = pd_option;
			} else {
				option = pt_option;
			}
			$("select[name='sch_pid']").html(option);
			$("select[name='sch_pid']").select2({width: '80%'});

		});


		sendSearch();
		setTimeout(function(){$("select[name='sch_pkind']").change();},1000);

	}
	);

    // 출고등록
    function shipped_reg(si_num, si_store, si_date){
		var si_num = si_num || "";
		setFormData('regFrm');
		$("#si_num").val('');
		$("input[name='mode']").val('reg_wear');
		$("#p_list").empty();
		$("select[name='sch_pkind']").val('A');
		$("select[name='sch_pkind']").change();
		$("input[name='si_date']").prop("disabled", false);
		$("select[name='si_kind2']").prop("disabled", false);
		$("select[name='sch_pid']").prop("disabled", false);
		$("select[name='si_store']").prop("disabled", false);
		if(si_num) {
			$("#si_num").val(si_num);
			$("input[name='si_date']").val(si_date);
			$("select[name='si_store']").val(si_store);
			sch_chagne(si_num);
			$("input[name='si_in_date']").prop("disabled", true);
			$("select[name='si_kind2']").prop("disabled", true);
			$("select[name='sch_pid']").prop("disabled", true);
			$("select[name='si_store']").prop("disabled", true);

		}
        pop_modal('pop_shipped_reg');
    }

	function sch_chagne(si_num) {
		var si_num = si_num || '';

		if(si_num == '' && $("select[name='sch_pid']").val() == '') {
			return;
		}

		if($("select[name='si_kind2']").val() == 'A') {
			$("#p_list").empty();
		}

		if($("select[name='si_store']").val() == '') {
			alertBox("창고를 먼저 선택해 주세요");
			$('#sch_pid').val('').trigger('change');
			return;
		}

		$.ajax({
			data: {mode:'get_waer_data', sch_pkind:$("select[name='sch_pkind']").val(), sch_pid:$("select[name='sch_pid']").val(), si_num:si_num, kind:'B',si_store:$("select[name='si_store']").val()},
			type: "POST",
			url: "/stock/ajax_request",
			cache: false,
			dataType:'html',
			success: function(res) {
				//console.log(res)
				$('#p_list').append(res);
			}
		});
	}

	function row_del(obj) {

		if(obj.pid) {
			$("input[name='mode']").val('del_wear');
			$("#regFrm")[0].submit();

			return;
		}
		//console.log(obj);
		$(obj.tr).remove();

	}

	function delete_ok() {
		alertBox("삭제 되었습니다.", sendSearch);
		$(".pop_close").click();

	}

	function wear_check(f) {


		if($("#p_list tr").length == 0) {
			alertBox("출고 상품이 없습니다.");
			return;
		}
		//return false;
		f.submit();
	}
</script>