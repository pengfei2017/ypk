<?php

namespace Ypk\Models;

class PBundlingGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $bl_goods_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $bl_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
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
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $goods_image;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $bl_goods_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $bl_appoint;

    /**
     * Method to set the value of field bl_goods_id
     *
     * @param integer $bl_goods_id
     * @return $this
     */
    public function setBlGoodsId($bl_goods_id)
    {
        $this->bl_goods_id = $bl_goods_id;

        return $this;
    }

    /**
     * Method to set the value of field bl_id
     *
     * @param integer $bl_id
     * @return $this
     */
    public function setBlId($bl_id)
    {
        $this->bl_id = $bl_id;

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
     * Method to set the value of field bl_goods_price
     *
     * @param double $bl_goods_price
     * @return $this
     */
    public function setBlGoodsPrice($bl_goods_price)
    {
        $this->bl_goods_price = $bl_goods_price;

        return $this;
    }

    /**
     * Method to set the value of field bl_appoint
     *
     * @param integer $bl_appoint
     * @return $this
     */
    public function setBlAppoint($bl_appoint)
    {
        $this->bl_appoint = $bl_appoint;

        return $this;
    }

    /**
     * Returns the value of field bl_goods_id
     *
     * @return integer
     */
    public function getBlGoodsId()
    {
        return $this->bl_goods_id;
    }

    /**
     * Returns the value of field bl_id
     *
     * @return integer
     */
    public function getBlId()
    {
        return $this->bl_id;
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
     * Returns the value of field goods_image
     *
     * @return string
     */
    public function getGoodsImage()
    {
        return $this->goods_image;
    }

    /**
     * Returns the value of field bl_goods_price
     *
     * @return double
     */
    public function getBlGoodsPrice()
    {
        return $this->bl_goods_price;
    }

    /**
     * Returns the value of field bl_appoint
     *
     * @return integer
     */
    public function getBlAppoint()
    {
        return $this->bl_appoint;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_bundling_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBundlingGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PBundlingGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
