	function get_sms_captcha(type){
        if($("#phone").val().length == 11 && $("#image_captcha").val().length == 4){
            var ajaxurl = '/shop/connect_sms/get_captcha&nchash=1&type='+type;
            ajaxurl += '&captcha='+$('#image_captcha').val()+'&phone='+$('#phone').val();
			$.ajax({
				type: "GET",
				url: ajaxurl,
				async: false,
				success: function(rs){
                    if(rs == 'true') {
                    	$("#sms_text").html('短信验证码已发出');
                    } else {
                        showError(rs);
                    }
			    }
			});
    	}
	}

	//检测手机校验码
	function check_captcha(){
        if($("#phone").val().length == 11 && $("#sms_captcha").val().length == 6){
            var ajaxurl = '/member/connect_sms/check_captcha';
            ajaxurl += '&sms_captcha='+$('#sms_captcha').val()+'&phone='+$('#phone').val();
			$.ajax({
				type: "GET",
				url: ajaxurl,
				async: false,
				success: function(rs){
            	    if(rs == 'true') {
            	        $.getScript('/member/connect_sms/register'+'&phone='+$('#phone').val());
            	        $("#register_sms_form").show(); //显示“设置密码”页面
                        var phongNum=$("#post_form").find("#phone").val(); //获取填写的手机号码
                        $("#register_sms_form").find("#member_name").val(phongNum); //设置默认显示电话号码
                        $("#register_sms_form").find("#sms_password").val(""); //清空自动生成的密码
            	        $("#post_form").hide(); //隐藏“填写手机号”页面
            	    } else {
            	        showError(rs);
            	    }
			    }
			});
    	}
	}