$(function() {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    var order_id = getQueryString("order_id");
    $.ajax({
        type: 'post',
        url: ApiUrl + "/member_order/search_deliver",
        data:{key:key,order_id:order_id},
        dataType:'json',
        success:function(result) {
            //检测是否登录了
            checkLogin(result.login);

            var data = result && result.datas;
            if (!data) {
                data = {};
                data.err = '暂无物流信息';
            }
	    window.location.href = data.deliver_info;
            //var html = template.render('order-delivery-js_template', data);
            //$("#order-delivery").html(html);
        }
    });

});
