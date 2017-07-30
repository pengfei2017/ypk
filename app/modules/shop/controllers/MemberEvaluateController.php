<?php
/**
 * 用户评价.
 * User: Administrator
 * Date: 2016/12/10
 * Time: 12:47
 *
 * 采用的布局页面：member_layout
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Log;
use Ypk\Models\CaseHistory;
use Ypk\Models\Goods;
use Ypk\Tpl;

class MemberEvaluateController extends BaseMemberController
{

    public function initialize()
    {
        parent::initialize();
        getTranslation('member_layout,member_evaluate,member_store_goods_index');
        Tpl::output('pj_act', 'member_evaluate');
    }

    /**
     * 订单添加评价
     */
    public function addAction()
    {
        $order_id = intval($_GET['order_id']); //订单id
        $return = Logic('member_evaluate')->validation($order_id, getSession('member_id'));
        if (!$return['state']) {
            showMessage($return['msg'], getUrl('shop/member_order'), 'html', 'error');
        }
        extract($return['data']);
        //判断是否提交
        if (chksubmit()) {
            $return = Logic('member_evaluate')->save($_POST, $order_info, $store_info, $order_goods, $this->member_info['member_id'], $this->member_info['member_name']);
            if (!$return['state']) {
                showDialog($return['msg'], 'reload', 'error');
            } else {
                showDialog(getLang('member_evaluation_evaluat_success'), getUrl('shop/member_order'), 'succ');
            }
        } else {
            //处理积分、经验值计算说明文字
            $ruleexplain = '';
            $exppoints_rule = getConfig("exppoints_rule") ? unserialize(getConfig("exppoints_rule")) : array();
            $exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
            $points_comments = intval(getConfig('points_comments'));
            if ($exppoints_rule['exp_comments'] > 0 || $points_comments > 0) {
                $ruleexplain .= '评价完成将获得';
                if ($exppoints_rule['exp_comments'] > 0) {
                    $ruleexplain .= (' “' . $exppoints_rule['exp_comments'] . '经验值”');
                }
                if ($points_comments > 0) {
                    $ruleexplain .= (' “' . $points_comments . '积分”');
                }
                $ruleexplain .= '。';
            }
            Tpl::output('ruleexplain', $ruleexplain);

            $model_sns_alumb = Model('sns_album');
            $ac_id = $model_sns_alumb->getSnsAlbumClassDefault(getSession('member_id'));
            Tpl::output('ac_id', $ac_id);

            //不显示左菜单
            Tpl::output('left_show', 'order_view');
            Tpl::output('order_info', $order_info);
            Tpl::output('order_goods', $order_goods);
            Tpl::output('store_info', $store_info);
            //Tpl::showpage('evaluation.add');

//            $btn_str = "";
//            if (count($order_goods) > 0) {
//                foreach ($order_goods as $order_goods_info) {
//                    $goods_info = Goods::findFirst("goods_id=" . $order_goods_info['goods_id']);
//                    if ($goods_info !== false) {
//                        $goods_info = $goods_info->toArray();
//                        if ($goods_info['gc_id_1'] == 1073) {
//                            $btn_str .= "<label class=\"submit-border\">";
//                            $btn_str .= "<input id=\"add_case_history\" data-orderid='" . $order_id . "' data-storeid='" . $store_info['store_id'] . "' onclick='uploadCaseHistory(this)' type=\"button\" class=\"submit\" value=\"上传病历\"/>";
//                            $btn_str .= "</label>";
//                            break;
//                        }
//                    }
//                }
//            }
//            Tpl::output("btn_str", $btn_str);

            $this->view->render('member_evaluate', 'evaluation_add');
            $this->view->disable();
        }
    }

    /**
     * 订单添加评价
     */
    public function add_againAction()
    {
        $order_id = intval($_GET['order_id']);
        $return = Logic('member_evaluate')->validationAgain($order_id, getSession('member_id'));
        if (!$return['state']) {
            showMessage($return['msg'], getUrl('shop/member_order'), 'html', 'error');
        }
        extract($return['data']);

        //判断是否提交
        if (chksubmit()) {
            $return = Logic('member_evaluate')->saveAgain($_POST, $order_info, $evaluate_goods);
            if (!$return['state']) {
                showDialog($return['msg'], 'reload', 'error');
            } else {
                showDialog(getLang('member_evaluation_evaluat_success'), getUrl('shop/member_order'), 'succ');
            }
        } else {
            $model_sns_alumb = Model('sns_album');
            $ac_id = $model_sns_alumb->getSnsAlbumClassDefault(getSession('member_id'));
            Tpl::output('ac_id', $ac_id);

            //不显示左菜单
            Tpl::output('left_show', 'order_view');
            Tpl::output('order_info', $order_info);
            Tpl::output('evaluate_goods', $evaluate_goods);
            Tpl::output('store_info', $store_info);
            //Tpl::showpage('evaluation.add_again');
            $this->view->render('member_evaluate', 'evaluation_add_again');
            $this->view->disable();
        }
    }

    /**
     * 虚拟商品评价
     */
    public function add_vrAction()
    {
        $order_id = intval($_GET['order_id']);
        $return = Logic('member_evaluate')->validationVr($order_id, getSession('member_id'));
        if (!$return['state']) {
            showMessage($return['msg'], getUrl('shop/member_vr_order'), 'html', 'error');
        }
        extract($return['data']);
        //判断是否为页面
        if (!$_POST) {
            $order_goods[] = $order_info;
            //处理积分、经验值计算说明文字
            $ruleexplain = '';
            $exppoints_rule = getConfig("exppoints_rule") ? unserialize(getConfig("exppoints_rule")) : array();
            $exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
            $points_comments = intval(getConfig('points_comments'));
            if ($exppoints_rule['exp_comments'] > 0 || $points_comments > 0) {
                $ruleexplain .= '评价完成将获得';
                if ($exppoints_rule['exp_comments'] > 0) {
                    $ruleexplain .= (' “' . $exppoints_rule['exp_comments'] . '经验值”');
                }
                if ($points_comments > 0) {
                    $ruleexplain .= (' “' . $points_comments . '积分”');
                }
                $ruleexplain .= '。';
            }
            Tpl::output('ruleexplain', $ruleexplain);

            //不显示左菜单
            Tpl::output('left_show', 'order_view');
            Tpl::output('order_info', $order_info);
            Tpl::output('order_goods', $order_goods);
            Tpl::output('store_info', $store_info);
            //Tpl::showpage('evaluation.add');
            $this->view->render('member_evaluate', 'evaluation_add');
            $this->view->disable();
        } else {
            $return = Logic('member_evaluate')->saveVr($_POST, $order_info, $store_info, getSession('member_id'), getSession('member_name'));
            if (!$return['state']) {
                showDialog($return['msg'], 'reload', 'error');
            } else {
                showDialog(getLang('member_evaluation_evaluat_success'), getUrl('shop/member_vr_order'), 'succ');
            }
        }
        $this->view->disable();
    }

    /**
     * 评价列表
     */
    public function listAction()
    {
        $model_evaluate_goods = Model('evaluate_goods');

        $condition = array();
        $condition['geval_frommemberid'] = getSession('member_id');
        $goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($condition, 10);
        Tpl::output('goodsevallist', $goodsevallist);
        Tpl::output('show_page', $model_evaluate_goods->showpage());

        //Tpl::showpage('evaluation.index');
        $this->view->render('member_evaluate', 'evaluation_index');
        $this->view->disable();
    }

    /**
     * 上传病历展示页面
     */
    public function upload_case_historyAction()
    {
        $order_id = $_REQUEST['order_id']; //订单id
        $store_id = $_REQUEST['store_id']; //店铺id
        Tpl::output('order_id', $order_id);
        Tpl::output('store_id', $store_id);
    }

    /**
     * 保存上传的病历
     */
    public function save_case_historyAction()
    {
        $arr = array(
            'member_id' => getSession('member_id'),
            'store_id' => $_POST['store_id'],
            'case_content' => $_POST['g_body'],
            'is_public' => $_POST['privacy'],
            'order_id' => $_POST['order_id'],
            'title' => empty($_POST['title']) ? "匿名" : $_POST['title'],
            'add_time' => time()
        );
        $model = CaseHistory::findFirst("member_id=" . getSession('member_id')." and order_id=".$_POST['order_id']);
        if ($model === false) {
            $model = new CaseHistory();
        }
        if ($model->save($arr) === false) {
            Log::record(getSession('member_id') . "上传病历失败，数据是：" . json_encode($arr));
            showMessage('保存失败', '', '', 'error');
        }
        showMessage('保存成功');
    }
}