<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/9
 * Time: 20:38
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class LinkController extends BaseHomeController
{
    public function indexAction(){

        //友情链接
        getTranslation('home_index_index');
        $model_link = Model('link');
        $link_list = $model_link->getLinkList($condition,$page);
        /**
         * 整理图片链接
         */
        if (is_array($link_list)){
            foreach ($link_list as $k => $v){
                if (!empty($v['link_pic'])){
                    $link_list[$k]['link_pic'] = UPLOAD_SITE_URL.'/'.ATTACH_PATH.'/common/'.DS.$v['link_pic'];
                }
            }
        }
        Tpl::output('$link_list',$link_list);
        Model('seo')->type('index')->show();
       // Tpl::showpage('link');
        $this->view->render('link','link');
        $this->view->disable();
    }

}
