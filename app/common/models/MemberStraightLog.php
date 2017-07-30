<?php

namespace Ypk\Models;

class MemberStraightLog extends \Phalcon\Mvc\Model
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
    protected $buyer_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $buyer_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $buy_money;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $member_straight_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $seller_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $seller_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $sale_money;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $store_straight_money;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $member_tree_type;

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
     * Method to set the value of field buyer_id
     *
     * @param integer $buyer_id
     * @return $this
     */
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;

        return $this;
    }

    /**
     * Method to set the value of field buyer_name
     *
     * @param string $buyer_name
     * @return $this
     */
    public function setBuyerName($buyer_name)
    {
        $this->buyer_name = $buyer_name;

        return $this;
    }

    /**
     * Method to set the value of field buy_money
     *
     * @param double $buy_money
     * @return $this
     */
    public function setBuyMoney($buy_money)
    {
        $this->buy_money = $buy_money;

        return $this;
    }

    /**
     * Method to set the value of field member_straight_money
     *
     * @param double $member_straight_money
     * @return $this
     */
    public function setMemberStraightMoney($member_straight_money)
    {
        $this->member_straight_money = $member_straight_money;

        return $this;
    }

    /**
     * Method to set the value of field seller_id
     *
     * @param integer $seller_id
     * @return $this
     */
    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;

        return $this;
    }

    /**
     * Method to set the value of field seller_name
     *
     * @param string $seller_name
     * @return $this
     */
    public function setSellerName($seller_name)
    {
        $this->seller_name = $seller_name;

        return $this;
    }

    /**
     * Method to set the value of field sale_money
     *
     * @param double $sale_money
     * @return $this
     */
    public function setSaleMoney($sale_money)
    {
        $this->sale_money = $sale_money;

        return $this;
    }

    /**
     * Method to set the value of field store_straight_money
     *
     * @param double $store_straight_money
     * @return $this
     */
    public function setStoreStraightMoney($store_straight_money)
    {
        $this->store_straight_money = $store_straight_money;

        return $this;
    }

    /**
     * Method to set the value of field member_tree_type
     *
     * @param integer $member_tree_type
     * @return $this
     */
    public function setMemberTreeType($member_tree_type)
    {
        $this->member_tree_type = $member_tree_type;

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
     * Returns the value of field buyer_id
     *
     * @return integer
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * Returns the value of field buyer_name
     *
     * @return string
     */
    public function getBuyerName()
    {
        return $this->buyer_name;
    }

    /**
     * Returns the value of field buy_money
     *
     * @return double
     */
    public function getBuyMoney()
    {
        return $this->buy_money;
    }

    /**
     * Returns the value of field member_straight_money
     *
     * @return double
     */
    public function getMemberStraightMoney()
    {
        return $this->member_straight_money;
    }

    /**
     * Returns the value of field seller_id
     *
     * @return integer
     */
    public function getSellerId()
    {
        return $this->seller_id;
    }

    /**
     * Returns the value of field seller_name
     *
     * @return string
     */
    public function getSellerName()
    {
        return $this->seller_name;
    }

    /**
     * Returns the value of field sale_money
     *
     * @return double
     */
    public function getSaleMoney()
    {
        return $this->sale_money;
    }

    /**
     * Returns the value of field store_straight_money
     *
     * @return double
     */
    public function getStoreStraightMoney()
    {
        return $this->store_straight_money;
    }

    /**
     * Returns the value of field member_tree_type
     *
     * @return integer
     */
    public function getMemberTreeType()
    {
        return $this->member_tree_type;
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
        return 'member_straight_log';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberStraightLog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MemberStraightLog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
