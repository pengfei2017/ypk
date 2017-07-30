<?php

namespace Ypk\Models;

class OrderGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $rec_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $order_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $goods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
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
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $goods_num;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_image;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $goods_pay_price;

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
    protected $buyer_id;

    /**
     *
     * @var string
     * @Column(type="string", length=1, nullable=false)
     */
    protected $goods_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $promotions_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $commis_rate;

    /**
     *
     * @var integer
     * @Column(type="integer", length=8, nullable=false)
     */
    protected $gc_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $goods_spec;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $goods_contractid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=true)
     */
    protected $invite_rates;

    /**
     * Method to set the value of field rec_id
     *
     * @param integer $rec_id
     * @return $this
     */
    public function setRecId($rec_id)
    {
        $this->rec_id = $rec_id;

        return $this;
    }

    /**
     * Method to set the value of field order_id
     *
     * @param integer $order_id
     * @return $this
     */
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;

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
     * Method to set the value of field goods_num
     *
     * @param integer $goods_num
     * @return $this
     */
    public function setGoodsNum($goods_num)
    {
        $this->goods_num = $goods_num;

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
     * Method to set the value of field goods_pay_price
     *
     * @param double $goods_pay_price
     * @return $this
     */
    public function setGoodsPayPrice($goods_pay_price)
    {
        $this->goods_pay_price = $goods_pay_price;

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
     * Method to set the value of field buyer_id
     *
     * @param integer $buyer_id
     * @return $this
     */
    public function setBuyerId($buyer_id)
    {
        $this->buyer_id = $buyer_id;

        return $this;
    }

    /**
     * Method to set the value of field goods_type
     *
     * @param string $goods_type
     * @return $this
     */
    public function setGoodsType($goods_type)
    {
        $this->goods_type = $goods_type;

        return $this;
    }

    /**
     * Method to set the value of field promotions_id
     *
     * @param integer $promotions_id
     * @return $this
     */
    public function setPromotionsId($promotions_id)
    {
        $this->promotions_id = $promotions_id;

        return $this;
    }

    /**
     * Method to set the value of field commis_rate
     *
     * @param integer $commis_rate
     * @return $this
     */
    public function setCommisRate($commis_rate)
    {
        $this->commis_rate = $commis_rate;

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
     * Method to set the value of field goods_spec
     *
     * @param string $goods_spec
     * @return $this
     */
    public function setGoodsSpec($goods_spec)
    {
        $this->goods_spec = $goods_spec;

        return $this;
    }

    /**
     * Method to set the value of field goods_contractid
     *
     * @param string $goods_contractid
     * @return $this
     */
    public function setGoodsContractid($goods_contractid)
    {
        $this->goods_contractid = $goods_contractid;

        return $this;
    }

    /**
     * Method to set the value of field invite_rates
     *
     * @param integer $invite_rates
     * @return $this
     */
    public function setInviteRates($invite_rates)
    {
        $this->invite_rates = $invite_rates;

        return $this;
    }

    /**
     * Returns the value of field rec_id
     *
     * @return integer
     */
    public function getRecId()
    {
        return $this->rec_id;
    }

    /**
     * Returns the value of field order_id
     *
     * @return integer
     */
    public function getOrderId()
    {
        return $this->order_id;
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
     * Returns the value of field goods_num
     *
     * @return integer
     */
    public function getGoodsNum()
    {
        return $this->goods_num;
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
     * Returns the value of field goods_pay_price
     *
     * @return double
     */
    public function getGoodsPayPrice()
    {
        return $this->goods_pay_price;
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
     * Returns the value of field buyer_id
     *
     * @return integer
     */
    public function getBuyerId()
    {
        return $this->buyer_id;
    }

    /**
     * Returns the value of field goods_type
     *
     * @return string
     */
    public function getGoodsType()
    {
        return $this->goods_type;
    }

    /**
     * Returns the value of field promotions_id
     *
     * @return integer
     */
    public function getPromotionsId()
    {
        return $this->promotions_id;
    }

    /**
     * Returns the value of field commis_rate
     *
     * @return integer
     */
    public function getCommisRate()
    {
        return $this->commis_rate;
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
     * Returns the value of field goods_spec
     *
     * @return string
     */
    public function getGoodsSpec()
    {
        return $this->goods_spec;
    }

    /**
     * Returns the value of field goods_contractid
     *
     * @return string
     */
    public function getGoodsContractid()
    {
        return $this->goods_contractid;
    }

    /**
     * Returns the value of field invite_rates
     *
     * @return integer
     */
    public function getInviteRates()
    {
        return $this->invite_rates;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'order_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return OrderGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
