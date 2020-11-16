
            <section>
                <div class="contents">
					<?
						include_once APPPATH.'/Views/_page_path.php';
					?>

                    <form name="searchFrm" id="searchFrm">
					<input type="hidden" name="page" id="page" value="<?=$page?>">
					<div class="search_box">
                        <div class="box_row">
                            <span>기간</span>
                            <select name="" class="wAuto">
                                <option value="">가입일</option>
                            </select>
                            <input type="text" name="searchSdate" class="date mWt100 txac" value="" /> ~
                            <input type="text" name="searchEdate" class="date mWt100 txac" value="" />

                            <span class="ml20">회원등급</span>
                            <select name="searchLevel" class="wAuto">
                                <option value="">전체</option>
                            </select>

                            <span class="ml20">회원구분</span>
                            <select name="searchKind" class="wAuto">
                                <option value="">전체</option>
								<option value="A">일반</option>
								<option value="B">기업</option>
                            </select>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>담당자</span>
                            <select name="searchMn" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['manager'] as $row ) { if(strpos($row['mn_work'], 'cs') !== false) {echo '<option value="'.$row['mn_pid'].'">'.$row['mn_name'].'</option>';}}?>
                            </select>

                            <span class="ml20">가입경로</span>
                            <select name="searchRoot" class="wAuto">
                                <option value="">전체</option>
								<?foreach($setting['code']['Inroot'] as $row ) echo '<option value="'.$row['cd_pid'].'">'.$row['cd_name'].'</option>'?>
                            </select>

                            <span class="ml20">수신동의</span>
                            <label class="chkWrap"><input type="checkbox" name="searchInfo" value="Y" /><i></i><span>개인정보</span></label>
                            <label class="chkWrap ml10"><input type="checkbox" name="searchSms" value="Y" /><i></i><span>문자</span></label>
                            <label class="chkWrap ml10"><input type="checkbox" name="searchMail" value="Y" /><i></i><span>메일</span></label>
                            <label class="chkWrap ml10"><input type="checkbox" name="searchTel" value="Y" /><i></i><span>전화</span></label>
                        </div> <!-- box_row -->

                        <div class="box_row mt10">
                            <span>휴먼포함</span>
                            <label class="chkWrap"><input type="checkbox" name="searchDormant" value="Y" /><i></i></label>

                            <span class="ml20">탈퇴포함</span>
                            <label class="chkWrap"><input type="checkbox" name="searchwithdrawal" value="Y" /><i></i></label>

                            <span class="ml20">회원</span>
                            <select name="searchKey[]" class="multi_select" style="width:auto"  id="searchKey" multiple="multiple">
                                <option value="b.mb_name" selected>이름</option>
								<option value="b.mb_code">코드</option>
								<option value="concat(mb_tel1,mb_tel2,mb_tel3)">전화</option>
                            </select>
                            <input type="text" name="searchKey" class="mWt200" value="" placeholder="" />

                            <button type="button" class="bt_navy ml10" onclick="sendSearch(1)">조회</button>

                            <div class="po_right">
                                <button type="button" class="bt_black" onclick="merge_member();">회원병합</button>
                                <button type="button" class="bt_black" onclick="change_contact();">담당자변경</button>
                                <button type="button" class="bt_black" onclick="change_grade();">등급변경</button>
                                <button type="button" class="bt_green ml10" onclick="listExcel()">EXCEL</button>
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
        </div> <!-- container -->

	<?
        include_once "../common/inc/footer.php"; // footer
	?>

        <?
            include_once "pop_merge_member.php"; // 회원병합
            include_once "pop_change_contact.php"; // 담당자변경
            include_once "pop_change_grade.php"; // 등급변경
        ?>
	</body>
</html>

<script type="text/javascript">
sendSearch();
    // 파일업로드
    $(".file_wrap > button").on("click",function(){
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });

    // 회원병합
    function merge_member(){
        modal('pop_merge_member');
    }

    // 담당자변경
    function change_contact(){
        modal('pop_change_contact');
    }

    // 등급변경
    function change_grade(){
        modal('pop_change_grade');
    }
</script>