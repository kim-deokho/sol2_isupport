<body>
    <section>
        <form method="post" name="loginFrm" id="loginFrm" action="/m/auth/login_proc">
        <div class="login_wrap">
            <div class="logo">LOGO</div>
            <div class="id_pw">
                <input type="text" name="user_id" value="" placeholder="ID" autofocus="" required />
                <input type="password" name="user_pwd" value="" placeholder="PASSWORD" required />
                <div class="fce41 fs13 mt10" ><?=$login_fail?></div>
            </div>

            <div class="login"><button type="submit" class="bt_blue">LOGIN</button></div>
        </div> <!-- login_wrap -->
        </form>
    </section>
</body>
