$(function(){
    var key = getCookie('key');
    if (key === null) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    
    $('#feedbackbtn').click(function(){
        var feedback = $('#feedback').val();
        if (feedback == '') {
            $.sDialog({
                skin:"red",
                content:'请填写反馈内容',
                okBtn:false,
                cancelBtn:false
            });
            return false;
        }
        $.ajax({
            url:ApiUrl+"/member_feedback/feedback_add",
            type:"post",
            dataType:"json",
            data:{key:key, feedback:feedback},
            success:function (result){
                if(checkLogin(result.login)){
                    if(!result.datas.error){
                        errorTipsShow('<p>提交成功</p>');

                        setTimeout(function(){
                            window.location.href = WapSiteUrl + '/js_template/member/member.html';
                        }, 3000);
                    }else{
                        errorTipsShow('<p>' + result.datas.error + '</p>');
                    }
                }
            }
        });
    });
});