$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }

    initContent(key);

});

function initContent(key) {
    var case_id=getValueFromUrl("case_id");
    if(case_id){
        $.post(ApiUrl+"/member_index/load_case_history_content",{"key":key,"case_id":case_id},function (data) {
            if(data){
                var obj = eval('(' + data + ')');
                $(".member-center").html(obj.content);
                $(".member-center").find("img").css('font-size','0.7rem').css('width','100%');
            }
        },null);
    }
}

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}