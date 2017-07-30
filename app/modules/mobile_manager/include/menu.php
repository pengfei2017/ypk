<?php
/**
 * 菜单
 */
$_menu['mobile_manager'] = array(
    'name' => $lang['nc_mobile'],
    'child' => array(
        array(
            'name' => '设置',
            'child' => array(
                'setting' => '手机端设置',
                'special' => '模板设置',
                'category' => $lang['nc_mobile_catepic'],
           //     'app' => '应用安装',
                'feedback' => $lang['nc_mobile_feedback'],
                'payment' => '手机支付',
                'wx' => '微信二维码'
                //'connect' => '第三方登录'
            )
        ),
        array(
            'name'=>'分享二维码',
            'child'=>array(
                'share_img'=>'背景设置'
            )
        )
    )
);