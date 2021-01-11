<div class="page_name">
    <span class="first_menu"></span> &gt; <span class="sub_menu"></span>
</div> <!-- page_name -->

<script type="text/javascript">
	$(document).ready(readyDoc);
	
	function readyDoc() {		
		// 현재 페이지명
		var first_menu = $("#<?=$lastdirname?>").children("a").text();
        var sub_menu = $("#<?=$pagename?>").children("a").text();
		$("span.first_menu").text(first_menu);
		$("span.sub_menu").text(sub_menu);

		if("<?=$pagename?>" == "notice_write" || "<?=$pagename?>" == "notice_view"){
			$("span.sub_menu").text("공지사항");
		};
	}
</script>