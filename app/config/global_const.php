<?php
/**
 * 全局常量定义
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/19
 * Time: 23:53
 */

/**
 * 初始化
 */
define('StartTime', microtime(true)); //开始请求时间
define('TIMESTAMP', time());
define('DS', '/');
define('IGNORE_EXCEPTION', true);

/**
 * 安装判断
 */
if (!is_file(BASE_PATH . "/public/install/lock") && is_file(BASE_PATH . "/public/install/index.php")) {
    @header("location: /install/index.php");
    exit;
}

/**
 * layout目录定义
 */
define("SHOP_LAYOUT_DIR", "/common/layout/"); //商城模版目录

/**
 * 附件上传目录定义
 */
define('ATTACH_ADMIN_AVATAR', 'admin/avatar');
define('ATTACH_WAYBILL', 'shop/waybill');
define('ATTACH_PATH', 'shop'); //附件路径（即文件上传的默认文件夹）
define('ATTACH_COMMON', 'shop/common');
define('ATTACH_AVATAR', 'shop/avatar');
define('ATTACH_MEMBERTAG', 'shop/membertag');
define('ATTACH_STORE', 'shop/store');
define('ATTACH_GOODS', 'shop/store/goods');
define('ATTACH_STORE_DECORATION', 'shop/store/decoration');
define('ATTACH_LOGIN', 'shop/login');
define('ATTACH_ARTICLE', 'shop/article');
define('ATTACH_BRAND', 'shop/brand');
define('ATTACH_GOODS_CLASS', 'shop/goods_class');
define('ATTACH_ADV', 'shop/adv');
define('ATTACH_ACTIVITY', 'shop/activity');
define('ATTACH_WATERMARK', 'shop/watermark');
define('ATTACH_POINTPROD', 'shop/pointprod');
define('ATTACH_GROUPBUY', 'shop/groupbuy');
define('ATTACH_SLIDE', 'shop/store/slide');
define('ATTACH_VOUCHER', 'shop/voucher');
define('ATTACH_REDPACKET', 'shop/redpacket');
define('ATTACH_STORE_JOININ', 'shop/store_joinin');
define('ATTACH_REC_POSITION', 'shop/rec_position');
define('ATTACH_CONTRACTICON', 'shop/contracticon');
define('ATTACH_CONTRACTPAY', 'shop/contractpay');
define('ATTACH_MOBILE', 'mobile');
define('ATTACH_CIRCLE', 'circle');
define('ATTACH_CMS', 'cms');
define('ATTACH_LIVE', 'live');
define('ATTACH_MALBUM', 'shop/member');
define('ATTACH_MICROSHOP', 'microshop');
define('ATTACH_DELIVERY', 'delivery');
define('ATTACH_CHAIN', 'chain');
define('ATTACH_EDITOR', 'shop/editor');


/*
 * 商家入驻状态定义
 */
//新申请
define('STORE_JOIN_STATE_NEW', 10);
//完成付款
define('STORE_JOIN_STATE_PAY', 11);
//初审成功
define('STORE_JOIN_STATE_VERIFY_SUCCESS', 20);
//初审失败
define('STORE_JOIN_STATE_VERIFY_FAIL', 30);
//付款审核失败
define('STORE_JOIN_STATE_PAY_FAIL', 31);
//开店成功
define('STORE_JOIN_STATE_FINAL', 40);

//默认颜色规格id(前台显示图片的规格)
define('DEFAULT_SPEC_COLOR_ID', 1);


//会员登录注册发送短信间隔（单位为秒）
define('DEFAULT_CONNECT_SMS_TIME', 60);
//会员登录注册时每个手机号发送短信个数
define('DEFAULT_CONNECT_SMS_PHONE', 5);
//会员登录注册时每个IP发送短信个数
define('DEFAULT_CONNECT_SMS_IP', 20);

/**
 * 商品图片
 */
define('GOODS_IMAGES_WIDTH', '60,240,360,1280');
define('GOODS_IMAGES_HEIGHT', '60,240,360,1280');
define('GOODS_IMAGES_EXT', '_60,_240,_360,_1280');

/**
 *  订单状态
 */
//已取消
define('ORDER_STATE_CANCEL', 0);
//已产生但未支付
define('ORDER_STATE_NEW', 10);
//已支付
define('ORDER_STATE_PAY', 20);
//已发货
define('ORDER_STATE_SEND', 30);
//已收货，交易成功
define('ORDER_STATE_SUCCESS', 40);
//退款锁定中
define('ORDER_REFUND_LOCK', 50);
//订单超过N小时未支付自动取消
define('ORDER_AUTO_CANCEL_TIME', 1);
//订单超过N天未收货自动收货
define('ORDER_AUTO_RECEIVE_DAY', 10);

//预订尾款支付期限(小时)
define('BOOK_AUTO_END_TIME', 72);

//门店支付订单支付提货期限(天)
define('CHAIN_ORDER_PAYPUT_DAY', 7);
/**
 * 订单删除状态
 */
//默认未删除
define('ORDER_DEL_STATE_DEFAULT', 0);
//已删除
define('ORDER_DEL_STATE_DELETE', 1);
//彻底删除
define('ORDER_DEL_STATE_DROP', 2);

/**
 * 文章显示位置状态,1默认网站前台,2买家,3卖家,4全站
 */
define('ARTICLE_POSIT_SHOP', 1);
define('ARTICLE_POSIT_BUYER', 2);
define('ARTICLE_POSIT_SELLER', 3);
define('ARTICLE_POSIT_ALL', 4);

//兑换码过期后可退款时间，15天
define('CODE_INVALID_REFUND', 15);

/**
 * 加载全局配置信息文件
 */
if (file_exists(BASE_PATH . '/app/config/global_config.php')) {
    include(BASE_PATH . '/app/config/global_config.php');
} else {
    exit('全局配置文件不存在!');
}
global $global_config;

//默认平台医生id
define('DEFAULT_PLATFORM_STORE_ID', $global_config['default_store_id']);

define('ADMIN_SITE_URL', $global_config['admin_site_url']); // '/shop'
define('SHOP_SITE_URL', $global_config['shop_site_url']); // '/shop'
define('MICROSHOP_SITE_URL', $global_config['microshop_site_url']);
define('CIRCLE_SITE_URL', $global_config['circle_site_url']);
define('CHARSET', $global_config['charset']);
define('DBPRE', $global_config['tablepre']);
define('DBNAME', $global_config['dbname']);
define('UPLOAD_SITE_URL', $global_config['upload_site_url']); // '/files/upload'
define('BASE_UPLOAD_PATH', BASE_PATH . $global_config['upload_path']);
define('PASSWORD_ENCRYPT_KEY', $global_config['password_encrypt_key']);
define('URL_MODEL', $global_config['url_model']);
define('SUBDOMAIN_SUFFIX', $global_config['subdomain_suffix']);
define('CMS_SITE_URL', $global_config['cms_site_url']);
define('MOBILE_SITE_URL', $global_config['mobile_site_url']);
define('WAP_SITE_URL', $global_config['wap_site_url']);
define('RESOURCE_SITE_URL', $global_config['resource_site_url']); // '/resource'
define('RESOURCE_PATH', $global_config['resource_path']); // '/resource'
define('MEMBER_SITE_URL', $global_config['member_site_url']); // '/member'
define('DELIVERY_SITE_URL', $global_config['delivery_site_url']);
define('LOGIN_SITE_URL', $global_config['member_site_url']); //会员登录页面
define('RESOURCE_SITE_URL_HTTPS', $global_config['resource_site_url']);
define('CHAIN_SITE_URL', $global_config['chain_site_url']);
define('LOGIN_RESOURCE_SITE_URL', MEMBER_SITE_URL . '/resource');
define('UPLOAD_SITE_URL_HTTPS', $global_config['upload_site_url']);
define('CHAT_SITE_URL', $global_config['chat_site_url']); // '/chat'
define('NODE_SITE_URL', $global_config['node_site_url']);
define('LANG_TYPE', $global_config['lang_type']);
define('SESSION_EXPIRE', $global_config['session_expire']);
define('COOKIE_PRE', $global_config['cookie_pre']);

/**
 * 判断字符串是否是ip地址
 * @param $server_name
 * @return int
 */
function isIp($server_name)
{
    return preg_match('/^((?:(?:25[0-5]|2[0-4]\d|((1\d{2})|([1-9]?\d)))\.){3}(?:25[0-5]|2[0-4]\d|((1\d{2})|([1 -9]?\d))))$/', $server_name);
}

/**
 * 获得网站的一级域名
 * 在存储cookies时填写cookies作用域时用
 * @return string
 */
function get_first_level_domain_name()
{
    //在php cli脚本程序中，没有浏览器和服务器的概念，只是一个php脚本客户端，所以$_SERVER没有SERVER_NAME这个索引
    if (isset($_SERVER['SERVER_NAME'])) {

        $server_name = strtolower($_SERVER['SERVER_NAME']);

        if (!isIp($server_name)) {
            //不是ip地址的话，把cookie的作用域填成一级域名

            //com\.cn指以.com.cn结尾的一级域名
            //com指以.com结尾的一级域名
            //cn指以.cn结尾的一级域名
            //org指以.org结尾的一级域名
            //site指以.site结尾的一级域名
            //site\.cn指以.site.cn结尾的一级域名
            //如果你所搜索的一级域名的末尾不存在，请在下面自行添加
            preg_match('/[\w][\w-]*\.(?:com\.cn|com|cn|co|net|org|gov|cc|biz|info|site|site\.cn)(\/|$)/isU', $server_name, $domain);
            //rtrim用来去掉域名中的'/'字符
            return rtrim($domain[0], '/');
        } else {
            //是ip地址的话，，把cookie的作用域填成ip地址
            return $server_name;
        }
    }
}

define('FIRST_LEVEL_DOMAIN_NAME', get_first_level_domain_name());

/**
 * 加载自定义的公共方法
 */
if (file_exists(BASE_PATH . '/app/common/library/Function.php')) {
    require_once BASE_PATH . '/app/common/library/Function.php';
}

/**
 * 加载客户树和医护人员树的操作函数
 */
if (file_exists(BASE_PATH . '/app/common/library/TreeFunction.php')) {
    require_once BASE_PATH . '/app/common/library/TreeFunction.php';
}