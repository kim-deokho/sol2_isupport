var jsConfig = {isLogin:false, imgDir:'/assets/img', editorDir:'/assets/lib/SE2', isSubmit:false, url_path:{fnm:null, snm:null}, pagePermition:null, multi_query:false};
jQuery.fn.serializeObject = function() {
    var obj = null;
    try {
        if (this[0].tagName && this[0].tagName.toUpperCase() == "FORM") {
            var arr = this.serializeArray();
            if (arr) {
                obj = {};
                jQuery.each(arr, function() {
                    obj[this.name] = this.value;
                });
            }//if ( arr ) {
        }
    } catch (e) {
        alert(e.message);
    } finally {
    }
 
    return obj;
};
var gcUtil = {
    loader : function(type, targetId, target) {
        var type = type || 'show';
        var targetId = targetId || '#container';
        var target = target || '';
        if(type=='show'){
            if(jsConfig.isSubmit) return false;
            jsConfig.isSubmit=true;
            $(targetId, target).block({ message: '<div>L O A D I N G . . .</div>', css:{ 
                border: 'none', 
                padding: '15px', 
                backgroundColor: '#000', 
                '-webkit-border-radius': '10px', 
                '-moz-border-radius': '10px', 
                opacity: .5, 
                color: '#fff' 
            } });            
        }
        else {
            jsConfig.isSubmit=false;
            $(targetId, target).unblock();
        }
    }
    ,frmEn : function(id) {
        $('#'+id).find('input, select, radio, checkbox, file, textarea').prop('disabled', false);
    }
    ,prevFileImg : function(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) { 
                var prev_target=$('#'+input.id).attr('data-prev');
                $('#'+prev_target).attr('src', e.target.result);
            }                   
            reader.readAsDataURL(input.files[0]);
        }
    }
};
/*
function getDatepickerDefaultOption() {
    return {
        dateFormat: 'yy-mm-dd',
        showAnim: 'slideDown',
        prevText: '이전 달',
        nextText: '다음 달',
        monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
        dayNames: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
        dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
        showMonthAfterYear: true,
        yearSuffix: '년'
    };
}
function setDatepickerPeriod(sdate_id, edate_id) {
    // datepicker
    $( "#"+sdate_id ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#"+edate_id ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#"+sdate_id ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    $( "#"+edate_id ).datepicker({
        changeMonth: true,
        onClose: function( selectedDate ) {
            $( "#"+sdate_id ).datepicker( "option", "maxDate", selectedDate );
        }
    });
    $( "#"+edate_id ).datepicker( "option", "dateFormat", "yy-mm-dd" );
}
$.datepicker.setDefaults(getDatepickerDefaultOption());
*/
function win_load(type) {
    var type = type || 'reload';
    var return_url = return_url || '';
    if(type=='reload') top.location.reload();
    else if(type=='href') top.location.href=top.location.href;
    else if(type=='back') history.back();
    else top.location.href=type;
}

function resultReList() {
    sendSearch();
    close_modal();
}

function setRadio(name, value) {
    $('input:radio[name="'+name+'"][value="'+value+'"]').prop('checked', true);
}

function getRadio(name) {
    return $('input:radio[name="'+name+'"]:checked').val();
}

// 체크한 체크박스 값
function getCheckbox(chk_id, separator) {
    var separator = separator || ',';
	var chkList = document.getElementsByName(chk_id);
	var checks = '';
	for (var i=0; i<chkList.length; i++) {
		if(chkList[i].checked == false) continue;
		checks += chkList[i].value+separator;
	}
	if(checks!='') checks = checks.substr(0, checks.length-1);
	return checks;
}

// 체크박스
function setCheckbox(eleName, str, separator) {    
    if(str=='') return;
    var separator = separator || ',';
    var exp = str.split(separator);
	var ele = document.getElementsByName(eleName);
	for(var i=0, len=ele.length; i < len; i++) {
		ele[i].checked = false;
		for(var j=0, jlen=exp.length; j < jlen; j++) {
			if(ele[i].value==exp[j]) {
				ele[i].checked = true;
				break;
			}
		}
	}
}

function inputNumberAutoComma(obj) {        
    // 콤마( , )의 경우도 문자로 인식되기때문에 콤마를 따로 제거한다.
    var deleteComma = obj.value.replace(/\,/g, "");

    // 콤마( , )를 제외하고 문자가 입력되었는지를 확인한다.
    if(isFinite(deleteComma) == false) {
        alert("문자는 입력하실 수 없습니다.");
        obj.value = "";
        return false;
    }
    
    // 기존에 들어가있던 콤마( , )를 제거한 이 후의 입력값에 다시 콤마( , )를 삽입한다.
    obj.value = inputNumberWithComma(inputNumberRemoveComma(obj.value));
}

// 천단위 이상의 숫자에 콤마( , )를 삽입하는 함수
function inputNumberWithComma(str) {
    if(!str) return 0;
    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

// 콤마( , )가 들어간 값에 콤마를 제거하는 함수
function inputNumberRemoveComma(str) {
    str = String(str);
    str = str.replace(/(^0+)/, "");
    return str.replace(/[^\d]+/g, "");
}

function getBrowser() {
	var agt = navigator.userAgent.toLowerCase();
	if (agt.indexOf("chrome") != -1) return 'Chrome';
	if (agt.indexOf("opera") != -1) return 'Opera';
	if (agt.indexOf("staroffice") != -1) return 'Star Office';
	if (agt.indexOf("webtv") != -1) return 'WebTV';
	if (agt.indexOf("beonex") != -1) return 'Beonex';
	if (agt.indexOf("chimera") != -1) return 'Chimera';
	if (agt.indexOf("netpositive") != -1) return 'NetPositive';
	if (agt.indexOf("phoenix") != -1) return 'Phoenix';
	if (agt.indexOf("firefox") != -1) return 'Firefox';
	if (agt.indexOf("safari") != -1) return 'Safari';
	if (agt.indexOf("skipstone") != -1) return 'SkipStone';
	if (agt.indexOf("msie") != -1) return 'IE';
	if (agt.indexOf("netscape") != -1) return 'Netscape';
	if (agt.indexOf("mozilla/5.0") != -1) return 'Mozilla';
}

function getIEVer() {
    var agt = navigator.userAgent.toLowerCase();
    var word = 'msie';
    var reg = new RegExp( word + "([0-9]{1,})(\\.{0,}[0-9]{0,1})" ); if ( reg.exec( agt ) != null ) return RegExp.$1 + RegExp.$2;
}

// form file
function bs_input_file() {
	$(".input-file").before(
		function() {
			if ( ! $(this).prev().hasClass('input-ghost') ) {
				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
				element.attr("name",$(this).attr("name"));
				element.change(function(){
					element.next(element).find('input').val((element.val()).split('\\').pop());
				});
				$(this).find("button.btn-choose").click(function(){
					element.click();
				});
				$(this).find("button.btn-reset").click(function(){
					element.val(null);
					$(this).parents(".input-file").find('input').val('');
				});
				$(this).find('input').css("cursor","pointer");
				$(this).find('input').mousedown(function() {
					$(this).parents('.input-file').prev().click();
					return false;
				});
				return element;
			}
		}
	);
}
function summerSendFile(file, el) {
    var form_data = new FormData();
    form_data.append('file', file);
    $.ajax({
        data: form_data,
        type: "POST",
        url: '/common/editor_fileupload',
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function(res) {
            var resJson=JSON.parse(res);
            if(!resJson.success) {
                alert(resJson.msg);
                return false;
            }
           
            // var image = $('<img>').attr('src', resJson.res.file_name);
            // console.log(image[0]);
            // $('.summernote').summernote("insertNode", image[0]);
            $(el).summernote('editor.insertImage', resJson.res.file_name);
        }
    });
}

function resizeFrame(frame_id, add_h, limit_h) {
    var add_h = add_h || 0;
    var limit_h = limit_h || 0;
    var lastHeight = 0, curHeight = 0, $frame = $('#'+frame_id);
    //setTimeout(function(){
    curHeight = $frame.contents().find('body').height();
    curHeight += add_h;
    if(curHeight > limit_h && limit_h>0) curHeight=limit_h;
    //console.log(frame_id+'/'+curHeight+'/'+$frame.prop('scrollHeight'));
    if ( curHeight != lastHeight ) {
        $frame.css('height', (lastHeight = curHeight) + 'px' );
    }
    //},500);
}

function getUrlParams() {
    var params = {};
    window.location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(str, key, value) { params[key] = value; });
    return params;
}

/*
 팝업오픈
 surl : 팝업URL
 winName : 팝업명
 popupwidth : 팝업넓이
 popupheight : 팝업길이
 scrollbar : 스크롤여부
 resize : 리사이즈여부
 */
function PopUpWindowNameOpen(surl, winName, popupwidth, popupheight, scrollbar, resize) {
	scrollbar = scrollbar ? scrollbar : 'auto';
	resize = resize ? resize : 'no';
	Top = (window.screen.availHeight - parseInt(popupheight)) / 2;
	Left = (window.screen.availWidth - parseInt(popupwidth)) / 2;

	Future = "fullscreen=no,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=" + scrollbar + ",resizable=" + resize + ",left=" + Left + ",top=" + Top + ",width=" + popupwidth + ",height=" + popupheight;
	HiddenWindow = window.open(surl, winName, Future);
	//HiddenWindow.location = (surl!="") ? surl : "";

	//HiddenWindow.resizeTo(parseInt(popupwidth)+10, parseInt(popupheight)+29);
	HiddenWindow.focus();
	return HiddenWindow;
}

// 모달팝업
function pop_modal(el, is_close){
    var is_close = is_close || 'Y';
    var temp = $("#" + el); 
    temp.modal({        
        fadeDuration: 0,
        escapeClose: false,
        clickClose: false,
        showClose: false,
		closeExisting: is_close=='Y' ? true : false
    });

    temp.draggable({
        handle: ".modal_header"
    });     
};

function close_modal() {
    // console.log('modal', $.modal.length, $.modal.getCurrent());
    $.modal.getCurrent().close();
}