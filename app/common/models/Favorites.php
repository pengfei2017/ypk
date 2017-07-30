<?php

namespace Ypk\Models;

class Favorites extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $log_id;

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
    protected $member_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $fav_id;

    /**
     *
     * @var string
     * @Column(type="string", length=5, nullable=false)
     */
    protected $fav_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $fav_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $sc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $goods_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $gc_id;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=true)
     */
    protected $log_price;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $log_msg;

    /**
     * Method to set the value of field log_id
     *
     * @param integer $log_id
     * @return $this
     */
    public function setLogId($log_id)
    {
        $this->log_id = $log_id;

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
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Method to set the value of field fav_id
     *
     * @param integer $fav_id
     * @return $this
     */
    public function setFavId($fav_id)
    {
        $this->fav_id = $fav_id;

        return $this;
    }

    /**
     * Method to set the value of field fav_type
     *
     * @param string $fav_type
     * @return $this
     */
    public function setFavType($fav_type)
    {
        $this->fav_type = $fav_type;

        return $this;
    }

    /**
     * Method to set the value of field fav_time
     *
     * @param integer $fav_time
     * @return $this
     */
    public function setFavTime($fav_time)
    {
        $this->fav_time = $fav_time;

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
     * Method to set the value of field goods_name
     *
     * @param string $goods_name
     * @return $this
     */
    public function setGoodsName($goods_name)
    {
        $this->goods_name = $goods_name;

        return $this;
    }

    /**
     * Method to set the value of field goods_image
     *
     * @param string $goods_image
     * @return $this
     */
    public function setGoodsImage($goods_image)
    {
        $this->goods_image = $goods_image;

        return $this;
    }

    /**
     * Method to set the value of field gc_id
     *
     * @param integer $gc_id
     * @return $this
     */
    public function setGcId($gc_id)
    {
        $this->gc_id = $gc_id;

        return $this;
    }

    /**
     * Method to set the value of field log_price
     *
     * @param double $log_price
     * @return $this
     */
    public function setLogPrice($log_price)
    {
        $this->log_price = $log_price;

        return $this;
    }

    /**
     * Method to set the value of field log_msg
     *
     * @param string $log_msg
     * @return $this
     */
    public function setLogMsg($log_msg)
    {
        $this->log_msg = $log_msg;

        return $this;
    }

    /**
     * Returns the value of field log_id
     *
     * @return integer
     */
    public function getLogId()
    {
        return $this->log_id;
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
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field fav_id
     *
     * @return integer
     */
    public function getFavId()
    {
        return $this->fav_id;
    }

    /**
     * Returns the value of field fav_type
     *
     * @return string
     */
    public function getFavType()
    {
        return $this->fav_type;
    }

    /**
     * Returns the value of field fav_time
     *
     * @return integer
     */
    public function getFavTime()
    {
        return $this->fav_time;
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
     * Returns the value of field sc_id
     *
     * @return integer
     */
    public function getScId()
    {
        return $this->sc_id;
    }

    /**
     * Returns the value of field goods_name
     *
     * @return string
     */
    public function getGoodsName()
    {
        return $this->goods_name;
    }

    /**
     * Returns the value of field goods_image
     *
     * @return string
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * Returns the value of field gc_id
     *
     * @return integer
     */
    public function getGcId()
    {
        return $this->gc_id;
    }

    /**
     * Returns the value of field log_price
     *
     * @return double
     */
    public function getLogPrice()
    {
        return $this->log_price;
    }

    /**
     * Returns the value of field log_msg
     *
     * @return string
     */
    public function getLogMsg()
    {
        return $this->log_msg;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'favorites';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Favorites[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Favorites
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
