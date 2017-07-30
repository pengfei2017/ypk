<?php

namespace Ypk\Models;

class StoreMap extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $map_id;

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
    protected $sc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $name_info;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=false)
     */
    protected $address_info;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $phone_info;

    /**
     *
     * @var string
     * @Column(type="string", length=250, nullable=true)
     */
    protected $bus_info;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $update_time;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $baidu_lng;

    /**
     *
     * @var double
     * @Column(type="double", nullable=false)
     */
    protected $baidu_lat;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $baidu_province;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $baidu_city;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=false)
     */
    protected $baidu_district;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=true)
     */
    protected $baidu_street;

    /**
     * Method to set the value of field map_id
     *
     * @param integer $map_id
     * @return $this
     */
    public function setMapId($map_id)
    {
        $this->map_id = $map_id;

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
     * Method to set the value of field sc_id
     *
     * @param integer $sc_id
     * @return $this
     */
    public function setScId($sc_id)
    {
        $this->sc_id = $sc_id;

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
     * Method to set the value of field name_info
     *
     * @param string $name_info
     * @return $this
     */
    public function setNameInfo($name_info)
    {
        $this->name_info = $name_info;

        return $this;
    }

    /**
     * Method to set the value of field address_info
     *
     * @param string $address_info
     * @return $this
     */
    public function setAddressInfo($address_info)
    {
        $this->address_info = $address_info;

        return $this;
    }

    /**
     * Method to set the value of field phone_info
     *
     * @param string $phone_info
     * @return $this
     */
    public function setPhoneInfo($phone_info)
    {
        $this->phone_info = $phone_info;

        return $this;
    }

    /**
     * Method to set the value of field bus_info
     *
     * @param string $bus_info
     * @return $this
     */
    public function setBusInfo($bus_info)
    {
        $this->bus_info = $bus_info;

        return $this;
    }

    /**
     * Method to set the value of field update_time
     *
     * @param integer $update_time
     * @return $this
     */
    public function setUpdateTime($update_time)
    {
        $this->update_time = $update_time;

        return $this;
    }

    /**
     * Method to set the value of field baidu_lng
     *
     * @param double $baidu_lng
     * @return $this
     */
    public function setBaiduLng($baidu_lng)
    {
        $this->baidu_lng = $baidu_lng;

        return $this;
    }

    /**
     * Method to set the value of field baidu_lat
     *
     * @param double $baidu_lat
     * @return $this
     */
    public function setBaiduLat($baidu_lat)
    {
        $this->baidu_lat = $baidu_lat;

        return $this;
    }

    /**
     * Method to set the value of field baidu_province
     *
     * @param string $baidu_province
     * @return $this
     */
    public function setBaiduProvince($baidu_province)
    {
        $this->baidu_province = $baidu_province;

        return $this;
    }

    /**
     * Method to set the value of field baidu_city
     *
     * @param string $baidu_city
     * @return $this
     */
    public function setBaiduCity($baidu_city)
    {
        $this->baidu_city = $baidu_city;

        return $this;
    }

    /**
     * Method to set the value of field baidu_district
     *
     * @param string $baidu_district
     * @return $this
     */
    public function setBaiduDistrict($baidu_district)
    {
        $this->baidu_district = $baidu_district;

        return $this;
    }

    /**
     * Method to set the value of field baidu_street
     *
     * @param string $baidu_street
     * @return $this
     */
    public function setBaiduStreet($baidu_street)
    {
        $this->baidu_street = $baidu_street;

        return $this;
    }

    /**
     * Returns the value of field map_id
     *
     * @return integer
     */
    public function getMapId()
    {
        return $this->map_id;
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
     * Returns the value of field sc_id
     *
     * @return integer
     */
    public function getScId()
    {
        return $this->sc_id;
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
     * Returns the value of field name_info
     *
     * @return string
     */
    public function getNameInfo()
    {
        return $this->name_info;
    }

    /**
     * Returns the value of field address_info
     *
     * @return string
     */
    public function getAddressInfo()
    {
        return $this->address_info;
    }

    /**
     * Returns the value of field phone_info
     *
     * @return string
     */
    public function getPhoneInfo()
    {
        return $this->phone_info;
    }

    /**
     * Returns the value of field bus_info
     *
     * @return string
     */
    public function getBusInfo()
    {
        return $this->bus_info;
    }

    /**
     * Returns the value of field update_time
     *
     * @return integer
     */
    public function getUpdateTime()
    {
        return $this->update_time;
    }

    /**
     * Returns the value of field baidu_lng
     *
     * @return double
     */
    public function getBaiduLng()
    {
        return $this->baidu_lng;
    }

    /**
     * Returns the value of field baidu_lat
     *
     * @return double
     */
    public function getBaiduLat()
    {
        return $this->baidu_lat;
    }

    /**
     * Returns the value of field baidu_province
     *
     * @return string
     */
    public function getBaiduProvince()
    {
        return $this->baidu_province;
    }

    /**
     * Returns the value of field baidu_city
     *
     * @return string
     */
    public function getBaiduCity()
    {
        return $this->baidu_city;
    }

    /**
     * Returns the value of field baidu_district
     *
     * @return string
     */
    public function getBaiduDistrict()
    {
        return $this->baidu_district;
    }

    /**
     * Returns the value of field baidu_street
     *
     * @return string
     */
    public function getBaiduStreet()
    {
        return $this->baidu_street;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_map';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMap[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreMap
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
