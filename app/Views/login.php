<div class="login_wrap">
    <div class="box">
        <div class="logo_name">
            <!--로고가 등록되지 않은경우 회사명 텍스트 출력 -->
            <!--<span class="logo_img"><img src="../common/img/logo.png" alt="LOGO" /></span>-->
            <span class="logo_txt">LOGO</span>
        </div>
        <form method="post" name="loginFrm" id="loginFrm" action="/auth/login_proc">
            <div class="id_pw">
                <input type="text" name="user_id" value="" placeholder="ID" autofocus="" required/>
                <input type="password" name="user_pwd" value="" placeholder="PASSWORD" required/>
                <div class="fs14 fcdb mt10" ><?=$login_fail?></div>
            </div>
            <!-- id_pw -->

            <div class="login_button">
                <button type="submit" class="set_bg">LOGIN</button>
            </div>
        </form>
        <!-- buttonCenter -->

        <div class="login_copy">Copyright © <span class="fw6">ISUPPORT Solution.</span> All Rights Reserved.</div>
        <!-- copyrigtht -->
    </div>
    <!-- box -->
</div>
