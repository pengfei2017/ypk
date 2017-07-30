<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/14
 * Time: 11:09
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Models\CaseHistory;
use Ypk\Models\Member;
use Ypk\Models\Store;
use Ypk\Tpl;

class CaseHistoryController extends BaseSellerController
{
    public function initialize()
    {
        parent::initialize();
        getTranslation('member_home_index,common,msg');
    }

    public function indexAction()
    {
        $str = "";
        $store_info = Store::findFirst("member_id=" . getSession('member_id'));
        if ($store_info !== false) {
            $member_ids = CaseHistory::find(array('conditions' => 'store_id=' . $store_info->getStoreId(), 'columns' => 'member_id'));
            if (count($member_ids) > 0) {
                $user_ids = array();
                foreach ($member_ids as $member_id) {
                    $user_ids[] = $member_id['member_id'];
                }
                if (!empty($user_ids)) {
                    $ids = implode(',', $user_ids);
                    if (!empty($ids)) {
                        $member_list = Member::find("member_id in (" . $ids . ") and member_state=1");
                        if (count($member_list) > 0) {
                            $member_list = $member_list->toArray();
                            foreach ($member_list as $member) {
                                $str .= "<option value='" . $member['member_id'] . "'>" . $member['member_name'] . "</option>";
                            }
                        }
                    }
                }
            }
        }
        Tpl::output('option_list', $str);
    }

    /**
     * 异步加载购买用户的病历列表
     */
    public function ajax_loadAction()
    {
        $str = "";
        $buyer_id = $_POST['member_id'];
        if (!empty($buyer_id)) {
            $store_info = Store::findFirst("member_id=" . getSession('member_id'));
            if ($store_info !== false) {
                if (intval($buyer_id) == -1) { //查出该医生的客户的全部病历
                    $case_list = CaseHistory::find("store_id=" . $store_info->getStoreId() . " and is_public=1");
                } else {
                    $case_list = CaseHistory::find("member_id=" . $buyer_id . " and store_id=" . $store_info->getStoreId() . " and is_public=1");
                }
                if (count($case_list) > 0) {
                    $case_list = $case_list->toArray();
                    foreach ($case_list as $case_info) {
                        $str .= "<li class=\"item\"><a href=\"" . getUrl('shop/case_history/details', array('case_id' => $case_info['id'])) . "\">" . $case_info['title'] . "</a></li>";
                    }
                }
            }
        }
        if (empty($str)) {
            $str = "<li class=\"item\">暂无病历记录</li>";
        }
        echo $str;
        exit;
    }

    /**
     * 加载病历详情
     */
    public function detailsAction()
    {
        $str = "";
        $case_id = $_REQUEST['case_id'];
        if (!empty($case_id)) {
            $case_info = CaseHistory::findFirst("id=" . $case_id);
            if ($case_info !== false) {
                Tpl::output('title',$case_info->getTitle());
                Tpl::output('content',$case_info->getCaseContent());
            }
        }
    }
}