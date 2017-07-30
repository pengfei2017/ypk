<?php
/**
 * 文章
 **/
namespace Ypk\Modules\Mobile\Controllers;

class ArticleClassController extends MobileHomeController
{

    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $article_class_model = Model('article_class');
        $article_model = Model('article');
        $condition = array();

        $article_class = $article_class_model->getClassList($condition);
        output_data(array('article_class' => $article_class));
    }
}
