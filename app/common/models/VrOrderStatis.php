<?php

namespace Ypk\Models;

class VrOrderStatis extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=9, nullable=false)
     */
    protected $os_month;

    /**
     *
     * @var integer
     * @Column(type="integer", length=6, nullable=true)
     */
    protected $os_year;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $os_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $os_end_date;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $os_order_totals;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $os_commis_totals;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $os_result_totals;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $os_create_date;

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
     * Method to set the value of field os_year
     *
     * @param integer $os_year
     * @return $this
     */
    public function setOsYear($os_year)
    {
        $this->os_year = $os_year;

        return $this;
    }

    /**
     * Method to set the value of field os_start_date
     *
     * @param integer $os_start_date
     * @return $this
     */
    public function setOsStartDate($os_start_date)
    {
        $this->os_start_date = $os_start_date;

        return $this;
    }

    /**
     * Method to set the value of field os_end_date
     *
     * @param integer $os_end_date
     * @return $this
     */
    public function setOsEndDate($os_end_date)
    {
        $this->os_end_date = $os_end_date;

        return $this;
    }

    /**
     * Method to set the value of field os_order_totals
     *
     * @param double $os_order_totals
     * @return $this
     */
    public function setOsOrderTotals($os_order_totals)
    {
        $this->os_order_totals = $os_order_totals;

        return $this;
    }

    /**
     * Method to set the value of field os_commis_totals
     *
     * @param double $os_commis_totals
     * @return $this
     */
    public function setOsCommisTotals($os_commis_totals)
    {
        $this->os_commis_totals = $os_commis_totals;

        return $this;
    }

    /**
     * Method to set the value of field os_result_totals
     *
     * @param double $os_result_totals
     * @return $this
     */
    public function setOsResultTotals($os_result_totals)
    {
        $this->os_result_totals = $os_result_totals;

        return $this;
    }

    /**
     * Method to set the value of field os_create_date
     *
     * @param integer $os_create_date
     * @return $this
     */
    public function setOsCreateDate($os_create_date)
    {
        $this->os_create_date = $os_create_date;

        return $this;
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
     * Returns the value of field os_year
     *
     * @return integer
     */
    public function getOsYear()
    {
        return $this->os_year;
    }

    /**
     * Returns the value of field os_start_date
     *
     * @return integer
     */
    public function getOsStartDate()
    {
        return $this->os_start_date;
    }

    /**
     * Returns the value of field os_end_date
     *
     * @return integer
     */
    public function getOsEndDate()
    {
        return $this->os_end_date;
    }

    /**
     * Returns the value of field os_order_totals
     *
     * @return double
     */
    public function getOsOrderTotals()
    {
        return $this->os_order_totals;
    }

    /**
     * Returns the value of field os_commis_totals
     *
     * @return double
     */
    public function getOsCommisTotals()
    {
        return $this->os_commis_totals;
    }

    /**
     * Returns the value of field os_result_totals
     *
     * @return double
     */
    public function getOsResultTotals()
    {
        return $this->os_result_totals;
    }

    /**
     * Returns the value of field os_create_date
     *
     * @return integer
     */
    public function getOsCreateDate()
    {
        return $this->os_create_date;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'vr_order_statis';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrderStatis[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VrOrderStatis
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
