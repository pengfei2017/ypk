<?php

namespace Ypk\Models;

class Circle extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_id;

    /**
     *
     * @var string
     * @Column(type="string", length=12, nullable=false)
     */
    protected $circle_name;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $circle_desc;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_masterid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $circle_mastername;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $circle_img;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $class_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_mcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_thcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $circle_gcount;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $circle_pursuereason;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $circle_notice;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $circle_status;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $circle_statusinfo;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $circle_joinaudit;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=false)
     */
    protected $circle_addtime;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $circle_noticetime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $is_recommend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $is_hot;

    /**
     *
     * @var string
     * @Column(type="string", length=60, nullable=true)
     */
    protected $circle_tag;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $new_verifycount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $new_informcount;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $mapply_open;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=false)
     */
    protected $mapply_ml;

    /**
     *
     * @var integer
     * @Column(type="integer", length=5, nullable=false)
     */
    protected $new_mapplycount;

    /**
     * Method to set the value of field circle_id
     *
     * @param integer $circle_id
     * @return $this
     */
    public function setCircleId($circle_id)
    {
        $this->circle_id = $circle_id;

        return $this;
    }

    /**
     * Method to set the value of field circle_name
     *
     * @param string $circle_name
     * @return $this
     */
    public function setCircleName($circle_name)
    {
        $this->circle_name = $circle_name;

        return $this;
    }

    /**
     * Method to set the value of field circle_desc
     *
     * @param string $circle_desc
     * @return $this
     */
    public function setCircleDesc($circle_desc)
    {
        $this->circle_desc = $circle_desc;

        return $this;
    }

    /**
     * Method to set the value of field circle_masterid
     *
     * @param integer $circle_masterid
     * @return $this
     */
    public function setCircleMasterid($circle_masterid)
    {
        $this->circle_masterid = $circle_masterid;

        return $this;
    }

    /**
     * Method to set the value of field circle_mastername
     *
     * @param string $circle_mastername
     * @return $this
     */
    public function setCircleMastername($circle_mastername)
    {
        $this->circle_mastername = $circle_mastername;

        return $this;
    }

    /**
     * Method to set the value of field circle_img
     *
     * @param string $circle_img
     * @return $this
     */
    public function setCircleImg($circle_img)
    {
        $this->circle_img = $circle_img;

        return $this;
    }

    /**
     * Method to set the value of field class_id
     *
     * @param integer $class_id
     * @return $this
     */
    public function setClassId($class_id)
    {
        $this->class_id = $class_id;

        return $this;
    }

    /**
     * Method to set the value of field circle_mcount
     *
     * @param integer $circle_mcount
     * @return $this
     */
    public function setCircleMcount($circle_mcount)
    {
        $this->circle_mcount = $circle_mcount;

        return $this;
    }

    /**
     * Method to set the value of field circle_thcount
     *
     * @param integer $circle_thcount
     * @return $this
     */
    public function setCircleThcount($circle_thcount)
    {
        $this->circle_thcount = $circle_thcount;

        return $this;
    }

    /**
     * Method to set the value of field circle_gcount
     *
     * @param integer $circle_gcount
     * @return $this
     */
    public function setCircleGcount($circle_gcount)
    {
        $this->circle_gcount = $circle_gcount;

        return $this;
    }

    /**
     * Method to set the value of field circle_pursuereason
     *
     * @param string $circle_pursuereason
     * @return $this
     */
    public function setCirclePursuereason($circle_pursuereason)
    {
        $this->circle_pursuereason = $circle_pursuereason;

        return $this;
    }

    /**
     * Method to set the value of field circle_notice
     *
     * @param string $circle_notice
     * @return $this
     */
    public function setCircleNotice($circle_notice)
    {
        $this->circle_notice = $circle_notice;

        return $this;
    }

    /**
     * Method to set the value of field circle_status
     *
     * @param integer $circle_status
     * @return $this
     */
    public function setCircleStatus($circle_status)
    {
        $this->circle_status = $circle_status;

        return $this;
    }

    /**
     * Method to set the value of field circle_statusinfo
     *
     * @param string $circle_statusinfo
     * @return $this
     */
    public function setCircleStatusinfo($circle_statusinfo)
    {
        $this->circle_statusinfo = $circle_statusinfo;

        return $this;
    }

    /**
     * Method to set the value of field circle_joinaudit
     *
     * @param integer $circle_joinaudit
     * @return $this
     */
    public function setCircleJoinaudit($circle_joinaudit)
    {
        $this->circle_joinaudit = $circle_joinaudit;

        return $this;
    }

    /**
     * Method to set the value of field circle_addtime
     *
     * @param string $circle_addtime
     * @return $this
     */
    public function setCircleAddtime($circle_addtime)
    {
        $this->circle_addtime = $circle_addtime;

        return $this;
    }

    /**
     * Method to set the value of field circle_noticetime
     *
     * @param string $circle_noticetime
     * @return $this
     */
    public function setCircleNoticetime($circle_noticetime)
    {
        $this->circle_noticetime = $circle_noticetime;

        return $this;
    }

    /**
     * Method to set the value of field is_recommend
     *
     * @param integer $is_recommend
     * @return $this
     */
    public function setIsRecommend($is_recommend)
    {
        $this->is_recommend = $is_recommend;

        return $this;
    }

    /**
     * Method to set the value of field is_hot
     *
     * @param integer $is_hot
     * @return $this
     */
    public function setIsHot($is_hot)
    {
        $this->is_hot = $is_hot;

        return $this;
    }

    /**
     * Method to set the value of field circle_tag
     *
     * @param string $circle_tag
     * @return $this
     */
    public function setCircleTag($circle_tag)
    {
        $this->circle_tag = $circle_tag;

        return $this;
    }

    /**
     * Method to set the value of field new_verifycount
     *
     * @param integer $new_verifycount
     * @return $this
     */
    public function setNewVerifycount($new_verifycount)
    {
        $this->new_verifycount = $new_verifycount;

        return $this;
    }

    /**
     * Method to set the value of field new_informcount
     *
     * @param integer $new_informcount
     * @return $this
     */
    public function setNewInformcount($new_informcount)
    {
        $this->new_informcount = $new_informcount;

        return $this;
    }

    /**
     * Method to set the value of field mapply_open
     *
     * @param integer $mapply_open
     * @return $this
     */
    public function setMapplyOpen($mapply_open)
    {
        $this->mapply_open = $mapply_open;

        return $this;
    }

    /**
     * Method to set the value of field mapply_ml
     *
     * @param integer $mapply_ml
     * @return $this
     */
    public function setMapplyMl($mapply_ml)
    {
        $this->mapply_ml = $mapply_ml;

        return $this;
    }

    /**
     * Method to set the value of field new_mapplycount
     *
     * @param integer $new_mapplycount
     * @return $this
     */
    public function setNewMapplycount($new_mapplycount)
    {
        $this->new_mapplycount = $new_mapplycount;

        return $this;
    }

    /**
     * Returns the value of field circle_id
     *
     * @return integer
     */
    public function getCircleId()
    {
        return $this->circle_id;
    }

    /**
     * Returns the value of field circle_name
     *
     * @return string
     */
    public function getCircleName()
    {
        return $this->circle_name;
    }

    /**
     * Returns the value of field circle_desc
     *
     * @return string
     */
    public function getCircleDesc()
    {
        return $this->circle_desc;
    }

    /**
     * Returns the value of field circle_masterid
     *
     * @return integer
     */
    public function getCircleMasterid()
    {
        return $this->circle_masterid;
    }

    /**
     * Returns the value of field circle_mastername
     *
     * @return string
     */
    public function getCircleMastername()
    {
        return $this->circle_mastername;
    }

    /**
     * Returns the value of field circle_img
     *
     * @return string
     */
    public function getCircleImg()
    {
        return $this->circle_img;
    }

    /**
     * Returns the value of field class_id
     *
     * @return integer
     */
    public function getClassId()
    {
        return $this->class_id;
    }

    /**
     * Returns the value of field circle_mcount
     *
     * @return integer
     */
    public function getCircleMcount()
    {
        return $this->circle_mcount;
    }

    /**
     * Returns the value of field circle_thcount
     *
     * @return integer
     */
    public function getCircleThcount()
    {
        return $this->circle_thcount;
    }

    /**
     * Returns the value of field circle_gcount
     *
     * @return integer
     */
    public function getCircleGcount()
    {
        return $this->circle_gcount;
    }

    /**
     * Returns the value of field circle_pursuereason
     *
     * @return string
     */
    public function getCirclePursuereason()
    {
        return $this->circle_pursuereason;
    }

    /**
     * Returns the value of field circle_notice
     *
     * @return string
     */
    public function getCircleNotice()
    {
        return $this->circle_notice;
    }

    /**
     * Returns the value of field circle_status
     *
     * @return integer
     */
    public function getCircleStatus()
    {
        return $this->circle_status;
    }

    /**
     * Returns the value of field circle_statusinfo
     *
     * @return string
     */
    public function getCircleStatusinfo()
    {
        return $this->circle_statusinfo;
    }

    /**
     * Returns the value of field circle_joinaudit
     *
     * @return integer
     */
    public function getCircleJoinaudit()
    {
        return $this->circle_joinaudit;
    }

    /**
     * Returns the value of field circle_addtime
     *
     * @return string
     */
    public function getCircleAddtime()
    {
        return $this->circle_addtime;
    }

    /**
     * Returns the value of field circle_noticetime
     *
     * @return string
     */
    public function getCircleNoticetime()
    {
        return $this->circle_noticetime;
    }

    /**
     * Returns the value of field is_recommend
     *
     * @return integer
     */
    public function getIsRecommend()
    {
        return $this->is_recommend;
    }

    /**
     * Returns the value of field is_hot
     *
     * @return integer
     */
    public function getIsHot()
    {
        return $this->is_hot;
    }

    /**
     * Returns the value of field circle_tag
     *
     * @return string
     */
    public function getCircleTag()
    {
        return $this->circle_tag;
    }

    /**
     * Returns the value of field new_verifycount
     *
     * @return integer
     */
    public function getNewVerifycount()
    {
        return $this->new_verifycount;
    }

    /**
     * Returns the value of field new_informcount
     *
     * @return integer
     */
    public function getNewInformcount()
    {
        return $this->new_informcount;
    }

    /**
     * Returns the value of field mapply_open
     *
     * @return integer
     */
    public function getMapplyOpen()
    {
        return $this->mapply_open;
    }

    /**
     * Returns the value of field mapply_ml
     *
     * @return integer
     */
    public function getMapplyMl()
    {
        return $this->mapply_ml;
    }

    /**
     * Returns the value of field new_mapplycount
     *
     * @return integer
     */
    public function getNewMapplycount()
    {
        return $this->new_mapplycount;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'circle';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Circle[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Circle
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
