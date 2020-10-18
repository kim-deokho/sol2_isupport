$(function() {
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
    
    /* nav */
	$('.lnb_bg').on('click', function(){		
		$('.lnb').stop().animate({'left':'-62%'}, 300);
		$('body').css('overflow','auto');
		$('.lnb_bg').fadeOut();
	});

	/* footer */
	$("footer > ul > li").on("click", function(){				
		$(this).parent("ul").children("li").removeClass("active");
		$(this).addClass("active");

		var tid = $(this).attr("id");
        $.ajax({
            type : 'GET',
            url : tid + ".php",
            dataType : "html",
            error : function() {
                alert("error");
            },
            success : function(data) {
                $('.contents').html(data);
            },
            beforeSend:function(){
                $('.loading').removeClass('hidden');
            },
            complete:function(){
                $('.loading').addClass('hidden');
            }
        });
	});
}); // ready 끝

/* date */
$(document).on("click",".date",function(){    
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
    
    $(this).datepicker('show');
});

function load_page(page){
    $.ajax({
        type : 'GET',
        url : page + ".php",
        dataType : "html",
        error : function() {
            alert("error");
        },
        success : function(data) {
            $('.contents').html(data);
        },
        beforeSend:function(){
            $('.loading').removeClass('hidden');
        },
        complete:function(){
            $('.loading').addClass('hidden');
        }
    });
}

/* nav */
function lnb(){
	$('.lnb').stop().animate({'left':'0'}, 300);
	$('body').css('overflow','hidden');
	$('.lnb_bg').fadeIn();
};

function lnb_close(){	
	$('.lnb').stop().animate({'left':'-62%'}, 300);
	$('body').css('overflow','auto');
	$('.lnb_bg').fadeOut();
};

// 모달팝업
function modal(el){
    var temp = $("#" + el); 
    temp.modal({        
        fadeDuration: 0,
        escapeClose: false,
        //clickClose: false,
		showClose: false,
		closeExisting: false		
    });

    $('.modal_close').click(function(e){        
        e.preventDefault();             
        temp.hide();
        $(this).closest(".blocker").click();
    });

    temp.draggable({
        handle: ".modal_header"
    });     
};

// url 인자 파싱
function getUrlParams() {
    var params = {};
    window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(str, key, value) { params[key] = value; });
    return params;
}