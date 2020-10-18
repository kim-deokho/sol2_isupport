<?          
        include_once "../common/inc/head.php"; // head
    ?>
	
    <body>
        <?            
            include_once "../common/inc/header.php"; // header
        ?>

        <section>
            <div class="contents">                
            </div> <!-- contents -->
        </section>

        <?            
            include_once "./footer.php"; // footer
        ?>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(readyDoc);

    function readyDoc() {
        var par = getUrlParams();        
        $("#"+par.con).click();
    };
</script>