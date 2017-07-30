/**
 * Created by Administrator on 2016/12/28.
 */

$(function () {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    $.getJSON(ApiUrl + '/my_team', {key: key}, function (result) {
        checkLogin(result.login);
        if (pageFlag == "my_team_table") { //位置族谱（表格展示）
            loadTableList(key);
        }
        if (pageFlag == "my_team_tree") { //位置族谱（树状展示）
            loadTreeList(key);
        }
        if (pageFlag == "my_team_straight") { //直荐族谱
            loadStraghtList(key);
        }
        if (pageFlag == "my_team_memberlist") { //加盟商列表
            loadMemberList(key);
        }
        if (pageFlag == "my_team_score_count") { //积分统计
            loadScoreCountList(key);
        }
    });

});

//加载表格位置族谱
function loadTableList(key) {
    var member_id = getValueFromUrl("member_id");
    $.post(ApiUrl + '/my_team/my_team_table', {'key': key, 'member_id': member_id}, function (data) {
        var obj = eval('(' + data + ')');
        $("#myTeamTable").html(obj.mapStr);
        $(".member_info").html(obj.user_info);
    }, null);
}

//加载树状位置族谱
function loadTreeList(key) {
    var member_id = getValueFromUrl("member_id");
    $.post(ApiUrl + '/my_team/my_team_tree', {'key': key, 'member_id': member_id}, function (data) {
        $("#myTeamTable").html(data);
    }, null);
}

//加载直荐族谱
function loadStraghtList(key) {
    $.post(ApiUrl + '/my_team/my_team_straight', {'key': key}, function (data) {
        $("#myTeamTable").append(data);
    }, null);
}

//加载加盟商列表
function loadMemberList(key) {
    $.post(ApiUrl + '/my_team/my_team_memberlist', {'key': key}, function (data) {
        $("#myTeamTable").append(data);
    }, null);
}

//加载积分统计列表
function loadScoreCountList(key) {
    $.post(ApiUrl + '/my_team/my_team_score_count', {'key': key}, function (data) {
        $("#myTeamTable").append(data);
    }, null);
}

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}

