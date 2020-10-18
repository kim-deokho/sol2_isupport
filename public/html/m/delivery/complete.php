<div class="search_box">
    <div class="box_row">
        <span>완료일</span>
        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/> ~ 
        <input type="text" name="" class="date mWt100" value="" onFocus="this.blur()"/>        
    </div> <!-- box_row -->

    <div class="box_row mt10">
        <span>고객명</span>
        <input type="text" name="" class="mWt180" value="" placeholder="이름/연락처" />
    </div> <!-- box_row -->

    <div class="box_row mt10">
        <span>상품명</span>
        <input type="text" name="" class="mWt250" value="" placeholder="상품명" />
    </div> <!-- box_row -->    
</div> <!-- search_box -->

<div class="list_top mt5">
    Total : 10
</div> <!-- list_top -->
<ul class="list_type1">
    <?for($i=0;$i<10;$i++){?>
    <li onclick="load_page('complete_write')">
        <div>주문일 : 2020-04-14   &#124;   완료일 : 2020-04-14</div>
        <div>홍길동(010-1234-5678) <i>[09:00 배송완료]</i></div>
        <div>서울시 영등포구 여의도동 24길 23</div>
    </li>
    <?}?>
</ul> <!-- ul.list_type1 -->

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        $(".h_title").text("[배송]배송완료");
    };
</script>