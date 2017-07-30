$(function () {
    var key = getCookie('key');
    if (!key) {
        //判断用户登录
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    var member_type_id=getCookie("member_type_id"); //用户身份id
    if(parseInt(member_type_id)<2){ //表示是普通会员
        $(".straight_doctor").remove();
        $(".collision_doctor").remove();
        $(".commission_doctor").remove();
        $(".share_benefits").remove();
    }

    $.getJSON(ApiUrl + '/member_index/my_asset', {key: key}, function (result) {
        checkLogin(result.login);
        $('#predepoit').html(result.datas.predepoit + ' 元');
        $('#rcb').html(result.datas.available_rc_balance + ' 元');
        $('#voucher').html(result.datas.voucher + ' 张');
        $('#redpacket').html(result.datas.redpacket + ' 个');
        $('#point').html(result.datas.point + ' 分');
    });
});