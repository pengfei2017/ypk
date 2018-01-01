if (getQueryString('key') != '') {
    var key = getQueryString('key');
} else {
    var key = getCookie('key');
}
var chat_audio = 1;//消息提醒声音开关
var audio_playing = false; //是否正在播放声音
var currentAudio = null; //当前播放的是那一首提示声音
var lastRunTime = Date.now(); //最后一次播放提示音的时间
var protectTime = 100;//设置保护性延时 单位毫秒，不要小于50 建议100以上

var nodeSiteUrl = '';
var memberInfo = {};
var userInfo = {}; //要咨询的医生
var userChatCard = []; //购买的该医生的所有可用的聊天卡

var resourceSiteUrl = '';
var user_state_list = new Array();//所有会员在线状态信息
var smilies_array = new Array();

smilies_array[1] = [['1', ':smile:', 'smile.gif', '28', '28', '28', '微笑'], ['2', ':sad:', 'sad.gif', '28', '28', '28', '难过'], ['3', ':biggrin:', 'biggrin.gif', '28', '28', '28', '呲牙'], ['4', ':cry:', 'cry.gif', '28', '28', '28', '大哭'], ['5', ':huffy:', 'huffy.gif', '28', '28', '28', '发怒'], ['6', ':shocked:', 'shocked.gif', '28', '28', '28', '惊讶'], ['7', ':tongue:', 'tongue.gif', '28', '28', '28', '调皮'], ['8', ':shy:', 'shy.gif', '28', '28', '28', '害羞'], ['9', ':titter:', 'titter.gif', '28', '28', '28', '偷笑'], ['10', ':sweat:', 'sweat.gif', '28', '28', '28', '流汗'], ['11', ':mad:', 'mad.gif', '28', '28', '28', '抓狂'], ['12', ':lol:', 'lol.gif', '28', '28', '28', '阴险'], ['13', ':loveliness:', 'loveliness.gif', '28', '28', '28', '可爱'], ['14', ':funk:', 'funk.gif', '28', '28', '28', '惊恐'], ['15', ':curse:', 'curse.gif', '28', '28', '28', '咒骂'], ['16', ':dizzy:', 'dizzy.gif', '28', '28', '28', '晕'], ['17', ':shutup:', 'shutup.gif', '28', '28', '28', '闭嘴'], ['18', ':sleepy:', 'sleepy.gif', '28', '28', '28', '睡'], ['19', ':hug:', 'hug.gif', '28', '28', '28', '拥抱'], ['20', ':victory:', 'victory.gif', '28', '28', '28', '胜利'], ['21', ':sun:', 'sun.gif', '28', '28', '28', '太阳'], ['22', ':moon:', 'moon.gif', '28', '28', '28', '月亮'], ['23', ':kiss:', 'kiss.gif', '28', '28', '28', '示爱'], ['24', ':handshake:', 'handshake.gif', '28', '28', '28', '握手']];
var t_id = getQueryString('t_id');
var chat_goods_id = getQueryString('goods_id');
var order_evaluate_html = '<span style="float: right; padding: 0; margin:5px 10px 5px 0; text-decoration: underline;" class="title"><a style="color: #cccccc;" id="order_evaluate" href="javascript:order_evaluate();">评价</a></span>';
var order_vrrefund_html = '<span style="float: right; padding: 0; margin:5px 10px 5px 0; text-decoration: underline;" class="title"><a style="color: #cccccc;" id="order_vrrefund" href="javascript:order_vrrefund2();">投诉</a></span>';
//var order_vrrefund_html ='';

$(function () {
    //解决ios自带浏览器和安卓自带浏览器在没有用户交互触摸浏览器屏幕只通过js调用播放声音被拦截的问题
    $('html').one('click', function () {
        if (chat_audio === 1) {
            currentAudio = document.getElementById("msg_tip_audio");
            currentAudio.currentTime = 0;
            currentAudio.play();
            setTimeout(function () {
                currentAudio.pause();
                currentAudio.currentTime = 0;
            }, 100);
        }
    });
    $.getJSON(ApiUrl + '/member_chat/get_node_info', {
        key: key,
        u_id: t_id,
        chat_goods_id: chat_goods_id
    }, function (result) {
        nodeSiteUrl = result.datas.node_site_url;
        memberInfo = result.datas.member_info;
        userInfo = result.datas.user_info;
        userChatCard = result.datas.member_chat_card;
        checkLogin(result.login);
        //清除浏览器残留的和自己聊天的聊天卡，避免自己和自己聊天（和自己的聊天凭证chat_time_47_47的情况）
        delCookie('chat_time_' + memberInfo.member_id + '_' + memberInfo.member_id);
        if (memberInfo.member_id == userInfo.member_id) {
            $.sDialog({
                skin: "red",
                content: "不能和自己聊天",
                okBtn: false,
                cancelBtn: false
            });
            setTimeout(function () {
                history.back();
            }, 3000);
            return false;
        }
        connentNode(result.datas);
        if (!$.isEmptyObject(result.datas.chat_goods)) {
            var goods = result.datas.chat_goods;
            var html = '<div class="nctouch-chat-product"> <div class="goods-pic"><img src="' + goods.pic + '" alt=""/></div><div class="goods-info"><div class="goods-name"><a href="' + WapSiteUrl + "/js_template/product_detail.html?goods_id=" + goods.goods_id + '" target="_blank">' + goods.goods_name + '</div></a><div class="goods-price">￥' + goods.goods_price + "</div><p><a href='javascript:;' class='send_goods_url'>发送链接</a></p></div> </div>";
            $("#chat_msg_html").append(html);
        }
        update_chat_time();
    });

    var connentNode = function (data) {
        $('h1').html((userInfo.store_name != '' ? userInfo.store_name : userInfo.member_name) + '（<span>离线</span>）');
        resourceSiteUrl = data.resource_site_url;
        if (!data.node_chat) {
            $.sDialog({
                skin: "red",
                content: '在线聊天系统暂时未启用',
                okBtn: false,
                cancelBtn: false
            });
            return false;
        }

        var is_set_chat_offline = getCookie('is_set_chat_offline');
        if (typeof is_set_chat_offline != "undefined" && is_set_chat_offline != null && is_set_chat_offline == 1) { //医生设置了聊天为不在线状态
            $.sDialog({
                skin: "red",
                content: '你现在处于离线状态,是否设置聊天为在线状态',
                okBtnText: '设置在线',
                cancelBtnText: '返回',
                okBtn: true,
                cancelBtn: true,
                okFn: function () {
                    delCookie('is_set_chat_offline');
                    window.location.href = window.location.href;
                },
                cancelFn: function () {
                    history.back();
                }
            });
            return false;
        }

        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = nodeSiteUrl + '/socket.io/socket.io.js';
        document.body.appendChild(script);
        checkIO();
        function checkIO() {
            setTimeout(function () {
                if (typeof io === "function") {
                    connect_node();
                } else {
                    checkIO();
                }
            }, 500);
        }

        function connect_node() {
            var connect_url = nodeSiteUrl;
            var connect = 0;//连接状态
            var member = {};

            member['u_id'] = memberInfo.member_id;
            member['u_name'] = memberInfo.member_name;
            member['avatar'] = memberInfo.member_avatar;
            member['s_id'] = memberInfo.store_id;
            member['s_name'] = memberInfo.store_name;
            member['s_avatar'] = memberInfo.store_avatar;


            socket = io(connect_url, {'path': '/socket.io', 'reconnection': false});
            socket.on('connect', function () {
                connect = 1;
                socket.emit('update_user', member);

                // 在线状态
                if (memberInfo.member_id != userInfo.member_id && userInfo.member_id > 0) {
                    var u_list = {};
                    u_list[userInfo.member_id] = 0;
                    socket.emit('get_state', u_list);
                }
                socket.on('get_state', function (u_list) {
                    get_state(u_list);
                });

                setInterval(function () {
                    if (connect === 1) {
                        // 在线状态
                        if (memberInfo.member_id != userInfo.member_id && userInfo.member_id > 0) {
                            var u_list = {};
                            u_list[userInfo.member_id] = 0;
                            socket.emit('get_state', u_list);
                        }
                    }
                }, 3000);

                socket.on('get_msg', function (data) {
                    get_msg(data);
                });
//                        socket.on('del_msg', function (data) {
//                          del_msg(data);
//                        });
                socket.on('disconnect', function () {
                    connect = 0;
                    // 重连
//                          connect('0');
                });
            });
//                function node_get_state(data){
//                    if(connect === 1) {
//                        var myArray=new Array();
//                        myArray['5'] = 0
//                        socket.emit('get_state', myArray);
//                    }
//                }
            function node_send_msg(data) {
                if (connect === 1) {
                    if (memberInfo.member_id == data.t_id) {
                        $.sDialog({
                            skin: "red",
                            content: "不能和自己聊天",
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false;
                    }
                    if (user_state_list[data.t_id] <= 0) {
                        send_buy_chat_card_msg(false, '对方不在线，请稍后再联系');
                        return false;
                    }
                    //发消息时，判断是否有与该医生进行聊天的主动聊天卡
                    var chat_card = getCookie('chat_time_' + data.t_id + '_' + memberInfo.member_id);
                    var now = new Date().getTime();
                    if (t_id != 1 && memberInfo['member_id'] != 1 && ( typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0)) {
                        delCookie('chat_time_' + data.t_id + '_' + memberInfo.member_id);
                        send_buy_chat_card_msg(false);
                        return;
                    }
                    var chat_card_id = 0;
                    if (t_id != 1 && memberInfo['member_id'] != 1) {
                        chat_card_id = (chat_card.split('_'))[0];
                    }
                    $.ajax({
                        type: 'post',
                        url: ApiUrl + '/member_chat/send_msg',
                        data: {
                            key: data.key,
                            t_id: data.t_id,
                            t_name: data.t_name,
                            t_msg: data.t_msg,
                            chat_goods_id: data.chat_goods_id,
                            chat_card_id: chat_card_id
                        },
                        dataType: 'json',
                        success: function (result) {
                            if (result.code == 200) {
                                var msgData = result.datas.msg;
                                socket.emit('send_msg', msgData);
                                msgData.avatar = memberInfo.member_avatar;
                                msgData.class = 'msg-me';
                                insert_html(msgData);
                            } else {
                                $.sDialog({
                                    skin: "red",
                                    content: result.datas.error,
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                return false;
                            }
                        }
                    });
                }
            }

            function node_del_msg(max_id, f_id) {
                if (connect === 1) {
                    socket.emit('del_msg', {'max_id': max_id, 'f_id': f_id});
                }
            }

            function get_state(u_list) {//返回会员的状态并在页面显示
                user_state_list = u_list['u_state'];
                if (user_state_list[userInfo.member_id] <= 0) {
                    $('h1 span').html('离线');
                } else {
                    $('h1 span').html('在线');
                }
            }

            // 接收消息
            function get_msg(data) {
                var max_id;
                var chat_card_id = 0;
                for (var k in data) {
                    var msgData = data[k];
                    if (data[k].f_id != t_id) {
                        continue;
                    }
                    max_id = k;
                    msgData.avatar = (!$.isEmptyObject(userInfo.store_id) ? userInfo.store_avatar : userInfo.member_avatar);
                    msgData.class = 'msg-other';
                    insert_html(msgData);
                    play_audio();
                    if (chat_card_id == 0) {
                        chat_card_id = data[k].chat_card_id;
                    }

                }
                if (typeof(max_id) != 'undefined') {
                    node_del_msg(max_id, t_id);
                }

                if (connect === 1) {
                    // 只有主动聊天卡不存在时才检测，接收消息后，判断用户是否有被动聊天卡，要是检测的太频繁，会消耗数据库压力，
                    var chat_card = getCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
                    var now = new Date().getTime();
                    if (t_id != 1 && memberInfo['member_id'] != 1 && (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0)) {
                        delCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
                        $.ajax({
                            type: 'post',
                            url: ApiUrl + '/member_chat/doctor_chat_card_list',
                            data: {key: key, u_id: t_id, chat_card_id: chat_card_id},
                            async: false,
                            dataType: 'json',
                            success: function (result) {
                                if (result.code == 200) {
                                    var doctor_chat_card = result.datas;
                                    var end_time = new Date().getTime() + parseInt(doctor_chat_card.how_lang_time) * 1000;
                                    //服务结束时间
                                    var chat_card_end_time = doctor_chat_card.chat_card_end_time * 1000;
                                    if (end_time > chat_card_end_time) {
                                        end_time = chat_card_end_time;
                                    }
                                    if (end_time <= new Date().getTime()) {
                                        send_buy_chat_card_msg(false, '服务时间已经结束');
                                        return false;
                                    }
                                    var is_evaluate = 1; //是否对该聊天卡已进行评价
                                    addCookie('chat_time_' + doctor_chat_card.doctor_id + '_' + memberInfo.member_id, doctor_chat_card.id + '_' + end_time + '_' + doctor_chat_card.card_type + '_' + doctor_chat_card.order_id + '_' + doctor_chat_card.exchange_code + '_' + is_evaluate, 24);
                                    userChatCard.push(doctor_chat_card);
                                    update_chat_time();
                                }
                            }
                        });
                    }
                }
            }

            // 删除消息
//                function del_msg(data) {
//                }

            $('#submit').click(function () {
                var t_msg = $('#msg').val();
                $('#msg').val('');
                if (t_msg == '') {
                    $.sDialog({
                        skin: "red",
                        content: '请填写内容',
                        okBtn: false,
                        cancelBtn: false
                    });
                    return false;
                }
                node_send_msg({
                    key: key,
                    t_id: t_id,
                    t_name: userInfo.member_name,
                    t_msg: t_msg,
                    chat_goods_id: chat_goods_id
                });
                $('#chat_smile').addClass('hide');
                $('.nctouch-chat-con').css('bottom', '2rem');
            });
            //开始
            $(".send_goods_url").click(function () {
                var goods_url = $(".goods-name a").attr("href");
                var goods_name = $(".goods-name a").html();
                var goods_price = $(".goods-price").html();
                var last_msg = $("#msg").val() + goods_url + "&nbsp;" + goods_name + "&nbsp;" + goods_price;
                console.log(last_msg);
                $("#msg").val(last_msg).trigger("click");
                $("#submit").trigger("click");
            });
            //结束
        }

        for (var i in smilies_array[1]) {
            var s = smilies_array[1][i];
            var smilieimg = '<img title="' + s[6] + '" alt="' + s[6] + '" data-sign="' + s[1] + '" src="' + resourceSiteUrl + '/js/smilies/images/' + s[2] + '">';
            $('#chat_smile > ul').append('<li>' + smilieimg + '</li>');
        }

        $('#open_smile').click(function () {
            if ($('#chat_smile').hasClass('hide')) {
                $('#chat_smile').removeClass('hide');
                $('.nctouch-chat-con').css('bottom', '7rem');
            } else {
                $('#chat_smile').addClass('hide');
                $('.nctouch-chat-con').css('bottom', '2rem');
            }
        });
        $('#chat_smile').on('click', 'img', function () {
            var _sign = $(this).attr('data-sign');
            var dthis = $('#msg')[0];
            var start = dthis.selectionStart;
            var end = dthis.selectionEnd;
            var top = dthis.scrollTop;
            dthis.value = dthis.value.substring(0, start) + _sign + dthis.value.substring(end, dthis.value.length);
            dthis.setSelectionRange(start + _sign.length, end + _sign.length);
        });

        // 查看更多聊天记录
        $('#chat_msg_log').click(function () {
            $.ajax({
                type: 'post',
                url: ApiUrl + '/member_chat/get_chat_log&page=50',
                data: {key: key, t_id: t_id, t: 30},
                dataType: 'json',
                success: function (result) {
                    if (result.code == 200) {
                        if (result.datas.list.length == 0) {
                            $.sDialog({
                                skin: "block",
                                content: '暂无聊天记录',
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }
                        result.datas.list.reverse();
                        $("#chat_msg_html").html('');
                        for (var i = 0; i < result.datas.list.length; i++) {
                            var _list = result.datas.list[i];
                            if (_list.f_id != t_id) {
                                var data = {};
                                data.class = 'msg-me';
                                data.avatar = memberInfo.member_avatar;
                                data.t_msg = _list.t_msg;
                                insert_html(data);
                            } else {
                                var data = {};
                                data.class = 'msg-other';
                                data.avatar = userInfo.store_avatar == '' ? userInfo.member_avatar : userInfo.store_avatar;
                                data.t_msg = _list.t_msg;
                                insert_html(data);
                            }
                        }
                    } else {
                        $.sDialog({
                            skin: "red",
                            content: result.datas.error,
                            okBtn: false,
                            cancelBtn: false
                        });
                        return false;
                    }
                }
            });
        });

    }
});

function send_buy_chat_card_msg(is_play_audio, msg) {
    if (typeof is_play_audio === 'undefined') {
        is_play_audio = true;
    }
    if (typeof msg === "undefined") {
        msg = '请&nbsp;<a style="color: #00D800;" href="JavaScript:check_chat_card(' + userInfo.member_id + ');">选择聊天卡</a>';
    }
    var msgData = {
        class: 'msg-other',
        t_msg: msg,
        avatar: (!$.isEmptyObject(userInfo.store_id) ? userInfo.store_avatar : userInfo.member_avatar),
        goods_info: null
    };
    insert_html(msgData);
    if (is_play_audio) {
        play_audio();
    }
}

function check_chat_card(u_id) {
    if (user_state_list[u_id] <= 0) {
        $.sDialog({
            skin: "red",
            content: "对方不在线，请稍后再联系",
            okBtn: false,
            cancelBtn: false
        });
        setTimeout(function () {
            history.back();
        }, 3000);
        return false;
    }
    var chat_card = getCookie('chat_time_' + u_id + '_' + memberInfo.member_id);
    var now = new Date().getTime();
    if (t_id != 1 && memberInfo['member_id'] != 1 && ( typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0)) {
        delCookie('chat_time_' + u_id + '_' + memberInfo.member_id);
        chat_card = [];
        for (var iii = 0; iii < userChatCard.length; iii++) {
            if (parseInt(userChatCard[iii].is_use) == 0) {
                chat_card.push(userChatCard[iii]);
            }
        }
        userChatCard = chat_card;
        if (userChatCard.length <= 0) {
            $.sDialog({
                skin: "red",
                content: '没有可以使用的聊天卡,是否现在去购买聊天卡',
                okBtnText: '是',
                cancelBtnText: '否',
                okBtn: true,
                cancelBtn: true,
                okFn: function () {
                    window.location.href = WapSiteUrl + "/js_template/product_list.html?gc_id=1076&doctor_id=" + u_id + "&_rand=" + 10000 * Math.random();
                },
                cancelFn: function () {
                    history.back();
                }
            });
        } else {
            var cart_list_radio = '<style type="text/css">label {cursor: pointer;display: inline-block;margin-right: 15px;padding-left: 25px;position: relative;}input[type="radio"] {display: none;}label:before {background-color: #ffffff;bottom: 3px;box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.3) inset, 0 1px 0 0 rgba(255, 255, 255, 0.8);content: "";display: inline-block;height: 17px;left: 0;margin-right: 10px;position: absolute;width: 16px;}.radio label:before {border-radius: 8px;}input[type="radio"]:checked + label:before {color: #7a7a7a;content: "•";font-size: 37px;line-height: 18px;text-align: center;}</style><div class="radio">';
            for (var ii = 0; ii < userChatCard.length; ii++) {
                cart_list_radio += '<br/><input name="chat_card_id" ' + (ii == 0 ? 'checked="checked"' : "") + ' id="' + userChatCard[ii].id + '" type="radio" value="' + userChatCard[ii].id + '"><label for="' + userChatCard[ii].id + '">' + userChatCard[ii].how_lang_time + '</label>';
            }
            cart_list_radio += '</div>';
            $.sDialog({
                skin: "red",
                content: '请选择聊天卡' + cart_list_radio,
                okBtn: true,
                cancelBtn: true,
                okFn: function () {
                    var chat_card_id = $('input[name="chat_card_id"]:checked').val();
                    $.ajax({
                        type: 'post',
                        url: ApiUrl + '/member_chat/set_card_used',
                        data: {key: key, chat_card_id: chat_card_id},
                        async: false,
                        dataType: 'json',
                        success: function (result) {
                            if (result.code == 200) {
                                var data = result.datas;
                                for (var ii = 0; ii < userChatCard.length; ii++) {
                                    if (userChatCard[ii].id == chat_card_id) {
                                        userChatCard[ii].is_use = 1;
                                        var end_time = new Date().getTime() + parseInt(userChatCard[ii].how_lang_time) * 1000;
                                        //服务结束时间
                                        var chat_card_end_time = data.chat_card_end_time * 1000;
                                        if (end_time > chat_card_end_time) {
                                            end_time = chat_card_end_time;
                                        }
                                        if (end_time <= new Date().getTime()) {
                                            send_buy_chat_card_msg(false, '服务时间已经结束');
                                            return false;
                                        }
                                        var is_evaluate = 0; //是否对该聊天卡已进行评价
                                        addCookie('chat_time_' + data.doctor_id + '_' + memberInfo.member_id, data.id + '_' + end_time + '_' + data.card_type + '_' + data.order_id + '_' + data.exchange_code + '_' + is_evaluate, 24);
                                        update_chat_time();
                                        send_buy_chat_card_msg(false, '现在可以聊天了');
                                        break;
                                    }
                                }
                            } else {
                                //聊天卡使用状态设置失败
                                $.sDialog({
                                    skin: "red",
                                    content: '选择聊天卡失败，请稍后重试',
                                    okBtn: false,
                                    cancelBtn: false
                                });
                                history.back();
                            }
                        }
                    });
                },
                cancelFn: function () {
                    history.back();
                }
            });
        }
    }
}

function insert_html(msgData) {
    msgData.t_msg = update_chat_msg(msgData.t_msg);
    var html = '<dl class="' + msgData.class + '"><dt><img src="' + msgData.avatar + '" alt=""/><i></i></dt><dd>' + msgData.t_msg + '</dd></dl>';
    $("#chat_msg_html").append(html);
    if (!$.isEmptyObject(msgData.goods_info)) {
        var goods = msgData.goods_info;
        var html = '<div class="nctouch-chat-product"> <a href="' + WapSiteUrl + '/js_template/product_detail.html?goods_id=' + goods.goods_id + '" target="_blank"><div class="goods-pic"><img src="' + goods.pic36 + '" alt=""/></div><div class="goods-info"><div class="goods-name">' + goods.goods_name + '</div><div class="goods-price">￥' + goods.goods_price + '</div></div></a> </div>';
        $("#chat_msg_html").append(html);
    }
    setTimeout(function () {
        $("#anchor-bottom")[0].scrollIntoView();
    }, 300);
}

// 表情
function update_chat_msg(msg) {
    if (typeof smilies_array !== "undefined") {
        msg = '' + msg;
        for (var i in smilies_array[1]) {
            var s = smilies_array[1][i];
            var re = new RegExp("" + s[1], "g");
            var smilieimg = '<img title="' + s[6] + '" alt="' + s[6] + '" src="' + resourceSiteUrl + '/js/smilies/images/' + s[2] + '">';
            msg = msg.replace(re, smilieimg);
        }
    }
    return msg;
}

function update_chat_time() {
    if (t_id != 1 && memberInfo['member_id'] != 1) {
        var chat_time_interval = setInterval(function () {
            var chat_card = getCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
            var now = new Date().getTime();
            if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
                delCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
                $('#chat_time').html(0);
                clearInterval(chat_time_interval);
                chat_time_interval = null;
                send_buy_chat_card_msg(false);
                //如果没有启动聊天卡，删除退款和评价按钮
                if ($("#order_vrrefund").length > 0) {
                    $("#order_vrrefund").remove();
                }
                if ($("#order_evaluate").length > 0) {
                    $("#order_evaluate").remove();
                }
                if ($("#order_operate").css('display') !== 'none') {
                    $("#order_operate").hide();
                }
            } else {
                var left_time = (chat_card.split('_'))[1] - now;
                $('#chat_time').html(formatSeconds(left_time));
                //如果启动聊天卡，当聊天卡类型是医生端聊天卡时，删除退款和评价按钮
                var card_type = (chat_card.split('_'))[2]; //0是客户 1是医生
                if (card_type == 0) { //如果是客户
                    var is_evaluate = (chat_card.split('_'))[5]; //0是未评价或者退款 1是已评价或者退款
                    if (is_evaluate == 0) { //如果未对该聊天卡进行评价或者退款
                        if ($("#order_operate").css('display') == 'none') {
                            $("#order_operate").show();
                        }
                        if ($("#order_vrrefund").length == 0) {
                            $("#order_operate").append(order_vrrefund_html);
                        }
                        if ($("#order_evaluate").length == 0) {
                            $("#order_operate").append(order_evaluate_html);
                        }
                    } else {
                        if ($("#order_vrrefund").length > 0) {
                            $("#order_vrrefund").remove();
                        }
                        if ($("#order_evaluate").length > 0) {
                            $("#order_evaluate").remove();
                        }
                        if ($("#order_operate").css('display') !== 'none') {
                            $("#order_operate").hide();
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
        $('#chat_time').parent().hide();
    }
}

//投诉
function order_vrrefund2() {
    var chat_card = getCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
    var order_id = (chat_card.split('_'))[3];
    window.location.href = WapSiteUrl + '/js_template/member/vr_order_tousu.html?order_id=' + order_id;
}

/**
 * 退款
 */
function order_vrrefund() {
    $.sDialog({
        skin: "red",
        content: '发起退款申请后，该张聊天卡将作废，终止本次咨询，是否继续？',
        okBtnText: '确定',
        cancelBtnText: '取消',
        okBtn: true,
        cancelBtn: true,
        okFn: function () {
            var chat_card = getCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
            var now = new Date().getTime();
            if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
                $.sDialog({
                    skin: "red",
                    content: '退款失败',
                    okBtn: false,
                    cancelBtn: false
                });
            } else {
                var order_id = (chat_card.split('_'))[3];
                //删除cookie
                delCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
                //todo 这个路径要改
                window.location.href = WapSiteUrl + '/js_template/member/vr_order_detail.html?order_id=' + order_id;
            }
        },
        cancelFn: function () {
            //默认取消会关闭对话框
        }
    });
}

/**
 * 评价
 */
function order_evaluate() {
    var chat_card = getCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id);
    var now = new Date().getTime();
    if (typeof chat_card === "undefined" || chat_card == null || (chat_card.split('_'))[1] - now <= 0) {
        $.sDialog({
            skin: "red",
            content: '评价失败',
            okBtn: false,
            cancelBtn: false
        });
    } else {
        var vr_code = (chat_card.split('_'))[4];
        //模拟发送兑换码的兑换请求
        $.sDialog({
            skin: "red",
            content: '是否向医生发送虚拟兑换码：' + vr_code + '？',
            okBtnText: '发送并评价',
            cancelBtnText: '取消',
            okBtn: true,
            cancelBtn: true,
            okFn: function () {
                $.ajax({
                    type: 'post',
                    url: ApiUrl + '/member_index/exchange',
                    data: {
                        key: key,
                        vr_code: vr_code
                    },
                    dataType: 'json',
                    success: function (result) {
                        if (result.code != 200) {
                            $.sDialog({
                                skin: "red",
                                content: '评价失败',
                                okBtn: false,
                                cancelBtn: false
                            });
                            return false;
                        }
                        var data = result.datas;
                        /*if (data.error > 0) {
                         $.sDialog({
                         skin: "red",
                         content: '已经评价过了',
                         okBtn: false,
                         cancelBtn: false
                         });
                         return false;
                         }*/
                        //设置该聊天卡评价状态为已评价
                        addCookie('chat_time_' + userInfo.member_id + '_' + memberInfo.member_id, (chat_card.split('_'))[0] + '_' + (chat_card.split('_'))[1] + '_' + (chat_card.split('_'))[2] + '_' + (chat_card.split('_'))[3] + '_' + (chat_card.split('_'))[4] + '_1', 24);
                        var order_id = (chat_card.split('_'))[3];
                        window.location.href = WapSiteUrl + '/js_template/member/vr_order_detail.html?order_id=' + order_id;
                    }
                });
            },
            cancelFn: function () {
                //默认取消会关闭对话框
            }
        });
    }
}

//警告：一定要用document.getElementById得到currentAudio，不要用jquery获取后再把jquery对象转化为js对象，不然在苹果手机浏览器中不会播放声音
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

$(function () {
    $('input[class="type-file-file"]').change(uploadChange);
    function uploadChange() {
        var filepath = $(this).val();
        var extStart = filepath.lastIndexOf(".");
        var ext = filepath.substring(extStart, filepath.length).toUpperCase();
        if (ext != ".PNG" && ext != ".GIF" && ext != ".JPG" && ext != ".JPEG") {
            $.sDialog({
                skin: "red",
                content: "图片类型错误，请选择png、gif、jpg等格式",
                okBtn: false,
                cancelBtn: false
            });
            $(this).attr('value', '');
            return false;
        }
        if ($(this).val() == '') return false;
        if (!memberInfo.member_id) {
            $.sDialog({
                skin: "red",
                content: "请登录后再发送图片消息",
                okBtn: false,
                cancelBtn: false
            });
        }
        ajaxFileUpload();
    }

    function ajaxFileUpload() {
        $jq.ajaxFileUpload({
            url: ApiUrl + '/member_index/pic_upload?form_submit=ok&key=' + key + '&uploadpath=chat_image/' + memberInfo.member_id,
            secureuri: false,
            fileElementId: '_pic',
            dataType: 'json',
            success: function (data, status) {
                if (data.status == 1) {
                    $('#msg').val('<img src="' + data.url + '">');
                } else {
                    $.sDialog({
                        skin: "red",
                        content: data.msg,
                        okBtn: false,
                        cancelBtn: false
                    });
                }
                $('input[class="type-file-file"]').bind('change', uploadChange);
            },
            error: function (data, status, e) {
                $.sDialog({
                    skin: "red",
                    content: "图片发送失败",
                    okBtn: false,
                    cancelBtn: false
                });
                $('input[class="type-file-file"]').bind('change', uploadChange);
            }
        })
    }
});