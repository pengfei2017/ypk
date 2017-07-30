<?php

namespace Ypk\Models;

class AlbumClass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $aclass_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $aclass_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $aclass_des;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $aclass_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $aclass_cover;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $upload_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $is_default;

    /**
     * Method to set the value of field aclass_id
     *
     * @param integer $aclass_id
     * @return $this
     */
    public function setAclassId($aclass_id)
    {
        $this->aclass_id = $aclass_id;

        return $this;
    }

    /**
     * Method to set the value of field aclass_name
     *
     * @param string $aclass_name
     * @return $this
     */
    public function setAclassName($aclass_name)
    {
        $this->aclass_name = $aclass_name;

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
     * Method to set the value of field aclass_des
     *
     * @param string $aclass_des
     * @return $this
     */
    public function setAclassDes($aclass_des)
    {
        $this->aclass_des = $aclass_des;

        return $this;
    }

    /**
     * Method to set the value of field aclass_sort
     *
     * @param integer $aclass_sort
     * @return $this
     */
    public function setAclassSort($aclass_sort)
    {
        $this->aclass_sort = $aclass_sort;

        return $this;
    }

    /**
     * Method to set the value of field aclass_cover
     *
     * @param string $aclass_cover
     * @return $this
     */
    public function setAclassCover($aclass_cover)
    {
        $this->aclass_cover = $aclass_cover;

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
     * Returns the value of field aclass_id
     *
     * @return integer
     */
    public function getAclassId()
    {
        return $this->aclass_id;
    }

    /**
     * Returns the value of field aclass_name
     *
     * @return string
     */
    public function getAclassName()
    {
        return $this->aclass_name;
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
     * Returns the value of field aclass_des
     *
     * @return string
     */
    public function getAclassDes()
    {
        return $this->aclass_des;
    }

    /**
     * Returns the value of field aclass_sort
     *
     * @return integer
     */
    public function getAclassSort()
    {
        return $this->aclass_sort;
    }

    /**
     * Returns the value of field aclass_cover
     *
     * @return string
     */
    public function getAclassCover()
    {
        return $this->aclass_cover;
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
        return 'album_class';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AlbumClass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AlbumClass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
