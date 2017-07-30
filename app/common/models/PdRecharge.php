<?php

namespace Ypk\Models;

class PdRecharge extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdr_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $pdr_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdr_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $pdr_member_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $pdr_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $pdr_payment_code;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=true)
     */
    protected $pdr_payment_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $pdr_trade_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdr_add_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $pdr_payment_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdr_payment_time;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $pdr_admin;

    /**
     * Method to set the value of field pdr_id
     *
     * @param integer $pdr_id
     * @return $this
     */
    public function setPdrId($pdr_id)
    {
        $this->pdr_id = $pdr_id;

        return $this;
    }

    /**
     * Method to set the value of field pdr_sn
     *
     * @param string $pdr_sn
     * @return $this
     */
    public function setPdrSn($pdr_sn)
    {
        $this->pdr_sn = $pdr_sn;

        return $this;
    }

    /**
     * Method to set the value of field pdr_member_id
     *
     * @param integer $pdr_member_id
     * @return $this
     */
    public function setPdrMemberId($pdr_member_id)
    {
        $this->pdr_member_id = $pdr_member_id;

        return $this;
    }

    /**
     * Method to set the value of field pdr_member_name
     *
     * @param string $pdr_member_name
     * @return $this
     */
    public function setPdrMemberName($pdr_member_name)
    {
        $this->pdr_member_name = $pdr_member_name;

        return $this;
    }

    /**
     * Method to set the value of field pdr_amount
     *
     * @param double $pdr_amount
     * @return $this
     */
    public function setPdrAmount($pdr_amount)
    {
        $this->pdr_amount = $pdr_amount;

        return $this;
    }

    /**
     * Method to set the value of field pdr_payment_code
     *
     * @param string $pdr_payment_code
     * @return $this
     */
    public function setPdrPaymentCode($pdr_payment_code)
    {
        $this->pdr_payment_code = $pdr_payment_code;

        return $this;
    }

    /**
     * Method to set the value of field pdr_payment_name
     *
     * @param string $pdr_payment_name
     * @return $this
     */
    public function setPdrPaymentName($pdr_payment_name)
    {
        $this->pdr_payment_name = $pdr_payment_name;

        return $this;
    }

    /**
     * Method to set the value of field pdr_trade_sn
     *
     * @param string $pdr_trade_sn
     * @return $this
     */
    public function setPdrTradeSn($pdr_trade_sn)
    {
        $this->pdr_trade_sn = $pdr_trade_sn;

        return $this;
    }

    /**
     * Method to set the value of field pdr_add_time
     *
     * @param integer $pdr_add_time
     * @return $this
     */
    public function setPdrAddTime($pdr_add_time)
    {
        $this->pdr_add_time = $pdr_add_time;

        return $this;
    }

    /**
     * Method to set the value of field pdr_payment_state
     *
     * @param string $pdr_payment_state
     * @return $this
     */
    public function setPdrPaymentState($pdr_payment_state)
    {
        $this->pdr_payment_state = $pdr_payment_state;

        return $this;
    }

    /**
     * Method to set the value of field pdr_payment_time
     *
     * @param integer $pdr_payment_time
     * @return $this
     */
    public function setPdrPaymentTime($pdr_payment_time)
    {
        $this->pdr_payment_time = $pdr_payment_time;

        return $this;
    }

    /**
     * Method to set the value of field pdr_admin
     *
     * @param string $pdr_admin
     * @return $this
     */
    public function setPdrAdmin($pdr_admin)
    {
        $this->pdr_admin = $pdr_admin;

        return $this;
    }

    /**
     * Returns the value of field pdr_id
     *
     * @return integer
     */
    public function getPdrId()
    {
        return $this->pdr_id;
    }

    /**
     * Returns the value of field pdr_sn
     *
     * @return string
     */
    public function getPdrSn()
    {
        return $this->pdr_sn;
    }

    /**
     * Returns the value of field pdr_member_id
     *
     * @return integer
     */
    public function getPdrMemberId()
    {
        return $this->pdr_member_id;
    }

    /**
     * Returns the value of field pdr_member_name
     *
     * @return string
     */
    public function getPdrMemberName()
    {
        return $this->pdr_member_name;
    }

    /**
     * Returns the value of field pdr_amount
     *
     * @return double
     */
    public function getPdrAmount()
    {
        return $this->pdr_amount;
    }

    /**
     * Returns the value of field pdr_payment_code
     *
     * @return string
     */
    public function getPdrPaymentCode()
    {
        return $this->pdr_payment_code;
    }

    /**
     * Returns the value of field pdr_payment_name
     *
     * @return string
     */
    public function getPdrPaymentName()
    {
        return $this->pdr_payment_name;
    }

    /**
     * Returns the value of field pdr_trade_sn
     *
     * @return string
     */
    public function getPdrTradeSn()
    {
        return $this->pdr_trade_sn;
    }

    /**
     * Returns the value of field pdr_add_time
     *
     * @return integer
     */
    public function getPdrAddTime()
    {
        return $this->pdr_add_time;
    }

    /**
     * Returns the value of field pdr_payment_state
     *
     * @return string
     */
    public function getPdrPaymentState()
    {
        return $this->pdr_payment_state;
    }

    /**
     * Returns the value of field pdr_payment_time
     *
     * @return integer
     */
    public function getPdrPaymentTime()
    {
        return $this->pdr_payment_time;
    }

    /**
     * Returns the value of field pdr_admin
     *
     * @return string
     */
    public function getPdrAdmin()
    {
        return $this->pdr_admin;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pd_recharge';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PdRecharge[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PdRecharge
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
