$(document).ready(readyDoc);
window.onpopstate = function(event) {

    console.log('history', event);
    sendSearch('history');
}
function readyDoc() {
    attachEvt();
}; // readyDoc 끝

var cateCtr=null;
function attachEvt() {
    $('input').on('keyup', function(evt) {
        if($(this).attr('_enter')) {
            if(evt.keyCode==13) eval($(this).attr('_enter')+'()');
        }
        if($(this).hasClass('input-comma')) new Input_money_by_name($(this).attr('name'));
    });

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
    setBtnPermition();

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
        $("#"+input_id+"_del").val("Y");
    });

    // 멀티 셀렉트(쿼리에 멀티값이 없을때만 기본셋팅 / 있을때는 setFormQUery에서 셋팅 : 중복셋팅오류방지)
    getQueryStringObject();
    if(!jsConfig.multi_query) $('.multi_select').multipleSelect();

} 
// 권한에 의한 저장,삭제,출력,엑셀
function setBtnPermition() {
    if(jsConfig.pagePermition) {
        if(jsConfig.pagePermition.access!='Y') {
            $('.container').addClass('d_none');
            alertBox("접속 권한이 없습니다.", win_load, 'back');
        }
        if(jsConfig.pagePermition.save!='Y') $('.js-save-btn').addClass('d_none');
        if(jsConfig.pagePermition.del!='Y') $('.js-del-btn').addClass('d_none');
        if(jsConfig.pagePermition.print!='Y') $('.js-print-btn').addClass('d_none');
        if(jsConfig.pagePermition.excel!='Y') $('.js-excel-btn').addClass('d_none');
    }
}

function sendSearch(pg) {
    var pg = pg || '';
    var f = document.forms['searchFrm'];
    if(pg=='history' || !pg) setFormQuery(pg);
    if(pg!='history') f.page.value=pg || (f.page.value>0 ? f.page.value : 1);

    
    var url_path=location.pathname.replace(/\/$/, '');
    var data_url = url_path+'_data';
    var params_data=$('#searchFrm').serialize();

    console.log('pg', pg);

    if(pg && pg!='history') {
        console.log('push');
        history.pushState(null, jsConfig.url_path.fnm+'>'+jsConfig.url_path.snm, url_path+'?'+params_data);
    }
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
            setBtnPermition();
        }
    });
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
        // console.log('all',type_name, d_k, k, querys[k]);
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
                // console.log('multi', d_k, k, querys[k]);
                $select = $("[name='"+d_k+"']");
                $select.multipleSelect();
                exp_val=querys[k].split(',');

                $select.multipleSelect('setSelects', exp_val);
            }
            else if(tag_name=='SELECT' && $("[name='"+d_k+"']").hasClass('js-single-selector')) {
                // console.log('single', d_k, k, querys[k]);
                $("[name='"+d_k+"']").select2('val', querys[k]);
            }
            else {
                // console.log('normal', d_k, k, querys[k]);
                $('#'+k).val(querys[k]);
            }
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
                multiple=$("[name='"+d_k+"']").prop('multiple');

                // console.log('tagNmae', tagName, k, data[k]);
                if(tagName=='SELECT' && multiple) {
                    // console.log('on', d_k);
                    $select = $("[name='"+d_k+"']");
                    $select.multipleSelect();
                    exp_val=data[k].split(',');
                    // console.log('exp_val', exp_val, d_k, k);
                    $select.multipleSelect('setSelects', exp_val);
                }
                else if(tagName=='SELECT' && $("[name='"+d_k+"']").hasClass('js-single-selector')) {
                    $("[name='"+d_k+"']").select2('val', data[k]);
                }
                else {
                    if(tagName=='SPAN') $('#'+frm_id+' #'+k).html(data[k]);
                    else $('#'+frm_id+' #'+k).val(data[k]);
                }
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

