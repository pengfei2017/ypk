$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }

    $.post(ApiUrl+"/member_index/load_buy_service_user_liat",{"key":key},function (data) {
        if(data=="nologin"){
            window.location.href = WapSiteUrl + '/js_template/member/login.html';
            return;
        }
        else {
            $("#userList").append(data);
        }
    },null);

    loadCaseHistoryList(key,-1); //默认加载全部
    $("#userList").change(function () {
        var member_id=$(this).val();
        loadCaseHistoryList(key,parseInt(member_id));
    });
});

//获取用户的病历列表
function loadCaseHistoryList(key,member_id) {
    $.post(ApiUrl+"/member_index/load_case_history_list",{"key":key,"member_id":member_id},function (data) {
        $(".ulArea").html(data);
    },null);
}