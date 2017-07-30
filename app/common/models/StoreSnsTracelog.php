<?php

namespace Ypk\Models;

class StoreSnsTracelog extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    protected $strace_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $strace_storeid;

    /**
     *
     * @var string
     * @Column(type="string", length=100, nullable=true)
     */
    protected $strace_storename;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=true)
     */
    protected $strace_storelogo;

    /**
     *
     * @var string
     * @Column(type="string", length=150, nullable=true)
     */
    protected $strace_title;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $strace_content;

    /**
     *
     * @var string
     * @Column(type="string", length=11, nullable=true)
     */
    protected $strace_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $strace_cool;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $strace_spread;

    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    protected $strace_comment;

    /**
     *
     * @var integer
     * @Column(type="integer", length=4, nullable=true)
     */
    protected $strace_type;

    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    protected $strace_goodsdata;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    protected $strace_state;

    /**
     * Method to set the value of field strace_id
     *
     * @param integer $strace_id
     * @return $this
     */
    public function setStraceId($strace_id)
    {
        $this->strace_id = $strace_id;

        return $this;
    }

    /**
     * Method to set the value of field strace_storeid
     *
     * @param integer $strace_storeid
     * @return $this
     */
    public function setStraceStoreid($strace_storeid)
    {
        $this->strace_storeid = $strace_storeid;

        return $this;
    }

    /**
     * Method to set the value of field strace_storename
     *
     * @param string $strace_storename
     * @return $this
     */
    public function setStraceStorename($strace_storename)
    {
        $this->strace_storename = $strace_storename;

        return $this;
    }

    /**
     * Method to set the value of field strace_storelogo
     *
     * @param string $strace_storelogo
     * @return $this
     */
    public function setStraceStorelogo($strace_storelogo)
    {
        $this->strace_storelogo = $strace_storelogo;

        return $this;
    }

    /**
     * Method to set the value of field strace_title
     *
     * @param string $strace_title
     * @return $this
     */
    public function setStraceTitle($strace_title)
    {
        $this->strace_title = $strace_title;

        return $this;
    }

    /**
     * Method to set the value of field strace_content
     *
     * @param string $strace_content
     * @return $this
     */
    public function setStraceContent($strace_content)
    {
        $this->strace_content = $strace_content;

        return $this;
    }

    /**
     * Method to set the value of field strace_time
     *
     * @param string $strace_time
     * @return $this
     */
    public function setStraceTime($strace_time)
    {
        $this->strace_time = $strace_time;

        return $this;
    }

    /**
     * Method to set the value of field strace_cool
     *
     * @param integer $strace_cool
     * @return $this
     */
    public function setStraceCool($strace_cool)
    {
        $this->strace_cool = $strace_cool;

        return $this;
    }

    /**
     * Method to set the value of field strace_spread
     *
     * @param integer $strace_spread
     * @return $this
     */
    public function setStraceSpread($strace_spread)
    {
        $this->strace_spread = $strace_spread;

        return $this;
    }

    /**
     * Method to set the value of field strace_comment
     *
     * @param integer $strace_comment
     * @return $this
     */
    public function setStraceComment($strace_comment)
    {
        $this->strace_comment = $strace_comment;

        return $this;
    }

    /**
     * Method to set the value of field strace_type
     *
     * @param integer $strace_type
     * @return $this
     */
    public function setStraceType($strace_type)
    {
        $this->strace_type = $strace_type;

        return $this;
    }

    /**
     * Method to set the value of field strace_goodsdata
     *
     * @param string $strace_goodsdata
     * @return $this
     */
    public function setStraceGoodsdata($strace_goodsdata)
    {
        $this->strace_goodsdata = $strace_goodsdata;

        return $this;
    }

    /**
     * Method to set the value of field strace_state
     *
     * @param integer $strace_state
     * @return $this
     */
    public function setStraceState($strace_state)
    {
        $this->strace_state = $strace_state;

        return $this;
    }

    /**
     * Returns the value of field strace_id
     *
     * @return integer
     */
    public function getStraceId()
    {
        return $this->strace_id;
    }

    /**
     * Returns the value of field strace_storeid
     *
     * @return integer
     */
    public function getStraceStoreid()
    {
        return $this->strace_storeid;
    }

    /**
     * Returns the value of field strace_storename
     *
     * @return string
     */
    public function getStraceStorename()
    {
        return $this->strace_storename;
    }

    /**
     * Returns the value of field strace_storelogo
     *
     * @return string
     */
    public function getStraceStorelogo()
    {
        return $this->strace_storelogo;
    }

    /**
     * Returns the value of field strace_title
     *
     * @return string
     */
    public function getStraceTitle()
    {
        return $this->strace_title;
    }

    /**
     * Returns the value of field strace_content
     *
     * @return string
     */
    public function getStraceContent()
    {
        return $this->strace_content;
    }

    /**
     * Returns the value of field strace_time
     *
     * @return string
     */
    public function getStraceTime()
    {
        return $this->strace_time;
    }

    /**
     * Returns the value of field strace_cool
     *
     * @return integer
     */
    public function getStraceCool()
    {
        return $this->strace_cool;
    }

    /**
     * Returns the value of field strace_spread
     *
     * @return integer
     */
    public function getStraceSpread()
    {
        return $this->strace_spread;
    }

    /**
     * Returns the value of field strace_comment
     *
     * @return integer
     */
    public function getStraceComment()
    {
        return $this->strace_comment;
    }

    /**
     * Returns the value of field strace_type
     *
     * @return integer
     */
    public function getStraceType()
    {
        return $this->strace_type;
    }

    /**
     * Returns the value of field strace_goodsdata
     *
     * @return string
     */
    public function getStraceGoodsdata()
    {
        return $this->strace_goodsdata;
    }

    /**
     * Returns the value of field strace_state
     *
     * @return integer
     */
    public function getStraceState()
    {
        return $this->strace_state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'store_sns_tracelog';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSnsTracelog[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return StoreSnsTracelog
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
