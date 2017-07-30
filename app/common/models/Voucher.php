<?php

namespace Ypk\Models;

class Voucher extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_id;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $voucher_code;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_t_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $voucher_title;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $voucher_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_start_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_end_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $voucher_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $voucher_state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_active_date;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $voucher_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_owner_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $voucher_owner_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $voucher_order_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $voucher_pwd;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $voucher_pwd2;

    /**
     * Method to set the value of field voucher_id
     *
     * @param integer $voucher_id
     * @return $this
     */
    public function setVoucherId($voucher_id)
    {
        $this->voucher_id = $voucher_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_code
     *
     * @param string $voucher_code
     * @return $this
     */
    public function setVoucherCode($voucher_code)
    {
        $this->voucher_code = $voucher_code;

        return $this;
    }

    /**
     * Method to set the value of field voucher_t_id
     *
     * @param integer $voucher_t_id
     * @return $this
     */
    public function setVoucherTId($voucher_t_id)
    {
        $this->voucher_t_id = $voucher_t_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_title
     *
     * @param string $voucher_title
     * @return $this
     */
    public function setVoucherTitle($voucher_title)
    {
        $this->voucher_title = $voucher_title;

        return $this;
    }

    /**
     * Method to set the value of field voucher_desc
     *
     * @param string $voucher_desc
     * @return $this
     */
    public function setVoucherDesc($voucher_desc)
    {
        $this->voucher_desc = $voucher_desc;

        return $this;
    }

    /**
     * Method to set the value of field voucher_start_date
     *
     * @param integer $voucher_start_date
     * @return $this
     */
    public function setVoucherStartDate($voucher_start_date)
    {
        $this->voucher_start_date = $voucher_start_date;

        return $this;
    }

    /**
     * Method to set the value of field voucher_end_date
     *
     * @param integer $voucher_end_date
     * @return $this
     */
    public function setVoucherEndDate($voucher_end_date)
    {
        $this->voucher_end_date = $voucher_end_date;

        return $this;
    }

    /**
     * Method to set the value of field voucher_price
     *
     * @param integer $voucher_price
     * @return $this
     */
    public function setVoucherPrice($voucher_price)
    {
        $this->voucher_price = $voucher_price;

        return $this;
    }

    /**
     * Method to set the value of field voucher_limit
     *
     * @param double $voucher_limit
     * @return $this
     */
    public function setVoucherLimit($voucher_limit)
    {
        $this->voucher_limit = $voucher_limit;

        return $this;
    }

    /**
     * Method to set the value of field voucher_store_id
     *
     * @param integer $voucher_store_id
     * @return $this
     */
    public function setVoucherStoreId($voucher_store_id)
    {
        $this->voucher_store_id = $voucher_store_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_state
     *
     * @param integer $voucher_state
     * @return $this
     */
    public function setVoucherState($voucher_state)
    {
        $this->voucher_state = $voucher_state;

        return $this;
    }

    /**
     * Method to set the value of field voucher_active_date
     *
     * @param integer $voucher_active_date
     * @return $this
     */
    public function setVoucherActiveDate($voucher_active_date)
    {
        $this->voucher_active_date = $voucher_active_date;

        return $this;
    }

    /**
     * Method to set the value of field voucher_type
     *
     * @param integer $voucher_type
     * @return $this
     */
    public function setVoucherType($voucher_type)
    {
        $this->voucher_type = $voucher_type;

        return $this;
    }

    /**
     * Method to set the value of field voucher_owner_id
     *
     * @param integer $voucher_owner_id
     * @return $this
     */
    public function setVoucherOwnerId($voucher_owner_id)
    {
        $this->voucher_owner_id = $voucher_owner_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_owner_name
     *
     * @param string $voucher_owner_name
     * @return $this
     */
    public function setVoucherOwnerName($voucher_owner_name)
    {
        $this->voucher_owner_name = $voucher_owner_name;

        return $this;
    }

    /**
     * Method to set the value of field voucher_order_id
     *
     * @param integer $voucher_order_id
     * @return $this
     */
    public function setVoucherOrderId($voucher_order_id)
    {
        $this->voucher_order_id = $voucher_order_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_pwd
     *
     * @param string $voucher_pwd
     * @return $this
     */
    public function setVoucherPwd($voucher_pwd)
    {
        $this->voucher_pwd = $voucher_pwd;

        return $this;
    }

    /**
     * Method to set the value of field voucher_pwd2
     *
     * @param string $voucher_pwd2
     * @return $this
     */
    public function setVoucherPwd2($voucher_pwd2)
    {
        $this->voucher_pwd2 = $voucher_pwd2;

        return $this;
    }

    /**
     * Returns the value of field voucher_id
     *
     * @return integer
     */
    public function getVoucherId()
    {
        return $this->voucher_id;
    }

    /**
     * Returns the value of field voucher_code
     *
     * @return string
     */
    public function getVoucherCode()
    {
        return $this->voucher_code;
    }

    /**
     * Returns the value of field voucher_t_id
     *
     * @return integer
     */
    public function getVoucherTId()
    {
        return $this->voucher_t_id;
    }

    /**
     * Returns the value of field voucher_title
     *
     * @return string
     */
    public function getVoucherTitle()
    {
        return $this->voucher_title;
    }

    /**
     * Returns the value of field voucher_desc
     *
     * @return string
     */
    public function getVoucherDesc()
    {
        return $this->voucher_desc;
    }

    /**
     * Returns the value of field voucher_start_date
     *
     * @return integer
     */
    public function getVoucherStartDate()
    {
        return $this->voucher_start_date;
    }

    /**
     * Returns the value of field voucher_end_date
     *
     * @return integer
     */
    public function getVoucherEndDate()
    {
        return $this->voucher_end_date;
    }

    /**
     * Returns the value of field voucher_price
     *
     * @return integer
     */
    public function getVoucherPrice()
    {
        return $this->voucher_price;
    }

    /**
     * Returns the value of field voucher_limit
     *
     * @return double
     */
    public function getVoucherLimit()
    {
        return $this->voucher_limit;
    }

    /**
     * Returns the value of field voucher_store_id
     *
     * @return integer
     */
    public function getVoucherStoreId()
    {
        return $this->voucher_store_id;
    }

    /**
     * Returns the value of field voucher_state
     *
     * @return integer
     */
    public function getVoucherState()
    {
        return $this->voucher_state;
    }

    /**
     * Returns the value of field voucher_active_date
     *
     * @return integer
     */
    public function getVoucherActiveDate()
    {
        return $this->voucher_active_date;
    }

    /**
     * Returns the value of field voucher_type
     *
     * @return integer
     */
    public function getVoucherType()
    {
        return $this->voucher_type;
    }

    /**
     * Returns the value of field voucher_owner_id
     *
     * @return integer
     */
    public function getVoucherOwnerId()
    {
        return $this->voucher_owner_id;
    }

    /**
     * Returns the value of field voucher_owner_name
     *
     * @return string
     */
    public function getVoucherOwnerName()
    {
        return $this->voucher_owner_name;
    }

    /**
     * Returns the value of field voucher_order_id
     *
     * @return integer
     */
    public function getVoucherOrderId()
    {
        return $this->voucher_order_id;
    }

    /**
     * Returns the value of field voucher_pwd
     *
     * @return string
     */
    public function getVoucherPwd()
    {
        return $this->voucher_pwd;
    }

    /**
     * Returns the value of field voucher_pwd2
     *
     * @return string
     */
    public function getVoucherPwd2()
    {
        return $this->voucher_pwd2;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'voucher';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Voucher[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Voucher
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
