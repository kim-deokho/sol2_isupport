var cateCtr = {
    categorysJS : {}
    ,sel_categorys : {}
    ,subCategorys : {}
    ,chgCategory : function(val, depth) {
        this.setSelCategorys(val, depth);
        $('.sel_categorys').each(function(i){
            si = i+1;
            if(si>depth) {
                $('#cate'+si+' option').remove();
                $('#cate'+si).append('<option value="">전체</option>');
            }
        });
        if(val!="") {
            for(var i in this.sel_categorys) {
                if(!this.sel_categorys[i]) continue;
                if(i==1) this.subCategorys=this.categorysJS[this.sel_categorys[i]];
                else this.subCategorys=this.subCategorys[this.sel_categorys[i]];
            }
            this.makeSelect(depth);
        }
        
    }
    ,makeSelect : function(depth) {
        // console.log('sub', this.subCategorys, 'sel', this.sel_categorys);
        $target_sel = $('#cate'+(depth+1));
        for(var code in this.subCategorys) {
            if(code=='name' || code=='code') continue;
            $target_sel.append('<option value="'+code+'">'+this.subCategorys[code]['name']+'</option>');
        }
    }
    ,set : function() {
        // URL Queryr값으로 셋팅
        var params=getQueryStringObject();
        // console.log(params, getQueryStringObject());
        if(params['cate1']) $('#cate1').val(params['cate1']).trigger('change');
        if(params['cate2']) $('#cate2').val(params['cate2']).trigger('change');
        if(params['cate3']) $('#cate3').val(params['cate3']).trigger('change');
    }
    ,setSelCategorys : function(val, depth) {
        // 현재 선택한 카테고리 하위카테고리 선택값 초기화
        this.sel_categorys[depth]=val;
        for(var n in this.sel_categorys) {
            if(n>depth) this.sel_categorys[n]='';
        }
    }
}