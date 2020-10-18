$(document).ready(readyDoc);
window.onpopstate = function(event) {

    console.log('history', event);
    sendSearch('history');
}
function readyDoc() {
    attachEvt();
}; // readyDoc 끝

function attachEvt() {

    // 전체체크/해제
    $('.allCheck').on('click', function(){
        var target_chk=$(this).attr('data-check');
        if($(this).prop('checked')) $('.'+target_chk).prop('checked', true);
        else $('.'+target_chk).prop('checked', false);
    });

    // 체크/해제
    $('.lineCheck').on('click', function(){
        var target_chk=$(this).attr('data-line');
        if($(this).prop('checked')) $('.'+target_chk).prop('checked', true);
        else $('.'+target_chk).prop('checked', false);
    });

    // 권한에 의한 저장,삭제,출력,엑셀
    if(jsConfig.pagePermition) {
        if(jsConfig.pagePermition.access!='Y') {
            $('.container').addClass('d_none');
            alertBox("접속 권한이 없습니다.", win_back);
        }
        if(jsConfig.pagePermition.save!='Y') $('.js-save-btn').addClass('d_none');
        if(jsConfig.pagePermition.del!='Y') $('.js-del-btn').addClass('d_none');
        if(jsConfig.pagePermition.print!='Y') $('.js-print-btn').addClass('d_none');
        if(jsConfig.pagePermition.excel!='Y') $('.js-excel-btn').addClass('d_none');
    }

    // 파일찾기
    $('.find_file').on("click",function(){
        $('#'+$(this).attr('data-target')).click();
    });

    // 파일 미리보기
    $('.prev_file').on("change",function(){	
        gcUtil.prevFileImg(this);
    });

    // 파일 삭제
    $('.del_file').on("click",function(){	
        var prev_id=$(this).attr('data-prev');
        var empty_img=$(this).attr('data-empty');
        var input_id=$(this).attr('data-input');
        if(empty_img) $('#'+prev_id).attr('src', empty_img);
        $("#"+input_id).val("");
    });

    // 멀티 셀렉트(쿼리에 멀티값이 없을때만 기본셋팅 / 있을때는 setFormQUery에서 셋팅)
    getQueryStringObject();
    if(!jsConfig.multi_query) $('.multi_select').multipleSelect();

}
function win_back() {
    history.back();
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
        alertify.message("문자는 입력하실 수 없습니다.");
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
                alertify.error(resJson.msg);
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

function getQueryStringObject() {
    var a = window.location.search.substr(1).split('&');
    if (a == "") return {};
    var b = {};
    jsConfig.multi_query=false;
    for (var i = 0; i < a.length; ++i) {
        var p = a[i].split('=', 2);
        if(b[p[0]]) {
            if (p.length > 1) {               
                jsConfig.multi_query=true;
                b[p[0]] = b[p[0]]+","+decodeURIComponent(p[1].replace(/\+/g, " "));
            }
        }
        else {
            if (p.length == 1)
                b[p[0]] = "";
            else
                b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
    }
    return b;
}

function sendSearch(pg) {
    var f = document.forms['searchFrm'];
    if(pg=='history' || !pg) setFormQuery(pg);
    if(pg!='history') f.page.value=pg || (f.page.value>0 ? f.page.value : 1);

    
    var url_path=location.pathname.replace(/\/$/, '');
    var data_url = url_path+'_data';
    var params_data=$('#searchFrm').serialize();

    if(pg && pg!='history') 
        history.pushState(null, jsConfig.url_path.fnm+'>'+jsConfig.url_path.snm, url_path+'?'+params_data);
    gcUtil.loader('show', '#list_area');
    $.ajax({
        data: params_data,
        type: "POST",
        url: data_url,
        cache: false,
        dataType:'json',
        success: function(resJson) {
            // console.log(resJson);
            gcUtil.loader('hide', '#list_area');
            $('#list_area').html(resJson.html);
            paging(resJson.totCnt, resJson.page, resJson.rcnt);
        }
    });
}


function setFormQuery(pg) {
    document.forms['searchFrm'].reset();
    
    var querys = getQueryStringObject();
    // console.log('mult', jsConfig.multi_query, querys);
    if(jsConfig.multi_query) {
        $multi_select = $(".multi_select");
        $multi_select.multipleSelect('destroy');
    }
    else {
        if(pg=='history') {
            $multi_select = $(".multi_select");
            $multi_select.multipleSelect('refresh');
        }
    }
    
    for(var k in querys) {
        d_k=decodeURIComponent(k);
        type_name=$("input[name='"+d_k+"']").attr('type');
        if(type_name=='checkbox' || type_name=='radio') {
            exp_val=querys[k].split(',');
            $("input:"+type_name+"[name='"+d_k+"']").each(function(ei) {
                if($.inArray($(this).val(), exp_val)!==-1) {
                    this.checked=true;
                }
            });
        }
        else {
            tag_name=$("[name='"+d_k+"']").prop('tagName');
            multiple=$("[name='"+d_k+"']").prop('multiple');

            if(tag_name=='SELECT' && multiple) {
                // console.log('on', d_k);
                $select = $("[name='"+d_k+"']");
                $select.multipleSelect();
                exp_val=querys[k].split(',');
                // console.log('exp_val', exp_val, d_k, k);
                $select.multipleSelect('setSelects', exp_val);
            }
            else $('#'+k).val(querys[k]);
        }
    }
    if(cateCtr) cateCtr.set();
}

function setFormData(frm_id, data) {
    $('#'+frm_id)[0].reset();
    var data = data || '';
    if(data) {
        for(var k in data) {
            d_k=decodeURIComponent(k);
            type_name=$("input[name='"+d_k+"']").attr('type');
            // console.log(d_k, type_name);
            if(type_name=='checkbox' || type_name=='radio') {
                if(data[k]) {
                    exp_val=data[k].split(',');
                    $("input:"+type_name+"[name='"+d_k+"']").each(function(ei) {
                        if($.inArray($(this).val(), exp_val)!==-1) {
                            this.checked=true;
                        }
                    });
                }
            }
            else {
                tagName=$('#'+frm_id+' #'+k).prop('tagName');
                // console.log('tagNmae', tagName, k, data[k]);
                if(tagName=='SPAN') $('#'+frm_id+' #'+k).html(data[k]);
                else $('#'+frm_id+' #'+k).val(data[k]);
            }
        }
    }
}

function paging(totalData, currentPage, dataPerPage){
    var totalData = parseInt(totalData);
    var currentPage = parseInt(currentPage);
    var dataPerPage = parseInt(dataPerPage);

    var pageCount=10;    
    var totalPage = Math.ceil(totalData/dataPerPage);    // 총 페이지 수
    var first=0;
    var last=0;
    if(totalPage < pageCount) {
        if(currentPage > pageCount) first = 1;
		if((totalPage-currentPage) > pageCount) last = totalPage;
    }

    if(currentPage>1 && totalData>dataPerPage) first = 1;
	if(totalPage-currentPage>0 && totalData>dataPerPage) last = totalPage;

    var prev=0;
    var next=0;
	if(currentPage > 1) prev = currentPage - 1; // 이전 페이지
	if(currentPage + 1 <= totalPage) next = currentPage + 1;


	if(next > totalPage) next=1;

	// 각 페이지 번호 구하기
	var nBlock = Math.ceil(currentPage / pageCount);
	var nExpire = nBlock * pageCount;
	if(nExpire >= totalPage) nExpire = totalPage;

	var nInspire = (nBlock -1) * pageCount;
    if(nInspire < 1) nInspire = 1;
    
    // console.log("totalPage : " + totalPage);
    // console.log("last : " + last);
    // console.log("first : " + first);
    // console.log("next : " + next);
    // console.log("prev : " + prev);
    // console.log("nInspire : " + nInspire);
    // console.log("nExpire : " + nExpire);

    
    var html = `<div class="pageFirstButton pageButton">
                <span data-page="${first}"><img src="${jsConfig.imgDir}/button_list_big1_first.png" class="" alt="처음으로" ></span>
            </div>`;
        html += `<div class="pagePrevButton pageButton">
            <span data-page="${prev}"><img src="${jsConfig.imgDir}/button_list_big1_prev.png" alt="이전으로" ></span>
        </div>`;
        html += `<div class="pageNum">`;
        for(var i=nInspire; i <= nExpire; i++){
            className='';
            dataPage=i;
            if(currentPage==i) {
                className='on';
                dataPage=0;
            }
            html += `<span class="${className}" data-page="${dataPage}">${i}</span>`;
        }
        html += `</div>`;
        html += `<div class="pageNextButton pageButton">
                <span data-page="${next}"><img src="${jsConfig.imgDir}/button_list_big1_next.png" alt="다음으로" ></span>
            </div>`;
        html += `<div class="pageLastButton pageButton">
                <span data-page="${last}"><img src="${jsConfig.imgDir}/button_list_big1_last.png" alt="마지막으로" ></span>
            </div>`;

    $("#paging").html(html);
    $('#paging span').each(function(){
        var data_page=$(this).attr('data-page');
        if(data_page>0) {
            $(this).css('cursor', 'pointer');
            $(this).on('click', function(){
                sendSearch(data_page);
            });
        }
    });                             
}

function listExcel(frm_id) {
    var frm_id = frm_id || 'searchFrm';
    var f = document.forms[frm_id];
    var url_path=location.pathname.replace(/\/$/, '');
    var excel_url = url_path+'_excel';
    f.action = excel_url;
    f.submit();
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