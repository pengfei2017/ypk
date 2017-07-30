<?php

namespace Ypk\Models;

class Daddress extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $address_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $seller_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $area_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $city_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $area_info;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $address;

    /**
     *
     * @var string
     * @Column(type="string", length=40, nullable=true)
     */
    protected $telphone;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $company;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $is_default;

    /**
     * Method to set the value of field address_id
     *
     * @param integer $address_id
     * @return $this
     */
    public function setAddressId($address_id)
    {
        $this->address_id = $address_id;

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
     * Method to set the value of field seller_name
     *
     * @param string $seller_name
     * @return $this
     */
    public function setSellerName($seller_name)
    {
        $this->seller_name = $seller_name;

        return $this;
    }

    /**
     * Method to set the value of field area_id
     *
     * @param integer $area_id
     * @return $this
     */
    public function setAreaId($area_id)
    {
        $this->area_id = $area_id;

        return $this;
    }

    /**
     * Method to set the value of field city_id
     *
     * @param integer $city_id
     * @return $this
     */
    public function setCityId($city_id)
    {
        $this->city_id = $city_id;

        return $this;
    }

    /**
     * Method to set the value of field area_info
     *
     * @param string $area_info
     * @return $this
     */
    public function setAreaInfo($area_info)
    {
        $this->area_info = $area_info;

        return $this;
    }

    /**
     * Method to set the value of field address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Method to set the value of field telphone
     *
     * @param string $telphone
     * @return $this
     */
    public function setTelphone($telphone)
    {
        $this->telphone = $telphone;

        return $this;
    }

    /**
     * Method to set the value of field company
     *
     * @param string $company
     * @return $this
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Method to set the value of field is_default
     *
     * @param string $is_default
     * @return $this
     */
    public function setIsDefault($is_default)
    {
        $this->is_default = $is_default;

        return $this;
    }

    /**
     * Returns the value of field address_id
     *
     * @return integer
     */
    public function getAddressId()
    {
        return $this->address_id;
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
     * Returns the value of field seller_name
     *
     * @return string
     */
    public function getSellerName()
    {
        return $this->seller_name;
    }

    /**
     * Returns the value of field area_id
     *
     * @return integer
     */
    public function getAreaId()
    {
        return $this->area_id;
    }

    /**
     * Returns the value of field city_id
     *
     * @return integer
     */
    public function getCityId()
    {
        return $this->city_id;
    }

    /**
     * Returns the value of field area_info
     *
     * @return string
     */
    public function getAreaInfo()
    {
        return $this->area_info;
    }

    /**
     * Returns the value of field address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Returns the value of field telphone
     *
     * @return string
     */
    public function getTelphone()
    {
        return $this->telphone;
    }

    /**
     * Returns the value of field company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Returns the value of field is_default
     *
     * @return string
     */
    public function getIsDefault()
    {
        return $this->is_default;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'daddress';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Daddress[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Daddress
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
