<?php

namespace Ypk\Models;

class MemberPointsCollisionLog extends \Phalcon\Mvc\Model
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
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_self_used_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_left_used_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_right_used_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_collision_times;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $member_collision_money;

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
    protected $store_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_self_used_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_left_used_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_right_used_points;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $store_collision_times;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_collision_money;

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
    protected $collision_log_type;

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
     * Method to set the value of field member_self_used_points
     *
     * @param integer $member_self_used_points
     * @return $this
     */
    public function setMemberSelfUsedPoints($member_self_used_points)
    {
        $this->member_self_used_points = $member_self_used_points;

        return $this;
    }

    /**
     * Method to set the value of field member_left_used_points
     *
     * @param integer $member_left_used_points
     * @return $this
     */
    public function setMemberLeftUsedPoints($member_left_used_points)
    {
        $this->member_left_used_points = $member_left_used_points;

        return $this;
    }

    /**
     * Method to set the value of field member_right_used_points
     *
     * @param integer $member_right_used_points
     * @return $this
     */
    public function setMemberRightUsedPoints($member_right_used_points)
    {
        $this->member_right_used_points = $member_right_used_points;

        return $this;
    }

    /**
     * Method to set the value of field member_collision_times
     *
     * @param integer $member_collision_times
     * @return $this
     */
    public function setMemberCollisionTimes($member_collision_times)
    {
        $this->member_collision_times = $member_collision_times;

        return $this;
    }

    /**
     * Method to set the value of field member_collision_money
     *
     * @param double $member_collision_money
     * @return $this
     */
    public function setMemberCollisionMoney($member_collision_money)
    {
        $this->member_collision_money = $member_collision_money;

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
     * Method to set the value of field store_self_used_points
     *
     * @param integer $store_self_used_points
     * @return $this
     */
    public function setStoreSelfUsedPoints($store_self_used_points)
    {
        $this->store_self_used_points = $store_self_used_points;

        return $this;
    }

    /**
     * Method to set the value of field store_left_used_points
     *
     * @param integer $store_left_used_points
     * @return $this
     */
    public function setStoreLeftUsedPoints($store_left_used_points)
    {
        $this->store_left_used_points = $store_left_used_points;

        return $this;
    }

    /**
     * Method to set the value of field store_right_used_points
     *
     * @param integer $store_right_used_points
     * @return $this
     */
    public function setStoreRightUsedPoints($store_right_used_points)
    {
        $this->store_right_used_points = $store_right_used_points;

        return $this;
    }

    /**
     * Method to set the value of field store_collision_times
     *
     * @param integer $store_collision_times
     * @return $this
     */
    public function setStoreCollisionTimes($store_collision_times)
    {
        $this->store_collision_times = $store_collision_times;

        return $this;
    }

    /**
     * Method to set the value of field store_collision_money
     *
     * @param double $store_collision_money
     * @return $this
     */
    public function setStoreCollisionMoney($store_collision_money)
    {
        $this->store_collision_money = $store_collision_money;

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
     * Method to set the value of field collision_log_type
     *
     * @param integer $collision_log_type
     * @return $this
     */
    public function setCollisionLogType($collision_log_type)
    {
        $this->collision_log_type = $collision_log_type;

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
     * Returns the value of field member_points
     *
     * @return integer
     */
    public function getMemberPoints()
    {
        return $this->member_points;
    }

    /**
     * Returns the value of field member_self_used_points
     *
     * @return integer
     */
    public function getMemberSelfUsedPoints()
    {
        return $this->member_self_used_points;
    }

    /**
     * Returns the value of field member_left_used_points
     *
     * @return integer
     */
    public function getMemberLeftUsedPoints()
    {
        return $this->member_left_used_points;
    }

    /**
     * Returns the value of field member_right_used_points
     *
     * @return integer
     */
    public function getMemberRightUsedPoints()
    {
        return $this->member_right_used_points;
    }

    /**
     * Returns the value of field member_collision_times
     *
     * @return integer
     */
    public function getMemberCollisionTimes()
    {
        return $this->member_collision_times;
    }

    /**
     * Returns the value of field member_collision_money
     *
     * @return double
     */
    public function getMemberCollisionMoney()
    {
        return $this->member_collision_money;
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
     * Returns the value of field store_points
     *
     * @return integer
     */
    public function getStorePoints()
    {
        return $this->store_points;
    }

    /**
     * Returns the value of field store_self_used_points
     *
     * @return integer
     */
    public function getStoreSelfUsedPoints()
    {
        return $this->store_self_used_points;
    }

    /**
     * Returns the value of field store_left_used_points
     *
     * @return integer
     */
    public function getStoreLeftUsedPoints()
    {
        return $this->store_left_used_points;
    }

    /**
     * Returns the value of field store_right_used_points
     *
     * @return integer
     */
    public function getStoreRightUsedPoints()
    {
        return $this->store_right_used_points;
    }

    /**
     * Returns the value of field store_collision_times
     *
     * @return integer
     */
    public function getStoreCollisionTimes()
    {
        return $this->store_collision_times;
    }

    /**
     * Returns the value of field store_collision_money
     *
     * @return double
     */
    public function getStoreCollisionMoney()
    {
        return $this->store_collision_money;
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
     * Returns the value of field collision_log_type
     *
     * @return integer
     */
    public function getCollisionLogType()
    {
        return $this->collision_log_type;
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
        return 'member_points_collision_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberPointsCollisionLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberPointsCollisionLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
