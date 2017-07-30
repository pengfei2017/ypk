<?php
/**
 * 邀请返利处理逻辑
 * User: Administrator
 * Date: 2016/11/29
 * Time: 19:55
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Tpl;

class InviteController extends BaseHomeController
{

    protected function initialize()
    {
        parent::initialize();
        if (empty(getSession('is_login')) || getSession('is_login') != "1") {
            @header("Location: " . getUrl('member/login/index')); //跳转到会员登录页面
            exit;
        }
    }

    public function indexAction()
    {
        //$myurl=$this->maker_qrcodeAction(getSession('member_id')); //生成二维码图片链接
        //$this->view->setVar('myurl', $myurl);

        //$mydownurl=BASE_SITE_URL."/index.php?act=invite&op=downqrfile&id=".$_SESSION['member_id'];
        //$this->view->setVar('mydownurl', $mydownurl);
        //Tpl::showpage('invite');

        //设置手机二维码链接及图片
        $encode_member_id = encrypt(getSession('member_id'), MD5_KEY);
        $myurl = getDomainName() . "/h5_web/js_template/member/register_mobile.html?inviteId=" . $encode_member_id; //邀请链
        $str_member = "memberqr_" . getSession('member_id');
        $myurl_src = UPLOAD_SITE_URL . DS . "shop" . DS . "member" . DS . $str_member . '.png'; //二维码图片路径
        $imgfile = BASE_UPLOAD_PATH . DS . "shop" . DS . "member" . DS . $str_member . '.png';

        if(file_exists($imgfile)){
            @unlink($imgfile);
        }
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

        Tpl::output('myurl_src', $myurl_src);
        $this->view->pick('index/invite');
    }

    /**
     * 获取二维码图片链接
     * @param $id
     * @return string
     */
    public function maker_qrcodeAction($id)
    {
        $id = intval($id);
        if ($id <= 0) {
            $id = intval($_GET['id']);
        }
        if ($id <= 0) {
            return UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . 'default_qrcode.png';
        }

        $str_member = "memberqr_" . $id;
        $imgfile = BASE_UPLOAD_PATH . DS . "shop" . DS . "member" . DS . $str_member . '.png';
        if (!file_exists($imgfile)) {
            $member_id = base64_encode(intval($id) * 1);
            $myurl = getDomainName() . "/member/login/index?inviteId=" . $member_id;
            require_once(RESOURCE_SITE_URL . DS . 'phpqrcode' . DS . 'index.php');
            $PhpQRCode = new \PhpQRCode();

            $PhpQRCode->set('pngTempDir', UPLOAD_SITE_URL . DS . "shop" . DS . "member" . DS);
            $PhpQRCode->set('date', $myurl);
            $PhpQRCode->set('pngTempName', $str_member . '.png');
            $PhpQRCode->init();
        }
        return UPLOAD_SITE_URL . DS . "shop" . DS . "member" . DS . $str_member . '.png';

    }

    /**
     * 下载二维码图片
     */
    public function downqrfileAction()
    {

        $id = $_GET['id'];
        if ($id <= 0) die('请先登录会员后，再来这里操作哦。');
        $str_member = "memberqr_" . $id;
        $fileurl = BASE_UPLOAD_PATH . DS . "shop" . DS . "member" . DS . $str_member . ".png";


        ob_start();
        $filename = $fileurl;
        $date = date("Ymd-H:i:m");
        header("Content-type:  application/octet-stream ");
        header("Accept-Ranges:  bytes ");
        header("Content-Disposition:  attachment;  filename= {$str_member}.png");
        $size = readfile($filename);
        header("Accept-Length: " . $size);
    }
}