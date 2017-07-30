<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/7
 * Time: 21:04
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\Member;
use Ypk\Models\StoreJoinin;
use Ypk\Tpl;

class ComputeInfoController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('member_home_member,member_home_member,cut');
    }

    /**
     * 完善资料
     */
    public function computeinfoAction()
    {
        if (!empty($_POST['form_submit']) && $_POST['form_submit'] == 'ok') {
            $param = array();
            $param['member_name'] = getSession('member_name'); //用户名
            $param['business_sphere'] = $_POST['member_truename']; //医生真实姓名
            $param['contacts_name'] = $_POST['member_truename']; //联系人姓名
            $param['business_departments'] = $_POST['business_departments']; //科室
            $param['business_professional'] = $_POST['business_professional']; //职称
            $param['business_lockHospital'] = $_POST['business_lockHospital']; //定点医院
            $param['company_name'] = $_POST['business_lockHospital']; //单位名称
            $param['business_activeHospital'] = empty($_POST['business_activeHospital']) ? " " : $_POST['business_activeHospital']; //活动医院
            $param['company_address'] = $_POST['company_address']; //地区（省市县三级形式）
            $param['company_address_detail'] = $_POST['company_address_detail']; //详细地址
            $param['business_idcard_number'] = empty($_POST['business_idcard_number']) ? " " : $_POST['business_idcard_number']; //身份证号码
            $param['mail_content'] = $_POST['mail_content']; //个人简介
            $param['joinin_year'] = 1; //加入时长（单位：年）
            $param['store_class_commis_rates'] = 0;
            $param['sc_id'] = 0;
            if (StoreJoinin::count("member_id=" . getSession('member_id')) <= 0) { //表示新增
                $param['member_id'] = getSession('member_id');
                $store_join_model = new StoreJoinin();
                if ($store_join_model->save($param) === false) {
                    showDialog("保存失败");
                } else {
                    //修改member表中的真实姓名
                    $member_info = Member::findFirst("member_id=" . getSession('member_id'));
                    if ($member_info !== false) {
                        $member_info->save(array('member_truename' => $_POST['member_truename']));
                    }
                    showDialog("保存成功");
                }
            } else { //表示修改
                $res = StoreJoinin::findFirst("member_id=" . getSession('member_id'));
                if ($res->save($param) === false) {
                    showDialog("保存失败");
                } else {
                    //修改member表中的真实姓名
                    $member_info = Member::findFirst("member_id=" . getSession('member_id'));
                    if ($member_info !== false) {
                        $member_info->save(array('member_truename' => $_POST['member_truename']));
                    }
                    showDialog("保存成功");
                }
            }
        }

        $store_join_info = StoreJoinin::findFirst("member_id=" . getSession('member_id'));
        if ($store_join_info !== false) {
            $store_join_info = $store_join_info->toArray();
            Tpl::output('store_join_info', $store_join_info);
        }
    }
}