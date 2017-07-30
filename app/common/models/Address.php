<?php

namespace Ypk\Models;

class Address extends \Phalcon\Mvc\Model
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
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $true_name;

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
     * @Column(type="string", length=255, nullable=false)
     */
    protected $area_info;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $address;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $tel_phone;

    /**
     *
     * @var string
     * @Column(type="string", length=15, nullable=true)
     */
    protected $mob_phone;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $is_default;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $dlyp_id;

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
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field true_name
     *
     * @param string $true_name
     * @return $this
     */
    public function setTrueName($true_name)
    {
        $this->true_name = $true_name;

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
     * Method to set the value of field tel_phone
     *
     * @param string $tel_phone
     * @return $this
     */
    public function setTelPhone($tel_phone)
    {
        $this->tel_phone = $tel_phone;

        return $this;
    }

    /**
     * Method to set the value of field mob_phone
     *
     * @param string $mob_phone
     * @return $this
     */
    public function setMobPhone($mob_phone)
    {
        $this->mob_phone = $mob_phone;

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
     * Method to set the value of field dlyp_id
     *
     * @param integer $dlyp_id
     * @return $this
     */
    public function setDlypId($dlyp_id)
    {
        $this->dlyp_id = $dlyp_id;

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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field true_name
     *
     * @return string
     */
    public function getTrueName()
    {
        return $this->true_name;
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
     * Returns the value of field tel_phone
     *
     * @return string
     */
    public function getTelPhone()
    {
        return $this->tel_phone;
    }

    /**
     * Returns the value of field mob_phone
     *
     * @return string
     */
    public function getMobPhone()
    {
        return $this->mob_phone;
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
     * Returns the value of field dlyp_id
     *
     * @return integer
     */
    public function getDlypId()
    {
        return $this->dlyp_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'address';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Address[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Address
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
