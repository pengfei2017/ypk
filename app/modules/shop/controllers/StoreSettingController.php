<?php
/**
 * 医生中心-医生设置
 * User: Administrator
 * Date: 2016/12/13
 * Time: 2:26
 */

namespace Ypk\Modules\Shop\Controllers;

use Ypk\Tpl;
use Ypk\UploadFile;

class StoreSettingController extends BaseSellerController
{

    const MAX_MB_SLIDERS = 5;

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('member_store_index,member_layout');
    }

    /**
     * 卖家医生设置
     *
     * @internal param $string
     * @internal param $string
     */
    public function store_settingAction()
    {
        $model_class = Model('store');
        /**
         * 获取设置
         */
        // $setting_config = $GLOBALS['setting_config'];
        $config_subdomain_edit = getConfig('subdomain_edit');
        $config_subdomain_times = getConfig('subdomain_times');
        $config_subdomain_length = getConfig('subdomain_length');
        $config_subdomain_reserved = getConfig('subdomain_reserved');
        $config_enabled_subdomain = getConfig('enabled_subdomain');

        $store_id = getSession('store_id');//当前医生ID
        /**
         * 获取医生信息
         */
        $store_info = $model_class->getStoreInfoByID($store_id);
        $subdomain_edit = intval($config_subdomain_edit);//二级域名是否可修改
        $subdomain_times = intval($config_subdomain_times);//系统设置二级域名可修改次数
        $store_domain_times = intval($store_info['store_domain_times']);//医生已修改次数
        $subdomain_length = explode('-', $config_subdomain_length);
        $subdomain_length[0] = intval($subdomain_length[0]);
        $subdomain_length[1] = intval($subdomain_length[1]);
        if ($subdomain_length[0] < 1 || $subdomain_length[0] >= $subdomain_length[1]) {//域名长度
            $subdomain_length[0] = 3;
            $subdomain_length[1] = 12;
        }
        Tpl::output('subdomain_length', $subdomain_length);
        /**
         * 保存医生设置
         */
        if (chksubmit()) {
            $_POST['store_domain'] = trim($_POST['store_domain']);
            $store_domain = strtolower($_POST['store_domain']);
            //判断是否设置二级域名
            if (!empty($store_domain) && $store_domain != $store_info['store_domain']) {
                $store_domain_count = strlen($store_domain);
                if ($store_domain_count < $subdomain_length[0] || $store_domain_count > $subdomain_length[1]) {
                    showDialog(getLang('store_setting_wrong_uri') . ': ' . $config_subdomain_length, 'reload', 'error');
                }
                if (!preg_match('/^[\w-]+$/i', $store_domain)) {//判断域名是否正确
                    showDialog(getLang('store_setting_lack_uri'));
                }
                $store = $model_class->getStoreInfo(array(
                    'store_domain' => $store_domain
                ));
                //二级域名存在,则提示错误
                if (!empty($store) && ($store_id != $store['store_id'])) {
                    showDialog(getLang('store_setting_exists_uri'), 'reload', 'error');
                }
                //判断二级域名是否为系统禁止
                $subdomain_reserved = @explode(',', $config_subdomain_reserved);
                if (!empty($subdomain_reserved) && is_array($subdomain_reserved)) {
                    if (in_array($store_domain, $subdomain_reserved)) {
                        showDialog(getLang('store_setting_invalid_uri'));
                    }
                }
                if ($subdomain_times > $store_domain_times) {//可继续修改
                    $param = array();
                    $param['store_domain'] = $store_domain;
                    if (!empty($store_info['store_domain'])) $param['store_domain_times'] = $store_domain_times + 1;//第一次保存不计数
                    $model_class->editStore($param, array('store_id' => $store_id));
                }
                $_POST['store_domain'] = '';//避免重复更新
            }
            $upload = new UploadFile();
            /**
             * 上传医生图片
             */
            if (!empty($_FILES['store_banner']['name'])) {
                $upload->set('default_dir', ATTACH_STORE);
                $upload->set('thumb_ext', '');
                $upload->set('file_name', '');
                $upload->set('ifremove', false);
                $result = $upload->upfile('store_banner');
                if ($result) {
                    $_POST['store_banner'] = $upload->file_name;
                } else {
                    showDialog($upload->error);
                }
            }

            //删除旧医生图片
            if (!empty($_POST['store_banner']) && !empty($store_info['store_banner'])) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . $store_info['store_banner']);
            }

            /**
             * 上传医生图片
             */
            if (!empty($_FILES['store_label']['name'])) {
                $upload->set('default_dir', ATTACH_STORE);
                $upload->set('thumb_ext', '');
                $upload->set('file_name', '');
                $upload->set('ifremove', false);
                $result = $upload->upfile('store_label');
                if ($result) {
                    $_POST['store_label'] = $upload->file_name;
                } else {
                    showDialog($upload->error);
                }
            }

            //删除旧医生图片
            if (!empty($_POST['store_label']) && !empty($store_info['store_label'])) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . $store_info['store_label']);
            }

            //删除旧医生图片
            if (!empty($_POST['store_logo']) && !empty($store_info['store_logo'])) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_STORE . DS . $store_info['store_logo']);
            }
            /**
             * 更新入库
             */
            $param = array(
                'store_label' => empty($_POST['store_label']) ? $store_info['store_label'] : $_POST['store_label'],
                'store_banner' => empty($_POST['store_banner']) ? $store_info['store_banner'] : $_POST['store_banner'],
                'store_avatar' => empty($_POST['store_avatar']) ? $store_info['store_avatar'] : $_POST['store_avatar'],
                'store_vrcode_prefix' => preg_match('/^[a-zA-Z0-9]{1,3}$/', $_POST['store_vrcode_prefix']) ? $_POST['store_vrcode_prefix'] : null,
                'store_qq' => $_POST['store_qq'],
                'store_ww' => $_POST['store_ww'],
                'store_phone' => $_POST['store_phone'],
                'store_zy' => $_POST['store_zy'],
                'store_keywords' => $_POST['seo_keywords'],
                'store_description' => $_POST['seo_description']
            );
            if (!empty($_POST['store_theme'])) {
                $param['store_theme'] = $_POST['store_theme'];
            }


            $model_class->editStore($param, array('store_id' => $store_id));
            showDialog(getLang('nc_common_save_succ'), getUrl('shop/store_setting/store_setting'), 'succ');
        }
        /**
         * 实例化医生等级模型
         */
        // $model_store_grade   = Model('store_grade');
        // $store_grade     = $model_store_grade->getOneGrade($store_info['grade_id']);

        // 从基类中读取医生等级信息
        $store_grade = $this->store_grade;

        //编辑器多媒体功能
        $editor_multimedia = false;
        $sg_fun = @explode('|', $store_grade['sg_function']);
        if (!empty($sg_fun) && is_array($sg_fun)) {
            foreach ($sg_fun as $fun) {
                if ($fun == 'editor_multimedia') {
                    $editor_multimedia = true;
                }
            }
        }
        Tpl::output('editor_multimedia', $editor_multimedia);
        if ($subdomain_edit == 1 && ($subdomain_times > $store_domain_times)) {//可继续修改二级域名
            Tpl::output('subdomain_edit', $subdomain_edit);
        }
        /**
         * 输出医生信息
         */
        self::profile_menu('store_setting');
        Tpl::output('store_info', $store_info);
        Tpl::output('store_grade', $store_grade);
        Tpl::output('subdomain', $config_enabled_subdomain);
        Tpl::output('subdomain_times', $config_subdomain_times);

        //Tpl::showpage('store_setting_form');
        $this->view->render('store_setting', 'store_setting_form');
        $this->view->disable();
    }

    /**
     * 医生幻灯片
     */
    public function store_slideAction()
    {
        /**
         * 模型实例化
         */
        $model_store = Model('store');
        $model_upload = Model('upload');
        /**
         * 保存医生信息
         */
        if ($_POST['form_submit'] == 'ok') {
            // 更新医生信息
            $update = array();
            $update['store_slide'] = implode(',', $_POST['image_path']);
            $update['store_slide_url'] = implode(',', $_POST['image_url']);
            $model_store->editStore($update, array('store_id' => getSession('store_id')));

            // 删除upload表中数据
            $model_upload->delByWhere(array('upload_type' => 3, 'item_id' => getSession('store_id')));
            showDialog(getLang('nc_common_save_succ'), getUrl('shop/store_setting/store_slide'), 'succ');
        }

        // 删除upload中的无用数据
        $upload_info = $model_upload->getUploadList(array('upload_type' => 3, 'item_id' => getSession('store_id')), 'file_name');
        if (is_array($upload_info) && !empty($upload_info)) {
            foreach ($upload_info as $val) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_SLIDE . DS . $val['file_name']);
            }
        }
        $model_upload->delByWhere(array('upload_type' => 3, 'item_id' => getSession('store_id')));

        $store_info = $model_store->getStoreInfoByID(getSession('store_id'));
        if ($store_info['store_slide'] != '' && $store_info['store_slide'] != ',,,,') {
            Tpl::output('store_slide', explode(',', $store_info['store_slide']));
            Tpl::output('store_slide_url', explode(',', $store_info['store_slide_url']));
        }
        self::profile_menu('store_slide');

        //Tpl::showpage('store_slide_form');
        $this->view->render('store_setting', 'store_slide_form');
        $this->view->disable();
    }

    /**
     * 医生幻灯片ajax上传
     */
    public function silde_image_uploadAction()
    {
        $upload = new UploadFile();
        $upload->set('default_dir', ATTACH_SLIDE);
        $upload->set('max_size', getConfig('image_max_filesize'));

        $result = $upload->upfile($_POST['id']);


        $output = array();
        if (!$result) {
            $output['error'] = $upload->error;
            echo json_encode($output);
            die;
        }

        $img_path = $upload->file_name;

        /**
         * 模型实例化
         */
        $model_upload = Model('upload');

        if (intval($_POST['file_id']) > 0) {
            $file_info = $model_upload->getOneUpload($_POST['file_id']);
            @unlink(BASE_UPLOAD_PATH . DS . ATTACH_SLIDE . DS . $file_info['file_name']);

            $update_array = array();
            $update_array['upload_id'] = intval($_POST['file_id']);
            $update_array['file_name'] = $img_path;
            $update_array['file_size'] = $_FILES[$_POST['id']]['size'];
            $model_upload->updates($update_array);

            $output['file_id'] = intval($_POST['file_id']);
            $output['id'] = $_POST['id'];
            $output['file_name'] = $img_path;
            echo json_encode($output);
            die;
        } else {
            /**
             * 图片数据入库
             */
            $insert_array = array();
            $insert_array['file_name'] = $img_path;
            $insert_array['upload_type'] = '3';
            $insert_array['file_size'] = $_FILES[$_POST['id']]['size'];
            $insert_array['item_id'] = getSession('store_id');
            $insert_array['upload_time'] = time();

            $result = $model_upload->add($insert_array);

            if (!$result) {
                @unlink(BASE_UPLOAD_PATH . DS . ATTACH_SLIDE . DS . $img_path);
                $output['error'] = getLang('store_slide_upload_fail', 'UTF-8');
                echo json_encode($output);
                die;
            }

            $output['file_id'] = $result;
            $output['id'] = $_POST['id'];
            $output['file_name'] = $img_path;
            echo json_encode($output);
            die;
        }
    }

    /**
     * ajax删除幻灯片图片
     */
    public function dorp_imgAction()
    {
        /**
         * 模型实例化
         */
        $model_upload = Model('upload');
        $file_info = $model_upload->getOneUpload(intval($_GET['file_id']));
        if (!$file_info) {
        } else {
            @unlink(BASE_UPLOAD_PATH . DS . ATTACH_SLIDE . DS . $file_info['file_name']);
            $model_upload->del(intval($_GET['file_id']));
        }
        echo json_encode(array('succeed' => getLang('nc_common_save_succ', 'UTF-8')));
        die;
    }

    /**
     * 卖家医生主题设置
     *
     * @internal param $string
     * @internal param $string
     */
    public function themeAction()
    {
        /**
         * 医生信息
         */
        $store_class = Model('store');
        $store_info = $store_class->getStoreInfoByID(getSession('store_id'));
        /**
         * 主题配置信息
         */
        $style_data = array();
        $style_configurl = MODULE_RESOURCE . DS . 'style' . DS . "styleconfig.php";
        if (file_exists($style_configurl)) {
            include_once($style_configurl);
        }

        /**
         * 当前医生主题
         */
        $curr_store_theme = !empty($store_info['store_theme']) ? $store_info['store_theme'] : 'default';
        /**
         * 当前医生预览图片
         */
        $curr_image = MODULE_RESOURCE . '/store/style/' . $curr_store_theme . '/images/preview.jpg';
        $curr_theme = array(
            'curr_name' => $curr_store_theme,
            'curr_truename' => $style_data[$curr_store_theme]['truename'],
            'curr_image' => $curr_image
        );

        // 自营店全部可用
        if (checkPlatformStore()) {
            $themes = array_keys($style_data);
        } else {
            /**
             * 医生等级
             */
            $grade_class = Model('store_grade');
            $grade = $grade_class->getOneGrade($store_info['grade_id']);
            /**
             * 可用主题
             */
            $themes = explode('|', $grade['sg_template']);
        }

        /**
         * 可用主题预览图片
         */
        foreach ($style_data as $key => $val) {
            if (in_array($key, $themes)) {
                $theme_list[$key] = array(
                    'name' => $key,
                    'truename' => $val['truename'],
                    'image' => MODULE_RESOURCE . '/store/style/' . $key . '/images/preview.jpg'
                );
            }
        }
        /**
         * 页面输出
         */
        self::profile_menu('store_theme', 'store_theme');
        Tpl::output('store_info', $store_info);
        Tpl::output('curr_theme', $curr_theme);
        Tpl::output('theme_list', $theme_list);
        //Tpl::showpage('store_theme');
        $this->view->render('store_setting', 'store_theme');
        $this->view->disable();
    }

    /**
     * 卖家医生主题设置
     *
     * @internal param $string
     * @internal param $string
     */
    public function set_themeAction()
    {
        //读取语言包
        $lang = $this->translation;
        $style = isset($_GET['style_name']) ? trim($_GET['style_name']) : null;

        if (!empty($style) && file_exists(MODULE_RESOURCE . DS . '/store/style/' . $style . '/images/preview.jpg')) {
            $store_class = Model('store');
            $rs = $store_class->editStore(array('store_theme' => $style), array('store_id' => getSession('store_id')));
            showDialog($lang['store_theme_congfig_success'], 'reload', 'succ');
        } else {
            showDialog($lang['store_theme_congfig_fail'], '', 'succ');
        }
    }

    protected function getStoreMbSliders()
    {
        $store_info = Model('store')->getStoreInfoByID(getSession('store_id'));
        $mbSliders = @unserialize($store_info['mb_sliders']);
        if (!$mbSliders) {
            $mbSliders = array_fill(1, self::MAX_MB_SLIDERS, array(
                'img' => '',
                'type' => 1,
                'link' => '',
            ));
        }
        return $mbSliders;
    }

    protected function setStoreMbSliders(array $mbSliders)
    {
        return Model('store')->editStore(array(
            'mb_sliders' => serialize($mbSliders),
        ), array(
            'store_id' => getSession('store_id'),
        ));
    }

    public function store_mb_slidersAction()
    {
        try {
            $fileName = (string)$_POST['id'];
            if (!preg_match('/^file_(\d+)$/', $fileName, $fileIndex) || empty($_FILES[$fileName]['name'])) {
                throw new \Exception('参数错误');
            }

            $fileIndex = (int)$fileIndex[1];
            if ($fileIndex < 1 || $fileIndex > self::MAX_MB_SLIDERS) {
                throw new \Exception('参数错误2');
            }

            $mbSliders = $this->getStoreMbSliders();

            $upload = new UploadFile();
            $upload->set('default_dir', ATTACH_STORE);
            $upload->set('thumb_ext', '');
            $upload->set('file_name', '');
            $upload->set('ifremove', false);
            $result = $upload->upfile($fileName);

            if (!$result) {
                throw new \Exception($upload->error);
            }

            $oldImg = $mbSliders[$fileIndex]['img'];
            $newImg = $upload->file_name;

            $mbSliders[$fileIndex]['img'] = $newImg;

            if (!$this->setStoreMbSliders($mbSliders)) {
                throw new \Exception('更新失败');
            }

            if ($oldImg && file_exists($oldImg)) {
                unlink($oldImg);
            }

            echo json_encode(array(
                'uploadedUrl' => UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . $newImg,
            ));

        } catch (\Exception $ex) {
            echo json_encode(array(
                'error' => $ex->getMessage(),
            ));
        }
    }

    public function store_mb_sliders_dropAction()
    {
        try {
            $id = (int)$_REQUEST['id'];
            if ($id < 1 || $id > self::MAX_MB_SLIDERS) {
                throw new \Exception('参数错误');
            }

            $mbSliders = $this->getStoreMbSliders();

            $mbSliders[$id]['img'] = '';

            if (!$this->setStoreMbSliders($mbSliders)) {
                throw new \Exception('更新失败');
            }

            echo json_encode(array(
                'success' => true,
            ));

        } catch (\Exception $ex) {
            echo json_encode(array(
                'success' => false,
                'error' => $ex->getMessage(),
            ));
        }
    }

    public function store_mobileAction()
    {
        Tpl::output('max_mb_sliders', self::MAX_MB_SLIDERS);

        $store_info = Model('store')->getStoreInfoByID(getSession('store_id'));

        // 页头背景图
        $mb_title_img = $store_info['mb_title_img']
            ? UPLOAD_SITE_URL . '/' . ATTACH_STORE . '/' . $store_info['mb_title_img']
            : '';

        // 轮播
        $mbSliders = $this->getStoreMbSliders();

        if (chksubmit()) {
            $update_array = array();
            $upload = new UploadFile();

            // mb_title_img
            if ($mb_title_img_del = !empty($_POST['mb_title_img_del'])) {
                $update_array['mb_title_img'] = '';
            }
            if (!empty($_FILES['mb_title_img']['name'])) {
                $upload->set('default_dir', ATTACH_STORE);
                $upload->set('thumb_ext', '');
                $upload->set('file_name', '');
                $upload->set('ifremove', false);
                $result = $upload->upfile('mb_title_img');
                if ($result) {
                    $mb_title_img_del = true;
                    $update_array['mb_title_img'] = $upload->file_name;
                } else {
                    showDialog($upload->error);
                }
            }
            if ($mb_title_img_del && $mb_title_img && file_exists($mb_title_img)) {
                unlink($mb_title_img);
            }

            // mb_sliders
            $skuToValid = array();
            foreach ((array)$_POST['mb_sliders_links'] as $k => $v) {
                if ($k < 1 || $k > self::MAX_MB_SLIDERS) {
                    showDialog('参数错误');
                }

                $type = (int)$_POST['mb_sliders_type'][$k];
                switch ($type) {
                    case 1:
                        // 链接URL
                        $v = (string)$v;
                        if (!preg_match('#^https?://#', $v)) {
                            $v = '';
                        }
                        break;

                    case 2:
                        // 商品ID
                        $v = (int)$v;
                        if ($v < 1) {
                            $v = '';
                        } else {
                            $skuToValid[$k] = $v;
                        }
                        break;

                    default:
                        $type = 1;
                        $v = '';
                        break;
                }

                $mbSliders[$k]['type'] = $type;
                $mbSliders[$k]['link'] = $v;
            }

            if ($skuToValid) {
                $validSkus = (array)Model()->table('goods')->field('goods_id')->where(array(
                    'goods_id' => array('in', $skuToValid),
                    'store_id' => getSession('store_id'),
                ))->key('goods_id')->select();

                foreach ($skuToValid as $k => $v) {
                    if (!isset($validSkus[$v])) {
                        $mbSliders[$k]['link'] = '';
                    }
                }
            }

            // sort
            for ($i = 0; $i < self::MAX_MB_SLIDERS; $i++) {
                $sortedMbSliders[$i + 1] = $mbSliders[$_POST['mb_sliders_sort'][$i]];
            }

            $update_array['mb_sliders'] = serialize($sortedMbSliders);

            Model('store')->editStore($update_array, array(
                'store_id' => getSession('store_id'),
            ));

            showDialog('保存成功', getUrl('shop/store_setting/store_mobile'), 'succ');
        }

        $mbSliderUrls = array();
        foreach ($mbSliders as $v) {
            if ($v['img']) {
                $mbSliderUrls[] = UPLOAD_SITE_URL . DS . ATTACH_STORE . DS . $v['img'];
            }
        }

        Tpl::output('mb_title_img', $mb_title_img);
        Tpl::output('mbSliders', $mbSliders);
        Tpl::output('mbSliderUrls', $mbSliderUrls);

        $this->profile_menu('store_mobile');
        //Tpl::showPage('store_setting.store_mobile');
        $this->view->render('store_setting', 'store_setting_store_mobile');
        $this->view->disable();
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_key 当前导航的menu_key
     * @internal param string $menu_type 导航类型
     */
    private function profile_menu($menu_key = '')
    {
        $menu_array = array(
            1 => array('menu_key' => 'store_setting', 'menu_name' => getLang('nc_member_path_store_config'), 'menu_url' => getUrl('shop/store_setting/store_setting')),
            4 => array('menu_key' => 'store_slide', 'menu_name' => getLang('nc_member_path_store_slide'), 'menu_url' => getUrl('shop/store_setting/store_slide')),
            5 => array('menu_key' => 'store_theme', 'menu_name' => '医生主题', 'menu_url' => getUrl('shop/store_setting/theme')),

            7 => array(
                'menu_key' => 'store_mobile',
                'menu_name' => '手机医生设置',
                'menu_url' => getUrl('shop/store_setting/store_mobile'),
            ),
        );
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }

}