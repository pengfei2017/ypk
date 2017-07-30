<?php

namespace Ypk\Models;

class VrOrderBill extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ob_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $ob_no;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ob_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ob_end_date;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $ob_order_totals;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $ob_commis_totals;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $ob_result_totals;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $ob_create_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    protected $os_month;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $ob_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $ob_pay_date;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $ob_pay_content;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $ob_store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $ob_store_name;

    /**
     * Method to set the value of field ob_id
     *
     * @param integer $ob_id
     * @return $this
     */
    public function setObId($ob_id)
    {
        $this->ob_id = $ob_id;

        return $this;
    }

    /**
     * Method to set the value of field ob_no
     *
     * @param integer $ob_no
     * @return $this
     */
    public function setObNo($ob_no)
    {
        $this->ob_no = $ob_no;

        return $this;
    }

    /**
     * Method to set the value of field ob_start_date
     *
     * @param integer $ob_start_date
     * @return $this
     */
    public function setObStartDate($ob_start_date)
    {
        $this->ob_start_date = $ob_start_date;

        return $this;
    }

    /**
     * Method to set the value of field ob_end_date
     *
     * @param integer $ob_end_date
     * @return $this
     */
    public function setObEndDate($ob_end_date)
    {
        $this->ob_end_date = $ob_end_date;

        return $this;
    }

    /**
     * Method to set the value of field ob_order_totals
     *
     * @param double $ob_order_totals
     * @return $this
     */
    public function setObOrderTotals($ob_order_totals)
    {
        $this->ob_order_totals = $ob_order_totals;

        return $this;
    }

    /**
     * Method to set the value of field ob_commis_totals
     *
     * @param double $ob_commis_totals
     * @return $this
     */
    public function setObCommisTotals($ob_commis_totals)
    {
        $this->ob_commis_totals = $ob_commis_totals;

        return $this;
    }

    /**
     * Method to set the value of field ob_result_totals
     *
     * @param double $ob_result_totals
     * @return $this
     */
    public function setObResultTotals($ob_result_totals)
    {
        $this->ob_result_totals = $ob_result_totals;

        return $this;
    }

    /**
     * Method to set the value of field ob_create_date
     *
     * @param integer $ob_create_date
     * @return $this
     */
    public function setObCreateDate($ob_create_date)
    {
        $this->ob_create_date = $ob_create_date;

        return $this;
    }

    /**
     * Method to set the value of field os_month
     *
     * @param integer $os_month
     * @return $this
     */
    public function setOsMonth($os_month)
    {
        $this->os_month = $os_month;

        return $this;
    }

    /**
     * Method to set the value of field ob_state
     *
     * @param string $ob_state
     * @return $this
     */
    public function setObState($ob_state)
    {
        $this->ob_state = $ob_state;

        return $this;
    }

    /**
     * Method to set the value of field ob_pay_date
     *
     * @param integer $ob_pay_date
     * @return $this
     */
    public function setObPayDate($ob_pay_date)
    {
        $this->ob_pay_date = $ob_pay_date;

        return $this;
    }

    /**
     * Method to set the value of field ob_pay_content
     *
     * @param string $ob_pay_content
     * @return $this
     */
    public function setObPayContent($ob_pay_content)
    {
        $this->ob_pay_content = $ob_pay_content;

        return $this;
    }

    /**
     * Method to set the value of field ob_store_id
     *
     * @param integer $ob_store_id
     * @return $this
     */
    public function setObStoreId($ob_store_id)
    {
        $this->ob_store_id = $ob_store_id;

        return $this;
    }

    /**
     * Method to set the value of field ob_store_name
     *
     * @param string $ob_store_name
     * @return $this
     */
    public function setObStoreName($ob_store_name)
    {
        $this->ob_store_name = $ob_store_name;

        return $this;
    }

    /**
     * Returns the value of field ob_id
     *
     * @return integer
     */
    public function getObId()
    {
        return $this->ob_id;
    }

    /**
     * Returns the value of field ob_no
     *
     * @return integer
     */
    public function getObNo()
    {
        return $this->ob_no;
    }

    /**
     * Returns the value of field ob_start_date
     *
     * @return integer
     */
    public function getObStartDate()
    {
        return $this->ob_start_date;
    }

    /**
     * Returns the value of field ob_end_date
     *
     * @return integer
     */
    public function getObEndDate()
    {
        return $this->ob_end_date;
    }

    /**
     * Returns the value of field ob_order_totals
     *
     * @return double
     */
    public function getObOrderTotals()
    {
        return $this->ob_order_totals;
    }

    /**
     * Returns the value of field ob_commis_totals
     *
     * @return double
     */
    public function getObCommisTotals()
    {
        return $this->ob_commis_totals;
    }

    /**
     * Returns the value of field ob_result_totals
     *
     * @return double
     */
    public function getObResultTotals()
    {
        return $this->ob_result_totals;
    }

    /**
     * Returns the value of field ob_create_date
     *
     * @return integer
     */
    public function getObCreateDate()
    {
        return $this->ob_create_date;
    }

    /**
     * Returns the value of field os_month
     *
     * @return integer
     */
    public function getOsMonth()
    {
        return $this->os_month;
    }

    /**
     * Returns the value of field ob_state
     *
     * @return string
     */
    public function getObState()
    {
        return $this->ob_state;
    }

    /**
     * Returns the value of field ob_pay_date
     *
     * @return integer
     */
    public function getObPayDate()
    {
        return $this->ob_pay_date;
    }

    /**
     * Returns the value of field ob_pay_content
     *
     * @return string
     */
    public function getObPayContent()
    {
        return $this->ob_pay_content;
    }

    /**
     * Returns the value of field ob_store_id
     *
     * @return integer
     */
    public function getObStoreId()
    {
        return $this->ob_store_id;
    }

    /**
     * Returns the value of field ob_store_name
     *
     * @return string
     */
    public function getObStoreName()
    {
        return $this->ob_store_name;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_order_bill';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrderBill[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrderBill
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
