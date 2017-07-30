<?php

namespace Ypk\Models;

class StatOrder extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $order_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $order_add_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $payment_code;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $order_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $shipping_fee;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $evaluation_state;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $order_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $refund_state;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $refund_amount;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $order_from;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $order_isvalid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $reciver_province_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $grade_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $sc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $buyer_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $buyer_name;

    /**
     * Method to set the value of field order_id
     *
     * @param integer $order_id
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;

        return $this;
    }

    /**
     * Method to set the value of field order_sn
     *
     * @param string $order_sn
     * @return $this
     */
    public function setOrderSn($order_sn)
    {
        $this->order_sn = $order_sn;

        return $this;
    }

    /**
     * Method to set the value of field order_add_time
     *
     * @param integer $order_add_time
     * @return $this
     */
    public function setOrderAddTime($order_add_time)
    {
        $this->order_add_time = $order_add_time;

        return $this;
    }

    /**
     * Method to set the value of field payment_code
     *
     * @param string $payment_code
     * @return $this
     */
    public function setPaymentCode($payment_code)
    {
        $this->payment_code = $payment_code;

        return $this;
    }

    /**
     * Method to set the value of field order_amount
     *
     * @param double $order_amount
     * @return $this
     */
    public function setOrderAmount($order_amount)
    {
        $this->order_amount = $order_amount;

        return $this;
    }

    /**
     * Method to set the value of field shipping_fee
     *
     * @param double $shipping_fee
     * @return $this
     */
    public function setShippingFee($shipping_fee)
    {
        $this->shipping_fee = $shipping_fee;

        return $this;
    }

    /**
     * Method to set the value of field evaluation_state
     *
     * @param string $evaluation_state
     * @return $this
     */
    public function setEvaluationState($evaluation_state)
    {
        $this->evaluation_state = $evaluation_state;

        return $this;
    }

    /**
     * Method to set the value of field order_state
     *
     * @param string $order_state
     * @return $this
     */
    public function setOrderState($order_state)
    {
        $this->order_state = $order_state;

        return $this;
    }

    /**
     * Method to set the value of field refund_state
     *
     * @param integer $refund_state
     * @return $this
     */
    public function setRefundState($refund_state)
    {
        $this->refund_state = $refund_state;

        return $this;
    }

    /**
     * Method to set the value of field refund_amount
     *
     * @param double $refund_amount
     * @return $this
     */
    public function setRefundAmount($refund_amount)
    {
        $this->refund_amount = $refund_amount;

        return $this;
    }

    /**
     * Method to set the value of field order_from
     *
     * @param string $order_from
     * @return $this
     */
    public function setOrderFrom($order_from)
    {
        $this->order_from = $order_from;

        return $this;
    }

    /**
     * Method to set the value of field order_isvalid
     *
     * @param integer $order_isvalid
     * @return $this
     */
    public function setOrderIsvalid($order_isvalid)
    {
        $this->order_isvalid = $order_isvalid;

        return $this;
    }

    /**
     * Method to set the value of field reciver_province_id
     *
     * @param integer $reciver_province_id
     * @return $this
     */
    public function setReciverProvinceId($reciver_province_id)
    {
        $this->reciver_province_id = $reciver_province_id;

        return $this;
    }

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
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field grade_id
     *
     * @param integer $grade_id
     * @return $this
     */
    public function setGradeId($grade_id)
    {
        $this->grade_id = $grade_id;

        return $this;
    }

    /**
     * Method to set the value of field sc_id
     *
     * @param integer $sc_id
     * @return $this
     */
    public function setScId($sc_id)
    {
        $this->sc_id = $sc_id;

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
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
    }

    /**
     * Returns the value of field order_sn
     *
     * @return string
     */
    public function getOrderSn()
    {
        return $this->order_sn;
    }

    /**
     * Returns the value of field order_add_time
     *
     * @return integer
     */
    public function getOrderAddTime()
    {
        return $this->order_add_time;
    }

    /**
     * Returns the value of field payment_code
     *
     * @return string
     */
    public function getPaymentCode()
    {
        return $this->payment_code;
    }

    /**
     * Returns the value of field order_amount
     *
     * @return double
     */
    public function getOrderAmount()
    {
        return $this->order_amount;
    }

    /**
     * Returns the value of field shipping_fee
     *
     * @return double
     */
    public function getShippingFee()
    {
        return $this->shipping_fee;
    }

    /**
     * Returns the value of field evaluation_state
     *
     * @return string
     */
    public function getEvaluationState()
    {
        return $this->evaluation_state;
    }

    /**
     * Returns the value of field order_state
     *
     * @return string
     */
    public function getOrderState()
    {
        return $this->order_state;
    }

    /**
     * Returns the value of field refund_state
     *
     * @return integer
     */
    public function getRefundState()
    {
        return $this->refund_state;
    }

    /**
     * Returns the value of field refund_amount
     *
     * @return double
     */
    public function getRefundAmount()
    {
        return $this->refund_amount;
    }

    /**
     * Returns the value of field order_from
     *
     * @return string
     */
    public function getOrderFrom()
    {
        return $this->order_from;
    }

    /**
     * Returns the value of field order_isvalid
     *
     * @return integer
     */
    public function getOrderIsvalid()
    {
        return $this->order_isvalid;
    }

    /**
     * Returns the value of field reciver_province_id
     *
     * @return integer
     */
    public function getReciverProvinceId()
    {
        return $this->reciver_province_id;
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
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field grade_id
     *
     * @return integer
     */
    public function getGradeId()
    {
        return $this->grade_id;
    }

    /**
     * Returns the value of field sc_id
     *
     * @return integer
     */
    public function getScId()
    {
        return $this->sc_id;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'stat_order';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StatOrder[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StatOrder
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
