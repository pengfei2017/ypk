<?php

namespace Ypk\Models;

class PointsOrder extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_orderid;

    /**
     *
     * @var string
     * @Column(type="string", length=20, nullable=false)
     */
    protected $point_ordersn;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_buyerid;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $point_buyername;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $point_buyeremail;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_addtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $point_shippingtime;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $point_shippingcode;

    /**
     *
     * @var string
     * @Column(type="string", length=30, nullable=true)
     */
    protected $point_shipping_ecode;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $point_finnshedtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_allpoint;

    /**
     *
     * @var string
     * @Column(type="string", length=300, nullable=true)
     */
    protected $point_ordermessage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_orderstate;

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
     * Method to set the value of field point_ordersn
     *
     * @param string $point_ordersn
     * @return $this
     */
    public function setPointOrdersn($point_ordersn)
    {
        $this->point_ordersn = $point_ordersn;

        return $this;
    }

    /**
     * Method to set the value of field point_buyerid
     *
     * @param integer $point_buyerid
     * @return $this
     */
    public function setPointBuyerid($point_buyerid)
    {
        $this->point_buyerid = $point_buyerid;

        return $this;
    }

    /**
     * Method to set the value of field point_buyername
     *
     * @param string $point_buyername
     * @return $this
     */
    public function setPointBuyername($point_buyername)
    {
        $this->point_buyername = $point_buyername;

        return $this;
    }

    /**
     * Method to set the value of field point_buyeremail
     *
     * @param string $point_buyeremail
     * @return $this
     */
    public function setPointBuyeremail($point_buyeremail)
    {
        $this->point_buyeremail = $point_buyeremail;

        return $this;
    }

    /**
     * Method to set the value of field point_addtime
     *
     * @param integer $point_addtime
     * @return $this
     */
    public function setPointAddtime($point_addtime)
    {
        $this->point_addtime = $point_addtime;

        return $this;
    }

    /**
     * Method to set the value of field point_shippingtime
     *
     * @param integer $point_shippingtime
     * @return $this
     */
    public function setPointShippingtime($point_shippingtime)
    {
        $this->point_shippingtime = $point_shippingtime;

        return $this;
    }

    /**
     * Method to set the value of field point_shippingcode
     *
     * @param string $point_shippingcode
     * @return $this
     */
    public function setPointShippingcode($point_shippingcode)
    {
        $this->point_shippingcode = $point_shippingcode;

        return $this;
    }

    /**
     * Method to set the value of field point_shipping_ecode
     *
     * @param string $point_shipping_ecode
     * @return $this
     */
    public function setPointShippingEcode($point_shipping_ecode)
    {
        $this->point_shipping_ecode = $point_shipping_ecode;

        return $this;
    }

    /**
     * Method to set the value of field point_finnshedtime
     *
     * @param integer $point_finnshedtime
     * @return $this
     */
    public function setPointFinnshedtime($point_finnshedtime)
    {
        $this->point_finnshedtime = $point_finnshedtime;

        return $this;
    }

    /**
     * Method to set the value of field point_allpoint
     *
     * @param integer $point_allpoint
     * @return $this
     */
    public function setPointAllpoint($point_allpoint)
    {
        $this->point_allpoint = $point_allpoint;

        return $this;
    }

    /**
     * Method to set the value of field point_ordermessage
     *
     * @param string $point_ordermessage
     * @return $this
     */
    public function setPointOrdermessage($point_ordermessage)
    {
        $this->point_ordermessage = $point_ordermessage;

        return $this;
    }

    /**
     * Method to set the value of field point_orderstate
     *
     * @param integer $point_orderstate
     * @return $this
     */
    public function setPointOrderstate($point_orderstate)
    {
        $this->point_orderstate = $point_orderstate;

        return $this;
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
     * Returns the value of field point_ordersn
     *
     * @return string
     */
    public function getPointOrdersn()
    {
        return $this->point_ordersn;
    }

    /**
     * Returns the value of field point_buyerid
     *
     * @return integer
     */
    public function getPointBuyerid()
    {
        return $this->point_buyerid;
    }

    /**
     * Returns the value of field point_buyername
     *
     * @return string
     */
    public function getPointBuyername()
    {
        return $this->point_buyername;
    }

    /**
     * Returns the value of field point_buyeremail
     *
     * @return string
     */
    public function getPointBuyeremail()
    {
        return $this->point_buyeremail;
    }

    /**
     * Returns the value of field point_addtime
     *
     * @return integer
     */
    public function getPointAddtime()
    {
        return $this->point_addtime;
    }

    /**
     * Returns the value of field point_shippingtime
     *
     * @return integer
     */
    public function getPointShippingtime()
    {
        return $this->point_shippingtime;
    }

    /**
     * Returns the value of field point_shippingcode
     *
     * @return string
     */
    public function getPointShippingcode()
    {
        return $this->point_shippingcode;
    }

    /**
     * Returns the value of field point_shipping_ecode
     *
     * @return string
     */
    public function getPointShippingEcode()
    {
        return $this->point_shipping_ecode;
    }

    /**
     * Returns the value of field point_finnshedtime
     *
     * @return integer
     */
    public function getPointFinnshedtime()
    {
        return $this->point_finnshedtime;
    }

    /**
     * Returns the value of field point_allpoint
     *
     * @return integer
     */
    public function getPointAllpoint()
    {
        return $this->point_allpoint;
    }

    /**
     * Returns the value of field point_ordermessage
     *
     * @return string
     */
    public function getPointOrdermessage()
    {
        return $this->point_ordermessage;
    }

    /**
     * Returns the value of field point_orderstate
     *
     * @return integer
     */
    public function getPointOrderstate()
    {
        return $this->point_orderstate;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'points_order';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsOrder[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsOrder
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
