
$(function () {
    var cart_count = 0;
    cart_count = getCookie('cart_count');
    if (getQueryString('key') != '') {
        var key = getQueryString('key');
        var username = getQueryString('username');
        addCookie('key', key);
        addCookie('username', username);
    } else {
        var key = getCookie('key');
    }
    var html = '<div class="nctouch-footer-wrap posr">';
    html += '<div class="nav-text">';
    html += '<a href="' + WapSiteUrl + '/index.html">首页</a>'
        + '<a href="' + WapSiteUrl + '/js_template/member/member_invite_code.html">分享商城</a>'
        + '<a href="' + WapSiteUrl + '/js_template/cart_list.html">购物车</a>'
        + '<a href="' + WapSiteUrl + '/js_template/member/member.html">我的</a>';
    html += "</div>";
    html += '<div class="nav-text">';
    html += '<a href="' + WapSiteUrl + '/js_template/member/member_asset.html">我的收入</a>';
    if (key) {
        html += '<a id="logoutbtn" href="javascript:void(0);">注销</a>'
    } else {
        html += '<a href="' + WapSiteUrl + '/js_template/member/login.html">登录</a>'
            + '<a href="' + WapSiteUrl + '/js_template/member/register_mobile.html">注册</a>';
    }
    html += '<a href="' + WapSiteUrl + '/js_template/member/member_feedback.html">反馈</a>'
    + '<a href="' + WapSiteUrl + '/js_template/article_list.html?ac_id=2">帮助</a>';
    //html += '<a href="javascript:void(0);" class="gotop">返回顶部</a>' + "</div>";
    html += "</div>";


    if (cart_count > 0) {
        var fnav = '<div id="footnav" class="footnav clearfix"><ul>'
            + '<li><a href="' + WapSiteUrl + '"><i class="home"></i><p>首页</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/product_first_categroy.html"><i class="categroy"></i><p>分类</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/search.html"><i class="search"></i><p>搜索</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/cart_list.html"><i class="cart"></i><sup></sup><p>购物车</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/member/member.html"><i class="member"></i><p>我的</p></a></li></ul>'
            + '</div>';
    } else {
        var fnav = '<div id="footnav" class="footnav clearfix"><ul>'
            + '<li><a href="' + WapSiteUrl + '"><i class="home"></i><p>首页</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/product_first_categroy.html"><i class="categroy"></i><p>分类</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/search.html"><i class="search"></i><p>搜索</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/cart_list.html"><span id="cart_count"><i class="cart"></i></span><p>购物车</p></a></li>'
            + '<li><a href="' + WapSiteUrl + '/js_template/member/member.html"><i class="member"></i><p>我的</p></a></li></ul>'
            + '</div>';
    }
    //$("#footer").html(html + fnav);
    $("#footer").html(html);
    var key = getCookie('key');

    //注销登录
    $('#logoutbtn').click(function () {
        var username = getCookie('username');
        var key = getCookie('key');
        var client = 'h5_web';
        $.ajax({
            type: 'post',
            url: ApiUrl + '/logout',
            data: {username: username, key: key, client: client},
            success: function (result) {
                if (result) {
                    delCookie('username');
                    delCookie('key');
                    location.href = WapSiteUrl;
                }
            }
        });
    });
    $('footnav li').html();
});