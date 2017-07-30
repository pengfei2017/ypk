$(function () {
    var key = getCookie('key');
    if (!key || key=="" || key==null || key=="undefined") {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    //加载健康知识列表
    $.post(ApiUrl+"/article/ajax_health_list",{'key':key},function (data) {
        $(".member-center").html(data);
    },null);
});

//收藏新闻
function collectNews(obj) {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    var newsId=$(obj).attr("data-id");
    $.post(ApiUrl+"/member_index/collect_news",{'key':key,"newsId":newsId},function (data) {
        if(data=="nologin"){
            window.location.href = WapSiteUrl + '/js_template/member/login.html';
            return;
        }else if(data=="argerr"){
            alert("参数错误");
            window.location.reload();
        }else if(data=="nonews"){
            alert("要收藏的新闻不存在");
            window.location.reload();
        }else if(data=="ok"){
            alert("收藏成功");
        }else if(data=="err"){
            alert("收藏失败");
            window.location.reload();
        }
        else {
            alert("系统繁忙，请稍后再试");
            window.location.reload();
        }
    },null);
}