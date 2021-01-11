<div class="search_box">
    <div class="box_row">
        <span>요청일</span>
        <button class="ud_bt up" onclick="">up</button>
        <button class="ud_bt down" onclick="">down</button>

        <span class="sbml">배정일</span>
        <button class="ud_bt up" onclick="">up</button>
        <button class="ud_bt down" onclick="">down</button>
    </div> <!-- box_row -->

    <div class="box_row mt10">
        <span>고객명</span>
        <input type="text" name="" class="mWt180" value="" placeholder="이름/연락처" />
    </div> <!-- box_row -->

    <div class="box_row mt10">
        <span>상태</span>
        <div class="search_br ml15">
            <button class="active" onclick="">방문연기</button>
            <button onclick="">재방문</button>
            <button onclick="">긴급</button>
        </div>        
    </div> <!-- box_row -->
</div> <!-- search_box -->

<div class="list_top mt5">
    Total : 10
</div> <!-- list_top -->
<ul class="list_type1">
    <?for($i=0;$i<10;$i++){?>
    <li onclick="load_page('status_write')">
        <div>요청일 : 2020-04-14 &#124; 배정일 : 2020-04-14</div>
        <div>홍길동(010-1234-5678) <span>[긴급]</span><i>[방문연기]</i></div>
        <div>서울시 영등포구 여의도동 24길 23</div>
    </li>
    <?}?>
</ul> <!-- ul.list_type1 -->

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[AS]배정현황");
    };

    $(".search_br > button").on("click",function(){
        $(this).parent(".search_br").children("button").removeClass("active");
        $(this).addClass("active");
    });
</script>