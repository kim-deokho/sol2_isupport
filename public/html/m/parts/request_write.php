<div class="table_wrap">
    <table class="itable_1">
        <tbody>
            <tr>
                <th>요청일</th>
                <td>
                    <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>
                </td>                                
            </tr>
            <tr>
                <th>구분</th>
                <td>
                    <label class="radioWrap"><input type="radio" name="구분" value="" checked /><i></i><span class="fs14">출고</span></label>
                    <label class="radioWrap ml20"><input type="radio" name="구분" value=""  /><i></i><span class="fs14">반입</span></label>
                </td>                                
            </tr>
            <tr>
                <th>창고</th>
                <td>
                    <select name="" class="">
                        <option value="">전체</option>
                    </select>
                </td>                
            </tr>
            <tr>
                <th>부품검색</th>
                <td>
                    <div>
                        <select name="" class="wAuto">
                            <option value="">1차카테고리</option>
                        </select>
                        <select name="" class="wAuto">
                            <option value="">2차카테고리</option>
                        </select>
                    </div>

                    <div>
                        <input type="text" name="" class="bt2r" value="" placeholder="부품명" />
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
                            <select name="" class="wAuto">
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
                            <select name="" class="wAuto">
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
                    <textarea name=""></textarea>
                </td>                                
            </tr>
            <tr>
                <th>처리자</th>
                <td>
                    김직원 2020-4-14 12:33
                </td>                
            </tr>                                                      						
        </tbody>
    </table> <!-- itable_1 -->
</div> <!-- table_Wrap -->

<div class="buttonCenter">
    <button class="bt_100_32 bt_gray" onclick="load_page('request')">목록</button>
    <button class="bt_100_32 bt_dark ml5" onclick="">저장</button>
</div>

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[부품]요청내역");        
    };  
</script>