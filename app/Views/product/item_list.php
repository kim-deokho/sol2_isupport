
<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?> 
        <form name="searchFrm" id="searchFrm" method="get" onsubmit="sendSearch(1);return false;">
        <input type="hidden" name="page" id="page" value="<?=$page?>">
        <div class="search_box mt10">
            <div class="box_row">
                <span>카테고리</span>
                <select name="cate1" id="cate1" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 1)">
                    <option value="">전체</option>
<?                  foreach($categorysJS as $code=>$cate) echo '<option value="'.$code.'" '.($code==$cate1?'selected':'').'>'.$cate['name'].'</option>';?>
                </select>
                <select name="cate2" id="cate2" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 2)">
                    <option value="">전체</option>
                </select>
                <select name="cate3" id="cate3" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 3)">
                    <option value="">전체</option>
                </select>

                <span class="ml20">구분</span>
                <select name="search_kind" id="search_kind" class="wAuto">
                    <option value="">전체</option>
<?                  foreach($setting['code']['ProductKind'] as $info) echo '<option value="'.$info['cd_pid'].'" '.($info['cd_pid']==$search_kind?'selected':'').'>'.$info['cd_name'].'</option>';?>                      
                </select>
            </div> <!-- box_row -->
            <div class="box_row mt10">
                <span>상품명</span>
                <select class="multi_select" style="width:auto" name="searchKey[]" id="searchKey" multiple="multiple">
<?                  foreach(array('pd_name'=>'상품명', 'pd_code'=>'상품코드') as $sk=>$sv) echo '<option value="'.$sk.'">'.$sv.'</option>';?>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="검색어" />

                <!-- <input type="text" name="pd_name" id="pd_name" class="mWt280" value="<?=$pd_name?>" placeholder="상품명" /> -->

                <span class="ml20">사용여부</span>
                <select name="search_use" id="search_use" class="wAuto">
                    <option value="">전체</option>
<?                  foreach(array('Y', 'N') as $k) echo '<option value="'.$k.'" '.($k==$search_use?'selected':'').'>'.$k.'</option>';?>      
                </select>

                <button type="submit" class="bt_navy ml10">조회</button>

                <div class="po_right">
                    <button type="button" class="bt_black" onclick="popProductFrm();">상품등록</button>
                    <button type="button" class="bt_green ml10 js-excel-btn" onclick="listExcel()">EXCEL</button>
                </div> <!-- po_right // 오른쪽 버튼 -->
            </div> <!-- box_row -->
        </div> <!-- search_box -->
        </form>

        <?# 리스트 영역?>
        <div class="table_wrap" id="list_area"></div>

        <?# 페이징 영역?>
        <div class="mResultTablePage mContentWrap" id="paging"></div>
    </div> <!-- contents -->
</section>
<?
    include_once "popProductRegForm.php"; // 상품등록
?>
<script src="<?=JS_DIR?>/category.controller.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-single-selector').select2();
});
sendSearch();
cateCtr.categorysJS = <?=json_encode($categorysJS)?>;
cateCtr.set();

function popProductFrm(pid) {
    var pid = pid || '';
    var cate_prefix = 'pd_cate';
    document.forms['regFrm'].pd_pid.value=pid;
    $('#search_bom').select2('val', {});
    $('#search_bom').prop('disabled', false);
    if(pid) {
        gcUtil.loader();
        $.ajax({
            data: {mode:'get_product', pid:pid},
            type: "POST",
            url: "/product/ajax_request",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                gcUtil.loader('hide');
                // console.log('res', resJson);
                if(!resJson.pd_pid) {
                    alertBox('상품정보를 가져오는데 실패했습니다.');
                }
                else {
                    // BOM 리스트 가져오기
                    $.ajax({
                        data: {pd_pid:pid, ord_cnt:resJson.ord_cnt},
                        type: "POST",
                        url: '/product/getBomProductData',
                        cache: false,
                        dataType:'html',
                        success: function(resHtml) {
                            $('#id_bom_product_list').html(resHtml);
                        }
                        ,error : function(e) {
                            alertBox("BOM Error!");
                        }
                    });


                    setFormData('regFrm', resJson);
                    // 이전 입고가(변경여부 체크를 위해)
                    $('#regFrm #old_in_price').val(resJson.pd_in_price);
                    $('#regFrm #pd_code').prop('disabled', true);
                    // 이미지
                    $('#p_img_prev').attr('src', resJson.pd_img);
                    // number_format Set
                    $('.input-comma').each(function(){
                        $(this).val(inputNumberWithComma($(this).val()));
                    });
                    chgDeliveryKind(resJson.pd_delivery_kind);
                    var reg_date_html=resJson.reg_date.substring(0, 10);
                    if(resJson.up_date) reg_date_html += ' (최종수정 : '+resJson.up_date.substring(0, 10)+')';

                    $('#regFrm #pd_code').prop('disabled', true);
                    $('#label_is_auto').css('display', 'none')
                    $('#reg_update').html(reg_date_html);
                    if(resJson.ord_cnt>0) $('#search_bom').prop('disabled', true);

                    pop_modal('pop_product_reg');
                    
                    var cate1=resJson.pd_pc_code.substr(0, 3);
                    var cate2=resJson.pd_pc_code.substr(3, 3);
                    var cate3=resJson.pd_pc_code.substr(6, 3);
                    cate1 = cate1=='000' ? '' : cate1;
                    cate2 = cate2=='000' ? '' : cate2;
                    cate3 = cate3=='000' ? '' : cate3;

                    if(cate1) $('#'+cate_prefix+'1').val(cate1).trigger('change');
                    if(cate2) $('#'+cate_prefix+'2').val(cate2).trigger('change');
                    if(cate3) $('#'+cate_prefix+'3').val(cate3);

                    // 카테고리 변경불가
                    $('.product_categorys').each(function(){
                        $(this).prop('disabled', true);
                    });
                }
            }
        });
    }
    else {
        $('#regFrm #pd_code').prop('disabled', false);
        $('#label_is_auto').css('display', 'inline-block');
        // 이미지
        $('#p_img_prev').attr('src', jsConfig.imgDir+'/img_none.jpg');
        $('#reg_update').html('');
        setFormData('regFrm');
        // 카테고리 초기화
        $('#'+cate_prefix+'1').val('').trigger('change');
        // 매입처 초기화
        $('#ct_pid').select2('val', {});
        // BOM 설정 초기화
        $('#tb_bom_list tbody').html('<tr id="tr_no_data"><td colspan="10" class="no_data">등록된 상품이 없습니다.</td></tr>');
        
        pop_modal('pop_product_reg');

        // 카테고리 변경가능
        $('.product_categorys').each(function(){
            $(this).prop('disabled', false);
        });
    }
}

// 등록할 BOM상품선택
function setBomData(val) {
    if(!val) return false;
    exp_val=val.split('|@|');
    pd_pid=exp_val[0];
    pd_code=exp_val[1];
    pd_name=exp_val[2];
    pd_in_price=exp_val[3];

    if(document.forms['regFrm'].pd_pid.value==pd_pid) {
        alertBox('같은 상품은 등록이 불가능합니다.');
        return false;
    }

    var is_exists=false;
    $('.bom_products').each(function(){
        if($(this).attr('data-pid')!=pd_pid) return true;
        is_exists=true;
        return false;
    });
    if(is_exists) {
        alertBox('이미 등록된 상품입니다.');
        return false;
    }
    var pk_idx=$('.bom_products').length;
    var trHtml='<tr id="tr_'+pk_idx+'">';

    trHtml+='   <td>'+(pk_idx+1)+'</td>';
    trHtml+='   <td>'+pd_code+'</td>';
    trHtml+='   <td>'+pd_name+'</td>';
    trHtml+='   <td><input type="text" name="Data[cnt][]" onkeyup="inputNumberAutoComma(this)" class="mWt60 h_20 txar bom_products input-comma" data-pid="'+pd_pid+'" value="" /></td>';
    trHtml+='   <td>'+inputNumberWithComma(pd_in_price)+'</td>';
    trHtml+='   <td><input type="text" name="Data[price][]" onkeyup="inputNumberAutoComma(this)" class="mWt100 h_20 txar input-comma" value="" /></td>';
    trHtml+='   <td><button type="button" class="small bt_red js-del-btn" onclick="delBomData(\''+pk_idx+'\')">삭제</button></td>';
    trHtml+='<input type="hidden" name="Data[pd_pid][]" value="'+pd_pid+'">';
    trHtml+='<input type="hidden" name="Data[pb_pid][]"">';
    trHtml+='</tr>';
    

    $('#tr_no_data').addClass('d_none');
    $('#tb_bom_list tbody tr:last').after(trHtml);
}

function delBomData(idx) {
    $('#tr_'+idx).remove();
    if($('.bom_products').length<1) $('#tr_no_data').removeClass('d_none');
}

function chgDeliveryKind(val) {
    if(val=='B') $('#pd_delivery_charge').prop('readonly', false);
    else $('#pd_delivery_charge').prop('readonly', true);
}

function chkDoubleName() {
    var f = document.forms['regFrm'];
    var data={type:'product', pd_pid : f.pd_pid.value, pd_name:f.pd_name.value}
    $.ajax({
        data: data,
        type: "POST",
        url: '/product/chkDoubleName',
        cache: false,
        dataType:'json',
        success: function(resJson) {
            if(resJson.result) {
                alertBox('이미 동일한 상품명이 존재합니다.');
                f.is_double.value='Y';
            }
            else {
                alertBox('사용 가능한 상품명입니다.');
                f.is_double.value='N';
            }
        }
        ,error : function(e) {
            alertBox("Double Error!");
        }
    });
}
</script>