$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }

    $.ajax({
        type: 'get',
        url: ApiUrl + "/member_account/get_mobile_info",
        data: {key: key},
        dataType: 'json',
        success: function (result) {
            if (result.code == 200) {
                if (result.datas.state) {
                    $('#mobile_link').attr('href', 'member_mobile_modify.html');
                    $('#mobile_value').html(result.datas.mobile);
                }
            } else {
            }
        }
    });
    $.ajax({
        type: 'get',
        url: ApiUrl + "/member_account/get_paypwd_info",
        data: {key: key},
        dataType: 'json',
        success: function (result) {
            if (result.code == 200) {
                if (!result.datas.state) {
                    $('#paypwd_tips').html('未设置');
                }
            } else {
            }
        }
    });

    var is_set_chat_offline = getCookie('is_set_chat_offline');
    if (typeof is_set_chat_offline != "undefined" && is_set_chat_offline != null && is_set_chat_offline == 1) { //医生设置了聊天为不在线状态
        $('#is_set_chat_offline').html('设为在线状态');
    } else {
        $('#is_set_chat_offline').html('设为离线状态');
    }
});