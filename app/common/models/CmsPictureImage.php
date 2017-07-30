<?php

namespace Ypk\Models;

class CmsPictureImage extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $image_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $image_name;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $image_abstract;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $image_goods;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $image_store;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $image_width;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=true)
     */
    protected $image_height;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $image_picture_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $image_path;

    /**
     * Method to set the value of field image_id
     *
     * @param integer $image_id
     * @return $this
     */
    public function setImageId($image_id)
    {
        $this->image_id = $image_id;

        return $this;
    }

    /**
     * Method to set the value of field image_name
     *
     * @param string $image_name
     * @return $this
     */
    public function setImageName($image_name)
    {
        $this->image_name = $image_name;

        return $this;
    }

    /**
     * Method to set the value of field image_abstract
     *
     * @param string $image_abstract
     * @return $this
     */
    public function setImageAbstract($image_abstract)
    {
        $this->image_abstract = $image_abstract;

        return $this;
    }

    /**
     * Method to set the value of field image_goods
     *
     * @param string $image_goods
     * @return $this
     */
    public function setImageGoods($image_goods)
    {
        $this->image_goods = $image_goods;

        return $this;
    }

    /**
     * Method to set the value of field image_store
     *
     * @param string $image_store
     * @return $this
     */
    public function setImageStore($image_store)
    {
        $this->image_store = $image_store;

        return $this;
    }

    /**
     * Method to set the value of field image_width
     *
     * @param integer $image_width
     * @return $this
     */
    public function setImageWidth($image_width)
    {
        $this->image_width = $image_width;

        return $this;
    }

    /**
     * Method to set the value of field image_height
     *
     * @param integer $image_height
     * @return $this
     */
    public function setImageHeight($image_height)
    {
        $this->image_height = $image_height;

        return $this;
    }

    /**
     * Method to set the value of field image_picture_id
     *
     * @param integer $image_picture_id
     * @return $this
     */
    public function setImagePictureId($image_picture_id)
    {
        $this->image_picture_id = $image_picture_id;

        return $this;
    }

    /**
     * Method to set the value of field image_path
     *
     * @param string $image_path
     * @return $this
     */
    public function setImagePath($image_path)
    {
        $this->image_path = $image_path;

        return $this;
    }

    /**
     * Returns the value of field image_id
     *
     * @return integer
     */
    public function getImageId()
    {
        return $this->image_id;
    }

    /**
     * Returns the value of field image_name
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->image_name;
    }

    /**
     * Returns the value of field image_abstract
     *
     * @return string
     */
    public function getImageAbstract()
    {
        return $this->image_abstract;
    }

    /**
     * Returns the value of field image_goods
     *
     * @return string
     */
    public function getImageGoods()
    {
        return $this->image_goods;
    }

    /**
     * Returns the value of field image_store
     *
     * @return string
     */
    public function getImageStore()
    {
        return $this->image_store;
    }

    /**
     * Returns the value of field image_width
     *
     * @return integer
     */
    public function getImageWidth()
    {
        return $this->image_width;
    }

    /**
     * Returns the value of field image_height
     *
     * @return integer
     */
    public function getImageHeight()
    {
        return $this->image_height;
    }

    /**
     * Returns the value of field image_picture_id
     *
     * @return integer
     */
    public function getImagePictureId()
    {
        return $this->image_picture_id;
    }

    /**
     * Returns the value of field image_path
     *
     * @return string
     */
    public function getImagePath()
    {
        return $this->image_path;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'cms_picture_image';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsPictureImage[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return CmsPictureImage
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
