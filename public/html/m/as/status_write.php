<div class="table_wrap">
    <table class="itable_1">
        <tbody>
            <tr>
                <th>요청일</th>
                <td>
                    <div class="right_chk">
                        <div>2020-01-01 (김상담)</div>
                        <label class="chkWrap"><span class="fs14 fce41 mr5">긴급</span><input type="checkbox" name="" value="" /><i></i></label>
                    </div>
                </td>                                
            </tr>
            <tr>
                <th>AS수취인</th>
                <td>
                    <input type="text" name="" class="mWt120" value="" />
                </td>                
            </tr>            
            <tr>
                <th>AS연락처</th>
                <td>
                    <a href="tel:010-1234-5678">010-1234-5678</a> / <a href="tel:010-0001-0000">010-0001-0000</a>
                </td>                                
            </tr>
            <tr>
                <th>주소</th>
                <td>
                    <div>
                        <button type="button" class="bt_pd bt_white_bor" onclick="">주소찾기</button>
                        <input type="text" name="" class="mWt70" value="" placeholder="우편번호" />
                        <button type="button" class="bt_pd bt_gray" onclick="">배송지선택</button>
                    </div>
                    <div>
                        <input type="text" name="" class="" value="" placeholder="기본주소" />
                    </div>
                    <div>                        
                        <input type="text" name="" class="" value="" placeholder="상세주소"  />
                    </div>
                </td>                                
            </tr>
            <tr>
                <th>상담메모</th>
                <td>
                    방문전에 꼭 먼저 연락주세요. 밖에 있습니다.
                </td>                                
            </tr>
            <tr>
                <th>제품정보</th>
                <td>
                    안마의자 CMC-1300A
                    <button type="button" class="bt_pd bt_gray" onclick="">변경</button>
                </td>                                
            </tr>
            <tr>
                <th>제품시리얼</th>
                <td>
                    <input type="text" name="" class="" value="" />
                </td>                
            </tr>
            <tr>
                <th>모델명</th>
                <td>
                    <input type="text" name="" class="" value="" />
                </td>                
            </tr>
            <tr>
                <th>부위</th>
                <td>
                    <select name="" class="">
                        <option value="">소모품</option>
                    </select>
                </td>                
            </tr>
            <tr>
                <th>증상</th>
                <td>
                    <select name="" class="">
                        <option value="">파손</option>
                    </select>
                </td>                
            </tr>                                               						
        </tbody>
    </table> <!-- itable_1 -->

    <table class="itable_1 mt10">
        <tbody>
            <tr>
                <th>AS기사</th>
                <td>
                    김기사
                </td>                                
            </tr>             
            <tr>
                <th>방문일시</th>
                <td>
                    <div>
                        <select name="" class="wAuto">
                            <option value="">선택</option>
                            <option value="">방문예정</option>
                            <option value="">배송중</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>
                        <select name="" class="wAuto">
                            <option value="">00:00</option>
                        </select>
                    </div>
                </td>                                
            </tr>
            <tr>
                <th>통화메모</th>
                <td>
                    <textarea name=""></textarea>
                </td>                                
            </tr>
            <tr>
                <th>일정안내문자</th>
                <td>
                    <select name="" class="wAuto">
                        <option value="">010-1111-2222</option>
                    </select>
                    <button type="button" class="bt_pd bt_black" onclick="">발송</button>
                </td>                                
            </tr>                                                   						
        </tbody>
    </table> <!-- itable_1 -->

    <table class="itable_1 mt10">
        <tbody>
            <tr>
                <th>처리</th>
                <td>
                    <select name="" class="">
                        <option value="">선택</option>
                    </select>
                </td>                                
            </tr>
            <tr>
                <th>사유</th>
                <td>
                    <select name="" class="">
                        <option value="">부품미확보</option>
                    </select>
                </td>                                
            </tr>
            <tr>
                <th>상세사유</th>
                <td>
                    <textarea name=""></textarea>
                </td>                                
            </tr>                                        						
        </tbody>
    </table> <!-- itable_1 -->
</div> <!-- table_Wrap -->

<div class="buttonCenter">
    <button class="bt_100_32 bt_gray" onclick="load_page('status')">목록</button>
    <button class="bt_100_32 bt_dark ml5" onclick="">저장</button>
</div>

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[AS]배정현황");        
    };
</script>