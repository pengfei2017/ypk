<?php

namespace Ypk\Models;

class VrOrderCode extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rec_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $buyer_id;

    /**
     *
     * @var string
     * @Column(type="string", length=18, nullable=false)
     */
    protected $vr_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $vr_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_usetime;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $pay_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_indate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=false)
     */
    protected $commis_rate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $refund_lock;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $vr_invalid_refund;

    /**
     * Method to set the value of field rec_id
     *
     * @param integer $rec_id
     * @return $this
     */
    public function setRecId($rec_id)
    {
        $this->rec_id = $rec_id;

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
     * Method to set the value of field vr_code
     *
     * @param string $vr_code
     * @return $this
     */
    public function setVrCode($vr_code)
    {
        $this->vr_code = $vr_code;

        return $this;
    }

    /**
     * Method to set the value of field vr_state
     *
     * @param integer $vr_state
     * @return $this
     */
    public function setVrState($vr_state)
    {
        $this->vr_state = $vr_state;

        return $this;
    }

    /**
     * Method to set the value of field vr_usetime
     *
     * @param integer $vr_usetime
     * @return $this
     */
    public function setVrUsetime($vr_usetime)
    {
        $this->vr_usetime = $vr_usetime;

        return $this;
    }

    /**
     * Method to set the value of field pay_price
     *
     * @param double $pay_price
     * @return $this
     */
    public function setPayPrice($pay_price)
    {
        $this->pay_price = $pay_price;

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
     * Method to set the value of field refund_lock
     *
     * @param integer $refund_lock
     * @return $this
     */
    public function setRefundLock($refund_lock)
    {
        $this->refund_lock = $refund_lock;

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
     * Returns the value of field rec_id
     *
     * @return integer
     */
    public function getRecId()
    {
        return $this->rec_id;
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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
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
     * Returns the value of field vr_code
     *
     * @return string
     */
    public function getVrCode()
    {
        return $this->vr_code;
    }

    /**
     * Returns the value of field vr_state
     *
     * @return integer
     */
    public function getVrState()
    {
        return $this->vr_state;
    }

    /**
     * Returns the value of field vr_usetime
     *
     * @return integer
     */
    public function getVrUsetime()
    {
        return $this->vr_usetime;
    }

    /**
     * Returns the value of field pay_price
     *
     * @return double
     */
    public function getPayPrice()
    {
        return $this->pay_price;
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
     * Returns the value of field commis_rate
     *
     * @return integer
     */
    public function getCommisRate()
    {
        return $this->commis_rate;
    }

    /**
     * Returns the value of field refund_lock
     *
     * @return integer
     */
    public function getRefundLock()
    {
        return $this->refund_lock;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_order_code';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrderCode[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrderCode
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
