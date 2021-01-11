<div class="table_wrap">
    <table class="itable_1">
        <tbody>
            <tr>
                <th>요청일</th>
                <td>
                    <input type="text" name="" class="mWt100" value="" readonly />
                </td>                                
            </tr>
            <tr>
                <th>구분</th>
                <td>
                    출고
                </td>                                
            </tr>
            <tr>
                <th>창고</th>
                <td>
                    <select name="" class="" disabled>
                        <option value="">본사창고</option>
                    </select>
                </td>                
            </tr>
            <tr>
                <th>부품검색</th>
                <td>
                    <div>
                        <select name="" class="wAuto" disabled>
                            <option value="">1차카테고리</option>
                        </select>
                        <select name="" class="wAuto" disabled>
                            <option value="">2차카테고리</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="" class="bt2r" value="" placeholder="부품명" readonly />
                        <button type="button" class="bt_pd bt_black" onclick="">추가</button>
                    </div>
                </td>                                
            </tr>
            <tr>
                <th>요청부품</th>
                <td>
                    <div>
                        <div>
                            안마의자 > 하부나사
                        </div>
                        <div class="fw6">
                            하부 조임 나사 BC12
                        </div>
                        <div>
                            현재고:5 /                            
                            요청수량:                            
                            <select name="" class="wAuto" disabled>
                                <option value="">1</option>
                            </select>
                            <button type="button" class="bt_pd bt_black" onclick="">X</button>
                        </div>
                    </div>
                    <div>
                        <div>
                            안마의자 > 하부나사
                        </div>
                        <div class="fw6">
                            하부 조임 나사 BC12
                        </div>
                        <div>
                            현재고:5 /                            
                            요청수량:                            
                            <select name="" class="wAuto" disabled>
                                <option value="">1</option>
                            </select>
                            <button type="button" class="bt_pd bt_black" onclick="">X</button>
                        </div>
                    </div>
                </td>                                
            </tr>
            <tr>
                <th>비고</th>
                <td>
                    <textarea name="">박기사에게 대신 전달함</textarea>
                </td>                                
            </tr>
            <tr>
                <th>처리자</th>
                <td>
                    김직원 2020-4-14 12:33 <span class="fw6 fc26a">[출고완료]</span>
                </td>                
            </tr>                                                      						
        </tbody>
    </table> <!-- itable_1 -->
</div> <!-- table_Wrap -->

<div class="buttonCenter">
    <button class="bt_100_32 bt_gray" onclick="load_page('request')">목록</button>
</div>

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[부품]요청내역");        
    };  
</script>