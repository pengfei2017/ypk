<?php

namespace Ypk\Models;

class PointsOrdergoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_recid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_orderid;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_goodsid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $point_goodsname;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_goodspoints;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $point_goodsnum;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $point_goodsimage;

    /**
     * Method to set the value of field point_recid
     *
     * @param integer $point_recid
     * @return $this
     */
    public function setPointRecid($point_recid)
    {
        $this->point_recid = $point_recid;

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
     * Method to set the value of field point_goodsid
     *
     * @param integer $point_goodsid
     * @return $this
     */
    public function setPointGoodsid($point_goodsid)
    {
        $this->point_goodsid = $point_goodsid;

        return $this;
    }

    /**
     * Method to set the value of field point_goodsname
     *
     * @param string $point_goodsname
     * @return $this
     */
    public function setPointGoodsname($point_goodsname)
    {
        $this->point_goodsname = $point_goodsname;

        return $this;
    }

    /**
     * Method to set the value of field point_goodspoints
     *
     * @param integer $point_goodspoints
     * @return $this
     */
    public function setPointGoodspoints($point_goodspoints)
    {
        $this->point_goodspoints = $point_goodspoints;

        return $this;
    }

    /**
     * Method to set the value of field point_goodsnum
     *
     * @param integer $point_goodsnum
     * @return $this
     */
    public function setPointGoodsnum($point_goodsnum)
    {
        $this->point_goodsnum = $point_goodsnum;

        return $this;
    }

    /**
     * Method to set the value of field point_goodsimage
     *
     * @param string $point_goodsimage
     * @return $this
     */
    public function setPointGoodsimage($point_goodsimage)
    {
        $this->point_goodsimage = $point_goodsimage;

        return $this;
    }

    /**
     * Returns the value of field point_recid
     *
     * @return integer
     */
    public function getPointRecid()
    {
        return $this->point_recid;
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
     * Returns the value of field point_goodsid
     *
     * @return integer
     */
    public function getPointGoodsid()
    {
        return $this->point_goodsid;
    }

    /**
     * Returns the value of field point_goodsname
     *
     * @return string
     */
    public function getPointGoodsname()
    {
        return $this->point_goodsname;
    }

    /**
     * Returns the value of field point_goodspoints
     *
     * @return integer
     */
    public function getPointGoodspoints()
    {
        return $this->point_goodspoints;
    }

    /**
     * Returns the value of field point_goodsnum
     *
     * @return integer
     */
    public function getPointGoodsnum()
    {
        return $this->point_goodsnum;
    }

    /**
     * Returns the value of field point_goodsimage
     *
     * @return string
     */
    public function getPointGoodsimage()
    {
        return $this->point_goodsimage;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'points_ordergoods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsOrdergoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsOrdergoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
