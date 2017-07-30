<?php
/**
 * Created by PhpStorm.
 * User: 贺鹏飞
 * Date: 2016/11/19
 * Time: 10:46
 */

namespace Ypk\Logic;

use Phalcon\Db;
use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
use Phalcon\Mvc\Model\Transaction\Manager as TxManager;
use Ypk\Model;
use Ypk\Models\Member;
use Ypk\Models\MemberCommon;
use Ypk\Models\SnsAlbumclass;
use Ypk\Models\Store;
use Ypk\Process;
use Ypk\QueueClient;
use Ypk\Validate;

/**
 * 会员模型
 *
 * Class MemberLogic
 * @package Ypk\Logic
 */
class MemberLogic extends Model
{
    public function __construct()
    {

    }

    /**
     * 会员详细信息（查库）
     * @param array $condition
     * @param string $field
     * @return array
     */
    public function getMemberInfo($condition, $field = '*')
    {
        $member = Member::findFirst(array(
            "conditions" => getConditionsByParamArray($condition),
            "columns" => $field,
            "bind" => $condition
        ));
        if ($member) {
            return $member->toArray();
        } else {
            return array();
        }
    }

    /**
     * 取得会员详细信息（优先查询缓存）
     * 如果未找到，则缓存所有字段
     * @param int $member_id
     * @param string $fields
     * @return array
     * @internal param string $field 需要取得的缓存键值, 例如：'*','member_name,member_sex'
     */
    public function getMemberInfoByID($member_id, $fields = '*')
    {
        $member_info = read_file_cache($member_id, false, null, 'member/');
        if (empty($member_info)) {
            $member_info = $this->getMemberInfo(array('member_id' => $member_id), '*', true);
            write_file_cache($member_id, $member_info, null, 'member/');
        }
        return $member_info;
    }

    /**
     *获取佣金订单数量
     *
     */
    public function getOrderInviteCount($inviteid, $memberid)
    {
        return $this->table('pd_log')->where(array('lg_invite_member_id' => $memberid, 'lg_member_id' => $inviteid))->count();
    }

    /**
     *获取佣金订单总金额
     *
     */
    public function getOrderInviteamount($inviteid, $memberid)
    {
        return $this->table('pd_log')->where(array('lg_invite_member_id' => $memberid, 'lg_member_id' => $inviteid))->sum('lg_av_amount');
    }

    /**
     * 会员列表
     * @param array $condition
     * @param string $field
     * @param number $page
     * @param string $order
     */
    public function getMembersList($condition, $page = null, $order = 'member_id desc', $field = '*')
    {
        return $this->table('member')->field($field)->where($condition)->page($page)->order($order)->select();
    }


    /**
     * 删除会员
     *
     * @param int $id 记录ID
     * @return array $rs_row 返回数组形式的查询结果
     */
    public function del($id)
    {
        if (intval($id) > 0) {
            $where = " member_id = '" . intval($id) . "'";
            $result = Db::delete('member', $where);
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 编辑会员
     * @param $data
     * @return bool|Member
     */
    public function editMember($data)
    {
        $update = Member::findFirst(array(
            "conditions" => getConditionsByParamArray(array('member_id' => $data['member_id'])),
            "bind" => array('member_id' => $data['member_id'])
        ));

        if ($update) {
            if ($update->save($data)) {
                delete_file_cache($update->getMemberId(), 'member/');
            } else {
                return false;
            }
        } else {
            return false;
        }
        return $update;
    }

    /**
     * 登录时创建会话SESSION
     *
     * @param array $member_info 会员信息
     */
    public function createSession($member_info = array(), $reg = false)
    {
        if (empty($member_info) || !is_array($member_info)) {
            return;
        }

        setSession('is_login', 1); //标识登录状态，用于在其他页面进行使用判断
        setSession('member_id', $member_info['member_id']);
        setSession('member_name', $member_info['member_name']);
        setSession('member_email', $member_info['member_email']);
        setSession('is_buy', (isset($member_info['is_buy']) ? $member_info['is_buy'] : 1)); //会员是否有购买权限（1开启，0关闭）
        setSession('avatar', $member_info['member_avatar']); //会员头像路径
        setSession('member_type_id', $member_info['member_type_id']); //会员身份标识

        // 把头像路径保存到cookie中一年
        //$this->set_avatar_cookie();

        //根据用户id获取用户对应的卖家信息
        //$seller_info = (new SellerLogic())->getSellerInfo(array('member_id' => $_SESSION['member_id']));
        //$_SESSION['store_id'] = $seller_info['store_id']; //医生id

//        if (trim($member_info['member_qqopenid'])) {
//            $_SESSION['openid'] = $member_info['member_qqopenid']; //qq互联id
//        }
//        if (trim($member_info['member_sinaopenid'])) {
//            $_SESSION['slast_key']['uid'] = $member_info['member_sinaopenid']; //新浪互联id
//        }

//        if (!$reg) {
//            //添加会员积分
//            $this->addPoint($member_info);
//            //添加会员经验值
//            $this->addExppoint($member_info);
//        }

        //判断当前登录时间
//        if (!empty($member_info['member_login_time'])) {
//            $update_info = array(
//                'member_login_num' => ($member_info['member_login_num'] + 1),
//                'member_login_time' => TIMESTAMP,
//                'member_old_login_time' => $member_info['member_login_time'],
//                'member_login_ip' => getIp(),
//                'member_old_login_ip' => $member_info['member_login_ip']
//            );
//            $this->editMember(array('member_id' => $member_info['member_id']), $update_info);
//        }
        //setMyCookie('cart_goods_num', '', -3600);
        // cookie中的cart存入数据库
        //(new CartLogic())->mergecart($member_info, $_SESSION['store_id']);

        // 7天自动登录
        if ($member_info['auto_login'] == 1) {
            $this->auto_login();
        }
    }

    /**
     * 获取会员信息
     *
     * @param    array $param 会员条件
     * @param    string $field 显示字段
     * @return    array 数组格式的返回结果
     */
    public function infoMember($param, $field = '*')
    {
        if (empty($param)) return false;

        //得到条件语句
        $condition_str = $this->getCondition($param);
        $param = array();
        $param['table'] = 'member';
        $param['where'] = $condition_str;
        $param['field'] = $field;
        $param['limit'] = 1;
        $member_list = Db::select($param);
        $member_info = $member_list[0];
        if (intval($member_info['store_id']) > 0) {
            $param = array();
            $param['table'] = 'store';
            $param['field'] = 'store_id';
            $param['value'] = $member_info['store_id'];
            $field = 'store_id,store_name,grade_id';
            $store_info = Db::getRow($param, $field);
            if (!empty($store_info) && is_array($store_info)) {
                $member_info['store_name'] = $store_info['store_name'];
                $member_info['grade_id'] = $store_info['grade_id'];
            }
        }
        return $member_info;
    }

    /**
     * 7天内自动登录
     */
    public function auto_login()
    {
        setMyCookie('auto_login', encrypt(getSession('member_id'), MD5_KEY), 7 * 24 * 60 * 60);
    }

    /**
     * 头像路径保存一年
     */
    public function set_avatar_cookie()
    {
        setMyCookie('member_avatar', getSession('avatar'), 365 * 24 * 60 * 60);
    }

    /**
     * 验证用户登录
     * @param $login_info
     * @return array
     */
    public function login($login_info)
    {
        $user_name = $login_info['user_name']; //输入用户名
        $password = $login_info['password']; //输入的用户密码
        $obj_validate = new Validate();

        //存放验证信息
        $obj_validate->validateparam = array(
            array(
                "input" => $user_name,
                "require" => "true",
                "message" => "请填写用户名"
            ),
            array(
                "input" => $user_name,
                "validator" => "username",
                "message" => "请填写字母、数字、中文、_"
            ),
            array(
                "input" => $user_name,
                "max" => "20",
                "min" => "1",
                "validator" => "length",
                "message" => "用户名长度要在1~20个字符"
            ),
            array(
                "input" => $password,
                "require" => "true",
                "message" => "密码不能为空"
            )
        );
        $error = $obj_validate->validate();
        if ($error != '') {
            return array('error' => $error);
        }
        $condition = array();
        $condition['member_name'] = $user_name;
        $condition['member_passwd'] = md5($password);
        $member_info = $this->getMemberInfo($condition); //根据条件查询用户信息

        //if (empty($member_info) && preg_match('/^0?(13|15|17|18|14)[0-9]{9}$/i', $user_name)) {//根据会员名没找到时查手机号
        //    $condition = array();
        //    $condition['member_mobile'] = $user_name;
        //    $condition['member_passwd'] = md5($password);
        //    $member_info = $this->getMemberInfo($condition);
        //}
        //if (empty($member_info) && (strpos($user_name, '@') > 0)) {//按邮箱和密码查询会员
        //    $condition = array();
        //    $condition['member_email'] = $user_name;
        //    $condition['member_passwd'] = md5($password);
        //    $member_info = $this->getMemberInfo($condition);
        //}
        if (!empty($member_info)) { //表示登录成功
            if (!$member_info['member_state']) {
                return array('error' => '账号被停用');
            }

            //添加会员积分
            //$this->addPoint($member_info);
            //添加会员经验值
            //$this->addExppoint($member_info);

            //$update_info = array(
            //    'member_login_num' => ($member_info['member_login_num'] + 1),
            //    'member_login_time' => TIMESTAMP,
            //    'member_old_login_time' => $member_info['member_login_time'],
            //    'member_login_ip' => getIp(),
            //    'member_old_login_ip' => $member_info['member_login_ip']
            //);
            //$this->editMember(array('member_id' => $member_info['member_id']), $update_info);

            return $member_info;
        } else {
            return array('error' => '登录失败');
        }
    }

    /**
     * 用户注册操作
     */
    public function register($register_info)
    {
        //重复注册验证
//        if (process::islock('reg')) {
//            return array('error' => '您的操作过于频繁，请稍后再试');
//        }
        // 注册验证
        $obj_validate = new Validate();  //验证浏览器提交的注册信息的格式是否正确
        $obj_validate->validateparam = array(
            array(
                "input" => $register_info["member_mobile"],
                "require" => "true",
                "message" => "请填写手机号码"
            ),
            array(
                "input" => $register_info["member_mobile"],
                "max" => "11",
                "min" => "11",
                "validator" => "length",
                "message" => "请输入11位的手机号码"
            ),
            array(
                "input" => $register_info["password"],
                "require" => "true",
                "message" => "密码不能为空"
            ),
            array(
                "input" => $register_info["password_confirm"],
                "require" => "true",
                "validator" => "Compare",
                "operator" => "==",
                "to" => $register_info["password"],
                "message" => "密码与确认密码不相同"
            ),
        );
        $error = $obj_validate->validate();
        if ($error != '') {  //表示验证失败
            return array('error' => $error);
        }

        // 验证手机号码是否重复
        $check_member_name = $this->getMemberInfo(array('member_mobile' => $register_info['member_mobile']));
        if (is_array($check_member_name) and count($check_member_name) > 0) {
            return array('error' => '手机号码已存在');
        }

        // 验证邮箱是否重复
        //$check_member_email = $this->getMemberInfo(array('member_email' => $register_info['email']));
        //if (is_array($check_member_email) and count($check_member_email) > 0) {
        //    return array('error' => '邮箱已存在');
        //}

        // 会员添加
        $member_info = array();
        $member_info['member_name'] = $register_info['username']; //用户名
        $member_info['member_passwd'] = $register_info['password']; //密码
        $member_info['member_email'] = $register_info['email']; //电子邮箱

        //添加邀请人(推荐人)会员积分
        $member_info['inviter_id'] = $register_info['inviter_id']; //推荐人id
        $insert_id = $this->addMember($member_info); //添加注册用户到数据库，并返回新添加的用户id
        if ($insert_id) {
            $member_info['member_id'] = $insert_id;
            $member_info['is_buy'] = 1; //会员是否有购买权限（1：开启，0：关闭）
            //Process::addprocess('reg');
            return $member_info;
        } else {
            return array('error' => '注册失败');
        }
    }

    /**
     * 注册商城会员
     *
     * @param array $param 会员信息
     * @return bool
     */
    public function addMember($param)
    {
        if (empty($param)) {
            return false;
        }
        try {
            //创建一个事务管理器
            $manager = new TxManager();
            //获取一个新的事务
            $transaction = $manager->get();

            $member_info = array();
            if (isset($param['member_id'])) {
                $member_info['member_id'] = $param['member_id'];
            }
            $member_info['member_name'] = $param['member_name'];
            $member_info['member_passwd'] = md5(trim($param['member_passwd']));
            $member_info['member_email'] = $param['member_email'];
            $member_info['member_time'] = TIMESTAMP;
            $member_info['member_login_time'] = TIMESTAMP;
            $member_info['member_old_login_time'] = TIMESTAMP;
            $member_info['member_login_ip'] = getIp();
            $member_info['member_old_login_ip'] = $member_info['member_login_ip'];

            $member_info['member_truename'] = $param['member_truename'];
            $member_info['member_qq'] = $param['member_qq'];
            $member_info['member_sex'] = $param['member_sex'];
            $member_info['member_avatar'] = $param['member_avatar'];
            if (isset($param['member_qqopenid'])) {
                $member_info['member_qqopenid'] = $param['member_qqopenid'];
            }
            if (isset($param['member_qqinfo'])) {
                $member_info['member_qqinfo'] = $param['member_qqinfo'];
            }
            if (isset($param['member_sinaopenid'])) {
                $member_info['member_sinaopenid'] = $param['member_sinaopenid'];
            }
            if (isset($param['member_sinainfo'])) {
                $member_info['member_sinainfo'] = $param['member_sinainfo'];
            }

            //添加邀请人(推荐人)
            if (isset($param['inviter_id'])) {
                $member_info['inviter_id'] = $param['inviter_id'];
            }
            if (isset($param['member_mobile_bind'])) {
                $member_info['member_mobile'] = $param['member_mobile'];
                $member_info['member_mobile_bind'] = $param['member_mobile_bind'];
            }
            if (isset($param['weixin_unionid'])) {
                $member_info['weixin_unionid'] = $param['weixin_unionid'];
                $member_info['weixin_info'] = $param['weixin_info'];
            }
            $member = new Member();
            $member->setTransaction($transaction);
            if ($member->save($member_info) == false) {
                $transaction->rollback("添加会员失败!");
            }
            $insert_id = $member->getMemberId();

            $member_common = new MemberCommon();
            $member_common->setTransaction($transaction);
            if ($member_common->save(array('member_id' => $insert_id)) == false) {
                $transaction->rollback("添加会员扩展信息失败!");
            }
            $insert = $member_common->getMemberId();

            // 添加默认相册
            $insert = array();
            $insert['ac_name'] = '买家秀';
            $insert['member_id'] = $insert_id;
            $insert['ac_des'] = '买家秀默认相册';
            $insert['ac_sort'] = 1;
            $insert['is_default'] = 1;
            $insert['upload_time'] = TIMESTAMP;
            $sns_albumclass = new SnsAlbumclass();
            $sns_albumclass->setTransaction($transaction);
            if ($sns_albumclass->save($insert) == false) {
                $transaction->rollback("买家秀默认相册!");
            }
            $rs = $sns_albumclass->getAcId();

//            if (getConfig('points_isuse')) {
//                $logic_point = new PointLogic();
//                //添加会员积分
//                $logic_point->savePointsLog('regist', array('pl_memberid' => $insert_id, 'pl_membername' => $param['member_name']), false);
//                //添加邀请人(推荐人)会员积分
//                if (isset($member_info['inviter_id'])) {
//                    $inviter = Member::findFirst('member_id = ' . $member_info['inviter_id']);
//                    $inviter_name = $inviter->getMemberName();
//                    $logic_point->savePointsLog('inviter', array('pl_memberid' => $member_info['inviter_id'], 'pl_membername' => $inviter_name, 'invited' => $member_info['member_name']));
//                }
//            }

            $transaction->commit();
            return $insert_id;
        } catch (TxFailed $e) {
            return false;
        }
    }

    /**
     * 会员登录检查
     *
     */
    public function checkloginMember()
    {
        if (intval(getSession('is_login')) == 1) {
            @header("Location: " . getUrl('shop/index'));
            exit();
        }
    }

    /**
     * 检查会员是否允许举报商品
     *
     */
    public function isMemberAllowInform($member_id)
    {
        $condition = array();
        $condition['member_id'] = $member_id;
        $member_info = $this->getMemberInfo($condition, 'inform_allow');
        if (intval($member_info['inform_allow']) === 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 取单条信息
     * @param unknown $condition
     * @param string $fields
     */
    public function getMemberCommonInfo($condition = array(), $fields = '*')
    {
        return $this->table('member_common')->where($condition)->field($fields)->find();
    }

    /**
     * 插入扩展表信息
     * @param array $data
     * @return bool|int
     */
    public function addMemberCommon($data)
    {
        $member_common = new MemberCommon();
        if ($member_common->save($data)) {
            return $member_common->getMemberId();
        } else {
            return false;
        }
    }

    /**
     * 编辑会员扩展表
     * @param unknown $data
     * @param unknown $condition
     * @return Ambigous <mixed, boolean, number, unknown, resource>
     */
    public function editMemberCommon($data, $condition)
    {
        return $this->table('member_common')->where($condition)->update($data);
    }

    /**
     * 添加会员积分
     * @param unknown $member_info
     */
    public function addPoint($member_info)
    {
        if (!getConfig('points_isuse') || empty($member_info)) return;

        //一天内只有第一次登录赠送积分
        if (trim(@date('Y-m-d', $member_info['member_login_time'])) == trim(date('Y-m-d'))) return;

        //加入队列
        $queue_content = array();
        $queue_content['member_id'] = $member_info['member_id'];
        $queue_content['member_name'] = $member_info['member_name'];
        QueueClient::push('addPoint', $queue_content);
    }

    /**
     * 添加会员经验值
     * @param unknown $member_info
     */
    public function addExppoint($member_info)
    {
        if (empty($member_info)) return;

        //一天内只有第一次登录赠送经验值
        if (trim(@date('Y-m-d', $member_info['member_login_time'])) == trim(date('Y-m-d'))) return;

        //加入队列
        $queue_content = array();
        $queue_content['member_id'] = $member_info['member_id'];
        $queue_content['member_name'] = $member_info['member_name'];
        QueueClient::push('addExppoint', $queue_content);
    }

    /**
     * 取得会员安全级别
     * @param unknown $member_info
     */
    public function getMemberSecurityLevel($member_info = array())
    {
        $tmp_level = 0;
        if ($member_info['member_email_bind'] == '1') {
            $tmp_level += 1;
        }
        if ($member_info['member_mobile_bind'] == '1') {
            $tmp_level += 1;
        }
        if ($member_info['member_paypwd'] != '') {
            $tmp_level += 1;
        }
        return $tmp_level;
    }

    /**
     * 获得会员等级
     * @param bool $show_progress 是否计算其当前等级进度
     * @param int $exppoints 会员经验值
     * @param array $cur_level 会员当前等级
     * @return array|mixed
     */
    public function getMemberGradeArr($show_progress = false, $exppoints = 0, $cur_level = '')
    {
        $member_grade = getConfig('member_grade') ? unserialize(getConfig('member_grade')) : array();
        //处理会员等级进度
        if ($member_grade && $show_progress) {
            if ($cur_level === '') {
                $cur_gradearr = $this->getOneMemberGrade($exppoints, false, $member_grade);
                $cur_level = $cur_gradearr['level'];
            }
            foreach ($member_grade as $k => $v) {
                if ($cur_level == $v['level']) {
                    $v['is_cur'] = true;
                }
                $member_grade[$k] = $v;
            }
        }
        return $member_grade;
    }

    /**
     * 获得某一会员等级
     * @param int $exppoints
     * @param bool $show_progress 是否计算其当前等级进度
     * @param array $member_grade 会员等级
     * @return array|mixed
     */
    public function getOneMemberGrade($exppoints, $show_progress = false, $member_grade = array())
    {
        if (!$member_grade) {
            $member_grade = getConfig('member_grade') ? unserialize(getConfig('member_grade')) : array();
        }
        if (empty($member_grade)) {//如果会员等级设置为空
            $grade_arr['level'] = -1;
            $grade_arr['level_name'] = '暂无等级';
            return $grade_arr;
        }

        $exppoints = intval($exppoints);

        $grade_arr = array();
        if ($member_grade) {
            foreach ($member_grade as $k => $v) {
                if ($exppoints >= $v['exppoints']) {
                    $grade_arr = $v;
                }
            }
        }
        //计算提升进度
        if ($show_progress == true) {
            if (intval($grade_arr['level']) >= (count($member_grade) - 1)) {//如果已达到顶级会员
                $grade_arr['downgrade'] = $grade_arr['level'] - 1;//下一级会员等级
                $grade_arr['downgrade_name'] = $member_grade[$grade_arr['downgrade']]['level_name'];
                $grade_arr['downgrade_exppoints'] = $member_grade[$grade_arr['downgrade']]['exppoints'];
                $grade_arr['upgrade'] = $grade_arr['level'];//上一级会员等级
                $grade_arr['upgrade_name'] = $member_grade[$grade_arr['upgrade']]['level_name'];
                $grade_arr['upgrade_exppoints'] = $member_grade[$grade_arr['upgrade']]['exppoints'];
                $grade_arr['less_exppoints'] = 0;
                $grade_arr['exppoints_rate'] = 100;
            } else {
                $grade_arr['downgrade'] = $grade_arr['level'];//下一级会员等级
                $grade_arr['downgrade_name'] = $member_grade[$grade_arr['downgrade']]['level_name'];
                $grade_arr['downgrade_exppoints'] = $member_grade[$grade_arr['downgrade']]['exppoints'];
                $grade_arr['upgrade'] = $member_grade[$grade_arr['level'] + 1]['level'];//上一级会员等级
                $grade_arr['upgrade_name'] = $member_grade[$grade_arr['upgrade']]['level_name'];
                $grade_arr['upgrade_exppoints'] = $member_grade[$grade_arr['upgrade']]['exppoints'];
                $grade_arr['less_exppoints'] = $grade_arr['upgrade_exppoints'] - $exppoints;
                $grade_arr['exppoints_rate'] = round(($exppoints - $member_grade[$grade_arr['level']]['exppoints']) / ($grade_arr['upgrade_exppoints'] - $member_grade[$grade_arr['level']]['exppoints']) * 100, 2);
            }
        }
        return $grade_arr;
    }
}