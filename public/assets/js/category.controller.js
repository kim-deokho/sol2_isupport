var cateCtr = {
    categorysJS : {}
    ,sel_categorys : {}
    ,subCategorys : {}
    ,itemsJS : {}
    ,item_selector : ''
    ,chgCategory : function(val, depth, targetName, prefix) {
        var targetName = targetName || 'search_categorys';
        var prefix = prefix || 'cate';
        this.setSelCategorys(val, depth);
        $('.'+targetName).each(function(i){
            si = i+1;
			
			if(targetName == 'promotion') {
				text = si+'차카테고리';
			} else {
				text = '전체';
			}
            if(si>depth) {
                $('#'+prefix+si+' option').remove();
                $('#'+prefix+si).append('<option value="">'+text+'</option>');
            }
        });
        if(val!="") {
            for(var i in this.sel_categorys) {
                if(!this.sel_categorys[i]) continue;
                if(i==1) this.subCategorys=this.categorysJS[this.sel_categorys[i]];
                else this.subCategorys=this.subCategorys[this.sel_categorys[i]];
            }
            this.makeSelect(prefix, depth);
            // 해당 카테고리의 상품을 가져와 셋팅
            if(this.item_selector) this.setItems(targetName);
        }
        
    }
    ,makeSelect : function(prefix, depth) {
        // console.log('sub', this.subCategorys, 'sel', this.sel_categorys);
        $target_sel = $('#'+prefix+(depth+1));
        for(var code in this.subCategorys) {
            if(code=='name' || code=='code') continue;
            $target_sel.append('<option value="'+code+'">'+this.subCategorys[code]['name']+'</option>');
        }
    }
    ,set : function(prefix) {
        var prefix = prefix || 'cate';
        // URL Queryr값으로 셋팅
        var params=getQueryStringObject();
        // console.log(params, getQueryStringObject());
        if(params['cate1']) $('#'+prefix+'1').val(params['cate1']).trigger('change');
        if(params['cate2']) $('#'+prefix+'2').val(params['cate2']).trigger('change');
        if(params['cate3']) $('#'+prefix+'3').val(params['cate3']).trigger('change');
    }
    ,setSelCategorys : function(val, depth) {
        // 현재 선택한 카테고리 하위카테고리 선택값 초기화
        this.sel_categorys[depth]=val;
        for(var n in this.sel_categorys) {
            if(n>depth) this.sel_categorys[n]='';
        }
    }
    ,setItems : function(targetName) {
        var select_category='';
        $('.'+targetName).each(function(i){
            select_category += $(this).val();
        });
        $('#'+this.item_selector+' option').remove();
        $('#'+this.item_selector).append('<option value="">선택</option>');
        for(var i in this.itemJS) {
            let item = this.itemJS[i];
            if(select_category==item['pt_tc_code'].substring(0, select_category.length)) {
                let opt_value=item['pt_pid']+':'+addslashes(item['pt_name'])+':'+item['pt_out_price']+':'+item['pt_wages'];
                $('#'+this.item_selector).append('<option value="'+opt_value+'">'+item['pt_name']+'</option>');
            }
        }
    }
}