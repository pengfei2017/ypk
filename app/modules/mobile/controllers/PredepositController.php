<?php
/**
 * 账户余额及充值卡 预存款管理逻辑
 * User: Administrator
 * Date: 2016/12/8
 * Time: 17:59
 *
 * 采用的布局页：member_layout
 */
namespace Ypk\Modules\Mobile\Controllers;

use Ypk\Validate;

class PredepositController extends MobileMemberController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 充值添加
     */
    public function recharge_addAction()
    {
        // 验证充值数据
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input" => $_POST["pdr_amount"], "require" => "true", "message" => '充值金额不能为空')
        );
        $error = $obj_validate->validate();
        if ($error != '') {
            output_error($error);
        }

        $pdr_amount = abs(floatval($_POST['pdr_amount']));
        if ($pdr_amount <= 0) {
            output_error("充值金额为大于或者等于0.01的数字");
        }
        $model_pdr = Model('predeposit');
        $data = array();
        $data['pdr_sn'] = $pay_sn = $model_pdr->makeSn();
        $data['pdr_member_id'] = $this->member_info['member_id'];
        $data['pdr_member_name'] = $this->member_info['member_name'];
        $data['pdr_amount'] = $pdr_amount;
        $data['pdr_add_time'] = TIMESTAMP;
        $insert = $model_pdr->addPdRecharge($data);

        if ($insert) {
            //转向到商城支付页面
            output_data(array('pay_sn' => $pay_sn));
        } else {
            output_error('提交失败');
        }
    }
}