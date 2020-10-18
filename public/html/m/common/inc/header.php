<header>
    <div class="header_wrap">
        <div onclick="lnb();"><img src="../common/img/menu.png" alt="menu" /></div>
        <div class="h_title"></div>
    </div> <!-- header_wrap -->
</header>

<nav>
    <div class="lnb_bg"></div>
    <div class="lnb">
        <div class="lnb_top">
            <div>
                <div onclick="lnb_close();"><img src="../common/img/close.png" alt="메뉴 닫기" /></div>
                <div><button class="bt_black" onclick="">로그아웃</button></div>
            </div>

            <div>
                <img src="../common/img/mb.png" alt="" />
                <span>김기사님 접속중</span>
            </div>
        </div> <!-- lnb_top -->
        
        <ul>			
			<li id="delivery">
				<a href="javascript:void(0);">배송관리</a>
				<ul class="sub_menu">
                    <li><a href="../delivery/?con=status">배정현황</a></li>
                    <li><a href="../delivery/?con=going">배송중</a></li>
                    <li><a href="../delivery/?con=complete">배송완료</a></li>
				</ul>
            </li>
            <li id="as">
				<a href="javascript:void(0);">AS관리</a>
				<ul class="sub_menu">
                    <li><a href="../as/?con=status">배정현황</a></li>
                    <li><a href="../as/?con=going">방문예정</a></li>
                    <li><a href="../as/?con=progress">처리중</a></li>
                    <li><a href="../as/?con=complete">처리완료</a></li>
				</ul>
            </li>
            <li id="parts">
				<a href="javascript:void(0);">부품</a>
				<ul class="sub_menu">
                    <li><a href="../parts/?con=status">부품현황</a></li>
                    <li><a href="../parts/?con=request">요청내역</a></li>
                    <li><a href="../parts/?con=dispose">폐기내역</a></li>
				</ul>
            </li>		
		</ul>
    </div> <!-- lnb -->
</nav>

<div class="loading hidden">
    <div><img src="../common/img/loding.gif" /></div>
</div>

<script type="text/javascript">
    // 메뉴
    $(document).ready(readyDoc);

    function readyDoc() {
        $("li#<?=$lastdirname?>").addClass("active");
        $("li#<?=$lastdirname?>").children("ul.sub_menu").show();
    };	
    $(".lnb > ul > li").on("click",function(){		
		if(!$(this).hasClass("active")){
			$(".lnb > ul > li").removeClass("active");
			$("ul.sub_menu").slideUp();
			$(this).addClass("active");
			$(this).children("ul.sub_menu").slideDown();
		};
	});
</script>