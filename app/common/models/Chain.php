<?php

namespace Ypk\Models;

class Chain extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $chain_id;

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
    protected $chain_user;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    protected $chain_pwd;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $chain_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $chain_img;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $area_id_1;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $area_id_2;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $area_id_3;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $area_id_4;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $area_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $area_info;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $chain_address;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $chain_phone;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $chain_opening_hours;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $chain_traffic_line;

    /**
     * Method to set the value of field chain_id
     *
     * @param integer $chain_id
     * @return $this
     */
    public function setChainId($chain_id)
    {
        $this->chain_id = $chain_id;

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
     * Method to set the value of field chain_user
     *
     * @param string $chain_user
     * @return $this
     */
    public function setChainUser($chain_user)
    {
        $this->chain_user = $chain_user;

        return $this;
    }

    /**
     * Method to set the value of field chain_pwd
     *
     * @param string $chain_pwd
     * @return $this
     */
    public function setChainPwd($chain_pwd)
    {
        $this->chain_pwd = $chain_pwd;

        return $this;
    }

    /**
     * Method to set the value of field chain_name
     *
     * @param string $chain_name
     * @return $this
     */
    public function setChainName($chain_name)
    {
        $this->chain_name = $chain_name;

        return $this;
    }

    /**
     * Method to set the value of field chain_img
     *
     * @param string $chain_img
     * @return $this
     */
    public function setChainImg($chain_img)
    {
        $this->chain_img = $chain_img;

        return $this;
    }

    /**
     * Method to set the value of field area_id_1
     *
     * @param integer $area_id_1
     * @return $this
     */
    public function setAreaId1($area_id_1)
    {
        $this->area_id_1 = $area_id_1;

        return $this;
    }

    /**
     * Method to set the value of field area_id_2
     *
     * @param integer $area_id_2
     * @return $this
     */
    public function setAreaId2($area_id_2)
    {
        $this->area_id_2 = $area_id_2;

        return $this;
    }

    /**
     * Method to set the value of field area_id_3
     *
     * @param integer $area_id_3
     * @return $this
     */
    public function setAreaId3($area_id_3)
    {
        $this->area_id_3 = $area_id_3;

        return $this;
    }

    /**
     * Method to set the value of field area_id_4
     *
     * @param integer $area_id_4
     * @return $this
     */
    public function setAreaId4($area_id_4)
    {
        $this->area_id_4 = $area_id_4;

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
     * Method to set the value of field chain_address
     *
     * @param string $chain_address
     * @return $this
     */
    public function setChainAddress($chain_address)
    {
        $this->chain_address = $chain_address;

        return $this;
    }

    /**
     * Method to set the value of field chain_phone
     *
     * @param string $chain_phone
     * @return $this
     */
    public function setChainPhone($chain_phone)
    {
        $this->chain_phone = $chain_phone;

        return $this;
    }

    /**
     * Method to set the value of field chain_opening_hours
     *
     * @param string $chain_opening_hours
     * @return $this
     */
    public function setChainOpeningHours($chain_opening_hours)
    {
        $this->chain_opening_hours = $chain_opening_hours;

        return $this;
    }

    /**
     * Method to set the value of field chain_traffic_line
     *
     * @param string $chain_traffic_line
     * @return $this
     */
    public function setChainTrafficLine($chain_traffic_line)
    {
        $this->chain_traffic_line = $chain_traffic_line;

        return $this;
    }

    /**
     * Returns the value of field chain_id
     *
     * @return integer
     */
    public function getChainId()
    {
        return $this->chain_id;
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
     * Returns the value of field chain_user
     *
     * @return string
     */
    public function getChainUser()
    {
        return $this->chain_user;
    }

    /**
     * Returns the value of field chain_pwd
     *
     * @return string
     */
    public function getChainPwd()
    {
        return $this->chain_pwd;
    }

    /**
     * Returns the value of field chain_name
     *
     * @return string
     */
    public function getChainName()
    {
        return $this->chain_name;
    }

    /**
     * Returns the value of field chain_img
     *
     * @return string
     */
    public function getChainImg()
    {
        return $this->chain_img;
    }

    /**
     * Returns the value of field area_id_1
     *
     * @return integer
     */
    public function getAreaId1()
    {
        return $this->area_id_1;
    }

    /**
     * Returns the value of field area_id_2
     *
     * @return integer
     */
    public function getAreaId2()
    {
        return $this->area_id_2;
    }

    /**
     * Returns the value of field area_id_3
     *
     * @return integer
     */
    public function getAreaId3()
    {
        return $this->area_id_3;
    }

    /**
     * Returns the value of field area_id_4
     *
     * @return integer
     */
    public function getAreaId4()
    {
        return $this->area_id_4;
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
     * Returns the value of field area_info
     *
     * @return string
     */
    public function getAreaInfo()
    {
        return $this->area_info;
    }

    /**
     * Returns the value of field chain_address
     *
     * @return string
     */
    public function getChainAddress()
    {
        return $this->chain_address;
    }

    /**
     * Returns the value of field chain_phone
     *
     * @return string
     */
    public function getChainPhone()
    {
        return $this->chain_phone;
    }

    /**
     * Returns the value of field chain_opening_hours
     *
     * @return string
     */
    public function getChainOpeningHours()
    {
        return $this->chain_opening_hours;
    }

    /**
     * Returns the value of field chain_traffic_line
     *
     * @return string
     */
    public function getChainTrafficLine()
    {
        return $this->chain_traffic_line;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'chain';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Chain[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Chain
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
