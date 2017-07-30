$(function(){
    var mobile = getQueryString("mobile");
    var captcha = getQueryString("captcha");
    
    // 显示密码
    $('#checkbox').click(function(){
        if ($(this).prop('checked')) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });

    //加载用户身份列表
    $.post(ApiUrl+"/connect/load_member_type_list",null,function (data) {
        $("#member_type_list").html(data);
        changeMemberTypeEvent();
    },null);

    $("#member_type_list").change(function () { //用户身份改变事件
        changeMemberTypeEvent();
    });

    Zepto.sValid.init({//注册验证
        rules:{
            password:"required",
            member_name:"required"
        },
        messages:{
            password:"密码必填!",
            member_name:"帐号必填"
        },
        callback:function (eId,eMsg,eRules){
            if(eId.length >0){
                var errorHtml = "";
                $.map(eMsg,function (idx,item){
                    errorHtml += "<p>"+idx+"</p>";
                });
                errorTipsShow(errorHtml);
            }else{
                errorTipsHide()
            }
        }  
    });

    //设置密码后，提交注册
    $('#completebtn').click(function(){
        if (!$(this).parent().hasClass('ok')) {
            return false;
        }
        var member_type_id=$("#member_type_list").val(); //获取用户身份id
        if(parseInt(member_type_id)>1){
            if(!$("#business_person_body").val() || $("#business_person_body").val().length<=0){
                errorTipsShow('<p>请选择个人全身照</p>');
                return false;
            }
            if(!$("#business_id_card").val() || $("#business_id_card").val().length<=0){
                errorTipsShow('<p>请选择手持身份证半身照</p>');
                return false;
            }
            if(!$("#business_qualification_certificate").val() || $("#business_qualification_certificate").val().length<=0){
                errorTipsShow('<p>请选择医师资格证书</p>');
                return false;
            }
            if(!$("#business_certified_certificate").val() || $("#business_certified_certificate").val().length<=0){
                errorTipsShow('<p>请选择医师执业证书</p>');
                return false;
            }
        }

        var password = $("#password").val(); //密码
        if(Zepto.sValid()){
            var inviteId=$("input[name='inviteId']").val(); //获取邀请人id
            //$("#myform").submit(); //提交表单数据（此处只用于提交图片证件数据）
            //ajaxFileUpload();
            var formData = new FormData(document.getElementById("myform"));
            //添加其他额外的数据
            formData.append("member_name",$("#member_name").val());
            formData.append("phone",mobile);
            formData.append("captcha",captcha);
            formData.append("client","h5_web");
            formData.append("member_type_id",member_type_id);
            $("#coverDiv").css("display","block"); //显示遮罩层
            $.ajax({
                type:'post',
                url:ApiUrl+"/connect/sms_register",
                data:formData,
                dataType:'json',
                processData: false,  // 告诉jQuery不要去处理发送的数据
                contentType: false,   // 告诉jQuery不要去设置Content-Type请求头
                success:function(result){
                    $("#coverDiv").css("display","block"); //隐藏遮罩层
                    if(result.datas.error=="ok"){
                        Zepto.sDialog({
                            skin: "red",
                            content: '申请已成功提交，请耐心等待短信通知结果',
                            okBtn: false,
                            cancelBtn: false
                        });
                        setTimeout(function () {
                            window.location="../../index.html";
                        },2500);
                        return;
                    }
                    if(!result.datas.error){
                        //addCookie('username',result.datas.username);
                        //addCookie('key',result.datas.key);
                        location.href = WapSiteUrl + '/js_template/member/login.html';
                    }else{
                        errorTipsShow("<p>"+result.datas.error+"</p>");
                    }
                }
            });         
        }
    });

    //处理邀请链接
    processInviteUrl();
});

//处理邀请链接
function processInviteUrl() {
    var inviteId=getValueFromUrl('inviteId'); //邀请人id
    $("input[name='inviteId']").val(inviteId);
}

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}

//根据客户身份判断上传证件标签是否显示
function changeMemberTypeEvent() {
    var member_type_id=$("#member_type_list").val();
    if(parseInt(member_type_id)>1){
        $(".doctorinfo").css("display","block");
    }else {
        $(".doctorinfo").css("display","none");
    }
}

function ajaxFileUpload()
{

    $.ajaxFileUpload({
            url:ApiUrl+"/connect/sms_register",
            //secureuri:false,
            fileElementId:['business_person_body','business_id_card','business_qualification_certificate','business_certified_certificate'],
            dataType: 'json'
        }
    );

    return false;

}


