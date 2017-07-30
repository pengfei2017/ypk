var urlParamValue = getValueFromUrl('op');
if (urlParamValue && urlParamValue == "err") {
    Zepto.sDialog({
        skin: "red",
        content: '提交失败，请重新填写',
        okBtn: false,
        cancelBtn: false
    });
}
if (urlParamValue && urlParamValue == "ok") {
    Zepto.sDialog({
        skin: "red",
        content: '提交成功',
        okBtn: false,
        cancelBtn: false
    });
    setTimeout(function () {
        window.location = "member.html";
    }, 3000);
}

$(function () {
    var key = getCookie('key');
    if (!key || key == "undefined" || key == "") {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    $("input[name='key']").val(key);
    setAraeValue(); //设置省市县三级字符串值
    loadProvinceList(key); //加载省级列表
    $(".province").change(function () { //加载地级市列表
        loadCityList(key);
    });
    $(".city").change(function () { //加载县级市列表
        loadCountyList(key);
    });
    $(".county").change(function () {
        setAraeValue();
    });
    bindFormValidate(); //绑定表单验证

    //加载个人信息
    //loadDoctorInfo(key);
});

//加载表单信息
function loadDoctorInfo(key) {
    $.post(ApiUrl + "/member_index/load_doctor_info_custom", {"key": key}, function (data) {
        if (data !== "err") {
            var obj = eval('(' + data + ')');
            if (obj) {
                $("#member_truename").val(obj.member_truename);
                $("#member_sex").val(obj.member_sex?obj.member_sex:3);
                $("#member_qq").val(obj.member_qq);
                $("#company_address").val(obj.member_areainfo); //设置地区内容
                $(".province").val(obj.member_provinceid); //设置省id
                $.post(ApiUrl + "/member_index/loadAreaList", {"key": key, "parent_id": obj.member_provinceid}, function (data) {
                    $(".city").html(data);
                    $(".city").val(obj.member_areaid); //设置地级市id
                    $.post(ApiUrl + "/member_index/loadAreaList", {"key": key, "parent_id": obj.member_areaid}, function (data) {
                        $(".county").html(data);
                        $(".county").val(obj.member_cityid); //设置县级市id
                    }, null);
                }, null);
            }
        }
    }, null);
}

//绑定表单验证
function bindFormValidate() {
    $("#submitForm").validate({
        errorPlacement: function (error, element) {
            var error_td = element.parent('.input-box').children('span.err');
            error_td.append(error);
        },
        success: function (element) {
            element.parent('.input-box').children('span.err').html('');
        },
        rules: {
            member_truename: { //真实姓名
                required: true
            },
            company_address: { //地区
                required: true
            }
        },
        messages: {
            member_truename: { //真实姓名
                required: '真实姓名必填'
            },
            company_address: { //地区
                required: '地区必选'
            }
        }
    });
}

//提交表单数据
function formSubmit() {
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    if ($("#submitForm").valid()) {
        $("#submitForm").submit();
    }
}

//加载省级列表
function loadProvinceList(key) {
    $("#company_address").val("");
    $.post(ApiUrl + "/member_index/loadAreaList", {"key": key, "parent_id": 0}, function (data) {
        $(".province").html(data);
        loadDoctorInfo(key);
        //setAraeValue();
    }, null);
}

//加载地级市列表
function loadCityList(key) {
    $("#company_address").val("");
    var areaId = $(".province").find("option:checked").val();
    $.post(ApiUrl + "/member_index/loadAreaList", {"key": key, "parent_id": areaId}, function (data) {
        $(".city").html(data);
        loadCountyList(key);
        setAraeValue();
    }, null);
}

//加载县级市列表
function loadCountyList(key) {
    $("#company_address").val("");
    var areaId = $(".city").find("option:checked").val();
    $.post(ApiUrl + "/member_index/loadAreaList", {"key": key, "parent_id": areaId}, function (data) {
        $(".county").html(data);
        setAraeValue();
    }, null);
}

//设置省市县三级字符串值
function setAraeValue() {
    var provinceName = "";
    var cityName = "";
    var countyName = "";
    if (parseInt($(".province").find("option:checked").val()) != -1) {
        provinceName = $(".province").find("option:checked").html();
    }
    if (parseInt($(".city").find("option:checked").val()) != -1) {
        cityName = $(".city").find("option:checked").html();
    }
    if (parseInt($(".county").find("option:checked").val()) != -1) {
        countyName = $(".county").find("option:checked").html();
    }
    $("#company_address").val(provinceName + " " + cityName + " " + countyName);
}

//获取url传递的参数的值
function getValueFromUrl(key) {
    var reg = new RegExp("(^|&)" + key + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null)return unescape(r[2]);
    return null;
}