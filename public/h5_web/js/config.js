var SiteUrl = "http://"+window.location.host+"/shop";//"http://v5.33hao.com/shop";
var ApiUrl = "http://"+window.location.host+"/mobile";//"http://v5.33hao.com/mobile";
var pagesize = 10;
var WapSiteUrl = "http://"+window.location.host+"/h5_web";//"http://v5.33hao.com/h5_web";
var IOSSiteUrl = "http://"+window.location.host+"/app.ipa";//"http://v5.33hao.com/app.ipa";
var AndroidSiteUrl = "http://"+window.location.host+"/app.apk";//"http://v5.33hao.com/app.apk";

// auto url detection
(function() {
    var m = /^(https?:\/\/.+)\/h5_web/i.exec(location.href);
    if (m && m.length > 1) {
        SiteUrl = m[1] + '/shop';
        ApiUrl = m[1] + '/mobile';
        WapSiteUrl = m[1] + '/h5_web';
    }
})();
