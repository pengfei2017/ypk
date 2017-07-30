<?php
namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model\Query;
use Ypk\Logic\MessageLogic;
use Ypk\Models\Article;
use Ypk\Models\MemberChatCard;
use Ypk\Tpl;

/**
 * 前台总控制器父类
 *
 * Class ControllerBase
 */
class ControllerBase extends Controller
{
    /**
     * 语言包翻译对象
     */
    protected $translation;

    protected function initialize()
    {
        /**
         * php 判断访问来源是否手机浏览器并自动跳转的代码
         */
        if (defined('WAP_SITE_URL') && isset($_SERVER['HTTP_USER_AGENT'])) {
            $agent = $_SERVER['HTTP_USER_AGENT'];
            $url = WAP_SITE_URL;
            if (strpos($agent, "comFront") !== false || strpos($agent, "iPhone") !== false || strpos($agent, "MIDP-2.0") !== false || strpos($agent, "Opera Mini") !== false || strpos($agent, "UCWEB") !== false || strpos($agent, "Android") !== false || strpos($agent, "Windows Phone OS") !== false || strpos($agent, "Windows CE") !== false || strpos($agent, "SymbianOS") !== false) {
                //也许电脑和手机端H5在聊天时，电脑端给手机端发送一个电脑端的链接，这时用户点开链接看到的是电脑端布局，所以自动帮用户转化为手机端页面，
                //一般聊天时会发送商品详情页、医生列表、医生详情页
                $urlparamarray = getUrlParamArray();
                if ($urlparamarray['module'] == 'shop') {
                    switch ($urlparamarray['controller']) {
                        case 'goods':
                            $url .= '/js_template/product_detail.html?goods_id=' . $_GET['goods_id'];
                            break;
                        case 'store_list':
                            $url .= '/shop.html';
                            break;
                        case 'show_store':
                            $url .= '/js_template/store.html?store_id=' . $_GET['store_id'];
                            break;
                    }
                }
                header('Location:' . $url);
                exit();
            }
        }

        $controller_name = $this->dispatcher->getControllerName();
        $action_name = $this->dispatcher->getActionName();
        if ($controller_name != "index" && $action_name != 'uploadQualification') { //表示访问的是非首页的页面，必须判断是否登录
            if (intval(getSession('is_login')) !== 1) { //表示还没有登录
                showMessage("请先登录", getUrl('member/login/index'), 'html');
            }
        }

        //查询当前用户没有用过的聊天凭证
        if (!empty(getSession('member_id'))) {
            $member_chat_card = MemberChatCard::find(array('member_id = ' . getSession('member_id') . ' and is_use = 0 and card_type = 0 and chat_card_end_time > ' . time(), 'order' => 'how_lang_time,id'));
            if ($member_chat_card !== false) {
                setSession('member_chat_card', $member_chat_card->toArray());
            }
        }

    }

    /**
     * 输出信息
     *
     * @param string $msg 输出信息
     * @param string /array $url 跳转地址 当$url为数组时，结构为 array('msg'=>'跳转连接文字','url'=>'跳转连接');
     * @param string $show_type 输出格式 默认为html
     * @param string $msg_type 信息类型 succ 为成功，error为失败/错误
     * @param int $is_show 是否显示跳转链接，默认是为1，显示
     * @param string $admin_index_extrajs 要传递到admin/index/index页面执行的扩展JS
     * @param int $time 跳转时间，默认为2秒
     */
    protected final function showMessage($msg, $url = '', $show_type = 'html', $msg_type = 'succ', $is_show = 1, $admin_index_extrajs = '', $time = 2000)
    {
        showMessage($msg, $url, $show_type, $msg_type, $is_show, $admin_index_extrajs, $time);
    }

    /**
     * 消息提示，主要适用于普通页面AJAX提交的情况
     *
     * @param string $message 消息内容
     * @param string $url 提示完后的URL去向
     * @param string $alert_type 提示类型 error/succ/notice 分别为错误/成功/警示
     * @param string $extrajs 扩展JS
     * @param int $time 停留时间
     */
    protected final function showDialog($message = '', $url = '', $alert_type = 'error', $extrajs = '', $time = 2)
    {
        showDialog($message, $url, $alert_type, $extrajs, $time);
    }

    /**
     * 检查短消息数量
     *
     */
    protected function checkMessage()
    {
        if ($this->session->get('member_id') == '') return;
        //判断cookie是否存在
        $cookie_name = 'msgnewnum' . $this->session->get('member_id'); //获取会员名称
        if (cookie($cookie_name) != null) {
            $countnum = intval(cookie($cookie_name));
        } else {
            $message_model = new MessageLogic();
            $countnum = $message_model->countNewMessage($this->session->get('member_id')); //根据会员id查询未读的新消息数量
            setMyCookie($cookie_name, $countnum . '', 2 * 3600); //保存2小时
        }
        Tpl::output('message_num', $countnum);
        $this->view->setVar('message_num', $countnum);
    }

    /**
     *  输出头部的公用信息
     *
     */
    protected function showLayout()
    {
        $this->checkMessage();//短消息检查
        $this->article();//文章输出

        $this->showCartCount();

        //热门搜索
        $this->view->setVar('hot_search', @explode(',', getConfig('hot_search')));
        $rec_search_list = array();
        if (getConfig('rec_search') != '') {
            $rec_search_list = @unserialize(getConfig('rec_search'));
        }
        $this->view->setVar('rec_search_list', is_array($rec_search_list) ? $rec_search_list : array());

        //历史搜索
        $his_search_list = array();
        if (cookie('his_sh') != '') {
            $his_search_list = explode('~', cookie('his_sh'));
        }
        $this->view->setVar('his_search_list', is_array($his_search_list) ? $his_search_list : array());

        //输出商品分类
        $model_class = Model('goods_class');
        $goods_class = $model_class->get_all_category();
        $this->view->setVar('goodsClassList', $goods_class);
        //下面三行是常国写的
        //$model_class = new \Ypk\Logic\GoodsclassLogic();
        //$goodsClassList = $model_class->getAllGoodsClassNav(); //获取所有的商品分类及推荐分类信息
        //$this->view->setVar('goodsClassList', $goodsClassList);

        //获取页面底部导航
        $nav_list = read_file_cache('nav', true);
        $this->view->setVar('nav_list', $nav_list);
        Tpl::output("nav_list", $nav_list);
        //查询保障服务项目
        $contract_list = Model('contract')->getContractItemByCache();
        Tpl::output('contract_list', $contract_list);
        $this->view->setVar('contract_list', $contract_list);
    }

    /**
     * 显示购物车数量
     */
    protected function showCartCount()
    {
        if (cookie('cart_goods_num') != null) {
            $cart_num = intval(cookie('cart_goods_num'));
        } else {
            //已登录状态，存入数据库,未登录时，优先存入缓存，否则存入COOKIE
            if ($this->session->get('member_id')) {
                $save_type = 'db';
            } else {
                $save_type = 'cookie';
            }
            $cart_num = (new \Ypk\Logic\CartLogic())->getCartNum($save_type, array('buyer_id' => $this->session->get('member_id')));//查询购物车商品种类
        }
        $this->view->setVar('cart_goods_num', $cart_num);
    }

    /**
     * 输出会员等级
     * @param bool $is_return 是否返回会员信息，返回为true，输出会员信息为false
     * @return array
     */
    protected function getMemberAndGradeInfo($is_return = false)
    {
        $member_info = array();
        //会员详情及会员级别处理
        if (getSession('member_id')) {
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfoByID(getSession('member_id'));
            if ($member_info) {
                $member_gradeinfo = $model_member->getOneMemberGrade(intval($member_info['member_exppoints']));
                $member_info = array_merge($member_info, $member_gradeinfo);
                $member_info['security_level'] = $model_member->getMemberSecurityLevel($member_info);
            }
        }
        if ($is_return == true) {//返回会员信息
            return $member_info;
        } else {//输出会员信息
            Tpl::output('member_info', $member_info);
            $this->view->setVar('member_info', $member_info);
        }
    }

    /**
     * 验证会员是否登录
     *
     */
    protected function checkLogin()
    {
        if (intval(getSession('is_login')) !== 1) {
            $ref_url = getReferer();
            if ($_GET['inajax']) {
                showDialog('', '', 'js', "login_dialog();", 200);
            } else {
                @header("location: " . getUrl('member/login/index', array('ref_url' => $ref_url)));
            }
            exit;
        }
    }

    /**
     * 文章输出
     */
    protected function article()
    {
        $show_article = array();//商城公告
        $article_list = array();//下方文章

        if (getConfig('cache_open')) {
            if ($article = read_file_cache("index/article")) {
                $this->view->setVar('show_article', $article['show_article']);
                Tpl::output('show_article', $article['show_article']);
                $this->view->setVar('article_list', $article['article_list']);
                Tpl::output('article_list', $article['article_list']);
                return;
            }
        } else {
            if (file_exists(MODULE_PATH . '/include/article.php')) {
                include(MODULE_PATH . '/include/article.php');
                Tpl::output('show_article', $show_article);
                $this->view->setVar('show_article', $show_article);
                Tpl::output('article_list', $article_list);
                $this->view->setVar('article_list', $article_list);
                return;
            }
        }

        $model_article_class = Model('article_class');
        $model_article = Model('article');

        $notice_class = array('notice');
        $code_array = array('member', 'payment', 'sold', 'service');
        $notice_limit = 4;
        $faq_limit = 5;

        $class_condition = array();
        $class_condition['home_index'] = 'home_index';
        $class_condition['order'] = 'ac_sort asc';
        $article_class = $model_article_class->getClassList($class_condition);
        $class_list = array();
        if (!empty($article_class) && is_array($article_class)) {
            foreach ($article_class as $key => $val) {
                $ac_code = $val['ac_code'];
                $ac_id = $val['ac_id'];
                $val['list'] = array();//文章
                $class_list[$ac_id] = $val;
            }
        }

        $condition = array();
        $condition['article_show'] = '1';
        $condition['field'] = 'article.article_id,article.ac_id,article.article_url,article_class.ac_code,article.article_position,article.article_title,article.article_time,article_class.ac_name,article_class.ac_parent_id';
        $condition['order'] = 'article_sort asc,article_time desc';
        $condition['limit'] = '300';
        $article_array = $model_article->getJoinList($condition);
        if (!empty($article_array) && is_array($article_array)) {
            foreach ($article_array as $key => $val) {
                if ($val['ac_code'] == 'notice' && !in_array($val['article_position'], array(ARTICLE_POSIT_SHOP, ARTICLE_POSIT_ALL))) continue;
                $ac_id = $val['ac_id'];
                $ac_parent_id = $val['ac_parent_id'];
                if ($ac_parent_id == 0) {//顶级分类
                    $class_list[$ac_id]['list'][] = $val;
                } else {
                    $class_list[$ac_parent_id]['list'][] = $val;
                }
            }
        }
        if (!empty($class_list) && is_array($class_list)) {
            foreach ($class_list as $key => $val) {
                $ac_code = $val['ac_code'];
                if (in_array($ac_code, $notice_class)) {
                    $list = $val['list'];
                    array_splice($list, $notice_limit);
                    $val['list'] = $list;
                    $show_article[$ac_code] = $val;
                }
                if (in_array($ac_code, $code_array)) {
                    $list = $val['list'];
                    $val['class']['ac_name'] = $val['ac_name'];
                    array_splice($list, $faq_limit);
                    $val['list'] = $list;
                    $article_list[] = $val;
                }
            }
        }
        if (getConfig('cache_open')) {
            write_file_cache('index/article', array(
                'show_article' => $show_article,
                'article_list' => $article_list,
            ));
        } else {
            $string = "<?php\n\$show_article=" . var_export($show_article, true) . ";\n";
            $string .= "\$article_list=" . var_export($article_list, true) . ";\n?>";
            file_put_contents(MODULE_PATH . '/include/article.php', ($string));
        }

        Tpl::output('show_article', $show_article);
        $this->view->setVar('show_article', $show_article);
        Tpl::output('article_list', $article_list);
        $this->view->setVar('article_list', $article_list);
    }

    /**
     * 自动登录
     */
    protected function auto_login()
    {
        $data = cookie('auto_login');
        if (empty($data)) {
            return false;
        }
        $model_member = new \Ypk\Logic\MemberLogic();
        if ($this->session->get('is_login')) {
            $model_member->auto_login();
        }
        $member_id = intval(decrypt($data, MD5_KEY));
        if ($member_id <= 0) {
            return false;
        }
        $member_info = $model_member->getMemberInfoByID($member_id);
        $model_member->createSession($member_info);
    }
}