<?php
/**
 * 账户余额及充值卡 预存款管理逻辑
 * User: Administrator
 * Date: 2016/12/8
 * Time: 17:59
 *
 * 采用的布局页：member_layout
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Tpl;
use Ypk\Validate;

class PredepositController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('member_predeposit');
    }

    /**
     * 充值添加
     */
    public function recharge_addAction()
    {
        if (!chksubmit()) {
            //信息输出
            self::profile_menu('recharge_add', 'recharge_add');
            //Tpl::showpage('predeposit.pd_add');
            $this->view->render('predeposit','pd_add');
            exit();
        }
        $pdr_amount = abs(floatval($_POST['pdr_amount']));
        if ($pdr_amount <= 0) {
            showMessage(getLang('predeposit_recharge_add_pricemin_error'), '', 'html', 'error');
        }
        $model_pdr = Model('predeposit');
        $data = array();
        $data['pdr_sn'] = $pay_sn = $model_pdr->makeSn();
        $data['pdr_member_id'] = getSession('member_id');
        $data['pdr_member_name'] = getSession('member_name');
        $data['pdr_amount'] = $pdr_amount;
        $data['pdr_add_time'] = TIMESTAMP;
        $insert = $model_pdr->addPdRecharge($data);
        if ($insert) {
            //转向到商城支付页面
            redirect(getUrl('shop/buy/pd_pay',array('pay_sn'=>$pay_sn)));
        }
    }

    /**
     * 平台充值卡
     */
    public function rechargecard_addAction()
    {
        if (!chksubmit()) {
            self::profile_menu('rechargecard_add', 'rechargecard_add');
            //Tpl::showpage('predeposit.rechargecard_add');
            $this->view->render('predeposit','rechargecard_add');
            return;
        }

        $sn = (string)$_POST['rc_sn'];
        if (!$sn || strlen($sn) > 50) {
            showMessage('平台充值卡卡号不能为空且长度不能大于50', '', 'html', 'error');
            exit;
        }

        try {
            model('predeposit')->addRechargeCard($sn, $_SESSION);
            showMessage('平台充值卡使用成功', getUrl('member/predeposit/rcb_log_list'));
        } catch (\Exception $e) {
            showMessage($e->getMessage(), '', 'html', 'error');
            exit;
        }
        $this->view->disable();
    }

    /**
     * 充值列表
     */
    public function indexAction()
    {
        $condition = array();
        $condition['pdr_member_id'] = getSession('member_id');
        if (!empty($_GET['pdr_sn'])) {
            $condition['pdr_sn'] = $_GET['pdr_sn'];
        }

        $model_pd = Model('predeposit');
        $list = $model_pd->getPdRechargeList($condition, 20, '*', 'pdr_id desc');

        self::profile_menu('log', 'recharge_list');
        Tpl::output('list', $list);
        Tpl::output('show_page', $model_pd->showpage());

        //Tpl::showpage('predeposit.pd_list');
        $this->view->render('predeposit','pd_list');
        $this->view->disable();
    }

    /**
     * 查看充值详细
     *
     */
    public function recharge_showAction()
    {
        $pdr_id = intval($_GET["id"]);
        if ($pdr_id <= 0) {
            showDialog(getLang('predeposit_parameter_error'), '', 'error');
        }

        $model_pd = Model('predeposit');
        $condition = array();
        $condition['pdr_member_id'] = getSession('member_id');
        $condition['pdr_id'] = $pdr_id;
        $condition['pdr_payment_state'] = 1;
        $info = $model_pd->getPdRechargeInfo($condition);
        if (!$info) {
            showDialog(getLang('predeposit_record_error'), '', 'error');
        }
        Tpl::output('info', $info);
        self::profile_menu('rechargeinfo', 'rechargeinfo');
        //Tpl::showpage('predeposit.pd_info');
        $this->view->render('predeposit','pd_info');
        $this->view->disable();
    }

    /**
     * 删除充值记录
     *
     */
    public function recharge_delAction()
    {
        $pdr_id = intval($_GET["id"]);
        if ($pdr_id <= 0) {
            showDialog(getLang('predeposit_parameter_error'), '', 'error');
        }

        $model_pd = Model('predeposit');
        $condition = array();
        $condition['pdr_member_id'] = getSession('member_id');
        $condition['pdr_id'] = $pdr_id;
        $condition['pdr_payment_state'] = 0;
        $result = $model_pd->delPdRecharge($condition);
        if ($result) {
            showDialog(getLang('nc_common_del_succ'), 'reload', 'succ', 'CUR_DIALOG.close()');
        } else {
            showDialog(getLang('nc_common_del_fail'), '', 'error');
        }
    }

    /**
     * 预存款变更日志
     */
    public function pd_log_listAction()
    {
        $model_pd = Model('predeposit');
        $condition = array();
        $condition['lg_member_id'] = getSession('member_id');
        $list = $model_pd->getPdLogList($condition, 20, '*', 'lg_id desc');

        //信息输出
        self::profile_menu('log', 'loglist');
        Tpl::output('show_page', $model_pd->showpage());
        Tpl::output('list', $list);
        //Tpl::showpage('predeposit.pd_log_list');
    }

    /**
     * 充值卡余额变更日志
     */
    public function rcb_log_listAction()
    {
        $model = Model();
        $list = $model->table('rcb_log')->where(array(
            'member_id' => getSession('member_id'),
        ))->page(20)->order('id desc')->select();

        //信息输出
        self::profile_menu('log', 'rcb_log_list');
        Tpl::output('show_page', $model->showpage());
        Tpl::output('list', $list);
        //Tpl::showpage('predeposit.rcb_log_list');
    }

    /**
     * 申请提现
     */
    public function pd_cash_addAction()
    {
        if (chksubmit()) {
            $obj_validate = new Validate();
            $pdc_amount = abs(floatval($_POST['pdc_amount']));
            $validate_arr[] = array("input" => $pdc_amount, "require" => "true", 'validator' => 'Compare', 'operator' => '>=', "to" => '0.01', "message" => getLang('predeposit_cash_add_pricemin_error'));
            $validate_arr[] = array("input" => $_POST["pdc_bank_name"], "require" => "true", "message" => getLang('predeposit_cash_add_shoukuanbanknull_error'));
            $validate_arr[] = array("input" => $_POST["pdc_bank_no"], "require" => "true", "message" => getLang('predeposit_cash_add_shoukuanaccountnull_error'));
            $validate_arr[] = array("input" => $_POST["pdc_bank_user"], "require" => "true", "message" => getLang('predeposit_cash_add_shoukuannamenull_error'));
            $validate_arr[] = array("input" => $_POST["password"], "require" => "true", "message" => '请输入支付密码');
            $obj_validate->validateparam = $validate_arr;
            $error = $obj_validate->validate();
            if ($error != '') {
                showDialog($error, '', 'error');
            }

            $model_pd = Model('predeposit');
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfoByID(getSession('member_id'));
            //验证支付密码
            if (md5($_POST['password']) != $member_info['member_paypwd']) {
                showDialog('支付密码错误', '', 'error');
            }
            //验证金额是否足够
            if (floatval($member_info['available_predeposit']) < $pdc_amount) {
                showDialog(getLang('predeposit_cash_shortprice_error'), getUrl('member/predeposit/pd_cash_list'), 'error');
            }
            try {
                $model_pd->beginTransaction();
                $pdc_sn = $model_pd->makeSn();
                $data = array();
                $data['pdc_sn'] = $pdc_sn;
                $data['pdc_member_id'] = getSession('member_id');
                $data['pdc_member_name'] = getSession('member_name');
                $data['pdc_amount'] = $pdc_amount;
                $data['pdc_bank_name'] = $_POST['pdc_bank_name'];
                $data['pdc_bank_no'] = $_POST['pdc_bank_no'];
                $data['pdc_bank_user'] = $_POST['pdc_bank_user'];
                $data['pdc_add_time'] = TIMESTAMP;
                $data['pdc_payment_state'] = 0;
                $insert = $model_pd->addPdCash($data);
                if (!$insert) {
                    throw new \Exception(getLang('predeposit_cash_add_fail'));
                }
                //冻结可用预存款
                $data = array();
                $data['member_id'] = $member_info['member_id'];
                $data['member_name'] = $member_info['member_name'];
                $data['amount'] = $pdc_amount;
                $data['order_sn'] = $pdc_sn;
                $model_pd->changePd('cash_apply', $data);
                $model_pd->commit();
                showDialog(getLang('predeposit_cash_add_success'), getUrl('member/predeposit/pd_cash_list'), 'succ', 'CUR_DIALOG.close()');
            } catch (\Exception $e) {
                $model_pd->rollback();
                showDialog($e->getMessage(), getUrl('member/predeposit/pd_cash_list'), 'error');
            }
        }
    }

    /**
     * 提现列表
     */
    public function pd_cash_listAction()
    {
        $condition = array();
        $condition['pdc_member_id'] = getSession('member_id');
        if (preg_match('/^\d+$/', $_GET['sn_search'])) {
            $condition['pdc_sn'] = $_GET['sn_search'];
        }
        if (isset($_GET['paystate_search'])) {
            $condition['pdc_payment_state'] = intval($_GET['paystate_search']);
        }
        $model_pd = Model('predeposit');
        $cash_list = $model_pd->getPdCashList($condition, 30, '*', 'pdc_id desc');

        self::profile_menu('log', 'cashlist');
        Tpl::output('list', $cash_list);
        Tpl::output('show_page', $model_pd->showpage());
        //Tpl::showpage('predeposit.pd_cash_list');
    }

    /**
     * 提现记录详细
     */
    public function pd_cash_infoAction()
    {
        $pdc_id = intval($_GET["id"]);
        if ($pdc_id <= 0) {
            showMessage(getLang('predeposit_parameter_error'), getUrl('member/predeposit/pd_cash_list'), 'html', 'error');
        }
        $model_pd = Model('predeposit');
        $condition = array();
        $condition['pdc_member_id'] = getSession('member_id');
        $condition['pdc_id'] = $pdc_id;
        $info = $model_pd->getPdCashInfo($condition);
        if (empty($info)) {
            showMessage(getLang('predeposit_record_error'), getUrl('member/predeposit/pd_cash_list'), 'html', 'error');
        }

        self::profile_menu('cashinfo', 'cashinfo');
        Tpl::output('info', $info);
        //Tpl::showpage('predeposit.pd_cash_info');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     */
    private function profile_menu($menu_type, $menu_key = '')
    {
        $menu_array = array(
            array('menu_key' => 'loglist', 'menu_name' => '账户余额', 'menu_url' => getUrl('shop/predeposit/pd_log_list')),
            array('menu_key' => 'recharge_list', 'menu_name' => '充值明细', 'menu_url' => getUrl('shop/predeposit/index')),
            //array('menu_key' => 'cashlist', 'menu_name' => '余额提现', 'menu_url' =>getUrl('shop/predeposit/pd_cash_list')),
            //array('menu_key' => 'rcb_log_list', 'menu_name' => '充值卡余额', 'menu_url' => getUrl('shop/predeposit/rcb_log_list')),
        );
        switch ($menu_type) {
            case 'rechargeinfo':
                $menu_array[] = array('menu_key' => 'rechargeinfo', 'menu_name' => '充值详细', 'menu_url' => '');
                break;
            case 'recharge_add':
                $menu_array[] = array('menu_key' => 'recharge_add', 'menu_name' => '在线充值', 'menu_url' => '');
                break;
            case 'rechargecard_add':
                $menu_array[] = array('menu_key' => 'rechargecard_add', 'menu_name' => '充值卡充值', 'menu_url' => 'javascript:;');
                break;
            case 'cashadd':
                $menu_array[] = array('menu_key' => 'cashadd', 'menu_name' => '提现申请', 'menu_url' => getUrl('member/predeposit/pd_cash_add'));
                break;
            case 'cashinfo':
                $menu_array[] = array('menu_key' => 'cashinfo', 'menu_name' => '提现详细', 'menu_url' => '');
                break;
            case 'log':
            default:
                break;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }
}