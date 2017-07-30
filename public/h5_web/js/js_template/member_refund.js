$(function(){
    var key = getCookie('key');
    //渲染list
    var load_class = new ncScrollLoad();
    load_class.loadInit({
        'url':ApiUrl + '/member_refund/get_refund_list',
        'getparam':{key :key },
        'tmplid':'refund-list-js_template',
        'containerobj':$("#refund-list"),
        'iIntervalId':true,
        'data':{WapSiteUrl:WapSiteUrl}
    });
});