var f = document.forms['searchFrm'];
function sendSearch() {
    $.ajax({
        url : location.pathname+'_data',
        data : $("#searchFrm").serialize(),
        type: "POST",
        cache: false,
        dataType:'json',
        success: function(resJson) {
            if(resJson.html) {
                $('.list_type1').html(resJson.html);
                $('#result_cnt').text(inputNumberWithComma(resJson.totCnt));
            }
        }
    });
}

function detailForm(id) {
    location.href=location.pathname+'/'+id;
}