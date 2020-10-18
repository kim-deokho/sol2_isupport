    <?            
        include_once "../common/inc/head.php"; // head
    ?>
	
    <body>
		<section>
            <div class="login_wrap">
                <div class="logo">LOGO</div>

                <div class="id_pw">
                    <input type="text" name="" value="" placeholder="ID" />
                    <input type="password" name="" value="" placeholder="PASSWORD" />
                </div>

                <div class="login"><button class="bt_blue" onclick="login();">LOGIN</button></div>
            </div> <!-- login_wrap -->
        </section>
    </body>
</html>

<script type="text/javascript">
    function login(){       
        location.href="../delivery/?con=status";
    }  
</script>