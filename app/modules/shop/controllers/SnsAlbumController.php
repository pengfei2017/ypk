<?php
/**
 * 买家相册处理
 * User: Administrator
 * Date: 2017/1/11
 * Time: 0:33
 */

namespace Ypk\Modules\Shop\Controllers;

use Phalcon\Mvc\View;
use Ypk\Tpl;
use Ypk\UploadFile;

class SnsAlbumController extends BaseSNSController
{
    public function initialize()
    {
        parent::initialize();

        $lang = getTranslation('sns_album,sns_home');
        Tpl::output('menu_sign', 'snsalbum');

        $where = array();
        $where['name'] = !empty($this->master_info['member_truename']) ? $this->master_info['member_truename'] : $this->master_info['member_name'];
        Model('seo')->type('sns')->param($where)->show();
    }

    public function indexAction()
    {
        $this->album_cateAction();
        exit;
    }

    /**
     * 相册分类列表
     *
     */
    public function album_cateAction()
    {
        // 实例化模型
        $model = Model();
        // 验证是否存在默认相册
        $where = array();
        $where['member_id'] = $this->master_id;
        $where['is_default'] = 1;
        $class_info = $model->table('sns_albumclass')->where($where)->find();
        if (empty($class_info)) {
            $insert = array();
            $insert['ac_name'] = getLang('sns_buyershow');
            $insert['member_id'] = $this->master_id;
            $insert['ac_des'] = getLang('sns_buyershow_album_des');
            $insert['ac_sort'] = 1;
            $insert['is_default'] = 1;
            $insert['upload_time'] = time();
            $model->table('sns_albumclass')->insert($insert);
        }

        /**
         * 相册分类
         */
        $where = array();   // 条件
        $where['member_id'] = $this->master_id;
        $order = 'ac_sort asc';
        // 相册
        $ac_list = $model->table('sns_albumclass')->where($where)->order($order)->select();
        $count = 0; // 图片总数量
        if (!empty($ac_list)) {
            // 相册中商品数量
            $ap_count = $model->table('sns_albumpic')->field('count(ap_id) as count,ac_id')->where($where)->group('ac_id')->select();
            $ap_count = array_under_reset($ap_count, 'ac_id', 1);
            foreach ($ac_list as $key => $val) {
                if (isset($ap_count[$val['ac_id']])) {
                    $count += intval($ap_count[$val['ac_id']]['count']);
                    $ac_list[$key]['count'] = $ap_count[$val['ac_id']]['count'];
                } else {
                    $ac_list[$key]['count'] = 0;
                }
            }
        }
        Tpl::output('count', $count);
        Tpl::output('ac_list', $ac_list);

        self::profile_menu('album', 'album');
        //Tpl::showpage('sns_album_list');
        $this->view->render('sns_album', 'sns_album_list');
        $this->view->disable();
    }

    /**
     * 相册分类添加
     *
     */
    public function album_addAction()
    {
        $model = Model();
        $class_count = $model->table('sns_albumclass')->where(array('member_id' => $this->master_id))->count();
        Tpl::output('class_count', $class_count);
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('sns_album', 'sns_album_class_add');
        $this->view->disable();
        //Tpl::showpage('sns_album_class_add', 'null_layout');
    }

    /**
     * 相册保存
     *
     */
    public function album_add_saveAction()
    {
        if (chksubmit()) {
            $model = Model();
            $class_count = $model->table('sns_albumclass')->where(array('member_id' => $_SESSION['member_id']))->count();
            if ($class_count >= 10) {
                showDialog(getLang('album_class_save_max_10'), getUrl('shop/sns_album'), 'error');
            }
            $insert = array();
            $insert['ac_name'] = $_POST['name'];
            $insert['member_id'] = $_SESSION['member_id'];
            $insert['ac_des'] = $_POST['description'];
            $insert['ac_sort'] = intval($_POST['sort']);
            $insert['upload_time'] = time();

            $return = $model->table('sns_albumclass')->insert($insert);
            if ($return) {
                showDialog(getLang('album_class_save_succeed'), getUrl('shop/sns_album'), 'succ', empty($_GET['inajax']) ? '' : 'CUR_DIALOG.close();');
            }
        }
        showDialog(getLang('album_class_save_lose'));
    }

    /**
     * 相册分类编辑
     */
    public function album_editAction()
    {
        $id = intval($_GET['id']);
        if ($id <= 0) {
            echo getLang('album_parameter_error');
            exit;
        }
        /**
         * 实例化相册模型
         */
        $model = Model();
        $where = array();
        $where['ac_id'] = $id;
        $where['member_id'] = $_SESSION['member_id'];
        $class_info = $model->table('sns_albumclass')->where($where)->find();
        Tpl::output('class_info', $class_info);
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('sns_album', 'sns_album_class_edit');
        $this->view->disable();
        //Tpl::showpage('sns_album_class_edit', 'null_layout');
    }

    /**
     * 相册分类编辑保存
     */
    public function album_edit_saveAction()
    {
        $update = array();
        $update['ac_name'] = $_POST['name'];
        $update['ac_des'] = $_POST['description'];
        $update['ac_sort'] = intval($_POST['sort']);


        // 实例化模型
        $model = Model();
        // 更新
        $re = $model->table('sns_albumclass')->where(array('ac_id' => intval($_POST['id'])))->update($update);
        if ($re) {
            showDialog(getLang('album_class_edit_succeed'), getUrl('shop/sns_album'), 'succ', empty($_GET['inajax']) ? '' : 'CUR_DIALOG.close();');
        } else {
            showDialog(getLang('album_class_edit_lose'));
        }
    }

    /**
     * 相册删除
     */
    public function album_delAction()
    {
        $id = intval($_GET['id']);
        if ($id <= 0) {
            showMessage(getLang('album_parameter_error'), '', 'html', 'error');
        }
        $model = Model();
        //删除分类
        $return = $model->table('sns_albumclass')->where(array('ac_id' => $id, 'member_id' => $_SESSION['member_id']))->delete();
        if (!$return) {
            showDialog(getLang('album_class_file_del_lose'));
        }
        /**
         * 更新图片分类
         */
        $where = array();
        $where['is_default'] = 1;
        $where['member_id'] = $_SESSION['member_id'];
        $class_info = $model->table('sns_albumclass')->where($where)->find();
        $return = $model->where(array('ac_id' => $id))->update(array('ac_id' => $class_info['ac_id']));
        if ($return) {
            showDialog(getLang('album_class_file_del_succeed'), getUrl('shop/sns_album'), 'succ');
        } else {
            showDialog(getLang('album_class_file_del_lose'));
        }
    }

    /**
     * 图片列表
     */
    public function album_pic_listAction()
    {
        $id = intval($_GET['id']);
        if ($id <= 0) {
            showMessage(getLang('album_parameter_error'), '', 'html', 'error');
        }

        $model = Model();
        $where = array();
        $where['ac_id'] = $id;
        $param['member_id'] = $this->master_id;
        $order = 'ap_id desc';
        if ($_GET['sort'] != '') {
            switch ($_GET['sort']) {
                case '0':
                    $order = 'upload_time desc';
                    break;
                case '1':
                    $order = 'upload_time asc';
                    break;
                case '2':
                    $order = 'ap_size desc';
                    break;
                case '3':
                    $order = 'ap_size asc';
                    break;
                case '4':
                    $order = 'ap_name desc';
                    break;
                case '5':
                    $order = 'ap_name asc';
                    break;
            }
        }
        $pic_list = $model->table('sns_albumpic')->where($where)->order($order)->page(36)->select();
        Tpl::output('pic_list', $pic_list);
        Tpl::output('show_page', $model->showpage());


        /**
         * 相册列表
         */
        $where = array();
        $where['member_id'] = $this->master_id;
        $class_array = $model->table('sns_albumclass')->where($where)->select();
        if (empty($class_array)) {
            showMessage(getLang('wrong_argument'), '', '', 'error');
        }

        // 整理
        $class_array = array_under_reset($class_array, 'ac_id');
        $class_list = $class_info = array();
        foreach ($class_array as $val) {
            if ($val['ac_id'] == $id) {
                $class_info = $val;
            } else {
                $class_list[] = $val;
            }
        }
        Tpl::output('class_list', $class_list);
        Tpl::output('class_info', $class_info);

        self::profile_menu('album_pic', 'pic_list');
        $this->view->render('sns_album', 'sns_album_pic_list');
        $this->view->disable();
        //Tpl::showpage('sns_album_pic_list');
    }

    /**
     * 修改相册封面
     */
    public function change_album_coverAction()
    {
        $id = intval($_GET['id']);
        if ($id <= 0) {
            showDialog(getLang('nc_common_op_fail'));
        }
        $model = Model();
        /**
         * 图片信息
         */
        $where = array();
        $where['ap_id'] = $id;
        $where['member_id'] = $_SESSION['member_id'];
        $pic_info = $model->table('sns_albumpic')->where($where)->find();
        $update = array();
        $update['ac_cover'] = str_ireplace('.', '_240.', $pic_info['ap_cover']);
        $return = $model->table('sns_albumclass')->where(array('ac_id' => $pic_info['ac_id']))->update($update);
        if ($return) {
            showDialog(getLang('nc_common_op_succ'), 'reload', 'succ');
        } else {
            showDialog(getLang('nc_common_op_fail'));
        }
    }

    /**
     * 图片详细页
     */
    public function album_pic_infoAction()
    {
        $class_id = intval($_GET['class_id']);
        $id = intval($_GET['id']);
        if ($class_id <= 0 && $id <= 0) {
            showMessage(getLang('album_parameter_error'), '', 'html', 'error');
        }
        /**
         * 实例化相册类
         */
        $model = Model();

        /**
         * 图片列表
         */
        $where = array();
        $where['ac_id'] = $class_id;
        $where['member_id'] = $this->master_id;
        $each_num = 9;
        $pic_list = $model->table('sns_albumpic')->where($where)->order('ap_id desc')->page($each_num)->select();
        if (empty($pic_list)) {
            showMessage(getLang('wrong_argument'), '', '', 'error');
        }

        $curpage = intval($_GET['curpage']);
        if (empty($curpage)) $curpage = 1;
        Tpl::output('total_page', $model->gettotalpage());
        Tpl::output('curpage', $curpage);

        foreach ($pic_list as $key => $val) {
            if ($id == $val['ap_id']) {
                $pic_num = $key;
                $pic_info = $val;
            }
            $val['ap_size'] = sprintf('%.2f', intval($val['ap_size']) / 1024);
            $pic_list[$key] = $val;
        }
        if (!isset($pic_info)) {
            showMessage(getLang('wrong_argument'), '', '', 'error');
        }
        Tpl::output('pic_num', $pic_num);
        Tpl::output('pic_info', $pic_info);
        Tpl::output('pic_list', $pic_list);

        /**
         * 相册信息
         */
        $class_info = $model->table('sns_albumclass')->where($where)->find();
        Tpl::output('class_info', $class_info);

        self::profile_menu('album_pic_info', 'pic_info');
        $this->view->render('sns_album', 'sns_album_pic_info');
        $this->view->disable();
        //Tpl::showpage('sns_album_pic_info');
    }

    /**
     * 图片详细页
     */
    public function album_pic_scroll_ajaxAction()
    {
        $class_id = intval($_GET['class_id']);
        $id = intval($_GET['id']);
        if ($class_id <= 0 && $id <= 0) {
            exit();
        }
        /**
         * 实例化相册类
         */
        $model = Model();

        /**
         * 图片列表
         */
        $where = array();
        $where['ac_id'] = $class_id;
        $where['member_id'] = $this->master_id;
        $each_num = 9;
        $pic_list = $model->table('sns_albumpic')->where($where)->order('ap_id desc')->page($each_num)->select();
        if (empty($pic_list)) {
            exit();
        }

        foreach ($pic_list as $key => $val) {
            if ($id == $val['ap_id']) {
                $pic_num = $key;
                $pic_info = $val;
            }
            $val['ap_size'] = sprintf('%.2f', intval($val['ap_size']) / 1024);
            $pic_list[$key] = $val;
        }
        Tpl::output('pic_list', $pic_list);

        self::profile_menu('album_pic_info', 'pic_info');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('sns_album', 'sns_album_pic_info_scroll_ajax');
        $this->view->disable();
        //Tpl::showpage('sns_album_pic_info_scroll_ajax', 'null_layout');
    }

    /**
     * 图片删除
     */
    public function album_pic_delAction()
    {
        if (empty($_GET['id'])) {
            showDialog(getLang('album_parameter_error'));
        }
        if (!empty($_GET['id']) && is_array($_GET['id'])) {
            $id = $_GET['id'];
        } else {
            $id[] = intval($_GET['id']);
        }

        // 模型
        $model = Model();
        foreach ($id as $v) {
            $v = intval($v);
            if ($v <= 0) continue;
            $ap_info = $model->table('sns_albumpic')->where(array('ap_id' => $v, 'member_id' => $_SESSION['member_id']))->find();
            if (empty($ap_info)) continue;
            @unlink(BASE_UPLOAD_PATH . DS . ATTACH_MALBUM . DS . $_SESSION['member_id'] . DS . $ap_info['ap_cover']);
            @unlink(BASE_UPLOAD_PATH . DS . ATTACH_MALBUM . DS . $_SESSION['member_id'] . DS . str_ireplace('.', '_240.', $ap_info['ap_cover']));
            @unlink(BASE_UPLOAD_PATH . DS . ATTACH_MALBUM . DS . $_SESSION['member_id'] . DS . str_ireplace('.', '_1024.', $ap_info['ap_cover']));
            $model->table('sns_albumpic')->where(array('ap_id' => $ap_info['ap_id']))->delete();
        }
        showDialog(getLang('album_class_pic_del_succeed'), 'reload', 'succ');
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
        $album_menuname = ($this->relation == 3 ? getLang('sns_me') : 'TA') . getLang('nc_sns_path_my_album');
        switch ($menu_type) {
            case 'album':
                $menu_array = array(
                    1 => array('menu_key' => 'album', 'menu_name' => $album_menuname, 'menu_url' => getUrl('shop/sns_album', array('mid' => $this->master_id))),
                );
                break;
            case 'album_pic':
                $menu_array = array(
                    1 => array('menu_key' => 'album', 'menu_name' => $album_menuname, 'menu_url' => getUrl('shop/sns_album', array('mid' => $this->master_id))),
                    2 => array('menu_key' => 'pic_list', 'menu_name' => getLang('nc_sns_path_album_pic_list'), 'menu_url' => getUrl('shop/sns_album/album_pic_list', array('mid' => $this->master_id, 'id' => intval($_GET['id'])))),
                );
                break;
            case 'album_pic_info':
                $menu_array = array(
                    1 => array('menu_key' => 'album', 'menu_name' => $album_menuname, 'menu_url' => getUrl('shop/sns_album', array('mid' => $this->master_id))),
                    2 => array('menu_key' => 'pic_info', 'menu_name' => getLang('nc_sns_path_album_pic_info'), 'menu_url' => getUrl('shop/sns_album/album_pic_info', array('mid' => $this->master_id, 'class_id' => intval($_GET['class_id']), 'id' => intval($_GET['id'])))),
                );
                break;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
    }

    /**
     * ajax返回图片信息
     */
    public function ajax_change_imgmessageAction()
    {
        $url = explode('/', $_GET['url']);
        $str = array_pop($url);
        $str = explode('.', $str);
        /**
         * 实例化图片模型
         */
        $model = Model();
        $where = array();
        $where['member_id'] = $this->master_id;
        $where['ap_cover'] = array('like', '%' . $str['0'] . '%');
        $pic_info = $model->table('sns_albumpic')->where($where)->find();

        /**
         * 小图尺寸
         */
//        if (strtoupper(CHARSET) == 'GBK') {
//            $pic_info['ap_name'] = getLang($pic_info['ap_name']);
//        }
        echo json_encode(array(
            'img_name' => $pic_info['ap_name'],
            'default_size' => sprintf('%.2f', intval($pic_info['ap_size']) / 1024),
            'default_spec' => $pic_info['ap_spec'],
            'upload_time' => date('Y-m-d', $pic_info['upload_time'])
        ));
        exit;
    }

    /**
     * 上传图片
     *
     */
    public function swfuploadAction()
    {
        $member_id = $_SESSION['member_id'];
        $class_id = intval($_POST['category_id']);
        if ($member_id <= 0 && $class_id <= 0) {
            echo json_encode(array('state' => 'false', 'message' => getLang('sns_upload_pic_fail'), 'origin_file_name' => $_FILES["file"]["name"]));
            exit;
        }

        $model = Model();
        // 验证图片数量
        $count = $model->table('sns_albumpic')->where(array('member_id' => $member_id))->count();
        if (getConfig('malbum_max_sum') != 0 && $count >= getConfig('malbum_max_sum')) {
            echo json_encode(array('state' => 'false', 'message' => getLang('sns_upload_img_max_num_error'), 'origin_file_name' => $_FILES["file"]["name"]));
            exit;
        }

        $upload = new UploadFile();
        $upload_dir = ATTACH_MALBUM . DS . $member_id . DS;

        $upload->set('default_dir', $upload_dir . $upload->getSysSetPath());
        $thumb_width = '240,1024';
        $thumb_height = '2048,1024';

        $upload->set('max_size', getConfig('image_max_filesize'));
        $upload->set('thumb_width', $thumb_width);
        $upload->set('thumb_height', $thumb_height);
        $upload->set('fprefix', $member_id);
        $upload->set('thumb_ext', '_240,_1024');
        $result = $upload->upfile('file');
        if (!$result) {
            echo json_encode(array('state' => 'false', 'message' => getLang('sns_upload_pic_fail'), 'origin_file_name' => $_FILES["file"]["name"]));
            exit;
        }

        $img_path = $upload->getSysSetPath() . $upload->file_name;
        list($width, $height, $type, $attr) = getimagesize(BASE_UPLOAD_PATH . DS . ATTACH_MALBUM . DS . $member_id . DS . $img_path);

        $image = explode('.', $_FILES["file"]["name"]);


//        if (strtoupper(CHARSET) == 'GBK') {
//            $image['0'] = Language::getGBK($image['0']);
//        }
        $insert = array();
        $insert['ap_name'] = $image['0'];
        $insert['ac_id'] = $class_id;
        $insert['ap_cover'] = $img_path;
        $insert['ap_size'] = intval($_FILES['file']['size']);
        $insert['ap_spec'] = $width . 'x' . $height;
        $insert['upload_time'] = time();
        $insert['member_id'] = $member_id;
        $result = $model->table('sns_albumpic')->insert($insert);

        $data = array();
        $data['file_id'] = $result;
        $data['file_name'] = $img_path;
        $data['origin_file_name'] = $_FILES["file"]["name"];
        $data['file_path'] = $img_path;
        $data['file_url'] = snsThumb($img_path, 240);
        $data['state'] = 'true';
        $output = json_encode($data);
        echo $output;
        exit;
    }

    /**
     * ajax验证名称时候重复
     */
    public function ajax_check_class_nameAction()
    {
        $ac_name = trim($_GET['ac_name']);
        if ($ac_name == '') {
            echo 'true';
            die;
        }
        $model = Model();
        $where = array();
        $where['ac_name'] = $ac_name;
        $where['member_id'] = $_SESSION['member_id'];;
        $class_info = $model->table('sns_albumclass')->where($where)->count();
        if (!empty($class_info)) {
            echo 'false';
            die;
        } else {
            echo 'true';
            die;
        }
    }
}
