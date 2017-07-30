delCookie("add_lock");
//检查回传标识
var resdata=getValueFromUrl("resdata");
if(resdata){
    if(resdata=="savefail"){
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
            content: '保存成功，等待管理员审核',
            okBtn: true,
            cancelBtn: false,
            okFn:function () {
                window.location="service_set.html";
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
                window.location="service_set.html";
            }
        });
    }
}
$(function () {
    var key = getCookie('key');
    if (!key) {window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    $("input[name='key']").val(key); //设置表单的key
	$(".gcategory_service_list").change(function () {
	    $(".g_name").empty();
        $(".g_name").append("<option value='-1'>-请选择-</option>");
        $(".g_jingle").empty();
        $(".g_jingle").append("<option value='-1'>-请选择-</option>");
        if($(this).val()!=-1){
              var selected_name = $(this).find("option:selected").html();
            loadServiceList1(selected_name,key);
        }
        else {
            $(".g_name").val("");
        }
        $(".g_name").change(function(){
            $(".g_jingle").empty();
            $(".g_jingle").append("<option value='-1'>-请选择-</option>")
            if($(this).val()!=-1) {
                // var selected_name1 = $(this).find("option:selected").html();
                var selected_name1 = $(this).find("option:selected").html();
                loadServiceList2(selected_name1, key);
            }
        });
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
            //加载已发布的服务列表
            $.post(ApiUrl+"/member_index/load_service_list",{"key":key},function (data) {
                $(".member-center").append(data);
            },null);

            //获取医院地点和科室地点
            $.post(ApiUrl+"/member_index/get_address",{"key":key},function (data) {
                if(data && data!=""){
                    var obj = eval('(' + data + ')');
                    if(obj){
                        $("#hispital_address").val(obj.hispital_address); //医院地点
                        $("#depart_address").val(obj.depart_address); //科室地点
                    }
                }
            },null);
            bindFormValidate(); //绑定表单验证
            loadServiceList(key); //加载服务类别列表

            getCommisRate();
            $(".gcategory_service_list").change(function () {
                getCommisRate();
            });
            $(".private_price").change(function () {
                conputeSystemPrice();
            });
        }
    },null);
});
//编辑时初始化基本数据
function initBaseData(key) {
    var goods_id=getValueFromUrl("goods_id"); //获取服务id
    if(goods_id){
        $("input[name='goods_id']").val(goods_id);
        $("input[name='opType']").val("edit");
        $.post(ApiUrl+"/member_index/get_goods_info",{'key':key,'goods_id':goods_id},function (data) {
            if(data=="nogoods"){
                Zepto.sDialog({
                    skin: "red",
                    content: '该服务不存在',
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
                    var select_value=$(".gcategory_service_list").find("option[data-id='"+obj.gc_id+"']").val();
                    $(".gcategory_service_list").val(select_value);
                    $(".g_name").val(obj.goods_name);
                    $(".g_jingle").val(obj.goods_jingle);
                    $(".private_price").val(obj.doctor_private_price);
                    $(".goods_storage").val(obj.goods_storage);
                    $("#sart_time").val(obj.doctor_service_start_time); //服务开始时间
                    $("#end_time").val(obj.doctor_service_end_time); //服务结束时间
                    $("#hispital_address").val(obj.hispital_address); //医院地点
                    $("#depart_address").val(obj.depart_address); //科室地点
					$("#hispital_zuozhen").val(obj.hispital_zuozhen); //坐诊医院
                    getCommisRate(); //获取翻倍比例，并计算平台价格
                }
            }
        },null);
    }
}

//格式化时间戳
function formatDate(now) {
    var year=now.getYear();
    var month=now.getMonth()+1;
    var date=now.getDate();
    var hour=now.getHours();
    var minute=now.getMinutes();
    var second=now.getSeconds();
    return "20"+year+"-"+month+"-"+date+" "+hour+":"+minute+":"+second;
}

//获取翻倍比例的倍数
function getCommisRate() {
    var rate=$(".gcategory_service_list").find("option:selected").val(); //服务翻倍比例
    var gc_id=$(".gcategory_service_list").find("option:selected").attr("data-id"); //服务类别id
    var point_rate=$(".gcategory_service_list").find("option:selected").attr("data-pointrate"); //服务赠送积分比例

    if(rate){
        if(parseInt(rate)<=0){
            $(".commis_rate").html(0);
        }
        else {
            $(".commis_rate").html(rate);
        }
    }
    $(".gc_id").val(gc_id);
    $(".buy_points_rate").val(point_rate); //设置购买服务赠送的积分比例
    conputeSystemPrice(); //计算平台价格
}

//计算平台价格
function conputeSystemPrice() {
    var privatePrice=parseFloat($(".private_price").val()); //获取私有价格
    if(privatePrice){
        var rate=parseFloat($(".gcategory_service_list").find("option:selected").val()); //获取平台翻倍比例
        if(parseInt(rate)<=0){
            rate=0;
        }
        var systemPrice=privatePrice*rate; //计算出平台翻倍后的价格
        $(".system_price").val(systemPrice.toFixed(2));
    }
    else {
        $(".system_price").val(0.00);
    }
}

//加载服务类别列表
function loadServiceList(key) {
    $.post(ApiUrl+"/member_index/load_service_category",{"key":key},function (data) {
        $(".gcategory_service_list").append(data);
         initBaseData(key); //编辑时初始化基本数据
    },null);
}
//加载服务名称
function loadServiceList1(g_name,key) {
    $.post(ApiUrl+"/member_index/load_service_category2",{"g_name":g_name,"key":key},function (data) {
        if(data==""){
            $(".g_name").append("<option selected = 'selected' value='"+g_name+"'>"+g_name+"</option>");
        }else{
            $(".g_name").append(data);
            var selected_name1 = $(".g_name").find("option:selected").html();
                loadServiceList2(selected_name1, key);
        }
         // $(".g_name").append(data);
        // initBaseData(key); //编辑时初始化基本数据
    },null);
}
function loadServiceList2(g_lingle,key){
    $.post(ApiUrl+"/member_index/load_service_category3",{"g_lingle":g_lingle,"key":key},function (data) {
        if(data==""){
            $(".g_jingle").append("<option selected = 'selected' >"+g_lingle+"</option>");
            // value='"+g_lingle+"'
        }else{
            $(".g_jingle").append(data);
        }
        // $(".g_name").append(data);
        // initBaseData(key); //编辑时初始化基本数据
    },null);
};

//绑定表单验证
function bindFormValidate() {
    $("#submitForm").validate({
        errorPlacement: function (error, element) {
            //element.nextAll('span').first().after(error);
            //alert($(element).html());
            //$(element).css("border", "dashed 1px red");
        },
        rules:{
            g_name:{ //服务名称
                required: true
            },
            private_price:{ //服务价格
                required: true,
                number      : true,
                min         : 0.00,
                max         : 9999999
            },
            hispital_address:{  //医院地点
                required: true
            },
            depart_address:{ //科室地点
                required: true
            },
			hispital_zuozhen:{ //坐诊医院
                required: true
            },
            system_price : { //平台价格
                required    : true,
                number      : true,
                min         : 0.00,
                max         : 9999999
            },
            goods_storage:{ //服务数量
                required    : true,
                digits      : true,
                min         : 0,
                max         : 999999999
            },
            sart_time : { //服务开始时间
                required    : true
            },
            end_time  : { //服务结束时间
                required    : true
            }
        }
    });
}

//提交表单验证
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

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}