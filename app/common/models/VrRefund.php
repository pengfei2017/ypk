<?php

namespace Ypk\Models;

class VrRefund extends \Phalcon\Mvc\Model
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
    protected $goods_num;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $goods_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=false)
     */
    protected $code_sn;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $refund_amount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $admin_state;

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
    protected $admin_time;

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
    protected $admin_message;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    protected $commis_rate;

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
     * Method to set the value of field code_sn
     *
     * @param string $code_sn
     * @return $this
     */
    public function setCodeSn($code_sn)
    {
        $this->code_sn = $code_sn;

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
     * Method to set the value of field admin_state
     *
     * @param integer $admin_state
     * @return $this
     */
    public function setAdminState($admin_state)
    {
        $this->admin_state = $admin_state;

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
     * Returns the value of field goods_num
     *
     * @return integer
     */
    public function getGoodsNum()
    {
        return $this->goods_num;
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
     * Returns the value of field goods_image
     *
     * @return string
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * Returns the value of field code_sn
     *
     * @return string
     */
    public function getCodeSn()
    {
        return $this->code_sn;
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
     * Returns the value of field admin_state
     *
     * @return integer
     */
    public function getAdminState()
    {
        return $this->admin_state;
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
     * Returns the value of field admin_time
     *
     * @return integer
     */
    public function getAdminTime()
    {
        return $this->admin_time;
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
     * Returns the value of field admin_message
     *
     * @return string
     */
    public function getAdminMessage()
    {
        return $this->admin_message;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_refund';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrRefund[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrRefund
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
