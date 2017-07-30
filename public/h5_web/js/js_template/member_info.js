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

    //加载医生个人信息
    //loadDoctorInfo(key);
});

//加载表单信息
function loadDoctorInfo(key) {
    $.post(ApiUrl + "/member_index/load_doctor_info", {"key": key}, function (data) {
        if (data !== "err") {
            var obj = eval('(' + data + ')');
            if (obj) {
                $("#member_truename").val(obj.business_sphere);
                $("#business_departments").val(obj.business_departments);
                $("#business_professional").val(obj.business_professional);
                $("#business_lockHospital").val(obj.business_lockHospital);
                $("#business_activeHospital").val(obj.business_activeHospital);
                $("#company_address_detail").val(obj.company_address_detail);
                $("#business_idcard_number").val(obj.business_idcard_number);
                $("#mail_content").val(obj.mail_content);
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
            business_departments: { //科室
                required: true
            },
            business_professional: { //职称
                required: true
            },
            business_lockHospital: { //定点医院
                required: true
            },
            company_address: { //地区
                required: true
            },
            company_address_detail: { //详细地址
                required: true
            },
            business_idcard_number: { //身份证长度
                maxlength: 20
            }
        },
        messages: {
            member_truename: { //真实姓名
                required: '真实姓名必填'
            },
            business_departments: { //科室
                required: '科室必填'
            },
            business_professional: { //职称
                required: '职称必填'
            },
            business_lockHospital: { //定点医院
                required: '定点医院必填'
            },
            company_address: { //地区
                required: '地区必填'
            },
            company_address_detail: { //详细地址
                required: '详细地址必填'
            },
            business_idcard_number: {
                maxlength: "身份证号码不能超过20个字符"
            }
        }
    });
}

//提交表单数据
function formSubmit() {
    //alert($("#submitForm").valid());
    var key = getCookie('key');
    if (!key) {
        window.location.href = WapSiteUrl + '/js_template/member/login.html';
        return;
    }
    if ($("#submitForm").valid()) {
        //验证卖家名是否已经存在
        var seller_name = $("#seller_name").val();
        $.post(ApiUrl + "/member_index/check_seller_name_exist", {
            "key": key,
            "seller_name": seller_name
        }, function (data) {
            if (data == "true") {
                errorTipsShow('<p>医务中心登录帐号已经存在，请修改后重新提交！</p>');
            }
            else {
                $("#submitForm").submit();
            }
        }, null);

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