<?php

namespace Ypk\Models;

class PBundling extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $bl_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $bl_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $bl_discount_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $bl_freight_choose;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $bl_freight;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $bl_state;

    /**
     * Method to set the value of field bl_id
     *
     * @param integer $bl_id
     * @return $this
     */
    public function setBlId($bl_id)
    {
        $this->bl_id = $bl_id;

        return $this;
    }

    /**
     * Method to set the value of field bl_name
     *
     * @param string $bl_name
     * @return $this
     */
    public function setBlName($bl_name)
    {
        $this->bl_name = $bl_name;

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
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field bl_discount_price
     *
     * @param double $bl_discount_price
     * @return $this
     */
    public function setBlDiscountPrice($bl_discount_price)
    {
        $this->bl_discount_price = $bl_discount_price;

        return $this;
    }

    /**
     * Method to set the value of field bl_freight_choose
     *
     * @param integer $bl_freight_choose
     * @return $this
     */
    public function setBlFreightChoose($bl_freight_choose)
    {
        $this->bl_freight_choose = $bl_freight_choose;

        return $this;
    }

    /**
     * Method to set the value of field bl_freight
     *
     * @param double $bl_freight
     * @return $this
     */
    public function setBlFreight($bl_freight)
    {
        $this->bl_freight = $bl_freight;

        return $this;
    }

    /**
     * Method to set the value of field bl_state
     *
     * @param integer $bl_state
     * @return $this
     */
    public function setBlState($bl_state)
    {
        $this->bl_state = $bl_state;

        return $this;
    }

    /**
     * Returns the value of field bl_id
     *
     * @return integer
     */
    public function getBlId()
    {
        return $this->bl_id;
    }

    /**
     * Returns the value of field bl_name
     *
     * @return string
     */
    public function getBlName()
    {
        return $this->bl_name;
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
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field bl_discount_price
     *
     * @return double
     */
    public function getBlDiscountPrice()
    {
        return $this->bl_discount_price;
    }

    /**
     * Returns the value of field bl_freight_choose
     *
     * @return integer
     */
    public function getBlFreightChoose()
    {
        return $this->bl_freight_choose;
    }

    /**
     * Returns the value of field bl_freight
     *
     * @return double
     */
    public function getBlFreight()
    {
        return $this->bl_freight;
    }

    /**
     * Returns the value of field bl_state
     *
     * @return integer
     */
    public function getBlState()
    {
        return $this->bl_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_bundling';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBundling[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBundling
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
