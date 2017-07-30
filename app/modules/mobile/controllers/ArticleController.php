<?php
/**
 * 文章
 **/
namespace Ypk\Modules\Mobile\Controllers;

use Ypk\Models\Article;
use Ypk\Models\ArticleClass;

class ArticleController extends MobileHomeController
{

    public function initialize()
    {
        parent::initialize();
    }

    /**
     * 文章列表
     */
    public function article_listAction()
    {
        if (!empty($_GET['ac_id']) && intval($_GET['ac_id']) > 0) {
            $article_class_model = Model('article_class');
            $article_model = Model('article');
            $condition = array();

            $child_class_list = $article_class_model->getChildClass(array(2,3,5));
            $ac_ids = array();
            if (!empty($child_class_list) && is_array($child_class_list)) {
                foreach ($child_class_list as $v) {
                    $ac_ids[] = $v['ac_id'];
                }
            }
            $ac_ids = implode(',', $ac_ids);
            $condition['ac_ids'] = $ac_ids;
            $condition['article_show'] = '1';
            $article_list = $article_model->getArticleList($condition);
            $article_type_name = $this->article_type_name($ac_ids);
            output_data(array('article_list' => $article_list, 'article_type_name' => $article_type_name));
        } else {
            output_error('缺少参数:文章类别编号');
        }
    }

    /**
     * ajax获取文章列表
     */
    public function ajax_article_listAction()
    {
        $str = "";
        $ac_info = ArticleClass::findFirst("ac_code='news'");
        if ($ac_info) {
            $ac_info = $ac_info->toArray();
            $ac_id = $ac_info['ac_id'];
            $article_list = Article::find("ac_id=" . $ac_id . " and article_show=1");
            if (count($article_list) > 0) {
                $article_list = $article_list->toArray();
                foreach ($article_list as $article) {
                    $str .= "<dl class=\"mt5 news_list\">";
                    $str .= " <dt>";
                    $str .= " <a href=\"news_detail.html?news_id=" . $article['article_id'] . "\">";
                    $title = mb_strlen($article['article_title'], 'UTF-8') > 26 ? (mb_substr($article['article_title'], 0, 26, 'UTF-8') . "...") : $article['article_title'];
                    $str .= "<h3>" . $title . "</h3>";
                    $str .= "<span>";
                    $str .= "<img class=\"news_img\" src=\"/h5_web/images/news/news_ico.png\" />";
                    $str .= "</span>";
                    $str .= "</a>";
                    $str .= "<a href=\"javascript:void(0)\" data-id=\"" . $article['article_id'] . "\" onclick=\"collectNews(this)\" style=\"display: inline-block;font-size: 0.7rem;margin-top: 0.5rem;\">收藏</a>";
                    $str .= "</dt>";
                    $str .= "</dl>";
                }
            }
        }
        echo $str;
        exit;
    }

    /**
     * ajax获取新闻资讯详情
     */
    public function ajax_article_detailAction()
    {
        $str = "";
        if (!empty($_POST['news_id'])) {
            $article = Article::findFirst("article_id=" . $_POST['news_id']);
            if ($article) {
                $article = $article->toArray();
                $str .= "<div class=\"title\">" . $article['article_title'] . "</div>";
                $str .= "<div class=\"time\">" . date('Y-m-d H:i:s', $article['article_time']) . "</div>";
                $str .= "<p class=\"content\">" . $article['article_content'] . "</p>";
            }
        }
        echo $str;
        exit;
    }

    /**
     * 获取“健康知识”列表
     */
    public function ajax_health_listAction()
    {
        $str = "";
        $ac_info = ArticleClass::findFirst("ac_code='health'");
        if ($ac_info) {
            $ac_info = $ac_info->toArray();
            $ac_id = $ac_info['ac_id'];
            $article_list = Article::find("ac_id=" . $ac_id . " and article_show=1");
            if (count($article_list) > 0) {
                $article_list = $article_list->toArray();
                foreach ($article_list as $article) {
                    $str .= "<dl class=\"mt5 news_list\">";
                    $str .= " <dt>";
                    $str .= " <a href=\"health_detail.html?health_id=" . $article['article_id'] . "\">";
                    $title = mb_strlen($article['article_title'], 'UTF-8') > 26 ? (mb_substr($article['article_title'], 0, 26, 'UTF-8') . "...") : $article['article_title'];
                    $str .= "<h3>" . $title . "</h3>";
                    $str .= "<span>";
                    $str .= "<img class=\"news_img\" src=\"/h5_web/images/news/news_ico.png\" />";
                    $str .= "</span>";
                    $str .= "</a>";
                    //$str .= "<a href=\"javascript:void(0)\" data-id=\"" . $article['article_id'] . "\" onclick=\"collectNews(this)\" style=\"display: inline-block;font-size: 0.7rem;margin-top: 0.5rem;\">收藏</a>";
                    $str .= "</dt>";
                    $str .= "</dl>";
                }
            }
        }
        if (empty($str)) {
            $str .= "<dl class=\"mt5 news_list\">";
            $str .= " <dt>";
            $str .= "<h3>暂无记录</h3>";
            $str .= "<span>";
            $str .= "</span>";
            $str .= "</a>";
            $str .= "</dt>";
            $str .= "</dl>";
        }
        echo $str;
        exit;
    }

    /**
     * 获取“健康知识”详情
     */
    public function ajax_health_detailAction()
    {
        $str = "";
        if (!empty($_POST['health_id'])) {
            $article = Article::findFirst("article_id=" . $_POST['health_id']);
            if ($article) {
                $article = $article->toArray();
                $str .= "<div class=\"title\">" . $article['article_title'] . "</div>";
                $str .= "<div class=\"time\">" . date('Y-m-d H:i:s', $article['article_time']) . "</div>";
                $str .= "<p class=\"content\">" . $article['article_content'] . "</p>";
            }
        }
        echo $str;
        exit;
    }

    /**
     * 根据类别编号获取文章类别信息
     */
    private function article_type_name()
    {
        if (!empty($_GET['ac_id']) && intval($_GET['ac_id']) > 0) {
            $article_class_model = Model('article_class');
            $article_class = $article_class_model->getOneClass(intval($_GET['ac_id']));
            return ($article_class['ac_name']);
        } else {
            return ('缺少参数:文章类别编号');
        }
    }

    /**
     * 单篇文章显示
     */
    public function article_showAction()
    {
        $article_model = Model('article');

        if (!empty($_GET['article_id']) && intval($_GET['article_id']) > 0) {
            $article = $article_model->getOneArticle(intval($_GET['article_id']));

            if (empty($article)) {
                output_error('文章不存在');
            } else {
                output_data($article);
            }
        } else {
            output_error('缺少参数:文章编号');
        }
    }
}
