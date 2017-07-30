<?php

namespace Ypk\Models;

class MemberRewardGiveoutLog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $member_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $month_total;

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
    protected $member_collision_sum_money;

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
    protected $store_share_benefits_money_sum;

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
    protected $store_collision_sum_money;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_commission_money_sum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;


    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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
     * Method to set the value of field month_total
     *
     * @param double $month_total
     * @return $this
     */
    public function setMonthTotal($month_total)
    {
        $this->month_total = $month_total;

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
     * Method to set the value of field add_time
     *
     * @param integer $add_time
     * @return $this
     */
    public function setAddTime($add_time)
    {
        $this->add_time = $add_time;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
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
     * Returns the value of field month_total
     *
     * @return double
     */
    public function getMonthTotal()
    {
        return $this->month_total;
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
     * Returns the value of field member_collision_sum_money
     *
     * @return double
     */
    public function getMemberCollisionSumMoney()
    {
        return $this->member_collision_sum_money;
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
     * Returns the value of field store_share_benefits_money_sum
     *
     * @return double
     */
    public function getStoreShareBenefitsMoneySum()
    {
        return $this->store_share_benefits_money_sum;
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
     * Returns the value of field store_collision_sum_money
     *
     * @return double
     */
    public function getStoreCollisionSumMoney()
    {
        return $this->store_collision_sum_money;
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
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'member_reward_giveout_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberRewardGiveoutLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberRewardGiveoutLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
