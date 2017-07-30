<?php

namespace Ypk\Models;

class Upload extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $upload_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $file_name;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $file_thumb;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $file_size;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $upload_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $upload_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $item_id;

    /**
     * Method to set the value of field upload_id
     *
     * @param integer $upload_id
     * @return $this
     */
    public function setUploadId($upload_id)
    {
        $this->upload_id = $upload_id;

        return $this;
    }

    /**
     * Method to set the value of field file_name
     *
     * @param string $file_name
     * @return $this
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;

        return $this;
    }

    /**
     * Method to set the value of field file_thumb
     *
     * @param string $file_thumb
     * @return $this
     */
    public function setFileThumb($file_thumb)
    {
        $this->file_thumb = $file_thumb;

        return $this;
    }

    /**
     * Method to set the value of field file_size
     *
     * @param integer $file_size
     * @return $this
     */
    public function setFileSize($file_size)
    {
        $this->file_size = $file_size;

        return $this;
    }

    /**
     * Method to set the value of field upload_type
     *
     * @param integer $upload_type
     * @return $this
     */
    public function setUploadType($upload_type)
    {
        $this->upload_type = $upload_type;

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
     * Method to set the value of field item_id
     *
     * @param integer $item_id
     * @return $this
     */
    public function setItemId($item_id)
    {
        $this->item_id = $item_id;

        return $this;
    }

    /**
     * Returns the value of field upload_id
     *
     * @return integer
     */
    public function getUploadId()
    {
        return $this->upload_id;
    }

    /**
     * Returns the value of field file_name
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->file_name;
    }

    /**
     * Returns the value of field file_thumb
     *
     * @return string
     */
    public function getFileThumb()
    {
        return $this->file_thumb;
    }

    /**
     * Returns the value of field file_size
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->file_size;
    }

    /**
     * Returns the value of field upload_type
     *
     * @return integer
     */
    public function getUploadType()
    {
        return $this->upload_type;
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
     * Returns the value of field item_id
     *
     * @return integer
     */
    public function getItemId()
    {
        return $this->item_id;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'upload';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Upload[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Upload
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
