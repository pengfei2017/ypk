<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 11:42
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Phalcon\Mvc\View;
use Ypk\Logic\BrandLogic;
use Ypk\Logic\GoodsClassLogic;
use Ypk\Logic\WebconfigLogic;
use Ypk\Models\Brand;
use Ypk\Models\Express;
use Ypk\Models\Web;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Tpl;
use Ypk\UploadFile;

/**
 * Class Web_configController
 * @package Ypk\Modules\ShopManager\Controllers
 *
 * 商城-设置-首页管理
 */
class WebConfigController extends ControllerBase
{

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('setting,layout,web_config,common');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->web_configAction();
        $this->view->render('web_config', 'web_config');

    }

    /**
     * 获取板块列表
     */
    public function web_configAction()
    {
        $model_web_config = new WebconfigLogic();
        $style_array = $model_web_config->getStyleList();//板块样式数组
        $this->view->setVar('style_array', $style_array);
        $web_list = Web::find("web_page='index'");
        if (count($web_list) > 0) {
            $web_list = $web_list->toArray();
        } else {
            $web_list = array();
        }
        $this->view->setVar('web_list', $web_list);
    }

    /**
     * 基本设置
     */
    public function web_editAction()
    {
        $model_web_config = Model('web_config');
        $web_id = intval($_GET["web_id"]);
        if (chksubmit()) {
            $web_array = array();
            $web_id = intval($_POST["web_id"]);
            $web_array['web_name'] = $_POST["web_name"];
            $web_array['style_name'] = $_POST["style_name"];
            $web_array['web_sort'] = intval($_POST["web_sort"]);
            $web_array['web_show'] = intval($_POST["web_show"]);
            $web_array['update_time'] = time();
            $model_web_config->updateWeb(array('web_id' => $web_id), $web_array);
            $model_web_config->updateWebHtml($web_id);//更新前台显示的html内容
            $this->log(getLang('web_config_code_edit') . '[' . $_POST["web_name"] . ']', 1);
            showMessage(getLang('nc_common_save_succ'), getUrl('shop_manager/web_config'));
        }
        $web_list = $model_web_config->getWebList(array('web_id' => $web_id));
        $this->view->setVar('web_array', $web_list[0]);
    }

    /**
     * 板块设计
     */
    public function code_editAction()
    {
        $model_web_config = Model('web_config');
        $web_id = intval($_GET["web_id"]);
        $code_list = $model_web_config->getCodeList(array('web_id' => "$web_id"));
        if (is_array($code_list) && !empty($code_list)) {
            $model_class = Model('goods_class');
            $parent_goods_class = $model_class->getTreeClassList(2);//商品分类父类列表，只取到第二级
            if (is_array($parent_goods_class) && !empty($parent_goods_class)) {
                foreach ($parent_goods_class as $k => $v) {
                    $parent_goods_class[$k]['gc_name'] = str_repeat("&nbsp;", $v['deep'] * 2) . $v['gc_name'];
                }
            }
            $this->view->setVar('parent_goods_class', $parent_goods_class);

            $goods_class = $model_class->getTreeClassList(1);//第一级商品分类
            $this->view->setVar('goods_class', $goods_class);

            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val["var_name"];
                $code_info = $val["code_info"];
                $code_type = $val["code_type"];
                $val['code_info'] = $model_web_config->get_array($code_info, $code_type);
                $this->view->setVar('code_' . $var_name, $val);
            }
            $style_array = $model_web_config->getStyleList();//样式数组

            $this->view->setVar('style_array', $style_array);

            $web_list = $model_web_config->getWebList(array('web_id' => $web_id));

            $this->view->setVar('web_array', $web_list[0]);

            $this->view->render('web_config', 'code_edit');
        } else {
            showMessage(getLang('nc_no_record'));
        }
        $this->view->disable();
    }

    /**
     * 更新整个页面的html代码
     */
    public function web_htmlAction()
    {
        $model_web_config = Model('web_config');
        $web_id = intval($_GET["web_id"]);
        $web_list = $model_web_config->getWebList(array('web_id' => $web_id));
        $web_array = $web_list[0];
        if (!empty($web_array) && is_array($web_array)) {
            $model_web_config->updateWebHtml($web_id, $web_array);
            showMessage(getLang('nc_common_op_succ'), getUrl('shop_manager/web_config'));
        } else {
            showMessage(getLang('nc_common_op_fail'));
        }

    }

    /**
     * 焦点区显示
     */
    public function focus_editAction()
    {
        $model_web_config = new WebconfigLogic();
        $web_id = '101';
        $code_list = $model_web_config->getCodeList(array('web_id' => $web_id));
        if (count($code_list) > 0 && is_array($code_list->toArray())) {
            $code_list = $code_list->toArray();
            foreach ($code_list as $key => $val) {
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info, $code_type);
                $this->view->setVar('code_' . $var_name, $val);
            }
        }
        $screen_adv_list = $model_web_config->getAdvList("screen");//焦点大图广告数据
        if (count($screen_adv_list) > 0) {
            $screen_adv_list = $screen_adv_list->toArray();
        } else {
            $screen_adv_list = array();
        }
        $this->view->setVar('screen_adv_list', $screen_adv_list);

        $focus_adv_list = $model_web_config->getAdvList("focus");//四张联动区广告数据
        if (count($focus_adv_list) > 0) {
            $focus_adv_list = $focus_adv_list->toArray();
        } else {
            $focus_adv_list = array();
        }
        $this->view->setVar('focus_adv_list', $focus_adv_list);
    }

    /**
     * 更新html内容
     */
    public function html_updateAction()
    {
        $model_web_config = Model('web_config');
        $web_id = intval($_GET["web_id"]);
        $web_list = $model_web_config->getWebList(array('web_id' => $web_id));
        $web_array = $web_list[0];
        if (!empty($web_array) && is_array($web_array)) {
            $model_web_config->updateWebHtml($web_id, $web_array);
            $this->showMessage($this->translation['nc_common_op_succ']);
        } else {
            $this->showMessage($this->translation['nc_common_op_fail']);
        }
    }

    /**
     * 头部促销区
     */
    public function sale_editAction()
    {
        $model_web_config = new WebconfigLogic();
        $web_id = '121';
        $code_list = $model_web_config->getCodeList(array('web_id' => $web_id));
        if (is_array($code_list) && !empty($code_list)) {
            $model_class = new GoodsClassLogic();
            $goods_class = $model_class->getTreeClassList(1);//第一级商品分类
            $this->view->setVar('goods_class', $goods_class);
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info, $code_type);
                $this->view->setVar('code_' . $var_name, $val);
            }
        }
    }

    /**
     * 商品分类
     */
    public function category_listAction()
    {
        $model_class = new GoodsClassLogic();
        $gc_parent_id = intval($_GET['id']);
        $goods_class = $model_class->getGoodsClassListByParentId($gc_parent_id);
        $this->view->setVar('goods_class', $goods_class);
    }

    /**
     * 商品推荐
     */
    public function recommend_listAction()
    {
        $model_web_config = new WebconfigLogic();
        $condition = array();
        $gc_id = intval($_REQUEST['id']);
        if ($gc_id > 0) {
            $condition['gc_id'] = $gc_id;
        }
        $goods_name = trim($_REQUEST['goods_name']);
        if (!empty($goods_name)) {
            $goods_id = intval($_REQUEST['goods_name']);
            if ($goods_id === $goods_name) {
                $condition['goods_id'] = $goods_id;
            } else {
                $condition['goods_name'] = array('like', '%' . $goods_name . '%');
            }
        }
        $goods_list = $model_web_config->getGoodsList($condition, 'goods_id desc', 6);
        $this->view->setVar('show_page', $model_web_config->showpage(2));
        $this->view->setVar('goods_list', $goods_list);
    }

    /**
     * 商品排序查询
     */
    public function goods_listAction()
    {
        $model_web_config = new WebconfigLogic();
        $condition = array();
        $where = "";
        $order = 'goods_salenum desc,goods_id desc';//销售数量
        $goods_order = trim($_REQUEST['goods_order']);
        if (!empty($goods_order)) {
            $order = $goods_order . ' desc,goods_id desc';
        }
        $gc_id = intval($_REQUEST['id']);
        if ($gc_id > 0) {
            $condition['gc_id'] = $gc_id;
        }
        $goods_name = trim($_REQUEST['goods_name']);
        if (!empty($goods_name)) {
            $goods_id = intval($_REQUEST['goods_name']);
            if ($goods_id === $goods_name) {
                $condition['goods_id'] = $goods_id;
                if (empty($where)) {
                    $where = "goods_id='" . $goods_id . "'";
                } else {
                    $where = $where . ",goods_id='" . $goods_id . "'";
                }
            } else {
                $condition['goods_name'] = array('like', '%' . $goods_name . '%');
                if (empty($where)) {
                    $where = "goods_name like '%" . $goods_name . "%'";
                } else {
                    $where = ",goods_name like '%" . $goods_name . "%'";
                }
            }
        }
        $goods_list = $model_web_config->getGoodsList($condition, $order, 6);
        getModelArrayListByPaging('Ypk\Models\Goods', $total_num, '', $where, '', 1, 0);
        $this->view->setVar('show_page', getPageShow(intval($total_num), 6));
        $this->view->setVar('goods_list', $goods_list);
    }

    /**
     * 加载品牌列表
     */
    public function brand_listAction()
    {
        $model_brand = Model('brand');
        /**
         * 检索条件
         */
        $condition = array();
        if (!empty($_REQUEST['brand_name'])) {
            $condition['brand_name'] = array('like', '%' . trim($_REQUEST['brand_name']) . '%');
        }
        if (!empty($_REQUEST['brand_initial'])) {
            $condition['brand_initial'] = trim($_REQUEST['brand_initial']);
        }
        $brand_list = $model_brand->getBrandPassedList($condition, '*', 6);
        $this->view->setVar('show_page',$model_brand->showpage());
        $this->view->setVar('brand_list',$brand_list);
        //Tpl::setDirquna('shop');
        //Tpl::showpage('web_brand.list','null_layout');
        $this->view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        $this->view->render('web_config','web_brand_list');
    }

    /**
     * 保存“推荐分类”设置
     */
    public function code_updateAction()
    {
        $code_id = intval($_POST['code_id']);
        $web_id = intval($_POST['web_id']);
        $model_web_config = Model('web_config');
        $code = $model_web_config->getCodeRow($code_id,$web_id);
        if (!empty($code)) {
            $code_type = $code['code_type'];
            $var_name = $code['var_name'];
            $code_info = $_POST[$var_name];
            $code_info = $model_web_config->get_str($code_info,$code_type);
            $state = $model_web_config->updateCode(array('code_id'=> $code_id),array('code_info'=> $code_info));
        }
        if($state) {
            echo '1';exit;
        } else {
            echo '0';exit;
        }
    }

    /**
     * 保存图片
     */
    public function upload_picAction()
    {
        $code_id = intval($_POST['code_id']);
        $web_id = intval($_POST['web_id']);
        $model_web_config = Model('web_config');
        $code = $model_web_config->getCodeRow($code_id, $web_id);
        if (!empty($code)) {
            $code_type = $code['code_type'];
            $var_name = $code['var_name'];
            $code_info = $_POST[$var_name];

            $file_name = 'web-' . $web_id . '-' . $code_id;
            $pic_name = $this->_upload_pic($file_name);//上传图片
            if (!empty($pic_name)) {
                $code_info['pic'] = $pic_name;
            }

            $this->view->setVar('var_name', $var_name);
            $this->view->setVar('pic', $code_info['pic']);
            $tempPic = $code_info['pic'];
            $this->view->setVar('type', $code_info['type']);
            $this->view->setVar('ap_id', $code_info['ap_id']);
            $code_info = $model_web_config->get_str($code_info, $code_type);
            $state = $model_web_config->updateCode(array('code_id' => $code_id), array('code_info' => $code_info));

            ob_clean();
            $resContent = $this->getReturnStr($var_name, $tempPic);
            echo $resContent;
            exit;
        }
    }

    /**
     * 中部推荐图片
     */
    public function recommend_picAction()
    {
        $code_id = intval($_POST['code_id']);
        $web_id = intval($_POST['web_id']);
        $model_web_config = Model('web_config');
        $code = $model_web_config->getCodeRow($code_id, $web_id);
        $key_id = intval($_POST['key_id']);
        $pic_id = intval($_POST['pic_id']);
        if (!empty($code) && $key_id > 0 && $pic_id > 1) {
            $code_info = $code['code_info'];
            $code_type = $code['code_type'];
            $code_info = $model_web_config->get_array($code_info, $code_type);//原数组

            $var_name = "pic_list";
            $pic_info = $_POST[$var_name];
            $pic_info['pic_id'] = $pic_id;
            if (!empty($code_info[$key_id]['pic_list'][$pic_id]['pic_img'])) {//原图片
                $pic_info['pic_img'] = $code_info[$key_id]['pic_list'][$pic_id]['pic_img'];
            }

            $file_name = 'web-' . $web_id . '-' . $code_id . '-' . $key_id . '-' . $pic_id;
            $pic_name = $this->_upload_pic($file_name);//上传图片
            if (!empty($pic_name)) {
                $pic_info['pic_img'] = $pic_name;
            }

            $recommend_list = array();
            $recommend_list = $_POST['recommend_list'];
            $recommend_list['pic_list'] = $code_info[$key_id]['pic_list'];
            $code_info[$key_id] = $recommend_list;
            $code_info[$key_id]['pic_list'][$pic_id] = $pic_info;

            $this->view->setVar('pic', $pic_info);
            $code_info = $model_web_config->get_str($code_info, $code_type);
            $state = $model_web_config->updateCode(array('code_id' => $code_id), array('code_info' => $code_info));

            echo "<script>parent.recommend_pic(\"" . $pic_info['pic_id'] . "\",\"" . $pic_info['pic_img'] . "\");</script>";
            exit;
        }
    }

    /**
     * 保存楼层中部切换图片
     */
    public function slide_advAction()
    {
        $code_id = intval($_POST['code_id']);
        $web_id = intval($_POST['web_id']);
        $model_web_config = Model('web_config');
        $code = $model_web_config->getCodeRow($code_id, $web_id);
        if (!empty($code)) {
            $code_type = $code['code_type'];
            $var_name = $code['var_name'];
            $code_info = $_POST[$var_name];

            $pic_id = intval($_POST['slide_id']);
            $tempPic = "";
            if ($pic_id > 0) {
                $var_name = "slide_pic";
                $pic_info = $_POST[$var_name];
                $pic_info['pic_id'] = $pic_id;
                if (!empty($code_info[$pic_id]['pic_img'])) {//原图片
                    $pic_info['pic_img'] = $code_info[$pic_id]['pic_img'];
                }
                $file_name = 'web-' . $web_id . '-' . $code_id . '-' . $pic_id;
                $pic_name = $this->_upload_pic($file_name);//上传图片
                if (!empty($pic_name)) {
                    $pic_info['pic_img'] = $pic_name;
                }

                $code_info[$pic_id] = $pic_info;
                $this->view->setVar('pic', $pic_info);
                $tempPic = $pic_info;
            }
            $code_info = $model_web_config->get_str($code_info, $code_type);
            $model_web_config->updateCode(array('code_id' => $code_id), array('code_info' => $code_info));

            echo "<script>parent.slide_adv(\"" . $tempPic['pic_id'] . "\",\"" . $tempPic['pic_img'] . "\");</script>";
            exit;
        }
    }

    /**
     * 保存焦点区切换大图
     */
    public function screen_picAction()
    {
        $code_id = intval($_POST['code_id']);
        $web_id = intval($_POST['web_id']);
        $model_web_config = Model('web_config');
        $code = $model_web_config->getCodeRow($code_id, $web_id);
        if (!empty($code)) {
            $code_type = $code['code_type'];
            $var_name = $code['var_name'];
            $code_info = $_POST[$var_name];

            $key = intval($_POST['key']);
            $ap_pic_id = intval($_POST['ap_pic_id']);
            if ($ap_pic_id > 0 && $ap_pic_id == $key) {
                $ap_color = $_POST['ap_color'];
                $code_info[$ap_pic_id]['color'] = $ap_color;
                $this->view->setVar('ap_pic_id', $ap_pic_id);
                $this->view->setVar('ap_color', $ap_color);
            }
            $pic_id = intval($_POST['screen_id']);
            if ($pic_id > 0 && $pic_id == $key) {
                $var_name = "screen_pic";
                $pic_info = $_POST[$var_name];
                $pic_info['pic_id'] = $pic_id;
                if (!empty($code_info[$pic_id]['pic_img'])) {//原图片
                    $pic_info['pic_img'] = $code_info[$pic_id]['pic_img'];
                }
                $file_name = 'web-' . $web_id . '-' . $code_id . '-' . $pic_id;
                $pic_name = $this->_upload_pic($file_name);//上传图片
                if (!empty($pic_name)) {
                    $pic_info['pic_img'] = $pic_name;
                }

                $code_info[$pic_id] = $pic_info;
                $this->view->setVar('pic', $pic_info);
            }
            $code_info = $model_web_config->get_str($code_info, $code_type);
            $model_web_config->updateCode(array('code_id' => $code_id), array('code_info' => $code_info));
        }
    }

    /**
     * 保存焦点区切换小图
     */
    public function focus_picAction()
    {
        $code_id = intval($_POST['code_id']);
        $web_id = intval($_POST['web_id']);
        $model_web_config = Model('web_config');
        $code = $model_web_config->getCodeRow($code_id, $web_id);
        if (!empty($code)) {
            $code_type = $code['code_type'];
            $var_name = $code['var_name'];
            $code_info = $_POST[$var_name];

            $key = intval($_POST['key']);
            $slide_id = intval($_POST['slide_id']);
            $pic_id = intval($_POST['pic_id']);
            if ($pic_id > 0 && $slide_id == $key) {
                $var_name = "focus_pic";
                $pic_info = $_POST[$var_name];
                $pic_info['pic_id'] = $pic_id;
                if (!empty($code_info[$slide_id]['pic_list'][$pic_id]['pic_img'])) {//原图片
                    $pic_info['pic_img'] = $code_info[$slide_id]['pic_list'][$pic_id]['pic_img'];
                }
                $file_name = 'web-' . $web_id . '-' . $code_id . '-' . $slide_id . '-' . $pic_id;
                $pic_name = $this->_upload_pic($file_name);//上传图片
                if (!empty($pic_name)) {
                    $pic_info['pic_img'] = $pic_name;
                }

                $code_info[$slide_id]['pic_list'][$pic_id] = $pic_info;
                $this->view->setVar('pic', $pic_info);
            }
            $code_info = $model_web_config->get_str($code_info, $code_type);
            $model_web_config->updateCode(array('code_id' => $code_id), array('code_info' => $code_info));
        }
    }

    /**
     * 上传图片
     */
    private function _upload_pic($file_name)
    {
        $pic_name = '';
        if (!empty($file_name)) {
            if (!empty($_FILES['pic']['name'])) {//上传图片
                $upload = new UploadFile();
                $filename_tmparr = explode('.', $_FILES['pic']['name']);
                $ext = end($filename_tmparr);
                $upload->set('default_dir', ATTACH_EDITOR);
                $upload->set('file_name', $file_name . "." . $ext);
                $result = $upload->upfile('pic');
                if ($result) {
                    $pic_name = ATTACH_EDITOR . "/" . $upload->file_name . '?' . mt_rand(100, 999);//加随机数防止浏览器缓存图片
                }
            }
        }
        return $pic_name;
    }

    /**
     * @param $var_name
     * @param $pic
     * @return string
     */
    private function getReturnStr($var_name, $pic)
    {
        return "<script type=\"text/javascript\">parent.update_pic(\"$var_name\",\"$pic\");</script>";
    }
}