<?php

namespace Ypk\Models;

class PointsOrderaddress extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_oaid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_orderid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $point_truename;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_areaid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $point_areainfo;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=false)
     */
    protected $point_address;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $point_telphone;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=true)
     */
    protected $point_mobphone;

    /**
     * Method to set the value of field point_oaid
     *
     * @param integer $point_oaid
     * @return $this
     */
    public function setPointOaid($point_oaid)
    {
        $this->point_oaid = $point_oaid;

        return $this;
    }

    /**
     * Method to set the value of field point_orderid
     *
     * @param integer $point_orderid
     * @return $this
     */
    public function setPointOrderid($point_orderid)
    {
        $this->point_orderid = $point_orderid;

        return $this;
    }

    /**
     * Method to set the value of field point_truename
     *
     * @param string $point_truename
     * @return $this
     */
    public function setPointTruename($point_truename)
    {
        $this->point_truename = $point_truename;

        return $this;
    }

    /**
     * Method to set the value of field point_areaid
     *
     * @param integer $point_areaid
     * @return $this
     */
    public function setPointAreaid($point_areaid)
    {
        $this->point_areaid = $point_areaid;

        return $this;
    }

    /**
     * Method to set the value of field point_areainfo
     *
     * @param string $point_areainfo
     * @return $this
     */
    public function setPointAreainfo($point_areainfo)
    {
        $this->point_areainfo = $point_areainfo;

        return $this;
    }

    /**
     * Method to set the value of field point_address
     *
     * @param string $point_address
     * @return $this
     */
    public function setPointAddress($point_address)
    {
        $this->point_address = $point_address;

        return $this;
    }

    /**
     * Method to set the value of field point_telphone
     *
     * @param string $point_telphone
     * @return $this
     */
    public function setPointTelphone($point_telphone)
    {
        $this->point_telphone = $point_telphone;

        return $this;
    }

    /**
     * Method to set the value of field point_mobphone
     *
     * @param string $point_mobphone
     * @return $this
     */
    public function setPointMobphone($point_mobphone)
    {
        $this->point_mobphone = $point_mobphone;

        return $this;
    }

    /**
     * Returns the value of field point_oaid
     *
     * @return integer
     */
    public function getPointOaid()
    {
        return $this->point_oaid;
    }

    /**
     * Returns the value of field point_orderid
     *
     * @return integer
     */
    public function getPointOrderid()
    {
        return $this->point_orderid;
    }

    /**
     * Returns the value of field point_truename
     *
     * @return string
     */
    public function getPointTruename()
    {
        return $this->point_truename;
    }

    /**
     * Returns the value of field point_areaid
     *
     * @return integer
     */
    public function getPointAreaid()
    {
        return $this->point_areaid;
    }

    /**
     * Returns the value of field point_areainfo
     *
     * @return string
     */
    public function getPointAreainfo()
    {
        return $this->point_areainfo;
    }

    /**
     * Returns the value of field point_address
     *
     * @return string
     */
    public function getPointAddress()
    {
        return $this->point_address;
    }

    /**
     * Returns the value of field point_telphone
     *
     * @return string
     */
    public function getPointTelphone()
    {
        return $this->point_telphone;
    }

    /**
     * Returns the value of field point_mobphone
     *
     * @return string
     */
    public function getPointMobphone()
    {
        return $this->point_mobphone;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'points_orderaddress';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsOrderaddress[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsOrderaddress
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
