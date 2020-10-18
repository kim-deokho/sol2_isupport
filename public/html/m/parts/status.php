<div class="search_box">
    <div class="box_row">
        <span>부품명</span>
        <select name="" class="wAuto">
            <option value="">1차카테고리</option>
        </select>
        <select name="" class="wAuto">
            <option value="">2차카테고리</option>
        </select>
    </div> <!-- box_row -->

    <div class="box_row mt10">        
        <input type="text" name="" class="mWt200 ml40" value="" placeholder="부품명" />
        <button type="button" class="bt_pd bt_black" onclick="">검색</button>
    </div> <!-- box_row -->
</div> <!-- search_box -->

<div class="list_top mt5">
    Total : 0 / 0 / 0
</div> <!-- list_top -->
<div class="table_wrap_l">
    <table class="ltable_2" id="">
        <thead>
            <tr>									
                <th class="mWt45p">부품명</th>
                <th>신청</th>
                <th>사용</th>
                <th>반입</th>
                <th>현재</th>
            </tr>
        </thead>
        <tbody id="">
            <?for($i=0;$i<20;$i++){?>
            <tr>
                <td class="p_name">
                    <div>안마의자 > 하부나사</div>
                    <div>하부 조임 나사 BC12</div>
                </td>
                <td>5</td>
                <td>3</td>
                <td>0</td>
                <td>2</td>
            </tr>
            <?}?>
        </tbody>
    </table>
</div> <!-- table_wrap_l -->

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[부품]부품현황");
    };
</script>