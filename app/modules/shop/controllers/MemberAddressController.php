<?php
/**
 * 用户中心-收货地址
 * User: Administrator
 * Date: 2016/12/11
 * Time: 16:57
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Tpl;
use Ypk\Validate;

class MemberAddressController extends BaseMemberController
{
    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('member_address,member_layout');
    }

    /**
     * 会员地址
     */
    public function addressAction()
    {
        $lang = $this->translation;
        $address_class = Model('address');
        /**
         * 判断页面类型
         */
        if (!empty($_GET['type'])) {
            /**
             * 新增/编辑地址页面
             */
            if (intval($_GET['id']) > 0) {
                /**
                 * 得到地址信息
                 */
                $address_info = $address_class->getOneAddress(intval($_GET['id']));
                if ($address_info['member_id'] != getSession('member_id')) {
                    showMessage($lang['member_address_wrong_argument'], getUrl('shop/member_address/address'), 'html', 'error');
                }
                /**
                 * 输出地址信息
                 */
                Tpl::output('address_info', $address_info);
            }
            /**
             * 增加/修改页面输出
             */
            Tpl::output('type', $_GET['type']);
            //Tpl::showpage('member_address.edit', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('member_address', 'member_address_edit');
            exit;
        }

        /**
         * 判断操作类型
         */
        if (chksubmit()) {
            if ($_POST['city_id'] == '') {
                $_POST['city_id'] = $_POST['area_id'];
            }
            /**
             * 验证表单信息
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["true_name"], "require" => "true", "message" => $lang['member_address_receiver_null']),
                array("input" => $_POST["area_id"], "require" => "true", "validator" => "Number", "message" => $lang['member_address_wrong_area']),
                array("input" => $_POST["city_id"], "require" => "true", "validator" => "Number", "message" => $lang['member_address_wrong_area']),
                array("input" => $_POST["region"], "require" => "true", "message" => $lang['member_address_area_null']),
                array("input" => $_POST["address"], "require" => "true", "message" => $lang['member_address_address_null']),
                array("input" => $_POST['tel_phone'] . $_POST['mob_phone'], 'require' => 'true', 'message' => $lang['member_address_phone_and_mobile'])
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                //showValidateError($error);
                $this->showMessage($error);
            }
            $data = array();
            $data['member_id'] = getSession('member_id');
            $data['true_name'] = $_POST['true_name'];
            $data['area_id'] = intval($_POST['area_id']);
            $data['city_id'] = intval($_POST['city_id']);
            $data['area_info'] = $_POST['region'];
            $data['address'] = $_POST['address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data['is_default'] = $_POST['is_default'] ? 1 : 0;
            if ($_POST['is_default']) {
                $address_class->editAddress(array('is_default' => 0), array('member_id' => getSession('member_id'), 'is_default' => 1));
            }

            if (intval($_POST['id']) > 0) {
                $rs = $address_class->editAddress($data, array('address_id' => intval($_POST['id']), 'member_id' => getSession('member_id')));
                if (!$rs) {
                    showDialog($lang['member_address_modify_fail'], '', 'error');
                }
            } else {
                $count = $address_class->getAddressCount(array('member_id' => getSession('member_id')));
                if ($count >= 20) {
                    showDialog('最多允许添加20个有效地址', '', 'error');
                }
                $rs = $address_class->addAddress($data);
                if (!$rs) {
                    showDialog($lang['member_address_add_fail'], '', 'error');
                }
            }
            showDialog($lang['nc_common_op_succ'], 'reload', 'js');
        }
        $del_id = isset($_GET['id']) ? intval(trim($_GET['id'])) : 0;
        if ($del_id > 0) {
            $rs = $address_class->delAddress(array('address_id' => $del_id, 'member_id' => getSession('member_id')));
            if ($rs) {
                showDialog(getLang('member_address_del_succ'), getUrl('shop/member_address/address'), 'js');
            } else {
                showDialog(getLang('member_address_del_fail'), '', 'error');
            }
        }
        $address_list = $address_class->getAddressList(array('member_id' => getSession('member_id')));

        self::profile_menu('address', 'address');
        Tpl::output('address_list', $address_list);
        //Tpl::showpage('member_address.index');
        $this->view->pick('member_address/member_address_index');
    }

    /**
     * 添加自提点型收货地址
     */
    public function delivery_addAction()
    {
        if (chksubmit()) {
            $info = Model('delivery_point')->getDeliveryPointOpenInfo(array('dlyp_id' => intval($_POST['dlyp_id'])));
            if (empty($info)) {
                showDialog('该自提点不存在', '', 'error');
            }
            $data = array();
            $data['member_id'] = getSession('member_id');
            $data['true_name'] = $_POST['true_name'];
            $data['area_id'] = $info['dlyp_area_3'];
            $data['city_id'] = $info['dlyp_area_2'];
            $data['area_info'] = $info['dlyp_area_info'];
            $data['address'] = $info['dlyp_address'];
            $data['tel_phone'] = $_POST['tel_phone'];
            $data['mob_phone'] = $_POST['mob_phone'];
            $data['dlyp_id'] = $info['dlyp_id'];
            $data['is_default'] = 0;
            if (intval($_POST['address_id'])) {
                $result = Model('address')->editAddress($data, array('address_id' => intval($_POST['address_id'])));
            } else {
                $count = Model('address')->getAddressCount(array('member_id' => getSession('member_id')));
                if ($count >= 20) {
                    showDialog('最多允许添加20个有效地址', '', 'error');
                }
                $result = Model('address')->addAddress($data);
            }
            if (!$result) {
                showDialog('保存失败', '', 'error');
            }
            showDialog('保存成功', 'reload', 'js');
        } else {
            if (intval($_GET['id']) > 0) {
                $model_addr = Model('address');
                $condition = array('address_id' => intval($_GET['id']), 'member_id' => getSession('member_id'));
                $address_info = $model_addr->getAddressInfo($condition);
                //取出省级ID
                $area_info = Model('area')->getAreaInfo(array('area_id' => $address_info['city_id']));
                $address_info['province_id'] = $area_info['area_parent_id'];
                Tpl::output('address_info', $address_info);
            }
            //Tpl::showpage('member_address.delivery_add', 'null_layout');
            $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
            $this->view->render('member_address','member_address_delivery_add');
        }
    }

    /**
     * 展示自提点列表
     */
    public function delivery_listAction()
    {
        $model_delivery = Model('delivery_point');
        $condition = array();
        $condition['dlyp_area'] = intval($_GET['area_id']);
        $list = $model_delivery->getDeliveryPointOpenList($condition, 5);
        Tpl::output('show_page', $model_delivery->showpage());
        Tpl::output('list', $list);
        //Tpl::showpage('member_address.delivery_list', 'null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('member_address','member_address_delivery_list');
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     */
    private function profile_menu($menu_type, $menu_key = '')
    {
        $menu_array = array();
        switch ($menu_type) {
            case 'address':
                $menu_array = array(
                    1 => array('menu_key' => 'address', 'menu_name' => '地址列表', 'menu_url' => getUrl('shop/member_adderss/address')));
                break;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }
}