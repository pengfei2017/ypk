<?php
/**
 * 商家注销
 */

namespace Ypk\Modules\Mobile\Controllers;



class SellerAlbumController extends MobileSellerController {

    public function initialize(){
        parent::initialize();
    }

    public function image_uploadAction() {
        $logic_goods = Logic('goods');

        $result =  $logic_goods->uploadGoodsImage(
            $_POST['name'],
            $this->seller_info['store_id'],
            $this->store_grade['sg_album_limit']
        );

        if(!$result['state']) {
            output_error($result['msg']);
        }

        output_data(array('image_name' => $result['data']['name']));
    }

}
