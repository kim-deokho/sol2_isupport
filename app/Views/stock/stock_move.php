
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

					<form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
                    <div class="search_box">
                        <div class="box_row">
                            <span>등록일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>보낸창고</span>
                            <select name="searchStO" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">받는창고</span>
                            <select name="searchStI" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="move_reg();">이동등록</button>
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
            include_once "pop_move_reg.php"; // 이동등록
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

    // 이동등록
    function move_reg(sm_num, out_store, in_store, r_date){
		var sm_num = sm_num || "";
		setFormData('regFrm');
		$("#sm_num").val('');
		$("input[name='mode']").val('reg_move');
		$("#p_list").empty();
		$("select[name='sch_pkind']").val('A');
		$("select[name='sch_pkind']").change();
		$("select[name='sch_pid']").prop("disabled", false);
		$("select[name='sm_out_store']").prop("disabled", false);
		$("select[name='sm_in_store']").prop("disabled", false);
		if(sm_num) {
			$("#sm_num").val(sm_num);
			$("input[name='r_date']").val(r_date);
			$("select[name='sm_out_store']").val(out_store);
			$("select[name='sm_in_store']").val(in_store);
			sch_chagne(sm_num);
			$("input[name='r_date']").prop("disabled", true);
			$("select[name='sch_pkind']").prop("disabled", true);
			$("select[name='sch_pid']").prop("disabled", true);
			$("select[name='sm_out_store']").prop("disabled", true);
			$("select[name='sm_in_store']").prop("disabled", true);

		}
        pop_modal('pop_move_reg');
    }

	function sch_chagne(sm_num) {
		var sm_num = sm_num || '';

		if(sm_num == '' && $("select[name='sch_pid']").val() == '') {
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
			data: {mode:'get_waer_data', sch_pkind:$("select[name='sch_pkind']").val(), sch_pid:$("select[name='sch_pid']").val(), sm_num:sm_num,si_store:$("select[name='sm_out_store']").val()},
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
			$("input[name='del_sm_pid']").val(obj.pid);
			$("input[name='mode']").val('del_move');
			$("#regFrm")[0].submit();
			$("input[name='mode']").val('reg_move');
		}
		//console.log(obj);
		$(obj.tr).remove();

	}

	function delete_ok() {

		if($("#p_list tr").length == 0) {
			alertBox("모든 상품이 삭제 되었습니다.", sendSearch);
			$(".pop_close").click();
		}

	}

	function move_check(f) {


		if($("#p_list tr").length == 0) {
			alertBox("이동 상품이 없습니다.");
			return;
		}
		//return false;
		f.submit();
	}

	function move_confrim(data) {
		obj = data.split(/,/g);
		$.ajax({
			data: {mode:'move_in', kind:obj[0], sm_num:obj[1]},
			type: "POST",
			url: "/stock/execute",
			cache: false,
			dataType:'json',
			success: function(res) {
				//console.log(res)
				$('#p_list').append(res);
			}
		});
	}

</script>