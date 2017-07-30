var audio_playing = false; //是否正在播放声音

$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }

    $.post(ApiUrl+"/member_index/load_doctor_service_list",{"key":key},function (data) {
        $("#serviceList").append(data);
    },null);
    loadDataList(-1);
    $("#serviceList").change(function () {
        var serviceId = $(this).find("option:checked").val(); //获取服务id（亦即商品id）
        loadDataList(serviceId);
    });

    //设置一个定时器
    setInterval(function () {
        $.post(ApiUrl+"/member_index/check_buy",{"key":key},function (data) {
            if(data!="" && data!=null && data!="null" && data!='undefined'){
                var currentAudio = document.getElementById("msg_tip_audio");
                if (audio_playing) {
                    audio_playing = false;
                    currentAudio.pause();
                }
                audio_playing = true;
                try {
                    lastRunTime = Date.now();
                    currentAudio.play(); //开始播放，可能需要三四秒才能播放完，所以下面不能立马把audio_playing设置为false
                } catch (e) {
                }
                var idArr=data.split(",");
                for (var i=0;i<idArr.length;i++){
                    $("ul[id='"+idArr[i]+"']").find(".is_exchange").find('.content').html("<span style='color: green;font-weight: bold;'>是</span>");
                }
            }
        },null);
    },7000); //用于提醒服务被兑换

    //异步加载列表数据
    function loadDataList(serviceId) {
        $.post(ApiUrl+"/member_index/load_doctor_service_record_list", {"key":key,"serviceId": serviceId}, function (data) {
            $(".ulArea").remove();
            $(".member-center").append(data);
        }, null);
    }
});