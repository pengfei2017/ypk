<?php

namespace Ypk\Models;

class Waybill extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
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
     * @Column(type="string", length=50, nullable=false)
     */
    protected $waybill_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $waybill_width;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $waybill_height;

    /**
     *
     * @var string
     * @Column(type="string", length=2000, nullable=true)
     */
    protected $waybill_data;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $waybill_usable;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $waybill_top;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $waybill_left;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $express_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $express_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $store_id;

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
     * Method to set the value of field waybill_image
     *
     * @param string $waybill_image
     * @return $this
     */
    public function setWaybillImage($waybill_image)
    {
        $this->waybill_image = $waybill_image;

        return $this;
    }

    /**
     * Method to set the value of field waybill_width
     *
     * @param integer $waybill_width
     * @return $this
     */
    public function setWaybillWidth($waybill_width)
    {
        $this->waybill_width = $waybill_width;

        return $this;
    }

    /**
     * Method to set the value of field waybill_height
     *
     * @param integer $waybill_height
     * @return $this
     */
    public function setWaybillHeight($waybill_height)
    {
        $this->waybill_height = $waybill_height;

        return $this;
    }

    /**
     * Method to set the value of field waybill_data
     *
     * @param string $waybill_data
     * @return $this
     */
    public function setWaybillData($waybill_data)
    {
        $this->waybill_data = $waybill_data;

        return $this;
    }

    /**
     * Method to set the value of field waybill_usable
     *
     * @param integer $waybill_usable
     * @return $this
     */
    public function setWaybillUsable($waybill_usable)
    {
        $this->waybill_usable = $waybill_usable;

        return $this;
    }

    /**
     * Method to set the value of field waybill_top
     *
     * @param integer $waybill_top
     * @return $this
     */
    public function setWaybillTop($waybill_top)
    {
        $this->waybill_top = $waybill_top;

        return $this;
    }

    /**
     * Method to set the value of field waybill_left
     *
     * @param integer $waybill_left
     * @return $this
     */
    public function setWaybillLeft($waybill_left)
    {
        $this->waybill_left = $waybill_left;

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
     * Method to set the value of field express_name
     *
     * @param string $express_name
     * @return $this
     */
    public function setExpressName($express_name)
    {
        $this->express_name = $express_name;

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
     * Returns the value of field waybill_image
     *
     * @return string
     */
    public function getWaybillImage()
    {
        return $this->waybill_image;
    }

    /**
     * Returns the value of field waybill_width
     *
     * @return integer
     */
    public function getWaybillWidth()
    {
        return $this->waybill_width;
    }

    /**
     * Returns the value of field waybill_height
     *
     * @return integer
     */
    public function getWaybillHeight()
    {
        return $this->waybill_height;
    }

    /**
     * Returns the value of field waybill_data
     *
     * @return string
     */
    public function getWaybillData()
    {
        return $this->waybill_data;
    }

    /**
     * Returns the value of field waybill_usable
     *
     * @return integer
     */
    public function getWaybillUsable()
    {
        return $this->waybill_usable;
    }

    /**
     * Returns the value of field waybill_top
     *
     * @return integer
     */
    public function getWaybillTop()
    {
        return $this->waybill_top;
    }

    /**
     * Returns the value of field waybill_left
     *
     * @return integer
     */
    public function getWaybillLeft()
    {
        return $this->waybill_left;
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
     * Returns the value of field express_name
     *
     * @return string
     */
    public function getExpressName()
    {
        return $this->express_name;
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
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'waybill';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Waybill[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Waybill
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
