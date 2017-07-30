<?php

namespace Ypk\Models;

class PXianshi extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $xianshi_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $xianshi_name;

    /**
     *
     * @var string
     * @Column(type="string", length=10, nullable=true)
     */
    protected $xianshi_title;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=true)
     */
    protected $xianshi_explain;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $quota_id;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $start_time;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $end_time;

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
    protected $store_id;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $member_name;

    /**
     *
     * @var string
     * @Column(type="string", length=50, nullable=false)
     */
    protected $store_name;

    /**
     *
     * @var integer
     * @Column(type="integer", length=10, nullable=false)
     */
    protected $lower_limit;

    /**
     *
     * @var integer
     * @Column(type="integer", length=3, nullable=false)
     */
    protected $state;

    /**
     * Method to set the value of field xianshi_id
     *
     * @param integer $xianshi_id
     * @return $this
     */
    public function setXianshiId($xianshi_id)
    {
        $this->xianshi_id = $xianshi_id;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_name
     *
     * @param string $xianshi_name
     * @return $this
     */
    public function setXianshiName($xianshi_name)
    {
        $this->xianshi_name = $xianshi_name;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_title
     *
     * @param string $xianshi_title
     * @return $this
     */
    public function setXianshiTitle($xianshi_title)
    {
        $this->xianshi_title = $xianshi_title;

        return $this;
    }

    /**
     * Method to set the value of field xianshi_explain
     *
     * @param string $xianshi_explain
     * @return $this
     */
    public function setXianshiExplain($xianshi_explain)
    {
        $this->xianshi_explain = $xianshi_explain;

        return $this;
    }

    /**
     * Method to set the value of field quota_id
     *
     * @param integer $quota_id
     * @return $this
     */
    public function setQuotaId($quota_id)
    {
        $this->quota_id = $quota_id;

        return $this;
    }

    /**
     * Method to set the value of field start_time
     *
     * @param integer $start_time
     * @return $this
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;

        return $this;
    }

    /**
     * Method to set the value of field end_time
     *
     * @param integer $end_time
     * @return $this
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;

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
     * Method to set the value of field member_name
     *
     * @param string $member_name
     * @return $this
     */
    public function setMemberName($member_name)
    {
        $this->member_name = $member_name;

        return $this;
    }

    /**
     * Method to set the value of field store_name
     *
     * @param string $store_name
     * @return $this
     */
    public function setStoreName($store_name)
    {
        $this->store_name = $store_name;

        return $this;
    }

    /**
     * Method to set the value of field lower_limit
     *
     * @param integer $lower_limit
     * @return $this
     */
    public function setLowerLimit($lower_limit)
    {
        $this->lower_limit = $lower_limit;

        return $this;
    }

    /**
     * Method to set the value of field state
     *
     * @param integer $state
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Returns the value of field xianshi_id
     *
     * @return integer
     */
    public function getXianshiId()
    {
        return $this->xianshi_id;
    }

    /**
     * Returns the value of field xianshi_name
     *
     * @return string
     */
    public function getXianshiName()
    {
        return $this->xianshi_name;
    }

    /**
     * Returns the value of field xianshi_title
     *
     * @return string
     */
    public function getXianshiTitle()
    {
        return $this->xianshi_title;
    }

    /**
     * Returns the value of field xianshi_explain
     *
     * @return string
     */
    public function getXianshiExplain()
    {
        return $this->xianshi_explain;
    }

    /**
     * Returns the value of field quota_id
     *
     * @return integer
     */
    public function getQuotaId()
    {
        return $this->quota_id;
    }

    /**
     * Returns the value of field start_time
     *
     * @return integer
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Returns the value of field end_time
     *
     * @return integer
     */
    public function getEndTime()
    {
        return $this->end_time;
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
     * Returns the value of field store_id
     *
     * @return integer
     */
    public function getStoreId()
    {
        return $this->store_id;
    }

    /**
     * Returns the value of field member_name
     *
     * @return string
     */
    public function getMemberName()
    {
        return $this->member_name;
    }

    /**
     * Returns the value of field store_name
     *
     * @return string
     */
    public function getStoreName()
    {
        return $this->store_name;
    }

    /**
     * Returns the value of field lower_limit
     *
     * @return integer
     */
    public function getLowerLimit()
    {
        return $this->lower_limit;
    }

    /**
     * Returns the value of field state
     *
     * @return integer
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'p_xianshi';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return PXianshi[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return PXianshi
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
