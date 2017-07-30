<?php
/**
 * 前台品牌分类
 */

namespace Ypk\Modules\Mobile\Controllers;

class DocumentController extends MobileHomeController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function agreementAction()
    {
        $doc = Model('document')->getOneByCode('agreement');
        output_data($doc);
    }
}
