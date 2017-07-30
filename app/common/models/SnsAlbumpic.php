<?php

namespace Ypk\Models;

class SnsAlbumpic extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ap_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $ap_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ac_id;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    protected $ap_cover;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $ap_size;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $ap_spec;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $member_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $upload_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $ap_type;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $item_id;

    /**
     * Method to set the value of field ap_id
     *
     * @param integer $ap_id
     * @return $this
     */
    public function setApId($ap_id)
    {
        $this->ap_id = $ap_id;

        return $this;
    }

    /**
     * Method to set the value of field ap_name
     *
     * @param string $ap_name
     * @return $this
     */
    public function setApName($ap_name)
    {
        $this->ap_name = $ap_name;

        return $this;
    }

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
     * Method to set the value of field ap_cover
     *
     * @param string $ap_cover
     * @return $this
     */
    public function setApCover($ap_cover)
    {
        $this->ap_cover = $ap_cover;

        return $this;
    }

    /**
     * Method to set the value of field ap_size
     *
     * @param integer $ap_size
     * @return $this
     */
    public function setApSize($ap_size)
    {
        $this->ap_size = $ap_size;

        return $this;
    }

    /**
     * Method to set the value of field ap_spec
     *
     * @param string $ap_spec
     * @return $this
     */
    public function setApSpec($ap_spec)
    {
        $this->ap_spec = $ap_spec;

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
     * Method to set the value of field ap_type
     *
     * @param integer $ap_type
     * @return $this
     */
    public function setApType($ap_type)
    {
        $this->ap_type = $ap_type;

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
     * Returns the value of field ap_id
     *
     * @return integer
     */
    public function getApId()
    {
        return $this->ap_id;
    }

    /**
     * Returns the value of field ap_name
     *
     * @return string
     */
    public function getApName()
    {
        return $this->ap_name;
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
     * Returns the value of field ap_cover
     *
     * @return string
     */
    public function getApCover()
    {
        return $this->ap_cover;
    }

    /**
     * Returns the value of field ap_size
     *
     * @return integer
     */
    public function getApSize()
    {
        return $this->ap_size;
    }

    /**
     * Returns the value of field ap_spec
     *
     * @return string
     */
    public function getApSpec()
    {
        return $this->ap_spec;
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
     * Returns the value of field upload_time
     *
     * @return integer
     */
    public function getUploadTime()
    {
        return $this->upload_time;
    }

    /**
     * Returns the value of field ap_type
     *
     * @return integer
     */
    public function getApType()
    {
        return $this->ap_type;
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
        return 'sns_albumpic';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsAlbumpic[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return SnsAlbumpic
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
