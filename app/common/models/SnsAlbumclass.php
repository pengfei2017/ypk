<?php

namespace Ypk\Models;

class SnsAlbumclass extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ac_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $ac_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $ac_des;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $ac_sort;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $ac_cover;

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
     * Method to set the value of field ac_id
     *
     * @param integer $ac_id
     * @return $this
     */
    public function setAcId($ac_id)
    {
        $this->ac_id = $ac_id;

        return $this;
    }

    /**
     * Method to set the value of field ac_name
     *
     * @param string $ac_name
     * @return $this
     */
    public function setAcName($ac_name)
    {
        $this->ac_name = $ac_name;

        return $this;
    }

    /**
     * Method to set the value of field member_id
     *
     * @param integer $member_id
     * @return $this
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;

        return $this;
    }

    /**
     * Method to set the value of field ac_des
     *
     * @param string $ac_des
     * @return $this
     */
    public function setAcDes($ac_des)
    {
        $this->ac_des = $ac_des;

        return $this;
    }

    /**
     * Method to set the value of field ac_sort
     *
     * @param integer $ac_sort
     * @return $this
     */
    public function setAcSort($ac_sort)
    {
        $this->ac_sort = $ac_sort;

        return $this;
    }

    /**
     * Method to set the value of field ac_cover
     *
     * @param string $ac_cover
     * @return $this
     */
    public function setAcCover($ac_cover)
    {
        $this->ac_cover = $ac_cover;

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
     * Returns the value of field ac_id
     *
     * @return integer
     */
    public function getAcId()
    {
        return $this->ac_id;
    }

    /**
     * Returns the value of field ac_name
     *
     * @return string
     */
    public function getAcName()
    {
        return $this->ac_name;
    }

    /**
     * Returns the value of field member_id
     *
     * @return integer
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * Returns the value of field ac_des
     *
     * @return string
     */
    public function getAcDes()
    {
        return $this->ac_des;
    }

    /**
     * Returns the value of field ac_sort
     *
     * @return integer
     */
    public function getAcSort()
    {
        return $this->ac_sort;
    }

    /**
     * Returns the value of field ac_cover
     *
     * @return string
     */
    public function getAcCover()
    {
        return $this->ac_cover;
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
        return 'sns_albumclass';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsAlbumclass[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsAlbumclass
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
