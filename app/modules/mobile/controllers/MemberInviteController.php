<?php
/**
 * 邀请返利（生成二维码及邀请链接）
 */


namespace Ypk\Modules\Mobile\Controllers;


use Ypk\Model;
use Ypk\Models\StoreJoinin;

class MemberInviteController extends MobileMemberController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $member_id = $this->member_info['member_id'];
        //首先判断当前用户是否已经完善资料
        if (check_info_complete($member_id) != true && intval($this->member_info['member_type_id']) > 1) {
            output_data(array('msg' => 'nocomplete','member_type'=>'doctor'));
        }elseif(check_info_custom_complete($member_id) != true && intval($this->member_info['member_type_id']) === 1){
            output_data(array('msg' => 'nocomplete','member_type'=>'custom'));
        }
        else {
//            if (file_exists(BASE_UPLOAD_PATH . '/share_erweima/' . md5($member_id) . '.png')) {
//                //分享二维码已经存在，直接跳转到图片处
//                output_data(array('png_img' => UPLOAD_SITE_URL . '/share_erweima/' . md5($member_id) . '.png'));
//            }
            //$encode_member_id = base64_encode(intval($member_id) * 1);
            //$myurl = BASE_PATH . "/#V5" . $encode_member_id;
            //$myurl = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . "/public/h5_web/js_template/member/register_mobile.html/#V5" . $encode_member_id;
            $encode_member_id = encrypt($member_id, MD5_KEY);
            $myurl = getDomainName() . "/h5_web/js_template/member/register_mobile.html?inviteId=" . $encode_member_id; //邀请链

            $str_member = "memberqr_" . $member_id;
            $myurl_src = UPLOAD_SITE_URL . DS . "shop" . DS . "member" . DS . $str_member . '.png';
            $imgfile = BASE_UPLOAD_PATH . DS . "shop" . DS . "member" . DS . $str_member . '.png';
            if (!file_exists($imgfile)) {
                try {
                    include(BASE_PATH . '/public/resource/phpqrcode/index.php');
                } catch (\Exception $ex) {

                }
                $PhpQRCode = new \PhpQRCode();
                $PhpQRCode->set('pngTempDir', BASE_UPLOAD_PATH . DS . "shop" . DS . "member" . DS);
                $PhpQRCode->set('date', $myurl);
                $PhpQRCode->set('pngTempName', $str_member . '.png');
                $PhpQRCode->init();
            }
            $member_info = array();
            $member_info['user_name'] = $this->member_info['member_name']; //用户名
            $member_info['member_truename'] = $this->member_info['member_truename']; //真实姓名
            $member_info['avator'] = getMemberAvatarForID($this->member_info['member_id']);
            $member_info['point'] = $this->member_info['member_points'];
            $member_info['predepoit'] = $this->member_info['available_predeposit'];
            $member_info['available_rc_balance'] = $this->member_info['available_rc_balance'];
            $member_info['myurl'] = $myurl;
            $member_info['myurl_src'] = $myurl_src; //二维码图片链接
            $member_info['member_areainfo']=$this->member_info['member_areainfo'];

            //获取医生所在医院和职称
            $store_join_model = Model('store_joinin');
            $store_join_info = $store_join_model->getOne('member_id=' . $this->member_info['member_id']);
            if (!empty($store_join_info)) {
                $member_info['company_address'] = $store_join_info['company_address']; //省市县三级
                $member_info['business_lockHospital'] = $store_join_info['business_lockHospital']; //定点医院
                $member_info['business_departments'] = $store_join_info['business_departments']; //科室
                $member_info['business_professional'] = $store_join_info['business_professional']; //职称
            } else {
                $member_info['company_address'] = "";
                $member_info['business_lockHospital'] = "系统平台管理员"; //定点医院
                $member_info['business_departments'] = ""; //科室
                $member_info['business_professional'] = ""; //职称
            }

            //下载连接
            //$mydownurl=BASE_PATH."/index.php?act=invite&op=downqrfile&id=".$member_id;
            $mydownurl = getUrl('mobile/invite/downqrfile', array('id' => $member_id));
            $member_info['mydownurl'] = $mydownurl;

            //获取页面背景图片链接
            //获取4张登录界面的图片名称array('1.jpg','2.jpg','3.jpg','4.jpg')
            $_pic = @unserialize(getConfig('mobile_code_pic'));
            if ($_pic[0] != '') {
                //从设置的4张图片中随机获取一张进行显示
                $back_img = UPLOAD_SITE_URL_HTTPS . '/' . ATTACH_MOBILE . '/codeimg/' . $_pic[array_rand($_pic)];
            } else {
                $back_img = UPLOAD_SITE_URL_HTTPS . '/' . ATTACH_MOBILE . '/codeimg/' . rand(1, 4) . '.jpg';
            }
            $member_info['back_img'] = $back_img;
            output_data(array('member_info' => $member_info));
        }
    }

    /**
     * 生成分享的二维码图片
     */
    public function get_share_imgAction()
    {
        $member_id = $this->member_info['member_id'];
        $image_data = $_POST['imageData'];
        if (empty($image_data)) {
            output_error('分享二维码生成失败，请稍后重试');
        }
        $image_data = explode(',', $image_data);
        $image_name = md5($member_id) . '.png';
        if (!file_exists(BASE_UPLOAD_PATH . '/share_erweima')) {
            mkDirs(BASE_UPLOAD_PATH . '/share_erweima');
        }
        file_put_contents(BASE_UPLOAD_PATH . '/share_erweima/' . $image_name, base64_decode($image_data[1]));
        output_data(array('png_img' => UPLOAD_SITE_URL . '/share_erweima/' . $image_name));
    }
}
