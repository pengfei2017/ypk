<?php

namespace Ypk\Models;

class GoodsImages extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_image_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $goods_commonid;

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
    protected $color_id;

    /**
     *
     * @var string
     * @Column(type="string", length=1000, nullable=false)
     */
    protected $goods_image;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $goods_image_sort;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_default;

    /**
     * Method to set the value of field goods_image_id
     *
     * @param integer $goods_image_id
     * @return $this
     */
    public function setGoodsImageId($goods_image_id)
    {
        $this->goods_image_id = $goods_image_id;

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
     * Method to set the value of field color_id
     *
     * @param integer $color_id
     * @return $this
     */
    public function setColorId($color_id)
    {
        $this->color_id = $color_id;

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
     * Method to set the value of field goods_image_sort
     *
     * @param integer $goods_image_sort
     * @return $this
     */
    public function setGoodsImageSort($goods_image_sort)
    {
        $this->goods_image_sort = $goods_image_sort;

        return $this;
    }

    /**
     * Method to set the value of field is_default
     *
     * @param integer $is_default
     * @return $this
     */
    public function setIsDefault($is_default)
    {
        $this->is_default = $is_default;

        return $this;
    }

    /**
     * Returns the value of field goods_image_id
     *
     * @return integer
     */
    public function getGoodsImageId()
    {
        return $this->goods_image_id;
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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field color_id
     *
     * @return integer
     */
    public function getColorId()
    {
        return $this->color_id;
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
     * Returns the value of field goods_image_sort
     *
     * @return integer
     */
    public function getGoodsImageSort()
    {
        return $this->goods_image_sort;
    }

    /**
     * Returns the value of field is_default
     *
     * @return integer
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
        return 'goods_images';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsImages[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return GoodsImages
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
