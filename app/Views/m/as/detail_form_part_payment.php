<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th rowspan="2">부품</th>
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
            <td>
                <div>
                    <div>
                        하부 조임 나사 BC12
                    </div>
                    <div>
                        (15,000 / 5,000)
                        <select name="" class="mWt50">
                            <option value="">1</option>
                        </select>
                        <button type="button" class="bt_pd bt_black" onclick="">X</button>
                    </div>
                </div>

                <div>
                    <div>
                        하부 받침 WE-456
                    </div>
                    <div>
                        (15,000 / 5,000)
                        <select name="" class="mWt50">
                            <option value="">1</option>
                        </select>
                        <button type="button" class="bt_pd bt_black" onclick="">X</button>
                    </div>
                </div>
            </td>                                
        </tr>                                    						
    </tbody>
</table> <!-- itable_1 -->

<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th>사진첨부</th>
            <td>
                <button type="button" class="bt_pd bt_white_bor" onclick="">사진보기(0)</button>
            </td>                                
        </tr>
        <tr>
            <th>요금</th>
            <td>
                <div>
                    <select name="" class="">
                        <option value="">유상</option>
                    </select>
                </div>

                <div class="table_wrap_l">
                    <table class="ltable_1" id="">
                        <thead>
                            <tr>									
                                <th>부품비</th>
                                <th>공임비</th>
                                <th>출장비</th>
                            </tr>
                        </thead>
                        <tbody id="">
                            <tr>
                                <td>15,000</td>
                                <td>5,000</td>
                                <td class="txar"><input type="text" name="" class="mWt70 txar" value="" /></td>
                            </tr>
                        </tbody>
                        <tfoot id="">
                            <tr>
                                <td colspan="3" class="fw6 txar">
                                    합계 : 
                                    <input type="text" name="" class="mWt100 txar" value="" />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div> <!-- table_wrap_l -->
            </td>                                
        </tr>                                 						
    </tbody>
</table> <!-- itable_1 -->

<table class="itable_1 mt10">
    <tbody>
        <tr>
            <th>확인자</th>
            <td>
                <input type="text" name="" class="mWt150" value="" />
                <select name="" class="wAuto">
                    <option value="">본인</option>
                </select>
            </td>                                
        </tr>
        <tr>
            <th>연락처</th>
            <td>
                <input type="text" name="" class="mWt150" value="" />
            </td>                                
        </tr>
        <tr>
            <th>서명</th>
            <td>
                <div id="signature-pad" class="signature-pad">
                    <div class="signature-pad--body">
                        <canvas></canvas>
                    </div>
                    <div class="signature-pad--footer">
                        <div class="signature-pad--actions">
                            <div>
                                <button type="button" class="bt_100_32 bt_blue" data-action="clear">지우기</button>
                            </div>                            
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <th>결제정보</th>
            <td>
                <div>
                    <select name="" class="wAuto">
                        <option value="">카드</option>
                    </select>
                    <select name="" class="wAuto">
                        <option value="">삼성카드</option>
                    </select>
                </div>

                <div>
                    <label class="chkWrap"><input type="checkbox" name="" value="" /><i></i><span>입금확인</span></label>
                </div>
                
                <div>
                    <button type="button" class="bt_pd bt_red" onclick="">결제취소</button>
                </div>
            </td>                                
        </tr>                                                     						
    </tbody>
</table>
<script type="text/javascript" src="<?=M_JS_DIR?>/signature.js"></script>