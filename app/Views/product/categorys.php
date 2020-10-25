
<link rel="stylesheet" href="<?=LIB_DIR?>/jsTree/dist/themes/default/style.min.css" />
<section>
    <div class="contents">
<?
        include_once APPPATH.'/Views/_page_path.php';
?> 

        <div class="left_right_con mWt900">
            <div class="left_con">
                <div class="category_wrap">
                    <div class="mostCategoryAdd" onclick="createRoot()">+ 최상위 카테고리 추가</div>
                    <div id='jstree_category'></div>
                </div> <!-- category_wrap -->
            </div> <!-- left_con -->
        </div> <!-- left_right_con -->

    </div> <!-- contents -->
</section>
<script src="<?=LIB_DIR?>/jsTree/dist/jstree.min.js"></script>
<script type="text/javascript">
var jstreeAction='';
function createRoot() {
	$.ajax({
		type : 'POST'
		,url : '/product/getCategoryNewNodeId'
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
$(function() {
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
			,"data" : <?=json_encode($categorysJS)?>
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
                            if($node.id.length==9) {
                                alertBox('더 이상 하위카테고리를 생성할 수 없습니다.');
                                return false;
                            }
							// id값 지정을 위해
							$.ajax({
								type : 'POST'
								,url : '/product/getCategoryNewNodeId'
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
                            confirmBox("하위 카테고리까지 모두 삭제됩니다. \n복구가 불가능하니 신중히 삭제하시기 바랍니다!!!\n정말 삭제하시겠습니까?", function(){
                                // 데이타 삭제
								$.ajax({
									type : 'POST'
									,url : '/product/execute'
									,data : {'mode':'deleteCategoryNode', 'id':$node.id}
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
            	,data : {'mode':'addCategoryNode', 'id':data.node.id, 'parent_id':data.node.parent, 'name':data.text}
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
                    ,data : {'mode':'updateCategoryName', 'id':data.node.id, 'name':data.text, 'parent_id':data.node.parent}
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
</script>