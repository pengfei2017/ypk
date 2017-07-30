<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/13
 * Time: 15:12
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class BaseArticleController extends ControllerBase
{
    public function initialize()
    {
        /**
         * 读取通用、布局的语言包
         */
        getTranslation('common,core_lang_index');
        /**
         * 设置布局文件内容
         */
        // Tpl::setLayout('article_layout');

        /**
         * 获取导航
         */
        Tpl::output('nav_list', read_file_cache('nav', true));

        /**
         *  输出头部的公用信息
         */
        $this->showLayout();

        /**
         * 文章
         */
        $this->article();
    }

}