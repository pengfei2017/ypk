$(function () { //ApiUrl
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
    }
    initData(key); //初始化
});

//初始化
function initData(key) {
    var type=getValueFromUrl("type");
    if(type=="straght"){  //直荐奖
        loadStraghtList(key);
    }
    if(type=="collision"){ //积分碰撞将
        loadCollisionList(key);
    }
    if(type=="commission"){ //分佣奖
        loadCommissionList(key);
    }
    if(type=="share_benefits"){ //分利奖
        loadShareBenefitsList(key);
    }
}

//直荐奖
function loadStraghtList(key) {
    var member_type = getValueFromUrl("member_type");
    $.post(ApiUrl+"/member_index/load_straght_list", {"key":key,"member_type":member_type}, function (data) {
        $(".tbList").append(data);
    }, null);
}

//积分碰撞奖
function loadCollisionList(key) {
    var member_type = getValueFromUrl("member_type");
    $.post(ApiUrl+"/member_index/load_collision_list", {"key":key,"member_type":member_type}, function (data) {
        $(".tbList").append(data);
    }, null);
}

//分佣奖
function loadCommissionList(key) {
    var member_type = getValueFromUrl("member_type");
    $.post(ApiUrl+"/member_index/load_commission_list", {"key":key,"member_type":member_type}, function (data) {
        $(".tbList").append(data);
    }, null);
}

//分利奖
function loadShareBenefitsList(key) {
    var member_type = getValueFromUrl("member_type");
    $.post(ApiUrl+"/member_index/load_share_benefits_list", {"key":key,"member_type":member_type}, function (data) {
        $(".tbList").append(data);
    }, null);
}


//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}
