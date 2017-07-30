<?php
/**
 * 医生等级
 */

namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Logic\SellerLogic;
use Ypk\Logic\StoreGradeLogic;
use Ypk\Logic\StoreLogic;
use Ypk\Models\Store;
use Ypk\Models\StoreGrade;
use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Validate;

class StoreGradeController extends ControllerBase
{

    public function initialize(){
        $this->translation = getTranslation('layout,store_grade,store,common');
        $this->view->setVar('lang', $this->translation);
    }
    public function indexAction() {
        $this->store_gradeAction();
        $this->view->render('store_grade', 'storegrade');
    }
    /**
     * 医生等级
     */
    public function store_gradeAction(){
        $model_grade = new StoreGradeLogic();
        /**
         * 删除
         */
        if (chksubmit()){
            if (!empty($_POST['check_sg_id'])){
                if (is_array($_POST['check_sg_id'])){
                    $model_store = new StoreLogic();
                    foreach ($_POST['check_sg_id'] as $k => $v){
                        /**
                         * 该医生等级下的所有医生会自动改为默认等级
                         */
                        $v = intval($v);
                        //判断是否默认等级，默认等级不能删除
                        if ($v == 1){
                            $this->showMessage($this->translation->_('default_store_grade_no_del'),getUrl('shop_manager/store_grade/store_grade'));
                        }
                        //判断该等级下是否存在医生，存在的话不能删除
                        if ($this->isable_delGrade($v)){
                            $model_grade->del($v);
                        }
                    }
                }
                delete_file_cache('store_grade');
                $this->log($this->translation->_('nc_del,store_grade').'[ID:'.implode(',',$_POST['check_sg_id']).']',1);
                $this->showMessage($this->translation->_('nc_common_del_succ'));
            }else {
                $this->showMessage($this->translation->_('nc_common_del_fail'));
            }
        }
        $condition['like_sg_name'] = trim($_POST['like_sg_name']);
        $condition['order'] = 'sg_sort';

       $grade_list = $model_grade->getGradeList($condition);

        $this->view->setVar('like_sg_name',trim($_POST['like_sg_name']));
        $this->view->setVar('grade_list',$grade_list);
        $this->view->pick('store_grade/storegrade');
    }

    /**
     * 新增等级
     */
    public function store_grade_addAction(){

        $model_grade = new StoreGradeLogic();
        if (chksubmit()){

            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["sg_name"], "require"=>"true", "message"=>$this->translation->_('store_grade_name_no_null')),
                array("input"=>$_POST["sg_goods_limit"], "require"=>"true", 'validator'=>'Number', "message"=>$this->translation->_('allow_pubilsh_product_num_only_lnteger')),
                array("input"=>$_POST["sg_sort"], "require"=>"true", 'validator'=>'Number', "message"=>$this->translation->_('sort_only_lnteger')),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                $this->showMessage($error);
            }else {
                //验证等级名称
                if (!$this->checkGradeName(array('sg_name'=>trim($_POST['sg_name'])))){
                    $this->showMessage($this->translation->_('now_store_grade_name_is_there'));
                }
                //验证级别是否存在
                if (!$this->checkGradeSort(array('sg_sort'=>trim($_POST['sg_sort'])))){
                    $this->showMessage($this->translation->_('add_gradesortexist'));
                }
                $insert_array = array();
                $insert_array['sg_name'] = trim($_POST['sg_name']);
                $insert_array['sg_goods_limit'] = trim($_POST['sg_goods_limit']);
                $insert_array['sg_space_limit'] = '100';
                $insert_array['sg_album_limit'] = '' === trim($_POST['sg_album_limit']) ? 1000 : intval($_POST['sg_album_limit']);
                $insert_array['sg_function'] = $_POST['sg_function']?implode('|',$_POST['sg_function']):'';
                $insert_array['sg_price'] = abs(floatval($_POST['sg_price']));
                $insert_array['sg_description'] = trim($_POST['sg_description']);
                $insert_array['sg_sort'] = trim($_POST['sg_sort']);
                $insert_array['sg_template'] = 'default';

                $result = $model_grade->add($insert_array);
                if ($result){
                    delete_file_cache('store_grade');
                    $this->log($this->translation->_('nc_add,store_grade').'['.$_POST['sg_name'].']',1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'),getUrl('shop_manager/store_grade/store_grade'));
                }else {
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

    }

    /**
     * 等级编辑
     */
    public function store_grade_editAction(){


        $model_grade = new StoreGradeLogic();
        if (chksubmit()){
            if (!$_POST['sg_id']){
                $this->showMessage($this->translation->_('grade_parameter_error'),getUrl('shop_manager/store_grade/store_grade'));
            }
            /**
             * 验证
             */
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["sg_name"], "require"=>"true", "message"=>$this->translation->_('store_grade_name_no_null')),
                array("input"=>$_POST["sg_goods_limit"], "require"=>"true", 'validator'=>'Number', "message"=>$this->translation->_('allow_pubilsh_product_num_only_lnteger')),
                array("input"=>$_POST["sg_sort"], "require"=>"true", 'validator'=>'Number', "message"=>$this->translation->_('sort_only_lnteger')),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                $this->showMessage($error);
            }else {
                //如果是默认等级则级别为0
                if ($_POST['sg_id'] == 1){
                    $_POST['sg_sort'] = 0;
                }
                //验证等级名称
                if (!$this->checkGradeName(array('sg_name'=>trim($_POST['sg_name']),'sg_id'=>intval($_POST['sg_id'])))){
                    $this->showMessage($this->translation->_('now_store_grade_name_is_there'),getUrl('shop_manager/store_grade/store_grade_edit').'?sg_id='.intval($_POST['sg_id']));
                }
                //验证级别是否存在
                if (!$this->checkGradeSort(array('sg_sort'=>trim($_POST['sg_sort']),'sg_id'=>intval($_POST['sg_id'])))){
                    $this->showMessage($this->translation->_('add_gradesortexist'),getUrl('shop_manager/store_grade/store_grade_edit').'sg_id='.intval($_POST['sg_id']));
                }
                $update_array = array();
                $update_array['sg_name'] = trim($_POST['sg_name']);
                $update_array['sg_goods_limit'] = trim($_POST['sg_goods_limit']);
                $update_array['sg_album_limit'] = trim($_POST['sg_album_limit']);
                $update_array['sg_function'] = $_POST['sg_function']?implode('|',$_POST['sg_function']):'';
                $update_array['sg_price'] = abs(floatval($_POST['sg_price']));
                $update_array['sg_description'] = trim($_POST['sg_description']);
                $update_array['sg_sort'] = trim($_POST['sg_sort']);

                //$result = $model_grade->where(array('sg_id'=>intval($_POST['sg_id'])))->update($update_array);
                $update_array['sg_id'] = intval($_POST['sg_id']);
                $result = $model_grade->updates($update_array);
                if ($result){
                    delete_file_cache('store_grade');
                    $this->log($this->translation->_('nc_edit,store_grade').'['.$_POST['sg_name'].']',1);
                    $this->showMessage($this->translation->_('nc_common_save_succ'));
                }else {
                    $this->showMessage($this->translation->_('nc_common_save_fail'));
                }
            }
        }

        $grade_array = $model_grade->getOneGrade(intval($_GET['sg_id']));
        if (empty($grade_array)){
            $this->showMessage($this->translation->_('illegal_parameter'));
        }
        //附加功能
        $grade_array['sg_function'] = explode('|',$grade_array['sg_function']);

        $this->view->setVar('grade_array',$grade_array);
    }
    /**
     * 删除等级
     */
    public function store_grade_delAction(){
        /**
         * 读取语言包
         */
        $model_grade = new StoreGradeLogic();
        if (intval($_GET['sg_id']) > 0){
            //判断是否默认等级，默认等级不能删除
            if ($_GET['sg_id'] == 1){
                $this->showMessage($this->translation->_('default_store_grade_no_del'),getUrl('shop_manager/store_grade/store_grade'));
            }
            //判断该等级下是否存在医生，存在的话不能删除
            if (!$this->isable_delGrade(intval($_GET['sg_id']))){
                $this->showMessage($this->translation->_('del_gradehavestore'),getUrl('shop_manager/store_grade/store_grade'));
            }
            /**
             * 删除分类
             */
            $model_grade->del(intval($_GET['sg_id']));
            delete_file_cache('store_grade');
            $this->log($this->translation->_('nc_del,store_grade').'[ID:'.intval($_GET['sg_id']).']',1);
            $this->showMessage($this->translation->_('nc_common_del_succ'),getUrl('shop_manager/store_grade/store_grade'));
        }else {
            $this->showMessage($this->translation->_('nc_common_del_fail'),getUrl('shop_manager/store_grade/store_grade'));
        }
    }

    /**
     * 等级：设置可选模板
     */
    public function store_grade_templatesAction(){
        /**
         * 读取语言包
         */
        $model_grade = new StoreGradeLogic();
        if (chksubmit()){
            $update_array = array();
            $update_array['sg_id'] = $_POST['sg_id'];
            if (!in_array('default',$_POST['template'])){
                $_POST['template'][] = 'default';
            }
            $update_array['sg_template'] = $_POST['template']?implode('|',$_POST['template']):'';
            $update_array['sg_template_number'] = count($_POST['template']);

            $result = $model_grade->updates($update_array);
            if ($result){
                $this->log($this->translation->_('nc_edit'),$this->translation->_('store_grade_tpl'),1);
                $this->showMessage($this->translation->_('nc_common_save_succ'),getUrl('shop_manager/store_grade/store_grade'));
            }else {
                $this->showMessage($this->translation->_('nc_common_save_fail'));
            }
        }
        //主题配置信息
        $style_data = array();
        $style_configurl = BASE_ROOT_PATH.DS.DIR_SHOP.'/templates/'.TPL_SHOP_NAME.DS.'store'.DS.'style'.DS."styleconfig.php";
        if (file_exists($style_configurl)){
            include_once($style_configurl);
            if (strtoupper(CHARSET) == 'GBK'){
                $style_data = $this->translation->_($style_data);
            }
            $dir_list = array_keys($style_data);
        }
        /**
         * 等级信息
         */
        $grade_array = $model_grade->getOneGrade(intval($_GET['sg_id']));
        if (empty($grade_array)){
            $this->showMessage($this->translation->_('illegal_parameter'));
        }
        $grade_array['sg_template'] = explode('|',$grade_array['sg_template']);

        $this->view->setVar('dir_list',$dir_list);
        $this->view->setVar('grade_array',$grade_array);
        $this->view->render('store_grade','store_grade_template');
//        Tpl::showpage('store_grade_template.edit');
//        Tpl::setDirquna('shop');
    }
    /**
     * ajax操作
     */
    public function ajaxAction(){
        switch ($_GET['branch']){
            /**
             * 医生等级：验证是否有重复的名称
             */
            case 'check_grade_name':
                if ($this->checkGradeName($_GET)){
                    echo 'true'; exit;
                }else{
                    echo 'false'; exit;
                }
                break;
            case 'check_grade_sort':
                if ($this->checkGradeSort($_GET)){
                    echo 'true'; exit;
                }else{
                    echo 'false'; exit;
                }
                break;
        }
    }
    /**
     * 查询医生等级名称是否存在
     */
    private function checkGradeName($param){
        $query = StoreGrade::query();
        $query->where('sg_name = \'' . trim($param['sg_name']) . '\'');
        if(!empty($_GET['sg_id'])){
            $query->andWhere('sg_id <>'.intval($param['sg_id']));
        }
        $model_grade = $query->execute();
        if(count($model_grade->toArray()) > 0){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 查询医生等级是否存在
     */
    private function checkGradeSort($param){
        $query = StoreGrade::query();
        $query->where('sg_sort = \''.trim($param['sg_sort']).'\'');
        if(!empty($param['sg_id'])){
            $query->andWhere('sg_id <>'.intval($param['sg_id']));
        }
        $model_grade = $query->execute();
        if(count($model_grade->toArray()) > 0){
            return false;
        }else{
            return true;
        }
    }
    /**
     * 判断医生等级是否能删除
     */
    public function isable_delGrade($sg_id){
        //判断该等级下是否存在医生，存在的话不能删除
        $model_store = new StoreLogic();
        $store_list = $model_store->getStoreList(array('conditions'=>'grade_id='.$sg_id));
        if (count($store_list) > 0){
            return false;
        }
        return true;
    }
}
