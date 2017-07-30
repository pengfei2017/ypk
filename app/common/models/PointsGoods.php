<?php

namespace Ypk\Models;

class PointsGoods extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_id;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=false)
     */
    protected $pgoods_name;

    /**
     *
     * @var double
     * @Column(type="double", length=10, nullable=false)
     */
    protected $pgoods_price;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_points;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $pgoods_image;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $pgoods_tag;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $pgoods_serial;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_storage;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $pgoods_show;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $pgoods_commend;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_add_time;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $pgoods_keywords;

    /**
     *
     * @var string
     * @Column(type="string", length=200, nullable=true)
     */
    protected $pgoods_description;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    protected $pgoods_body;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $pgoods_state;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $pgoods_close_reason;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_salenum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_view;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $pgoods_islimit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $pgoods_limitnum;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $pgoods_islimittime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_limitmgrade;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $pgoods_starttime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $pgoods_endtime;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $pgoods_sort;

    /**
     * Method to set the value of field pgoods_id
     *
     * @param integer $pgoods_id
     * @return $this
     */
    public function setPgoodsId($pgoods_id)
    {
        $this->pgoods_id = $pgoods_id;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_name
     *
     * @param string $pgoods_name
     * @return $this
     */
    public function setPgoodsName($pgoods_name)
    {
        $this->pgoods_name = $pgoods_name;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_price
     *
     * @param double $pgoods_price
     * @return $this
     */
    public function setPgoodsPrice($pgoods_price)
    {
        $this->pgoods_price = $pgoods_price;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_points
     *
     * @param integer $pgoods_points
     * @return $this
     */
    public function setPgoodsPoints($pgoods_points)
    {
        $this->pgoods_points = $pgoods_points;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_image
     *
     * @param string $pgoods_image
     * @return $this
     */
    public function setPgoodsImage($pgoods_image)
    {
        $this->pgoods_image = $pgoods_image;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_tag
     *
     * @param string $pgoods_tag
     * @return $this
     */
    public function setPgoodsTag($pgoods_tag)
    {
        $this->pgoods_tag = $pgoods_tag;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_serial
     *
     * @param string $pgoods_serial
     * @return $this
     */
    public function setPgoodsSerial($pgoods_serial)
    {
        $this->pgoods_serial = $pgoods_serial;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_storage
     *
     * @param integer $pgoods_storage
     * @return $this
     */
    public function setPgoodsStorage($pgoods_storage)
    {
        $this->pgoods_storage = $pgoods_storage;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_show
     *
     * @param integer $pgoods_show
     * @return $this
     */
    public function setPgoodsShow($pgoods_show)
    {
        $this->pgoods_show = $pgoods_show;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_commend
     *
     * @param integer $pgoods_commend
     * @return $this
     */
    public function setPgoodsCommend($pgoods_commend)
    {
        $this->pgoods_commend = $pgoods_commend;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_add_time
     *
     * @param integer $pgoods_add_time
     * @return $this
     */
    public function setPgoodsAddTime($pgoods_add_time)
    {
        $this->pgoods_add_time = $pgoods_add_time;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_keywords
     *
     * @param string $pgoods_keywords
     * @return $this
     */
    public function setPgoodsKeywords($pgoods_keywords)
    {
        $this->pgoods_keywords = $pgoods_keywords;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_description
     *
     * @param string $pgoods_description
     * @return $this
     */
    public function setPgoodsDescription($pgoods_description)
    {
        $this->pgoods_description = $pgoods_description;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_body
     *
     * @param string $pgoods_body
     * @return $this
     */
    public function setPgoodsBody($pgoods_body)
    {
        $this->pgoods_body = $pgoods_body;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_state
     *
     * @param integer $pgoods_state
     * @return $this
     */
    public function setPgoodsState($pgoods_state)
    {
        $this->pgoods_state = $pgoods_state;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_close_reason
     *
     * @param string $pgoods_close_reason
     * @return $this
     */
    public function setPgoodsCloseReason($pgoods_close_reason)
    {
        $this->pgoods_close_reason = $pgoods_close_reason;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_salenum
     *
     * @param integer $pgoods_salenum
     * @return $this
     */
    public function setPgoodsSalenum($pgoods_salenum)
    {
        $this->pgoods_salenum = $pgoods_salenum;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_view
     *
     * @param integer $pgoods_view
     * @return $this
     */
    public function setPgoodsView($pgoods_view)
    {
        $this->pgoods_view = $pgoods_view;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_islimit
     *
     * @param integer $pgoods_islimit
     * @return $this
     */
    public function setPgoodsIslimit($pgoods_islimit)
    {
        $this->pgoods_islimit = $pgoods_islimit;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_limitnum
     *
     * @param integer $pgoods_limitnum
     * @return $this
     */
    public function setPgoodsLimitnum($pgoods_limitnum)
    {
        $this->pgoods_limitnum = $pgoods_limitnum;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_islimittime
     *
     * @param integer $pgoods_islimittime
     * @return $this
     */
    public function setPgoodsIslimittime($pgoods_islimittime)
    {
        $this->pgoods_islimittime = $pgoods_islimittime;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_limitmgrade
     *
     * @param integer $pgoods_limitmgrade
     * @return $this
     */
    public function setPgoodsLimitmgrade($pgoods_limitmgrade)
    {
        $this->pgoods_limitmgrade = $pgoods_limitmgrade;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_starttime
     *
     * @param integer $pgoods_starttime
     * @return $this
     */
    public function setPgoodsStarttime($pgoods_starttime)
    {
        $this->pgoods_starttime = $pgoods_starttime;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_endtime
     *
     * @param integer $pgoods_endtime
     * @return $this
     */
    public function setPgoodsEndtime($pgoods_endtime)
    {
        $this->pgoods_endtime = $pgoods_endtime;

        return $this;
    }

    /**
     * Method to set the value of field pgoods_sort
     *
     * @param integer $pgoods_sort
     * @return $this
     */
    public function setPgoodsSort($pgoods_sort)
    {
        $this->pgoods_sort = $pgoods_sort;

        return $this;
    }

    /**
     * Returns the value of field pgoods_id
     *
     * @return integer
     */
    public function getPgoodsId()
    {
        return $this->pgoods_id;
    }

    /**
     * Returns the value of field pgoods_name
     *
     * @return string
     */
    public function getPgoodsName()
    {
        return $this->pgoods_name;
    }

    /**
     * Returns the value of field pgoods_price
     *
     * @return double
     */
    public function getPgoodsPrice()
    {
        return $this->pgoods_price;
    }

    /**
     * Returns the value of field pgoods_points
     *
     * @return integer
     */
    public function getPgoodsPoints()
    {
        return $this->pgoods_points;
    }

    /**
     * Returns the value of field pgoods_image
     *
     * @return string
     */
    public function getPgoodsImage()
    {
        return $this->pgoods_image;
    }

    /**
     * Returns the value of field pgoods_tag
     *
     * @return string
     */
    public function getPgoodsTag()
    {
        return $this->pgoods_tag;
    }

    /**
     * Returns the value of field pgoods_serial
     *
     * @return string
     */
    public function getPgoodsSerial()
    {
        return $this->pgoods_serial;
    }

    /**
     * Returns the value of field pgoods_storage
     *
     * @return integer
     */
    public function getPgoodsStorage()
    {
        return $this->pgoods_storage;
    }

    /**
     * Returns the value of field pgoods_show
     *
     * @return integer
     */
    public function getPgoodsShow()
    {
        return $this->pgoods_show;
    }

    /**
     * Returns the value of field pgoods_commend
     *
     * @return integer
     */
    public function getPgoodsCommend()
    {
        return $this->pgoods_commend;
    }

    /**
     * Returns the value of field pgoods_add_time
     *
     * @return integer
     */
    public function getPgoodsAddTime()
    {
        return $this->pgoods_add_time;
    }

    /**
     * Returns the value of field pgoods_keywords
     *
     * @return string
     */
    public function getPgoodsKeywords()
    {
        return $this->pgoods_keywords;
    }

    /**
     * Returns the value of field pgoods_description
     *
     * @return string
     */
    public function getPgoodsDescription()
    {
        return $this->pgoods_description;
    }

    /**
     * Returns the value of field pgoods_body
     *
     * @return string
     */
    public function getPgoodsBody()
    {
        return $this->pgoods_body;
    }

    /**
     * Returns the value of field pgoods_state
     *
     * @return integer
     */
    public function getPgoodsState()
    {
        return $this->pgoods_state;
    }

    /**
     * Returns the value of field pgoods_close_reason
     *
     * @return string
     */
    public function getPgoodsCloseReason()
    {
        return $this->pgoods_close_reason;
    }

    /**
     * Returns the value of field pgoods_salenum
     *
     * @return integer
     */
    public function getPgoodsSalenum()
    {
        return $this->pgoods_salenum;
    }

    /**
     * Returns the value of field pgoods_view
     *
     * @return integer
     */
    public function getPgoodsView()
    {
        return $this->pgoods_view;
    }

    /**
     * Returns the value of field pgoods_islimit
     *
     * @return integer
     */
    public function getPgoodsIslimit()
    {
        return $this->pgoods_islimit;
    }

    /**
     * Returns the value of field pgoods_limitnum
     *
     * @return integer
     */
    public function getPgoodsLimitnum()
    {
        return $this->pgoods_limitnum;
    }

    /**
     * Returns the value of field pgoods_islimittime
     *
     * @return integer
     */
    public function getPgoodsIslimittime()
    {
        return $this->pgoods_islimittime;
    }

    /**
     * Returns the value of field pgoods_limitmgrade
     *
     * @return integer
     */
    public function getPgoodsLimitmgrade()
    {
        return $this->pgoods_limitmgrade;
    }

    /**
     * Returns the value of field pgoods_starttime
     *
     * @return integer
     */
    public function getPgoodsStarttime()
    {
        return $this->pgoods_starttime;
    }

    /**
     * Returns the value of field pgoods_endtime
     *
     * @return integer
     */
    public function getPgoodsEndtime()
    {
        return $this->pgoods_endtime;
    }

    /**
     * Returns the value of field pgoods_sort
     *
     * @return integer
     */
    public function getPgoodsSort()
    {
        return $this->pgoods_sort;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'points_goods';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsGoods[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PointsGoods
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
