<?php
/**
 * 举报管理
 */
namespace Ypk\Modules\ShopManager\Controllers;


use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Page;
use Ypk\Tpl;
use Ypk\Validate;

class InformController extends ControllerBase {
    private $links = array(
        array('url' => array('module' => 'shop_manager', 'controller' => 'inform', 'action' => 'inform_list'), 'text' => '未处理'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'inform', 'action' => 'inform_handled_list'), 'text' => '已处理'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'inform', 'action' => 'inform_subject_type_list'), 'text' => '类型设置'),
        array('url' => array('module' => 'shop_manager', 'controller' => 'inform', 'action' => 'inform_subject_list'), 'text' => '主题设置')
    );
    public function initialize(){
        parent::initialize();
        $this->translation = getTranslation('inform,layout,common');
        $url_param_array = getUrlParamArray();
        if ($url_param_array['action'] == 'index') $url_param_array['action'] = 'inform_list';
        Tpl::output('top_link',$this->sublink($this->links,$url_param_array['action']));
    }

    /*
     * 默认操作列出未处理的举报
     */
    public function indexAction(){
        $this->inform_listAction();
    }

    /*
     * 未处理的举报列表
     */
    public function inform_listAction(){
        $_GET['type'] = 'waiting';
//
//		Tpl::setDirquna('shop');
//        Tpl::showpage('inform.list');
        $this->view->pick('inform/inform_list');
    }

    /*
     * 已处理的举报列表
     */
    public function inform_handled_listAction(){
//		Tpl::setDirquna('shop');
//        Tpl::showpage('inform.list');
        $this->view->pick('inform/inform_list');
    }
    public function get_xmlAction(){
        //实例化分页
        $page = new Page();
        $page->setEachNum($_POST['rp']) ;
        $page->setStyle('admin') ;
        //获得举报列表
        $model_inform = Model('inform') ;
        $condition['inform_state'] = $_GET['type'] == 'waiting' ? 1 : 2;
        if ($_POST['query'] && in_array($_POST['qtype'],array('inform_goods_name','inform_member_name','inform_store_name','inform_type','inform_subject'))) {
            $condition[$_POST['qtype']] = $_POST['query'];
        }
        if (in_array($_POST['sortname'],array('inform_datetime','inform_member_id','inform_goods_id','inform_store_id')) && in_array($_POST['sortorder'],array('asc','desc'))) {
            $condition['order'] = $_POST['sortname'].' '.$_POST['sortorder'];
        }
        $inform_list = $model_inform->getInform($condition,$page);
        $data = array();
        $data['now_page'] = $page->get('now_page');
        $data['total_num'] = $page->get('total_num');
        if ($inform_list && is_array($inform_list)) {
            $pic_base_url = UPLOAD_SITE_URL.'/shop/inform/';
            foreach ($inform_list as $k => $v){
                $list = array();
                if ($_GET['type'] == 'waiting') {
                $list['operation'] = "<a class=\"btn orange\" href=\"".getUrl('shop_manager/inform/show_handle_page',array('inform_id'=>$v['inform_id'],'inform_goods_name'=>$v['inform_goods_name']))."\"><i class=\"fa fa-gavel\"></i>处理</a>";
                } else {
                    $list['operation'] = '--';
                }
                $list['inform_member_name'] = $v['inform_member_name'];
                $list['inform_subject_type_id'] = $v['inform_subject_type_name'];
                $list['inform_subject_id'] = $v['inform_subject_content'];
                $list['inform_goods_name'] = "<a class='open' title='{$v['inform_goods_name']}' href='". getUrl('shop_manager/goods/index', array('goods_id' => $v['inform_goods_id'])) ."' target='blank'>{$v['inform_goods_name']}</a>";
                $list['inform_pic'] = '';
                if(!empty($v['inform_pic1'])) {
                    $list['inform_pic'] .= "<a href='".$pic_base_url.$v['inform_pic1']."' target='_blank' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".$pic_base_url.$v['inform_pic1'].">\")'><i class='fa fa-picture-o'></i></a> ";
                }
                if(!empty($v['inform_pic2'])) {
                    $list['inform_pic'] .= "<a href='".$pic_base_url.$v['inform_pic2']."' target='_blank' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".$pic_base_url.$v['inform_pic2'].">\")'><i class='fa fa-picture-o'></i></a> ";
                }
                if(!empty($v['inform_pic3'])) {
                    $list['inform_pic'] .= "<a href='".$pic_base_url.$v['inform_pic3']."' target='_blank' class='pic-thumb-tip' onMouseOut='toolTip()' onMouseOver='toolTip(\"<img src=".$pic_base_url.$v['inform_pic3'].">\")'><i class='fa fa-picture-o'></i></a> ";
                }
                $list['inform_datetime'] = date('Y-m-d H:i:s',$v['inform_datetime']);
                if ($_GET['type'] == '') {
                    $list['inform_handle_type'] = str_replace(array(1,2,3),array('无效举报','恶意举报','有效举报'),$v['inform_handle_type']);
                    $list['inform_handle_message'] = $v['inform_handle_message'];
                }
                $list['inform_store_name'] = $v['inform_store_name'];
                $list['inform_member_id'] = $v['inform_member_id'];
                $list['inform_goods_id'] = $v['inform_goods_id'];
                $list['inform_store_id'] = $v['inform_store_id'];
                $data['list'][$v['inform_id']] = $list;
            }
        }
        ob_clean();
        exit(flexigridXML($data));

    }

    /*
     * 举报类型列表
     */
    public function inform_subject_type_listAction() {

        //实例化分页
        $page = new Page();
        $page->setEachNum(300) ;
        $page->setStyle('admin') ;

        //获得有效举报类型列表
        $model_inform_subject_type = Model('inform_subject_type') ;
        $inform_type_list = $model_inform_subject_type->getActiveInformSubjectType($page) ;

        Tpl::output('list', $inform_type_list) ;
        Tpl::output('show_page',$page->show()) ;
//		Tpl::setDirquna('shop');
//        Tpl::showpage('inform_subject_type.list') ;
        $this->view->pick('inform/inform_subject_type_list');
    }


    /*
     * 举报主题列表
     */
    public function inform_subject_listAction(){

        //实例化分页
        $page = new Page();
        $page->setEachNum(300) ;
        $page->setStyle('admin') ;

        //获得举报主题列表
        $model_inform_subject = Model('inform_subject') ;

        //搜索条件
        $condition = array();
        $condition['order'] = 'inform_subject_id asc';
        $condition['inform_subject_type_id'] = trim($_GET['inform_subject_type_id']);
        $condition['inform_subject_state'] = 1;
        $inform_subject_list = $model_inform_subject->getInformSubject($condition,$page) ;

        //获取有效举报类型
        $model_inform_subject_type = Model('inform_subject_type');
        $type_list= $model_inform_subject_type->getActiveInformSubjectType();

        Tpl::output('list', $inform_subject_list) ;
        Tpl::output('type_list', $type_list) ;
        Tpl::output('show_page',$page->show()) ;
//		Tpl::setDirquna('shop');
//        Tpl::showpage('inform_subject.list') ;
        $this->view->pick('inform/inform_subject_list');

    }

    /*
     * 添加举报类型页面
     */
    public function inform_subject_type_addAction(){
//Tpl::setDirquna('shop');
//        Tpl::showpage('inform_subject_type.add') ;
        $this->view->pick('inform/inform_subject_type_add');
    }
    /*
     * 保存添加的举报类型
     */
    public function inform_subject_type_saveAction(){

        //获取提交的内容
        $input['inform_type_name'] = trim($_POST['inform_type_name']);
        $input['inform_type_desc']  = trim($_POST['inform_type_desc']);

        //验证提交的内容
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$input['inform_type_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>getLang('inform_type_null')),
            array("input"=>$input['inform_type_desc'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"100","message"=>getLang('inform_type_desc_null')),
        );
        $error = $obj_validate->validate();

        if ($error != ''){
            showMessage($error);
        }
        else {
            //验证成功保存
            $input['inform_type_state'] = 1;
            $model_inform_subject_type = Model('inform_subject_type');
            $model_inform_subject_type->saveInformSubjectType($input);
            $this->log(getLang('nc_add,inform_type').'['.$_POST['inform_type_name'].']',1);
            showMessage(getLang('nc_common_save_succ'),getUrl('shop_manager/inform/inform_subject_type_list'));
        }
    }

    /*
     * 删除举报类型,伪删除只是修改标记
     */
    public function inform_subject_type_dropAction(){

        $inform_type_id = $_GET['inform_type_id'];
        $inform_type_id = "'".implode("','", explode(',', $inform_type_id))."'";
        if(empty($inform_type_id)) {
            showMessage(getLang('param_error'),getUrl('shop_manager/inform/index'));
        }

        //删除分类
        $model_inform_subject_type = Model('inform_subject_type');
        $update_array = array();
        $update_array['inform_type_state'] = 2;
        $where_array = array();
        $where_array['in_inform_type_id'] = $inform_type_id;
        $model_inform_subject_type->updateInformSubjectType($update_array,$where_array);

        //删除分类下边的主题
        $model_inform_subject= Model('inform_subject');
        $update_subject_array = array();
        $update_subject_array['inform_subject_state'] = 2;
        $where_subject_array = array();
        $where_subject_array['in_inform_subject_type_id'] = $inform_type_id;
        $model_inform_subject->updateInformSubject($update_subject_array,$where_subject_array);
        $this->log(getLang('nc_del,inform_type').'[ID:'.$_POST['inform_type_id'].']',1);
        showMessage(getLang('nc_common_del_succ'),getUrl('shop_manager/inform/inform_subject_type_list'));

    }


    /*
     * 添加举报主题页面
     */
    public function inform_subject_addAction(){

        //获得可用举报类型列表
        $model_inform_subject_type = Model('inform_subject_type');
        $inform_type_list = $model_inform_subject_type->getActiveInformSubjectType();

        if(empty($inform_type_list)) {
            showMessage(getLang('inform_type_error'));
        }

        Tpl::output('list', $inform_type_list) ;
//		Tpl::setDirquna('shop');
//        Tpl::showpage('inform_subject.add') ;
        $this->view->pick('inform/inform_subject_add');

    }

    /*
     * 保存添加的举报主题
     */
    public function inform_subject_saveAction(){

        //获取提交的内容
        list($input['inform_subject_type_id'],$input['inform_subject_type_name']) = explode(',',trim($_POST['inform_subject_type']));
        $input['inform_subject_content'] = trim($_POST['inform_subject_content']);

        //验证提交的内容
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$input['inform_subject_type_name'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>getLang('inform_subject_null')),
            array("input"=>$input['inform_subject_content'], "require"=>"true","validator"=>"Length","min"=>"1","max"=>"50","message"=>getLang('inform_content_null')),
            array("input"=>$input['inform_subject_type_id'], "require"=>"true","validator"=>"Number","message"=>getLang('param_error')),
        );
        $error = $obj_validate->validate();

        if ($error != ''){
            showMessage($error);
        }
        else {
            //验证成功保存
            $input['inform_subject_state'] = 1;
            $model_inform_subject = Model('inform_subject');
            $model_inform_subject->saveInformSubject($input);
            $this->log(getLang('nc_add,inform_subject').'['.$input['inform_subject_type_name'].']',1);
            showMessage(getLang('nc_common_save_succ'),getUrl('shop_manager/inform/inform_subject_list'));
        }
    }

    /*
     * 删除举报主题,伪删除只是修改标记
     */
    public function inform_subject_dropAction(){

        $inform_subject_id = $_GET['inform_subject_id'];
        if(empty($inform_subject_id)) {
            showMessage(getLang('param_error'),getUrl('shop_manager/inform/index'));
        }
        $model_inform_subject= Model('inform_subject');
        $update_array = array();
        $update_array['inform_subject_state'] = 2;
        $where_array = array();
        $where_array['in_inform_subject_id'] = "'".implode("','", explode(',', $inform_subject_id))."'";
        $model_inform_subject->updateInformSubject($update_array,$where_array);
        $this->log(getLang('nc_del,inform_subject').'['.$_POST['inform_subject_id'].']',1);
        showMessage(getLang('nc_common_del_succ'),getUrl('shop_manager/inform/inform_subject_list'));
    }

    /*
     * 显示处理举报
     */
    public function show_handle_pageAction() {
        $inform_id = intval($_GET['inform_id']);
        $inform_goods_name = urldecode($_GET['inform_goods_name']);

        if(strtoupper(CHARSET) == 'GBK') {
            $inform_goods_name = getUTF8($inform_goods_name);
        }

        TPL::output('inform_id',$inform_id);
        TPL::output('inform_goods_name',$inform_goods_name);
//		Tpl::setDirquna('shop');
//        Tpl::showpage('inform.handle');
        $this->view->pick('inform/inform_handle');
    }

    /*
     * 处理举报
     */
    public function inform_handleAction(){

        $inform_id = intval($_POST['inform_id']);
        $inform_handle_type = intval($_POST['inform_handle_type']);
        $inform_handle_message = trim($_POST['inform_handle_message']);

        if(empty($inform_id)||empty($inform_handle_type)) {
            showMessage(getLang('param_error'),'');
        }

        //验证输入的数据
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(

            array("input"=>$inform_handle_message, "require"=>"true","validator"=>"Length","min"=>"1","max"=>"100","message"=>getLang('inform_handle_message_null')),
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showMessage($error);
        }

        $model_inform = Model('inform');
        $inform_info = $model_inform->getoneInform($inform_id);
        if(empty($inform_info)||intval($inform_info['inform_state'])===2) {
            showMessage(getLang('param_error'));
        }

        $update_array = array();
        $where_array = array();

        //根据选择处理
        switch($inform_handle_type) {

            case 1:
                $where_array['inform_id'] = $inform_id;
                break;
            case 2:
                //恶意举报，清理所有该用户的举报，设置该用户禁止举报
                $where_array['inform_member_id'] = $inform_info['inform_member_id'];
                $this->denyMemberInform($inform_info['inform_member_id']);
                break;
            case 3:
                //有效举报，商品禁售
                $where_array['inform_id'] = $inform_id;
                $this->denyGoods($inform_info['inform_goods_id']);
                break;
            default:
                showMessage(getLang('param_error'));

        }

        $update_array['inform_state'] = 2;
        $update_array['inform_handle_type'] = $inform_handle_type;
        $update_array['inform_handle_message'] = $inform_handle_message;
        $update_array['inform_handle_datetime'] = time();
        $admin_info = $this->getAdminInfo();
        $update_array['inform_handle_member_id'] = $admin_info['id'];
        $where_array['inform_state'] = 1;

        if($model_inform->updateInform($update_array,$where_array)) {
            $this->log(getLang('inform_text_handle,inform').'[ID:'.$inform_id.']',1);
            showMessage(getLang('nc_common_op_succ'),getUrl('shop_manager/inform/inform_list'));
        }
        else {
            showMessage(getLang('nc_common_op_fail'));
        }
    }

    /*
     * 禁止该用户举报
     */
    private function denyMemberInform($member_id) {

        $model_member = Model('member');
        $param = array();
        $param['inform_allow'] = 2;
        return $model_member->editMember(array('member_id'=>$member_id),$param);
    }

    /*
     * 禁止商品销售
     */
    private function denyGoods($goods_id) {
        //修改商品状态
        $model_goods = Model('goods');
        $goods_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_commonid');
        if (empty($goods_info)) {
            return true;
        }
        return Model('goods')->editProducesLockUp(array('goods_stateremark' => '商品被举报，平台禁售'),array('goods_commonid' => $goods_info['goods_commonid']));
    }
}
