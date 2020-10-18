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