$(function () {
    var key = getCookie('key');
    if (key == '') {
        location.href = 'login.html';
    }
    $.ajax({
        type: 'post',
        url: ApiUrl + "/member_invite",
        data: {key: key},
        dataType: 'json',
        //jsonp:'callback',
        success: function (result) {
            checkLogin(result.login);
            if (result.datas.msg == "nocomplete") {
                $.sDialog({
                    skin: "red",
                    content: '请先完善资料再分享商城',
                    okBtn: true,
                    cancelBtn: false,
                    okFn:function () {
                        window.location="member_info.html";
                    }
                });
            }
            else {
                $('#username').html(result.datas.member_info.user_name);
                $('#myurl').val(result.datas.member_info.myurl);
                $('#myurl_src').attr("src", result.datas.member_info.myurl_src);
                $('#download_url').attr("href", result.datas.member_info.mydownurl);
                return false;
            }
        }
    });
});