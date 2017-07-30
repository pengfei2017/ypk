
$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }

    $.post(ApiUrl+"/member_index/month_reward",{"key":key},function (res) {
        var res=JSON.parse(res);
        if(parseInt(res.member_type_id)===1){
            $(".doctor").css('display','none');
            $(".member_straight_money_sum_log").html(res.member_straight_money_sum_log);
            $(".member_collision_sum_money_log").html(res.member_collision_sum_money_log);
            $(".member_commission_money_sum_log").html(res.member_commission_money_sum_log);
            $(".month_total_log").html(res.month_total_log);
        }
        else {
            $(".member_straight_money_sum_log").html(res.member_straight_money_sum_log);
            $(".member_collision_sum_money_log").html(res.member_collision_sum_money_log);
            $(".member_commission_money_sum_log").html(res.member_commission_money_sum_log);
            $(".store_share_benefits_money_sum_log").html(res.store_share_benefits_money_sum_log);
            $(".store_straight_money_sum_log").html(res.store_straight_money_sum_log);
            $(".store_collision_sum_money_log").html(res.store_collision_sum_money_log);
            $(".store_commission_money_sum_log").html(res.store_commission_money_sum_log);
            $(".month_total_log").html(res.month_total_log);
        }
    });
});