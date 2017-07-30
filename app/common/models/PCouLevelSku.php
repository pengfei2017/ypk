<?php

namespace Ypk\Models;

class PCouLevelSku extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $cou_id;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $xlevel;

    /**
     *
     * @var integer
     * @Primary
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $sku_id;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $price;

    /**
     * Method to set the value of field cou_id
     *
     * @param integer $cou_id
     * @return $this
     */
    public function setCouId($cou_id)
    {
        $this->cou_id = $cou_id;

        return $this;
    }

    /**
     * Method to set the value of field xlevel
     *
     * @param integer $xlevel
     * @return $this
     */
    public function setXlevel($xlevel)
    {
        $this->xlevel = $xlevel;

        return $this;
    }

    /**
     * Method to set the value of field sku_id
     *
     * @param integer $sku_id
     * @return $this
     */
    public function setSkuId($sku_id)
    {
        $this->sku_id = $sku_id;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Returns the value of field cou_id
     *
     * @return integer
     */
    public function getCouId()
    {
        return $this->cou_id;
    }

    /**
     * Returns the value of field xlevel
     *
     * @return integer
     */
    public function getXlevel()
    {
        return $this->xlevel;
    }

    /**
     * Returns the value of field sku_id
     *
     * @return integer
     */
    public function getSkuId()
    {
        return $this->sku_id;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_cou_level_sku';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouLevelSku[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PCouLevelSku
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
