<style type="text/css">
    #pop_manager_reg {max-width: 800px;}
</style>
<div id="pop_manager_reg" class="modal">
    <div class="modal_header">
        <div class="modal_title">
            <span>직원 등록</span>
            <span>(!) 상담/배송/AS 담당자는 반드시 업무를 체크해주세요.</span>
        </div> <!-- modal_title -->     
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
    </div> <!-- modal_header -->        

    <div class="modal_contents">
        <form name="regFrm" id="regFrm" method="post" onsubmit="regManager(this);return false;" target="hiddenFrame" action="/basic/execute">
        <input type="hidden" name="mode" id="mode" value="reg_manager">
        <input type="hidden" name="mn_pid" id="mn_pid">
        <input type="hidden" name="mn_work_str" id="mn_work_str">
        <input type="hidden" name="mn_add_str" id="mn_add_str">
        <div class="table_wrap">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th class="mWt100">사원코드</th>
                        <td><span id="mn_no"></span></td>
                        <th class="mWt100">등록일</th>
                        <td><span id="reg_date"></span></td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td><input type="text" name="mn_name" id="mn_name" class="" value="" required /></td>
                        <th>아이디</th>
                        <td><input type="text" name="mn_id" id="mn_id" class="" value="" minlength=6 maxlength=30 required /></td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td>
                            <input type="password" name="pwd" id="pwd" class="mWt50p" value=""  minlength=6 maxlength=20 />
                            <label class="chkWrap ml20" id="chk_pwd"><input type="checkbox" name="pwd_chg" value="Y" id="pwd_chg"><i></i><span>비밀번호 변경</span></label>
                        </td>
                        <th>비밀번호확인</th>
                        <td><input type="password" name="pwd_confirm" id="pwd_confirm" class="" value=""  minlength=6 maxlength=20 /></td>
                    </tr>
                    <tr>
                        <th>부서</th>
                        <td>
                            <select name="mn_department" id="mn_department" class="" required>
                                <option value="">- 선택 -</option>
<?                              foreach($setting['code']['Departments'] as $part) echo '<option value="'.$part['cd_pid'].'" >'.$part['cd_name'].'</option>';?>                                
                            </select>
                        </td>
                        <th>업무</th>
                        <td>
<?                          foreach($setting['code']['Works'] as $k=>$v) echo '<label class="chkWrap '.($k=='cs'?'':'ml20').'"><input type="checkbox" name="mn_work" value="'.$k.'" /><i></i><span>'.$v.'</span></label>';?> 
                        </td>
                    </tr>
                    <tr>
                        <th>직위</th>
                        <td>
                            <select name="mn_position" id="mn_position" class="" required>
                                <option value="">- 선택 -</option>
<?                              foreach($setting['code']['Positions'] as $position) echo '<option value="'.$position['cd_pid'].'" >'.$position['cd_name'].'</option>';?>                                 
                            </select>
                        </td>
                        <th>기본권한</th>
                        <td>
                            <select name="bn_pid" id="bn_pid" class="" required>
                                <option value="">- 선택 -</option>
<?                              foreach($permainRows as $p_row) echo '<option value="'.$p_row['bn_pid'].'">'.$p_row['bn_name'].($p_row['bn_use']!='Y'?'(사용안함)':'').'</option>';?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>직책</th>
                        <td>
                            <select name="mn_duty" id="mn_duty" class="" required>
                                <option value="">- 선택 -</option>
<?                              foreach($setting['code']['Dutys'] as $duty) echo '<option value="'.$duty['cd_pid'].'" >'.$duty['cd_name'].'</option>';?> 
                            </select>
                        </td>
                        <th>개별권한</th>
                        <td>
                            <button type="button" class="bt_sblue" onclick="popAdd()">설정</button>
                        </td>
                    </tr>
                    <tr>
                        <th>입사일</th>
                        <td><input type="text" name="mn_in_date" id="mn_in_date" class="date mWt100 txac" value="" required /></td>
                        <th>퇴사일</th>
                        <td><input type="text" name="mn_out_date" id="mn_out_date" class="date mWt100 txac" value="" /></td>
                    </tr>
                    <tr>
                        <th>전화</th>
                        <td><input type="text" name="mn_tel" id="mn_tel" class="" value="" /></td>
                        <th>휴대폰</th>
                        <td><input type="text" name="mn_hp" id="mn_hp" class="" value="" pattern="[0-9]{10,11}" required /></td>
                    </tr>
                    <tr>
                        <th>이메일</th>
                        <td><input type="email" name="mn_email" id="mn_email" class="" value="" required /></td>
                        <th>내선번호</th>
                        <td><input type="text" name="mn_com_tel" id="mn_com_tel" class="" value="" /></td>
                    </tr>
                    <tr>
                        <th>추가권한</th>
                        <td colspan="3">
<?                          foreach($setting['code']['addPer'] as $k=>$v) echo '<label class="chkWrap '.($k=='item_pay'?'':'ml20').'"><input type="checkbox" name="mn_add" value="'.$k.'" /><i></i><span>'.$v.'</span></label>';?> 
                        </td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td colspan="3">
                            <div>
                                <input type="text" name="mn_post" id="mn_post" class="mWt80" value="" placeholder="우편번호" required readonly />
                                <button type="button" class="bt_white_bor" onclick="daumPost.pop()">주소찾기</button>
                            </div>
                            <div class="mt7">
                                <input type="text" name="mn_addr" id="mn_addr" class="mWt49p" value="" placeholder="기본주소" required readonly/>
                                <input type="text" name="mn_addr2" id="mn_addr2" class="mWt49p" value="" placeholder="상세주소" required />
                            </div>
                        </td>
                    </tr>                           
                    <tr>
                        <th>메모</th>
                        <td colspan="3"><textarea name="mn_memo" id="mn_memo" class="txa_base"></textarea></td>
                    </tr>
                </tbody>
            </table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->
       
        <div class="buttonCenter mt20">
            <a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
            <button type="submit" class="bt_150_40 bt_black ml5 js-save-btn">저장</button>
        </div> <!-- buttonCenter -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->
