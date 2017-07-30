<?php
/**
 * 菜单
 */
$_menu['shop_manager'] = array(
    'name' => '商城',
    'child' => array(
        array(
            'name' => '设置',
            'child' => array(
                'setting' => '商城设置',
                'upload' => '图片设置',
                'search' => '搜索设置',
                //'seo' => $lang->_('nc_seo_set'),
                'message' => $lang->_('nc_message_set'),
                'payment' => $lang->_('nc_pay_method'),
                'express' => $lang->_('nc_admin_express_set'),
                'waybill' => '运单模板',
                'web_config' => '首页管理',
                //'web_channel' => '频道管理'
            )),
        array(
            'name' => $lang->_('nc_goods'),
            'child' => array(
                'goods' => $lang->_('nc_goods_manage'),
                'goods_class' => $lang->_('nc_class_manage'),
                'brand' => $lang->_('nc_brand_manage'),
                'type' => $lang->_('nc_type_manage'),
                'spec' => $lang->_('nc_spec_manage'),
                'goods_album' => $lang->_('nc_album_manage'),
                //   'goods_recommend' => '商品推荐'
            )),
        array(
            'name' => $lang->_('nc_store'), //医生
            'child' => array(
                'store' => $lang->_('nc_store_manage'),
                //'store_grade' => $lang->_('nc_store_grade'), //医生等级
                //'store_class' => $lang->_('nc_store_class'), //医生分类
                //'domain' => $lang->_('nc_domain_manage'), //二级域名
                //'sns_strace' => $lang->_('nc_s_snstrace'), //医生动态
                //'help_store' => '医生帮助',
                //'store_joinin' => '商家入驻',
                'ownshop' => '自营平台'
            )),
        array(
            'name' => $lang->_('nc_member'),
            'child' => array(
                'member' => $lang->_('nc_member_manage'),
                'member_exp' => '等级经验值',
                'points' => $lang->_('nc_member_pointsmanage'),
                'sns_sharesetting' => $lang->_('nc_binding_manage'),
                'sns_malbum' => $lang->_('nc_member_album_manage'),
                'snstrace' => $lang->_('nc_snstrace'),
                'sns_member' => $lang->_('nc_member_tag'),
                'predeposit' => $lang->_('nc_member_predepositmanage'),
                'reward_giveout' => $lang->_('nc_member_reward_giveout'),
                'reward_log' => $lang->_('nc_member_reward_log'),
                'chat_log' => '聊天记录'
            )),
        array(
            'name' => $lang->_('nc_trade'),
            'child' => array(
                'order' => $lang->_('nc_order_manage'),
                'vr_order' => '虚拟订单',
                'refund' => '退款管理',
                'return' => '退货管理',
                'vr_refund' => '虚拟订单退款',
                'consulting' => $lang->_('nc_consult_manage'),
                'inform' => $lang->_('nc_inform_config'),
                'evaluate' => $lang->_('nc_goods_evaluate'),
                //'complain' => $lang->_('nc_complain_config')
            )),
        /* array(
             'name' => $lang->_('nc_operation'),
             'child' => array(
                 'operating' => '运营设置',
                 'bill' => $lang->_('nc_bill_manage'),
                 'vr_bill' => '虚拟订单结算',
                 'mall_consult' => '平台客服',
                 'rechargecard' => '平台充值卡',
                 'delivery' => '物流自提服务站',
                 'contract' => '消费者保障服务'
             )),
         array(
             'name' => '促销',
             'child' => array(
                 'operation' => '促销设定',
                 'groupbuy' => $lang->_('nc_groupbuy_manage'),
                 'vr_groupbuy' => '虚拟抢购设置',
                 'promotion_cou' => '加价购',
                 'promotion_xianshi' => $lang->_('nc_promotion_xianshi'),
                 'promotion_mansong' => $lang->_('nc_promotion_mansong'),
                 'promotion_bundling' => $lang->_('nc_promotion_bundling'),
                 'promotion_booth' => '推荐展位',
                 'promotion_book' => '预售商品',
                 'promotion_fcode' => 'Ｆ码商品',
                 'promotion_combo' => '推荐组合',
                 'promotion_sole' => '手机专享',
                 'pointprod' => $lang->_('nc_pointprod'),
                 'voucher' => $lang->_('nc_voucher_price_manage'),
                 'redpacket' => '平台红包',
                 'activity' => $lang->_('nc_activity_manage')
             )),*/
        array(
            'name' => $lang->_('nc_stat'),
            'child' => array(
                'stat_general' => $lang->_('nc_statgeneral'),
                'stat_industry' => $lang->_('nc_statindustry'),
                'stat_member' => $lang->_('nc_statmember'),
                'stat_store' => $lang->_('nc_statstore'),
                'stat_trade' => $lang->_('nc_stattrade'),
                'stat_goods' => $lang->_('nc_statgoods'),
                //           'stat_marketing' => $lang->_('nc_statmarketing'),
                'stat_aftersale' => $lang->_('nc_stataftersale')
            ))
    ));
