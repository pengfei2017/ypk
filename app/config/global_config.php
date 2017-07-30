<?php
/**
 * 全局配置信息
 */
$global_config = array();
$global_config['admin_site_url'] = '/admin';
$global_config['shop_site_url'] = '/shop';
$global_config['cms_site_url'] = '/cms';
$global_config['microshop_site_url'] = '/microshop';
$global_config['circle_site_url'] = '/circle';
$global_config['mobile_site_url'] = '/mobile';
$global_config['wap_site_url'] = '/h5_web';
$global_config['wechat_site_url'] = '/wechat/ems/'; //微信网址

$global_config['lc_open'] = true;//如果要启用商城首页楼层导航，把false修改为true，另外记得在后台进行楼层设置，否则没有楼层数据，照样显示不出来

$global_config['node_chat'] = true;//如果要启用IM，把false修改为true
$global_config['chat_site_url'] = '/chat';
$global_config['node_site_url'] = 'http://ypk99.com:8096'; //如果要启用IM，把 developer.site 修改为您的node服务器IP

$global_config['delivery_site_url'] = '/delivery';
$global_config['chain_site_url'] = '/chain';
$global_config['member_site_url'] = '/member';
$global_config['upload_site_url'] = '/files/upload';
$global_config['upload_path'] = '/public/files/upload';
$global_config['allow_upload_image_type'] = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
$global_config['allow_upload_flash_type'] = array('flv', 'swf');
$global_config['allow_upload_media_type'] = array('mp3', 'mp4');
$global_config['resource_site_url'] = '/resource';
$global_config['resource_path'] = BASE_PATH . '/public/resource';
$global_config['version'] = '201610030300';
$global_config['setup_date'] = '2016-10-03 03:00:00';
$global_config['gip'] = 0;
$global_config['tablepre'] = '';
$global_config['dbname'] = 'ypk';
$global_config['debug'] = false;
$global_config['session_expire'] = 3600;
$global_config['lang_type'] = 'zh_cn';
$global_config['cookie_pre'] = '44DE_';

$global_config['cache_open'] = false; //todo 数据缓存打开了

$global_config['fullindexer']['open'] = false;
$global_config['fullindexer']['appname'] = 'xingsu';
$global_config['password_encrypt_key'] = md5('automatically');
$global_config['debug'] = false;
$global_config['url_model'] = false; //如果要启用伪静态，把false修改为true
$global_config['subdomain_suffix'] = '';//如果要启用医生二级域名，请填写不带www的域名
//$global_config['session_type'] = 'redis';
//$global_config['session_save_path'] = 'tcp://127.0.0.1:6379';
//流量记录表数量，为1~10之间的数字，默认为3，数字设置完成后请不要轻易修改，否则可能造成流量统计功能数据错误
$global_config['flowstat_tablenum'] = 3;
//$global_config['oss']['open'] = false;
//$global_config['oss']['img_url'] = '';
//$global_config['oss']['api_url'] = '';
//$global_config['oss']['bucket'] = '';
//$global_config['oss']['access_id'] = '';
//$global_config['oss']['access_key'] = '';
$global_config['https'] = false;
$global_config['charset'] = 'UTF-8';
$global_config['default_store_id'] = 0;
$global_config['member_tree_level'] = array(
    '1' => array('name' => '铜卡', 'pay_money' => 0, 'style' => array('title' => '铜', 'background-color' => '#ccc', 'color' => '#000'), 'has_permission' => array('straight'), 'straight_money_base_rate' => 0.03, 'collision_money_base' => 0, 'commission_rate' => array('1' => 0, '2' => 0, '3' => 0)),
    '2' => array('name' => '银卡', 'pay_money' => 1500, 'style' => array('title' => '银', 'background-color' => '#070bf7', 'color' => '#f3f0f0'), 'has_permission' => array('straight', 'collision', 'commission'), 'straight_money_base_rate' => 0.05, 'collision_money_base' => 150, 'commission_rate' => array('1' => 0.08, '2' => 0.03, '3' => 0.01)),
    '3' => array('name' => '金卡', 'pay_money' => 3000, 'style' => array('title' => '金', 'background-color' => '#f33', 'color' => 'yellow'), 'has_permission' => array('straight', 'collision', 'commission'), 'straight_money_base_rate' => 0.1, 'collision_money_base' => 245, 'commission_rate' => array('1' => 0.1, '2' => 0.05, '3' => 0.03))
);
$global_config['doctor_share_benefits_rate'] = 0.6; //医生分利比例
$global_config['max_collision_times'] = 500; //每个会员一个月最多可以积分碰撞500次 //月初将所有会员当月的碰撞次数设为0
$global_config['collision_big_ratio'] = 2; //积分碰撞比例达到2:1的2
$global_config['collision_small_ratio'] = 1; //积分碰撞比例达到2:1的1，collision_small_ratio必须比collision_big_ratio小，千万别弄反
$global_config['points_base_number'] = 3000; //积分碰撞积分基数单位 3000
//每个月月底评定一次等级时等级区分比率
$global_config['member_month_level_rate'] = array(
    '1' => array(2, 4),
    '2' => array(4, 7),
    '3' => array(6, 12),
    '4' => array(8, 16),
    '5' => array(16, 32),
    '6' => array(32, 64),
    '7' => array(60, 120),
    '8' => array(120, 240),
    '9' => array(240, 480)
);
$global_config['doctor_get_points_rate'] = 0.6; //医务人员获取积分的比例
$global_config['chat_card_rate'] = 0.6; //聊天卡翻倍比例
$global_config['file_upload_total_size'] = 40; //上传图片总大小限制（单位：M）
$global_config['service_refund_time_long'] = 720; //医生服务可以发起退款的时间区间限制（单位：分钟）


return $global_config;