var order_id = getQueryString('order_id');
var store_id = '';
var map_index_id = '';
var map_list = [];
$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
    }
    $.getJSON(ApiUrl + '/member_vr_order/order_info', {key: key, order_id: order_id}, function (result) {
        if (result.datas.error) {
            return;
        }
        result.datas.order_info.WapSiteUrl = WapSiteUrl;
        $('#order-info-container').html(template.render('order-info-js_template', result.datas.order_info));
        $('#buyer_phone').val(result.datas.order_info.buyer_phone);

        // 取消
        $(".cancel-order").click(cancelOrder);
        // 评价
        $(".evaluation-order").click(evaluationOrder);
        //上传病历
        $('.upload-case-history-order').click(function () {
            var order_id = $(this).attr("order_id");
            var store_id = $(this).attr("store_id");
            location.href = WapSiteUrl + '/js_template/member/upload_case_history.html?order_id=' + order_id+"&store_id="+store_id;
        });

        // 全部退款
        $('.all_refund_order').click(allRefundOrder);
        $('#resend').click(reSend);
        $('#tosend').click(toSend);

        $.getJSON(ApiUrl + '/goods/store_o2o_addr', {store_id: result.datas.order_info.store_id}, function (result) {
            if (result.datas.error) {
                return;
            }
            $('#list-address-ul').html(template.render('list-address-script', result.datas));
            if (result.datas.addr_list.length > 0) {
                map_list = result.datas.addr_list;
                var _html = '';
                _html += '<dl index_id="0">';
                _html += '<dt>' + map_list[0].name_info + '</dt>';
                _html += '<dd>' + map_list[0].address_info + '</dd>';
                _html += '</dl>';
                _html += '<p><a href="tel:' + map_list[0].phone_info + '"></a></p>';
                $('#goods-detail-o2o').html(_html);
                $('#goods-detail-o2o').on('click', 'dl', map);
                if (map_list.length > 1) {
                    $('#store_addr_list').html('查看全部' + map_list.length + '家分店地址');
                } else {
                    $('#store_addr_list').html('查看商家地址');
                }
                $('#map_all > em').html(map_list.length);
            } else {
                $('.nctouch-vr-order-location').hide();
            }
        });
        $.animationLeft({
            valve: '#store_addr_list',
            wrapper: '#list-address-wrapper',
            scroll: '#list-address-scroll'
        });
    });

    //取消订单
    function cancelOrder() {
        var order_id = $(this).attr("order_id");

        $.sDialog({
            content: '确定取消订单？',
            okFn: function () {
                cancelOrderId(order_id);
            }
        });
    }

    function cancelOrderId(order_id) {
        $.ajax({
            type: "post",
            url: ApiUrl + "/member_vr_order/order_cancel",
            data: {order_id: order_id, key: key},
            dataType: "json",
            success: function (result) {
                if (result.datas && result.datas == 1) {
                    window.location.reload();
                }
            }
        });
    }

    function reSend() {
        // 从下到上动态显示隐藏内容
        $.animationUp({valve: '', scroll: ''});
        $('#buyer_phone').on('blur', function () {
            if ($(this).val() != '' && !/^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test($(this).val())) {
                $(this).val(/\d+/.exec($(this).val()));
            }
        });
    };

    function toSend() {
        var buyer_phone = $('#buyer_phone').val();
        $.ajax({
            type: "post",
            url: ApiUrl + "/member_vr_order/resend",
            data: {order_id: order_id, buyer_phone: buyer_phone, key: key},
            dataType: "json",
            success: function (result) {
                if (result.datas && result.datas == 1) {
                    $('.nctouch-bottom-mask').addClass('down').removeClass('up');
                } else {
                    $('.rpt_error_tip').html(result.datas.error).show();
                }
            }
        });
    }

    // 评价
    function evaluationOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/js_template/member/member_vr_evaluation.html?order_id=' + orderId;

    }

    // 全部退款
    function allRefundOrder() {
        var orderId = $(this).attr('order_id');
        location.href = WapSiteUrl + '/js_template/member/refund_all.html?order_id=' + orderId;
    }

    $('#list-address-scroll').on('click', 'dl > a,#map_all', map);
    $('#map_all').on('click', map);

    function map() {
        $('#map-wrappers').removeClass('hide').removeClass('right').addClass('left');
        $('#map-wrappers').on('click', '.header-l > a', function () {
            $('#map-wrappers').addClass('right').removeClass('left');
        });
        $('#baidu_map').css('width', document.body.clientWidth);
        $('#baidu_map').css('height', document.body.clientHeight);
        map_index_id = $(this).attr('index_id');
        if (typeof map_index_id != 'string') {
            map_index_id = '';
        }
        if (typeof(map_js_flag) == 'undefined') {
            $.ajax({
                url: WapSiteUrl + '/js/map.js',
                dataType: "script",
                async: false
            });
        }
        if (typeof BMap == 'object') {
            baidu_init();
        } else {
            load_script();
        }
    }
});

//联系医生
function to_chat(obj) {
    location.href=WapSiteUrl+"/js_template/member/chat_info.html?goods_id="+$(obj).attr("data-goods_id")+"&t_id="+$(obj).attr("data-to-user-id");
}

//确认兑换服务或聊天卡，发送电子兑换码
function send_vr_code(obj) {
    Zepto.sDialog({
        skin: "red",
        content: '建议您确定使用该产品后再进行兑换，您确定要兑换码？',
        okBtn: true,
        cancelBtn: true,
        okFn: function () {
            send_code($(obj).attr("data-vrcode"));
        }
    });

}

//发送兑换码
function send_code(vr_code) {
    var key = getCookie('key');
    $.post(ApiUrl + "/member_index/exchange", {"key": key, "vr_code": vr_code}, function (data) {
        data = eval("(" + data + ")");
        if (parseInt(data.datas.error) == 6) {
            Zepto.sDialog({
                skin: "red",
                content: '操作失败，请稍后再试',
                okBtn: false,
                cancelBtn: false
            });
        }
        else {
            Zepto.sDialog({
                skin: "red",
                content: '兑换成功',
                okBtn: false,
                cancelBtn: false
            });
            setTimeout(function () {
                window.location.reload();
            }, 2000);
        }
    }, null);
}