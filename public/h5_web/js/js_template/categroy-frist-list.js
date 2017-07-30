$(function () {
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    } else {
        var key = getCookie('key');
        if (!key || key=="" || key=="undefined") {
            window.location.href = WapSiteUrl + '/js_template/member/login.html';
            return;
        }
    }

    var myScroll;
    $("#header").on('click', '.header-inp', function () {
        location.href = WapSiteUrl + '/js_template/search.html';
    });

    $.getJSON(ApiUrl + "/goods_class", function (result) {
        var data = result.datas;
        data.WapSiteUrl = WapSiteUrl;
        var html = template.render('category-one', data);
        $("#categroy-cnt").html(html);
        myScroll = new IScroll('#categroy-cnt', {mouseWheel: true, click: true});

        //设置聊天卡类别的链接
        $(".category-item-a[date-id='1076']").attr("href",WapSiteUrl+"/js_template/product_list.html?gc_id=1076");
    });

    get_brand_recommend();

    $('#categroy-cnt').on('click', '.category', function () {
        $('.pre-loading').show();
        $(this).parent().addClass('selected').siblings().removeClass("selected");
        var gc_id = $(this).attr('date-id');
        $.getJSON(ApiUrl + '/goods_class/get_child_all', {gc_id: gc_id}, function (result) {
            var data = result.datas;
            data.WapSiteUrl = WapSiteUrl;
            var html = template.render('category-two', data);
            $("#categroy-rgt").html(html);
            $('.pre-loading').hide();
            new IScroll('#categroy-rgt', {mouseWheel: true, click: true});
        });
        myScroll.scrollToElement(document.querySelector('.categroy-list li:nth-child(' + ($(this).parent().index() + 1) + ')'), 1000);
    });

    $('#categroy-cnt').on('click', '.brand', function () {
        $('.pre-loading').show();
        get_brand_recommend();
    });
});

function get_brand_recommend() {
    $('.category-item').removeClass('selected');
    $('.brand').parent().addClass('selected');
    $.getJSON(ApiUrl + '/brand/recommend_list', function (result) {
        var data = result.datas;
        data.WapSiteUrl = WapSiteUrl;
        var html = template.render('brand-one', data);
        $("#categroy-rgt").html(html);
        $('.pre-loading').hide();
        new IScroll('#categroy-rgt', {mouseWheel: true, click: true});
    });
}