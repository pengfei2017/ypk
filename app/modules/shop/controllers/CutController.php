<?php
/**
 * 图片裁剪
 * User: Administrator
 * Date: 2016/12/13
 * Time: 3:57
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Tpl;
use Ypk\UploadFile;

class CutController extends BaseMemberController
{

    /**
     * 图片上传
     *
     */
    public function pic_uploadAction()
    {
        if (chksubmit()) {
            //上传图片
            $upload = new UploadFile();
            $upload->set('thumb_width', 500);
            $upload->set('thumb_height', 499);
            $upload->set('thumb_ext', '_small');
            $upload->set('max_size', getConfig('image_max_filesize') ? getConfig('image_max_filesize') : 1024);
            $upload->set('ifremove', true);
            $upload->set('default_dir', $_GET['uploadpath']);

            if (!empty($_FILES['_pic']['tmp_name'])) {
                $result = $upload->upfile('_pic');
                if ($result) {
                    exit(json_encode(array('status' => 1, 'url' => UPLOAD_SITE_URL . '/' . $_GET['uploadpath'] . '/' . $upload->thumb_image)));
                } else {
                    exit(json_encode(array('status' => 0, 'msg' => $upload->error)));
                }
            }
        }
    }

    /**
     * 图片裁剪
     *
     */
    public function pic_cutAction()
    {
        //import('function.thumb');
        if (chksubmit()) {
            $thumb_width = $_POST['x'];
            $x1 = $_POST["x1"];
            $y1 = $_POST["y1"];
            $x2 = $_POST["x2"];
            $y2 = $_POST["y2"];
            $w = $_POST["w"];
            $h = $_POST["h"];
            $scale = $thumb_width / $w;
            $src = str_ireplace(UPLOAD_SITE_URL, BASE_UPLOAD_PATH, $_POST['url']);
            if (strpos($src, '..') !== false || strpos($src, BASE_UPLOAD_PATH) !== 0) {
                exit();
            }
            $save_file2 = str_replace('_small.', '_sm.', $src);
            $cropped = resize_thumb($save_file2, $src, $w, $h, $x1, $y1, $scale);
            @unlink($src);
            $pathinfo = pathinfo($save_file2);
            exit($pathinfo['basename']);
        } else {
            $this->translation = getTranslation('cut');
            $lang = $this->translation;
        }
        $save_file = str_ireplace(UPLOAD_SITE_URL, BASE_UPLOAD_PATH, $_GET['url']);
        $_GET['x'] = (intval($_GET['x']) > 50 && $_GET['x'] < 400) ? $_GET['x'] : 200;
        $_GET['y'] = (intval($_GET['y']) > 50 && $_GET['y'] < 400) ? $_GET['y'] : 200;
        $_GET['resize'] = $_GET['resize'] == '0' ? '0' : '1';
        Tpl::output('height', get_height($save_file));
        Tpl::output('width', get_width($save_file));
        //Tpl::showpage('cut', 'null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('cut','cut');
        $this->view->disable();
    }
}