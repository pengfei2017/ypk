<?php

namespace Ypk\Models;

class MemberCommissionLog extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_id;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $member_tree_commission_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_commission_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_tree_id;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_tree_commission_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_commission_level;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $commission_tree_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $collision_member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $collision_times;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $collision_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $order_id;

    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * @param int $order_id
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }

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
     * Method to set the value of field member_tree_commission_money
     *
     * @param double $member_tree_commission_money
     * @return $this
     */
    public function setMemberTreeCommissionMoney($member_tree_commission_money)
    {
        $this->member_tree_commission_money = $member_tree_commission_money;

        return $this;
    }

    /**
     * Method to set the value of field member_commission_level
     *
     * @param integer $member_commission_level
     * @return $this
     */
    public function setMemberCommissionLevel($member_commission_level)
    {
        $this->member_commission_level = $member_commission_level;

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
     * Method to set the value of field store_tree_commission_money
     *
     * @param double $store_tree_commission_money
     * @return $this
     */
    public function setStoreTreeCommissionMoney($store_tree_commission_money)
    {
        $this->store_tree_commission_money = $store_tree_commission_money;

        return $this;
    }

    /**
     * Method to set the value of field store_commission_level
     *
     * @param integer $store_commission_level
     * @return $this
     */
    public function setStoreCommissionLevel($store_commission_level)
    {
        $this->store_commission_level = $store_commission_level;

        return $this;
    }

    /**
     * Method to set the value of field commission_tree_type
     *
     * @param integer $commission_tree_type
     * @return $this
     */
    public function setCommissionTreeType($commission_tree_type)
    {
        $this->commission_tree_type = $commission_tree_type;

        return $this;
    }

    /**
     * Method to set the value of field collision_member_id
     *
     * @param integer $collision_member_id
     * @return $this
     */
    public function setCollisionMemberId($collision_member_id)
    {
        $this->collision_member_id = $collision_member_id;

        return $this;
    }

    /**
     * Method to set the value of field collision_times
     *
     * @param integer $collision_times
     * @return $this
     */
    public function setCollisionTimes($collision_times)
    {
        $this->collision_times = $collision_times;

        return $this;
    }

    /**
     * Method to set the value of field collision_money
     *
     * @param double $collision_money
     * @return $this
     */
    public function setCollisionMoney($collision_money)
    {
        $this->collision_money = $collision_money;

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
     * Returns the value of field member_tree_id
     *
     * @return integer
     */
    public function getMemberTreeId()
    {
        return $this->member_tree_id;
    }

    /**
     * Returns the value of field member_tree_commission_money
     *
     * @return double
     */
    public function getMemberTreeCommissionMoney()
    {
        return $this->member_tree_commission_money;
    }

    /**
     * Returns the value of field member_commission_level
     *
     * @return integer
     */
    public function getMemberCommissionLevel()
    {
        return $this->member_commission_level;
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
     * Returns the value of field store_tree_commission_money
     *
     * @return double
     */
    public function getStoreTreeCommissionMoney()
    {
        return $this->store_tree_commission_money;
    }

    /**
     * Returns the value of field store_commission_level
     *
     * @return integer
     */
    public function getStoreCommissionLevel()
    {
        return $this->store_commission_level;
    }

    /**
     * Returns the value of field commission_tree_type
     *
     * @return integer
     */
    public function getCommissionTreeType()
    {
        return $this->commission_tree_type;
    }

    /**
     * Returns the value of field collision_member_id
     *
     * @return integer
     */
    public function getCollisionMemberId()
    {
        return $this->collision_member_id;
    }

    /**
     * Returns the value of field collision_times
     *
     * @return integer
     */
    public function getCollisionTimes()
    {
        return $this->collision_times;
    }

    /**
     * Returns the value of field collision_money
     *
     * @return double
     */
    public function getCollisionMoney()
    {
        return $this->collision_money;
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
        return 'member_commission_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberCommissionLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberCommissionLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
