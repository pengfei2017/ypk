$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    //加载收藏的新闻列表
    $.post(ApiUrl+"/member_index/ajax_collect_article_list",{'key':key},function (data) {
        if(data=="nologin"){
            window.location.href = WapSiteUrl + '/js_template/member/login.html';
            return;
        }else {
            $(".member-center").html(data);
        }
    },null);
});