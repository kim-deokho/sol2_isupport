
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

                            <span class="ml20">창고</span>
                            <select name="searchSt" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Storage'] as $part) echo '<option value="'.$part['cd_pid'].'">'.$part['cd_name'].'</option>';?>
                            </select>

                            <span class="ml20">상품명</span>
                            <input type="text" name="searchWord" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="adjust_reg();">조정등록</button>
                                <button type="button" class="bt_green ml5" onclick="listExcel()">EXCEL</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
                        </div> <!-- box_row -->
                    </div> <!-- search_box -->
					</form>

                    <div class="table_wrap" id="list_area">

                    </div> <!-- table_wrap -->

					<div class="mResultTablePage mContentWrap" id="paging">

					</div> <!-- mResultTablePage -->
            </section>




        <?
            include_once "pop_adjust_reg.php"; // 조정등록
        ?>


<script type="text/javascript">
var tmpHtml;
var pd_option;
var pt_option;
	$(document).ready(function(){
		//$(".sel2").select2({width: '100%'});
		tmpHtml = $("#p_list tr:eq(0)").clone();
		$("#p_list tr:eq(0)").remove();

		$("body").on("change","select[name='sa_p_kind[]']",function(evnet, pd_pid){
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
			stock = $(this).children("option:selected").attr("stock");

			oi_name = $(this).children("option:selected").text();
			tr.find("input[name='st_qea[]']").val(inputNumberWithComma(stock));
			tr.find("input[name='oi_name[]']").val(oi_name);
			tr.find("input[name='sa_qea[]']").val(0);
			tr.find("input[name='sa_qea[]']").keyup();
		});

		$("body").on("keyup", "input[name='sa_qea[]']", function(){

			tr = $(this).parent().parent();
			st_qea = Number(tr.find("input[name='st_qea[]']").val().replace(/,/g,''));

			pd_pid = tr.find("select[name='pd_pid[]']").val();
			if(pd_pid == '') {
				alert("상품을 선택하세요");
				this.value = '';
				return;
			}

			if(st_qea == '') {
				st_qea = 0;
			}
			sa_qea = Number(this.value.replace(/,/g,''));
			if(sa_qea == '') {
				sa_qea = 0;
			}
			tr.find("input[name='ad_qea[]']").val(inputNumberWithComma(st_qea-sa_qea));
			this.value = inputNumberWithComma(sa_qea);
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
		store = $("#sa_store").val();
		$.ajax({
			data: {mode:'get_oikind', kind:'A', store:store},
			type: "POST",
			url: "/stock/ajax_request",
			cache: false,
			dataType:'html',
			success: function(res) {
				pd_option = res;
			}
		});

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

	function add_tr(sa_p_kind, pd_pid){
		//cnt = $("#p_list tr").length - 1;
		cnt = $("#p_list tr").length;
		html = tmpHtml;
		html.find("input[type='text']").val("");
		html.find("select[name='sa_p_kind[]']").val(sa_p_kind);
		html.find("input[type='hidden']").val("");
		$("#p_list:last").append(html);
		cnt = $("#p_list tr").length-1;
		tmpHtml = $("#p_list tr:eq("+cnt+")").clone();
		tr = $("#p_list tr:eq("+cnt+")");
		tr.find("select[name='sa_p_kind[]']").trigger('change',pd_pid);


	}

	function adjust_check(f) {
		check = true;
		$("select[name='pd_pid[]']").each(function(){
			if(this.value != "") {
				check = false;
			}
		});

		if(check) {
			alertBox("조정등록할 상품/부품은 1개이상 존재 해야 합니다.");
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

sendSearch();
    // 조정등록
    function adjust_reg(){
		add_tr('A','')
        pop_modal('pop_adjust_reg');

    }
</script>