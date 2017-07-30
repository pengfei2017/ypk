<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/29
 * Time: 19:51
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\StoreSnsTracelog;

class StoreSnsTracelogLogic extends  Model
{

    public function initialize(){
        $lang = getTranslation('sns_strace');

//        protected $lang;
//        $lang = getTranslation('sns_strace,snstrace');
    }

    /**
     * 医生动态列表
     *
     * @param unknown $condition
     * @param string $field
     * @param string $order
     * @param number $page
     * @return array
     */
    public function getStoreSnsTracelogList($condition)
    {
        $model = new StoreSnsTracelog();
        $result = $model->find($condition);
        if($result == false){
            return array();
        }else{
            return $result->toArray();
        }
    }

    /**
     * 获得医生动态总数
     *
     * @param unknown $condition
     * @return array
     */
    public function getStoreSnsTracelogCount($condition) {
        return $this->where($condition)->count();
    }

    /**
     * 获取单条医生动态
     *
     * @param unknown $condition
     * @return array
     */
    public function getStoreSnsTracelogInfo($condition) {
        $result  = StoreSnsTracelog::findFirst($condition);
        return $result->toArray();
    }

    /**
     * 保存医生动态
     *
     * @param array $insert
     * @param bool $replace
     * @return boolean
     */
    public function saveStoreSnsTracelog($insert, $replace = false) {
        return $this->insert($insert, $replace);
    }

    /**
     * 保存医生动态
     *
     * @param array $insert
     * @param bool $replace
     * @return boolean
     */
    public function saveStoreSnsTracelogAll($insert, $replace = false) {
        return $this->insertAll($insert, $replace);
    }

    /**
     * 更新医生动态
     *
     * @param array $update
     * @param array $condition
     * @return boolean
     */
    public function editStoreSnsTracelog($update, $condition) {
        $result = StoreSnsTracelog::findFirst($condition);
        if($result->save($update)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 删除医生动态
     *
     * @param array $condition
     * @return boolean
     */
    public function delStoreSnsTracelog($condition) {
        return $this->where($condition)->delete();
    }

    /**
     * 拼写个类型样式
     * @param string $type 动态类型
     * @param array  $data 相关数据
     */
    public function spellingStyle($type,$data){
        //1'relay',2'normal',3'new',4'coupon',5'xianshi',6'mansong',7'bundling',8'groupbuy',9'recommend',10'hotsell'
        $rs = '';
        switch ($type){
            case '2':
                break;
            case '3':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop_manager/goods/index', array('goods_id'=>$data['goods_id'])) . "\"><img src=\"" . cthumb($data['goods_image'], 240, $data['store_id']) . "\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['goods_name'] . "\"></a></div>
                        <div class=\"goodsinfo\">
                        <dl>
                           <dt><i class=\"desc-type desc-type-new\">" . $lang->_('store_sns_new_selease') . "</i><a target=\"_blank\" href=\"" . getUrl('shop_manager/goods/index', array('goods_id'=>$data['goods_id'])) . "\">" . $data['goods_name'] . "</a></dt>
                            <dd>" . $lang->_('sns_sharegoods_price') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_price']) . "</dd>
                            <dd>" . ($data['goods_transfee_charge'] == '1' ? $lang->_('store_sns_free_shipping') : $lang->_('sns_sharegoods_freight') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_freight'])) . "</dd>
                            <dd nctype=\"collectbtn_" . $data['goods_id'] . "\"><a href=\"javascript:void(0);\" onclick=\"javascript:collect_goods('" . $data['goods_id'] . "','succ','collectbtn_" . $data['goods_id'] . "');\">" . $lang->_('sns_sharegoods_collect') . "</a></dd>
                        </dl>
                      </div>
                 </div>";
                break;
            case '4':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop/coupon_store/detail', array('coupon_id' => $data['coupon_id'], 'id' => $data['store_id'])) . "\"><img src=\"" . $data['coupon_pic'] . "\" onerror=\"this.src='" . MODULE_RESOURCE . "/images/default_coupon_image.png'\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['coupon_title'] . "\"></a></div>
                        <div class=\"goodsinfo\">
                        <dl>
                            <dt><i class=\"desc-type desc-type-coupon\">" . $lang->_('store_sns_coupon') . "</i><a target=\"_blank\" href=\"" . getUrl('shop/coupon_store/detail', array('coupon_id' => $data['coupon_id'], 'id' => $data['store_id'])) . "\">" . $data['coupon_title'] . "</a></dt>
                            <dd>" . $lang->_('store_sns_coupon_price') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['coupon_price']) . "</dd>
                            <dd>" . $lang->_('store_sns_start-stop_time') . $lang->_('nc_colon') . date('Y-m-d H:i', $data['coupon_start_date']) . "~" . date('Y-m-d H:i', $data['coupon_end_date']) . "</dd>
                        </dl>
                      </div>
                    </div>";
                break;
            case '5':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop_manager/goods/index',array('goods_id'=>$data['goods_id'])) . "\"><img src=\"" . cthumb($data['goods_image'], 240,$data['store_id']) . "\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['goods_name'] . "\"></a></div>
                        <div class=\"goodsinfo\">
                        <dl>
                            <dt><i class=\"desc-type desc-type-xianshi\">" . $lang->_('store_sns_xianshi') . "</i><a target=\"_blank\" href=\"" . getUrl('shop_manager/goods/index', array('goods_id'=>$data['goods_id'])) . "\">" . $data['goods_name'] . "</a></dt>
                            <dd>" . $lang->_('sns_sharegoods_price') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_price']) . "</dd>
                            <dd>" . $lang->_('store_sns_formerprice') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['xianshi_price']) . "</dd>
                            <dd nctype=\"collectbtn_" . $data['goods_id'] . "\"><a href=\"javascript:void(0);\" onclick=\"javascript:collect_goods('" . $data['goods_id'] . "','succ','collectbtn_" . $data['goods_id'] . "');\">" . $lang->_('sns_sharegoods_collect') . "</a></dd>
                        </dl>
                      </div>
                     </div>";
                break;
            case '6':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('show_store', 'index', array('store_id'=>$data['store_id'])) . "\"><img src=\"" . MODULE_RESOURCE . "/images/mjs-pic.gif\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"".$data['ansong_name']."\"></a></div>
                        <div class=\"goodsinfo\">
                        <dl>
                            <dt><i class=\"desc-type desc-type-mansong\">" . $lang->_('store_sns_mansong') . "</i><a target=\"_blank\" href=\"" . getUrl('shop/show_store/index', array('store_id'=>$data['store_id'])) . "\">" . $data['mansong_name'] . "</a></dt>
                            <dd>" . $lang->_('store_sns_start-stop_time') . $lang->_('nc_colon') . date('Y-m-d H:i', $data['start_time']) . "~" . date('Y-m-d H:i', $data['end_time']) . "</dd>
                        </dl>
                        </div>
                     </div>";
                break;
            case '7':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\"><img src=\"" . cthumb($data['bl_img'], 240, $data['store_id']) . "\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['bl_name'] . "\"></a></div>
                        <div class=\"goodsinfo\">
                        <dl>
                            <dt><i class=\"desc-type desc-type-bundling\">" . $lang->_('store_sns_bundling') . "</i><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\">".$data['bl_name']."</a></dt>
                            <dd>" . $lang->_('store_sns_bundling_price') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['bl_discount_price']) . "</dd>
                            <dd>" . (($data['bl_freight_choose']==1) ? $lang->_('store_sns_free_shipping') : $lang->_('sns_sharegoods_freight') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['bl_freight'])) . "</dd>
                        </dl>
                    </div>
                    </div>";
                break;
            case '8':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\"><img src=\"" . gthumb($data['group_pic'],'small',$data['store_id']) . "\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['group_name'] . "\"></a></div>
                        <div class=\"goodsinfo\">
                        <dl>
                            <dt><i class=\"desc-type desc-type-groupbuy\">" . $lang->_('store_sns_gronpbuy') . "</i><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\">" . $data['group_name'] . "</a></dt>
                            <dd>" . $lang->_('store_sns_goodsprice') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_price']) . "</dd>
                            <dd>" . $lang->_('store_sns_groupprice') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['groupbuy_price']) . "</dd>
                            <dd>" . $lang->_('store_sns_start-stop_time') . $lang->_('nc_colon') . date('Y-m-d H:i', $data['start_time']) . "~" . date('Y-m-d H:i', $data['end_time']) . "</dd>
                        </dl>
                    </div>
                </div>";
                break;
            case '9':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\"><img src=\"" . thumb($data, 240) . "\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['goods_name'] . "\"></a></div>
                    <div class=\"goodsinfo\">
                    <dl>
                        <dt><i class=\"desc-type desc-type-recommend\">" . $lang->_('store_sns_store_recommend') . "</i><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\">" . $data['goods_name'] . "</a></dt>
                        <dd>" . $lang->_('sns_sharegoods_price') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_price']) . "</dd>
                        <dd>" . $lang->_('sns_sharegoods_freight') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_freight']) . "</dd>
                        <dd nctype=\"collectbtn_" . $data['goods_id'] . "\"><a href=\"javascript:void(0);\" onclick=\"javascript:collect_goods('" . $data['goods_id'] . "','succ','collectbtn_" . $data['goods_id'] . "');\">" . $lang->_('sns_sharegoods_collect') . "</a></dd>
                    </dl>
                    </div>
                 </div>";
                break;
            case '10':
                $rs = "<div class=\"fd-media\">
                    <div class=\"goodsimg\"><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\"><img src=\"" . thumb($data, 240) . "\" onload=\"javascript:DrawImage(this,120,120);\" alt=\"" . $data['goods_name'] . "\"></a></div>
                    <div class=\"goodsinfo\">
                        <dl>
                            <dt><i class=\"desc-type desc-type-hotsell\">" . $lang->_('store_sns_hotsell') . "</i><a target=\"_blank\" href=\"" . getUrl('shop/goods/index', array('goods_id'=>$data['goods_id'])) . "\">" . $data['goods_name'] . "</a></dt>
                            <dd>" . $lang->_('sns_sharegoods_price') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_price']) . "</dd>
                            <dd>" . $lang->_('sns_sharegoods_freight') . $lang->_('nc_colon') . $lang->_('currency') . ncPriceFormat($data['goods_freight']) . "</dd>
                            <dd nctype=\"collectbtn_" . $data['goods_id'] . "\"><a href=\"javascript:void(0);\" onclick=\"javascript:collect_goods('" . $data['goods_id'] . "','succ','collectbtn_" . $data['goods_id']. "');\">" . $lang->_('sns_sharegoods_collect') . "</a></dd>
                        </dl>
                      </div>
                     </div>";
                break;
        }
        return $rs;
    }
}
