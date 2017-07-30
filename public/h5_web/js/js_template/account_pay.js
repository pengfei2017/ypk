//检查回传标识
var resdata=getValueFromUrl("resdata");
if(resdata){
    if(resdata=="err"){
        Zepto.sDialog({
            skin: "red",
            content: '保存失败',
            okBtn: false,
            cancelBtn: false
        });
    }
    if(resdata=="ok"){
        Zepto.sDialog({
            skin: "red",
            content: '保存成功',
            okBtn: false,
            cancelBtn: false
        });
    }
}

$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    $("input[name='key']").val(key);
    $.post(ApiUrl+"/member_index/account_pay",{'key':key,'type':'init'},function (data) {
        if(data){
            var obj=eval("("+data+")");
            $("#account_pay").val(obj.datas.account_pay);
            $("#account_wx").val(obj.datas.account_wx);
            $("#account_bank").val(obj.datas.account_bank);
            $("#bank_type").val(obj.datas.bank_type);
            $("#bank_class").val(obj.datas.bank_class);
            $("#bank_name").val(obj.datas.bank_name);
            $("#bank_address").val(obj.datas.bank_address);
        }

    },null);

});

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}