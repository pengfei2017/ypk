<?php

namespace Ypk\Models;

class VoucherPrice extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_price_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $voucher_price_describe;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $voucher_defaultpoints;

    /**
     * Method to set the value of field voucher_price_id
     *
     * @param integer $voucher_price_id
     * @return $this
     */
    public function setVoucherPriceId($voucher_price_id)
    {
        $this->voucher_price_id = $voucher_price_id;

        return $this;
    }

    /**
     * Method to set the value of field voucher_price_describe
     *
     * @param string $voucher_price_describe
     * @return $this
     */
    public function setVoucherPriceDescribe($voucher_price_describe)
    {
        $this->voucher_price_describe = $voucher_price_describe;

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
     * Method to set the value of field voucher_defaultpoints
     *
     * @param integer $voucher_defaultpoints
     * @return $this
     */
    public function setVoucherDefaultpoints($voucher_defaultpoints)
    {
        $this->voucher_defaultpoints = $voucher_defaultpoints;

        return $this;
    }

    /**
     * Returns the value of field voucher_price_id
     *
     * @return integer
     */
    public function getVoucherPriceId()
    {
        return $this->voucher_price_id;
    }

    /**
     * Returns the value of field voucher_price_describe
     *
     * @return string
     */
    public function getVoucherPriceDescribe()
    {
        return $this->voucher_price_describe;
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
     * Returns the value of field voucher_defaultpoints
     *
     * @return integer
     */
    public function getVoucherDefaultpoints()
    {
        return $this->voucher_defaultpoints;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'voucher_price';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return VoucherPrice[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return VoucherPrice
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
