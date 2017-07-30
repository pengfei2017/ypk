<?php

namespace Ypk\Models;

class RefundReturn extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $refund_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $order_sn;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $refund_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $store_name;

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
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $order_goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $goods_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $goods_num;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $refund_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $order_goods_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $refund_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $seller_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $refund_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $return_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $order_lock;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $goods_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $seller_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $admin_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $reason_id;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $reason_info;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $pic_info;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $buyer_message;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $seller_message;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $admin_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $express_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $invoice_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $ship_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $delay_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $receive_time;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $receive_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    protected $commis_rate;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $rpt_amount;

    /**
     * Method to set the value of field refund_id
     *
     * @param integer $refund_id
     * @return $this
     */
    public function setRefundId($refund_id)
    {
        $this->refund_id = $refund_id;

        return $this;
    }

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
     * Method to set the value of field refund_sn
     *
     * @param string $refund_sn
     * @return $this
     */
    public function setRefundSn($refund_sn)
    {
        $this->refund_sn = $refund_sn;

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
     * Method to set the value of field order_goods_id
     *
     * @param integer $order_goods_id
     * @return $this
     */
    public function setOrderGoodsId($order_goods_id)
    {
        $this->order_goods_id = $order_goods_id;

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
     * Method to set the value of field order_goods_type
     *
     * @param integer $order_goods_type
     * @return $this
     */
    public function setOrderGoodsType($order_goods_type)
    {
        $this->order_goods_type = $order_goods_type;

        return $this;
    }

    /**
     * Method to set the value of field refund_type
     *
     * @param integer $refund_type
     * @return $this
     */
    public function setRefundType($refund_type)
    {
        $this->refund_type = $refund_type;

        return $this;
    }

    /**
     * Method to set the value of field seller_state
     *
     * @param integer $seller_state
     * @return $this
     */
    public function setSellerState($seller_state)
    {
        $this->seller_state = $seller_state;

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
     * Method to set the value of field return_type
     *
     * @param integer $return_type
     * @return $this
     */
    public function setReturnType($return_type)
    {
        $this->return_type = $return_type;

        return $this;
    }

    /**
     * Method to set the value of field order_lock
     *
     * @param integer $order_lock
     * @return $this
     */
    public function setOrderLock($order_lock)
    {
        $this->order_lock = $order_lock;

        return $this;
    }

    /**
     * Method to set the value of field goods_state
     *
     * @param integer $goods_state
     * @return $this
     */
    public function setGoodsState($goods_state)
    {
        $this->goods_state = $goods_state;

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
     * Method to set the value of field seller_time
     *
     * @param integer $seller_time
     * @return $this
     */
    public function setSellerTime($seller_time)
    {
        $this->seller_time = $seller_time;

        return $this;
    }

    /**
     * Method to set the value of field admin_time
     *
     * @param integer $admin_time
     * @return $this
     */
    public function setAdminTime($admin_time)
    {
        $this->admin_time = $admin_time;

        return $this;
    }

    /**
     * Method to set the value of field reason_id
     *
     * @param integer $reason_id
     * @return $this
     */
    public function setReasonId($reason_id)
    {
        $this->reason_id = $reason_id;

        return $this;
    }

    /**
     * Method to set the value of field reason_info
     *
     * @param string $reason_info
     * @return $this
     */
    public function setReasonInfo($reason_info)
    {
        $this->reason_info = $reason_info;

        return $this;
    }

    /**
     * Method to set the value of field pic_info
     *
     * @param string $pic_info
     * @return $this
     */
    public function setPicInfo($pic_info)
    {
        $this->pic_info = $pic_info;

        return $this;
    }

    /**
     * Method to set the value of field buyer_message
     *
     * @param string $buyer_message
     * @return $this
     */
    public function setBuyerMessage($buyer_message)
    {
        $this->buyer_message = $buyer_message;

        return $this;
    }

    /**
     * Method to set the value of field seller_message
     *
     * @param string $seller_message
     * @return $this
     */
    public function setSellerMessage($seller_message)
    {
        $this->seller_message = $seller_message;

        return $this;
    }

    /**
     * Method to set the value of field admin_message
     *
     * @param string $admin_message
     * @return $this
     */
    public function setAdminMessage($admin_message)
    {
        $this->admin_message = $admin_message;

        return $this;
    }

    /**
     * Method to set the value of field express_id
     *
     * @param integer $express_id
     * @return $this
     */
    public function setExpressId($express_id)
    {
        $this->express_id = $express_id;

        return $this;
    }

    /**
     * Method to set the value of field invoice_no
     *
     * @param string $invoice_no
     * @return $this
     */
    public function setInvoiceNo($invoice_no)
    {
        $this->invoice_no = $invoice_no;

        return $this;
    }

    /**
     * Method to set the value of field ship_time
     *
     * @param integer $ship_time
     * @return $this
     */
    public function setShipTime($ship_time)
    {
        $this->ship_time = $ship_time;

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
     * Method to set the value of field receive_time
     *
     * @param integer $receive_time
     * @return $this
     */
    public function setReceiveTime($receive_time)
    {
        $this->receive_time = $receive_time;

        return $this;
    }

    /**
     * Method to set the value of field receive_message
     *
     * @param string $receive_message
     * @return $this
     */
    public function setReceiveMessage($receive_message)
    {
        $this->receive_message = $receive_message;

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
     * Returns the value of field refund_id
     *
     * @return integer
     */
    public function getRefundId()
    {
        return $this->refund_id;
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
     * Returns the value of field refund_sn
     *
     * @return string
     */
    public function getRefundSn()
    {
        return $this->refund_sn;
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
     * Returns the value of field goods_id
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * Returns the value of field order_goods_id
     *
     * @return integer
     */
    public function getOrderGoodsId()
    {
        return $this->order_goods_id;
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
     * Returns the value of field goods_num
     *
     * @return integer
     */
    public function getGoodsNum()
    {
        return $this->goods_num;
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
     * Returns the value of field goods_image
     *
     * @return string
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * Returns the value of field order_goods_type
     *
     * @return integer
     */
    public function getOrderGoodsType()
    {
        return $this->order_goods_type;
    }

    /**
     * Returns the value of field refund_type
     *
     * @return integer
     */
    public function getRefundType()
    {
        return $this->refund_type;
    }

    /**
     * Returns the value of field seller_state
     *
     * @return integer
     */
    public function getSellerState()
    {
        return $this->seller_state;
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
     * Returns the value of field return_type
     *
     * @return integer
     */
    public function getReturnType()
    {
        return $this->return_type;
    }

    /**
     * Returns the value of field order_lock
     *
     * @return integer
     */
    public function getOrderLock()
    {
        return $this->order_lock;
    }

    /**
     * Returns the value of field goods_state
     *
     * @return integer
     */
    public function getGoodsState()
    {
        return $this->goods_state;
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
     * Returns the value of field seller_time
     *
     * @return integer
     */
    public function getSellerTime()
    {
        return $this->seller_time;
    }

    /**
     * Returns the value of field admin_time
     *
     * @return integer
     */
    public function getAdminTime()
    {
        return $this->admin_time;
    }

    /**
     * Returns the value of field reason_id
     *
     * @return integer
     */
    public function getReasonId()
    {
        return $this->reason_id;
    }

    /**
     * Returns the value of field reason_info
     *
     * @return string
     */
    public function getReasonInfo()
    {
        return $this->reason_info;
    }

    /**
     * Returns the value of field pic_info
     *
     * @return string
     */
    public function getPicInfo()
    {
        return $this->pic_info;
    }

    /**
     * Returns the value of field buyer_message
     *
     * @return string
     */
    public function getBuyerMessage()
    {
        return $this->buyer_message;
    }

    /**
     * Returns the value of field seller_message
     *
     * @return string
     */
    public function getSellerMessage()
    {
        return $this->seller_message;
    }

    /**
     * Returns the value of field admin_message
     *
     * @return string
     */
    public function getAdminMessage()
    {
        return $this->admin_message;
    }

    /**
     * Returns the value of field express_id
     *
     * @return integer
     */
    public function getExpressId()
    {
        return $this->express_id;
    }

    /**
     * Returns the value of field invoice_no
     *
     * @return string
     */
    public function getInvoiceNo()
    {
        return $this->invoice_no;
    }

    /**
     * Returns the value of field ship_time
     *
     * @return integer
     */
    public function getShipTime()
    {
        return $this->ship_time;
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
     * Returns the value of field receive_time
     *
     * @return integer
     */
    public function getReceiveTime()
    {
        return $this->receive_time;
    }

    /**
     * Returns the value of field receive_message
     *
     * @return string
     */
    public function getReceiveMessage()
    {
        return $this->receive_message;
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
     * Returns the value of field rpt_amount
     *
     * @return double
     */
    public function getRptAmount()
    {
        return $this->rpt_amount;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'refund_return';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefundReturn[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefundReturn
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
