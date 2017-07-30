<?php
/**
 * 菜单
 */
$_menu['system_manager'] = array(
    'name' => '平台',
    'child' => array(
        array(
            'name' => $lang->_('nc_config'),
            'child' => array(
                'setting' => $lang->_('nc_web_set'),
                'upload' => $lang->_('nc_upload_set'),
                //'message' => '邮件设置',
               // 'taobao_api' => '淘宝接口',
                'admin' => '权限设置',
                'admin_log' => $lang->_('nc_admin_log'),
                'area' => '地区设置',
                'cache' => $lang->_('nc_admin_clear_cache'),

            )
        ),
        array(
            'name' => $lang->_('nc_member'),
            'child' => array(
                'member' => $lang->_('nc_member_manage'),
                'account' => $lang->_('nc_web_account_syn')
            )
        ),
        array(
            'name' => $lang->_('nc_website'),
            'child' => array(
                'article_class' => $lang->_('nc_article_class'),
                'article' => $lang->_('nc_article_manage'),
                'document' => $lang->_('nc_document'),
                'navigation' => $lang->_('nc_navigation'),
                'adv' => $lang->_('nc_adv_manage'),
                'rec_position' => $lang->_('nc_admin_res_position'),
            )
        ),
        array(
            'name' => '应用',
            'child' => array(
                'link' => '友情连接',
                'hao' => '基本设置',
               // 'goods' => '商品管理',
              //  'db' => '数据库管理',
               // 'member' => '会员管理'
            )
        )
    )
);
