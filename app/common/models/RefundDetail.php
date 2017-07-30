<?php

namespace Ypk\Models;

class RefundDetail extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
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
     * @Column(type="string", length=32, nullable=false)
     */
    protected $batch_no;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $refund_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $pay_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $pd_amount;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $rcb_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $refund_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=true)
     */
    protected $refund_state;

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
    protected $pay_time;

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
     * Method to set the value of field batch_no
     *
     * @param string $batch_no
     * @return $this
     */
    public function setBatchNo($batch_no)
    {
        $this->batch_no = $batch_no;

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
     * Method to set the value of field pay_amount
     *
     * @param double $pay_amount
     * @return $this
     */
    public function setPayAmount($pay_amount)
    {
        $this->pay_amount = $pay_amount;

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
     * Method to set the value of field refund_code
     *
     * @param string $refund_code
     * @return $this
     */
    public function setRefundCode($refund_code)
    {
        $this->refund_code = $refund_code;

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
     * Method to set the value of field pay_time
     *
     * @param integer $pay_time
     * @return $this
     */
    public function setPayTime($pay_time)
    {
        $this->pay_time = $pay_time;

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
     * Returns the value of field batch_no
     *
     * @return string
     */
    public function getBatchNo()
    {
        return $this->batch_no;
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
     * Returns the value of field pay_amount
     *
     * @return double
     */
    public function getPayAmount()
    {
        return $this->pay_amount;
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
     * Returns the value of field rcb_amount
     *
     * @return double
     */
    public function getRcbAmount()
    {
        return $this->rcb_amount;
    }

    /**
     * Returns the value of field refund_code
     *
     * @return string
     */
    public function getRefundCode()
    {
        return $this->refund_code;
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
     * Returns the value of field add_time
     *
     * @return integer
     */
    public function getAddTime()
    {
        return $this->add_time;
    }

    /**
     * Returns the value of field pay_time
     *
     * @return integer
     */
    public function getPayTime()
    {
        return $this->pay_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'refund_detail';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefundDetail[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RefundDetail
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
