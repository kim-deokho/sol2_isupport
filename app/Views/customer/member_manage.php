
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <form name="msf" id="msf" onsubmit="serch_member();return false;" >
					<input type='hidden' name="mode" value='serch_member'>
					<div class="search_box mt10">
                        <div class="box_row">
                            <span class="row2_span">고객검색</span>
                            <div class="row2_div">
                                <div>
                                    <select name="searchKey[]" class="multi_select" style="width:auto"  id="searchKey" multiple="multiple" required>
                                        <option value="mb_name" selected>이름</option>
										<option value="concat(mb_tel1,mb_tel2,mb_tel3)" selected>전화번호</option>
										<option value="concat(mb_addr,mb_addr2)">주소</option>
										<option value="mb_code">코드</option>
                                    </select>
                                    <input type="text" name="searchWord" class="mWt300" value="" placeholder="검색어" required />
									<span>휴먼포함</span>
                            <label class="chkWrap"><input type="checkbox" name="searchDormant" value="Y" /><i></i></label>
                                    <button type="submit" class="bt_navy ml10" onclick="">조회</button><br />
                                </div>

                                <div class="mt5">
                                    <select name="mem_sel" id="mem_sel" class="mWt700" onchange="change_mem();">
                                        <option value="">== ↓ 밑의 해당 고객을 선택하세요. ==</option>
                                    </select>
                                </div>
                            </div> <!-- row2_div -->

                            <div class="po_right mt13">
                                <button type="button" class="bt_150_40 bt_black" onclick="member_reg();">신규회원등록</button>
                            </div> <!-- po_right // 오른쪽 버튼 -->
						</div> <!-- box_row -->
                    </div> <!-- search_box -->
					</form>

                    <div class="m_manage_wrap">

                        <div class="mm_left_con">
						<form name="mem_reg2" id="mem_reg2" method="post" action="execute" onsubmit="check_mem_modify(this);return false;" target="hiddenFrame">
						<input type="hidden" name="mb_pid" id="mb_pid" value="" >
						<input type="hidden" name="mode" value="reg_member">
                            <div class="title_2 mb5">
                                <div>
                                    고객기본정보
                                    <button type="submit" class="bt_black ml10 d_none mem_load" onclick="" >저장</button>
                                </div>

                                <div>
                                    <button type="button" class="bt_gray ml5  d_none mem_load" onclick="adress_reg();">배송지등록</button>
                                    <button type="button" class="set_button ml5 d_none mem_load" onclick="order_reg();">주문등록</button>
                                </div>
                            </div> <!-- title_2 -->

                            <div class="table_wrap mem_info">
                                <!-- 휴면계정일경우 시작 -->
                                <div class="dormant_wrap d_none"  onclick="confirmBox('휴면계정을 복구 하시겠습니까?',dormant_change);">
                                    <div class="dormant_bg"></div>
                                    <div class="dormant_text">휴면계정 입니다.</div>
                                </div> <!-- dormant_wrap -->
                                <!-- 휴면계정일경우 끝 -->

                                <table class="itable_1">
									<tbody>
										<tr>
											<th class="mWt70">이름</th>
											<td class=""><input type="text" name="mb_name" id="mb_name" class="mWt120" value="" required /></td>
											<th class="mWt70">고객코드</th>
											<td><input type="text"  id="mb_code" class="mWt120" value="" readonly /></td>
											<th class="mWt70">등록일</th>
											<td class=""><input type="text"  id="reg_date" class="mWt100" value="" readonly /></td>
										</tr>
										<tr>
											<th>전화1</th>
											<td>
												<input type="text" name="mb_tel1" id="mb_tel1" class="mWt120" value="" required/>
												<input type="text" name="mb_fm1" id="mb_fm1" class="mWt50" value="" />
											</td>
											<th>담당자</th>
											<td id=''></td>
											<th>수정일</th>
											<td><input type="text"  id="up_date" class="mWt100" value="" readonly /></td>
										</tr>
										<tr>
											<th>전화2</th>
											<td>
												<input type="text" name="mb_tel2" id="mb_tel2" class="mWt120" value="" />
												<input type="text" name="mb_fm2" id="mb_fm2" class="mWt50" value="" />
											</td>
											<th>회원등급</th>
											<td>
												<select name="ml_pid" class="mWt120">
													<option value="">VIP</option>
												</select>
												<label class="chkWrap"><input type="checkbox" name="ml_noauto" value="Y" /><i></i><span>수동</span></label>
											</td>
											<th>적립금</th>
											<td>
												<span class="vam_dib mWt120">345,000</span>
												<button type="button" class="bt_gray" onclick="">보기</button>
											</td>
										</tr>
										<tr>
											<th>전화3</th>
											<td>
												<input type="text" name="mb_tel3" class="mWt120" value="" />
												<input type="text" name="mb_fm3" class="mWt50" value="" />
											</td>
											<th>최종통화일</th>
											<td id='mb_last_tel_date'>2020-02-01 12:33</td>
											<th>상품권</th>
											<td>
												<span class="vam_dib mWt120">3개</span>
												<button type="button" class="bt_gray" onclick="">보기</button>
											</td>
										</tr>
										<tr>
											<th rowspan="2">수신동의</th>
											<td rowspan="2" colspan="3">
												<div>
													<label class="chkWrap"><input type="checkbox" name="mb_info_agree" id="mb_info_agree" value="Y" /><i></i><span>개인정보</span></label>(<span id='mb_info_agree_date'></span>)
													<label class="chkWrap ml20"><input type="checkbox" name="mb_sms_agree" id="mb_sms_agree" value="Y" /><i></i><span>문자</span></label>(<span id='mb_sms_agree_date'></span>)
													<br><br>
													<label class="chkWrap "><input type="checkbox" name="mb_email_agree" id="mb_email_agree" value="Y" /><i></i><span>메일</span></label>(<span id='mb_email_agree_date'></span>)
													<label class="chkWrap ml20"><input type="checkbox" name="mb_tel_agree" id="mb_tel_agree" value="Y" /><i></i><span>전화(마케팅)</span></label>(<span id='mb_tel_agree_date'></span>)
												</div>

											</td>
											<th>예치금</th>
											<td>
												<span class="vam_dib mWt120">552,000</span>
												<button type="button" class="bt_gray" onclick="">보기</button>
											</td>
										</tr>
										<tr>
											<th>탈퇴여부</th>
											<td>
												<div>
													<label class="chkWrap"><input type="checkbox" name="mb_dormant" value="Y" /><i></i><span>휴면</span></label>(<span id='mb_dormant_date'></span>)
													<label class="chkWrap ml20"><input type="checkbox" name="mb_withdrawal" value="Y" /><i></i><span>탈퇴</span></label>(<span id='mb_withdrawal_date'></span>)
												</div>

											</td>
										</tr>
										<tr>
											<th>주소</th>
											<td colspan="5">
												<div>
													<input type="text" name="mb_post" id="mb_post" class="mWt80" value="" placeholder="우편번호" />
													<button type="button" class="bt_white_bor" onclick="pop_post('mb_post','mb_addr','mb_addr2')">주소찾기</button>
												</div>
												<div class="mt7">
													<input type="text" name="mb_addr" id="mb_addr" class="mWt45p" value="" placeholder="기본주소" />
													<input type="text" name="mb_addr2" id="mb_addr2" class="mWt45p" value="" placeholder="상세주소"  />
												</div>
											</td>
										</tr>
										<tr>
											<th>가입경로</th>
											<td>
												<select name="" class="wAuto">
													<option value="">온라인광고</option>
												</select>
											</td>
											<th>이메일</th>
											<td><input type="text" name="" class="" value="" /></td>
											<th>생년월일</th>
											<td><input type="text" name="" class="date mWt100" value="" /></td>
										</tr>
										<tr>
											<th>회원구분</th>
											<td colspan="5">
												<label class="radioWrap"><input type="radio" name="mb_kind" value="A" checked /><i></i><span>개인회원</span></label>
												<label class="radioWrap ml30"><input type="radio" name="mb_kind" value="B"  /><i></i><span>기업회원</span></label>
												<select name="ct_pid" id="ct_pid" class="wAuto">
													<option value="">거래처 설정</option>
													<?foreach($setting['customer'] as $row ) echo '<option value="'.$row['ct_pid'].'">'.$row['ct_name'].'</option>'?>
												</select>
												<span class="vam_dib ml20">※ 세금계산서 발행의 경우, 기업회원으로 설정하세요.</span>
											</td>
										</tr>
										<tr>
											<th>일반메모</th>
											<td colspan="3"><textarea name="mb_memo" id="mb_memo" class="txa_base"></textarea></td>
											<th>관리자메모</th>
											<td><textarea name="mb_admin_memo" id="mb_admin_memo" class="txa_base"></textarea></td>
										</tr>
									</tbody>
								</table> <!-- itable_1 -->
                            </div> <!-- table_Wrap -->
							</form>
                        </div> <!-- mm_left_con -->

                        <div class="mm_right_con">
                            <form name="cfm" id="cfm" method="post" action="execute" onsubmit="check_coun(this);return false;" target="hiddenFrame">
							<input type="hidden" name="mb_pid">
							<input type="hidden" name="mode" value="reg_cuon">
							<div class="title_2">
                                <div>상담관리</div>

                                <div>
                                    <button type="button" class="set_button d_none mem_load" onclick="as_reg();">AS등록</button>
                                    <button type="button" class="bt_gray ml5 d_none mem_load" onclick="coun_his()">상담내역</button>
                                </div>
                            </div> <!-- title_2 -->

                            <div class="table_wrap">
                                <table class="itable_1">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select name="mc_tel" class="mc_tel wAuto" required>

                                                </select>

                                                <select name="mc_kind1" class="wAuto" required>
													<option value="">전화종류</option>
                                                <?foreach($setting['code']['Counkind1'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
                                                </select>
                                                <select name="mc_kind2" class="wAuto" required>
													<option value="">상담종류</option>
                                                <?foreach($setting['code']['Counkind2'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
                                                </select>
                                                <select name="mc_kind3" class="wAuto">
                                                    <option value="A">미처리</option>
                                                    <option value="B">처리중</option>
                                                    <option value="C">처리완료</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><textarea name="mc_contents" class="mem_txa" required></textarea></td>
                                        </tr>
                                    </tbody>
                                </table> <!-- itable_1 -->
								<div class="buttonCenter mt10">
									<button type="submit" class="bt_100p_40 bt_black d_none mem_load" onclick="">저장</button>
								</div> <!-- buttonCenter -->
                            </div> <!-- table_Wrap -->
							</form>
                        </div> <!-- mm_right_con -->
                    </div> <!-- m_manage_wrap -->

                    <div class="tab_wrap mt10">
                        <div class="tab_base">
                            <a href="#m_tab1" title="m_tab1" id="a_t1" class="active">주문내역</a>
                            <a href="#m_tab2" title="m_tab2" id="a_t2">상담내역</a>
                            <a href="#m_tab3" title="m_tab3" id="a_t3">취소내역</a>
                            <a href="#m_tab4" title="m_tab4" id="a_t4">반품/교환내역</a>
                            <a href="#m_tab5" title="m_tab5" id="a_t5">환불내역</a>
                            <a href="#m_tab6" title="m_tab6" id="a_t6">AS내역</a>
                            <a href="#m_tab7" title="m_tab7" id="a_t7">미수금내역</a>
                        </div> <!-- tab_base -->

                        <div id="m_tab1" class="tab_base_con t_block">
                            <?
                                include_once "mem_tab_1.php"; // 주문내역
                            ?>
                        </div> <!-- m_tab1 / tab_base_con -->

                        <div id="m_tab2" class="tab_base_con">
                            <?
                                include_once "mem_tab_2.php"; // 상담내역
                            ?>
                        </div> <!-- m_tab2 / tab_base_con -->

                        <div id="m_tab3" class="tab_base_con">
                            <?
                                include_once "mem_tab_3.php"; // 취소내역
                            ?>
                        </div> <!-- m_tab3 / tab_base_con -->

                        <div id="m_tab4" class="tab_base_con">
                            <?
                                include_once "mem_tab_4.php"; // 반품/교환내역
                            ?>
                        </div> <!-- m_tab4 / tab_base_con -->

                        <div id="m_tab5" class="tab_base_con">
                            <?
                                include_once "mem_tab_5.php"; // 환불내역
                            ?>
                        </div> <!-- m_tab5 / tab_base_con -->

                        <div id="m_tab6" class="tab_base_con">
                            <?
                                include_once "mem_tab_6.php"; // AS내역
                            ?>
                        </div> <!-- m_tab6 / tab_base_con -->

                        <div id="m_tab7" class="tab_base_con">
                            <?
                                include_once "mem_tab_7.php"; // 미수금내역
                            ?>
                        </div> <!-- m_tab7 / tab_base_con -->
                    </div> <!-- tab_wrap -->

                </div> <!-- contents -->
            </section>
		</div> <!-- container -->

	<?
        include_once "../common/inc/footer.php"; // footer
	?>

        <?
		    include_once "pop_member_reg.php"; // 신규회원등록
            include_once "pop_order_reg.php"; // 주문등록
            include_once "pop_order_cancel.php"; // 취소요청
            include_once "pop_order_return.php"; // 반품요청
            include_once "pop_order_exchange.php"; // 교환요청
            include_once "pop_as_reg.php"; // as등록
            include_once "pop_coun_his.php"; // 상담내역
            include_once "pop_adress_reg.php"; // 배송지등록
            include_once "pop_adress_list.php"; // 배송지선택
            include_once "pop_bankbook_reg.php"; // 무통장 입력
            include_once "pop_card_reg.php"; // 카드 입력
        ?>
	</body>
</html>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=JS_DIR?>/daum.post.ctr.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.js-single-selector').select2();
    });
    var categorys = <?=json_encode($categorys)?>;
    var customer = <?=json_encode($setting['customer'])?>;
	function serch_member() {
		$.ajax({
			url : 'ajax_request',
			data : $("#msf").serialize(),
			type: "POST",
			cache: false,
			dataType:'html',
			success: function(res) {
				$('#mem_sel').html(res);
				cnt = $('#mem_sel option').length;

				if(cnt == 2) {
					$("#mem_sel option:eq(1)").prop("selected", true);
					change_mem();
				}
			}
		});

		return false;
	}

	function dormant_change() {
		f = document.forms['mem_reg2'];
		f.mode.value = 'dormant_change';
		f.submit();
		f.mode.value = 'reg_member';

		return false;
	}

	function change_mem() {
		$(".mem_load").addClass("d_none")
		$(".dormant_wrap").addClass("d_none");
		$("#cfm")[0].reset();
		$("#cfm2")[0].reset();
		mb_pid = $('#mem_sel').val();
		$.ajax({
			url : 'ajax_request',
			data : {mode:'mem_sel',mb_pid:mb_pid},
			type: "POST",
			cache: false,
			dataType:'json',
			success: function(res) {
				if(res.mb_dormant == 'Y') {
					$(".dormant_wrap").removeClass("d_none");
					setFormData("mem_reg2");
					$("#mem_reg2 input[name='mb_pid']").val(res.mb_pid);
				} else if(res.mb_pid){
					setFormData("mem_reg2",res);
					$(".mem_load").removeClass("d_none");

					$(" input[name='mb_pid']").val(res.mb_pid);
					$(".mc_tel option").remove();

					if(res.mb_tel1 != "") {
						$(".mc_tel").append('<option value="'+res.mb_tel1+'">전화1</option>');
					}
					if(res.mb_tel2 != "") {
						$(".mc_tel").append('<option value="'+res.mb_tel2+'">전화2</option>');
					}
					if(res.mb_tel3 != "") {
						$(".mc_tel").append('<option value="'+res.mb_tel3+'">전화3</option>');
					}
				} else {
					setFormData("mem_reg2",res);
				}
			}
		});
	}

	function pop_post(post_id, addr_id, addrDetail_id) {
		daumPost.post_id = post_id;
		daumPost.addr_id = addr_id;
		daumPost.addrDetail_id = addrDetail_id;
		daumPost.addrExtra_id = addrDetail_id;
		daumPost.pop();
	}

	function check_mem_modify(f) {
		if(f.mb_pid.value == '') {
			alertBox('회원을 선택해 주세요');
			return;
		}

		f.submit();
	}

	function check_coun(f) {
		f.submit();
	}
    // 신규회원등록
    function member_reg(){
        pop_modal('pop_member_reg');
    }

    // 배송지등록
    function adress_reg(callback){
        list_dely(callback);
		pop_modal('pop_adress_reg', callback ? 'N' : 'Y');
    }

	//배송지 목록
	function list_dely(callback) {

		$("#bsf")[0].reset();
        $("#dy_pid").val('');
        var dataParams ={mode:'dely_list',mb_pid:$("input[name='mb_pid']").val()};
        if(callback) {
            dataParams.order='Y';
            dataParams.callback=callback;
        }
        console.log(callback, dataParams);
		gcUtil.loader('show', '#pop_dlist_area');
		$.ajax({
			data: dataParams,
			type: "POST",
			url: 'ajax_request',
			cache: false,
			dataType:'json',
			success: function(resJson) {
				// console.log(resJson);
				gcUtil.loader('hide', '#pop_dlist_area');
				$('#pop_dlist_area').html(resJson.html);

			}
		});
    }
    
    function selectDelivery(target_id) {
        var result = $('#'+target_id).data('select');
        var f = document.forms['asFrm'];
        f.ma_cut_name.value = result.dy_name ? result.dy_name : '';
        f.ma_cut_tel.value = result.dy_tel ? result.dy_tel : '';
        f.ma_cut_tel2.value = result.dy_tel2 ? result.dy_tel2 : '';
        f.ca_post.value = result.dy_post ? result.dy_post : '';
        f.ca_addr.value = result.dy_addr ? result.dy_addr : '';
        f.ca_addr2.value = result.dy_addr2 ? result.dy_addr2 : '';
        close_modal();
    }

	//배송지 삭제
	function del_dely(dy_pid) {
		f = document.forms['bsf'];
		f.dy_pid.value = dy_pid;
		f.mode.value = 'del_dely';
		f.submit();
		f.mode.value = 'reg_dely';

	}

	//기본배송지 설정
	function basic_dely(dy_pid) {
		f = document.forms['bsf'];
		f.dy_pid.value = dy_pid;
		f.mode.value = 'basic_dely';
		f.submit();
		f.mode.value = 'reg_dely';
	}

	function view_dely(dy_pid, dy_name, dy_tel1, dy_tel2, dy_post, dy_addr, dy_addr2) {
		$("#dy_pid").val(dy_pid);
		$("#dy_name").val(dy_name);
		$("#dy_tel1").val(dy_tel1);
		$("#dy_tel2").val(dy_tel2);
		$("#dy_post").val(dy_post);
		$("#dy_addr").val(dy_addr);
		$("#dy_addr2").val(dy_addr2);
	}



	// 주문등록
    function order_reg(){
        pop_modal('pop_order_reg');
    }

	// as등록
    function as_reg(){
        document.forms['asFrm'].reset();
        $('#pd_pid').val('').trigger('change');
        pop_modal('pop_as_reg');
    }

	// 상담내역
    function coun_his(){

		pop_sendSearch(1);
        pop_modal('pop_coun_his');
    }

	function pop_sendSearch(pg) {
		$("#cfm2")[0].reset();
		$("#mc_pid").val('');
		$("#reg_name").html('');

		var f = document.forms['searchFrm'];
		if(pg=='history' || !pg) setFormQuery(pg);
		if(pg!='history') f.page.value=pg || (f.page.value>0 ? f.page.value : 1);


		var url_path=location.pathname.replace(/\/$/, '');
		var data_url ='consulting_data';
		var params_data=$('#searchFrm').serialize();

		if(pg && pg!='history')
			history.pushState(null, jsConfig.url_path.fnm+'>'+jsConfig.url_path.snm, url_path+'?'+params_data);
		gcUtil.loader('show', '#pop_list_area');
		$.ajax({
			data: params_data,
			type: "POST",
			url: data_url,
			cache: false,
			dataType:'json',
			success: function(resJson) {
				// console.log(resJson);
				gcUtil.loader('hide', '#pop_list_area');
				$('#pop_list_area').html(resJson.html);
				pop_paging(resJson.totCnt, resJson.page, resJson.rcnt);
			}
		});
	}

	function pop_paging(totalData, currentPage, dataPerPage){
		var totalData = parseInt(totalData);
		var currentPage = parseInt(currentPage);
		var dataPerPage = parseInt(dataPerPage);

		var pageCount=10;
		var totalPage = Math.ceil(totalData/dataPerPage);    // 총 페이지 수
		var first=0;
		var last=0;
		if(totalPage < pageCount) {
			if(currentPage > pageCount) first = 1;
			if((totalPage-currentPage) > pageCount) last = totalPage;
		}

		if(currentPage>1 && totalData>dataPerPage) first = 1;
		if(totalPage-currentPage>0 && totalData>dataPerPage) last = totalPage;

		var prev=0;
		var next=0;
		if(currentPage > 1) prev = currentPage - 1; // 이전 페이지
		if(currentPage + 1 <= totalPage) next = currentPage + 1;


		if(next > totalPage) next=1;

		// 각 페이지 번호 구하기
		var nBlock = Math.ceil(currentPage / pageCount);
		var nExpire = nBlock * pageCount;
		if(nExpire >= totalPage) nExpire = totalPage;

		var nInspire = (nBlock -1) * pageCount;
		if(nInspire < 1) nInspire = 1;

		// console.log("totalPage : " + totalPage);
		// console.log("last : " + last);
		// console.log("first : " + first);
		// console.log("next : " + next);
		// console.log("prev : " + prev);
		// console.log("nInspire : " + nInspire);
		// console.log("nExpire : " + nExpire);


		var html = `<div class="pageFirstButton pageButton">
					<span data-page="${first}"><img src="${jsConfig.imgDir}/button_list_big1_first.png" class="" alt="처음으로" ></span>
				</div>`;
			html += `<div class="pagePrevButton pageButton">
				<span data-page="${prev}"><img src="${jsConfig.imgDir}/button_list_big1_prev.png" alt="이전으로" ></span>
			</div>`;
			html += `<div class="pageNum">`;
			for(var i=nInspire; i <= nExpire; i++){
				className='';
				dataPage=i;
				if(currentPage==i) {
					className='on';
					dataPage=0;
				}
				html += `<span class="${className}" data-page="${dataPage}">${i}</span>`;
			}
			html += `</div>`;
			html += `<div class="pageNextButton pageButton">
					<span data-page="${next}"><img src="${jsConfig.imgDir}/button_list_big1_next.png" alt="다음으로" ></span>
				</div>`;
			html += `<div class="pageLastButton pageButton">
					<span data-page="${last}"><img src="${jsConfig.imgDir}/button_list_big1_last.png" alt="마지막으로" ></span>
				</div>`;

		$("#pop_paging").html(html);
		$('#pop_paging span').each(function(){
			var data_page=$(this).attr('data-page');
			if(data_page>0) {
				$(this).css('cursor', 'pointer');
				$(this).on('click', function(){
					pop_sendSearch(data_page);
				});
			}
		});
	}

	function view_coun(mc_pid) {
		$.ajax({
			url : 'ajax_request',
			data : {mode:'coun_view',mc_pid:mc_pid},
			type: "POST",
			cache: false,
			dataType:'json',
			success: function(res) {

				setFormData("cfm2",res);

			}
		});
    }
    
    function setProduct(pid) {
		$.ajax({
			url : '/product/ajax_request',
			data : {mode:'get_product', 'pid':pid},
			type: "POST",
			cache: false,
			dataType:'json',
			success: function(resJson) {
                let catePathName = new Array();
                let ct_name = null;
                let resHtml = '';
                if(resJson.pd_pid) {
                    catePathName.push(categorys[resJson.pc_pid1]['pc_name']);
                    if(resJson.pc_pid2) catePathName.push(categorys[resJson.pc_pid2]['pc_name']);
                    if(resJson.pc_pid3) catePathName.push(categorys[resJson.pc_pid3]['pc_name']);

                    for(var i in customer) {
                        if(customer[i]['ct_pid']!=resJson.ct_pid) continue;
                        ct_name = customer[i]['ct_name'];
                        break;
                    }
                    resHtml = '<tr>';
                    resHtml += '<td>'+catePathName.join(' > ')+'</td>';
                    resHtml += '<td>'+ct_name+'</td>';
                    resHtml += '<td>'+resJson.pd_code+'</td>';
                    resHtml += '<td>'+resJson.pd_name+'</td>';
                    resHtml += '</tr>';
                }
                $('#as_product tbody').html(resHtml);
			}
		});

		return false;
    }
    
    function regAsComplete() {
        close_modal();
    }


</script>