<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/19
 * Time: 9:57
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Phalcon\Mvc\View;
use Ypk\Csv;
use Ypk\Logic\MemberLogic;
use Ypk\Models\Member;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

/**
 * 会员管理
 *
 * Class MemberController
 * @package Ypk\Modules\ShopManager\Controllers
 */
class MemberController extends ControllerBase
{
    const EXPORT_SIZE = 1000;

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,member');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->memberAction();
        $this->view->render('member', 'member');
    }

    /**
     * 会员管理
     */
    public function memberAction()
    {

    }

    /**
     * 会员修改
     */
    public function member_editAction()
    {
        $model_member = new MemberLogic();
        if (chksubmit()) {
            /**
             * 验证
             */
            $obj_validate = new Validate();
//            $obj_validate->validateparam = array(
//                array("input" => $_POST["member_email"], "require" => "true", 'validator' => 'Email', "message" => $this->translation->_('member_edit_valid_email')),
//            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $update_array = array();
                $update_array['member_id'] = intval($_POST['member_id']);
                if (!empty($_POST['member_passwd'])) {
                    $update_array['member_passwd'] = md5($_POST['member_passwd']);
                }
                //$update_array['member_email'] = $_POST['member_email'];
                $update_array['member_truename'] = $_POST['member_truename'];
                $update_array['member_sex'] = $_POST['member_sex'];
                $update_array['member_qq'] = $_POST['member_qq'];
                $update_array['member_ww'] = $_POST['member_ww'];
                $update_array['inform_allow'] = $_POST['inform_allow'];
                $update_array['member_state'] = $_POST['member_state']; //会员状态
                $update_array['is_buy'] = $_POST['isbuy'];
                $update_array['is_allowtalk'] = $_POST['allowtalk'];
                if (!empty($_POST['member_avatar'])) {
                    $update_array['member_avatar'] = $_POST['member_avatar'];
                }
                $result = $model_member->editMember($update_array);
                if ($result) {
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/member/member'),
                            'msg' => $this->translation->_('member_edit_back_to_list'),
                        ),
                        array(
                            'url' => getUrl('shop_manager/member/member_edit', array('member_id' => intval($_POST['member_id']))),
                            'msg' => $this->translation->_('member_edit_again'),
                        ),
                    );
                    $this->log($this->translation->_('nc_edit') . $this->translation->_('member_index_name') . '[ID:' . $_POST['member_id'] . ']', 1);
                    $this->showMessage($this->translation->_('member_edit_succ'), $url);
                } else {
                    $this->showMessage($this->translation->_('member_edit_fail'));
                }
            }
        }
        $condition['member_id'] = intval($_GET['member_id']);
        $member_array = $model_member->getMemberInfo($condition);

        $this->view->setVar('member_array', $member_array);
    }

    /**
     * 新增会员
     */
    public function member_addAction()
    {
        $model_member = new MemberLogic();
        /**
         * 保存
         */
        if (chksubmit()) {
            /**
             * 验证
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input" => $_POST["member_name"], "require" => "true", "validator" => "", "message" => $this->translation->_('member_add_name_null')),
                array("input" => $_POST["member_passwd"], "require" => "true", "validator" => "", "message" => '密码不能为空'),
                array("input" => $_POST["member_email"], "require" => "true", 'validator' => 'Email', "message" => $this->translation->_('member_edit_valid_email'))
            );
            $error = $obj_validate->validate();
            if ($error != '') {
                $this->showMessage($error);
            } else {
                $insert_array = array();
                $insert_array['member_name'] = trim($_POST['member_name']);
                $insert_array['member_passwd'] = trim($_POST['member_passwd']);
                $insert_array['member_email'] = trim($_POST['member_email']);
                $insert_array['member_truename'] = trim($_POST['member_truename']);
                $insert_array['member_sex'] = trim($_POST['member_sex']);
                $insert_array['member_qq'] = trim($_POST['member_qq']);
                $insert_array['member_ww'] = trim($_POST['member_ww']);
                //默认允许举报商品
                $insert_array['inform_allow'] = '1';
                if (!empty($_POST['member_avatar'])) {
                    $insert_array['member_avatar'] = trim($_POST['member_avatar']);
                }

                $result = $model_member->addMember($insert_array);
                if ($result) {
                    $url = array(
                        array(
                            'url' => getUrl('shop_manager/member/member'),
                            'msg' => $this->translation->_('member_add_back_to_list'),
                        ),
                        array(
                            'url' => getUrl('shop_manager/member/member_add'),
                            'msg' => $this->translation->_('member_add_again'),
                        ),
                    );
                    $this->log($this->translation->_('nc_add') . $this->translation->_('member_index_name') . '[ ' . $_POST['member_name'] . ']', 1);
                    $this->showMessage($this->translation->_('member_add_succ'), $url);
                } else {
                    $this->showMessage($this->translation->_('member_add_fail'));
                }
            }
        }
    }

    /**
     * ajax操作
     */
    public function ajaxAction()
    {
        $query = Member::query();
        switch ($_GET['branch']) {
            /**
             * 验证会员名是否重复
             */
            case 'check_user_name':
                $query->where('member_name = \'' . trim($_GET['member_name']) . '\'');
                if (!empty($_GET['member_id'])) {
                    $query->andWhere('member_id <> ' . intval($_GET['member_id']));
                }
                $list = $query->execute();
                if (count($list->toArray()) > 0) {
                    echo 'false';
                    exit;
                } else {
                    echo 'true';
                    exit;
                }
                break;
            /**
             * 验证邮件是否重复
             */
            case 'check_email':
                $query->where('member_email = \'' . trim($_GET['member_email']) . '\'');
                if (!empty($_GET['member_id'])) {
                    $query->andWhere('member_id <> ' . intval($_GET['member_id']));
                }
                $list = $query->execute();
                if (count($list->toArray()) > 0) {
                    echo 'false';
                    exit;
                } else {
                    echo 'true';
                    exit;
                }
                break;
        }
    }

    /**
     * 输出XML数据
     */
    public function get_xmlAction()
    {
        $logic_member = new MemberLogic();
        $member_grade = $logic_member->getMemberGradeArr();

        $model_member = Member::query();

        if ($_POST['query'] != '') {
            $model_member->where($_POST['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_POST['query'] . '%'));
        }

        $member = new Member();
        $metaData = $member->getModelsMetaData();
        $param = $metaData->getAttributes($member);

        if (in_array($_POST['sortname'], $param) && in_array($_POST['sortorder'], array('asc', 'desc'))) {
            $order = $_POST['sortname'] . ' ' . $_POST['sortorder'];
            $model_member->orderBy($order);
        }
        $page = $_POST['rp'];
        $now_page = $_POST['curpage'];
        $total_lists = $model_member->execute(); //没有限制limit的查询
        $total_num = count($total_lists->toArray());
        $member_list = $model_member->limit($page, (($now_page - 1) * $page))->execute(); //有限制limit的查询
        $member_list = $member_list->toArray();

        $sex_array = $this->get_sex();

        $data = array();
        $data['now_page'] = $now_page;
        $data['total_num'] = $total_num;
        foreach ($member_list as $value) {
            $param = array();
            $param['operation'] = "<a class='btn blue' href='" . getUrl('shop_manager/member/member_edit', array('member_id' => $value['member_id'])) . "'><i class='fa fa-pencil-square-o'></i>编辑</a>";
            $param['member_id'] = $value['member_id'];
            $param['member_name'] = "<img src=" . getMemberAvatarForID($value['member_id']) . " class='user-avatar' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=" . getMemberAvatarForID($value['member_id']) . ">\")'>" . $value['member_name'];
            //$param['member_email'] = $value['member_email'];
            $param['member_mobile'] = $value['member_mobile'];
            $param['member_sex'] = isset($sex_array[$value['member_sex']]) ? $sex_array[$value['member_sex']] : $sex_array[3];
            $param['member_truename'] = $value['member_truename'];
            $param['member_birthday'] = $value['member_birthday'];
            $param['member_time'] = date('Y-m-d', $value['member_time']);
            $param['member_login_time'] = date('Y-m-d', $value['member_login_time']);
            $param['member_login_ip'] = $value['member_login_ip'];
            $param['member_points'] = $value['member_points'];
            //$param['member_exppoints'] = $value['member_exppoints'];
            //$param['member_grade'] = ($t = $logic_member->getOneMemberGrade($value['member_exppoints'], false, $member_grade)) ? $t['level_name'] : '';
            $param['member_grade'] = getConfig('member_tree_level')[$value['member_tree_level']]['name'];
            $param['available_predeposit'] = ncPriceFormat($value['available_predeposit']);
            $param['freeze_predeposit'] = ncPriceFormat($value['freeze_predeposit']);
            $param['available_rc_balance'] = ncPriceFormat($value['available_rc_balance']);
            $param['freeze_rc_balance'] = ncPriceFormat($value['freeze_rc_balance']);
            $param['inform_allow'] = $value['inform_allow'] == '1' ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $param['is_buy'] = $value['is_buy'] == '1' ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $param['is_allowtalk'] = $value['is_allowtalk'] == '1' ? '<span class="yes"><i class="fa fa-check-circle"></i>是</span>' : '<span class="no"><i class="fa fa-ban"></i>否</span>';
            $param['member_state'] = $value['member_state'] == '1' ? '<span class="yes"><i class="fa fa-check-circle"></i>开启</span>' : '<span class="no"><i class="fa fa-ban"></i>关闭</span>';
            $data['list'][$value['member_id']] = $param;
        }
        echo flexigridXML($data);
        $this->view->disable();
        exit;
    }

    /**
     * 性别
     * @return array
     */
    private function get_sex()
    {
        $array = array();
        $array[1] = '男';
        $array[2] = '女';
        $array[3] = '保密';
        return $array;
    }

    /**
     * csv导出
     */
    public function export_csvAction()
    {
        $model_member = Member::query();

        if ($_GET['id'] != '') {
            $id_array = explode(',', $_GET['id']);
            $model_member->inWhere('member_id', $id_array);
        }
        if ($_GET['query'] != '') {
            $model_member->andWhere($_GET['qtype'] . ' LIKE :qtype:', array('qtype' => '%' . $_GET['query'] . '%'));
        }

        $member = new Member();
        $metaData = $member->getModelsMetaData();
        $param = $metaData->getAttributes($member);

        if (in_array($_GET['sortname'], $param) && in_array($_GET['sortorder'], array('asc', 'desc'))) {
            $order = $_GET['sortname'] . ' ' . $_GET['sortorder'];
            $model_member->orderBy($order);
        }
        if (!isset($_GET['curpage']) || !is_numeric($_GET['curpage'])) {
            $result = $model_member->execute()->toArray();
            $count = count($result);
            if ($count > self::EXPORT_SIZE) {   //显示分页下载链接
                $array = array();
                $page = ceil($count / self::EXPORT_SIZE);
                for ($i = 1; $i <= $page; $i++) {
                    $limit1 = ($i - 1) * self::EXPORT_SIZE + 1;
                    $limit2 = $i * self::EXPORT_SIZE > $count ? $count : $i * self::EXPORT_SIZE;
                    $array[$i] = $limit1 . ' ~ ' . $limit2;
                }
                $this->view->setVar('list', $array);
                $this->view->setVar('murl', getUrl('shop_manager/member/index'));
                $this->view->pick('common/export_excel');
                return;

            } else {
                //不需要分页下载
                $member_list = $model_member->execute();
            }
        } else {
            $offset = ($_GET['curpage'] - 1) * self::EXPORT_SIZE;
            $limit = self::EXPORT_SIZE;
            $member_list = $model_member->limit($limit, $offset)->execute();
        }

        $this->createCsv($member_list->toArray());
        $this->view->disable();
        exit;
    }

    /**
     * 生成csv文件
     */
    private function createCsv($member_list)
    {
        $model_member = new MemberLogic();
        $member_grade = $model_member->getMemberGradeArr();
        // 性别
        $sex_array = $this->get_sex();
        $data = array();
        foreach ($member_list as $value) {
            $param = array();
            $param['member_id'] = $value['member_id'];
            $param['member_name'] = $value['member_name'];
            $param['member_avatar'] = getMemberAvatarForID($value['member_id']);
            $param['member_email'] = $value['member_email'];
            $param['member_mobile'] = $value['member_mobile'];
            $param['member_sex'] = $sex_array[empty($value['member_sex']) ? 1 : $value['member_sex']];
            $param['member_truename'] = $value['member_truename'];
            $param['member_birthday'] = $value['member_birthday'];
            $param['member_time'] = date('Y-m-d', $value['member_time']);
            $param['member_login_time'] = date('Y-m-d', $value['member_login_time']);
            $param['member_login_ip'] = $value['member_login_ip'];
            $param['member_points'] = $value['member_points'];
            $param['member_exppoints'] = $value['member_exppoints'];
            $param['member_grade'] = ($t = $model_member->getOneMemberGrade($value['member_exppoints'], false, $member_grade)) ? $t['level_name'] : '';
            $param['available_predeposit'] = ncPriceFormat($value['available_predeposit']);
            $param['freeze_predeposit'] = ncPriceFormat($value['freeze_predeposit']);
            $param['available_rc_balance'] = ncPriceFormat($value['available_rc_balance']);
            $param['freeze_rc_balance'] = ncPriceFormat($value['freeze_rc_balance']);
            $param['inform_allow'] = $value['inform_allow'] == '1' ? '是' : '否';
            $param['is_buy'] = $value['is_buy'] == '1' ? '是' : '否';
            $param['is_allowtalk'] = $value['is_allowtalk'] == '1' ? '是' : '否';
            $param['member_state'] = $value['member_state'] == '1' ? '是' : '否';
            $data[$value['member_id']] = $param;
        }

        $header = array(
            'member_id' => '会员ID',
            'member_name' => '会员名称',
            'member_avatar' => '会员头像',
            'member_email' => '会员邮箱',
            'member_mobile' => '会员手机',
            'member_sex' => '会员性别',
            'member_truename' => '真实姓名',
            'member_birthday' => '出生日期',
            'member_time' => '注册时间',
            'member_login_time' => '最后登录时间',
            'member_login_ip' => '最后登录IP',
            'member_points' => '会员积分',
            'member_exppoints' => '会员经验',
            'member_grade' => '会员等级',
            'available_predeposit' => '可用预存款(元)',
            'freeze_predeposit' => '冻结预存款(元)',
            'available_rc_balance' => '可用充值卡(元)',
            'freeze_rc_balance' => '冻结充值卡(元)',
            'inform_allow' => '允许举报',
            'is_buy' => '允许购买',
            'is_allowtalk' => '允许咨询',
            'member_state' => '允许登录'
        );
        array_unshift($data, $header);
        $csv = new Csv();
        $export_data = $csv->charset($data, CHARSET, 'gbk');
        $csv->filename = $csv->charset('member_list', CHARSET) . (isset($_GET['curpage']) ? $_GET['curpage'] : '') . '-' . date('Y-m-d');
        $csv->export($export_data);
    }
}