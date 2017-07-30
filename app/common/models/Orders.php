<?php

namespace Ypk\Models;

class Orders extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
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
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $pay_sn;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $pay_sn1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
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
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $buyer_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $buyer_name;

    /**
     *
     * @var string
     * @Column(type="string", length=80, nullable=true)
     */
    protected $buyer_email;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $buyer_phone;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $add_time;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $payment_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $payment_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $finnshed_time;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $order_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $rcb_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $pd_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $shipping_fee;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $evaluation_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $evaluation_again_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $order_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $refund_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $lock_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $delete_state;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $refund_amount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $delay_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $order_from;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $shipping_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $order_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $api_pay_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $chain_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=false)
     */
    protected $chain_code;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $rpt_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $trade_no;

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
     * Method to set the value of field pay_sn1
     *
     * @param string $pay_sn1
     * @return $this
     */
    public function setPaySn1($pay_sn1)
    {
        $this->pay_sn1 = $pay_sn1;

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
     * Method to set the value of field buyer_email
     *
     * @param string $buyer_email
     * @return $this
     */
    public function setBuyerEmail($buyer_email)
    {
        $this->buyer_email = $buyer_email;

        return $this;
    }

    /**
     * Method to set the value of field buyer_phone
     *
     * @param string $buyer_phone
     * @return $this
     */
    public function setBuyerPhone($buyer_phone)
    {
        $this->buyer_phone = $buyer_phone;

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
     * Method to set the value of field payment_time
     *
     * @param integer $payment_time
     * @return $this
     */
    public function setPaymentTime($payment_time)
    {
        $this->payment_time = $payment_time;

        return $this;
    }

    /**
     * Method to set the value of field finnshed_time
     *
     * @param integer $finnshed_time
     * @return $this
     */
    public function setFinnshedTime($finnshed_time)
    {
        $this->finnshed_time = $finnshed_time;

        return $this;
    }

    /**
     * Method to set the value of field goods_amount
     *
     * @param double $goods_amount
     * @return $this
     */
    public function setGoodsAmount($goods_amount)
    {
        $this->goods_amount = $goods_amount;

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
     * Method to set the value of field rcb_amount
     *
     * @param double $rcb_amount
     * @return $this
     */
    public function setRcbAmount($rcb_amount)
    {
        $this->rcb_amount = $rcb_amount;

        return $this;
    }

    /**
     * Method to set the value of field pd_amount
     *
     * @param double $pd_amount
     * @return $this
     */
    public function setPdAmount($pd_amount)
    {
        $this->pd_amount = $pd_amount;

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
     * @param integer $evaluation_state
     * @return $this
     */
    public function setEvaluationState($evaluation_state)
    {
        $this->evaluation_state = $evaluation_state;

        return $this;
    }

    /**
     * Method to set the value of field evaluation_again_state
     *
     * @param integer $evaluation_again_state
     * @return $this
     */
    public function setEvaluationAgainState($evaluation_again_state)
    {
        $this->evaluation_again_state = $evaluation_again_state;

        return $this;
    }

    /**
     * Method to set the value of field order_state
     *
     * @param integer $order_state
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
     * Method to set the value of field lock_state
     *
     * @param integer $lock_state
     * @return $this
     */
    public function setLockState($lock_state)
    {
        $this->lock_state = $lock_state;

        return $this;
    }

    /**
     * Method to set the value of field delete_state
     *
     * @param integer $delete_state
     * @return $this
     */
    public function setDeleteState($delete_state)
    {
        $this->delete_state = $delete_state;

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
     * Method to set the value of field delay_time
     *
     * @param integer $delay_time
     * @return $this
     */
    public function setDelayTime($delay_time)
    {
        $this->delay_time = $delay_time;

        return $this;
    }

    /**
     * Method to set the value of field order_from
     *
     * @param integer $order_from
     * @return $this
     */
    public function setOrderFrom($order_from)
    {
        $this->order_from = $order_from;

        return $this;
    }

    /**
     * Method to set the value of field shipping_code
     *
     * @param string $shipping_code
     * @return $this
     */
    public function setShippingCode($shipping_code)
    {
        $this->shipping_code = $shipping_code;

        return $this;
    }

    /**
     * Method to set the value of field order_type
     *
     * @param integer $order_type
     * @return $this
     */
    public function setOrderType($order_type)
    {
        $this->order_type = $order_type;

        return $this;
    }

    /**
     * Method to set the value of field api_pay_time
     *
     * @param integer $api_pay_time
     * @return $this
     */
    public function setApiPayTime($api_pay_time)
    {
        $this->api_pay_time = $api_pay_time;

        return $this;
    }

    /**
     * Method to set the value of field chain_id
     *
     * @param integer $chain_id
     * @return $this
     */
    public function setChainId($chain_id)
    {
        $this->chain_id = $chain_id;

        return $this;
    }

    /**
     * Method to set the value of field chain_code
     *
     * @param integer $chain_code
     * @return $this
     */
    public function setChainCode($chain_code)
    {
        $this->chain_code = $chain_code;

        return $this;
    }

    /**
     * Method to set the value of field rpt_amount
     *
     * @param double $rpt_amount
     * @return $this
     */
    public function setRptAmount($rpt_amount)
    {
        $this->rpt_amount = $rpt_amount;

        return $this;
    }

    /**
     * Method to set the value of field trade_no
     *
     * @param string $trade_no
     * @return $this
     */
    public function setTradeNo($trade_no)
    {
        $this->trade_no = $trade_no;

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
     * Returns the value of field pay_sn
     *
     * @return string
     */
    public function getPaySn()
    {
        return $this->pay_sn;
    }

    /**
     * Returns the value of field pay_sn1
     *
     * @return string
     */
    public function getPaySn1()
    {
        return $this->pay_sn1;
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
     * Returns the value of field buyer_email
     *
     * @return string
     */
    public function getBuyerEmail()
    {
        return $this->buyer_email;
    }

    /**
     * Returns the value of field buyer_phone
     *
     * @return string
     */
    public function getBuyerPhone()
    {
        return $this->buyer_phone;
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
     * Returns the value of field payment_code
     *
     * @return string
     */
    public function getPaymentCode()
    {
        return $this->payment_code;
    }

    /**
     * Returns the value of field payment_time
     *
     * @return integer
     */
    public function getPaymentTime()
    {
        return $this->payment_time;
    }

    /**
     * Returns the value of field finnshed_time
     *
     * @return integer
     */
    public function getFinnshedTime()
    {
        return $this->finnshed_time;
    }

    /**
     * Returns the value of field goods_amount
     *
     * @return double
     */
    public function getGoodsAmount()
    {
        return $this->goods_amount;
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
     * Returns the value of field rcb_amount
     *
     * @return double
     */
    public function getRcbAmount()
    {
        return $this->rcb_amount;
    }

    /**
     * Returns the value of field pd_amount
     *
     * @return double
     */
    public function getPdAmount()
    {
        return $this->pd_amount;
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
     * @return integer
     */
    public function getEvaluationState()
    {
        return $this->evaluation_state;
    }

    /**
     * Returns the value of field evaluation_again_state
     *
     * @return integer
     */
    public function getEvaluationAgainState()
    {
        return $this->evaluation_again_state;
    }

    /**
     * Returns the value of field order_state
     *
     * @return integer
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
     * Returns the value of field lock_state
     *
     * @return integer
     */
    public function getLockState()
    {
        return $this->lock_state;
    }

    /**
     * Returns the value of field delete_state
     *
     * @return integer
     */
    public function getDeleteState()
    {
        return $this->delete_state;
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
     * Returns the value of field delay_time
     *
     * @return integer
     */
    public function getDelayTime()
    {
        return $this->delay_time;
    }

    /**
     * Returns the value of field order_from
     *
     * @return integer
     */
    public function getOrderFrom()
    {
        return $this->order_from;
    }

    /**
     * Returns the value of field shipping_code
     *
     * @return string
     */
    public function getShippingCode()
    {
        return $this->shipping_code;
    }

    /**
     * Returns the value of field order_type
     *
     * @return integer
     */
    public function getOrderType()
    {
        return $this->order_type;
    }

    /**
     * Returns the value of field api_pay_time
     *
     * @return integer
     */
    public function getApiPayTime()
    {
        return $this->api_pay_time;
    }

    /**
     * Returns the value of field chain_id
     *
     * @return integer
     */
    public function getChainId()
    {
        return $this->chain_id;
    }

    /**
     * Returns the value of field chain_code
     *
     * @return integer
     */
    public function getChainCode()
    {
        return $this->chain_code;
    }

    /**
     * Returns the value of field rpt_amount
     *
     * @return double
     */
    public function getRptAmount()
    {
        return $this->rpt_amount;
    }

    /**
     * Returns the value of field trade_no
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->trade_no;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'orders';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Orders[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Orders
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
