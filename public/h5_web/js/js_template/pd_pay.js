var key = getCookie('key');
var pay_sn = getQueryString("pay_sn");
var data = {};

data.key = key;
data.pay_sn = pay_sn;

Number.prototype.toFixed = function (d) {
    var s = this + "";
    if (!d) d = 0;
    if (s.indexOf(".") == -1) s += ".";
    s += new Array(d + 1).join("0");
    if (new RegExp("^(-|\\+)?(\\d+(\\.\\d{0," + (d + 1) + "})?)\\d*$").test(s)) {
        var s = "0" + RegExp.$2, pm = RegExp.$1, a = RegExp.$3.length, b = true;
        if (a == d + 2) {
            a = s.match(/\d/g);
            if (parseInt(a[a.length - 1]) > 4) {
                for (var i = a.length - 2; i >= 0; i--) {
                    a[i] = parseInt(a[i]) + 1;
                    if (a[i] == 10) {
                        a[i] = 0;
                        b = i != 1;
                    } else break;
                }
            }
            s = a.join("").replace(new RegExp("(\\d+)(\\d{" + d + "})\\d$"), "$1.$2");
        }
        if (b) s = s.substr(1);
        return (pm + s).replace(/\.$/, "");
    }
    return this + "";
};

var p2f = function (f) {
    return (parseFloat(f) || 0).toFixed(2);
};

$(function () {
    $.ajax({
        type: 'post',
        url: ApiUrl + '/member_pd_buy/pd_pay',
        dataType: 'json',
        data: data,
        success: function (result) {
            var data = result.datas;
            if (typeof(data.error) != 'undefined') {
                location.href = WapSiteUrl;
                return;
            }
            data.WapSiteUrl = WapSiteUrl;
            var html = template.render('goods_list', data);
            $("#deposit").html(html);
            $('#totalPrice').html(data.pay_info.pd_info.pdr_amount);
        }
    });

    $('#ToBuyStep2').click(function () {
        toPay(pay_sn, 'member_pd_buy', 'pd_pay');
    });
});