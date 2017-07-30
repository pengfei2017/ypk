<?php

namespace Ypk\Models;

class StoreWaybill extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_waybill_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $express_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $waybill_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $waybill_name;

    /**
     *
     * @var string
     * @Column(type="string", length=2000, nullable=true)
     */
    protected $store_waybill_data;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_default;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_waybill_left;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_waybill_top;

    /**
     * Method to set the value of field store_waybill_id
     *
     * @param integer $store_waybill_id
     * @return $this
     */
    public function setStoreWaybillId($store_waybill_id)
    {
        $this->store_waybill_id = $store_waybill_id;

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
     * Method to set the value of field express_id
     *
     * @param integer $express_id
     * @return $this
     */
    public function setExpressId($express_id)
    {
        $this->express_id = $express_id;

        return $this;
    }

    /**
     * Method to set the value of field waybill_id
     *
     * @param integer $waybill_id
     * @return $this
     */
    public function setWaybillId($waybill_id)
    {
        $this->waybill_id = $waybill_id;

        return $this;
    }

    /**
     * Method to set the value of field waybill_name
     *
     * @param string $waybill_name
     * @return $this
     */
    public function setWaybillName($waybill_name)
    {
        $this->waybill_name = $waybill_name;

        return $this;
    }

    /**
     * Method to set the value of field store_waybill_data
     *
     * @param string $store_waybill_data
     * @return $this
     */
    public function setStoreWaybillData($store_waybill_data)
    {
        $this->store_waybill_data = $store_waybill_data;

        return $this;
    }

    /**
     * Method to set the value of field is_default
     *
     * @param integer $is_default
     * @return $this
     */
    public function setIsDefault($is_default)
    {
        $this->is_default = $is_default;

        return $this;
    }

    /**
     * Method to set the value of field store_waybill_left
     *
     * @param integer $store_waybill_left
     * @return $this
     */
    public function setStoreWaybillLeft($store_waybill_left)
    {
        $this->store_waybill_left = $store_waybill_left;

        return $this;
    }

    /**
     * Method to set the value of field store_waybill_top
     *
     * @param integer $store_waybill_top
     * @return $this
     */
    public function setStoreWaybillTop($store_waybill_top)
    {
        $this->store_waybill_top = $store_waybill_top;

        return $this;
    }

    /**
     * Returns the value of field store_waybill_id
     *
     * @return integer
     */
    public function getStoreWaybillId()
    {
        return $this->store_waybill_id;
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
     * Returns the value of field express_id
     *
     * @return integer
     */
    public function getExpressId()
    {
        return $this->express_id;
    }

    /**
     * Returns the value of field waybill_id
     *
     * @return integer
     */
    public function getWaybillId()
    {
        return $this->waybill_id;
    }

    /**
     * Returns the value of field waybill_name
     *
     * @return string
     */
    public function getWaybillName()
    {
        return $this->waybill_name;
    }

    /**
     * Returns the value of field store_waybill_data
     *
     * @return string
     */
    public function getStoreWaybillData()
    {
        return $this->store_waybill_data;
    }

    /**
     * Returns the value of field is_default
     *
     * @return integer
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Returns the value of field store_waybill_left
     *
     * @return integer
     */
    public function getStoreWaybillLeft()
    {
        return $this->store_waybill_left;
    }

    /**
     * Returns the value of field store_waybill_top
     *
     * @return integer
     */
    public function getStoreWaybillTop()
    {
        return $this->store_waybill_top;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_waybill';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreWaybill[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreWaybill
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
