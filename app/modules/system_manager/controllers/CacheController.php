<?php
/**
 * wdb
 * 清理缓存
 */

namespace Ypk\Modules\SystemManager\Controllers;


use Ypk\Modules\Admin\Controllers\ControllerBase;
use Ypk\Tpl;

class CacheController extends ControllerBase
{
    protected $cacheItems = array(
        'setting',          // 基本缓存
        'seo',              // SEO缓存
        'groupbuy_price',   // 抢购价格区间
        'nav',              // 底部导航缓存
        'express',          // 快递公司
        'store_class',      // 医生分类
        'store_grade',      // 医生等级
        'store_msg_tpl',    // 医生消息
        'member_msg_tpl',   // 用户消息
        'consult_type',     // 咨询类型
        'circle_level',     // 圈子成员等级
        'admin_menu',       // 后台菜单
        'area',              // 地区
        'contractitem'      //消费者保障服务
    );

    public function initialize()
    {
        parent::initialize();
        $this->translation = getTranslation('common,layout,cache');
        $this->view->setVar('lang', $this->translation);
    }

    public function indexAction()
    {
        $this->clearAction();
    }

    /**
     * 清理缓存
     */
    public function clearAction()
    {
        if (!chksubmit()) {
//            Tpl::setDirquna('system');
//            Tpl::showpage('cache.clear');
            $this->view->pick('cache/cache_clear');
            return;
        }
        $lang = getTranslation();
        delCacheFile('');
        $this->log(getLang('cache_cls_operate'));
        showMessage($lang['cache_cls_ok']);
        return;


        //todo 后期需要把缓存键名称设为全局常量，下面的代码再做整改

        // 清理所有缓存
        if ($_POST['cls_full'] == 1) {
            foreach ($this->cacheItems as $i) {
                delete_file_cache($i);
            }

            // 商品分类
            delete_file_cache('gc_class');
            delete_file_cache('all_categories');
            delete_file_cache('goods_class_seo');
            delete_file_cache('class_tag');

            // 广告
            Model('adv')->makeApAllCache();

            // 首页及频道
            Model('web_config')->updateWeb(array('web_show' => 1), array('web_html' => ''));
            delCacheFile('index');
            delete_file_cache('channel');

            if (getConfig('cache_open')) {
                delete_file_cache('article', 'index/');
            }

        } else {
            $todo = (array)$_POST['cache'];

            foreach ($this->cacheItems as $i) {
                if (in_array($i, $todo)) {
                    delete_file_cache($i);
                }
            }

            // 商品分类
            if (in_array('goodsclass', $todo)) {
                delete_file_cache('gc_class');
                delete_file_cache('all_categories');
                delete_file_cache('goods_class_seo');
                delete_file_cache('class_tag');
            }

            // 广告
            if (in_array('adv', $todo)) {
                Model('adv')->makeApAllCache();
            }

            // 首页及频道
            if (in_array('index', $todo)) {
                Model('web_config')->updateWeb(array('web_show' => 1), array('web_html' => ''));
                delCacheFile('index');
                delete_file_cache('channel');

                if (getConfig('cache_open')) {
                    delete_file_cache('article', 'index/');
                }
            }
        }
        $this->log(getLang('cache_cls_operate'));
        showMessage($lang['cache_cls_ok']);
    }
}
