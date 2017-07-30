<?php

namespace Ypk\Models;

class VrOrder extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=11, nullable=false)
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
     * @Column(type="string", length=10, nullable=true)
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
     * @var string
     * @Column(type="string", length=35, nullable=true)
     */
    protected $trade_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $close_time;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $close_reason;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $finnshed_time;

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
    protected $refund_amount;

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
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
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
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $buyer_msg;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $delete_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $goods_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $goods_num;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $commis_rate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $gc_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_indate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $vr_send_times;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $vr_invalid_refund;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $order_promotion_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $promotions_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $order_from;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $evaluation_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $evaluation_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $use_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $api_pay_time;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_contractid;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $goods_spec;

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
     * Method to set the value of field close_time
     *
     * @param integer $close_time
     * @return $this
     */
    public function setCloseTime($close_time)
    {
        $this->close_time = $close_time;

        return $this;
    }

    /**
     * Method to set the value of field close_reason
     *
     * @param string $close_reason
     * @return $this
     */
    public function setCloseReason($close_reason)
    {
        $this->close_reason = $close_reason;

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
     * Method to set the value of field buyer_msg
     *
     * @param string $buyer_msg
     * @return $this
     */
    public function setBuyerMsg($buyer_msg)
    {
        $this->buyer_msg = $buyer_msg;

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
     * Method to set the value of field goods_id
     *
     * @param integer $goods_id
     * @return $this
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;

        return $this;
    }

    /**
     * Method to set the value of field goods_name
     *
     * @param string $goods_name
     * @return $this
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;

        return $this;
    }

    /**
     * Method to set the value of field goods_price
     *
     * @param double $goods_price
     * @return $this
     */
    public function setGoodsPrice($goods_price)
    {
        $this->goods_price = $goods_price;

        return $this;
    }

    /**
     * Method to set the value of field goods_num
     *
     * @param integer $goods_num
     * @return $this
     */
    public function setGoodsNum($goods_num)
    {
        $this->goods_num = $goods_num;

        return $this;
    }

    /**
     * Method to set the value of field goods_image
     *
     * @param string $goods_image
     * @return $this
     */
    public function setGoodsImage($goods_image)
    {
        $this->goods_image = $goods_image;

        return $this;
    }

    /**
     * Method to set the value of field commis_rate
     *
     * @param integer $commis_rate
     * @return $this
     */
    public function setCommisRate($commis_rate)
    {
        $this->commis_rate = $commis_rate;

        return $this;
    }

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Method to set the value of field vr_indate
     *
     * @param integer $vr_indate
     * @return $this
     */
    public function setVrIndate($vr_indate)
    {
        $this->vr_indate = $vr_indate;

        return $this;
    }

    /**
     * Method to set the value of field vr_send_times
     *
     * @param integer $vr_send_times
     * @return $this
     */
    public function setVrSendTimes($vr_send_times)
    {
        $this->vr_send_times = $vr_send_times;

        return $this;
    }

    /**
     * Method to set the value of field vr_invalid_refund
     *
     * @param integer $vr_invalid_refund
     * @return $this
     */
    public function setVrInvalidRefund($vr_invalid_refund)
    {
        $this->vr_invalid_refund = $vr_invalid_refund;

        return $this;
    }

    /**
     * Method to set the value of field order_promotion_type
     *
     * @param integer $order_promotion_type
     * @return $this
     */
    public function setOrderPromotionType($order_promotion_type)
    {
        $this->order_promotion_type = $order_promotion_type;

        return $this;
    }

    /**
     * Method to set the value of field promotions_id
     *
     * @param integer $promotions_id
     * @return $this
     */
    public function setPromotionsId($promotions_id)
    {
        $this->promotions_id = $promotions_id;

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
     * Method to set the value of field evaluation_time
     *
     * @param integer $evaluation_time
     * @return $this
     */
    public function setEvaluationTime($evaluation_time)
    {
        $this->evaluation_time = $evaluation_time;

        return $this;
    }

    /**
     * Method to set the value of field use_state
     *
     * @param integer $use_state
     * @return $this
     */
    public function setUseState($use_state)
    {
        $this->use_state = $use_state;

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
     * Method to set the value of field goods_contractid
     *
     * @param string $goods_contractid
     * @return $this
     */
    public function setGoodsContractid($goods_contractid)
    {
        $this->goods_contractid = $goods_contractid;

        return $this;
    }

    /**
     * Method to set the value of field goods_spec
     *
     * @param string $goods_spec
     * @return $this
     */
    public function setGoodsSpec($goods_spec)
    {
        $this->goods_spec = $goods_spec;

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
     * Returns the value of field trade_no
     *
     * @return string
     */
    public function getTradeNo()
    {
        return $this->trade_no;
    }

    /**
     * Returns the value of field close_time
     *
     * @return integer
     */
    public function getCloseTime()
    {
        return $this->close_time;
    }

    /**
     * Returns the value of field close_reason
     *
     * @return string
     */
    public function getCloseReason()
    {
        return $this->close_reason;
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
     * Returns the value of field order_amount
     *
     * @return double
     */
    public function getOrderAmount()
    {
        return $this->order_amount;
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
     * Returns the value of field buyer_msg
     *
     * @return string
     */
    public function getBuyerMsg()
    {
        return $this->buyer_msg;
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
     * Returns the value of field goods_id
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * Returns the value of field goods_name
     *
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * Returns the value of field goods_price
     *
     * @return double
     */
    public function getGoodsPrice()
    {
        return $this->goods_price;
    }

    /**
     * Returns the value of field goods_num
     *
     * @return integer
     */
    public function getGoodsNum()
    {
        return $this->goods_num;
    }

    /**
     * Returns the value of field goods_image
     *
     * @return string
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * Returns the value of field commis_rate
     *
     * @return integer
     */
    public function getCommisRate()
    {
        return $this->commis_rate;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns the value of field vr_indate
     *
     * @return integer
     */
    public function getVrIndate()
    {
        return $this->vr_indate;
    }

    /**
     * Returns the value of field vr_send_times
     *
     * @return integer
     */
    public function getVrSendTimes()
    {
        return $this->vr_send_times;
    }

    /**
     * Returns the value of field vr_invalid_refund
     *
     * @return integer
     */
    public function getVrInvalidRefund()
    {
        return $this->vr_invalid_refund;
    }

    /**
     * Returns the value of field order_promotion_type
     *
     * @return integer
     */
    public function getOrderPromotionType()
    {
        return $this->order_promotion_type;
    }

    /**
     * Returns the value of field promotions_id
     *
     * @return integer
     */
    public function getPromotionsId()
    {
        return $this->promotions_id;
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
     * Returns the value of field evaluation_state
     *
     * @return integer
     */
    public function getEvaluationState()
    {
        return $this->evaluation_state;
    }

    /**
     * Returns the value of field evaluation_time
     *
     * @return integer
     */
    public function getEvaluationTime()
    {
        return $this->evaluation_time;
    }

    /**
     * Returns the value of field use_state
     *
     * @return integer
     */
    public function getUseState()
    {
        return $this->use_state;
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
     * Returns the value of field goods_contractid
     *
     * @return string
     */
    public function getGoodsContractid()
    {
        return $this->goods_contractid;
    }

    /**
     * Returns the value of field goods_spec
     *
     * @return string
     */
    public function getGoodsSpec()
    {
        return $this->goods_spec;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_order';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrder[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrder
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
