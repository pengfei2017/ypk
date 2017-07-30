<?php

namespace Ypk\Models;

class AlbumPic extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $apic_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $apic_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $apic_tag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $aclass_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $apic_cover;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $apic_size;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $apic_spec;

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
     * Method to set the value of field apic_id
     *
     * @param integer $apic_id
     * @return $this
     */
    public function setApicId($apic_id)
    {
        $this->apic_id = $apic_id;

        return $this;
    }

    /**
     * Method to set the value of field apic_name
     *
     * @param string $apic_name
     * @return $this
     */
    public function setApicName($apic_name)
    {
        $this->apic_name = $apic_name;

        return $this;
    }

    /**
     * Method to set the value of field apic_tag
     *
     * @param string $apic_tag
     * @return $this
     */
    public function setApicTag($apic_tag)
    {
        $this->apic_tag = $apic_tag;

        return $this;
    }

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
     * Method to set the value of field apic_cover
     *
     * @param string $apic_cover
     * @return $this
     */
    public function setApicCover($apic_cover)
    {
        $this->apic_cover = $apic_cover;

        return $this;
    }

    /**
     * Method to set the value of field apic_size
     *
     * @param integer $apic_size
     * @return $this
     */
    public function setApicSize($apic_size)
    {
        $this->apic_size = $apic_size;

        return $this;
    }

    /**
     * Method to set the value of field apic_spec
     *
     * @param string $apic_spec
     * @return $this
     */
    public function setApicSpec($apic_spec)
    {
        $this->apic_spec = $apic_spec;

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
     * Returns the value of field apic_id
     *
     * @return integer
     */
    public function getApicId()
    {
        return $this->apic_id;
    }

    /**
     * Returns the value of field apic_name
     *
     * @return string
     */
    public function getApicName()
    {
        return $this->apic_name;
    }

    /**
     * Returns the value of field apic_tag
     *
     * @return string
     */
    public function getApicTag()
    {
        return $this->apic_tag;
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
     * Returns the value of field apic_cover
     *
     * @return string
     */
    public function getApicCover()
    {
        return $this->apic_cover;
    }

    /**
     * Returns the value of field apic_size
     *
     * @return integer
     */
    public function getApicSize()
    {
        return $this->apic_size;
    }

    /**
     * Returns the value of field apic_spec
     *
     * @return string
     */
    public function getApicSpec()
    {
        return $this->apic_spec;
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
        return 'album_pic';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return AlbumPic[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return AlbumPic
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
