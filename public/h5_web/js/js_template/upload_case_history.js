var res_msg = getQueryString("res_msg");
if (res_msg == "ok") {
    Zepto.sDialog({
        skin: "red",
        content: '保存成功',
        okBtn: false,
        cancelBtn: false
    });
    setTimeout(function () {
        location.href = WapSiteUrl + '/js_template/member/vr_order_list.html';
    }, 2500);
}
if (res_msg == "err") {
    Zepto.sDialog({
        skin: "red",
        content: '保存失败',
        okBtn: false,
        cancelBtn: false
    });
}

$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
    }
    $("input[name='key']").val(key);

    var order_id = getQueryString("order_id");
    $("input[name='order_id']").val(order_id);

    var store_id = getQueryString("store_id");
    $("input[name='store_id']").val(store_id);
});
