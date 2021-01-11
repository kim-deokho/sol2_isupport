<div class="table_wrap">
    <table class="itable_1">
        <tbody>
            <tr>
                <th>주문일</th>
                <td>
                    2020-01-01
                </td>                                
            </tr>
            <tr>
                <th>주문상품</th>
                <td>
                    <div>원형탁자 ADG-4000 (1)</div>
                    <div>원목의자 RT-5450 (4)</div>
                </td>                
            </tr>
            <tr>
                <th>고객명</th>
                <td>
                    홍길동
                </td>                                
            </tr>
            <tr>
                <th>연락처</th>
                <td>
                    <a href="tel:010-1234-5678">010-1234-5678</a> / <a href="tel:010-0001-0000">010-0001-0000</a>
                </td>                                
            </tr>
            <tr>
                <th>주소</th>
                <td>
                    서울시 영등포구 여의도동 24길 23 영등빌딩 303호
                </td>                                
            </tr>
            <tr>
                <th>배송메모</th>
                <td>
                    방문전에 꼭 먼저 연락주세요. 밖에 있습니다.
                </td>                                
            </tr>                                                      						
        </tbody>
    </table> <!-- itable_1 -->

    <table class="itable_1 mt10">
        <tbody>
            <tr>
                <th>배송예정일</th>
                <td>
                    <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>
                </td>                                
            </tr>
            <tr>
                <th>방문일시</th>
                <td>
                    <div>
                        <select name="" class="wAuto">
                            <option value="">선택</option>
                            <option value="">방문예정</option>
                            <option value="">방문연기</option>
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
                <th>비고</th>
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
        $(".h_title").text("[배송]배정현황");
    };
</script>