<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/23
 * Time: 11:24
 */

namespace Ypk\Modules\Member\Controllers;


use Phalcon\Mvc\Controller;
use Ypk\Model;
use Ypk\Tpl;

class BaseLoginController extends Controller
{
    /**
     * 语言包翻译对象
     */
    protected $translation;

    /**
     * 构造函数
     */
    public function initialize()
    {
        //读取通用、布局的语言包
        $this->translation = getTranslation('common');
        $this->view->setVar("lang", $this->translation);

        //指定布局文件
        //Tpl::setLayout('login_layout');

        //从缓存中获取导航
        $this->view->setVar('nav_list', read_file_cache('nav', true));

        //自动登录
        $this->auto_login();
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
            $message_model = Model('message');
            $countnum = $message_model->countNewMessage($this->session->get('member_id')); //根据会员id查询未读的新消息数量
            setMyCookie($cookie_name, $countnum . '', 2 * 3600);
        }
        //Tpl::output('message_num',$countnum);
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
        $model_class = new \Ypk\Logic\GoodsclassLogic();
        //$goods_class = $model_class->get_all_category(1);
        //$this->view->setVar('show_goods_class', $goods_class);
        $goodsClassList = $model_class->getAllGoodsClassNav(); //获取所有的商品分类及推荐分类信息
        $this->view->setVar('goodsClassList', $goodsClassList);

        //获取导航
        $this->view->setVar('nav_list', read_file_cache('nav', true));
        //查询保障服务项目
        $this->view->setVar('contract_list', (new \Ypk\Logic\ContractLogic())->getContractItemByCache());
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
        if ($this->session->get('member_id')) {
            $model_member = new \Ypk\Logic\MemberLogic();
            $member_info = $model_member->getMemberInfoByID($this->session->get('member_id'));
            if ($member_info) {
                $member_gradeinfo = $model_member->getOneMemberGrade(intval($member_info['member_exppoints']));
                $member_info = array_merge($member_info, $member_gradeinfo);
                $member_info['security_level'] = $model_member->getMemberSecurityLevel($member_info);
            }
        }
        if ($is_return == true) {//返回会员信息
            return $member_info;
        } else {//输出会员信息
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
            if (trim($_GET['op']) == 'favoritegoods' || trim($_GET['op']) == 'favoritestore') {
                $lang = getTranslation('UTF-8');
                echo json_encode(array('done' => false, 'msg' => $lang['no_login']));
                die;
            }
            $ref_url = getFullPageUri(); //获取当前页面的地址
            if ($_GET['inajax']) {
                $this->showDialog('', '', 'js', "login_dialog();", 200);
            } else {
                @header("location: " . getUrl('shop/login/index', array('ref_url' => $ref_url)));
            }
            exit;
        }
    }

    /**
     * 文章输出
     */
    protected function article()
    {

        if (getConfig('cache_open')) {
            if ($article = read_file_cache("article")) {
                $this->view->setVar('show_article', $article['show_article']);
                $this->view->setVar('article_list', $article['article_list']);
                return;
            }
        } else {
            if (file_exists(BASE_PATH . '/cache/index/article.php')) {
                include(BASE_PATH . '/cache/index/article.php');
                $this->view->setVar('show_article', $show_article);
                $this->view->setVar('article_list', $article_list);
                return;
            }
        }

        $model_article_class = new \Ypk\Logic\ArticleClassLogic();
        $model_article = new \Ypk\Logic\ArticleLogic();
        $show_article = array();//商城公告
        $article_list = array();//下方文章
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
        $article_array = array();//$model_article->getJoinList($condition);

        $res = $this->modelsManager->createBuilder()
            ->addFrom('Ypk\Models\Article', 'article')
            ->columns($condition['field'])//字符串形式
            ->innerJoin('Ypk\Models\ArticleClass', 'article.ac_id=article_class.ac_id', 'article_class')
            ->andWhere('article.article_show=1')//条件必须是字符串形式
            ->orderBy('article.article_sort asc,article.article_time desc')
            ->limit(300, 0)//第一个参数表示页容量，第二个参数表示偏移量
            ->getQuery()
            ->execute();
        if (count($res) > 0) {
            $article_array = $res->toArray();
        }

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
            ));
        } else {
            $string = "<?php\n\$show_article=" . var_export($show_article, true) . ";\n";
            $string .= "\$article_list=" . var_export($article_list, true) . ";\n?>";

            write_file_cache('article', $string, null, 'index/'); //写入缓存
            //$filePath=BASE_PATH . '/cache/index/article.php';
            //mkdir(BASE_PATH.'/cache/index');
            //if(!file_exists($filePath)){
            //    $fp=fopen($filePath,'W+');
            //}
            //file_put_contents(BASE_PATH . '/cache/index/article.php', ($string));
        }
        $this->view->setVar('show_article', $show_article);
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