<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 15:24
 */

namespace Ypk\Logic;


use Ypk\Model;
use Ypk\Models\Waybill;
use Ypk\UploadFile;
use Ypk\Validate;

class WaybillLogic extends Model
{
    /**
     * 获取设计数据
     * @param int $waybill_id 运单id
     * @param int $store_id 提供医生编号时验证模板的所属医生
     * @return array
     */
    public function getWaybillDesignInfo($waybill_id, $store_id = 0)
    {
        $waybill_id = intval($waybill_id);

        if ($waybill_id <= 0) {
            return array('error' => '运单模板不存在');
        }

        //$waybill_info = $this->getWaybillInfoByID($waybill_id);
        $waybill_info = Waybill::findFirst('waybill_id=' . $waybill_id)->toArray();
        if (!$waybill_info) {
            return array('error' => '运单模板不存在');
        }
        if ($store_id > 0 && $waybill_info['store_id'] != $store_id) {
            return array('error' => '运单模板不存在');
        }

        $waybill_info_data = $waybill_info['waybill_data'];
        unset($waybill_info['waybill_data']);

        //获取运单项目列表
        $waybill_item_list = $this->getWaybillItemList();

        if (!empty($waybill_info_data)) {
            foreach ($waybill_info_data as $key => $value) {
                $waybill_info_data[$key]['item_text'] = $waybill_item_list[$key]['item_text'];
            }
        }

        foreach ($waybill_item_list as $key => $value) {
            $waybill_item_list[$key]['check'] = $waybill_info_data[$key]['check'] ? 'checked' : '';
            $waybill_item_list[$key]['width'] = $waybill_info_data[$key]['width'] ? $waybill_info_data[$key]['width'] : '0';
            $waybill_item_list[$key]['height'] = $waybill_info_data[$key]['height'] ? $waybill_info_data[$key]['height'] : '0';
            $waybill_item_list[$key]['top'] = $waybill_info_data[$key]['top'] ? $waybill_info_data[$key]['top'] : '0';
            $waybill_item_list[$key]['left'] = $waybill_info_data[$key]['left'] ? $waybill_info_data[$key]['left'] : '0';
        }

        return array(
            'waybill_info' => $waybill_info,
            'waybill_info_data' => $waybill_info_data,
            'waybill_item_list' => $waybill_item_list,
        );

    }

    /**
     * 获取运单项目列表
     */
    public function getWaybillItemList()
    {
        $item = array(
            'buyer_name' => array('item_text' => '收货人'),
            'buyer_area' => array('item_text' => '收货人地区'),
            'buyer_address' => array('item_text' => '收货人地址'),
            'buyer_mobile' => array('item_text' => '收货人手机'),
            'buyer_phone' => array('item_text' => '收货人电话'),
            'seller_name' => array('item_text' => '发货人'),
            'seller_area' => array('item_text' => '发货人地区'),
            'seller_address' => array('item_text' => '发货人地址'),
            'seller_phone' => array('item_text' => '发货人电话'),
            'seller_company' => array('item_text' => '发货人公司'),
        );
        return $item;
    }

    /**
     * 根据编号读取单条记录
     * @param $waybill_id
     * @return bool|Waybill
     */
    public function getWaybillInfoByID($waybill_id)
    {
        $waybill_id = intval($waybill_id);
        if ($waybill_id <= 0) {
            return false;
        }

        //$waybill_info = $this->getWaybillInfo(array('waybill_id' => $waybill_id));
        $waybill_info = Waybill::findFirst('waybill_id=' . $waybill_id);
        return $waybill_info;
    }

    /**
     * @param $post 提交的数据
     * @param int $store_id 医生id
     * @return bool
     *
     * 保存运单模版
     */
    public function saveWaybill($post, $store_id = 0)
    {
        $param = array();
        $param['waybill_name'] = $post['waybill_name'];
        $param['waybill_width'] = $post['waybill_width'];
        $param['waybill_height'] = $post['waybill_height'];
        $param['waybill_left'] = $post['waybill_left'];
        $param['waybill_top'] = $post['waybill_top'];
        $param['waybill_usable'] = $post['waybill_usable'];
        $param['store_id'] = $store_id;
        list($param['express_id'], $param['express_name']) = explode('|', $_POST['waybill_express']);

        //图片上传
        $waybill_image = $this->_waybill_image_upload();
        if ($waybill_image) {
            $param['waybill_image'] = $waybill_image;
            if (!empty($param['old_waybill_image'])) {
                $this->delWaybillImage($_POST['old_waybill_image']); //删除图片
            }
        }

        //验证数据
        $error = $this->validWaybill($param);
        if ($error != '') {
            return false;
        }

        if (empty($post['waybill_id'])) { //添加
            $result = $this->addWaybill($param);
            $waybill_id = $result;
        } else { //编辑
            $condition = array();
            $condition['waybill_id'] = intval($post['waybill_id']);
            if ($store_id > 0) {
                $condition['store_id'] = $store_id;
            }
            $result = $this->editWaybill($param, $condition); //更新数据
            $waybill_id = $post['waybill_id'];
        }

        if ($result) {
            return $waybill_id;
        } else {
            return false;
        }
    }

    /**
     * 图片上传
     * @return bool
     */
    private function _waybill_image_upload()
    {
        $upload = new UploadFile();
        $upload->set('default_dir', ATTACH_WAYBILL); //设置上传目录
        $upload->set('allow_type', array('jpg', 'jpeg', 'png')); //设置文件类型

        $result = $upload->upfile('waybill_image');
        if ($result) {
            return $upload->file_name;
        } else {
            return false;
        }
    }

    /**
     * 添加
     * @param array $param
     * @return mixed
     */
    public function addWaybill($param)
    {
        $model = new Waybill();
        return $model->save($param);
        //return $this->insert($param);
    }

    /**
     * 删除图片
     * @param $image_name
     */
    public function delWaybillImage($image_name)
    {
        $image = BASE_UPLOAD_PATH . DS . ATTACH_WAYBILL . DS . $image_name;
        if (is_file($image)) {
            @unlink($image);
        }
    }

    /**
     * 验证输入信息
     * @param $input
     * @return mixed
     */
    public function validWaybill($input)
    {
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input" => $input['waybill_name'], "require" => "true", "message" => '模板名称不能为空'),
            array("input" => $input['waybill_width'], "require" => "true", "message" => '宽度不能为空'),
            array("input" => $input['waybill_height'], "require" => "true", "message" => '高度不能为空'),
        );
        return $obj_validate->validate();
    }

    /**
     * 更新
     * @param array $update 要更新的数据
     * @param $condition 条件
     * @return mixed
     */
    public function editWaybill($update, $condition)
    {
        $model = Waybill::findFirst($condition);
        return $model->save($update);
        //return $this->where($condition)->update($update);
    }
}