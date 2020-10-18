$(function() {	
	// 팝업창 드래그 설정
	$(".layer_pop_wrap").draggable();	

	// 달력 한국어
	$.datepicker.setDefaults({
        dateFormat: 'yy-mm-dd',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: ''
    });

	$(".date").datepicker({
		yearRange: 'c-100:c+10',
		changeYear: true,
		changeMonth: true
		/*
		showOn: "button", 
		buttonImage: "/common/img/button_calendar2.png", 
		buttonImageOnly: true
		*/
	});

	$(".date").on('click',function(){
		//var id_val = $(this).attr("id");
		//$("#"+id_val).datepicker('show');
		$(this).datepicker('show');
	});

	// 테이블 리스트 클릭
    $("table.t_effect_1 > tbody > tr").on("click",function(){
        $("table.t_effect_1 > tbody > tr").removeClass("active");
        $(this).addClass("active");
	});
	
	$("table.t_effect_2 > tbody > tr").on("dblclick",function(){
        $("table.t_effect_2 > tbody > tr").removeClass("active");
        $(this).addClass("active");
	});
	
	// 테이블 리스트 클릭
    $("ul.list_type_1 > li").on("click",function(){
		$(this).parent("ul").children("li").removeClass("active");
        $(this).addClass("active");
	});

	// 테이블 오름 내림 차순 up / down
	$("table th > i").on("click",function(){    
        if($(this).hasClass("down") === true){
            $(this).removeClass("down");
            $(this).addClass("up");
        }else{
            $(this).removeClass("up");
            $(this).addClass("down");
        }
	});
	
	/*탭*/
	$(".tab_base > a").on('click',function(e){
		var title = $(this).attr("title");
		$(this).parents(".tab_wrap").children(".tab_base_con").hide();
		$(this).parents(".tab_wrap").children("#"+title).fadeIn()
		$(this).parents(".tab_wrap").children(".tab_base").children("a").removeClass("active");
		$(this).addClass("active");
	});

	if (location.hash != "") {
		var hash = location.hash;
		var hash2 = hash.substr(1,6);
		var a_num = hash2.substr(5,5);
		$(".tab_base > a").removeClass("active");
		$("#a_t"+a_num).addClass("active");
		$(".tab_base_con").hide();
		$("#m_tab" + a_num).fadeIn();
	};
}); // ready 끝

// 모달팝업
function modal(el){
    var temp = $("#" + el); 
    temp.modal({        
        fadeDuration: 0,
        escapeClose: false,
        clickClose: false,
        showClose: false,
		closeExisting: false
    });

    temp.draggable({
        handle: ".modal_header"
    });     
};

// 경고창
function alert_layer(tx){	
	var temp = $(".alert_contents");
	var temp2 = $(".alert_layer");
	temp2.fadeIn();

	// 화면의 중앙에 레이어를 띄운다.
	if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
	else temp.css('top', '0px');
	if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
	else temp.css('left', '0px');

	temp.find(".alert_text").html(tx);

	temp.find(".alert_button").click(function(e){            
		temp2.fadeOut();
		e.preventDefault();		
	});
}

