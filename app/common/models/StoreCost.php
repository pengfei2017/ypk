<?php

namespace Ypk\Models;

class StoreCost extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cost_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cost_store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cost_seller_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cost_price;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $cost_remark;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $cost_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $cost_time;

    /**
     * Method to set the value of field cost_id
     *
     * @param integer $cost_id
     * @return $this
     */
    public function setCostId($cost_id)
    {
        $this->cost_id = $cost_id;

        return $this;
    }

    /**
     * Method to set the value of field cost_store_id
     *
     * @param integer $cost_store_id
     * @return $this
     */
    public function setCostStoreId($cost_store_id)
    {
        $this->cost_store_id = $cost_store_id;

        return $this;
    }

    /**
     * Method to set the value of field cost_seller_id
     *
     * @param integer $cost_seller_id
     * @return $this
     */
    public function setCostSellerId($cost_seller_id)
    {
        $this->cost_seller_id = $cost_seller_id;

        return $this;
    }

    /**
     * Method to set the value of field cost_price
     *
     * @param integer $cost_price
     * @return $this
     */
    public function setCostPrice($cost_price)
    {
        $this->cost_price = $cost_price;

        return $this;
    }

    /**
     * Method to set the value of field cost_remark
     *
     * @param string $cost_remark
     * @return $this
     */
    public function setCostRemark($cost_remark)
    {
        $this->cost_remark = $cost_remark;

        return $this;
    }

    /**
     * Method to set the value of field cost_state
     *
     * @param integer $cost_state
     * @return $this
     */
    public function setCostState($cost_state)
    {
        $this->cost_state = $cost_state;

        return $this;
    }

    /**
     * Method to set the value of field cost_time
     *
     * @param integer $cost_time
     * @return $this
     */
    public function setCostTime($cost_time)
    {
        $this->cost_time = $cost_time;

        return $this;
    }

    /**
     * Returns the value of field cost_id
     *
     * @return integer
     */
    public function getCostId()
    {
        return $this->cost_id;
    }

    /**
     * Returns the value of field cost_store_id
     *
     * @return integer
     */
    public function getCostStoreId()
    {
        return $this->cost_store_id;
    }

    /**
     * Returns the value of field cost_seller_id
     *
     * @return integer
     */
    public function getCostSellerId()
    {
        return $this->cost_seller_id;
    }

    /**
     * Returns the value of field cost_price
     *
     * @return integer
     */
    public function getCostPrice()
    {
        return $this->cost_price;
    }

    /**
     * Returns the value of field cost_remark
     *
     * @return string
     */
    public function getCostRemark()
    {
        return $this->cost_remark;
    }

    /**
     * Returns the value of field cost_state
     *
     * @return integer
     */
    public function getCostState()
    {
        return $this->cost_state;
    }

    /**
     * Returns the value of field cost_time
     *
     * @return integer
     */
    public function getCostTime()
    {
        return $this->cost_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_cost';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreCost[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreCost
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
