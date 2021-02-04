<link rel="stylesheet" type="text/css" href="<?=M_CSS_DIR?>/signature-pad.css">
<style type="text/css">
    #pop_as_proc {max-width: 1100px;}
    #pop_as_proc table.ltable_1 td {text-align:center;}
    /* #pop_as_proc #signature-pad {width: 234px;height: 100px;border: 1px solid #d9d9d9;box-sizing: border-box;} */
</style>

<div id="pop_as_proc" class="modal">
	<div class="modal_header">
		<div class="modal_title">
			<span>AS 처리</span>
			<span></span>
		</div> <!-- modal_title -->
		<div class="modal_close">
			<a href="#" rel="modal:close"><img src="<?=IMG_DIR?>/pop_close.png" alt="팝업닫기" /></a>
		</div> <!-- modal_close --> 
	</div> <!-- modal_header -->

	<div class="modal_contents">
        <form name="asFrm" id="asFrm" method="post" autocomplete="off" onsubmit="SaveUpdate();return false;" enctype="multipart/form-data" target="hiddenFrame" action="/delivery/update_as">
        <input type="hidden" name="aa_pid">
        <input type="hidden" name="ma_pid">
        <input type="hidden" name="mc_pid">
        <input type="hidden" name="mb_pid">
		<div class="two_areas" id="as_form_box">
		</div> <!-- two_areas -->                

		<div class="buttonRight mt20">
			<a href="#" rel="modal:close"><button type="button" class="bt_150_40 bt_gray pop_close" onclick="">취소</button></a>
			<button type="submit" class="js-save-btn bt_150_40 bt_black">저장</button>
        </div> <!-- buttonRight -->
        </form>
	</div> <!-- modal_contents -->
</div> <!-- modal -->
<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="<?=JS_DIR?>/daum.post.ctr.js"></script>
<script type="text/javascript" src="<?=JS_DIR?>/category.controller.js"></script>
<script type="text/javascript">
var categorys = <?=json_encode($categorys)?>;
var customer = <?=json_encode($setting['customer'])?>;
function pop_post(post_id, addr_id, addrDetail_id) {
    daumPost.post_id = post_id;
    daumPost.addr_id = addr_id;
    daumPost.addrDetail_id = addrDetail_id;
    daumPost.addrExtra_id = addrDetail_id;
    daumPost.pop();
}
function SaveUpdate() {
    var f = $('#asFrm')[0];
    var data = new FormData(f);
    $.ajax({
        url : '/delivery/update_as',
        enctype: 'multipart/form-data',
        processData: false, // 필수 
        contentType: false, // 필수
        data : data,
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            console.log('res', resJson);
            if(resJson.err_msg) {
                alertBox(resJson.err_msg);
            }
            else if(resJson.ok_msg) {
                alertBox(resJson.ok_msg, win_load, 'reload');
            }
        }
    });
    return false;
}
function getResultStateCode(code) {
    $('#aa_result_code option').remove();
    
    $.ajax({
        url : '/m/aservice/ajax_request/get_code_data',
        data : {mode:'get_code_data', code:code},
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            for(var i in resJson) $('#aa_result_code').append('<option value="'+resJson[i]['cd_pid']+'">'+resJson[i]['cd_name']+'</option>');
        }
    });

}
function setProduct(pid) {
    $.ajax({
        url : '/product/ajax_request',
        data : {mode:'get_product', 'pid':pid},
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            let catePathName = new Array();
            let ct_name = null;
            let resHtml = '';
            if(resJson.pd_pid) {
                catePathName.push(categorys[resJson.pc_pid1]['pc_name']);
                if(resJson.pc_pid2) catePathName.push(categorys[resJson.pc_pid2]['pc_name']);
                if(resJson.pc_pid3) catePathName.push(categorys[resJson.pc_pid3]['pc_name']);

                for(var i in customer) {
                    if(customer[i]['ct_pid']!=resJson.ct_pid) continue;
                    ct_name = customer[i]['ct_name'];
                    break;
                }
                resHtml = '<tr>';
                resHtml += '<td>'+catePathName.join(' > ')+'</td>';
                resHtml += '<td>'+ct_name+'</td>';
                resHtml += '<td>'+resJson.pd_code+'</td>';
                resHtml += '<td>'+resJson.pd_name+'</td>';
                resHtml += '</tr>';
            }
            $('#as_product tbody').html(resHtml);
        }
    });

    return false;
}
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.itemJS = <?=json_encode($partRows)?>;
cateCtr.item_selector='select_part';


function signCancel() {
    saveSign();
    $('.sign_set').removeClass('hidden');
    $('.sign_img').addClass('hidden');
    $('img.sign_img').remove();
}

function saveSign(sign) {
    var sign = sign || '';
    $.ajax({
        url : '/m/aservice/ajax_request',
        data : {mode:'update_sign', aa_pid:document.forms['aFrm'].aa_pid.value, sign:sign},
        type: "POST",
        cache: false,
        dataType:'html',
        success: function(res) {
            if(res=='ok' && sign) alertBox('저장되었습니다.');
        }
        ,error: function() {
            alertBox('Error');
        }
    });
}

</script>