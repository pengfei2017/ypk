<?php

namespace Ypk\Models;

class StoreExtend extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $express;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $pricerange;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $orderpricerange;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $bill_cycle;

    /**
     * Method to set the value of field store_id
     *
     * @param integer $store_id
     * @return $this
     */
    public function setStoreId($store_id)
    {
        $this->store_id = $store_id;

        return $this;
    }

    /**
     * Method to set the value of field express
     *
     * @param string $express
     * @return $this
     */
    public function setExpress($express)
    {
        $this->express = $express;

        return $this;
    }

    /**
     * Method to set the value of field pricerange
     *
     * @param string $pricerange
     * @return $this
     */
    public function setPricerange($pricerange)
    {
        $this->pricerange = $pricerange;

        return $this;
    }

    /**
     * Method to set the value of field orderpricerange
     *
     * @param string $orderpricerange
     * @return $this
     */
    public function setOrderpricerange($orderpricerange)
    {
        $this->orderpricerange = $orderpricerange;

        return $this;
    }

    /**
     * Method to set the value of field bill_cycle
     *
     * @param integer $bill_cycle
     * @return $this
     */
    public function setBillCycle($bill_cycle)
    {
        $this->bill_cycle = $bill_cycle;

        return $this;
    }

    /**
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field express
     *
     * @return string
     */
    public function getExpress()
    {
        return $this->express;
    }

    /**
     * Returns the value of field pricerange
     *
     * @return string
     */
    public function getPricerange()
    {
        return $this->pricerange;
    }

    /**
     * Returns the value of field orderpricerange
     *
     * @return string
     */
    public function getOrderpricerange()
    {
        return $this->orderpricerange;
    }

    /**
     * Returns the value of field bill_cycle
     *
     * @return integer
     */
    public function getBillCycle()
    {
        return $this->bill_cycle;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_extend';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreExtend[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreExtend
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
