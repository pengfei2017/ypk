<?php
/**
 * 第三方账号登录
 */
namespace Ypk\Modules\Mobile\Controllers;

use Ypk\Models\Member;
use Ypk\Models\MemberType;
use Ypk\Models\StoreJoinin;
use Ypk\UploadFile;

class ConnectController extends MobileHomeController
{
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 登录开关状态
     */
    public function get_stateAction()
    {
        $logic_connect_api = Logic('connect_api');
        $state_array = $logic_connect_api->getStateInfo();

        $key = $_GET['t'];
        if (trim($key) != '' && array_key_exists($key, $state_array)) {
            output_data($state_array[$key]);
        } else {
            output_data($state_array);
        }
    }

    /**
     * WAP页面微信登录回调
     */
    public function indexAction()
    {
        $logic_connect_api = Logic('connect_api');
        if (!empty($_GET['code'])) {
            $code = $_GET['code'];
            $client = 'wap';
            $user_info = $logic_connect_api->getWxUserInfo($code, 'wap');
            if (!empty($user_info['unionid'])) {
                $unionid = $user_info['unionid'];
                $model_member = Model('member');
                $member = $model_member->getMemberInfo(array('weixin_unionid' => $unionid));
                $state_data = array();
                $token = 0;
                if (!empty($member)) {//会员信息存在时自动登录
                    $token = $logic_connect_api->getUserToken($member, $client);
                } else {//自动注册会员并登录
                    $info_data = $logic_connect_api->wxRegister($user_info, $client);
                    $token = $info_data['token'];
                    $member = $info_data['member'];
                    $state_data['password'] = $member['member_passwd'];
                }
                if ($token) {
                    $state_data['key'] = $token;
                    $state_data['username'] = $member['member_name'];
                    $state_data['userid'] = $member['member_id'];
                    redirect(WAP_SITE_URL . '/js_template/member/member.html?username=' . $state_data['username'] . '&key=' . $state_data['key']);
                } else {
                    output_error('会员登录失败');
                }
            } else {
                output_error('微信登录失败');
            }
        } else {
            $_url = $logic_connect_api->getWxOAuth2Url();
            @header("location: " . $_url);
        }
    }

    /**
     * QQ互联获取应用唯一标识
     */
    public function get_qq_appidAction()
    {
        output_data(getConfig('app_qq_akey'));
    }

    /**
     * 请求QQ互联授权
     */
    public function get_qq_oauth2Action()
    {
        $logic_connect_api = Logic('connect_api');
        $qq_url = $logic_connect_api->getQqOAuth2Url('api');
        @header("location: " . $qq_url);
    }

    /**
     * QQ互联获取回调信息
     */
    public function get_qq_infoAction()
    {
        $code = $_GET['code'];
        $token = $_GET['token'];
        $client = $_GET['client'];
        $logic_connect_api = Logic('connect_api');
        $user_info = $logic_connect_api->getQqUserInfo($code, $client, $token);
        if (!empty($user_info['openid'])) {
            $qqopenid = $user_info['openid'];
            $model_member = Model('member');
            $member = $model_member->getMemberInfo(array('member_qqopenid' => $qqopenid));
            $state_data = array();
            $token = 0;
            if (!empty($member)) {//会员信息存在时自动登录
                $token = $logic_connect_api->getUserToken($member, $client);
            } else {//自动注册会员并登录
                $info_data = $logic_connect_api->qqRegister($user_info, $client);
                $token = $info_data['token'];
                $member = $info_data['member'];
                $state_data['password'] = $member['member_passwd'];
            }
            if ($token) {
                $state_data['key'] = $token;
                $state_data['username'] = $member['member_name'];
                $state_data['userid'] = $member['member_id'];
                if ($client == 'wap') {
                    redirect(WAP_SITE_URL . '/js_template/member/member.html?username=' . $state_data['username'] . '&key=' . $state_data['key']);
                }
                output_data($state_data);
            } else {
                output_error('会员登录失败');
            }
        } else {
            output_error('QQ互联登录失败');
        }
    }

    /**
     * 新浪微博获取应用唯一标识
     */
    public function get_sina_appidAction()
    {
        output_data(getConfig('app_sina_akey'));
    }

    /**
     * 请求新浪微博授权
     */
    public function get_sina_oauth2Action()
    {
        $logic_connect_api = Logic('connect_api');
        $sina_url = $logic_connect_api->getSinaOAuth2Url('api');
        @header("location: " . $sina_url);
    }

    /**
     * 新浪微博获取回调信息
     */
    public function get_sina_infoAction()
    {
        $code = $_GET['code'];
        $client = $_GET['client'];
        $sina_token['access_token'] = $_GET['accessToken'];
        $sina_token['uid'] = $_GET['userID'];
        $logic_connect_api = Logic('connect_api');
        $user_info = $logic_connect_api->getSinaUserInfo($code, $client, $sina_token);
        if (!empty($user_info['id'])) {
            $sinaopenid = $user_info['id'];
            $model_member = Model('member');
            $member = $model_member->getMemberInfo(array('member_sinaopenid' => $sinaopenid));
            $state_data = array();
            $token = 0;
            if (!empty($member)) {//会员信息存在时自动登录
                $token = $logic_connect_api->getUserToken($member, $client);
            } else {//自动注册会员并登录
                $info_data = $logic_connect_api->sinaRegister($user_info, $client);
                $token = $info_data['token'];
                $member = $info_data['member'];
                $state_data['password'] = $member['member_passwd'];
            }
            if ($token) {
                $state_data['key'] = $token;
                $state_data['username'] = $member['member_name'];
                $state_data['userid'] = $member['member_id'];
                if ($client == 'wap') {
                    redirect(WAP_SITE_URL . '/js_template/member/member.html?username=' . $state_data['username'] . '&key=' . $state_data['key']);
                }
                output_data($state_data);
            } else {
                output_error('会员登录失败');
            }
        } else {
            output_error('新浪微博登录失败');
        }
    }

    /**
     * 微信获取应用唯一标识
     */
    public function get_wx_appidAction()
    {
        output_data(getConfig('app_weixin_appid'));
    }

    /**
     * 微信获取回调信息
     */
    public function get_wx_infoAction()
    {
        $code = $_GET['code'];
        $access_token = $_GET['access_token'];
        $openid = $_GET['openid'];
        $client = $_GET['client'];
        $logic_connect_api = Logic('connect_api');
        if (!empty($code)) {
            $user_info = $logic_connect_api->getWxUserInfo($code, 'api');
        } else {
            $user_info = $logic_connect_api->getWxUserInfoUmeng($access_token, $openid);
        }
        if (!empty($user_info['unionid'])) {
            $unionid = $user_info['unionid'];
            $model_member = Model('member');
            $member = $model_member->getMemberInfo(array('weixin_unionid' => $unionid));
            $state_data = array();
            $token = 0;
            if (!empty($member)) {//会员信息存在时自动登录
                $token = $logic_connect_api->getUserToken($member, $client);
            } else {//自动注册会员并登录
                $info_data = $logic_connect_api->wxRegister($user_info, $client);
                $token = $info_data['token'];
                $member = $info_data['member'];
                $state_data['password'] = $member['member_passwd'];
            }
            if ($token) {
                $state_data['key'] = $token;
                $state_data['username'] = $member['member_name'];
                $state_data['userid'] = $member['member_id'];
                output_data($state_data);
            } else {
                output_error('会员登录失败');
            }
        } else {
            output_error('微信登录失败');
        }
    }

    /**
     * 获取手机短信验证码
     */
    public function get_sms_captchaAction()
    {
        $sec_key = $_GET['sec_key'];
        $sec_val = $_GET['sec_val'];
        $phone = $_GET['phone'];
        $log_type = $_GET['type'];//短信类型:1为注册,2为登录,3为找回密码
        /*$state_data = array(
            'state' => false,
            'msg' => '验证码或手机号码不正确'
            );*/

        //$result = Model('apiseccode')->checkApiSeccode($sec_key,$sec_val);
        //if ($result && strlen($phone) == 11){
        if (strlen($phone) == 11) {

            $logic_connect_api = Logic('connect_api');
            $state_data = $logic_connect_api->sendCaptcha($phone, $log_type);
        }
        $this->connect_output_data($state_data);
    }

    /**
     * 验证手机验证码
     */
    public function check_sms_captchaAction()
    {
        $phone = $_GET['phone'];
        $captcha = $_GET['captcha'];
        $log_type = $_GET['type'];
        $logic_connect_api = Logic('connect_api');
        $state_data = $logic_connect_api->checkSmsCaptcha($phone, $captcha, $log_type);
        $this->connect_output_data($state_data, 1);
    }

    /**
     * 手机端注册
     */
    public function sms_registerAction222()
    {
        $user_name = $_POST['user_name']; //用户名
        $phone = $_POST['phone']; //手机号码
        $captcha = $_POST['captcha']; //短信校验码
        $password = $_POST['password']; //密码
        $client = $_POST['client']; //客户端标识
        $member_type_id = empty($_POST['member_type_id']) ? 1 : $_POST['member_type_id']; //身份id
        $inviteId = empty($_POST['inviteId']) ? 1 : decrypt($_REQUEST['inviteId'], MD5_KEY); //邀请人id
        $logic_connect_api = Logic('connect_api');

        //上传医务人员的资质证件
        if (intval($member_type_id) > 1 && !empty($state_data) && is_array($state_data)) {
            $param = array();
            $member_info = Member::findFirst("member_id=" . $state_data['userid']);
            if ($member_info !== false) {
                $member_info = $member_info->toArray();
                $param['member_id'] = $member_info['member_id']; //会员id
                $param['member_name'] = $member_info['member_name']; //会员名称
                $param['business_person_body'] = $this->upload_image('business_person_body'); //个人全身照
                $param['business_id_card'] = $this->upload_image('business_id_card'); //手持身份证半身照
                $param['business_qualification_certificate'] = $this->upload_image('business_qualification_certificate'); //医师资格证书
                $param['business_certified_certificate'] = $this->upload_image('business_certified_certificate'); //医师执业证书
                $param['joinin_state'] = STORE_JOIN_STATE_NEW; //新的申请状态
                $param['seller_name'] = $_POST['phone'];
                $param['store_name'] = $_POST['phone'];
                if (StoreJoinin::count("member_id=" . $member_info['member_id']) <= 0) { //表示新增
                    $store_join_model = new StoreJoinin();
                    $store_join_model->save($param);
                } else { //表示修改
                    $res = StoreJoinin::findFirst("member_id=" . $member_info['member_id']);
                    $res->save($param);
                }
            }
        } else {
            //把用户添加到数据库
            $state_data = $logic_connect_api->smsRegister($phone, $captcha, $password, $client, $member_type_id, $inviteId);
        }

        $this->connect_output_data($state_data);
    }

    /**
     * 手机端注册
     */
    public function sms_registerAction()
    {
        $user_name = $_POST['member_name']; //用户名
        $phone = $_POST['phone']; //手机号码
        $captcha = $_POST['captcha']; //短信校验码
        $password = $_POST['password']; //密码
        $client = $_POST['client']; //客户端标识
        $member_type_id = empty($_POST['member_type_id']) ? 1 : $_POST['member_type_id']; //身份id
        $inviteId = empty($_POST['inviteId']) ? 1 : decrypt($_REQUEST['inviteId'], MD5_KEY); //邀请人id


        //上传医务人员的资质证件
        if (intval($member_type_id) > 1) {
            $member = array();
            $member['member_name'] = $user_name;
            $member['member_passwd'] = $_POST['password'];
            $member['member_email'] = '输入常用邮箱作为验证及找回密码使用';
            $member['member_mobile'] = $_POST['phone'];
            $member['member_mobile_bind'] = 1;
            $member['member_type_id'] = $_POST['member_type_id']; //会员类型id
            $member['inviter_id'] = $inviteId; //邀请人id

            $member['business_person_body'] = $this->upload_image('business_person_body'); //个人全身照
            $member['business_id_card'] = $this->upload_image('business_id_card'); //手持身份证半身照
            $member['business_qualification_certificate'] = $this->upload_image('business_qualification_certificate'); //医师资格证书
            $member['business_certified_certificate'] = $this->upload_image('business_certified_certificate'); //医师执业证书
            $member['seller_name'] = $user_name;
            $member['store_name'] = $user_name;
            $member['add_time'] = time(); //申请时间
            write_file_cache($_POST['phone'], $member, null, '../storejoin_cache/'); //写入缓存
            $this->connect_output_data(array('msg' => 'ok'));
            exit;
        } else {
            //把用户添加到数据库
            $logic_connect_api = Logic('connect_api');
            $state_data = $logic_connect_api->smsRegister($phone, $captcha, $password, $client, $member_type_id, $inviteId, $user_name);
        }

        $this->connect_output_data($state_data);
    }

    /**
     * 向服务器保存上传的文件
     * @param string $file 浏览器提交的要上传的文件名
     * @return string 返回已经上传后的文件名称
     */
    private function upload_image($file)
    {
        $pic_name = '';
        $upload = new UploadFile();
        $uploaddir = ATTACH_PATH . DS . 'store_joinin' . DS;
        $upload->set('default_dir', $uploaddir);
        $upload->set('allow_type', array('jpg', 'jpeg', 'gif', 'png'));
        if (!empty($_FILES[$file]['name'])) {
            $result = $upload->upfile($file);
            if ($result) {
                $pic_name = $upload->file_name;
                $upload->file_name = '';
            }
        }
        return $pic_name;
    }

    /**
     * 手机找回密码
     */
    public function find_passwordAction()
    {
        $phone = $_POST['phone'];
        $captcha = $_POST['captcha'];
        $password = $_POST['password'];
        $client = $_POST['client'];
        $logic_connect_api = Logic('connect_api');
        $state_data = $logic_connect_api->smsPassword($phone, $captcha, $password, $client);
        $this->connect_output_data($state_data);
    }

    /**
     * 格式化输出数据
     */
    public function connect_output_data($state_data, $type = 0)
    {
        if ($state_data['state']) {
            unset($state_data['state']);
            unset($state_data['msg']);
            if ($type == 1) {
                $state_data = 1;
            }
            output_data($state_data);
        } else {
            output_error($state_data['msg']);
        }
    }

    /**
     * 加载用户身份列表
     */
    public function load_member_type_listAction()
    {
        $str = "";
        $member_type_list = MemberType::find("is_enable=1");
        if (count($member_type_list) > 0) {
            $member_type_list = $member_type_list->toArray();
            foreach ($member_type_list as $key => $val) {
                $str .= '<option value=' . $val['type_id'] . '>' . $val['type_name'] . '</option>';
            }
        }
        echo $str;
        exit;
    }
}
