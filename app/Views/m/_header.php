 <body>
    <header>
        <div class="header_wrap">
            <div onclick="lnb();"><img src="<?=M_IMG_DIR?>/menu.png" alt="menu" /></div>
            <div class="h_title"><?=$setting['page_title']?></div>
        </div> <!-- header_wrap -->
    </header>

    <nav>
        <div class="lnb_bg"></div>
        <div class="lnb">
            <div class="lnb_top">
                <div>
                    <div onclick="lnb_close();"><img src="<?=M_IMG_DIR?>/close.png" alt="메뉴 닫기" /></div>
                    <div><button class="bt_black" onclick="">로그아웃</button></div>
                </div>

                <div>
                    <img src="<?=M_IMG_DIR?>/mb.png" alt="" />
                    <span><?=$setting['session']->get('as_mn_name')?> 접속중</span>
                </div>
            </div> <!-- lnb_top -->
            
            <ul>		
<?
            foreach($setting['menus'] as $m_k=>$menu) {
                echo '<li id="'.$m_k.'" class="'.($m_k==$setting['HostUri'][2]?'active':'').'">';
                echo '    <a href="'.($menu['link']?$menu['link']:'javascript:void(0)').'">'.$menu['label'].'</a>';
                if($menu['sub']) {
                    echo '    <ul class="sub" '.($m_k==$setting['HostUri'][2]?'style="display:block;"':'').'">';
                    foreach($menu['sub'] as $s_menu) {
                        echo '<li><a href="/m/'.$m_k.'/'.$s_menu['link'].'">'.$s_menu['label'].'</a></li>';
                    }
                    echo '    </ul>';
                }
                echo '</li>';
            }
?>     	
            </ul>
        </div> <!-- lnb -->
    </nav>

    <div class="loading hidden">
        <div><img src="<?=M_IMG_DIR?>/loding.gif" /></div>
    </div>

<script type="text/javascript">
    $(".lnb > ul > li").on("click",function(){		
		if(!$(this).hasClass("active")){
			$(".lnb > ul > li").removeClass("active");
			$("ul.sub").slideUp();
			$(this).addClass("active");
			$(this).children("ul.sub").slideDown();
		};
	});
</script>