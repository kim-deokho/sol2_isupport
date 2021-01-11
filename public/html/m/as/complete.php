<div class="search_box">
    <div class="box_row">
        <span>처리일</span>
        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/> ~ 
        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>        
    </div> <!-- box_row -->

    <div class="box_row mt10">
        <span>고객명</span>
        <input type="text" name="" class="mWt180" value="" placeholder="이름/연락처" />
    </div> <!-- box_row -->

    <div class="box_row mt10">
        <span>제품명</span>
        <input type="text" name="" class="mWt180" value="" placeholder="제품명" />
        <button type="button" class="bt_pd bt_black" onclick="">검색</button>
    </div> <!-- box_row -->
</div> <!-- search_box -->

<div class="list_top mt5">
    Total : 10
</div> <!-- list_top -->
<ul class="list_type1">
    <?for($i=0;$i<5;$i++){?>
    <li>
        <div>요청일 : 2020-04-14 &#124; 예정일 : 2020-04-14</div>
        <div>홍길동(010-1234-5678) <i>[유상 70,000]</i></div>
        <div>서울시 영등포구 여의도동 24길 23</div>
        <div><button type="button" class="dispose" onclick="load_page('complete_write')">부품폐기등록</button></div>
    </li>
    <li>
        <div>요청일 : 2020-04-14 &#124; 예정일 : 2020-04-14</div>
        <div>홍길동(010-1234-5678) <i>[무상]</i></div>
        <div>서울시 영등포구 여의도동 24길 23</div>
        <div><button type="button" class="dispose_ok" onclick="">부품폐기등록[완료]</button></div>
    </li>
    <?}?>
</ul> <!-- ul.list_type1 -->

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[AS]처리완료");
    };

    $(".search_br > button").on("click",function(){
        $(this).parent(".search_br").children("button").removeClass("active");
        $(this).addClass("active");
    });
</script>