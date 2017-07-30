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
                Zepto.sDialog({
                    skin: "red",
                    content: '请先完善资料再分享商城',
                    okBtn: true,
                    cancelBtn: true,
                    okFn: function () {
                        if(result.datas.member_type=="custom"){ //表示是普通客户
                            window.location = "member_info_custom.html";
                        }else { //表示是医务人员
                            window.location = "member_info.html";
                        }
                    },
                    cancelFn: function () {
                        history.back();
                    }
                });
            } else {
                if (result.datas.png_img && result.datas.png_img != '') {
                    window.location.href = result.datas.png_img;
                    return;
                }
                $("body").css("background", "url(" + result.datas.member_info.back_img + ") no-repeat"); //设置body的背景图片
                //$(".avator").css("background","url("+result.datas.member_info.avator+") no-repeat");
                $(".avator img").attr("src", result.datas.member_info.avator); //设置用户头像路径
                $(".codeimgdiv .codeimg img").attr("src", result.datas.member_info.myurl_src); //设置二维码图片路径
                $(".doctor_name span").html(result.datas.member_info.member_truename); //设置真实姓名
                $(".des span").html(result.datas.member_info.member_areainfo);

                //生成分享二维码图片
                html2canvas(document.body).then(function (canvas) {
                    var imageData = canvas.toDataURL("image/png");
                    $.ajax({
                        type: 'post',
                        url: ApiUrl + "/member_invite/get_share_img",
                        data: {
                            key: key,
                            imageData: imageData
                        },
                        dataType: 'json',
                        success: function (result) {
                            if (result.code == 200) {
                                window.location.href = result.datas.png_img;
                            } else {
                                $.sDialog({
                                    skin: "red",
                                    content: result.datas.error,
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                setTimeout(function () {
                                    history.back();
                                }, 3000);
                                return false;
                            }
                        }
                    });
                });
            }
        }
    });
});
