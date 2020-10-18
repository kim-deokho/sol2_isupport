<style type="text/css">
    #pop_staff_reg {max-width: 800px;}
</style>

<div id="pop_staff_reg" class="modal">
    <div class="modal_header">
        <div class="modal_title">
            <span>직원 등록</span>
            <span>(!) 상담/배송/AS 담당자는 반드시 업무를 체크해주세요.</span>
        </div> <!-- modal_title -->     
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="../common/img/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close -->   
    </div> <!-- modal_header -->        

    <div class="modal_contents">
        <div class="table_wrap">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th class="mWt100">사원코드</th>
                        <td></td>
                        <th class="mWt100">등록일</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>이름</th>
                        <td><input type="text" name="" class="" value="" /></td>
                        <th>아이디</th>
                        <td><input type="text" name="" class="" value="" /></td>
                    </tr>
                    <tr>
                        <th>비밀번호</th>
                        <td><input type="password" name="" class="" value="" /></td>
                        <th>비밀번호확인</th>
                        <td><input type="password" name="" class="" value="" /></td>
                    </tr>
                    <tr>
                        <th>부서</th>
                        <td>
                            <select name="" class="">
                                <option value="">배송팀</option>
                            </select>
                        </td>
                        <th>업무</th>
                        <td>
                            <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>상담</span></label>
                            <label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>배송</span></label>
                            <label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>AS</span></label>
                        </td>
                    </tr>
                    <tr>
                        <th>직위</th>
                        <td>
                            <select name="" class="">
                                <option value="">차장</option>
                            </select>
                        </td>
                        <th>기본권한</th>
                        <td>
                            <select name="" class="">
                                <option value="">배송팀</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>직책</th>
                        <td>
                            <select name="" class="">
                                <option value="">차장</option>
                            </select>
                        </td>
                        <th>개별권한</th>
                        <td>
                            <button type="button" class="bt_sblue" onclick="">설정</button>
                        </td>
                    </tr>
                    <tr>
                        <th>입사일</th>
                        <td><input type="text" name="" class="date mWt100 txac" value="" /></td>
                        <th>퇴사일</th>
                        <td><input type="text" name="" class="date mWt100 txac" value="" /></td>
                    </tr>
                    <tr>
                        <th>전화</th>
                        <td><input type="text" name="" class="" value="" /></td>
                        <th>휴대폰</th>
                        <td><input type="text" name="" class="" value="" /></td>
                    </tr>
                    <tr>
                        <th>이메일</th>
                        <td><input type="text" name="" class="" value="" /></td>
                        <th>내선번호</th>
                        <td><input type="text" name="" class="" value="" /></td>
                    </tr>
                    <tr>
                        <th>추가권한</th>
                        <td colspan="3">
                            <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>상품결제</span></label>
                            <label class="chkWrap ml20"><input type="checkbox" name="" value="" /><i></i><span>교환발송승인</span></label>
                        </td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td colspan="3">
                            <div>
                                <input type="text" name="" class="mWt80" value="" placeholder="우편번호" />
                                <button type="button" class="bt_white_bor" onclick="">주소찾기</button>
                            </div>
                            <div class="mt7">
                                <input type="text" name="" class="mWt49p" value="" placeholder="기본주소" />
                                <input type="text" name="" class="mWt49p" value="" placeholder="상세주소"  />
                            </div>
                        </td>
                    </tr>                           
                    <tr>
                        <th>메모</th>
                        <td colspan="3"><textarea name="" class="txa_base"></textarea></td>
                    </tr>
                </tbody>
            </table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->
       
        <div class="buttonCenter mt20">
            <a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray modal_close" onclick="">취소</button></a>
            <button type="button" class="bt_150_40 bt_black ml5" onclick="">저장</button>
        </div> <!-- buttonCenter -->
	</div> <!-- modal_contents -->
</div> <!-- modal -->

<script type="text/x-javascript">
</script>