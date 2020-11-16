<section>
    <div class="contents">
<?
    include_once APPPATH.'/Views/_page_path.php';
?>
    <form name="regFrm" id="regFrm" method="post" accept-charset="UTF-8" enctype="multipart/form-data" onsubmit="" target="hiddenFrame" action="/basic/execute">
    <input type="hidden" name="mode" id="mode" value="reg_company">
    <input type="hidden" name="com_pid" id="com_pid" value="<?=$row['com_pid']?>">
        <div class="table_wrap mWt900">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th class="mWt150">회사명</th>
                        <td class="mWt300"><input type="text" name="com_name" id="com_name" class="mWt200" value="<?=$row['com_name']?>" required/></td>
                        <th class="mWt150">법인번호</th>
                        <td class="mWt300"><input type="text" name="corporate_body_no" id="corporate_body_no" class="mWt200" value="<?=$row['corporate_body_no']?>" /></td>
                    </tr>
                    <tr>
                        <th>대표자명</th>
                        <td><input type="text" name="ceo_name" id="ceo_name" class="mWt200" value="<?=$row['ceo_name']?>" required /></td>
                        <th>사업자번호</th>
                        <td><input type="text" name="com_no" id="com_no" class="mWt200" value="<?=$row['com_no']?>" /></td>
                    </tr>
                    <tr>
                        <th>업태</th>
                        <td><input type="text" name="com_business_conditions" id="com_business_conditions" class="mWt200" value="<?=$row['com_business_conditions']?>" /></td>
                        <th>종목</th>
                        <td><input type="text" name="com_business_type" id="com_business_type" class="mWt200" value="<?=$row['com_business_type']?>" /></td>
                    </tr>
                    <tr>
                        <th>전화</th>
                        <td><input type="text" name="com_tel" id="com_tel" class="mWt200" value="<?=$row['com_tel']?>" /></td>
                        <th>휴대폰</th>
                        <td><input type="text" name="com_hp" id="com_hp" class="mWt200" value="<?=$row['com_hp']?>" /></td>
                    </tr>
                    <tr>
                        <th>팩스</th>
                        <td><input type="text" name="com_fax" id="com_fax" class="mWt200" value="<?=$row['com_fax']?>" /></td>
                        <th>이메일</th>
                        <td><input type="email" name="com_email" id="com_email" class="mWt200" value="<?=$row['com_email']?>" /></td>
                    </tr>
                    <tr>
                        <th>업체로고<br />(투명(PNG)이미지 300&times;100 권장)</th>
                        <td>
                            <div class="logo_photo_reg">
                                <div class="lpr_photo"><img src="<?=$row['com_logo']?AWS_UPLOAD_HOST.$row['com_logo']:IMG_DIR.'/logo_photo.jpg'?>" id="logo_prev" alt="logo" /></div>
                                <div class="lpr_button">
                                    <div><button type="button" class="bt_white_bor find_file" data-target="file_com_logo">찾아보기</button></div>
                                    <div><button type="button" class="bt_text del_file"  data-prev="logo_prev" data-empty="<?=IMG_DIR?>/logo_photo.jpg" data-input="file_com_logo">삭제</button></div>                                                                                
                                </div>
                                <input type="file" name="file_com_logo" id="file_com_logo" class="hidden prev_file" data-prev="logo_prev" />
                                <input type="hidden" name="file_com_logo_del" id="file_com_logo_del">
                            </div> <!-- logo_photo_reg -->
                        </td>
                        <th>업체도장<br />(투명(PNG)이미지 150&times;150 권장)</th>
                        <td>
                            <div class="stamp_photo_reg">
                                <div class="lpr_photo"><img src="<?=$row['com_seal']?AWS_UPLOAD_HOST.$row['com_seal']:IMG_DIR.'/stamp_photo.jpg'?>" id="stamp_prev" alt="stamp" /></div>
                                <div class="lpr_button">
                                    <div><button type="button" class="bt_white_bor find_file" data-target="file_com_seal">찾아보기</button></div>
                                    <div><button type="button" class="bt_text del_file" data-prev="stamp_prev" data-empty="<?=IMG_DIR?>/stamp_photo.jpg" data-input="file_com_seal">삭제</button></div>                                                                                
                                </div>
                                <input type="file" name="file_com_seal" id="file_com_seal" class="hidden prev_file" data-prev="stamp_prev" />
                                <input type="hidden" name="file_com_seal_del" id="file_com_seal_del">
                            </div> <!-- stamp_photo_reg -->
                        </td>
                    </tr>
                    <tr>
                        <th>주소</th>
                        <td colspan="3">
                            <div>
                                <input type="text" name="com_post" id="com_post" class="mWt80" value="<?=$row['com_post']?>" placeholder="우편번호" readOnly />
                                <button type="button" class="bt_white_bor" onclick="daumPost.pop()">주소찾기</button>
                            </div>
                            <div class="mt7">
                                <input type="text" name="com_addr" id="com_addr" class="mWt45p" value="<?=$row['com_addr']?>" placeholder="기본주소" readOnly />
                                <input type="text" name="com_addr2" id="com_addr2" class="mWt45p" value="<?=$row['com_addr2']?>" placeholder="상세주소" />
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->

        <div class="title_1">※ 세금계산서 업무 담당자</div>
        <div class="table_wrap mWt900">
            <table class="itable_1">
                <tbody>
                    <tr>
                        <th class="mWt150">담당자명</th>
                        <td class="mWt350"><input type="text" name="accounting_officer" id="accounting_officer" class="mWt200" value="<?=$row['accounting_officer']?>" /></td>
                        <th class="mWt150">담당 전화</th>
                        <td class="mWt350"><input type="text" name="accounting_officer_tel1" id="accounting_officer_tel1" class="mWt200" value="<?=$row['accounting_officer_tel1']?>" /></td>
                    </tr>
                    <tr>
                        <th>담당 이메일</th>
                        <td><input type="email" name="accounting_officer_email" id="accounting_officer_email" class="mWt200" value="<?=$row['accounting_officer_email']?>" /></td>
                        <th>담당 휴대폰</th>
                        <td><input type="text" name="accounting_officer_tel2" id="accounting_officer_tel2" class="mWt200" value="<?=$row['accounting_officer_tel2']?>" /></td>
                    </tr>                                
                    <tr>
                        <th>메모</th>
                        <td colspan="3"><textarea name="com_memo" id="com_memo" class="txa_base"><?=nl2br($row['com_memo'])?></textarea></td>
                    </tr>
                </tbody>
            </table> <!-- itable_1 -->
        </div> <!-- table_Wrap -->
        <div class="buttonRight mt10  mWt900">
            <button type="submit" class="bt_150_40 bt_black js-save-btn">저장</button>
        </div>
    </form>
    </div> <!-- contents -->
</section>
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=JS_DIR?>/daum.post.ctr.js"></script>
<script>
    daumPost.post_id='com_post';
    daumPost.addr_id='com_addr';
    daumPost.addrDetail_id='com_addr2';
    daumPost.addrExtra_id='com_addr2';
</script>