<?php

namespace Ypk\Models;

class OrderPay extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $pay_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $pay_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $buyer_id;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $api_pay_state;

    /**
     * Method to set the value of field pay_id
     *
     * @param integer $pay_id
     * @return $this
     */
    public function setPayId($pay_id)
    {
        $this->pay_id = $pay_id;

        return $this;
    }

    /**
     * Method to set the value of field pay_sn
     *
     * @param string $pay_sn
     * @return $this
     */
    public function setPaySn($pay_sn)
    {
        $this->pay_sn = $pay_sn;

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
     * Method to set the value of field api_pay_state
     *
     * @param string $api_pay_state
     * @return $this
     */
    public function setApiPayState($api_pay_state)
    {
        $this->api_pay_state = $api_pay_state;

        return $this;
    }

    /**
     * Returns the value of field pay_id
     *
     * @return integer
     */
    public function getPayId()
    {
        return $this->pay_id;
    }

    /**
     * Returns the value of field pay_sn
     *
     * @return string
     */
    public function getPaySn()
    {
        return $this->pay_sn;
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
     * Returns the value of field api_pay_state
     *
     * @return string
     */
    public function getApiPayState()
    {
        return $this->api_pay_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'order_pay';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderPay[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderPay
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
