<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/22
 * Time: 22:09
 */

namespace Ypk;

/**
 * hpf
 *
 * Class Chat
 * @package Ypk
 */
class Chat
{
    public static function getChatHtml($layout)
    {
        $web_html = '';
        if ($layout != 'msg_layout' && $layout != 'store_joinin_layout') {
            $avatar = getMemberAvatar(getSession('avatar'));
            $store_avatar = getStoreLogo(getSession('store_avatar'));
            $url_param_array = getUrlParamArray();
            $nchash = getHash($url_param_array['controller'], $url_param_array['action']);
            $formhash = Security::getTokenValue();
            $chat_resource_url = CHAT_RESOURCE_URL;
            $app_url = LOGIN_SITE_URL;
            $chat_url = CHAT_SITE_URL;
            $node_url = NODE_SITE_URL;
            $shop_url = SHOP_SITE_URL;
            $goods_id = intval($_GET['goods_id']);

            $member_id = getSession('member_id');
            $member_name = getSession('member_name');
            $store_id = getSession('store_id');
            $store_name = getSession('store_name');
            if (!empty(getSession('member_chat_card'))) {
                $member_chat_card = json_encode(getSession('member_chat_card'));
            } else {
                $member_chat_card = json_encode(array());
            }

            $web_html = <<<EOT
                    <link href="{$chat_resource_url}/css/chat.css" rel="stylesheet" type="text/css">
                    <div style="clear: both;"></div>
                    <div id="web_chat_dialog" style="display: none;float:right;">
                    </div>
                    <a id="chat_login" href="javascript:void(0)" style="display: none;"></a>
                    <script type="text/javascript">
                    var LOGIN_SITE_URL = '{$app_url}';
                    var CHAT_RESOURCE_URL = '{$chat_resource_url}';
                    var CHAT_SITE_URL = '{$chat_url}';
                    var SHOP_SITE_URL = '{$shop_url}';
                    var connect_url = "{$node_url}";

                    var layout = "{$layout}";
                    var act_op = "{$url_param_array['controller']}_{$url_param_array['action']}"; //to
                    var chat_goods_id = "{$goods_id}";
                    var user = {};

                    user['u_id'] = "{$member_id}";
                    user['u_name'] = "{$member_name}";
                    user['s_id'] = "{$store_id}";
                    user['s_name'] = "{$store_name}";
                    user['member_chat_card'] = '{$member_chat_card}';
                    user['s_avatar'] = "{$store_avatar}";
                    user['avatar'] = "{$avatar}";

                    $("#chat_login").nc_login({
                      nchash:'{$nchash}',
                      formhash:'{$formhash}'
                    });
                    </script>
EOT;
            if (defined('APP_ID') && APP_ID != 'shop') {
                $web_html .= '<link href="' . RESOURCE_SITE_URL . '/js/perfect-scrollbar.min.css" rel="stylesheet" type="text/css">';
                $web_html .= '<script type="text/javascript" src="' . RESOURCE_SITE_URL . '/js/perfect-scrollbar.min.js"></script>';
                $web_html .= '<script type="text/javascript" src="' . RESOURCE_SITE_URL . '/js/jquery.mousewheel.js"></script>';
            }
            $web_html .= '<script type="text/javascript" src="' . RESOURCE_SITE_URL . '/js/jquery.charCount.js" charset="utf-8"></script>';
            $web_html .= '<script type="text/javascript" src="' . RESOURCE_SITE_URL . '/js/jquery.smilies.js" charset="utf-8"></script>';
            $web_html .= '<script type="text/javascript" src="' . CHAT_RESOURCE_URL . '/js/user.js" charset="utf-8"></script>';

        }
        if ($layout == 'seller_layout') {
            $web_html .= '<script type="text/javascript" src="' . CHAT_RESOURCE_URL . '/js/store.js" charset="utf-8"></script>';
            $seller_smt_limits = '';
            if (!empty(getSession('seller_smt_limits')) && is_array(getSession('seller_smt_limits'))) {
                $seller_smt_limits = implode(',', getSession('seller_smt_limits'));
            }
            $seller_id = getSession('seller_id');
            $seller_name = getSession('seller_name');
            $seller_is_admin = getSession('seller_is_admin');
            $web_html .= <<<EOT
					<script type="text/javascript">
					user['seller_id'] = "{$seller_id}";
					user['seller_name'] = "{$seller_name}";
					user['seller_is_admin'] = "{$seller_is_admin}";
					var smt_limits = "{$seller_smt_limits}";
					</script>
EOT;
        }

        return $web_html;
    }
}