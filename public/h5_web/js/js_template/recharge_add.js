$(function () {
    var key = getCookie('key');
    $.sValid.init({
        rules: {
            pdr_amount: "required"
        },
        messages: {
            pdr_amount: "充值金额必填！"
        },
        callback: function (eId, eMsg, eRules) {
            if (eId.length > 0) {
                var errorHtml = "";
                $.map(eMsg, function (idx, item) {
                    errorHtml += "<p>" + idx + "</p>";
                });
                errorTipsShow(errorHtml);
            } else {
                errorTipsHide();
            }
        }
    });

    $('.btn').click(function () {
        if ($.sValid()) {
            var pdr_amount = $('#pdr_amount').val();

            $.ajax({
                type: 'post',
                url: ApiUrl + "/predeposit/recharge_add",
                data: {
                    key: key,
                    pdr_amount: pdr_amount
                },
                dataType: 'json',
                success: function (result) {
                    if (result.code == 200) {
                        //转向到商城支付页面
                        location.href = WapSiteUrl + '/js_template/order/pd_pay.html?pay_sn=' + result.datas.pay_sn;
                    } else {
                        errorTipsShow(result.datas.error);
                    }
                }
            });
        }
    });
});