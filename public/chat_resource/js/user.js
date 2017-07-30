var interval = 1;//断开后计时
var new_interval = 1;//消息提醒计时
var connect = 0;//连接状态
var new_msg = 0;//新消息数
var obj = {};
var socket = {};
var chat_log = {};
var connect_list = {};
var connect_n = 0;
var web_info = new Array();//页面信息
var friend_list = new Array();//我的好友
var recent_list = new Array();//最近联系人
var user_list = new Array();//所有会员信息
var msg_list = new Array();//收到消息
var goods_list = new Array();//所有商品信息
var store_goods = new Array();//医生推荐的商品
var dialog_show = 0;//对话框是否打开
var user_show = 0;//当前选择的会员
var msg_max = 20;//消息数
var time_max = 10;//定时(分钟)刷新防止登录超时退出,为0时关闭
var chat_audio = 1;//消息提醒声音开关
var audio_playing = false; //是否正在播放声音
var currentAudio = null; //当前播放的是那一首提示声音
var lastRunTime = Date.now(); //最后一次播放提示音的时间
var protectTime = 100;//设置保护性延时 单位毫秒，不要小于50 建议100以上
var doctor_id;
//判断是否有聊天权限
var member_chat_card = $.parseJSON(user['member_chat_card']);
var audio_info = '<audio id="msg_tip_audio" style="display: none;"><source src="' + CHAT_RESOURCE_URL + '/msg.mp3" type="audio/mpeg"/><source src="' + CHAT_RESOURCE_URL + '/msg.ogg" type="audio/ogg"/><source src="' + CHAT_RESOURCE_URL + '/msg.wav" type="audio/wav"/></audio>';
var order_evaluate_html = '<span style="float: right; padding: 0; margin-right:10px; text-decoration: underline;" class="title"><a id="order_evaluate" href="javascript:order_evaluate();">评价</a></span>';
var order_vrrefund_html = '<span style="float: right; padding: 0; margin-right:10px; text-decoration: underline;" class="title"><a id="order_vrrefund" href="javascript:order_vrrefund2();">投诉</a></span>';
$(function () {
    if (layout == 'seller_layout') {
        return;
    }
    if (user['u_id'] != '') {
        //清除浏览器残留的和自己聊天的聊天卡，避免自己和自己聊天（和自己的聊天凭证chat_time_47_47的情况）
        $.cookie('chat_time_' + user['u_id'] + '_' + user['u_id'], null, {
            expires: -1, //单位是天
            path: '/'
        });
        web_info['chat_goods_html'] = '';
        web_info['html_title'] = $(document).attr('title');
        web_info['msg_dialog'] = '<div id="new_msg_dialog" class="msg-windows"><div class="user-tab-bar"><ul class="user-list" id="user_list"></ul></div>' +
            '<div class="msg-dialog"><div class="dialog-body">' +
            '<div id="msg_list" class="msg-contnet"><div id="user_msg_list"></div></div>' +
            '<div class="msg-input-box"><div class="msg-input-title"><a id="chat_show_smilies" href="javascript:void(0)" class="chat_smiles">表情</a>' +
            '<span style="display: block; float: left; position: relative; width: 24px; height: 24px; margin-left: 10px; background-image: url(/h5_web/images/open_image.png); background-repeat: no-repeat; background-position: 50% 50%; background-size: 85%;" class="open-image"> <input style="position:absolute; display: block; width: 22px; height: 22px; opacity: 0; filter: alpha(opacity=0); cursor: pointer;" class="type-file-file" id="_pic" name="_pic" type="file" size="30" hidefocus="true"> </span>' +
            '<script type="text/javascript" src="/resource/js/jquery.js"></script><script type="text/javascript">var $jq = jQuery.noConflict();</script><script type="text/javascript" src="/resource/js/ajaxfileupload/ajaxfileupload.js"></script>' +
            '<span style="margin-left: 10px;">剩余：<strong id="chat_time" style="color:#00D800;"></strong>&nbsp;</span><span class="chat-log-btn off" onclick="show_chat_log();">聊天记录<i></i></span></div>' +
            '<form id="msg_form"><textarea name="send_message" id="send_message" class="textarea" onkeyup="send_keyup(event);" onfocus="send_focus();" ></textarea>' +
            '<div class="msg-bottom"><div id="msg_count"></div><a href="JavaScript:void(0);" onclick="send_msg();" class="msg-button"><i></i>发送消息</a><div id="send_alert"></div></div></form></div></div>' +
            '<div id="dialog_chat_right" class="dialog-chat-right"></div><div id="dialog_chat_log" class="dialog_chat_log"></div></div>' +
            '<div id="dialog_clear" class="dialog_clear"></div></div>';
        var chat_user_list = '<div class="chat-box"><div class="chat-list"><div class="chat-list-top"><h1><i></i>联系人</h1><span class="minimize-chat-list" onclick="chat_show_list();"></span><span id="set_my_online_state" style="float: right;color: #fff;margin-right: 10px;line-height: 28px;cursor: pointer;text-decoration: underline;" onclick="set_my_online_state();">设为离线</span></div>' +
            '<div id="chat_user_list" class="chat-list-content"><div><dl id="chat_user_friends"><dt onclick="chat_show_user_list(\'friends\');">' +
            '<span class="show"></span>我的好友</dt><dd id="chat_friends" style="display: none;"></dd></dl>' +
            '<dl id="chat_user_recent"><dt onclick="chat_show_user_list(\'recent\');"><span class="show"></span>最近联系人</dt><dd id="chat_recent" style="display: none;"></dd></dl></div></div>' +
            '</div></div>';
        var ajaxurl = CHAT_SITE_URL + '/web_chat/get_user_list&n=99&f_id=' + user['u_id'];
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: "jsonp",
            async: true,
            success: function (u_list) {
                for (var u_id in u_list) {
                    var user_info = u_list[u_id];
                    connect_list[u_id] = 0;
                    connect_n++;
                    set_user_info(u_id, "u_name", user_info['u_name']);
                    set_user_info(u_id, "avatar", user_info['avatar']);
                    if (user_info['friend'] == 1) friend_list[u_id] = user_info;
                    if (user_info['recent'] == 1) recent_list[u_id] = user_info;
                }

                setTimeout("getconnect()", 1000);

                $("#web_chat_dialog").prepend(chat_user_list);
                $('#chat_user_list').perfectScrollbar();

                setInterval(function () {
                    $.get(CHAT_SITE_URL + '/web_chat/get_session&key=member_id');
                }, time_max * 60000);
                $("#chat_show_user").click(function () {
                    chat_show_list();
                });
            }
        });
        if (act_op == 'goods_index') {//异步调用商品信息
            var ajaxurl = CHAT_SITE_URL + '/web_chat/get_goods_info&goods_id=' + chat_goods_id;
            $.ajax({
                type: "GET",
                url: ajaxurl,
                dataType: "jsonp",
                async: true,
                success: function (goods) {
                    if (typeof goods['goods_id'] !== "undefined") {
                        goods_id = goods['goods_id'];
                        goods_list[goods_id] = goods;
                        web_info['chat_goods_id'] = goods_id;
                        var goods_html = '';
                        goods_html += '<div class="goods-info">';
                        goods_html += '<div class="goods-pic"><a target="_blank" href="' + goods['url'] + '">';
                        goods_html += '<img src="' + goods['pic24'] + '"></a></div>';
                        goods_html += '<div class="goods-price">&yen;' + goods['goods_promotion_price'] + '</div>';
                        goods_html += '<div class="goods-name"><a class="goods_pic" target="_blank" href="' + goods['url'] + '">';
                        goods_html += goods['goods_name'] + '</a></div>';
                        goods_html += '<div class="goods-buy"><a class="buynow" href="JavaScript:void(0);" onclick="chat_goods_buy();">立即购买</a></div>';
                        goods_html += '</div>';
                        web_info['chat_goods_html'] = goods_html;
                    }
                }
            });
        }
    } else {
        var n = send_state();
        if (n > 0) setTimeout("getconnect()", 2000);
        $("#chat_show_user").click(function () {
            $('div[nctype="a-barLoginBox"]').trigger("click");
        });
    }

});
//window.onerror=function(){return true;}
$("#web_chat_dialog").after(audio_info);
if (typeof JSON !== 'object') {//兼容IE7
    $.getScript(RESOURCE_SITE_URL + '/js/json2.js');
}

function msg_dialog_close(id) {
    if (dialog_show == 1) $("#" + id).hide("slide", {direction: 'right'}, 300);
    dialog_show = 0;
    close_chat_log(user_show);
    if (connect === 1) $("#web_chat_dialog").show();
}
function msg_dialog_show(id) {
    if (dialog_show == 0) {
        $("#" + id).show("slide", {direction: 'right'}, 600,
            function () {
                $("#send_message").focus();
                var obj_msg = obj.find("div[select_user_msg='" + user_show + "']");
                setTimeout(function () {
                    obj.find("#msg_list").scrollTop(obj_msg.height());
                }, 300);
            });
    } else {
        $("#send_message").focus();
    }
    dialog_show = 1;
    if ($("#msg_count").html() == '') {
        $("#send_message").charCount({//输入字数控制
            allowed: 255,
            warning: 10,
            counterContainerID: 'msg_count',
            firstCounterText: '还可以输入',
            endCounterText: '字',
            errorCounterText: '已经超出'
        });
        $("#chat_show_smilies").smilies({smilies_id: "send_message"});
    }

    update_chat_time();

    obj.find('input[class="type-file-file"]').change(uploadChange);
}
function send_state() {//向服务器请求页面中的相关会员的在线状态
    var u_list = connect_list;
    var n = connect_n;
    if (layout == 'store_layout') {
        $("[member_id]").each(function () {
            n++;
            var u_id = $(this).attr("member_id");
            if (u_id > 0 && u_id != user['u_id']) u_list[u_id] = 0;
        });
    } else {
        switch (act_op) {
            case "act_op"://不显示状态
                break;
            case "member_snsfriend_findlist"://会员中心好友中"查找好友"不显示状态
            case "member_snsfriend_follow"://会员中心好友中"我关注的"不显示状态
            case "member_snsfriend_fan"://会员中心好友中"关注我的"不显示状态
                break;
            case "brand_list":
            case "search_index":
                $(".list_pic em[member_id]").each(function () {
                    n++;
                    var u_id = $(this).attr("member_id");
                    if (u_id > 0 && u_id != user['u_id']) u_list[u_id] = 0;
                });
                break;
            default:
                $("[member_id]").each(function () {
                    n++;
                    var u_id = $(this).attr("member_id");
                    if (u_id > 0 && u_id != user['u_id']) u_list[u_id] = 0;
                });
                break;
        }
    }
    $('[nctype="mcard"]').each(function () {
        var data_str = $(this).attr('data-param');
        eval('var mcard_obj = ' + data_str);
        var u_id = mcard_obj["id"];
        if (u_id > 0 && u_id != user['u_id']) {
            n++;
            u_list[u_id] = 0;
        }
    });

    if (connect === 1) {
        if (n > 0) {
            socket.emit('get_state', u_list);
        } else {
            if (user['u_id'] == '') {
                socket.disconnect();
            }
        }
    } else {
        return n;
    }
}
function get_state(list) {// 返回会员的状态并在页面显示
    var u_list = list['u_state'];
    set_user_list(list['user']);
    if (layout == 'store_layout' || act_op == 'goods_index') {//医生页面
        var store_id = 0;
        var store_name = '';
        if ($("div.service-list").size() > 0) {
            store_id = $("div.service-list").attr("store_id");
            store_name = $("div.service-list").attr("store_name");
            web_info['chat_store_id'] = store_id;
        }
        $("[member_id]").each(function () {
            var u_id = $(this).attr("member_id");
            if (store_id > 0) {
                set_user_info(u_id, "s_id", store_id);
                set_user_info(u_id, "s_name", store_name);
            }
            if ($(this).find(".chat").size() > 0) {
                $(this).find(".chat").remove();
            }
            $(this).prepend(get_chat(u_id, u_list[u_id]));
            if ($(this).attr("c_name")) {//医生客服
                var c_name = $(this).attr("c_name");
                set_user_info(u_id, "c_name", c_name);
                $(this).find(".chat").attr("href", "JavaScript:store_chat(" + u_id + ",'" + c_name + "');");
            }
        });
    } else {
        switch (act_op) {
            case "member_snsfriend_findlist"://会员中心好友中"查找好友"不显示状态
            case "member_snsfriend_follow"://会员中心好友中"我关注的"不显示状态
            case "member_snsfriend_fan"://会员中心好友中"关注我的"不显示状态
                break;
            case "brand_list":
            case "search_index":
                $(".list_pic em[member_id]").each(function () {
                    var u_id = $(this).attr("member_id");
                    if ($(this).find(".chat").size() > 0) {
                        $(this).find(".chat").remove();
                    }
                    $(this).prepend(get_chat(u_id, u_list[u_id]));
                    $(this).after("<p>在线客服</p>");
                });
                break;
            default:
                $("[member_id]").each(function () {
                    var u_id = $(this).attr("member_id");
                    if ($(this).find(".chat").size() > 0) {
                        $(this).find(".chat").remove();
                    }
                    $(this).prepend(get_chat(u_id, u_list[u_id]));
                });
                break;
        }
    }
    if (user['u_id'] != '') {
        update_recent();
        update_friends();
        if (obj.find('#dialog_chat_right').find('.user-info').find('.user-name i').length > 0) {
            obj.find('#dialog_chat_right').find('.user-info').find('.user-name i').remove();
            var online_html = '<i class="offline" title="离线"></i>';
            if (user_list[user_show]['online'] > 0) {
                online_html = '<i class="online" title="在线"></i>';
            }
            obj.find('#dialog_chat_right').find('.user-info').find('.user-name').append(online_html);
        }
        for (var k in user_list) {
            if (user_list[k] && obj.find("li[select_u_id='" + user_list[k]['u_id'] + "']").size() > 0) {
                obj.find("li[select_u_id='" + user_list[k]['u_id'] + "']").find('i').remove();
                var online_html = '<i class="offline" title="离线"></i>';
                if (user_list[k]['online'] > 0) {
                    online_html = '<i class="online" title="在线"></i>';
                }
                obj.find("li[select_u_id='" + user_list[k]['u_id'] + "']").prepend(online_html);
            }
        }

    } else {
        socket.disconnect();
    }
}
function show_obj() {//弹出框
    if (user_show < 1) {
        chat_show_list();
        return false;
    }
    msg_dialog_show('new_msg_dialog');
}
function chat_goods_buy() {
    $('a[nctype="buynow_submit"]').trigger("click");
}
function send_focus() {
    $("#send_alert").html('');
}
function send_keyup(event) {//回车发消息
    var t_msg = $.trim($("#send_message").val());
    if (event.keyCode == 13 && t_msg.length > 0) {
        send_msg();
    }
}
function send_msg() {//发消息
    if (user_show < 1) {
        $("#send_alert").html('未选择聊天会员');
        return false;
    }
    var msg = {};
    msg['f_id'] = user['u_id'];
    msg['f_name'] = user['u_name'];
    msg['t_id'] = user_show;
    msg['t_name'] = user_list[user_show]['u_name'];
    msg['t_msg'] = $.trim($("#send_message").val());
    if (msg['f_id'] == msg['t_id']) {
        send_buy_chat_card_msg(false, '不能和自己聊天');
        return false;
    }
    if (user_list[msg['t_id']]['online'] <= 0) {
        send_buy_chat_card_msg(false, '对方不在线，请稍后再联系');
        return false;
    }
    if (msg['t_msg'].length < 1) {
        $("#send_alert").html('发送内容不能为空');
        return false;
    }
    if (msg['t_msg'].length > 255) {
        $("#send_alert").html('一次最多只能发送255字');
        return false;
    }
    if (connect < 1) {
        $("#send_alert").html('您已经处于离线状态,稍后刷新再试');
        return false;
    }
    var chat_card = ($.cookie('chat_time_' + user_show + '_' + user['u_id']));
    var now = new Date().getTime();
    if (user_show != 1 && user['u_id'] != 1 && (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0)) {
        $.cookie('chat_time_' + user_show + '_' + user['u_id'], null, {
            expires: -1, //单位是天
            path: '/'
        });
        var msg = [];
        msg['f_id'] = user_show;
        msg['add_time'] = getCurrTime();
        msg['t_msg'] = '请&nbsp;<a style="color: #00D800;" href="JavaScript:check_chat_card(' + user_show + ');">选择聊天卡</a>';
        show_f_msg(msg);
        return;
    }
    if (user_show != 1 && user['u_id'] != 1) {
        msg['chat_card_id'] = (chat_card.split('_'))[0];
    } else {
        msg['chat_card_id'] = 0;
    }
    $.ajax({
        type: "POST",
        url: CHAT_SITE_URL + '/web_chat/send_msg',
        dataType: "jsonp",
        data: msg,
        async: false,
        success: function (t_msg) {
            if (t_msg['error']) {
                $("#send_alert").html('' + t_msg['error']);
                return false;
            } else {
                if (connect === 1) {
                    $("#send_message").val('');
                    $("#send_message").focus();
                    $("#send_alert").html('');
                    show_t_msg(t_msg);
                    if (chat_goods_id > 0 && typeof goods_list[chat_goods_id] === "object") {
                        var chat_goods = goods_list[chat_goods_id];
                        if (chat_goods['store_id'] == user_list[user_show]['s_id']) {//当前聊天的会员属于当前商品的医生
                            t_msg['chat_goods'] = chat_goods;
                        }
                    }
                    socket.emit('send_msg', t_msg);
                    return true;
                } else {
                    $("#send_alert").html('由于网络原因未发送成功,稍后再试');
                    return false;
                }
            }
        }
    });
}
function get_msg(list) {//接收消息
    var msg = {};
    for (var k in list) {
        msg = list[k];
        var m_id = msg['m_id'];
        var u_id = msg['f_id'];
        set_user(u_id, msg['f_name']);
        if (typeof msg_list[u_id][m_id] === "object") {//防止重复计数
            continue;
        }
        if (typeof msg['user'] === "object" && typeof msg['user']['avatar'] !== "undefined") {
            var user_info = msg['user'];
            var u_name = user_info['u_name'];
            set_user_info(u_id, "u_name", u_name);
            set_user_info(u_id, "s_id", user_info['s_id']);
            set_user_info(u_id, "s_name", user_info['s_name']);
            set_user_info(u_id, "avatar", user_info['avatar']);
            set_user_info(u_id, "s_avatar", user_info['s_avatar']);
            if (user_info['online'] > 0) set_user_info(u_id, "online", 1);
        }
        if (typeof user_list[u_id]['avatar'] === "undefined") {//当没获得会员信息时调用一次
            var ajaxurl = CHAT_SITE_URL + '/web_chat/get_info&t=member&u_id=' + u_id;
            $.ajax({
                type: "GET",
                url: ajaxurl,
                dataType: "jsonp",
                async: false,
                success: function (member) {
                    var u_name = member['member_name'];
                    set_user_info(u_id, "s_id", member['store_id']);
                    set_user_info(u_id, "s_name", member['store_name']);
                    set_user_info(u_id, "avatar", member['member_avatar']);
                    set_user_info(u_id, "s_avatar", member['store_avatar']);
                }
            });
        }
        if (layout == 'seller_layout') {
            chat_goods_info(msg);
        }
        msg_list[u_id][m_id] = msg;
        if (dialog_show == 0 || obj.find("li[select_u_id='" + u_id + "']").size() == 0) {//没有打开对话窗口时计数
            user_list[u_id]['new_msg']++;
            new_msg++;
        } else {
            if (user_show == u_id) {
                show_msg(u_id);//当前对话的会员消息设为已读
                play_audio();
            } else {
                user_list[u_id]['new_msg']++;
                new_msg++;
            }
        }
        alert_user_msg(u_id);
    }
    alert_msg();
}
function get_chat_log(time_from) {
    var obj_chat_log = $("#dialog_chat_log");
    if (obj_chat_log.html() == '') {
        var chat_log_list = '<div class="chat-log-top"><h1><i></i>聊天记录</h1><span class="close-chat-log" onclick="show_chat_log();"></span></div>' +
            '<div id="chat_log_list" class="chat_log_list"><div id="chat_log_msg" class="chat-log-msg"></div></div><div class="chat-log-bottom"><div id="chat_time_from" class="chat_time_from">' +
            '<span time_id="7" onclick="get_chat_log(7);" class="current">7天</span><span time_id="15" onclick="get_chat_log(15);">15天</span><span time_id="30" onclick="get_chat_log(30);">30天</span></div>' +
            '<div class="chat_log_first"><p>已到第一页</p></div><div class="chat_log_last"><p>已到最后一页</p></div>' +
            '<div id="chat_log_page" class="chat_log_page"><span onclick="get_chat_previous();" class="previous" title="上一页"></span><span onclick="get_chat_next();" class="next" title="下一页"></span></div></div>';
        obj_chat_log.append(chat_log_list);
    }
    obj_chat_log.show();
    chat_log['u_id'] = user_show;
    chat_log['now_page'] = 0;
    chat_log['total_page'] = 0;
    chat_log['time_from'] = 7;
    chat_log['list'] = new Array();
    var time_id = obj_chat_log.find("span.current").attr("time_id");
    if (time_from != time_id) {
        obj_chat_log.find("span.current").removeClass("current");
        obj_chat_log.find("span[time_id='" + time_from + "']").addClass("current");
        chat_log['time_from'] = time_from;
    }
    get_chat_msg(false);
}
function get_chat_next() {
    var now_page = chat_log['now_page'] - 1;
    if (now_page >= 1) {
        show_chat_msg(now_page);
        chat_log['now_page'] = now_page;
    } else {
        $('.chat_log_last').show();
        setTimeout("$('.chat_log_last').hide()", 2000);
    }
}
function get_chat_previous() {
    var now_page = chat_log['now_page'] + 1;
    if (chat_log['total_page'] >= now_page) {
        if (typeof chat_log['list'][now_page] === "undefined") {
            get_chat_msg(false);
        } else {
            show_chat_msg(now_page);
            chat_log['now_page'] = now_page;
            if (chat_log['total_page'] > now_page && typeof chat_log['list'][now_page + 1] === "undefined") get_chat_msg(true);
        }
    } else {
        $('.chat_log_first').show();
        setTimeout("$('.chat_log_first').hide()", 2000);
    }
}
function get_chat_msg(t) {
    var ajaxurl = CHAT_SITE_URL + '/web_chat/get_chat_log&page=30&f_id=' + user['u_id'] + '&t_id=' + chat_log['u_id'] + '&t=' + chat_log['time_from'];
    if (chat_log['now_page'] > 0) ajaxurl += '&curpage=' + (chat_log['now_page'] + 1);
    $.ajax({
        type: "GET",
        url: ajaxurl,
        dataType: "jsonp",
        async: t,
        success: function (chat_msg) {
            var now_page = chat_log['now_page'] + 1;
            chat_log['list'][now_page] = chat_msg['list'];
            if (t == false) {
                chat_log['now_page'] = now_page;
                show_chat_msg(now_page);
            }
            chat_log['total_page'] = chat_msg['total_page'];
            if (chat_log['total_page'] > 1 && chat_log['total_page'] > now_page && t == false) {
                get_chat_msg(true);
            }
        }
    });
}
function get_goods_info(msg) {//显示商品图片和名称
    if (typeof msg['goods_id'] === "undefined") {//没有定义商品编号时调用检测一次
        var t_msg = msg['t_msg'];
        var shop_site = SHOP_SITE_URL;
        var re = new RegExp(shop_site + "/goods/index&amp;goods_id=(\\d+)$", "g");
        var arr = re.exec(t_msg);
        goods_id = RegExp.$1;
        if (arr == null) {
            re = new RegExp(shop_site + "/item-(\\d+)\\.html$", "g");
            arr = re.exec(t_msg);
            goods_id = RegExp.$1;
            if (arr == null) {
                goods_id = 0;
            }
        }
        if (goods_id > 0) {
            if (typeof goods_list[goods_id] === "undefined") {
                var ajaxurl = CHAT_SITE_URL + '/web_chat/get_goods_info&goods_id=' + goods_id;
                $.ajax({
                    type: "GET",
                    url: ajaxurl,
                    dataType: "jsonp",
                    async: true,
                    success: function (goods) {
                        if (typeof goods['goods_id'] !== "undefined") {
                            goods_id = goods['goods_id'];
                            msg['goods_id'] = goods_id;
                            msg['goods_info'] = goods;
                            show_msg_goods(msg);
                            if (typeof goods_list[goods_id] === "undefined") {
                                goods_list[goods_id] = goods;
                            }
                        }
                    }
                });
            } else {
                msg['goods_id'] = goods_id;
                msg['goods_info'] = goods_list[goods_id];
                show_msg_goods(msg);
            }
        }
    } else {
        show_msg_goods(msg);
    }
}
function get_goods_list(s_id) {
    if (layout == 'seller_layout' || act_op == 'goods_index') {//商家中心不显示推荐商品
        return;
    }
    if (typeof store_goods[s_id] !== "undefined") {
        $("#chat_goods_list").html(store_goods[s_id]);
        $("#chat_goods_list").show();
        return;
    }
    var ajaxurl = CHAT_SITE_URL + '/web_chat/get_goods_list&s_id=' + s_id;
    $.ajax({
        type: "GET",
        url: ajaxurl,
        dataType: "jsonp",
        async: true,
        success: function (list) {
            var text_append = '<div class="title">医生推荐</div><div class="content"><ul>';
            for (var k in list) {
                var goods = list[k];
                var text_goods = '<li>';
                text_goods += '<div class="goods-pic"><a href="' + goods['url'] + '" target="_blank">';
                text_goods += '<img title="' + goods['goods_name'] + '" alt="' + goods['goods_name'] + '" src="' + goods['pic'] + '"/></a></div>';
                text_goods += '<div class="goods-price">&yen;' + goods['goods_promotion_price'] + '</div>';
                text_goods += '</li>';
                text_append += text_goods;
            }
            text_append += '</ul></div>';
            store_goods[s_id] = text_append;
            get_goods_list(s_id);
        }
    });
}
function update_msg(u_id) {//更新已读
    var u_name = user_list[u_id]['u_name'];
    user_list[u_id]['new_msg'] = 0;
    alert_user_msg(u_id);
    new_msg--;
    alert_msg();
}
function store_chat(u_id, c_name) {//医生客服对话窗口
    set_user_info(u_id, "c_name", c_name);//设置客服别名
    chat(u_id);
}
function check_chat_card(u_id) {
    if (user['u_id'] == '') {//未登录时弹出登录窗口
        $("#chat_login").trigger("click");
        return;
    }
    if (u_id == user['u_id']) {
        tip_chat_with_self(u_id);
        return;
    }
    if (user_list[u_id]['online'] <= 0) {
        showError('对方不在线，请稍后再联系');
        return;
    }
    if (u_id == 1 || user['u_id'] == 1) {
        chat(u_id);
        return;
    }
    var chat_card = $.cookie('chat_time_' + u_id + '_' + user['u_id']);
    var now = new Date().getTime();
    if (typeof chat_card != "undefined" && (chat_card.split('_'))[1] - now > 0) {
        chat(u_id);
        return;
    } else {
        chat_card = [];
        for (var i = 0; i < member_chat_card.length; i++) {
            if (member_chat_card[i]['member_id'] == user['u_id'] && member_chat_card[i]['doctor_id'] == u_id && member_chat_card[i]['is_use'] == 0 && member_chat_card[i]['how_lang_time'] > 0) {
                chat_card.push(member_chat_card[i]);
            }
        }
        if (chat_card.length == 0) {
            ajax_form('member_chat_card_list', '没有可以使用的聊天卡', '/chat/web_chat/member_chat_card_list?member_id=' + user['u_id'] + '&doctor_id=' + u_id, '640');
        } else {
            ajax_form('member_chat_card_list', '选择要使用的聊天卡', '/chat/web_chat/member_chat_card_list?member_id=' + user['u_id'] + '&doctor_id=' + u_id, '640');
        }
    }
}

function chat(u_id) {//打开对话窗口
    if (user['u_id'] == '') {//未登录时弹出登录窗口
        $("#chat_login").trigger("click");
        return;
    }
    if (u_id == user['u_id']) return;

    //判断是否自己设置了离线
    var is_set_chat_offline = $.cookie('is_set_chat_offline');
    if (typeof is_set_chat_offline != "undefined" && is_set_chat_offline != null && is_set_chat_offline == 1) { //医生设置了聊天为不在线状态
        showDialog('你现在处于离线状态,是否到个人中心设置聊天为在线状态?', 'confirm', '', function () {
            $.cookie('is_set_chat_offline', null, {
                expires: -1, //单位是天
                path: '/'
            });
            $('#web_chat_dialog .chat-box').find('#set_my_online_state').html('设为离线');
            if (connect === 0) {
                getconnect();
            }
        }, true, null, '', '设为在线状态', '取消');
        return false;
    }

    if (typeof user_list[u_id] === "undefined" || typeof user_list[u_id]['avatar'] === "undefined") {
        var ajaxurl = CHAT_SITE_URL + '/web_chat/get_info&t=member&u_id=' + u_id;
        $.ajax({
            type: "GET",
            url: ajaxurl,
            dataType: "jsonp",
            async: false,
            success: function (member) {
                var u_name = member['member_name'];
                if (typeof u_name === "undefined" || u_name == '') return false;
                set_user_info(u_id, "u_name", u_name);
                set_user_info(u_id, "s_id", member['store_id']);
                set_user_info(u_id, "s_name", member['store_name']);
                set_user_info(u_id, "avatar", member['member_avatar']);
                set_user_info(u_id, "s_avatar", member['store_avatar']);
            }
        });
    }
    update_user(u_id);
    show_msg(u_id);
    show_obj();
}

function update_chat_time() {
    if (user_show != 1 && user['u_id'] != 1) {
        var chat_time_interval = setInterval(function () {
            var chat_card = ($.cookie('chat_time_' + user_show + '_' + user['u_id']));
            var now = new Date().getTime();
            if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
                $.cookie('chat_time_' + user_show + '_' + user['u_id'], null, {
                    expires: -1, //单位是天
                    path: '/'
                });
                obj.find('#chat_time').html(0);
                clearInterval(chat_time_interval);
                chat_time_interval = null;
                send_buy_chat_card_msg(false);
                //如果没有启动聊天卡，删除退款和评价按钮
                if (obj.find("#order_vrrefund").length > 0) {
                    obj.find("#order_vrrefund").remove();
                }
                if (obj.find("#order_evaluate").length > 0) {
                    obj.find("#order_evaluate").remove();
                }

            } else {
                var left_time = (chat_card.split('_'))[1] - now;
                obj.find('#chat_time').html(formatSeconds(left_time));
                //如果启动聊天卡，当聊天卡类型是医生端聊天卡时，删除退款和评价按钮
                var card_type = (chat_card.split('_'))[2]; //0是客户 1是医生
                if (card_type == 0) { //如果是客户
                    var is_evaluate = (chat_card.split('_'))[5]; //0是未评价或者退款 1是已评价或者退款
                    if (is_evaluate == 0) { //如果未对该聊天卡进行评价或者退款
                        if (obj.find("#order_vrrefund").length == 0) {
                            obj.find(".msg-input-title").append(order_vrrefund_html);
                        }
                        if (obj.find("#order_evaluate").length == 0) {
                            obj.find(".msg-input-title").append(order_evaluate_html);
                        }
                    } else {
                        if (obj.find("#order_vrrefund").length > 0) {
                            obj.find("#order_vrrefund").remove();
                        }
                        if (obj.find("#order_evaluate").length > 0) {
                            obj.find("#order_evaluate").remove();
                        }
                    }

                } else { //如果是医生
                    if (obj.find("#order_vrrefund").length > 0) {
                        obj.find("#order_vrrefund").remove();
                    }
                    if (obj.find("#order_evaluate").length > 0) {
                        obj.find("#order_evaluate").remove();
                    }
                }
            }
        }, 1000);
    } else {
        obj.find('#chat_time').parent().hide();
    }
}
//投诉
function order_vrrefund2() {
    var chat_card = $.cookie('chat_time_' + user_show + '_' + user['u_id']);
    var order_id = (chat_card.split('_'))[3];
    window.location.href = '/shop/member_vrrefund/add_tousu?order_id=' + order_id;
}
function order_vrrefund() {
    showDialog('发起退款申请后，该张聊天卡将作废，终止本次咨询，是否继续？', 'confirm', '', function () {
        var chat_card = $.cookie('chat_time_' + user_show + '_' + user['u_id']);
        var now = new Date().getTime();
        if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
            showError('退款失败');
        } else {
            var order_id = (chat_card.split('_'))[3];
            //删除cookie
            $.cookie('chat_time_' + user_show + '_' + user['u_id'], null, {
                expires: -1, //单位是天
                path: '/'
            });
            window.location.href = '/shop/member_vrorder/show_order?order_id=' + order_id;
        }
    }, true, null, '', '确定', '取消');
}

function order_evaluate() {
    var chat_card = $.cookie('chat_time_' + user_show + '_' + user['u_id']);
    var now = new Date().getTime();
    if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
        showError('评价失败');
    } else {
        var vr_code = (chat_card.split('_'))[4];
        //模拟发送兑换码的兑换请求
        showDialog('是否向医生发送虚拟兑换码：' + vr_code + '？', 'confirm', '', function () {
            $.getJSON('/shop/member/exchange?form_submit=ok&vr_code=' + vr_code, null, function (data) {
                    if (data == null) {
                        showError('评价失败');
                        return false;
                    }
                    if (data.error > 0) {
                        //showError(data.error);
                        showError('已经评价过了');
                        return false;
                    }
                    //设置该聊天卡评价状态为已评价
                    $.cookie('chat_time_' + user_show + '_' + user['u_id'], (chat_card.split('_'))[0] + '_' + (chat_card.split('_'))[1] + '_' + (chat_card.split('_'))[2] + '_' + (chat_card.split('_'))[3] + '_' + (chat_card.split('_'))[4] + '_1', {
                        expires: 1, //单位是天
                        path: '/'
                    });
                    var order_id = (chat_card.split('_'))[3];
                    window.location.href = '/shop/member_vrorder/show_order?order_id=' + order_id;
                }
            );
        }, true, null, '', '发送并评价', '取消');
    }
}

function set_my_online_state() {
    var is_set_chat_offline = $.cookie('is_set_chat_offline');
    if (typeof is_set_chat_offline != "undefined" && is_set_chat_offline != null && is_set_chat_offline == 1) { //医生设置了聊天为不在线状态
        $.cookie('is_set_chat_offline', null, {
            expires: -1, //单位是天
            path: '/'
        });
        $('#web_chat_dialog .chat-box').find('#set_my_online_state').html('设为离线');
    } else {
        $.cookie('is_set_chat_offline', 1, {
            expires: 7, //单位是天
            path: '/'
        });
        $('#web_chat_dialog .chat-box').find('#set_my_online_state').html('设为在线');
    }
    getconnect();
}

function send_buy_chat_card_msg(is_play_audio, msg) {
    if (typeof is_play_audio === 'undefined') {
        is_play_audio = true;
    }
    if (typeof msg === "undefined") {
        msg = '请&nbsp;<a style="color: #00D800;" href="JavaScript:check_chat_card(' + user_show + ');">选择聊天卡</a>';
    }
    if (user_list[user_show]['online'] <= 0) {
        msg = '对方不在线，请稍后再联系';
    }
    var msgData = [];
    msgData['f_id'] = user_show;
    msgData['add_time'] = getCurrTime();
    msgData['t_msg'] = msg;
    show_f_msg(msgData);
    if (is_play_audio) {
        play_audio();
    }
}

function getCurrTime() {
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hour = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
    var minute = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
    var second = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
    return year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
}

function show_dialog() {//显示窗口
    update_dialog();
    show_obj();
}
function update_dialog() {//显示会员的对话
    if (new_msg < 1) return true;
    var select_user = 0;
    for (var u_id in user_list) {
        if (user_list[u_id]['new_msg'] > 0) {
            update_user(u_id);
            obj.find("em[unread_id='" + u_id + "']").addClass("unread");
            obj.find("em[unread_id='" + u_id + "']").html(user_list[u_id]['new_msg']);
        }
    }
    select_user = obj.find(".unread").first().attr("unread_id");
    if (select_user > 0) show_msg(select_user);
}
function show_chat_log() {
    if (user_show < 1) {
        $("#send_alert").html('未选择聊天会员');
        return false;
    }
    if (typeof chat_log['u_id'] === "undefined" || chat_log['u_id'] != user_show) {
        $("#web_chat_dialog").hide();
        obj.find(".chat-log-btn").removeClass("off");
        obj.find(".chat-log-btn").addClass("on");
        get_chat_log(7);
    } else {
        close_chat_log(user_show);
    }
}
function show_msg(u_id) {//显示会员的消息
    var user_info = user_list[u_id];
    var u_name = user_info['u_name'];
    if (obj.find("div[select_user_msg='" + u_id + "']").size() == 0) {
        obj.find("#user_msg_list").prepend('<div class="msg_list" select_user_msg="' + u_id + '"></div>');
    }
    obj.find(".msg_list").hide();
    obj.find("div[select_user_msg='" + u_id + "']").show();
    obj.find("li[select_u_id]").removeClass("select_user");
    obj.find("li[select_u_id='" + u_id + "']").addClass("select_user");
    if (user_show != u_id) {
        close_chat_log(user_show);
        $("#chat_user_avatar").attr("src", user_info['avatar']);
        $("#chat_goods_list").hide();
        var add_html = '';
        var store_html = '';
        if (typeof user_info['c_name'] !== "undefined") add_html = '--' + user_info['c_name'];
        if (typeof user_info['s_name'] !== "undefined" && user_info['s_name'] !== "") {
            get_goods_list(user_info['s_id']);//异步调用医生推荐的商品
            $("#chat_user_avatar").attr("src", user_info['s_avatar']);
            store_html = '<a target="_blank" href="' + SHOP_SITE_URL + '/show_store/index&store_id=' +
                user_info['s_id'] + '">' + user_info['s_name'] + '</a>';
            u_name = '客服：' + u_name;
        }
        var online_html = '<i class="offline" title="离线"></i>';
        if (user_info['online'] > 0) {
            online_html = '<i class="online" title="在线"></i>';
        }
        $("#chat_user_name").html(u_name + add_html + online_html);
        $("#chat_user_store").html(store_html);
        obj.find('#msg_list').perfectScrollbar('destroy');
        obj.find('#msg_list').perfectScrollbar();
    }
    if (layout == 'seller_layout') {
        store_goods_info(u_id);
    }
    user_show = u_id;
    var max_id = 0;
    for (var m_id in msg_list[u_id]) {
        if (obj.find("div[m_id='" + m_id + "']").size() == 0) {
            var msg = msg_list[u_id][m_id];
            show_f_msg(msg);
            update_msg(u_id);
            delete msg_list[u_id][m_id];//删除消息
            if (m_id > max_id) max_id = m_id;
        }
    }
    var obj_msg = obj.find("div[select_user_msg='" + u_id + "']");
    setTimeout(function () {
        obj.find("#msg_list").scrollTop(obj_msg.height());
    }, 300);
    $("#send_message").focus();
    if (max_id > 0 && connect === 1) socket.emit('del_msg', {'max_id': max_id, 'f_id': u_id});
}

function show_f_msg(msg) {//显示收到的消息
    var u_id = msg['f_id'];
    var user_info = user_list[u_id];
    var text_append = '';
    var obj_msg = obj.find("div[select_user_msg='" + u_id + "']");
    text_append += '<div class="from_msg" m_id="' + msg['m_id'] + '">';
    text_append += '<span class="user-avatar"><img src="' + user_info['avatar'] + '"></span>';
    text_append += '<dl><dt class="from-msg-time">';
    text_append += msg['add_time'] + '</dt>';
    text_append += '<dd class="from-msg-text">';
    text_append += update_chat_msg(msg['t_msg']) + '</dd>';
    text_append += '<dd class="arrow"></dd>';
    text_append += '</dl>';
    text_append += '</div>';
    obj_msg.append(text_append);
    get_goods_info(msg);
    var n = obj_msg.find("div[m_id]").size();
    if (n >= msg_max && n % msg_max == 1) {
        obj_msg.append('<div clear_id="' + msg['m_id'] + '" onclick="clear_msg(' + u_id + ',' + msg['m_id'] +
            ');" class="clear_msg"><a href="Javascript: void(0);">清除已上历史消息</a></div>');
    }
    setTimeout(function () {
        obj.find("#msg_list").scrollTop(obj_msg.height());
    }, 300);

    var chat_card = $.cookie('chat_time_' + doctor_id + '_' + user['u_id']);
    var now = new Date().getTime();
    if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
        $.cookie('chat_time_' + doctor_id + '_' + user['u_id'], null, {
            expires: -1, //单位是天
            path: '/'
        });
        //会员消息显示完需要检查下该人是否有与发送消息的人有聊天卡
        if (user_show != 1 && user['u_id'] != 1) {
            check_doctor_reply_card(user['u_id'], u_id, msg['chat_card_id']);
        }
    }
}

function check_doctor_reply_card(member_id, doctor_id, chat_card_id) {
    var chat_card = $.cookie('chat_time_' + doctor_id + '_' + user['u_id']);
    var now = new Date().getTime();
    if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
        $.cookie('chat_time_' + doctor_id + '_' + user['u_id'], null, {
            expires: -1, //单位是天
            path: '/'
        });
        //没有聊天卡，看有没有回复卡
        $.ajax({
            url: '/chat/web_chat/doctor_chat_card_list',
            type: 'POST', //GET
            async: false,    //同步
            dataType: 'json',
            data: {
                member_id: member_id,
                doctor_id: doctor_id,
                chat_card_id: chat_card_id
            },
            success: function (data) {
                if (data.status == 1) {
                    var doctor_card = data.doctor_card;
                    var end_time = new Date().getTime() + parseInt(doctor_card['how_lang_time']) * 1000;
                    //服务结束时间
                    var chat_card_end_time = parseInt(doctor_card['chat_card_end_time']) * 1000;
                    if (end_time > chat_card_end_time) {
                        end_time = chat_card_end_time;
                    }
                    if (end_time <= new Date().getTime()) {
                        send_buy_chat_card_msg(false, '服务时间已经结束');
                        return false;
                    }
                    var is_evaluate = 1; //是否对该聊天卡已进行评价
                    $.cookie('chat_time_' + doctor_card['doctor_id'] + '_' + user['u_id'], doctor_card['id'] + '_' + end_time + '_' + doctor_card['card_type'] + '_' + doctor_card['order_id'] + '_' + doctor_card['exchange_code'] + '_' + is_evaluate, {
                        expires: 1, //单位是天
                        path: '/'
                    }); //单位是秒，不是毫秒
                    chat(doctor_card['doctor_id']);
                }
            }
        });
    }
}

function show_t_msg(msg) {//显示发出的消息
    var user_info = user;
    var u_id = msg['t_id'];
    var text_append = '';
    var obj_msg = obj.find("div[select_user_msg='" + u_id + "']");
    text_append += '<div class="to_msg" m_id="' + msg['m_id'] + '">';
    text_append += '<span class="user-avatar"><img src="' + user_info['avatar'] + '"></span>';
    text_append += '<dl><dt class="to-msg-time">';
    text_append += msg['add_time'] + '</dt>';
    text_append += '<dd class="to-msg-text">';
    text_append += update_chat_msg(msg['t_msg']) + '</dd>';
    text_append += '<dd class="arrow"></dd>';
    text_append += '</dl>';
    text_append += '</div>';
    obj_msg.append(text_append);
    get_goods_info(msg);
    var n = obj_msg.find("div[m_id]").size();
    if (n >= msg_max && n % msg_max == 1) {
        obj_msg.append('<div clear_id="' + msg['m_id'] + '" onclick="clear_msg(' + u_id + ',' + msg['m_id'] +
            ');" class="clear_msg"><a href="Javascript: void(0);">清除已上历史消息</a></div>');
    }
    setTimeout(function () {
        obj.find("#msg_list").scrollTop(obj_msg.height());
    }, 300);
}
function show_chat_msg(now_page) {
    var log_list = chat_log['list'][now_page];
    $('#chat_log_msg').html('');
    for (var k in log_list) {
        var class_html = '';
        var text_append = '';
        var msg = log_list[k];
        msg['u_name'] = msg['f_name'];
        if (msg['u_name'] == user['u_name']) {
            msg['u_name'] = '我';
            class_html = 'chat_user';
        }
        text_append += '<div class="chat_msg ' + class_html + '" m_id="' + msg['m_id'] + '">';
        text_append += '<p class="user-log"><span class="user-name">' + msg['u_name'] + '</span>';
        text_append += '<span class="user-time">' + msg['time'] + '</span></p>';
        text_append += '<p class="user-msg">' + update_chat_msg(msg['t_msg']) + '</p>';
        text_append += '</div>';
        $('#chat_log_msg').prepend(text_append);
    }
    $('#chat_log_list').perfectScrollbar('destroy');
    $('#chat_log_list').perfectScrollbar();
    setTimeout(function () {
        $('#chat_log_list').scrollTop($('#chat_log_msg').height());
    }, 300);
}
function show_msg_goods(msg) {
    var m_id = msg['m_id'];
    var goods_id = msg['goods_id'];
    if (goods_id != '' && goods_id > 0) {
        var goods = msg['goods_info'];
        var text_append = '';
        text_append += '<div class="goods_info">';
        text_append += '<div class="goods_name"><a class="goods_pic" target="_blank" href="' + goods['url'] + '">';
        text_append += goods['goods_name'] + '</a></div>';
        text_append += '<div class="goods_price">&yen;' + goods['goods_promotion_price'] + '</div>';
        text_append += '<div class="goods_pic"><a target="_blank" href="' + goods['url'] + '">';
        text_append += '<img width="60" height="60" src="' + goods['pic'] + '"></a></div></div>';
        obj.find("div.msg_list div[m_id='" + m_id + "'] dd[class$='-msg-text']").append(text_append);
    }
}
function chat_show_user_list(chat_show) {
    var obj_chat = $("#chat_user_" + chat_show);
    if (obj_chat.find("dt span").attr("class") == 'hide') {
        obj_chat.find("dd[u_id]").show();
        obj_chat.find("dt span").attr("class", "show");
    } else {
        obj_chat.find("dd[u_id]").hide();
        obj_chat.find("dt span").attr("class", "hide");
    }
}
function chat_show_list() {
    if (user['u_id'] == '') {
        return;
    }
    var obj_chat = $(".chat-list");
    if (new_msg > 0 || obj_chat.css("display") == 'none') {
        obj_chat.show("slide", {direction: 'right'}, 300);
        if (new_msg > 0) show_dialog();
        var is_set_chat_offline = $.cookie('is_set_chat_offline');
        if (typeof is_set_chat_offline != "undefined" && is_set_chat_offline != null && is_set_chat_offline == 1) { //医生设置了聊天为不在线状态
            $('#web_chat_dialog .chat-box').find('#set_my_online_state').html('设为在线');
        } else {
            $('#web_chat_dialog .chat-box').find('#set_my_online_state').html('设为离线');
        }
    } else {
        obj_chat.hide("slide", {direction: 'right'}, 300);
    }

}
function del_msg(msg) {//已读消息处理
    var max_id = msg['max_id'];//最大的消息编号
    var u_id = msg['f_id'];//消息发送人
    for (var m_id in msg_list[u_id]) {
        if (max_id >= m_id) {
            delete msg_list[u_id][m_id];
            if (user_list[u_id]['new_msg'] > 0) user_list[u_id]['new_msg']--;
            if (new_msg > 0) new_msg--;
            alert_user_msg(u_id);
        }
    }
    alert_msg();
}
function alert_user_msg(u_id) {
    if (user_list[u_id]['new_msg'] > 0) {
        obj.find("em[unread_id='" + u_id + "']").addClass("unread");
        obj.find("em[unread_id='" + u_id + "']").html(user_list[u_id]['new_msg']);
        $("#chat_user_recent dd[u_id='" + u_id + "'] a").addClass("msg");
    } else {
        obj.find("em[unread_id='" + u_id + "']").html("");
        obj.find("em[unread_id='" + u_id + "']").removeClass("unread");
        $("#chat_user_recent dd[u_id='" + u_id + "'] a").removeClass("msg");
    }
}
function alert_msg() {
    var new_n = 0;
    clearInterval(new_interval);
    new_interval = null;
    if (new_msg > 0) {//消息提醒
        new_interval = setInterval(function () {
            new_n++;
            if (connect === 1) $(document).attr('title', '新消息(' + new_msg + ')    ' + web_info['html_title']);
            if (new_n % 3 > 1) $(document).attr('title', web_info['html_title']);
        }, 500);
        $("#new_msg").show().html(new_msg);
        play_audio();
    } else {
        new_msg = 0;
        $("#new_msg").hide().html('');
    }
    $(document).attr('title', web_info['html_title']);
}
function get_chat(u_id, online) {//显示链接地址
    var add_html = '<a class="chat chat_online" title="在线联系(不能和自己聊天哦)" href="JavaScript:tip_chat_with_self(' + u_id + ');">在线</a>';
    //不能和自己聊天
    if (u_id != user['u_id'] && u_id > 0) {
        var class_html = 'chat_offline';
        var text_html = '离线';
        var fn = 'tip_chat_offline';
        if (online > 0) {
            class_html = 'chat_online';
            text_html = '在线';
            fn = 'check_chat_card';
        }
        add_html = '<a class="chat ' + class_html + '" title="在线联系" href="JavaScript:' + fn + '(' + u_id + ');">' + text_html + '</a>';
    }
    return add_html;
}

function clear_msg(u_id, m_id) {//清除消息处理
    var obj_msg = obj.find("div[select_user_msg='" + u_id + "']");
    obj_msg.find("div[clear_id='" + m_id + "']").prevAll().remove();
    obj_msg.find("div[clear_id='" + m_id + "']").remove();
}

function tip_chat_with_self(u_id) { //提示用户不能和自己聊天
    showError('不能和自己聊天哦');
}

function tip_chat_offline(u_id) { //提示医生不在线，
    chat(u_id);
    //showError('对方不在线，请稍后再联系');
}

function play_audio() {//提示声音
    if (chat_audio === 1) {
        var currentTime = Date.now();
        if ((currentTime - lastRunTime) < protectTime) {
            return;//两次执行太过频繁，直接退出
        }
        if (currentAudio == null) {
            //警告：一定要用document.getElementById得到currentAudio，不要用jquery获取后再把jquery对象转化为js对象，不然在苹果手机浏览器中不会播放声音
            currentAudio = document.getElementById("msg_tip_audio");
        }

        if (audio_playing) {
            audio_playing = false;
            currentAudio.pause();
            currentAudio.currentTime = 0;
        }
        audio_playing = true;
        try {
            lastRunTime = Date.now();
            currentAudio.play(); //开始播放，可能需要三四秒才能播放完，所以下面不能立马把audio_playing设置为false
        } catch (e) {
        }
    }
}

function set_user_list(list) {//初始化会员列表
    for (var k in list) {
        var user_info = list[k];
        var u_id = user_info['u_id'];
        var u_name = user_info['u_name'];
        var online = 0;
        if (user_info['online'] > 0) online = 1;
        set_user_info(u_id, "u_name", u_name);
        set_user_info(u_id, "s_id", user_info['s_id']);
        set_user_info(u_id, "s_name", user_info['s_name']);
        set_user_info(u_id, "avatar", user_info['avatar']);
        set_user_info(u_id, "s_avatar", user_info['s_avatar']);
        set_user_info(u_id, "online", online);
    }
}
function set_user(u_id, u_name) {//初始化会员信息
    var user_info = new Array();
    user_info['u_id'] = u_id;
    user_info['u_name'] = u_name;
    user_info['new_msg'] = 0;
    user_info['online'] = 0;
    if (typeof user_list[u_id] === "undefined") user_list[u_id] = user_info;
    if (typeof msg_list[u_id] === "undefined") msg_list[u_id] = new Array();
}
function set_user_info(u_id, k, v) {//设置会员信息
    if (typeof user_list[u_id] === "undefined") set_user(u_id, '');
    user_list[u_id][k] = v;
}
function close_chat_log(u_id) {
    if (user_show == 0 || chat_log['u_id'] == u_id) {
        chat_log = {};
        $("#dialog_chat_log").hide();
        $('#chat_log_msg').html('');
        obj.find(".chat-log-btn").removeClass("on");
        obj.find(".chat-log-btn").addClass("off");
        if (connect === 1) $("#web_chat_dialog").show();
    }
}
function close_dialog(u_id) {
    obj.find("li[select_u_id='" + u_id + "']").remove();
    obj.find("div[select_user_msg='" + u_id + "']").hide();
    if (obj.find("li[select_u_id]").size() == 0) {
        msg_dialog_close('new_msg_dialog');
    } else {
        if (user_show == u_id) obj.find("li[select_u_id]").first().trigger("click");
    }
    if (user_show == u_id) {
        user_show = 0;
        close_chat_log(u_id);
    }
    if (obj.find("li[select_u_id]").size() < 2) obj.find(".user-tab-bar").hide();
}
function update_chat_msg(msg) {
    if (typeof smilies_array !== "undefined") {
        msg = '' + msg;
        for (var i in smilies_array[1]) {
            var s = smilies_array[1][i];
            var re = new RegExp("" + s[1], "g");
            var smilieimg = '<img width="28" height="28" title="' + s[6] + '" alt="' + s[6] + '" src="' + RESOURCE_SITE_URL + '/js/smilies/images/' + s[2] + '">';
            msg = msg.replace(re, smilieimg);
        }
    }
    return msg;
}
function update_friends() {
    var obj_friend = $("#chat_friends");
    for (var u_id in friend_list) {
        if (obj_friend.parent().find("dd[u_id='" + u_id + "']").size() > 0) {
            obj_friend.parent().find("dd[u_id='" + u_id + "']").remove();
        }
        if (user_list[u_id]['online'] > 0) {
            obj_friend.before('<dd u_id="' + u_id + '" onclick="chat(' + u_id + ');"><span class="user-avatar"><img alt="' + user_list[u_id]['u_name']
                + '" src="' + user_list[u_id]['avatar'] + '"><i class="online"></i></span><h5>' + user_list[u_id]['u_name'] + '</h5><a href="javascript:void(0)"></a></dd>');
        } else {
            obj_friend.after('<dd u_id="' + u_id + '" onclick="tip_chat_offline(' + u_id + ');"><span class="user-avatar"><img alt="' + user_list[u_id]['u_name']
                + '" src="' + user_list[u_id]['avatar'] + '"><i class="offline"></i></span><h5>' + user_list[u_id]['u_name'] + '</h5><a href="javascript:void(0)"></a></dd>');
        }
    }
    obj_friend.remove();
    chat_show_user_list('friends');
}
function update_recent() {
    var obj_recent = $("#chat_recent");
    for (var u_id in recent_list) {
        if (obj_recent.parent().find("dd[u_id='" + u_id + "']").size() > 0) {
            obj_recent.parent().find("dd[u_id='" + u_id + "']").remove();
        }
        if (user_list[u_id]['online'] > 0) {
            obj_recent.before('<dd u_id="' + u_id + '" title="最后对话:' + recent_list[u_id]['time'] + '" onclick="chat(' + u_id + ');"><span class="user-avatar"><img alt="' + user_list[u_id]['u_name']
                + '" src="' + user_list[u_id]['avatar'] + '"><i class="online"></i></span><h5>' + user_list[u_id]['u_name'] + '</h5><a href="javascript:void(0)"></a></dd>');
        } else {
            obj_recent.after('<dd u_id="' + u_id + '" title="最后对话:' + recent_list[u_id]['time'] + '" onclick="tip_chat_offline(' + u_id + ');"><span class="user-avatar"><img alt="' + user_list[u_id]['u_name']
                + '" src="' + user_list[u_id]['avatar'] + '"><i class="offline"></i></span><h5>' + user_list[u_id]['u_name'] + '</h5><a href="javascript:void(0)"></a></dd>');
        }
    }
    //obj_recent.remove();
}
function update_user(u_id) {
    if ($("#dialog_chat_right").html() == '') {
        var text_append = '<span class="dialog-close" onclick="msg_dialog_close(\'new_msg_dialog\');">&nbsp;</span>';
        text_append += '<div class="user-info">';
        text_append += '<div class="user-avatar">';
        text_append += '<img id="chat_user_avatar" src=""></div>';
        text_append += '<div id="chat_user_store" class="store-name"></div>';
        text_append += '<div id="chat_user_name" class="user-name"></div>';
        text_append += '</div>';
        if (layout != 'seller_layout' && act_op != 'goods_index') {//商家中心页面和商品详细页面不显示推荐商品
            text_append += '<div id="chat_goods_list" class="goods-list"></div>';
        }
        $("#dialog_chat_right").append(text_append + web_info['chat_goods_html']);
    }
    if (obj.find("li[select_u_id='" + u_id + "']").size() > 0) {
        obj.find("li[select_u_id='" + u_id + "']").remove();
    }
    var user_info = user_list[u_id];
    var u_name = user_info['u_name'];
    var text_append = '';
    var class_html = 'offline';
    if (user_info['online'] > 0) class_html = 'online';
    text_append += '<li class="user" select_u_id="' + u_id + '" onclick="show_msg(' + u_id + ');">';
    text_append += '<i class="' + class_html + '"></i>';
    text_append += '<span class="user-avatar avatar-' + user_info['online'] + '" title="' + u_name + '"><img alt="' + u_name + '" src="' + user_info['avatar'] + '"></span>';
    text_append += '<span class="user-name" title="' + u_name + '">';
    text_append += u_name + '<em></em></span>';
    text_append += '<em unread_id="' + u_id + '" class=""></em>';
    text_append += '<a class="ac-ico"></a>';
    text_append += '</li>';
    obj.find("#user_list").append(text_append);
    obj.find("#user_list").sortable({items: 'li'});
    obj.find("li[select_u_id='" + u_id + "'] .ac-ico").bind("click", function () {
        close_dialog(u_id);
        return false;
    });
    if (obj.find("li[select_u_id]").size() > 1) obj.find(".user-tab-bar").show();
    obj.find(".user-tab-bar").perfectScrollbar();
}
function getconnect() {
    $.getScript(connect_url + "/socket.io/socket.io.js", function () {
        clearInterval(interval);
        interval = null;
        if (typeof io === "function") {
            socket = io(connect_url, {'path': '/socket.io', 'reconnection': false});
            socket.on('connect', function () {
                connect = 1;
                send_state();
                socket.on('get_state', function (u_list) {
                    get_state(u_list);
                });
                setInterval(function () {
                    send_state();
                }, 3000);
                if (user['u_id'] == '') return false;//未登录时不取消息

                $("#web_chat_dialog").show();
                if ($("#new_msg_dialog").size() == 0) $("#web_chat_dialog").after(web_info['msg_dialog']);
                obj = $("#new_msg_dialog");
                socket.emit('update_user', user);
                socket.on('get_msg', function (msg_list) {
                    get_msg(msg_list);
                });
                socket.on('del_msg', function (msg) {
                    del_msg(msg);
                });
                socket.on('disconnect', function () {
                    connect = 0;
                    //$("#web_chat_dialog").hide();
                    interval = setInterval(getconnect, 60000);//断开1分钟后重新连接服务器
                });

                //判断是否自己设置了离线
                var is_set_chat_offline = $.cookie('is_set_chat_offline');
                if (typeof is_set_chat_offline != "undefined" && is_set_chat_offline != null && is_set_chat_offline == 1) { //医生设置了聊天为不在线状态
                    //socket.disconnect();
                    socket.emit('set_offline');
                }
            });
        }
    });
}

/**
 * 将毫秒数转化为时分秒
 * @param value
 * @returns {string}
 */
function formatSeconds(value) {
    // 秒
    var theTime = parseInt(value / 1000);
    // 分
    var theTime1 = 0;
    // 小时
    var theTime2 = 0;
    // alert(theTime);
    if (theTime > 60) {
        theTime1 = parseInt(theTime / 60);
        theTime = parseInt(theTime % 60);
        // alert(theTime1+"-"+theTime);
        if (theTime1 > 60) {
            theTime2 = parseInt(theTime1 / 60);
            theTime1 = parseInt(theTime1 % 60);
        }
    }
    var result = "" + parseInt(theTime) + "秒";
    if (theTime1 > 0) {
        result = "" + parseInt(theTime1) + "分" + result;
    }
    if (theTime2 > 0) {
        result = "" + parseInt(theTime2) + "小时" + result;
    }
    return result;
}

function uploadChange() {
    var filepath = $(this).val();
    var extStart = filepath.lastIndexOf(".");
    var ext = filepath.substring(extStart, filepath.length).toUpperCase();
    if (ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
        showError('图片类型错误，请选择png、gif、jpg等格式');
        $(this).attr('value', '');
        return false;
    }
    if ($(this).val() == '') return false;
    if (user['u_id'] == '') {
        showError('请登录后再发送图片消息');
    }
    ajaxFileUpload();
}

function ajaxFileUpload() {
    $jq.ajaxFileUpload({
        url: '/shop/member/pic_upload?form_submit=ok&uploadpath=chat_image/' + user['u_id'],
        secureuri: false,
        fileElementId: '_pic',
        dataType: 'json',
        success: function (data, status) {
            if (data.status == 1) {
                $("#send_message").val('<img src="' + data.url + '">');
            } else {
                showError(data.msg);
            }
            obj.find('input[class="type-file-file"]').bind('change', uploadChange);
        },
        error: function (data, status, e) {
            showError('图片发送失败');
            obj.find('input[class="type-file-file"]').bind('change', uploadChange);
        }
    })
}