var audio_playing = false; //是否正在播放声音
var __sto = setTimeout;
window.setTimeout = function(callback,timeout,param)
{
    var args = Array.prototype.slice.call(arguments,2);
    var _cb = function()
    {
        callback.apply(null,args);
    };
    __sto(_cb,timeout);
};
function sleep(numberMillis) {
    var now = new Date();
    var exitTime = now.getTime() + numberMillis;
    while (true) {
        now = new Date();
        if (now.getTime() > exitTime)
            return;
    }
}

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
    setTimeout(msg_tips,3000,key);

    //异步加载列表数据
    function loadDataList(serviceId) {
        $.post(ApiUrl+"/member_index/load_doctor_service_record_list", {"key":key,"serviceId": serviceId}, function (data) {
            $(".ulArea").remove();
            $(".member-center").append(data);
        }, null);
    }
});

//服务购买的消息提醒
function msg_tips(key) {
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

            var arr=eval("("+data+")");
            var str="";
            for(var key_index in arr){
                str+="<p style='text-align: left;'>"+arr[key_index].buyer_name+"&nbsp;&nbsp;兑换码:"+arr[key_index].vr_code+"</p>";
                $("ul[id='"+arr[key_index].id+"']").find(".is_exchange").find('.content').html("<span style='color: green;font-weight: bold;'>是</span>");
                $("ul[id='"+arr[key_index].id+"']").find(".vr_code").find('.content').html("<span style='color: green;font-weight: bold;'>"+arr[key_index].vr_code+"</span>");
            }

            Zepto.sDialog({
                autoTime:5000,
                content:''+str+'',
                okBtn:false,
                cancelBtn:false
            });
            // var idArr=data.split(",");
            // for (var i=0;i<idArr.length;i++){
            //     $("ul[id='"+idArr[i]+"']").find(".is_exchange").find('.content').html("<span style='color: green;font-weight: bold;'>是</span>");
            // }

        }
        setTimeout(msg_tips,6000,key);
    },null);
    // var str="";
    // str+="admin&nbsp;&nbsp;&nbsp;兑换码:5566778810086<br/><br/>";
    // str+="admin&nbsp;&nbsp;&nbsp;兑换码:5566778810086<br/><br/>";
    // str+="admin&nbsp;&nbsp;&nbsp;兑换码:5566778810086<br/><br/>";
    // Zepto.sDialog({
    //     autoTime:3000,
    //     content:''+str+'',
    //     okBtn:false,
    //     cancelBtn:false
    // });
}

function show_tips_dialog(str) {
    Zepto.sDialog({
        autoTime:3000,
        content:str,
        okBtn:false,
        cancelBtn:false
    });
}