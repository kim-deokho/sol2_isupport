<link rel="stylesheet" href="<?=LIB_DIR?>/jsTree/dist/themes/default/style.min.css" />
<style>
.vakata-context { 
     z-index:999 !important; 
} 
</style>
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
<?                  foreach($partCategorysJS as $code=>$cate) echo '<option value="'.$code.'" '.($code==$cate1?'selected':'').'>'.$cate['name'].'</option>';?>
                </select>
                <select name="cate2" id="cate2" class="wAuto search_categorys" onchange="cateCtr.chgCategory(this.value, 2)">
                    <option value="">전체</option>
                </select>

                <span class="ml20">사용여부</span>
                <select name="search_use" id="search_use" class="wAuto">
                    <option value="">전체</option>
<?                  foreach(array('Y', 'N') as $k) echo '<option value="'.$k.'" '.($k==$search_use?'selected':'').'>'.$k.'</option>';?>      
                </select>
            </div> <!-- box_row -->

            <div class="box_row mt10">                            
                <span>부품명</span>                            				
                <select class="multi_select" style="width:auto" name="searchKey[]" id="searchKey" multiple="multiple">
<?                  foreach(array('pt_name'=>'부품명', 'pt_code'=>'부품코드') as $sk=>$sv) echo '<option value="'.$sk.'">'.$sv.'</option>';?>
                </select>
                <input type="text" name="searchWord" id="searchWord" class="mWt150" value="<?=$searchWord?>" placeholder="검색어" />
                
                <div class="po_right">
                    <button type="button" class="bt_black" onclick="popPartsRegFrm();">부품등록</button>    
                    <button type="button" class="bt_black ml10" onclick="pop_modal('pop_category_set')">카테고리설정</button>
                    <button type="button" class="bt_green ml10" onclick="listExcel()">EXCEL</button>
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
    include_once "popPartRegForm.php"; // 부품등록
    include_once "popPartCategoryForm.php"; // 카테고리설정
?>
<script src="<?=JS_DIR?>/category.controller.js"></script>
<script src="<?=LIB_DIR?>/jsTree/dist/jstree.min.js"></script>
<script type="text/javascript">
var jstreeAction='';

sendSearch();
cateCtr.categorysJS = <?=json_encode($partCategorysJS)?>;
cateCtr.set();
$(function() {
    $('.js-single-selector').select2();

	$('#jstree_category').jstree({
		"core" : {
			"check_callback" : function (operation, node, node_parent, node_position, more) {
				// operation can be 'create_node', 'rename_node', 'delete_node', 'move_node' or 'copy_node'
				// in case of 'rename_node' node_position is filled with the new node name
				if(operation=='rename_node') {
                    // console.log(node, node_parent, node_position, more);
				}

				return true;
			}
			,"data" : <?=json_encode($partCategorysTree)?>
		}
        ,"plugins" : [ "contextmenu", "wholerow", "types" ]
		,"contextmenu":{
			"items": function($node) {
				var tree = $("#jstree_category").jstree(true);
				return {
					"Create": {
						"separator_before": false,
						"separator_after": false,
						"label": "하위생성",
						"action": function (obj) {
                            if($node.id.length==6) {
                                alertBox('더 이상 하위카테고리를 생성할 수 없습니다.');
                                return false;
                            }
							// id값 지정을 위해
							$.ajax({
								type : 'POST'
								,url : '/product/getPartCategoryNewNodeId'
								,data : {'parent_id':$node.id}
								,dataType : 'json'
								,success : function(data) {
									//alertBox(data);
                                    //return false;
                                    console.log(data, $node);
                                    jstreeAction='create';
									$node = tree.create_node($node, {'id':data.id, 'text':'NEW_'+data.id, 'parent':$node.id, 'type':data.id.length==9?'file':'folder'});
									tree.edit($node);
								}
								,error : function(xhr, status, error) {
									alertBox('Script Error');
								}
							});
						}
                    },
                    "Rename": {
                        "label": "이름변경",
                        "action": function (data) {
                            jstreeAction='rename';
                            var inst = $.jstree.reference(data.reference),
                            obj = inst.get_node(data.reference);
                            inst.edit(obj);
                        }
                    },
					"Remove": {
						"separator_before": false,
						"separator_after": false,
						"label": "삭제",
						"action": function (obj) {
                            confirmBox("하위 카테고리까지 모두 삭제됩니다. <br><strong style='color:red'>복구가 불가능</strong>하니 신중히 삭제하시기 바랍니다!!!<br>정말 삭제하시겠습니까?", function(){
                                // 데이타 삭제
								$.ajax({
									type : 'POST'
									,url : '/product/execute'
									,data : {'mode':'deletePartCategoryNode', 'id':$node.id}
									,dataType : 'json'
									,success : function(res) {
										if(res.err) {
											alertBox(res.err);
											return false;
										}
										tree.delete_node($node);
									}
									,error : function(xhr, status, error) {
										alertBox('Script Error');
										//alertBox(xhr+"\n"+status+"\n"+error);
										return false;
									}
								});
                            });
						}
					}
				};
			}
		}

	}).bind("rename_node.jstree", function (e, data) { 
        if(jstreeAction=='create') {
            // 데이타 저장
            $.ajax({
            	type : 'POST'
            	,url : '/product/execute'
            	,data : {'mode':'addPartCategoryNode', 'id':data.node.id, 'parent_id':data.node.parent, 'name':data.text}
            	,dataType : 'json'
            	,success : function(res) {
                    console.log('res', res);
                    if(res.err) {
                        alertBox(res.err);
                        $('#jstree_category').jstree('refresh');
                    }
            	}
            	,error : function(xhr, status, error) {
            		alertBox('Script Error');
            		return false;
            	}
            });
        }
        else if(jstreeAction=='rename') {
            if (data.node.text && data.text != data.old) {    
                $.ajax({
                    type : 'POST'
                    ,url : '/product/execute'
                    ,data : {'mode':'updatePartCategoryName', 'id':data.node.id, 'name':data.text, 'parent_id':data.node.parent}
                    ,dataType : 'json'
                    ,success : function(res) {
                        if(res.err) {
                            alertBox(data.err);
                            $('#jstree_category').jstree('refresh');
                        }
                        //tree.edit($node);
                    }
                    ,error : function(xhr, status, error) {
                        alertBox('Script Error');
                    }
                });  
            }    
        }
    });
});

function popPartsRegFrm(pid) {
    var pid = pid || '';
    var cate_prefix = 'pt_cate';
    document.forms['regFrm'].pt_pid.value=pid;
    if(pid) {
        gcUtil.loader();
        $.ajax({
            data: {mode:'get_part', pid:pid},
            type: "POST",
            url: "/product/ajax_request",
            cache: false,
            dataType:'json',
            success: function(resJson) {
                gcUtil.loader('hide');
                // console.log('res', resJson);
                if(!resJson.pt_pid) {
                    alertBox('부품정보를 가져오는데 실패했습니다.');
                }
                else {
                    setFormData('regFrm', resJson);
                    $('#regFrm #pt_code').prop('disabled', true);

                    //number_format Set
                    $('.input-comma').each(function(){
                        $(this).val(inputNumberWithComma($(this).val()));
                    });
                    var reg_date_html=resJson.reg_date.substring(0, 10);
                    if(resJson.up_date) reg_date_html += ' (최종수정 : '+resJson.up_date.substring(0, 10)+')';

                    $('#regFrm #pt_code').prop('disabled', true);
                    $('#label_is_auto').css('display', 'none');
                    $('#reg_update').html(reg_date_html);

                    pop_modal('pop_parts_reg');
                    
                    var cate1=resJson.pt_tc_code.substr(0, 3);
                    var cate2=resJson.pt_tc_code.substr(3, 3);

                    cate1 = cate1=='000' ? '' : cate1;
                    cate2 = cate2=='000' ? '' : cate2;

                    if(cate1) $('#'+cate_prefix+'1').val(cate1).trigger('change');
                    if(cate2) $('#'+cate_prefix+'2').val(cate2);

                    // 카테고리 변경불가
                    $('.part_categorys').each(function(){
                        $(this).prop('disabled', true);
                    });
                }
            }
        });
    }
    else {
        $('#regFrm #pt_code').prop('disabled', false);
        $('#label_is_auto').css('display', 'inline-block');
        
        $('#reg_update').html('');
        setFormData('regFrm');
        // 카테고리 초기화
        $('#'+cate_prefix+'1').val('').trigger('change');
        // 매입처 초기화
        $('#ct_pid').select2('val', {});
        
        pop_modal('pop_parts_reg');

        // 카테고리 변경가능
        $('.part_categorys').each(function(){
            $(this).prop('disabled', false);
        });
    }
}

function chkDoubleName() {
    var f = document.forms['regFrm'];
    var data={type:'part', pt_pid : f.pt_pid.value, pt_name:f.pt_name.value}
    $.ajax({
        data: data,
        type: "POST",
        url: '/product/chkDoubleName',
        cache: false,
        dataType:'json',
        success: function(resJson) {
            if(resJson.result) {
                alertBox('이미 동일한 부품명이 존재합니다.');
                f.is_double.value='Y';
            }
            else {
                alertBox('사용 가능한 부품명입니다.');
                f.is_double.value='N';
            }
        }
        ,error : function(e) {
            alertBox("Double Error!");
        }
    });
}

function createRoot() {
	$.ajax({
		type : 'POST'
		,url : '/product/getPartCategoryNewNodeId'
		,data : {'parent_id':'#'}
		,dataType : 'json'
		,success : function(data) {
			//alertBox(data);
            //return;
            jstreeAction='create';
			var tree = $("#jstree_category").jstree(true);
			$node = tree.create_node(null, {'id':data.id, 'text':'NEW_'+data.id});
			tree.edit($node);
		}
		,error : function(xhr, status, error) {
			alertBox('Script Error');
		}
	});
}
</script>