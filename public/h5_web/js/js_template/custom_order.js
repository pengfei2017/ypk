$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }

    //加载订单列表
    $.post(ApiUrl+"/member_index/custom_order_list",{"key":key},function (data) {
        if(data=="nologin"){
            window.location.href = WapSiteUrl + '/js_template/member/login.html';
            return;
        }
        else if(data=="illegal"){ //不是医务人员
            alert("无权访问");
            window.location.href = WapSiteUrl + '/js_template/member/member.html';
            return;
        }
        else if(data=="nopass"){
            alert("您的医生审核尚未通过");
            window.location.href = WapSiteUrl + '/js_template/member/member.html';
            return;
        }
        $(".member-center").html(data);
    },null);
});

//设置发货
function sendGoods(obj) {
    var order_id=$(obj).attr("data-id");
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    $.post(ApiUrl+"/member_index/send_order",{'key':key,'order_id':order_id},function (result) {
        if(result=="ok"){
            alert("发货成功");
            window.location.href = WapSiteUrl + '/js_template/member/custom_order.html';
        }
        var obj = eval('(' + result + ')');
        checkLogin(obj.login);
    },null);
}