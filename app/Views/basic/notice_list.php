<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?>    
        <div class="search_box mt10">
            <div class="box_row">
                <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
                <input type="hidden" name="page" id="page" value="<?=$page?>">
                <span>등록일</span>
                    <input type="text" name="sdate" name="sdate" class="date mWt100 txac" value="<?=$sdate?>" > ~
                    <input type="text" name="edate" class="date mWt100 txac" value="<?=$edate?>" >                            
                <span class="ml20">제목</span>
                    <input type="text" name="searchWord" id="searchWord" class="mWt250" value="<?=$searchWord?>" placeholder="검색어" />
                    <button type="submit" class="bt_navy ml10">조회</button>
                </form>

                <div class="po_right">
                    <button type="button" class="bt_black" onclick="noticeWrite(event);">글쓰기</button>
                </div> <!-- po_right // 오른쪽 버튼 -->
                
            </div> <!-- box_row -->
        </div> <!-- search_box -->
        
        <?# 리스트 영역?>
        <div class="table_wrap" id="list_area"></div>

        <?# 페이징 영역?>
        <div class="mResultTablePage mContentWrap" id="paging"></div>
    </div> <!-- contents -->
</section>
<?
include_once 'popNoticeForm.php';
include_once 'popNoticeView.php';
?>
<script>
sendSearch();
function noticeWrite(evt, pid, type) {
    evt.preventDefault();
    evt.stopPropagation();

    var pid = pid || '';
    var type = type || '';
    if(type=='view') {
        gcUtil.loader();
        $.ajax({
            data: {pid:pid},
            type: "POST",
            url: "/basic/popNoticeViewData",
            cache: false,
            dataType:'html',
            success: function(resHtml) {
                gcUtil.loader('hide');
                $('#id_pop_notice_view').html(resHtml);
                pop_modal('pop_notice_view');
            }
        });
    }
    else {
        document.forms['regFrm'].bd_pid.value=pid;
        if(pid) {
            gcUtil.loader();
            $.ajax({
                data: {mode:'get_notice', pid:pid},
                type: "POST",
                url: "/basic/ajax_request",
                cache: false,
                dataType:'json',
                success: function(resJson) {
                    gcUtil.loader('hide');
                    // console.log('res', resJson);
                    if(!resJson.bd_pid) {
                        alertBox('정보를 가져오는데 실패했습니다.');
                    }
                    else {
                        setFormData('regFrm', resJson);
                        pop_modal('pop_notice_reg');
                    }
                }
            });
        }
        else {
            $('#regFrm #reg_date').html('');
            setFormData('regFrm');
            pop_modal('pop_notice_reg');
        }
    }
}
function noticeDel(pid) {
    gcUtil.loader();
    $.ajax({
        data: {mode:'del_notice', bd_pid:pid},
        type: "POST",
        url: "/basic/execute",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            gcUtil.loader('hide');
            var msg='';
            if(resJson.err_msg) msg=resJson.err_msg;
            else if(resJson.msg) {
                msg=resJson.msg;

                alertBox(msg, location.reload());
            }
        }
    });
}
$(function(){
    // 파일첨부
    $(".file_wrap > button").on("click",function(){        
        $(this).parent(".file_wrap").children("input[type=file]").click();
    });

    $(".file_wrap > input[type=file]").on("change", function(){
        var file_val = $(this)[0].files[0].name;
        $(this).prevAll(".file_val").text(file_val);
    });

    $(".file_wrap > .file_del").on("click",function(){        
        $(this).prev(".file_val").text("");
        $(this).next("input[type=file]").val("");
        $('#'+$(this).attr('data-target')).val('Y');
    });
});
</script>