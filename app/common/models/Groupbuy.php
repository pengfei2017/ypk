<?php

namespace Ypk\Models;

class Groupbuy extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $groupbuy_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $groupbuy_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $end_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_commonid;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $goods_name;

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
    protected $store_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $groupbuy_price;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $groupbuy_rebate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $virtual_quantity;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $upper_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $buyer_count;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $buy_quantity;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $groupbuy_intro;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $recommended;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $views;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $s_class_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $groupbuy_image;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $groupbuy_image1;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $remark;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_vr;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_city_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_area_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_mall_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $vr_s_class_id;

    /**
     * Method to set the value of field groupbuy_id
     *
     * @param integer $groupbuy_id
     * @return $this
     */
    public function setGroupbuyId($groupbuy_id)
    {
        $this->groupbuy_id = $groupbuy_id;

        return $this;
    }

    /**
     * Method to set the value of field groupbuy_name
     *
     * @param string $groupbuy_name
     * @return $this
     */
    public function setGroupbuyName($groupbuy_name)
    {
        $this->groupbuy_name = $groupbuy_name;

        return $this;
    }

    /**
     * Method to set the value of field start_time
     *
     * @param integer $start_time
     * @return $this
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * Method to set the value of field end_time
     *
     * @param integer $end_time
     * @return $this
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;

        return $this;
    }

    /**
     * Method to set the value of field goods_id
     *
     * @param integer $goods_id
     * @return $this
     */
    public function setGoodsId($goods_id)
    {
        $this->goods_id = $goods_id;

        return $this;
    }

    /**
     * Method to set the value of field goods_commonid
     *
     * @param integer $goods_commonid
     * @return $this
     */
    public function setGoodsCommonid($goods_commonid)
    {
        $this->goods_commonid = $goods_commonid;

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
     * Method to set the value of field goods_price
     *
     * @param double $goods_price
     * @return $this
     */
    public function setGoodsPrice($goods_price)
    {
        $this->goods_price = $goods_price;

        return $this;
    }

    /**
     * Method to set the value of field groupbuy_price
     *
     * @param double $groupbuy_price
     * @return $this
     */
    public function setGroupbuyPrice($groupbuy_price)
    {
        $this->groupbuy_price = $groupbuy_price;

        return $this;
    }

    /**
     * Method to set the value of field groupbuy_rebate
     *
     * @param double $groupbuy_rebate
     * @return $this
     */
    public function setGroupbuyRebate($groupbuy_rebate)
    {
        $this->groupbuy_rebate = $groupbuy_rebate;

        return $this;
    }

    /**
     * Method to set the value of field virtual_quantity
     *
     * @param integer $virtual_quantity
     * @return $this
     */
    public function setVirtualQuantity($virtual_quantity)
    {
        $this->virtual_quantity = $virtual_quantity;

        return $this;
    }

    /**
     * Method to set the value of field upper_limit
     *
     * @param integer $upper_limit
     * @return $this
     */
    public function setUpperLimit($upper_limit)
    {
        $this->upper_limit = $upper_limit;

        return $this;
    }

    /**
     * Method to set the value of field buyer_count
     *
     * @param integer $buyer_count
     * @return $this
     */
    public function setBuyerCount($buyer_count)
    {
        $this->buyer_count = $buyer_count;

        return $this;
    }

    /**
     * Method to set the value of field buy_quantity
     *
     * @param integer $buy_quantity
     * @return $this
     */
    public function setBuyQuantity($buy_quantity)
    {
        $this->buy_quantity = $buy_quantity;

        return $this;
    }

    /**
     * Method to set the value of field groupbuy_intro
     *
     * @param string $groupbuy_intro
     * @return $this
     */
    public function setGroupbuyIntro($groupbuy_intro)
    {
        $this->groupbuy_intro = $groupbuy_intro;

        return $this;
    }

    /**
     * Method to set the value of field state
     *
     * @param integer $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Method to set the value of field recommended
     *
     * @param integer $recommended
     * @return $this
     */
    public function setRecommended($recommended)
    {
        $this->recommended = $recommended;

        return $this;
    }

    /**
     * Method to set the value of field views
     *
     * @param integer $views
     * @return $this
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Method to set the value of field class_id
     *
     * @param integer $class_id
     * @return $this
     */
    public function setClassId($class_id)
    {
        $this->class_id = $class_id;

        return $this;
    }

    /**
     * Method to set the value of field s_class_id
     *
     * @param integer $s_class_id
     * @return $this
     */
    public function setSClassId($s_class_id)
    {
        $this->s_class_id = $s_class_id;

        return $this;
    }

    /**
     * Method to set the value of field groupbuy_image
     *
     * @param string $groupbuy_image
     * @return $this
     */
    public function setGroupbuyImage($groupbuy_image)
    {
        $this->groupbuy_image = $groupbuy_image;

        return $this;
    }

    /**
     * Method to set the value of field groupbuy_image1
     *
     * @param string $groupbuy_image1
     * @return $this
     */
    public function setGroupbuyImage1($groupbuy_image1)
    {
        $this->groupbuy_image1 = $groupbuy_image1;

        return $this;
    }

    /**
     * Method to set the value of field remark
     *
     * @param string $remark
     * @return $this
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Method to set the value of field is_vr
     *
     * @param integer $is_vr
     * @return $this
     */
    public function setIsVr($is_vr)
    {
        $this->is_vr = $is_vr;

        return $this;
    }

    /**
     * Method to set the value of field vr_city_id
     *
     * @param integer $vr_city_id
     * @return $this
     */
    public function setVrCityId($vr_city_id)
    {
        $this->vr_city_id = $vr_city_id;

        return $this;
    }

    /**
     * Method to set the value of field vr_area_id
     *
     * @param integer $vr_area_id
     * @return $this
     */
    public function setVrAreaId($vr_area_id)
    {
        $this->vr_area_id = $vr_area_id;

        return $this;
    }

    /**
     * Method to set the value of field vr_mall_id
     *
     * @param integer $vr_mall_id
     * @return $this
     */
    public function setVrMallId($vr_mall_id)
    {
        $this->vr_mall_id = $vr_mall_id;

        return $this;
    }

    /**
     * Method to set the value of field vr_class_id
     *
     * @param integer $vr_class_id
     * @return $this
     */
    public function setVrClassId($vr_class_id)
    {
        $this->vr_class_id = $vr_class_id;

        return $this;
    }

    /**
     * Method to set the value of field vr_s_class_id
     *
     * @param integer $vr_s_class_id
     * @return $this
     */
    public function setVrSClassId($vr_s_class_id)
    {
        $this->vr_s_class_id = $vr_s_class_id;

        return $this;
    }

    /**
     * Returns the value of field groupbuy_id
     *
     * @return integer
     */
    public function getGroupbuyId()
    {
        return $this->groupbuy_id;
    }

    /**
     * Returns the value of field groupbuy_name
     *
     * @return string
     */
    public function getGroupbuyName()
    {
        return $this->groupbuy_name;
    }

    /**
     * Returns the value of field start_time
     *
     * @return integer
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Returns the value of field end_time
     *
     * @return integer
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * Returns the value of field goods_id
     *
     * @return integer
     */
    public function getGoodsId()
    {
        return $this->goods_id;
    }

    /**
     * Returns the value of field goods_commonid
     *
     * @return integer
     */
    public function getGoodsCommonid()
    {
        return $this->goods_commonid;
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
     * Returns the value of field goods_price
     *
     * @return double
     */
    public function getGoodsPrice()
    {
        return $this->goods_price;
    }

    /**
     * Returns the value of field groupbuy_price
     *
     * @return double
     */
    public function getGroupbuyPrice()
    {
        return $this->groupbuy_price;
    }

    /**
     * Returns the value of field groupbuy_rebate
     *
     * @return double
     */
    public function getGroupbuyRebate()
    {
        return $this->groupbuy_rebate;
    }

    /**
     * Returns the value of field virtual_quantity
     *
     * @return integer
     */
    public function getVirtualQuantity()
    {
        return $this->virtual_quantity;
    }

    /**
     * Returns the value of field upper_limit
     *
     * @return integer
     */
    public function getUpperLimit()
    {
        return $this->upper_limit;
    }

    /**
     * Returns the value of field buyer_count
     *
     * @return integer
     */
    public function getBuyerCount()
    {
        return $this->buyer_count;
    }

    /**
     * Returns the value of field buy_quantity
     *
     * @return integer
     */
    public function getBuyQuantity()
    {
        return $this->buy_quantity;
    }

    /**
     * Returns the value of field groupbuy_intro
     *
     * @return string
     */
    public function getGroupbuyIntro()
    {
        return $this->groupbuy_intro;
    }

    /**
     * Returns the value of field state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Returns the value of field recommended
     *
     * @return integer
     */
    public function getRecommended()
    {
        return $this->recommended;
    }

    /**
     * Returns the value of field views
     *
     * @return integer
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Returns the value of field class_id
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * Returns the value of field s_class_id
     *
     * @return integer
     */
    public function getSClassId()
    {
        return $this->s_class_id;
    }

    /**
     * Returns the value of field groupbuy_image
     *
     * @return string
     */
    public function getGroupbuyImage()
    {
        return $this->groupbuy_image;
    }

    /**
     * Returns the value of field groupbuy_image1
     *
     * @return string
     */
    public function getGroupbuyImage1()
    {
        return $this->groupbuy_image1;
    }

    /**
     * Returns the value of field remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Returns the value of field is_vr
     *
     * @return integer
     */
    public function getIsVr()
    {
        return $this->is_vr;
    }

    /**
     * Returns the value of field vr_city_id
     *
     * @return integer
     */
    public function getVrCityId()
    {
        return $this->vr_city_id;
    }

    /**
     * Returns the value of field vr_area_id
     *
     * @return integer
     */
    public function getVrAreaId()
    {
        return $this->vr_area_id;
    }

    /**
     * Returns the value of field vr_mall_id
     *
     * @return integer
     */
    public function getVrMallId()
    {
        return $this->vr_mall_id;
    }

    /**
     * Returns the value of field vr_class_id
     *
     * @return integer
     */
    public function getVrClassId()
    {
        return $this->vr_class_id;
    }

    /**
     * Returns the value of field vr_s_class_id
     *
     * @return integer
     */
    public function getVrSClassId()
    {
        return $this->vr_s_class_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'groupbuy';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Groupbuy[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Groupbuy
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
