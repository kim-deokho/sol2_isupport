<div class="search_box">
    <div class="box_row">
        <span>요청일</span>
        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/> ~ 
        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>   
    </div> <!-- box_row -->

    <div class="box_row mt10">
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

    <div class="box_row mt10">
        <span>구분</span>
        <div class="search_br ml15">
            <button class="active" onclick="">전체</button>
            <button onclick="">출고</button>
            <button onclick="">반입</button>
        </div>        
    </div> <!-- box_row -->
</div> <!-- search_box -->

<div class="bt_100p">
    <button type="button" class="bt_blue" onclick="load_page('request_write')">부품요청</button>
</div>

<div class="list_top mt5">
    Total : 9
</div> <!-- list_top -->
<ul class="list_type1">
    <?for($i=0;$i<3;$i++){?>
    <li onclick="load_page('request_detail')">
        <div>요청일 : 2020-04-14</div>
        <div>본사창고 <i>[출고/요청]</i></div>
        <div>PCB, 3D컨트롤, A80 (1)</div>
        <div>PCB, 메인, A80 (2)</div>
    </li>
    <li onclick="load_page('request_detail')">
        <div>요청일 : 2020-04-14</div>
        <div>본사창고 <i>[2020-04-14 출고완료]</i></div>
        <div>PCB, 3D컨트롤, A80 (1)</div>
        <div>PCB, 메인, A80 (2)</div>
    </li>
    <li onclick="load_page('request_detail')">
        <div>요청일 : 2020-04-14</div>
        <div>본사창고 <i>[반입/취소]</i></div>
        <div>PCB, 3D컨트롤, A80 (1)</div>
        <div>PCB, 메인, A80 (2)</div>
    </li>
    <?}?>
</ul> <!-- ul.list_type1 -->

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[부품]요청내역");
    };

    $(".search_br > button").on("click",function(){
        $(this).parent(".search_br").children("button").removeClass("active");
        $(this).addClass("active");
    });
</script>