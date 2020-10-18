 <body>
    <header>
        <div class="header_wrap set_bor">
            <div class="logo_name">
                <!--로고가 등록되지 않은경우 회사명 텍스트 출력 -->
                <!--<span class="logo_img"><img src="<?=IMG_DIR?>/logo.png" alt="LOGO" /></span>-->
                <span class="logo_txt">LOGO</span>
            </div> <!-- logo_name -->

            <div class="top_menu">
                <ul>
<?
                    $active_pid=''; $fnm=''; $snm='';
                    foreach($setting['menu'] as $t_menu) {
                        $active='';
                        if($setting['HostUri'][1]==gethostUri($t_menu['menu_url'], 1)) {
                            $active_id=$t_menu['pid'];
                            $active=true;
                            $fnm=$t_menu['menu_name'];
                        }
                        echo '<li><a href="'.$t_menu['menu_url'].'" '.($active?'class="set_color"':'').'>'.$t_menu['menu_name'].'</a></li>';
                    }
?>
                </ul>
            </div> <!-- top_menu -->

            <div class="user_box">
                <div><img src="<?=IMG_DIR?>/mb.png" /><?=$setting['session']->get('ss_mn_name')?>님 접속중</div>
                <div>
                    <span onclick="">비밀번호변경</span>
                    <span onclick="location.href='/auth/logout'">로그아웃</span>
                </div>
            </div> <!-- user_box -->
        </div> <!-- header_wrap -->
    </header>

    <!-- 경고창 시작 -->
    <div class="alert_layer">
        <div class="alert_bg"></div>    
        <div class="alert_contents">
            <div class="alert_text"></div>
            <div class="alert_button">확인</div>
        </div>
    </div> <!-- alert_layer -->
    <!-- 경고창 끝 -->
    <div class="container" id="container">
<?
    include_once '_left_menu.php';
?>