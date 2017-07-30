delCookie("add_lock");
//检查回传标识
var resdata=getValueFromUrl("resdata");
if(resdata){
    if(resdata=="savefail"){
        Zepto.sDialog({
            skin: "red",
            content: '参数不正确',
            okBtn: false,
            cancelBtn: false
        });
    }
    if(resdata=="ok"){
        Zepto.sDialog({
            skin: "red",
            content: '保存成功，等待管理员审核',
            okBtn: true,
            cancelBtn: false,
            okFn:function () {
                window.location="chat_card.html";
            }
        });
    }
    if(resdata=="del"){
        Zepto.sDialog({
            skin: "red",
            content: '删除成功',
            okBtn: true,
            cancelBtn: false,
            okFn:function () {
                window.location="chat_card.html";
            }
        });
    }
    if(resdata=="false"){
        Zepto.sDialog({
            skin: "red",
            content: '删除失败',
            okBtn: true,
            cancelBtn: false,
            okFn:function () {
                window.location="chat_card.html";
            }
        });
    }
    if(resdata=="err"){
        Zepto.sDialog({
            skin: "red",
            content: '保存失败',
            okBtn: false,
            cancelBtn: false
        });
    }
    if(resdata=="nogoods"){
        Zepto.sDialog({
            skin: "red",
            content: '该服务不存在',
            okBtn: true,
            cancelBtn: false,
            okFn:function () {
                window.location="chat_card.html";
            }
        });
    }
}
$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    bindFormValidate();
    
    $("#private_price").change(function () {
        var private_price=$("#private_price").val(); //私有价格
        var commis_rate=$(".commis_rate").html(); //翻倍比例
        var goods_price=(parseFloat(private_price)*parseFloat(commis_rate)).toFixed(2); //翻倍后的价格
        $("#goods_price").val(goods_price);
    });
    
    //检查当前医务人员是否已经通过审核
    $.post(ApiUrl+"/member_index/check_doctor_ispass",{"key":key},function (data) {
        if(data=="err"){
            Zepto.sDialog({
                skin: "red",
                content: '您尚未通过审核',
                okBtn: true,
                cancelBtn: false,
                okFn:function () {
                    window.location="member.html";
                }
            });
        }
        if(data=="nocomplete"){
            Zepto.sDialog({
                skin: "red",
                content: '请先完善资料再发布服务',
                okBtn: true,
                cancelBtn: false,
                okFn:function () {
                    window.location="member_info.html";
                }
            });
        }
        else {
            //获取已发布的聊天卡的列表
            $.post(ApiUrl+"/member_index/chat_card",{"key":key},function (data) {
                $(".member-center").append(data);
            },null);
            $("input[name='key']").val(key);
            loadServiceList(key); //加载聊天卡类别列表
            bindFormValidate(); //绑定表单验证
        }
    },null);
});

function initBaseData(key) {
    var goods_id=getValueFromUrl("goods_id"); //获取服务id
    if(goods_id){
        $("input[name='goods_id']").val(goods_id);
        $("input[name='opType']").val("edit");
        $.post(ApiUrl+"/member_index/get_goods_info",{'key':key,'goods_id':goods_id},function (data) {
            if(data=="nogoods"){
                Zepto.sDialog({
                    skin: "red",
                    content: '该聊天卡不存在',
                    okBtn: true,
                    cancelBtn: false,
                    okFn:function () {
                        history.back();
                    }
                });
            }
            else {
                var obj = eval('(' + data + ')');
                if(obj){
                    //var select_value=$(".gcategory_service_list").find("option[data-id='"+obj.gc_id+"']").val();
                    //$(".gcategory_service_list").val(select_value);
                    $("#g_name").val(obj.goods_name);
                    $("#g_jingle").val(obj.goods_jingle);
                    $("#private_price").val(obj.doctor_private_price); //聊天卡私有价格
                    $("#goods_price").val(obj.goods_price); //聊天卡平台价格
                    $("#goods_storage").val(obj.goods_storage);
                    $("#sart_time").val(obj.doctor_service_start_time);
                    $("#end_time").val(obj.doctor_service_end_time);
                    $("#goods_spec").val(parseInt(obj.spec_name)/60); //聊天卡时长
                    $(".commis_rate").html(obj.commis_rate); //聊天卡翻倍比例
                }
            }
        },null);
    }
    else {
        $.post(ApiUrl+"/member_index/get_commis_rate",{'key':key},function (data) {
            $(".commis_rate").html(data);
        },null);
    }
}

function bindFormValidate() {
    $("#submitForm").validate({
        errorPlacement: function (error, element) {
            //element.nextAll('span').first().after(error);
            //alert($(element).html());
            //$(element).css("border", "dashed 1px red");
        },
        rules:{
            g_name:{ //聊天卡名称
                required: true
            },
            private_price:{ //聊天卡私有价格
                required: true,
                number      : true,
                min         : 0.00,
                max         : 9999999
            },
            goods_price:{ //聊天卡平台价格
                required: true,
                number      : true,
                min         : 0.00,
                max         : 9999999
            },
            goods_storage:{ //聊天卡数量
                required    : true,
                digits      : true,
                min         : 0,
                max         : 999999999
            },
            sart_time:{ //开始时间
                required    : true
            },
            end_time:{ //结束时间
                required    : true
            },
            goods_spec:{
                required    : true,
                digits      : true,
                min         : 1,
                max         : 999999999
            }
        }
    });
}

function formSubmit() {
    var add_lock=getCookie("add_lock");
    if(add_lock=="ok"){
        Zepto.sDialog({
            skin: "red",
            content: '请勿重复提交',
            okBtn: false,
            cancelBtn: false
        });
        return;
    }else {
        addCookie("add_lock","ok",3600);
        if($("#submitForm").valid()){
            //进行权限验证
            if(parseInt($(".gcategory_service_list").find("option:checked").val())<0){
                Zepto.sDialog({
                    skin: "red",
                    content: '请选择服务类别',
                    okBtn: false,
                    cancelBtn: false
                });
                return;
            }
            var key = getCookie('key');
            $.post(ApiUrl+"/member_index/validate_member",{'key':key},function (data) {
                var obj = eval('(' + data + ')');
                if(obj.datas.msg=="ok"){
                    $("#submitForm").submit();
                }
                else if(obj.datas.msg=="illegal"){
                    Zepto.sDialog({
                        skin: "red",
                        content: '非医务人员无权操作',
                        okBtn: false,
                        cancelBtn: false
                    });
                }
                else if(obj.datas.msg=="nopass"){
                    Zepto.sDialog({
                        skin: "red",
                        content: '您的申请尚未通过审核',
                        okBtn: false,
                        cancelBtn: false
                    });
                }
                else {
                    Zepto.sDialog({
                        skin: "red",
                        content: '系统繁忙，请稍后再试',
                        okBtn: false,
                        cancelBtn: false
                    });
                }
            },null);
        }else {
            delCookie("add_lock");
            Zepto.sDialog({
                skin: "red",
                content: '填写的数据格式错误',
                okBtn: false,
                cancelBtn: false
            });
        }
    }

}

//加载聊天卡下拉菜单列表
function loadServiceList(key) {
    $.post(ApiUrl+"/member_index/chat_card_select",{"key":key},function (data) {
        $(".gcategory_service_list").html(data);
        initBaseData(key);
    },null);
}

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}