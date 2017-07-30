<?php
/**
 *客服中心
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class StoreCallcenterController extends BaseSellerController
{
    public function initialize() {
        parent::initialize();
        getTranslation('member_store_index,layout,common');
    }
    public function indexAction(){
        $model_store = Model('store');
        $store_info = $model_store->getStoreInfo(array('store_id' => $_SESSION['store_id']));
        Tpl::output('storeinfo', $store_info);
        $this->profile_menu('store_callcenter');
        $model_seller = Model('seller');
        $seller_list = $model_seller->getSellerList(array('store_id' => $store_info['store_id']), '', 'seller_id asc');//账号列表
        Tpl::output('seller_list', $seller_list);
       // Tpl::showpage('store_callcenter');
        $this->view->pick('storecallcenter/store_callcenter');
    }
    /**
     * 保存
     */
    public function saveAction(){
        if(chksubmit()){
            $update = array();
            $i=0;
            if(is_array($_POST['pre']) && !empty($_POST['pre'])){
                foreach($_POST['pre'] as $val){
                    if(empty($val['name']) || empty($val['type']) || empty($val['num'])) continue;
                    $update['store_presales'][$i]['name']   = $val['name'];
                    $update['store_presales'][$i]['type']   = intval($val['type']);
                    $update['store_presales'][$i]['num']    = $val['num'];
                    $i++;
                }
                $update['store_presales'] = serialize($update['store_presales']);
            }else{
                $update['store_presales'] = serialize(null);
            }

            $i=0;
            if(is_array($_POST['after']) && !empty($_POST['after'])){
                foreach($_POST['after'] as $val){
                    if(empty($val['name']) || empty($val['type']) || empty($val['num'])) continue;
                    $update['store_aftersales'][$i]['name'] = $val['name'];
                    $update['store_aftersales'][$i]['type'] = intval($val['type']);
                    $update['store_aftersales'][$i]['num']  = $val['num'];
                    $i++;
                }
                $update['store_aftersales'] = serialize($update['store_aftersales']);
            }else{
                $update['store_aftersales'] = serialize(null);
            }

            $update['store_workingtime'] = $_POST['working_time'];
            $where = array();
            $where['store_id']  = $_SESSION['store_id'];
            Model('store')->editStore($update,$where);
            showDialog(getLang('nc_common_save_succ'), getUrl('shop/store_callcenter/index'), 'succ');
        }
    }
    /**
     * 用户中心右边，小导航
     *
     * @param string    $menu_type  导航类型
     * @param string    $menu_key   当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_key) {
        $menu_array = array(
            1=>array('menu_key'=>'store_callcenter','menu_name'=>getLang('nc_member_path_store_callcenter'),'menu_url'=>getUrl('shop/store_callcenter/index')),
        );
        Tpl::output('member_menu',$menu_array);
        Tpl::output('menu_key',$menu_key);
        $this->view->setVar('member_menu',$menu_array);
        $this->view->setVar('menu_key',$menu_key);
    }
}
