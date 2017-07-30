<?php

namespace Ypk\Models;

class StoreReopen extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $re_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $re_grade_id;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $re_grade_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $re_grade_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $re_year;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $re_pay_amount;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $re_store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $re_store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $re_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $re_start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $re_end_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $re_create_time;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $re_pay_cert;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $re_pay_cert_explain;

    /**
     * Method to set the value of field re_id
     *
     * @param integer $re_id
     * @return $this
     */
    public function setReId($re_id)
    {
        $this->re_id = $re_id;

        return $this;
    }

    /**
     * Method to set the value of field re_grade_id
     *
     * @param integer $re_grade_id
     * @return $this
     */
    public function setReGradeId($re_grade_id)
    {
        $this->re_grade_id = $re_grade_id;

        return $this;
    }

    /**
     * Method to set the value of field re_grade_name
     *
     * @param string $re_grade_name
     * @return $this
     */
    public function setReGradeName($re_grade_name)
    {
        $this->re_grade_name = $re_grade_name;

        return $this;
    }

    /**
     * Method to set the value of field re_grade_price
     *
     * @param double $re_grade_price
     * @return $this
     */
    public function setReGradePrice($re_grade_price)
    {
        $this->re_grade_price = $re_grade_price;

        return $this;
    }

    /**
     * Method to set the value of field re_year
     *
     * @param integer $re_year
     * @return $this
     */
    public function setReYear($re_year)
    {
        $this->re_year = $re_year;

        return $this;
    }

    /**
     * Method to set the value of field re_pay_amount
     *
     * @param double $re_pay_amount
     * @return $this
     */
    public function setRePayAmount($re_pay_amount)
    {
        $this->re_pay_amount = $re_pay_amount;

        return $this;
    }

    /**
     * Method to set the value of field re_store_name
     *
     * @param string $re_store_name
     * @return $this
     */
    public function setReStoreName($re_store_name)
    {
        $this->re_store_name = $re_store_name;

        return $this;
    }

    /**
     * Method to set the value of field re_store_id
     *
     * @param integer $re_store_id
     * @return $this
     */
    public function setReStoreId($re_store_id)
    {
        $this->re_store_id = $re_store_id;

        return $this;
    }

    /**
     * Method to set the value of field re_state
     *
     * @param integer $re_state
     * @return $this
     */
    public function setReState($re_state)
    {
        $this->re_state = $re_state;

        return $this;
    }

    /**
     * Method to set the value of field re_start_time
     *
     * @param integer $re_start_time
     * @return $this
     */
    public function setReStartTime($re_start_time)
    {
        $this->re_start_time = $re_start_time;

        return $this;
    }

    /**
     * Method to set the value of field re_end_time
     *
     * @param integer $re_end_time
     * @return $this
     */
    public function setReEndTime($re_end_time)
    {
        $this->re_end_time = $re_end_time;

        return $this;
    }

    /**
     * Method to set the value of field re_create_time
     *
     * @param integer $re_create_time
     * @return $this
     */
    public function setReCreateTime($re_create_time)
    {
        $this->re_create_time = $re_create_time;

        return $this;
    }

    /**
     * Method to set the value of field re_pay_cert
     *
     * @param string $re_pay_cert
     * @return $this
     */
    public function setRePayCert($re_pay_cert)
    {
        $this->re_pay_cert = $re_pay_cert;

        return $this;
    }

    /**
     * Method to set the value of field re_pay_cert_explain
     *
     * @param string $re_pay_cert_explain
     * @return $this
     */
    public function setRePayCertExplain($re_pay_cert_explain)
    {
        $this->re_pay_cert_explain = $re_pay_cert_explain;

        return $this;
    }

    /**
     * Returns the value of field re_id
     *
     * @return integer
     */
    public function getReId()
    {
        return $this->re_id;
    }

    /**
     * Returns the value of field re_grade_id
     *
     * @return integer
     */
    public function getReGradeId()
    {
        return $this->re_grade_id;
    }

    /**
     * Returns the value of field re_grade_name
     *
     * @return string
     */
    public function getReGradeName()
    {
        return $this->re_grade_name;
    }

    /**
     * Returns the value of field re_grade_price
     *
     * @return double
     */
    public function getReGradePrice()
    {
        return $this->re_grade_price;
    }

    /**
     * Returns the value of field re_year
     *
     * @return integer
     */
    public function getReYear()
    {
        return $this->re_year;
    }

    /**
     * Returns the value of field re_pay_amount
     *
     * @return double
     */
    public function getRePayAmount()
    {
        return $this->re_pay_amount;
    }

    /**
     * Returns the value of field re_store_name
     *
     * @return string
     */
    public function getReStoreName()
    {
        return $this->re_store_name;
    }

    /**
     * Returns the value of field re_store_id
     *
     * @return integer
     */
    public function getReStoreId()
    {
        return $this->re_store_id;
    }

    /**
     * Returns the value of field re_state
     *
     * @return integer
     */
    public function getReState()
    {
        return $this->re_state;
    }

    /**
     * Returns the value of field re_start_time
     *
     * @return integer
     */
    public function getReStartTime()
    {
        return $this->re_start_time;
    }

    /**
     * Returns the value of field re_end_time
     *
     * @return integer
     */
    public function getReEndTime()
    {
        return $this->re_end_time;
    }

    /**
     * Returns the value of field re_create_time
     *
     * @return integer
     */
    public function getReCreateTime()
    {
        return $this->re_create_time;
    }

    /**
     * Returns the value of field re_pay_cert
     *
     * @return string
     */
    public function getRePayCert()
    {
        return $this->re_pay_cert;
    }

    /**
     * Returns the value of field re_pay_cert_explain
     *
     * @return string
     */
    public function getRePayCertExplain()
    {
        return $this->re_pay_cert_explain;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_reopen';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreReopen[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreReopen
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
