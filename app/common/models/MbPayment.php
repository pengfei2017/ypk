<?php

namespace Ypk\Models;

class MbPayment extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $payment_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $payment_code;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $payment_name;

    /**
     *
     * @var string
     * @Column(type="string", length=65535, nullable=true)
     */
    protected $payment_config;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $payment_state;

    /**
     * Method to set the value of field payment_id
     *
     * @param integer $payment_id
     * @return $this
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;

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
     * Method to set the value of field payment_name
     *
     * @param string $payment_name
     * @return $this
     */
    public function setPaymentName($payment_name)
    {
        $this->payment_name = $payment_name;

        return $this;
    }

    /**
     * Method to set the value of field payment_config
     *
     * @param string $payment_config
     * @return $this
     */
    public function setPaymentConfig($payment_config)
    {
        $this->payment_config = $payment_config;

        return $this;
    }

    /**
     * Method to set the value of field payment_state
     *
     * @param string $payment_state
     * @return $this
     */
    public function setPaymentState($payment_state)
    {
        $this->payment_state = $payment_state;

        return $this;
    }

    /**
     * Returns the value of field payment_id
     *
     * @return integer
     */
    public function getPaymentId()
    {
        return $this->payment_id;
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
     * Returns the value of field payment_name
     *
     * @return string
     */
    public function getPaymentName()
    {
        return $this->payment_name;
    }

    /**
     * Returns the value of field payment_config
     *
     * @return string
     */
    public function getPaymentConfig()
    {
        return $this->payment_config;
    }

    /**
     * Returns the value of field payment_state
     *
     * @return string
     */
    public function getPaymentState()
    {
        return $this->payment_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'mb_payment';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbPayment[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return MbPayment
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
