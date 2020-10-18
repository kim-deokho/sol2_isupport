 <?if($show=='Y'){?>
        </div>
        <div class="footer_wrap">
            <div class="copyright">
            Copyright © ISUPPORT Solution. All Rights Reserved.
            </div>
        </div>
    </body>
    <script>
        $(function(){
            $('.first_menu').text(jsConfig.url_path.fnm);
            $('.sub_menu').text(jsConfig.url_path.snm);
        });
    </script>
 <?}?>    
    <iframe id="hiddenFrame" name="hiddenFrame"  style="width:100%;height:1000px;" cellspacing="0" cellpadding="0" frameborder="0" scrolling="auto"></iframe>
</html>