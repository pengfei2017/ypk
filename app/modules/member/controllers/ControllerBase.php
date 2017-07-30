<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/3
 * Time: 23:39
 */

namespace Ypk\Modules\Member\Controllers;


use Phalcon\Mvc\Controller;
use Ypk\Tpl;

class ControllerBase extends Controller
{
    /**
     * 检查短消息数量
     *
     */
    protected function checkMessage()
    {
        if (getSession('member_id') == '') return;
        //判断cookie是否存在
        $cookie_name = 'msgnewnum' . getSession('member_id');
        if (cookie($cookie_name) != null) {
            $countnum = intval(cookie($cookie_name));
        } else {
            $message_model = Model('message');
            $countnum = $message_model->countNewMessage(getSession('member_id'));
            setMyCookie($cookie_name, $countnum . '', 2 * 3600);//保存2小时
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

        $this->showCartCount();

        //热门搜索
        Tpl::output('hot_search', @explode(',', getConfig('hot_search')));
        $this->view->setVar('hot_search', @explode(',', getConfig('hot_search')));
        if (getConfig('rec_search') != '') {
            $rec_search_list = @unserialize(getConfig('rec_search'));
        }
        Tpl::output('rec_search_list', is_array($rec_search_list) ? $rec_search_list : array());
        $this->view->setVar('rec_search_list', is_array($rec_search_list) ? $rec_search_list : array());

        //历史搜索
        if (cookie('his_sh') != '') {
            $his_search_list = explode('~', cookie('his_sh'));
        }
        Tpl::output('his_search_list', is_array($his_search_list) ? $his_search_list : array());
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
        Tpl::output('nav_list', read_file_cache('nav', true));
        $this->view->setVar('nav_list', read_file_cache('nav', true));

        //查询保障服务项目
        Tpl::output('contract_list', Model('contract')->getContractItemByCache());
        $this->view->setVar('contract_list', Model('contract')->getContractItemByCache());
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
            if (getSession('member_id')) {
                $save_type = 'db';
            } else {
                $save_type = 'cookie';
            }
            $cart_num = Model('cart')->getCartNum($save_type, array('buyer_id' => getSession('member_id')));//查询购物车商品种类
        }
        Tpl::output('cart_goods_num', $cart_num);
        $this->view->setVar('cart_goods_num', $cart_num);
    }

    /**
     * 系统公告
     */
    protected function system_notice()
    {
        $model_message = Model('article');
        $condition = array();
        $condition['ac_id'] = 1;
        $condition['article_position_in'] = ARTICLE_POSIT_ALL . ',' . ARTICLE_POSIT_BUYER;
        $condition['limit'] = 5;
        $article_list = $model_message->getArticleList($condition);
        Tpl::output('system_notice', $article_list);
        $this->view->setVar('system_notice', $article_list);
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
                $member_info['voucher_count'] = Model('voucher')->getCurrentAvailableVoucherCount(getSession('member_id'));
                $member_info['redpacket_count'] = Model('redpacket')->getCurrentAvailableRedpacketCount(getSession('member_id'));
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
        $show_article = '';
        $article_list = '';
        if (getConfig('cache_open')) {
            if ($article = read_file_cache("index/article")) {
                Tpl::output('show_article', $article['show_article']);
                Tpl::output('article_list', $article['article_list']);
                return;
            }
        } else {
            if (file_exists(BASE_PATH . '/cache/index/article.php')) {
                include(BASE_PATH . '/cache/index/article.php');
                Tpl::output('show_article', $show_article);
                Tpl::output('article_list', $article_list);
                return;
            }
        }

        $model_article_class = Model('article_class');
        $model_article = Model('article');
        $show_article = array();//商城公告
        $article_list = array();//下方文章
        $notice_class = array('notice');
        //$code_array = array('member', 'store', 'payment', 'sold', 'service', 'about');
        $code_array = array('member', 'payment', 'sold', 'service'); //设置要显示的导航类目，想要谁显示，只许把类目名加到该数组即可
        $notice_limit = 5;
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
            write_file_cache('article', array(
                'show_article' => $show_article,
                'article_list' => $article_list,
            ), null, 'index/');
        }

        Tpl::output('show_article', $show_article);
        Tpl::output('article_list', $article_list);
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
        $model_member = Model('member');
        if (getSession('is_login')) {
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