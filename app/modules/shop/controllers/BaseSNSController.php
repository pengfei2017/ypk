<?php
/**
 * 相册总父类
 * User: Administrator
 * Date: 2017/1/11
 * Time: 0:00
 */

namespace Ypk\Modules\Shop\Controllers;


use Ypk\Tpl;

class BaseSNSController extends ControllerBase
{
    protected $relation = 0;//浏览者与主人的关系：0 表示游客 1 表示一般普通会员 2表示朋友 3表示自己4表示已关注主人
    protected $master_id = 0; //主人编号
    const MAX_RECORDNUM = 20;//允许插入新记录的最大条数
    protected $master_info;

    public function initialize()
    {
        //Tpl::setDir('sns');
        //Tpl::setLayout('sns_layout');

        $this->view->setLayoutsDir(SHOP_LAYOUT_DIR);
        $this->view->setLayout('sns_layout');

        getTranslation('common,sns_layout');

        //验证会员及与主人关系
        $this->check_relation();

        //查询会员信息
        $this->getMemberAndGradeInfo(false);

        $this->master_info = $this->get_member_info();
        Tpl::output('master_info', $this->master_info);

        //添加访问记录
        $this->add_visit();

        //我的关注
        $this->my_attention();

        //获取设置
        $this->get_setting();

        //允许插入新记录的最大条数
        Tpl::output('max_recordnum', self::MAX_RECORDNUM);

        $this->showCartCount();

        Tpl::output('nav_list', read_file_cache('nav', true));
    }

    /**
     * 格式化时间
     * @param $time
     * @internal param $time时间戳
     * * @return false|string
     */
    protected function formatDate($time)
    {
        $handle_date = @date('Y-m-d', $time);//需要格式化的时间
        $reference_date = @date('Y-m-d', time());//参照时间
        $handle_date_time = strtotime($handle_date);//需要格式化的时间戳
        $reference_date_time = strtotime($reference_date);//参照时间戳
        if ($reference_date_time == $handle_date_time) {
            $timetext = @date('H:i', $time);//今天访问的显示具体的时间点
        } elseif (($reference_date_time - $handle_date_time) == 60 * 60 * 24) {
            $timetext = getLang('sns_yesterday');
        } elseif ($reference_date_time - $handle_date_time == 60 * 60 * 48) {
            $timetext = getLang('sns_beforeyesterday');
        } else {
            $month_text = getLang('nc_month');
            $day_text = getLang('nc_day');
            $timetext = @date("m{$month_text}d{$day_text}", $time);
        }
        return $timetext;
    }

    /**
     * 会员信息
     *
     * @return array
     */
    public function get_member_info()
    {
        if ($this->master_id <= 0) {
            showMessage(getLang('wrong_argument'), '', '', 'error');
        }
        $model = Model();
        $member_info = Model('member')->getMemberInfoByID($this->master_id);
        if (empty($member_info)) {
            showMessage(getLang('wrong_argument'), getUrl('shop/member_snshome'), '', 'error');
        }
        //粉丝数
        $fan_count = $model->table('sns_friend')->where(array('friend_tomid' => $this->master_id))->count();
        $member_info['fan_count'] = $fan_count;
        //关注数
        $attention_count = $model->table('sns_friend')->where(array('friend_frommid' => $this->master_id))->count();
        $member_info['attention_count'] = $attention_count;
        //兴趣标签
        $mtag_list = $model->table('sns_membertag,sns_mtagmember')->field('mtag_name')->on('sns_membertag.mtag_id = sns_mtagmember.mtag_id')->join('inner')->where(array('sns_mtagmember.member_id' => $this->master_id))->select();
        $tagname_array = array();
        if (!empty($mtag_list)) {
            foreach ($mtag_list as $val) {
                $tagname_array[] = $val['mtag_name'];
            }
        }
        $member_info['tagname'] = $tagname_array;
        return $member_info;
    }

    /**
     * 访客信息
     */
    protected function get_visitor()
    {
        $model = Model();
        //查询谁来看过我
        $visitme_list = $model->table('sns_visitor')->where(array('v_ownermid' => $this->master_id))->limit(9)->order('v_addtime desc')->select();
        if (!empty($visitme_list)) {
            foreach ($visitme_list as $k => $v) {
                $v['adddate_text'] = $this->formatDate($v['v_addtime']);
                $v['addtime_text'] = @date('H:i', $v['v_addtime']);
                $visitme_list[$k] = $v;
            }
        }
        Tpl::output('visitme_list', $visitme_list);
        if ($this->relation == 3) {   // 主人自己才有我访问过的人
            //查询我访问过的人
            $visitother_list = $model->table('sns_visitor')->where(array('v_mid' => $this->master_id))->limit(9)->order('v_addtime desc')->select();
            if (!empty($visitother_list)) {
                foreach ($visitother_list as $k => $v) {
                    $v['adddate_text'] = $this->formatDate($v['v_addtime']);
                    $visitother_list[$k] = $v;
                }
            }
            Tpl::output('visitother_list', $visitother_list);
        }
    }

    /**
     * 验证会员及主人关系
     */
    private function check_relation()
    {
        $model = Model();
        //验证主人会员编号
        $this->master_id = intval($_GET['mid']);
        if ($this->master_id <= 0) {
            if ($_SESSION['is_login'] == 1) {
                $this->master_id = $_SESSION['member_id'];
            } else {
                @header("location: " . getUrl('member/login/index', array('ref_url' => getUrl('shop/member_snshome'))));
            }
        }
        Tpl::output('master_id', $this->master_id);

        $model = Model();

        //判断浏览者与主人的关系
        if ($_SESSION['is_login'] == '1') {
            if ($this->master_id == $_SESSION['member_id']) {//主人自己
                $this->relation = 3;
            } else {
                $this->relation = 1;
                //查询好友表
                $friend_arr = $model->table('sns_friend')->where(array('friend_frommid' => $_SESSION['member_id'], 'friend_tomid' => $this->master_id))->find();
                if (!empty($friend_arr) && $friend_arr['friend_followstate'] == 2) {
                    $this->relation = 2;
                } elseif ($friend_arr['friend_followstate'] == 1) {
                    $this->relation = 4;
                }
            }
        }
        Tpl::output('relation', $this->relation);
    }

    /**
     * 增加访问记录
     */
    private function add_visit()
    {
        $model = Model();
        //记录访客
        if ($_SESSION['is_login'] == '1' && $this->relation != 3) {
            //访客为会员且不是空间主人则添加访客记录
            $visitor_info = $model->table('member')->where(array('member_id' => $_SESSION['member_id']))->find();
            if (!empty($visitor_info)) {
                //查询访客记录是否存在
                $existevisitor_info = $model->table('sns_visitor')->where(array('v_ownermid' => $this->master_id, 'v_mid' => $visitor_info['member_id']))->find();
                if (!empty($existevisitor_info)) {//访问记录存在则更新访问时间
                    $update_arr = array();
                    $update_arr['v_addtime'] = time();
                    $model->table('sns_visitor')->update(array('v_id' => $existevisitor_info['v_id'], 'v_addtime' => time()));
                } else {//添加新访问记录
                    $insert_arr = array();
                    $insert_arr['v_mid'] = $visitor_info['member_id'];
                    $insert_arr['v_mname'] = $visitor_info['member_name'];
                    $insert_arr['v_mavatar'] = $visitor_info['member_avatar'];
                    $insert_arr['v_ownermid'] = $this->master_info['member_id'];
                    $insert_arr['v_ownermname'] = $this->master_info['member_name'];
                    $insert_arr['v_ownermavatar'] = $this->master_info['member_avatar'];
                    $insert_arr['v_addtime'] = time();
                    $model->table('sns_visitor')->insert($insert_arr);
                }
            }
        }

        //增加主人访问次数
        $cookie_str = cookie('visitor');
        $cookie_arr = array();
        $is_increase = false;
        if (empty($cookie_str)) {
            //cookie不存在则直接增加访问次数
            $is_increase = true;
        } else {
            //cookie存在但是为空则直接增加访问次数
            $cookie_arr = explode('_', $cookie_str);
            if (!in_array($this->master_id, $cookie_arr)) {
                $is_increase = true;
            }
        }
        if ($is_increase == true) {
            //增加访问次数
            $model->table('member')->update(array('member_id' => $this->master_id, 'member_snsvisitnum' => array('exp', 'member_snsvisitnum+1')));
            //设置cookie，24小时之内不再累加
            $cookie_arr[] = $this->master_id;
            setMyCookie('visitor', implode('_', $cookie_arr), 24 * 3600);//保存24小时
        }
    }

    //我的关注
    private function my_attention()
    {
        if (intval($_SESSION['member_id']) > 0) {
            $my_attention = Model()->table('sns_friend')->where(array('friend_frommid' => $_SESSION['member_id']))->order('friend_addtime desc')->limit(4)->select();
            Tpl::output('my_attention', $my_attention);
        }
    }

    /**
     * 获取设置信息
     */
    private function get_setting()
    {
        $m_setting = Model()->table('sns_setting')->where(array('member_id' => $this->master_id))->find();
        Tpl::output('skin_style', (!empty($m_setting['setting_skin']) ? $m_setting['setting_skin'] : 'skin_01'));
    }

    /**
     * 留言板
     */
    protected function sns_messageboard()
    {
        $model = Model();
        $where = array();
        $where['from_member_id'] = array('neq', 0);
        $where['to_member_id'] = $this->master_id;
        $where['message_state'] = array('neq', 2);
        $where['message_parent_id'] = 0;
        $where['message_type'] = 2;
        $message_list = $model->table('message')->where($where)->order('message_id desc')->limit(10)->select();
        if (!empty($message_list)) {
            $pmsg_id = array();
            foreach ($message_list as $key => $val) {
                $pmsg_id[] = $val['message_id'];
                $message_list[$key]['message_time'] = $this->formatDate($val['message_time']);
            }
            $where = array();
            $where['message_parent_id'] = array('in', $pmsg_id);
            $rmessage_array = $model->table('message')->where($where)->select();
            $rmessage_list = array();
            if (!empty($rmessage_array)) {
                foreach ($rmessage_array as $key => $val) {
                    $val['message_time'] = $this->formatDate($val['message_time']);
                    $rmessage_list[$val['message_parent_id']][] = $val;
                }
                foreach ($rmessage_list as $key => $val) {
                    $rmessage_list[$key] = array_slice($val, -3, 3);
                }
            }
            Tpl::output('rmessage_list', $rmessage_list);
        }
        Tpl::output('message_list', $message_list);
    }
}