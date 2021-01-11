<div class="table_wrap">
    <table class="itable_1">
        <tbody>
            <tr>
                <th>폐기일</th>
                <td>
                    <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>
                </td>                                
            </tr>
            <tr>
                <th>AS접수번호</th>
                <td>
                    AS20200101-001
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
                <th>폐기부품</th>
                <td>
                    <div>
                        <div>
                            안마의자 > 하부나사
                        </div>
                        <div class="fw6">
                            하부 조임 나사 BC12
                        </div>
                        <div>
                            수량:
                            <select name="" class="wAuto">
                                <option value="">1</option>
                            </select>
                            창고:
                            <select name="" class="wAuto">
                                <option value="">본사창고</option>
                            </select>
                            사유:
                            <select name="" class="wAuto">
                                <option value="">파손</option>
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
        </tbody>
    </table> <!-- itable_1 -->
</div> <!-- table_Wrap -->

<div class="buttonCenter">
    <button class="bt_100_32 bt_gray" onclick="load_page('dispose')">목록</button>
    <button class="bt_100_32 bt_dark ml5" onclick="">저장</button>
</div>

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[부품]폐기내역");        
    };  
</script>