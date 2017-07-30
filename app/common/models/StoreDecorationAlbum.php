<?php

namespace Ypk\Models;

class StoreDecorationAlbum extends \Phalcon\Mvc\Model
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
     * @Column(type="string", length=50, nullable=false)
     */
    protected $image_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $image_origin_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $image_width;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $image_height;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $image_size;

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
    protected $upload_time;

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
     * Method to set the value of field image_origin_name
     *
     * @param string $image_origin_name
     * @return $this
     */
    public function setImageOriginName($image_origin_name)
    {
        $this->image_origin_name = $image_origin_name;

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
     * Method to set the value of field image_size
     *
     * @param integer $image_size
     * @return $this
     */
    public function setImageSize($image_size)
    {
        $this->image_size = $image_size;

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
     * Method to set the value of field upload_time
     *
     * @param integer $upload_time
     * @return $this
     */
    public function setUploadTime($upload_time)
    {
        $this->upload_time = $upload_time;

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
     * Returns the value of field image_origin_name
     *
     * @return string
     */
    public function getImageOriginName()
    {
        return $this->image_origin_name;
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
     * Returns the value of field image_size
     *
     * @return integer
     */
    public function getImageSize()
    {
        return $this->image_size;
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
     * Returns the value of field upload_time
     *
     * @return integer
     */
    public function getUploadTime()
    {
        return $this->upload_time;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_decoration_album';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDecorationAlbum[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreDecorationAlbum
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
