<?php

namespace Ypk\Models;

class PdCash extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $pdc_sn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdc_member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $pdc_member_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $pdc_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=false)
     */
    protected $pdc_bank_name;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $pdc_bank_no;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $pdc_bank_user;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pdc_add_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $pdc_payment_time;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $pdc_payment_state;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $pdc_payment_admin;

    /**
     * Method to set the value of field pdc_id
     *
     * @param integer $pdc_id
     * @return $this
     */
    public function setPdcId($pdc_id)
    {
        $this->pdc_id = $pdc_id;

        return $this;
    }

    /**
     * Method to set the value of field pdc_sn
     *
     * @param string $pdc_sn
     * @return $this
     */
    public function setPdcSn($pdc_sn)
    {
        $this->pdc_sn = $pdc_sn;

        return $this;
    }

    /**
     * Method to set the value of field pdc_member_id
     *
     * @param integer $pdc_member_id
     * @return $this
     */
    public function setPdcMemberId($pdc_member_id)
    {
        $this->pdc_member_id = $pdc_member_id;

        return $this;
    }

    /**
     * Method to set the value of field pdc_member_name
     *
     * @param string $pdc_member_name
     * @return $this
     */
    public function setPdcMemberName($pdc_member_name)
    {
        $this->pdc_member_name = $pdc_member_name;

        return $this;
    }

    /**
     * Method to set the value of field pdc_amount
     *
     * @param double $pdc_amount
     * @return $this
     */
    public function setPdcAmount($pdc_amount)
    {
        $this->pdc_amount = $pdc_amount;

        return $this;
    }

    /**
     * Method to set the value of field pdc_bank_name
     *
     * @param string $pdc_bank_name
     * @return $this
     */
    public function setPdcBankName($pdc_bank_name)
    {
        $this->pdc_bank_name = $pdc_bank_name;

        return $this;
    }

    /**
     * Method to set the value of field pdc_bank_no
     *
     * @param string $pdc_bank_no
     * @return $this
     */
    public function setPdcBankNo($pdc_bank_no)
    {
        $this->pdc_bank_no = $pdc_bank_no;

        return $this;
    }

    /**
     * Method to set the value of field pdc_bank_user
     *
     * @param string $pdc_bank_user
     * @return $this
     */
    public function setPdcBankUser($pdc_bank_user)
    {
        $this->pdc_bank_user = $pdc_bank_user;

        return $this;
    }

    /**
     * Method to set the value of field pdc_add_time
     *
     * @param integer $pdc_add_time
     * @return $this
     */
    public function setPdcAddTime($pdc_add_time)
    {
        $this->pdc_add_time = $pdc_add_time;

        return $this;
    }

    /**
     * Method to set the value of field pdc_payment_time
     *
     * @param integer $pdc_payment_time
     * @return $this
     */
    public function setPdcPaymentTime($pdc_payment_time)
    {
        $this->pdc_payment_time = $pdc_payment_time;

        return $this;
    }

    /**
     * Method to set the value of field pdc_payment_state
     *
     * @param string $pdc_payment_state
     * @return $this
     */
    public function setPdcPaymentState($pdc_payment_state)
    {
        $this->pdc_payment_state = $pdc_payment_state;

        return $this;
    }

    /**
     * Method to set the value of field pdc_payment_admin
     *
     * @param string $pdc_payment_admin
     * @return $this
     */
    public function setPdcPaymentAdmin($pdc_payment_admin)
    {
        $this->pdc_payment_admin = $pdc_payment_admin;

        return $this;
    }

    /**
     * Returns the value of field pdc_id
     *
     * @return integer
     */
    public function getPdcId()
    {
        return $this->pdc_id;
    }

    /**
     * Returns the value of field pdc_sn
     *
     * @return string
     */
    public function getPdcSn()
    {
        return $this->pdc_sn;
    }

    /**
     * Returns the value of field pdc_member_id
     *
     * @return integer
     */
    public function getPdcMemberId()
    {
        return $this->pdc_member_id;
    }

    /**
     * Returns the value of field pdc_member_name
     *
     * @return string
     */
    public function getPdcMemberName()
    {
        return $this->pdc_member_name;
    }

    /**
     * Returns the value of field pdc_amount
     *
     * @return double
     */
    public function getPdcAmount()
    {
        return $this->pdc_amount;
    }

    /**
     * Returns the value of field pdc_bank_name
     *
     * @return string
     */
    public function getPdcBankName()
    {
        return $this->pdc_bank_name;
    }

    /**
     * Returns the value of field pdc_bank_no
     *
     * @return string
     */
    public function getPdcBankNo()
    {
        return $this->pdc_bank_no;
    }

    /**
     * Returns the value of field pdc_bank_user
     *
     * @return string
     */
    public function getPdcBankUser()
    {
        return $this->pdc_bank_user;
    }

    /**
     * Returns the value of field pdc_add_time
     *
     * @return integer
     */
    public function getPdcAddTime()
    {
        return $this->pdc_add_time;
    }

    /**
     * Returns the value of field pdc_payment_time
     *
     * @return integer
     */
    public function getPdcPaymentTime()
    {
        return $this->pdc_payment_time;
    }

    /**
     * Returns the value of field pdc_payment_state
     *
     * @return string
     */
    public function getPdcPaymentState()
    {
        return $this->pdc_payment_state;
    }

    /**
     * Returns the value of field pdc_payment_admin
     *
     * @return string
     */
    public function getPdcPaymentAdmin()
    {
        return $this->pdc_payment_admin;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'pd_cash';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PdCash[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PdCash
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
