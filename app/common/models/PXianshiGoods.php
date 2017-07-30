<?php

namespace Ypk\Models;

class PXianshiGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $xianshi_goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $xianshi_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $xianshi_name;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $xianshi_title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $xianshi_explain;

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
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $goods_name;

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
    protected $xianshi_price;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $goods_image;

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
    protected $lower_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $state;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $xianshi_recommend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=9, nullable=true)
     */
    protected $gc_id_1;

    /**
     * Method to set the value of field xianshi_goods_id
     *
     * @param integer $xianshi_goods_id
     * @return $this
     */
    public function setXianshiGoodsId($xianshi_goods_id)
    {
        $this->xianshi_goods_id = $xianshi_goods_id;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_id
     *
     * @param integer $xianshi_id
     * @return $this
     */
    public function setXianshiId($xianshi_id)
    {
        $this->xianshi_id = $xianshi_id;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_name
     *
     * @param string $xianshi_name
     * @return $this
     */
    public function setXianshiName($xianshi_name)
    {
        $this->xianshi_name = $xianshi_name;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_title
     *
     * @param string $xianshi_title
     * @return $this
     */
    public function setXianshiTitle($xianshi_title)
    {
        $this->xianshi_title = $xianshi_title;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_explain
     *
     * @param string $xianshi_explain
     * @return $this
     */
    public function setXianshiExplain($xianshi_explain)
    {
        $this->xianshi_explain = $xianshi_explain;

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
     * Method to set the value of field xianshi_price
     *
     * @param double $xianshi_price
     * @return $this
     */
    public function setXianshiPrice($xianshi_price)
    {
        $this->xianshi_price = $xianshi_price;

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
     * Method to set the value of field lower_limit
     *
     * @param integer $lower_limit
     * @return $this
     */
    public function setLowerLimit($lower_limit)
    {
        $this->lower_limit = $lower_limit;

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
     * Method to set the value of field xianshi_recommend
     *
     * @param integer $xianshi_recommend
     * @return $this
     */
    public function setXianshiRecommend($xianshi_recommend)
    {
        $this->xianshi_recommend = $xianshi_recommend;

        return $this;
    }

    /**
     * Method to set the value of field gc_id_1
     *
     * @param integer $gc_id_1
     * @return $this
     */
    public function setGcId1($gc_id_1)
    {
        $this->gc_id_1 = $gc_id_1;

        return $this;
    }

    /**
     * Returns the value of field xianshi_goods_id
     *
     * @return integer
     */
    public function getXianshiGoodsId()
    {
        return $this->xianshi_goods_id;
    }

    /**
     * Returns the value of field xianshi_id
     *
     * @return integer
     */
    public function getXianshiId()
    {
        return $this->xianshi_id;
    }

    /**
     * Returns the value of field xianshi_name
     *
     * @return string
     */
    public function getXianshiName()
    {
        return $this->xianshi_name;
    }

    /**
     * Returns the value of field xianshi_title
     *
     * @return string
     */
    public function getXianshiTitle()
    {
        return $this->xianshi_title;
    }

    /**
     * Returns the value of field xianshi_explain
     *
     * @return string
     */
    public function getXianshiExplain()
    {
        return $this->xianshi_explain;
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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
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
     * Returns the value of field goods_price
     *
     * @return double
     */
    public function getGoodsPrice()
    {
        return $this->goods_price;
    }

    /**
     * Returns the value of field xianshi_price
     *
     * @return double
     */
    public function getXianshiPrice()
    {
        return $this->xianshi_price;
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
     * Returns the value of field lower_limit
     *
     * @return integer
     */
    public function getLowerLimit()
    {
        return $this->lower_limit;
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
     * Returns the value of field xianshi_recommend
     *
     * @return integer
     */
    public function getXianshiRecommend()
    {
        return $this->xianshi_recommend;
    }

    /**
     * Returns the value of field gc_id_1
     *
     * @return integer
     */
    public function getGcId1()
    {
        return $this->gc_id_1;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_xianshi_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PXianshiGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PXianshiGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
