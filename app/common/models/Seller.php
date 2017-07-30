<?php

namespace Ypk\Models;

class Seller extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $seller_id;

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
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $seller_group_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_admin;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $seller_quicklink;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $last_login_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_client;

    /**
     * Method to set the value of field seller_id
     *
     * @param integer $seller_id
     * @return $this
     */
    public function setSellerId($seller_id)
    {
        $this->seller_id = $seller_id;

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
     * Method to set the value of field seller_group_id
     *
     * @param integer $seller_group_id
     * @return $this
     */
    public function setSellerGroupId($seller_group_id)
    {
        $this->seller_group_id = $seller_group_id;

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
     * Method to set the value of field is_admin
     *
     * @param integer $is_admin
     * @return $this
     */
    public function setIsAdmin($is_admin)
    {
        $this->is_admin = $is_admin;

        return $this;
    }

    /**
     * Method to set the value of field seller_quicklink
     *
     * @param string $seller_quicklink
     * @return $this
     */
    public function setSellerQuicklink($seller_quicklink)
    {
        $this->seller_quicklink = $seller_quicklink;

        return $this;
    }

    /**
     * Method to set the value of field last_login_time
     *
     * @param integer $last_login_time
     * @return $this
     */
    public function setLastLoginTime($last_login_time)
    {
        $this->last_login_time = $last_login_time;

        return $this;
    }

    /**
     * Method to set the value of field is_client
     *
     * @param integer $is_client
     * @return $this
     */
    public function setIsClient($is_client)
    {
        $this->is_client = $is_client;

        return $this;
    }

    /**
     * Returns the value of field seller_id
     *
     * @return integer
     */
    public function getSellerId()
    {
        return $this->seller_id;
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
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field seller_group_id
     *
     * @return integer
     */
    public function getSellerGroupId()
    {
        return $this->seller_group_id;
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
     * Returns the value of field is_admin
     *
     * @return integer
     */
    public function getIsAdmin()
    {
        return $this->is_admin;
    }

    /**
     * Returns the value of field seller_quicklink
     *
     * @return string
     */
    public function getSellerQuicklink()
    {
        return $this->seller_quicklink;
    }

    /**
     * Returns the value of field last_login_time
     *
     * @return integer
     */
    public function getLastLoginTime()
    {
        return $this->last_login_time;
    }

    /**
     * Returns the value of field is_client
     *
     * @return integer
     */
    public function getIsClient()
    {
        return $this->is_client;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'seller';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Seller[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Seller
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
