
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>
					<form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
                    <div class="search_box">
                        <div class="box_row">
                            <span>발주일</span>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span class="ml20">발주처</span>
                            <select name="searchCt" class="wAuto">
                                <option value="">전체</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>발주상태</span>
                            <select name="searchState" class="wAuto">
                                <option value="">전체</option>
								<?foreach($state as $k =>$v) echo '<option value="'.$k.'">'.$v.'</option>';?>
                            </select>

                            <span class="ml20">발주자</span>
                            <select name="searchMn" class="wAuto">
                                <option value="">전체</option>
								<?foreach($manager as $part) echo '<option value="'.$part['mn_pid'].'">'.$part['mn_name'].'</option>';?>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black js-save-btn" onclick="purchase_reg();">발주등록</button>
                                <button type="button" class="bt_green ml5 js-excel-btn" onclick="listExcel()">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->

                    </div> <!-- search_box -->
					</form>
                    <div class="table_wrap" id="list_area">

                    </div> <!-- table_wrap -->

					<div class="mResultTablePage mContentWrap"  id="paging">

					</div> <!-- mResultTablePage -->
                </div> <!-- contents -->
            </section>




        <?
            include_once "pop_purchase_reg.php"; // 발주등록
            include_once "pop_purchase_cancel.php"; // 발주취소
        ?>


<script type="text/javascript">
var tmpHtml;
var pd_option;
var pt_option;
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


		$("body").on("change","select[name='oi_kind[]']",function(evnet, pd_pid){
			pd_pid = pd_pid || "";
			tr = $(this).parent().parent();
			option = $(this).val() == 'A' ? pd_option : pt_option;
			p_name = tr.find("select[name='pd_pid[]']");
			console.log(p_name);
			tr.find(".select2").remove();
			tr.find("select[name='pd_pid[]'] option").remove();
			p_name.html(option);
			$(p_name).val(pd_pid);
			tr.find("select[name='pd_pid[]']").select2({width: '100%'});


		});

		$("body").on("change","select[name='pd_pid[]']",function(){
			tr = $(this).parent().parent();
			in_price = $(this).children("option:selected").attr("in_price");
			oi_name = $(this).children("option:selected").text();
			tr.find("input[name='oi_in_price[]']").val(inputNumberWithComma(in_price));
			tr.find("input[name='oi_name[]']").val(oi_name);

		});

		$("body").on("click",".io_del",function(){
			cnt = $("#p_list tr").length;

			if(cnt == 1) {
				alertBox("발주하는 상품/부품은 1개이상 존재 해야 합니다.");
				return;
			}
			tr = $(this).parent().parent();

			confirmBox("삭제 하시겠습니까?", row_del, {tr:tr});
		});

		sendSearch();
	}
	);

	function add_tr(oi_kind, pd_pid){
		//cnt = $("#p_list tr").length - 1;
		cnt = $("#p_list tr").length;
		html = tmpHtml;
		html.find("input[type='text']").val("");
		html.find("select[name='oi_kind[]']").val(oi_kind);
		html.find("input[type='hidden']").val("");
		$("#p_list:last").append(html);
		cnt = $("#p_list tr").length-1;
		tmpHtml = $("#p_list tr:eq("+cnt+")").clone();
		tr = $("#p_list tr:eq("+cnt+")");
		tr.find("select[name='oi_kind[]']").trigger('change',pd_pid);


	}

	function purchase_check(f) {
		io_check = true;
		$("select[name='pd_pid[]']").each(function(){
			if(this.value != "") {
				io_check = false;
			}
		});

		if(io_check) {
			alertBox("발주하는 상품/부품은 1개이상 존재 해야 합니다.");
			return;
		}
		//return false;
		f.submit();
	}

	function row_del(obj) {
		pid = $(obj.tr).find("input[name='oi_pid[]']").val();
		if(pid) {
			$.ajax({
				data: {mode:'item_del', oi_pid:pid},
				type: "POST",
				url: "/stock/ajax_request",
				cache: false,
				dataType:'json',
				success: function(res) {
					pt_option = res;
				}
			});
		}
		console.log(pid);
		$(obj.tr).remove();
	}


    // 발주등록
    function purchase_reg(pid){
		var pid = pid || '';


		$("#p_list").empty();
		add_tr('A');
		if(pid == '') {
			$("input[name='io_pid']").val('');
		} else {
			gcUtil.loader();
			$.ajax({
				data: {mode:'get_purchase', pid:pid},
				type: "POST",
				url: "/stock/ajax_request",
				cache: false,
				dataType:'json',
				success: function(resJson) {
					gcUtil.loader('hide');
					 console.log('res', resJson);
					if(!resJson.io_pid) {
						alertBox('발주정보를 가져오는데 실패했습니다.');
					}
					else {
						setFormData('regFrm', resJson);
						$("#p_list").empty();
						for(var k in resJson.item) {

							add_tr(resJson.item[k].oi_kind, resJson.item[k].pd_pid);

							//console.log(resJson.item[k].oi_qea);
							html = $("#p_list tr:eq("+k+")");
							html.find("select[name='pd_pid[]']").val(resJson.item[k].pd_pid);
							//html.find("select[name='pd_pid[]']").select2().select2('val',resJson.item[k].pd_pid);
							html.find("input[name='oi_pid[]']").val(resJson.item[k].oi_pid);
							html.find("input[name='oi_name[]']").val(resJson.item[k].oi_name);
							html.find("input[name='oi_qea[]']").val(inputNumberWithComma(resJson.item[k].oi_qea));
							html.find("input[name='oi_in_price[]']").val(inputNumberWithComma(resJson.item[k].oi_in_price));
							html.find("input[name='oi_real_in_price[]']").val(inputNumberWithComma(resJson.item[k].oi_real_in_price));
						}
					}
				}
			});
		}
        pop_modal('pop_purchase_reg');
    }

    // 발주취소
    function purchase_cancel(pid, pd_pid, pd_name){
		$("#regForm2 input[name='oi_pid']").val(pid);
		$("#regForm2 input[name='pd_pid']").val(pd_pid);
		$("#regForm2 input[name='oic_pd_name']").val(pd_name);
		$("#pd_name").html(pd_name);
        pop_modal('pop_purchase_cancel');
    }
</script>