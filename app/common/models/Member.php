<?php

namespace Ypk\Models;

class Member extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $member_truename;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $member_avatar;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $member_sex;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $member_birthday;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $member_passwd;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    protected $member_paypwd;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $member_email;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $member_email_bind;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=true)
     */
    protected $member_mobile;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $member_mobile_bind;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $member_qq;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $member_ww;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_login_num;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $member_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $member_login_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $member_old_login_time;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $member_login_ip;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $member_old_login_ip;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $member_qqopenid;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $member_qqinfo;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $member_sinaopenid;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $member_sinainfo;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $weixin_unionid;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $weixin_info;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $available_predeposit;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $freeze_predeposit;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $available_rc_balance;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $freeze_rc_balance;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $inform_allow;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $is_buy;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $is_allowtalk;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $member_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_snsvisitnum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_areaid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_cityid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_provinceid;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $member_areainfo;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $member_privacy;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $member_exppoints;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $invite_one;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $invite_two;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $invite_three;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $inviter_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_row;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_column;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_left_invite_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_right_invite_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_row;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_column;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_left_invite_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_right_invite_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_self_used_points_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_left_used_points_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_right_used_points_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_collision_sum_times;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $member_collision_sum_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_self_used_points_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_left_used_points_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_right_used_points_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_collision_sum_times;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_collision_sum_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_type_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_final_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_final_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $upgrade_time;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $member_commission_money_sum;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_commission_money_sum;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $member_straight_money_sum;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_straight_money_sum;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_share_benefits_money_sum;

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Method to set the value of field member_truename
     *
     * @param string $member_truename
     * @return $this
     */
    public function setMemberTruename($member_truename)
    {
        $this->member_truename = $member_truename;

        return $this;
    }

    /**
     * Method to set the value of field member_avatar
     *
     * @param string $member_avatar
     * @return $this
     */
    public function setMemberAvatar($member_avatar)
    {
        $this->member_avatar = $member_avatar;

        return $this;
    }

    /**
     * Method to set the value of field member_sex
     *
     * @param integer $member_sex
     * @return $this
     */
    public function setMemberSex($member_sex)
    {
        $this->member_sex = $member_sex;

        return $this;
    }

    /**
     * Method to set the value of field member_birthday
     *
     * @param string $member_birthday
     * @return $this
     */
    public function setMemberBirthday($member_birthday)
    {
        $this->member_birthday = $member_birthday;

        return $this;
    }

    /**
     * Method to set the value of field member_passwd
     *
     * @param string $member_passwd
     * @return $this
     */
    public function setMemberPasswd($member_passwd)
    {
        $this->member_passwd = $member_passwd;

        return $this;
    }

    /**
     * Method to set the value of field member_paypwd
     *
     * @param string $member_paypwd
     * @return $this
     */
    public function setMemberPaypwd($member_paypwd)
    {
        $this->member_paypwd = $member_paypwd;

        return $this;
    }

    /**
     * Method to set the value of field member_email
     *
     * @param string $member_email
     * @return $this
     */
    public function setMemberEmail($member_email)
    {
        $this->member_email = $member_email;

        return $this;
    }

    /**
     * Method to set the value of field member_email_bind
     *
     * @param integer $member_email_bind
     * @return $this
     */
    public function setMemberEmailBind($member_email_bind)
    {
        $this->member_email_bind = $member_email_bind;

        return $this;
    }

    /**
     * Method to set the value of field member_mobile
     *
     * @param string $member_mobile
     * @return $this
     */
    public function setMemberMobile($member_mobile)
    {
        $this->member_mobile = $member_mobile;

        return $this;
    }

    /**
     * Method to set the value of field member_mobile_bind
     *
     * @param integer $member_mobile_bind
     * @return $this
     */
    public function setMemberMobileBind($member_mobile_bind)
    {
        $this->member_mobile_bind = $member_mobile_bind;

        return $this;
    }

    /**
     * Method to set the value of field member_qq
     *
     * @param string $member_qq
     * @return $this
     */
    public function setMemberQq($member_qq)
    {
        $this->member_qq = $member_qq;

        return $this;
    }

    /**
     * Method to set the value of field member_ww
     *
     * @param string $member_ww
     * @return $this
     */
    public function setMemberWw($member_ww)
    {
        $this->member_ww = $member_ww;

        return $this;
    }

    /**
     * Method to set the value of field member_login_num
     *
     * @param integer $member_login_num
     * @return $this
     */
    public function setMemberLoginNum($member_login_num)
    {
        $this->member_login_num = $member_login_num;

        return $this;
    }

    /**
     * Method to set the value of field member_time
     *
     * @param string $member_time
     * @return $this
     */
    public function setMemberTime($member_time)
    {
        $this->member_time = $member_time;

        return $this;
    }

    /**
     * Method to set the value of field member_login_time
     *
     * @param string $member_login_time
     * @return $this
     */
    public function setMemberLoginTime($member_login_time)
    {
        $this->member_login_time = $member_login_time;

        return $this;
    }

    /**
     * Method to set the value of field member_old_login_time
     *
     * @param string $member_old_login_time
     * @return $this
     */
    public function setMemberOldLoginTime($member_old_login_time)
    {
        $this->member_old_login_time = $member_old_login_time;

        return $this;
    }

    /**
     * Method to set the value of field member_login_ip
     *
     * @param string $member_login_ip
     * @return $this
     */
    public function setMemberLoginIp($member_login_ip)
    {
        $this->member_login_ip = $member_login_ip;

        return $this;
    }

    /**
     * Method to set the value of field member_old_login_ip
     *
     * @param string $member_old_login_ip
     * @return $this
     */
    public function setMemberOldLoginIp($member_old_login_ip)
    {
        $this->member_old_login_ip = $member_old_login_ip;

        return $this;
    }

    /**
     * Method to set the value of field member_qqopenid
     *
     * @param string $member_qqopenid
     * @return $this
     */
    public function setMemberQqopenid($member_qqopenid)
    {
        $this->member_qqopenid = $member_qqopenid;

        return $this;
    }

    /**
     * Method to set the value of field member_qqinfo
     *
     * @param string $member_qqinfo
     * @return $this
     */
    public function setMemberQqinfo($member_qqinfo)
    {
        $this->member_qqinfo = $member_qqinfo;

        return $this;
    }

    /**
     * Method to set the value of field member_sinaopenid
     *
     * @param string $member_sinaopenid
     * @return $this
     */
    public function setMemberSinaopenid($member_sinaopenid)
    {
        $this->member_sinaopenid = $member_sinaopenid;

        return $this;
    }

    /**
     * Method to set the value of field member_sinainfo
     *
     * @param string $member_sinainfo
     * @return $this
     */
    public function setMemberSinainfo($member_sinainfo)
    {
        $this->member_sinainfo = $member_sinainfo;

        return $this;
    }

    /**
     * Method to set the value of field weixin_unionid
     *
     * @param string $weixin_unionid
     * @return $this
     */
    public function setWeixinUnionid($weixin_unionid)
    {
        $this->weixin_unionid = $weixin_unionid;

        return $this;
    }

    /**
     * Method to set the value of field weixin_info
     *
     * @param string $weixin_info
     * @return $this
     */
    public function setWeixinInfo($weixin_info)
    {
        $this->weixin_info = $weixin_info;

        return $this;
    }

    /**
     * Method to set the value of field available_predeposit
     *
     * @param double $available_predeposit
     * @return $this
     */
    public function setAvailablePredeposit($available_predeposit)
    {
        $this->available_predeposit = $available_predeposit;

        return $this;
    }

    /**
     * Method to set the value of field freeze_predeposit
     *
     * @param double $freeze_predeposit
     * @return $this
     */
    public function setFreezePredeposit($freeze_predeposit)
    {
        $this->freeze_predeposit = $freeze_predeposit;

        return $this;
    }

    /**
     * Method to set the value of field available_rc_balance
     *
     * @param double $available_rc_balance
     * @return $this
     */
    public function setAvailableRcBalance($available_rc_balance)
    {
        $this->available_rc_balance = $available_rc_balance;

        return $this;
    }

    /**
     * Method to set the value of field freeze_rc_balance
     *
     * @param double $freeze_rc_balance
     * @return $this
     */
    public function setFreezeRcBalance($freeze_rc_balance)
    {
        $this->freeze_rc_balance = $freeze_rc_balance;

        return $this;
    }

    /**
     * Method to set the value of field inform_allow
     *
     * @param integer $inform_allow
     * @return $this
     */
    public function setInformAllow($inform_allow)
    {
        $this->inform_allow = $inform_allow;

        return $this;
    }

    /**
     * Method to set the value of field is_buy
     *
     * @param integer $is_buy
     * @return $this
     */
    public function setIsBuy($is_buy)
    {
        $this->is_buy = $is_buy;

        return $this;
    }

    /**
     * Method to set the value of field is_allowtalk
     *
     * @param integer $is_allowtalk
     * @return $this
     */
    public function setIsAllowtalk($is_allowtalk)
    {
        $this->is_allowtalk = $is_allowtalk;

        return $this;
    }

    /**
     * Method to set the value of field member_state
     *
     * @param integer $member_state
     * @return $this
     */
    public function setMemberState($member_state)
    {
        $this->member_state = $member_state;

        return $this;
    }

    /**
     * Method to set the value of field member_snsvisitnum
     *
     * @param integer $member_snsvisitnum
     * @return $this
     */
    public function setMemberSnsvisitnum($member_snsvisitnum)
    {
        $this->member_snsvisitnum = $member_snsvisitnum;

        return $this;
    }

    /**
     * Method to set the value of field member_areaid
     *
     * @param integer $member_areaid
     * @return $this
     */
    public function setMemberAreaid($member_areaid)
    {
        $this->member_areaid = $member_areaid;

        return $this;
    }

    /**
     * Method to set the value of field member_cityid
     *
     * @param integer $member_cityid
     * @return $this
     */
    public function setMemberCityid($member_cityid)
    {
        $this->member_cityid = $member_cityid;

        return $this;
    }

    /**
     * Method to set the value of field member_provinceid
     *
     * @param integer $member_provinceid
     * @return $this
     */
    public function setMemberProvinceid($member_provinceid)
    {
        $this->member_provinceid = $member_provinceid;

        return $this;
    }

    /**
     * Method to set the value of field member_areainfo
     *
     * @param string $member_areainfo
     * @return $this
     */
    public function setMemberAreainfo($member_areainfo)
    {
        $this->member_areainfo = $member_areainfo;

        return $this;
    }

    /**
     * Method to set the value of field member_privacy
     *
     * @param string $member_privacy
     * @return $this
     */
    public function setMemberPrivacy($member_privacy)
    {
        $this->member_privacy = $member_privacy;

        return $this;
    }

    /**
     * Method to set the value of field member_exppoints
     *
     * @param integer $member_exppoints
     * @return $this
     */
    public function setMemberExppoints($member_exppoints)
    {
        $this->member_exppoints = $member_exppoints;

        return $this;
    }

    /**
     * Method to set the value of field invite_one
     *
     * @param integer $invite_one
     * @return $this
     */
    public function setInviteOne($invite_one)
    {
        $this->invite_one = $invite_one;

        return $this;
    }

    /**
     * Method to set the value of field invite_two
     *
     * @param integer $invite_two
     * @return $this
     */
    public function setInviteTwo($invite_two)
    {
        $this->invite_two = $invite_two;

        return $this;
    }

    /**
     * Method to set the value of field invite_three
     *
     * @param integer $invite_three
     * @return $this
     */
    public function setInviteThree($invite_three)
    {
        $this->invite_three = $invite_three;

        return $this;
    }

    /**
     * Method to set the value of field inviter_id
     *
     * @param integer $inviter_id
     * @return $this
     */
    public function setInviterId($inviter_id)
    {
        $this->inviter_id = $inviter_id;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_id
     *
     * @param integer $member_tree_id
     * @return $this
     */
    public function setMemberTreeId($member_tree_id)
    {
        $this->member_tree_id = $member_tree_id;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_row
     *
     * @param integer $member_tree_row
     * @return $this
     */
    public function setMemberTreeRow($member_tree_row)
    {
        $this->member_tree_row = $member_tree_row;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_column
     *
     * @param integer $member_tree_column
     * @return $this
     */
    public function setMemberTreeColumn($member_tree_column)
    {
        $this->member_tree_column = $member_tree_column;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_left_invite_count
     *
     * @param integer $member_tree_left_invite_count
     * @return $this
     */
    public function setMemberTreeLeftInviteCount($member_tree_left_invite_count)
    {
        $this->member_tree_left_invite_count = $member_tree_left_invite_count;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_right_invite_count
     *
     * @param integer $member_tree_right_invite_count
     * @return $this
     */
    public function setMemberTreeRightInviteCount($member_tree_right_invite_count)
    {
        $this->member_tree_right_invite_count = $member_tree_right_invite_count;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_id
     *
     * @param integer $store_tree_id
     * @return $this
     */
    public function setStoreTreeId($store_tree_id)
    {
        $this->store_tree_id = $store_tree_id;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_row
     *
     * @param integer $store_tree_row
     * @return $this
     */
    public function setStoreTreeRow($store_tree_row)
    {
        $this->store_tree_row = $store_tree_row;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_column
     *
     * @param integer $store_tree_column
     * @return $this
     */
    public function setStoreTreeColumn($store_tree_column)
    {
        $this->store_tree_column = $store_tree_column;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_left_invite_count
     *
     * @param integer $store_tree_left_invite_count
     * @return $this
     */
    public function setStoreTreeLeftInviteCount($store_tree_left_invite_count)
    {
        $this->store_tree_left_invite_count = $store_tree_left_invite_count;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_right_invite_count
     *
     * @param integer $store_tree_right_invite_count
     * @return $this
     */
    public function setStoreTreeRightInviteCount($store_tree_right_invite_count)
    {
        $this->store_tree_right_invite_count = $store_tree_right_invite_count;

        return $this;
    }

    /**
     * Method to set the value of field member_points
     *
     * @param integer $member_points
     * @return $this
     */
    public function setMemberPoints($member_points)
    {
        $this->member_points = $member_points;

        return $this;
    }

    /**
     * Method to set the value of field member_self_used_points_sum
     *
     * @param integer $member_self_used_points_sum
     * @return $this
     */
    public function setMemberSelfUsedPointsSum($member_self_used_points_sum)
    {
        $this->member_self_used_points_sum = $member_self_used_points_sum;

        return $this;
    }

    /**
     * Method to set the value of field member_left_used_points_sum
     *
     * @param integer $member_left_used_points_sum
     * @return $this
     */
    public function setMemberLeftUsedPointsSum($member_left_used_points_sum)
    {
        $this->member_left_used_points_sum = $member_left_used_points_sum;

        return $this;
    }

    /**
     * Method to set the value of field member_right_used_points_sum
     *
     * @param integer $member_right_used_points_sum
     * @return $this
     */
    public function setMemberRightUsedPointsSum($member_right_used_points_sum)
    {
        $this->member_right_used_points_sum = $member_right_used_points_sum;

        return $this;
    }

    /**
     * Method to set the value of field member_collision_sum_times
     *
     * @param integer $member_collision_sum_times
     * @return $this
     */
    public function setMemberCollisionSumTimes($member_collision_sum_times)
    {
        $this->member_collision_sum_times = $member_collision_sum_times;

        return $this;
    }

    /**
     * Method to set the value of field member_collision_sum_money
     *
     * @param double $member_collision_sum_money
     * @return $this
     */
    public function setMemberCollisionSumMoney($member_collision_sum_money)
    {
        $this->member_collision_sum_money = $member_collision_sum_money;

        return $this;
    }

    /**
     * Method to set the value of field store_points
     *
     * @param integer $store_points
     * @return $this
     */
    public function setStorePoints($store_points)
    {
        $this->store_points = $store_points;

        return $this;
    }

    /**
     * Method to set the value of field store_self_used_points_sum
     *
     * @param integer $store_self_used_points_sum
     * @return $this
     */
    public function setStoreSelfUsedPointsSum($store_self_used_points_sum)
    {
        $this->store_self_used_points_sum = $store_self_used_points_sum;

        return $this;
    }

    /**
     * Method to set the value of field store_left_used_points_sum
     *
     * @param integer $store_left_used_points_sum
     * @return $this
     */
    public function setStoreLeftUsedPointsSum($store_left_used_points_sum)
    {
        $this->store_left_used_points_sum = $store_left_used_points_sum;

        return $this;
    }

    /**
     * Method to set the value of field store_right_used_points_sum
     *
     * @param integer $store_right_used_points_sum
     * @return $this
     */
    public function setStoreRightUsedPointsSum($store_right_used_points_sum)
    {
        $this->store_right_used_points_sum = $store_right_used_points_sum;

        return $this;
    }

    /**
     * Method to set the value of field store_collision_sum_times
     *
     * @param integer $store_collision_sum_times
     * @return $this
     */
    public function setStoreCollisionSumTimes($store_collision_sum_times)
    {
        $this->store_collision_sum_times = $store_collision_sum_times;

        return $this;
    }

    /**
     * Method to set the value of field store_collision_sum_money
     *
     * @param double $store_collision_sum_money
     * @return $this
     */
    public function setStoreCollisionSumMoney($store_collision_sum_money)
    {
        $this->store_collision_sum_money = $store_collision_sum_money;

        return $this;
    }

    /**
     * Method to set the value of field member_type_id
     *
     * @param integer $member_type_id
     * @return $this
     */
    public function setMemberTypeId($member_type_id)
    {
        $this->member_type_id = $member_type_id;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_level
     *
     * @param integer $member_tree_level
     * @return $this
     */
    public function setMemberTreeLevel($member_tree_level)
    {
        $this->member_tree_level = $member_tree_level;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_final_level
     *
     * @param integer $member_tree_final_level
     * @return $this
     */
    public function setMemberTreeFinalLevel($member_tree_final_level)
    {
        $this->member_tree_final_level = $member_tree_final_level;

        return $this;
    }

    /**
     * Method to set the value of field store_tree_final_level
     *
     * @param integer $store_tree_final_level
     * @return $this
     */
    public function setStoreTreeFinalLevel($store_tree_final_level)
    {
        $this->store_tree_final_level = $store_tree_final_level;

        return $this;
    }

    /**
     * Method to set the value of field upgrade_time
     *
     * @param integer $upgrade_time
     * @return $this
     */
    public function setUpgradeTime($upgrade_time)
    {
        $this->upgrade_time = $upgrade_time;

        return $this;
    }

    /**
     * Method to set the value of field member_commission_money_sum
     *
     * @param double $member_commission_money_sum
     * @return $this
     */
    public function setMemberCommissionMoneySum($member_commission_money_sum)
    {
        $this->member_commission_money_sum = $member_commission_money_sum;

        return $this;
    }

    /**
     * Method to set the value of field store_commission_money_sum
     *
     * @param double $store_commission_money_sum
     * @return $this
     */
    public function setStoreCommissionMoneySum($store_commission_money_sum)
    {
        $this->store_commission_money_sum = $store_commission_money_sum;

        return $this;
    }

    /**
     * Method to set the value of field member_straight_money_sum
     *
     * @param double $member_straight_money_sum
     * @return $this
     */
    public function setMemberStraightMoneySum($member_straight_money_sum)
    {
        $this->member_straight_money_sum = $member_straight_money_sum;

        return $this;
    }

    /**
     * Method to set the value of field store_straight_money_sum
     *
     * @param double $store_straight_money_sum
     * @return $this
     */
    public function setStoreStraightMoneySum($store_straight_money_sum)
    {
        $this->store_straight_money_sum = $store_straight_money_sum;

        return $this;
    }

    /**
     * Method to set the value of field store_share_benefits_money_sum
     *
     * @param double $store_share_benefits_money_sum
     * @return $this
     */
    public function setStoreShareBenefitsMoneySum($store_share_benefits_money_sum)
    {
        $this->store_share_benefits_money_sum = $store_share_benefits_money_sum;

        return $this;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field member_truename
     *
     * @return string
     */
    public function getMemberTruename()
    {
        return $this->member_truename;
    }

    /**
     * Returns the value of field member_avatar
     *
     * @return string
     */
    public function getMemberAvatar()
    {
        return $this->member_avatar;
    }

    /**
     * Returns the value of field member_sex
     *
     * @return integer
     */
    public function getMemberSex()
    {
        return $this->member_sex;
    }

    /**
     * Returns the value of field member_birthday
     *
     * @return string
     */
    public function getMemberBirthday()
    {
        return $this->member_birthday;
    }

    /**
     * Returns the value of field member_passwd
     *
     * @return string
     */
    public function getMemberPasswd()
    {
        return $this->member_passwd;
    }

    /**
     * Returns the value of field member_paypwd
     *
     * @return string
     */
    public function getMemberPaypwd()
    {
        return $this->member_paypwd;
    }

    /**
     * Returns the value of field member_email
     *
     * @return string
     */
    public function getMemberEmail()
    {
        return $this->member_email;
    }

    /**
     * Returns the value of field member_email_bind
     *
     * @return integer
     */
    public function getMemberEmailBind()
    {
        return $this->member_email_bind;
    }

    /**
     * Returns the value of field member_mobile
     *
     * @return string
     */
    public function getMemberMobile()
    {
        return $this->member_mobile;
    }

    /**
     * Returns the value of field member_mobile_bind
     *
     * @return integer
     */
    public function getMemberMobileBind()
    {
        return $this->member_mobile_bind;
    }

    /**
     * Returns the value of field member_qq
     *
     * @return string
     */
    public function getMemberQq()
    {
        return $this->member_qq;
    }

    /**
     * Returns the value of field member_ww
     *
     * @return string
     */
    public function getMemberWw()
    {
        return $this->member_ww;
    }

    /**
     * Returns the value of field member_login_num
     *
     * @return integer
     */
    public function getMemberLoginNum()
    {
        return $this->member_login_num;
    }

    /**
     * Returns the value of field member_time
     *
     * @return string
     */
    public function getMemberTime()
    {
        return $this->member_time;
    }

    /**
     * Returns the value of field member_login_time
     *
     * @return string
     */
    public function getMemberLoginTime()
    {
        return $this->member_login_time;
    }

    /**
     * Returns the value of field member_old_login_time
     *
     * @return string
     */
    public function getMemberOldLoginTime()
    {
        return $this->member_old_login_time;
    }

    /**
     * Returns the value of field member_login_ip
     *
     * @return string
     */
    public function getMemberLoginIp()
    {
        return $this->member_login_ip;
    }

    /**
     * Returns the value of field member_old_login_ip
     *
     * @return string
     */
    public function getMemberOldLoginIp()
    {
        return $this->member_old_login_ip;
    }

    /**
     * Returns the value of field member_qqopenid
     *
     * @return string
     */
    public function getMemberQqopenid()
    {
        return $this->member_qqopenid;
    }

    /**
     * Returns the value of field member_qqinfo
     *
     * @return string
     */
    public function getMemberQqinfo()
    {
        return $this->member_qqinfo;
    }

    /**
     * Returns the value of field member_sinaopenid
     *
     * @return string
     */
    public function getMemberSinaopenid()
    {
        return $this->member_sinaopenid;
    }

    /**
     * Returns the value of field member_sinainfo
     *
     * @return string
     */
    public function getMemberSinainfo()
    {
        return $this->member_sinainfo;
    }

    /**
     * Returns the value of field weixin_unionid
     *
     * @return string
     */
    public function getWeixinUnionid()
    {
        return $this->weixin_unionid;
    }

    /**
     * Returns the value of field weixin_info
     *
     * @return string
     */
    public function getWeixinInfo()
    {
        return $this->weixin_info;
    }

    /**
     * Returns the value of field available_predeposit
     *
     * @return double
     */
    public function getAvailablePredeposit()
    {
        return $this->available_predeposit;
    }

    /**
     * Returns the value of field freeze_predeposit
     *
     * @return double
     */
    public function getFreezePredeposit()
    {
        return $this->freeze_predeposit;
    }

    /**
     * Returns the value of field available_rc_balance
     *
     * @return double
     */
    public function getAvailableRcBalance()
    {
        return $this->available_rc_balance;
    }

    /**
     * Returns the value of field freeze_rc_balance
     *
     * @return double
     */
    public function getFreezeRcBalance()
    {
        return $this->freeze_rc_balance;
    }

    /**
     * Returns the value of field inform_allow
     *
     * @return integer
     */
    public function getInformAllow()
    {
        return $this->inform_allow;
    }

    /**
     * Returns the value of field is_buy
     *
     * @return integer
     */
    public function getIsBuy()
    {
        return $this->is_buy;
    }

    /**
     * Returns the value of field is_allowtalk
     *
     * @return integer
     */
    public function getIsAllowtalk()
    {
        return $this->is_allowtalk;
    }

    /**
     * Returns the value of field member_state
     *
     * @return integer
     */
    public function getMemberState()
    {
        return $this->member_state;
    }

    /**
     * Returns the value of field member_snsvisitnum
     *
     * @return integer
     */
    public function getMemberSnsvisitnum()
    {
        return $this->member_snsvisitnum;
    }

    /**
     * Returns the value of field member_areaid
     *
     * @return integer
     */
    public function getMemberAreaid()
    {
        return $this->member_areaid;
    }

    /**
     * Returns the value of field member_cityid
     *
     * @return integer
     */
    public function getMemberCityid()
    {
        return $this->member_cityid;
    }

    /**
     * Returns the value of field member_provinceid
     *
     * @return integer
     */
    public function getMemberProvinceid()
    {
        return $this->member_provinceid;
    }

    /**
     * Returns the value of field member_areainfo
     *
     * @return string
     */
    public function getMemberAreainfo()
    {
        return $this->member_areainfo;
    }

    /**
     * Returns the value of field member_privacy
     *
     * @return string
     */
    public function getMemberPrivacy()
    {
        return $this->member_privacy;
    }

    /**
     * Returns the value of field member_exppoints
     *
     * @return integer
     */
    public function getMemberExppoints()
    {
        return $this->member_exppoints;
    }

    /**
     * Returns the value of field invite_one
     *
     * @return integer
     */
    public function getInviteOne()
    {
        return $this->invite_one;
    }

    /**
     * Returns the value of field invite_two
     *
     * @return integer
     */
    public function getInviteTwo()
    {
        return $this->invite_two;
    }

    /**
     * Returns the value of field invite_three
     *
     * @return integer
     */
    public function getInviteThree()
    {
        return $this->invite_three;
    }

    /**
     * Returns the value of field inviter_id
     *
     * @return integer
     */
    public function getInviterId()
    {
        return $this->inviter_id;
    }

    /**
     * Returns the value of field member_tree_id
     *
     * @return integer
     */
    public function getMemberTreeId()
    {
        return $this->member_tree_id;
    }

    /**
     * Returns the value of field member_tree_row
     *
     * @return integer
     */
    public function getMemberTreeRow()
    {
        return $this->member_tree_row;
    }

    /**
     * Returns the value of field member_tree_column
     *
     * @return integer
     */
    public function getMemberTreeColumn()
    {
        return $this->member_tree_column;
    }

    /**
     * Returns the value of field member_tree_left_invite_count
     *
     * @return integer
     */
    public function getMemberTreeLeftInviteCount()
    {
        return $this->member_tree_left_invite_count;
    }

    /**
     * Returns the value of field member_tree_right_invite_count
     *
     * @return integer
     */
    public function getMemberTreeRightInviteCount()
    {
        return $this->member_tree_right_invite_count;
    }

    /**
     * Returns the value of field store_tree_id
     *
     * @return integer
     */
    public function getStoreTreeId()
    {
        return $this->store_tree_id;
    }

    /**
     * Returns the value of field store_tree_row
     *
     * @return integer
     */
    public function getStoreTreeRow()
    {
        return $this->store_tree_row;
    }

    /**
     * Returns the value of field store_tree_column
     *
     * @return integer
     */
    public function getStoreTreeColumn()
    {
        return $this->store_tree_column;
    }

    /**
     * Returns the value of field store_tree_left_invite_count
     *
     * @return integer
     */
    public function getStoreTreeLeftInviteCount()
    {
        return $this->store_tree_left_invite_count;
    }

    /**
     * Returns the value of field store_tree_right_invite_count
     *
     * @return integer
     */
    public function getStoreTreeRightInviteCount()
    {
        return $this->store_tree_right_invite_count;
    }

    /**
     * Returns the value of field member_points
     *
     * @return integer
     */
    public function getMemberPoints()
    {
        return $this->member_points;
    }

    /**
     * Returns the value of field member_self_used_points_sum
     *
     * @return integer
     */
    public function getMemberSelfUsedPointsSum()
    {
        return $this->member_self_used_points_sum;
    }

    /**
     * Returns the value of field member_left_used_points_sum
     *
     * @return integer
     */
    public function getMemberLeftUsedPointsSum()
    {
        return $this->member_left_used_points_sum;
    }

    /**
     * Returns the value of field member_right_used_points_sum
     *
     * @return integer
     */
    public function getMemberRightUsedPointsSum()
    {
        return $this->member_right_used_points_sum;
    }

    /**
     * Returns the value of field member_collision_sum_times
     *
     * @return integer
     */
    public function getMemberCollisionSumTimes()
    {
        return $this->member_collision_sum_times;
    }

    /**
     * Returns the value of field member_collision_sum_money
     *
     * @return double
     */
    public function getMemberCollisionSumMoney()
    {
        return $this->member_collision_sum_money;
    }

    /**
     * Returns the value of field store_points
     *
     * @return integer
     */
    public function getStorePoints()
    {
        return $this->store_points;
    }

    /**
     * Returns the value of field store_self_used_points_sum
     *
     * @return integer
     */
    public function getStoreSelfUsedPointsSum()
    {
        return $this->store_self_used_points_sum;
    }

    /**
     * Returns the value of field store_left_used_points_sum
     *
     * @return integer
     */
    public function getStoreLeftUsedPointsSum()
    {
        return $this->store_left_used_points_sum;
    }

    /**
     * Returns the value of field store_right_used_points_sum
     *
     * @return integer
     */
    public function getStoreRightUsedPointsSum()
    {
        return $this->store_right_used_points_sum;
    }

    /**
     * Returns the value of field store_collision_sum_times
     *
     * @return integer
     */
    public function getStoreCollisionSumTimes()
    {
        return $this->store_collision_sum_times;
    }

    /**
     * Returns the value of field store_collision_sum_money
     *
     * @return double
     */
    public function getStoreCollisionSumMoney()
    {
        return $this->store_collision_sum_money;
    }

    /**
     * Returns the value of field member_type_id
     *
     * @return integer
     */
    public function getMemberTypeId()
    {
        return $this->member_type_id;
    }

    /**
     * Returns the value of field member_tree_level
     *
     * @return integer
     */
    public function getMemberTreeLevel()
    {
        return $this->member_tree_level;
    }

    /**
     * Returns the value of field member_tree_final_level
     *
     * @return integer
     */
    public function getMemberTreeFinalLevel()
    {
        return $this->member_tree_final_level;
    }

    /**
     * Returns the value of field store_tree_final_level
     *
     * @return integer
     */
    public function getStoreTreeFinalLevel()
    {
        return $this->store_tree_final_level;
    }

    /**
     * Returns the value of field upgrade_time
     *
     * @return integer
     */
    public function getUpgradeTime()
    {
        return $this->upgrade_time;
    }

    /**
     * Returns the value of field member_commission_money_sum
     *
     * @return double
     */
    public function getMemberCommissionMoneySum()
    {
        return $this->member_commission_money_sum;
    }

    /**
     * Returns the value of field store_commission_money_sum
     *
     * @return double
     */
    public function getStoreCommissionMoneySum()
    {
        return $this->store_commission_money_sum;
    }

    /**
     * Returns the value of field member_straight_money_sum
     *
     * @return double
     */
    public function getMemberStraightMoneySum()
    {
        return $this->member_straight_money_sum;
    }

    /**
     * Returns the value of field store_straight_money_sum
     *
     * @return double
     */
    public function getStoreStraightMoneySum()
    {
        return $this->store_straight_money_sum;
    }

    /**
     * Returns the value of field store_share_benefits_money_sum
     *
     * @return double
     */
    public function getStoreShareBenefitsMoneySum()
    {
        return $this->store_share_benefits_money_sum;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Member[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Member
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
